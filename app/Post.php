<?php

namespace App;

use App\Category;
use App\Tag as Tag;
use Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB as DB;

class Post extends Model
{
    protected $appends = ['year', 'month', 'url'];

    protected $fillable = ['title', 'content', 'allow_comments', 'published_at', 'status'];

    protected $dates = ['created_at', 'updated_at', 'published_at'];

    public function getMonthAttribute()
    {
        if ($this->published_at) {
            return $this->published_at->format('m');
        }
    }

    public function getYearAttribute()
    {
        if ($this->published_at) {
            return $this->published_at->format('Y');
        }
    }

    public function getUrlAttribute()
    {
        return url($this->year . '/' . $this->month . '/' . $this->slug);
    }

    public function scopePublished($query)
    {
        $query->whereStatus('published')->whereRaw('published_at <= TIMESTAMP(NOW())');
    }

    public function scopeDraft($query)
    {
        $query->whereStatus('draft');
    }

    public static function getBySlug($slug)
    {
        return self::whereSlug($slug)->first();
    }

    public function getByCategorySlug($slug, $perPage = null)
    {
        $posts = self::whereHas('categories', function ($q) use ($slug) {
            $q->whereRaw('slug = ?', [$slug]);
        });
        $posts = $posts->with('tags', 'categories')->orderBy('created_at', 'DESC');
        if (!empty($perPage)) {
            $posts = $posts->paginate(5);
        } else {
            $posts = $posts->get();
        }

        return $posts;
    }

    public function getByTagSlug($slug, $perPage = null)
    {
        $posts = self::whereHas('tags', function ($q) use ($slug) {
            $q->whereRaw('slug = ?', [$slug]);
        });
        $posts = $posts->with('tags', 'categories')->orderBy('created_at', 'DESC');
        if (!empty($perPage)) {
            $posts = $posts->paginate(5);
        } else {
            $posts = $posts->get();
        }

        return $posts;
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function doUpdate($id, $request)
    {
        DB::transaction(function () use ($id, $request) {
            $post = Post::find($id);
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->allow_comments = ($request->input('allow_comments') !== null ? 1 : null);

            if (($request->input('status') !== null) && ($request->input('status') == 'published')) {
                $post->status = 'published';
                if ($request->input('published_at') !== null) {
                    $post->published_at = new \DateTime($request->input('published_at'));
                } else {
                    $post->published_at = new \DateTime;
                }
            } else {
                $post->status = 'draft';
                $post->published_at = null;
            }

            $post->slug = $this->makeSlug($post);
            $post->save();

            $this->indexToElasticSearch($post);

            $post->setCategories($post, $request->input('category_id'), $request->input('new_category'));

            $post->setTags($post, commaListToArray($request->input('tags')));

            //\File::cleanDirectory(app('http_cache.cache_dir'));
        });
    }

    public function store($request)
    {
        // dd($request->all());
        DB::transaction(function () use ($request) {
            $post = new Post;
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->creator_id = \Auth::user()->id;
            $post->allow_comments = ($request->input('allow_comments') == 'on' ? 1 : 0);

            if ($request->input('status') == 'published') {
                $post->status = 'published';
                if ($request->input('published_at') !== null) {
                    $post->published_at = new \DateTime($request->input('published_at'));
                } else {
                    $post->published_at = new \DateTime;
                }
            } else {
                $post->status = 'draft';
                $post->published_at = null;
            }
            $post->save();

            $post->slug = $this->makeSlug($post);
            $post->save();

            $this->indexToElasticSearch($post);

            $this->new_post = $post;

            $post->setCategories($post, $request->input('category_id'), $request->input('new_category'));
            $post->setTags($post, $request->input('tags'));

            //\File::cleanDirectory(app('http_cache.cache_dir'));
        });

        return $this->new_post;
    }

    // public function search($q)
    // {
    //     $posts = self::published()->where(function ($query) use ($q) {
    //         return $query->whereRaw('title LIKE ? OR content LIKE ?', ["%$q%", "%$q%"]);
    //     })->get();
    //
    //     return $posts;
    // }

    public static function getAll($type = 'all', $paginate = null, $sort_by = 'created_at', $order = 'desc', $limit = null)
    {
        $posts = self::orderBy($sort_by, $order);

        switch ($type) {
        case 'published':
            $posts = $posts->published();
            break;
        case 'draft':
            $posts = $posts->draft();
            break;
        default:
            $posts = $posts;
        }

        if (!is_null($limit)) {
            $posts = $posts->take(5);
        }

        if (!is_null($paginate)) {
            $posts = $posts->paginate($paginate);
        } else {
            $posts = $posts->get();
        }

        return $posts;
    }

    public static function makeSlug($post)
    {
        $current_slugs = self::whereSlug(str_slug($post->title))->where('id', '<>', $post->id)->get();

        if ($current_slugs->count()) {
            return str_slug($post->title . '-' . $post->id);
        }

        return str_slug($post->title);
    }

    public static function setTags($post, $tags = null)
    {
        $post->tags()->detach();
        $postTags = [];

        if (isset($tags) && (!empty($tags))) {
            foreach ($tags as $key => $value) {
                $currentTag = Tag::whereSlug(str_slug($value))->first();

                if (!$currentTag) {
                    $newTag = Tag::create([
                        'name' => $value,
                        'slug' => str_slug($value),
                    ]);
                    $addTagId = $newTag->id;
                } else {
                    $addTagId = $currentTag->id;
                }
                array_push($postTags, $addTagId);
            }
            $post->tags()->attach($postTags);
        }
    }

    public static function setCategories($post, $categoryIds = null, $newCategory = null)
    {
        $post->categories()->detach();

        if (isset($newCategory) && (!empty($newCategory))) {
            $currentCategory = Category::whereSlug(str_slug($newCategory))->first();

            if (!$currentCategory) {
                $newCategory = Category::create([
                    'name' => $newCategory,
                    'slug' => str_slug($newCategory),
                ]);
                $addCatid = $newCategory->id;
            } else {
                $addCatid = $currentCategory->id;
            }
            if (is_null($categoryIds)) {
                $categoryIds = [];
            }
            array_push($categoryIds, $addCatid);
        }

        if (isset($categoryIds)) {
            $post->categories()->attach($categoryIds);
        }
    }

    public function getIntroAttribute()
    {
        $divider = '<div style="page-break-after: always"><span style="display: none;">&nbsp;</span></div>';
        //<div style="page-break-after: always"><span style="display: none;">&nbsp;</span></div>

        if (strpos($this->content, $divider)) {
            $arr = explode($divider, $this->content, 2);

            $intro = $arr[0];

            return $intro;
        }

        return $this->content;
    }

    public function indexToElasticSearch($post)
    {
        $es = ClientBuilder::create()->build();

        $es->index([
            'index' => 'brewski',
            'type'  => 'post',
            'id'    => $post->id,
            'body'  => $post->toArray(),
        ]);
    }

    public static function makeCollectionFromElasticSearch($array)
    {
        if ($array['hits']['hits'] !== null) {
            $results = [];
            foreach ($array['hits']['hits'] as $post) {
                $results[] = $post;
            }

            return Collection::make(array_map(function ($r) {
                $post = new static();
                $post->newInstance($r['_source'], true);
                $post->setRawAttributes($r['_source'], true);
                return $post;
            }, $results));
        }

        return new Collection;
    }
}
