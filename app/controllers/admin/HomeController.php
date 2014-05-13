<?php

class Admin_HomeController extends \BaseController {

    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->limit(5)->get();

        return View::make('admin.home', compact('posts'));
    }
}
