<?php namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post as Post;

class PostsController extends Controller
{

    protected $post;
    protected $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post     = $post;
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = $this->post->getAll(null, 30);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->category->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $this->post->store($request);

        // $status = ($request->input('status') == 'published' ? 'published' : 'draft'); //not ready

        // $post = $this->post->create(
        //     [
        //         'title'          => $request->input('title'),
        //         'content'        => $request->input('content'),
        //         'status'         => $status,
        //         'allow_comments' => $request->allow_comments,
        //     ]);

        // $post->slug = $this->post->makeSlug($post);
        // $post->save();

        // $this->post->setCategories($post, $request->input('category_id'), $request->input('new_category'));
        // $this->post->setTags($post, commaListToArray($request->input('tags')));

        return redirect('/admin/posts')->withSuccess('Post was created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $categories = $this->category->all();
        $post       = $this->post->find($id);

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdatePostRequest $request, $id)
    {

        $this->post->doUpdate($id, $request);

        // $status = ($request->input('status') == 'published' ? 'published' : 'draft');

        // $post                 = $this->post->find($id);
        // $post->title          = $request->input('title');
        // $post->content        = $request->input('content');
        // $post->status         = $status;
        // $post->allow_comments = $request->allow_comments;
        // $post->save();

        // $this->post->setCategories($post, $request->input('category_id'), $request->input('new_category'));
        // $this->post->setTags($post, commaListToArray($request->input('tags')));

        // $post->slug = $this->post->makeSlug($post);
        // $post->save();

        return redirect('admin/posts/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->post->find($id)->delete();

        return redirect('admin/posts')->withSuccess('Post deleted');
    }
}
