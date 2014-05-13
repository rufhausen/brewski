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
    'after' => 'cache:' . ( ( isset( Cache::get('options')->cache_time ) ) ? (int) Cache::get('options')->cache_time : 0 )
], function ()
{
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);

    Route::get('{year}/{month}/{slug}', ['as' => 'post', 'uses' => 'HomeController@post'])
         ->where(['year' => '[0-9]+', 'month' => '[0-9]+', 'slug' => '^[a-zA-Z0-9-]*$']);

    Route::get('category/{slug}', ['as' => 'category', 'uses' => 'HomeController@category'])
         ->where(['slug' => '^[a-zA-Z0-9-]*$']);

    Route::get('tag/{slug}', ['as' => 'tag', 'uses' => 'HomeController@tag'])
         ->where(['slug' => '^[a-zA-Z0-9-]*$']);;
});

Route::post('contact', 'HomeController@postContact');
Route::get('search', 'HomeController@search');
Route::controller('password', 'RemindersController');
Route::get('sitemap', 'HomeController@getSiteMap');
Route::get('feed', 'HomeController@getFeed');

Route::get('test', function ()
{
    var_dump(arrayToCommaList(Post::find(19)->tags->lists('name')));
});

Route::group(['prefix' => 'admin'], function ()
{
    Route::get('logout', 'AuthController@logout');
    Route::post('login', 'AuthController@login');

    Route::get('login', function ()
    {
        return View::make('admin.login');
    });

    Route::group(['before' => 'auth'], function ()
    {
        Route::get('/', 'Admin_HomeController@index');
        Route::controller('options', 'OptionsController');
        Route::resource('posts', 'PostsController');
        Route::resource('pages', 'PagesController');
        Route::controller('media', 'MediaController');

    });

    Route::group(['prefix' => 'api'], function ()
    {
        Route::get('tags', function ()
        {
            return Tag::lists('name');
        });
    });
});


