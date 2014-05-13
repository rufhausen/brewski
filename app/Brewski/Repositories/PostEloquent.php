<?php namespace Brewski\Repositories;

use Post;
use Category;
use Tag;
use DB;
use Input;
use Auth;
use Str;

class PostEloquent extends BaseEloquent implements PostInterface {


    public function find($id)
    {
        return Post::find($id);
    }

    public function findBySlug($slug)
    {
        return Post::whereSlug($slug)->first();
    }

    public function search($q)
    {
        $posts = Post::published()->where(function ($query) use ($q)
        {
            return $query->whereRaw('title LIKE ? OR content LIKE ?', ["%$q%", "%$q%"]);
        })->get();

        return $posts;
    }

    public function getPublished($num = null, $order_by = 'published_at', $sort_order = 'DESC')
    {
        $posts = Post::published()->orderBy($order_by, $sort_order);

        if (!is_null($num))
        {
            $posts = $posts->limit($num);
        }

        return $posts->get();

    }

    public function getByTagSlug($slug, $per_page = null)
    {
        $posts = Post::whereHas('tags', function ($q) use ($slug)
        {
            $q->whereRaw('slug = ?', [$slug]);
        });
        if (!empty( $per_page ))
        {
            $posts = $posts->paginate(5);
        } else
        {
            $posts = $posts->get();
        }

        return $posts;
    }

    public function getByCategorySlug($slug, $per_page = null)
    {
        $posts = Post::whereHas('categories', function ($q) use ($slug)
        {
            $q->whereRaw('slug = ?', [$slug]);
        });
        if (!empty( $per_page ))
        {
            $posts = $posts->paginate(5);
        } else
        {
            $posts = $posts->get();
        }

        return $posts;
    }

    public function paginate($num, $status = 'published', $column = 'created_at', $order = 'DESC')
    {
        $posts = Post::orderBy($column, $order);
        switch ( $status )
        {
            case 'published';
                $posts = $posts->whereStatus('published');
                break;
            case 'draft';
                $posts = $posts->whereStatus('draft');
                break;
            case 'all';
                break;
            default;
                break;
        }

        return $posts->paginate($num);
    }

    public function create()
    {
        $this->validator->validate(Input::all(), Post::$rules, Post::$messages);
        $this->errors = $this->validator->getErrors();

        $this->new_post = null;

        if (!$this->getErrors())
        {
            DB::transaction(function ()
            {
                $post                 = new Post;
                $post->title          = Input::get('title');
                $post->content        = Input::get('content');
                $post->creator_id     = Auth::user()->id;
                $post->allow_comments = ( Input::get('allow_comments') == 'on' ? 1 : null );

                if (Input::get('status') == 'published')
                {
                    $post->status = 'published';
                    if (Input::get('published_at') !== null)
                    {
                        $post->published_at = new \DateTime(Input::get('published_at'));
                    } else
                    {
                        $post->published_at = new \DateTime;
                    }

                } else
                {
                    $post->status       = 'draft';
                    $post->published_at = null;
                }
                $post->save();
                $post->slug = $this->setSlug($post);
                $post->save();

                $this->new_post = $post;


                $this->setCategories($post, Input::get('category_id'), Input::get('new_category'));
                $this->setTags($post, Input::get('tags'));

                \File::cleanDirectory(app('http_cache.cache_dir'));

            });
        }

        return $this->new_post;
    }

    public function update($id)
    {
        $this->validator->validate(Input::all(), Post::$rules, Post::$messages);
        $this->errors = $this->validator->getErrors();

        if (!$this->getErrors())
        {
            DB::transaction(function () use ($id)
            {
                $post                 = Post::find($id);
                $post->title          = Input::get('title');
                $post->content        = Input::get('content');
                $post->allow_comments = ( Input::get('allow_comments') == 'on' ? 1 : null );
                if (Input::get('status') == 'published')
                {
                    $post->status = 'published';
                    if (Input::get('published_at') !== null)
                    {
                        $post->published_at = new \DateTime(Input::get('published_at'));
                    } else
                    {
                        $post->published_at = new \DateTime;
                    }

                } else
                {
                    $post->status       = 'draft';
                    $post->published_at = null;
                }
                $post->save();
                $post->slug = $this->setSlug($post);

                $this->setCategories($post, Input::get('category_id'), Input::get('new_category'));
                $this->setTags($post, commaListToArray(Input::get('tags')));

                \File::cleanDirectory(app('http_cache.cache_dir'));
            });
        }
    }

    public function setSlug($post)
    {
        $current_slugs = Post::whereSlug(Str::slug($post->title))->get();
        if ($current_slugs->count())
        {
            return Str::slug($post->title . '-' . $post->id);
        }

        return Str::slug($post->title);
    }

    public function setTags($post, $tags = null)
    {
        $post->tags()->detach();

        if (isset( $tags ) and ( !empty( $tags ) ))
        {
            $post_tags = [];
            foreach ( $tags as $key => $value )
            {
                $current_tag = Tag::whereSlug(Str::slug($value))->first();

                if (!$current_tag)
                {
                    $new_tag    = Tag::create([
                        'name' => $value,
                        'slug' => Str::slug($value)
                    ]);
                    $add_tag_id = $new_tag->id;


                } else
                {
                    $add_tag_id = $current_tag->id;
                }
                array_push($post_tags, $add_tag_id);
            }
        }

        $post->tags()->attach($post_tags);
    }

    public function setCategories($post, $category_ids = null, $new_category = null)
    {
        $post->categories()->detach();

        if (isset( $new_category ) and ( !empty( $new_category ) ))
        {
            $current_category = Category::whereSlug(Str::slug($new_category))->first();

            if (!$current_category)
            {
                $new_category = Category::create([
                    'name' => $new_category,
                    'slug' => Str::slug($new_category)
                ]);
                $add_cat_id   = $new_category->id;

            } else
            {
                $add_cat_id = $current_category->id;
            }
            if (is_null($category_ids))
            {
                $category_ids = [];
            }
            array_push($category_ids, $add_cat_id);
        }

        if (isset( $category_ids ))
        {
            $post->categories()->attach($category_ids);
        }
    }

    public function destroy($id)
    {
        $post = Post::destroy($id);

        return $post;
    }
}
