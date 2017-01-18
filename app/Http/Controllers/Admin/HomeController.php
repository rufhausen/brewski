<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post as Post;

class HomeController extends Controller
{
    protected $post;

    /**
     * [__construct description]
     * @param Post $post [description]
     */
    public function __construct(Post $post)
    {
        $this->middleware('auth');
        $this->post = $post;
    }

    /**
     * [getIndex description]
     * @return [type] [description]
     */
    public function getIndex()
    {
        $posts = $this->post->getAll(null, 10);
        return view('admin.index', compact('posts'));
    }
}
