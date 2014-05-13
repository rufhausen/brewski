<?php

class UsersController extends \BaseController {

    public function index()
    {
        $users = User::with('posts')->get();

        return View::make('admin.users.index', compact('users'));
    }
}
