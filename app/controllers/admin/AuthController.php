<?php

class AuthController extends \BaseController {


    public function login()
    {
        if (!Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')]))
        {
            return Redirect::back()->withError('Email or Password not correct');
        }

        return Redirect::intended('admin');
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::to('admin/login');
    }
}
