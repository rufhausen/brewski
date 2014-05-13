<?php

use Brewski\Repositories\PostInterface;


class PostsController extends \BaseController {

    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the post.
     *
     * @return Response
     */
    public function index()
    {
        $posts = $this->post->paginate(10, 'all');

        return View::make('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.posts.create');
    }

    /**
     * Store a newly created post in storage.
     *
     * @return Response
     */
    public function store()
    {
        $post = $this->post->create(Input::all());

        if ($this->post->getErrors())
        {
            return Redirect::back()->withErrors($this->post->getErrors());
        }

        return Redirect::action('PostsController@edit', $post->id)
            ->withSuccess('Your post has been created!');
    }

    /**
     * Display the specified post.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = $this->post->find($id);

        return View::make('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id)
    {
        //dd(Input::all());
        $this->post->update($id, Input::all());

        if ($this->post->getErrors())
        {
            return Redirect::back()->withErrors($this->post->getErrors());
        }

        return Redirect::action('PostsController@edit', $id)
            ->withSuccess('The post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->post->destroy($id);

        return Redirect::action('PostsController@index')
            ->withSuccess('The post has been deleted.');
    }

}
