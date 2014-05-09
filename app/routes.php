<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group([
    'after' => 'cache:'. ((isset(Cache::get('options')->cache_time )) ? (int) Cache::get('options')->cache_time : 0)], function ()
{
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);

    Route::get('{year}/{month}/{slug}', ['as' => 'post', 'uses' => 'HomeController@post'])
         ->where(['year' => '[0-9]+', 'month' => '[0-9]+', 'slug' => '^[a-zA-Z0-9-]*$']);

    Route::get('category/{slug}', ['as' => 'category', 'uses' => 'HomeController@category'])
         ->where(['slug' => '^[a-zA-Z0-9-]*$']);
});

Route::post('contact', 'HomeController@postContact');
Route::controller('password', 'RemindersController');
Route::get('sitemap', 'HomeController@getSiteMap');
Route::get('feed', 'HomeController@getFeed');

Route::get('test', function ()
{
    return Cache::get('options')['posts_per_page'];
});

Route::group(['prefix' => 'admin'], function ()
{
    Route::get('logout', 'Brewski\Controllers\Admin\AuthController@logout');
    Route::post('login', 'Brewski\Controllers\Admin\AuthController@login');

    Route::get('login', function ()
    {
        return View::make('Admin::login');
    });

    Route::group(['before' => 'auth'], function ()
    {
        Route::get('/', 'Brewski\Controllers\Admin\HomeController@index');
        Route::controller('options', 'Brewski\Controllers\Admin\OptionsController');
        Route::resource('posts', 'Brewski\Controllers\Admin\PostsController');
        Route::resource('pages', 'Brewski\Controllers\Admin\PagesController');
        Route::controller('media', 'Brewski\Controllers\Admin\MediaController');

    });
});


