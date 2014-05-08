<?php namespace Brewski\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Redirect;
use Input;

class AuthController extends \BaseController {


    public function login()
    {
        //$user = User::whereEmail(Input::get('email'))->wherePassword(Input::get('password'));

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
