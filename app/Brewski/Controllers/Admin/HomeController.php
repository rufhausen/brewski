<?php namespace Brewski\Controllers\Admin;

use View;
use Page;
use Post;

class HomeController extends \BaseController {

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->limit(5)->get();
        $pages = Page::orderBy('created_at', 'DESC')->limit(5)->get();

        return View::make('Admin::home', compact('posts', 'pages'));
    }
}
