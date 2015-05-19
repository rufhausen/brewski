<?php

Route::get('/', 'HomeController@getIndex');
Route::get('search', ['as' => 'search', 'uses' => 'HomeController@getSearch']);
Route::get('contact', 'HomeController@getContact');
Route::post('contact', ['as' => 'post_contact', 'uses' => 'HomeController@postContact']);
Route::get('feed', ['as' => 'feed', 'uses' => 'HomeController@getFeed']);
Route::get('sitemap', 'HomeController@getSiteMap');

Route::get('{year}/{month}/{slug}', ['as' => 'post', 'uses' => 'HomeController@getPost'])
    ->where(['year' => '[0-9]+', 'month' => '[0-9]+', 'slug' => '^[a-zA-Z0-9-]*$']);

Route::get('category/{slug}', ['as' => 'category', 'uses' => 'HomeController@getCategory'])
    ->where(['slug' => '^[a-zA-Z0-9-]*$']);

Route::get('tag/{slug}', ['as' => 'tag', 'uses' => 'HomeController@getTag'])
    ->where(['slug' => '^[a-zA-Z0-9-]*$']);

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::controller('password', 'Auth\PasswordController');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'HomeController@getIndex');
        Route::get('auth/logout', 'Auth\AuthController@getLogout');
        Route::resource('posts', 'PostsController', ['except' => 'show']);
        Route::resource('users', 'UsersController', ['except' => 'show']);
        Route::controller('settings', 'SettingsController');
        Route::get('clear-cache', 'CacheController@getClear');
    });

});

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::get('tags/{term?}', function ($term) {
        if (($term !== null) && (strlen($term) >= 2)) {
            $tags = App\Tag::where('name', 'LIKE', $term . '%')->get();

            return response()->json([
                'status' => 'success',
                'data'   => $tags->toArray(),
            ]);
        }
    });
});