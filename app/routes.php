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

Route::group(['after' => 'cache:600'], function ()
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

Route::get('test', function ()
{
    $categories = Category::with('post')->get()->toArray();

    dd($categories);

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

Route::get('sitemap', function(){

    // create new sitemap object
    $sitemap = App::make("sitemap");

    // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
    // by default cache is disabled
    //$sitemap->setCache('laravel.sitemap', 3600);

    // add item to the sitemap (url, date, priority, freq)
    $sitemap->add(URL::to('contact'), date('Y-m-d').'T12:30:00+02:00', '0.5', 'monthly');
    // get all posts from db
    $posts = Post::published()->orderBy('created_at', 'desc')->get();

    foreach ($posts as $post)
    {
        //dd($post->url);
        $sitemap->add($post->url, $post->updated_at, '1.0', 'daily', null, htmlspecialchars($post->title));
    }

    $categories = Category::all();

    foreach ($categories as $category)
    {
        $sitemap->add(Request::root() . '/category/' . $category->slug, $category->updated_at, '1.0', 'daily', null, htmlspecialchars($category->name));
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');

});

Route::get('feed', function(){

    // creating rss feed with our most recent 20 posts
    $posts = Post::published()->orderBy('published_at', 'desc')->take(20)->get();

    $feed = Feed::make();

    // set your feed's title, description, link, pubdate and language
    $feed->title = Cache::get('options')->site_name;
    $feed->description = Cache::get('options')->description;
    $feed->logo = '';
    $feed->link = URL::to('feed');
    $feed->pubdate = $posts[0]->published_at;
    $feed->lang = 'en';

    foreach ($posts as $post)
    {
        // set item's title, author, url, pubdate, description and content
        $feed->add($post->title, $post->creator->full_name, URL::to($post->slug), $post->published_at, htmlentities($post->intro), htmlentities($post->content));
    }

    // show your feed (options: 'atom' (recommended) or 'rss')
    return $feed->render('atom');

    // show your feed with cache for 60 minutes
    // second param can be integer, carbon or datetime
    // optional: you can set custom cache key with 3rd param as string
    return $feed->render('atom', 60);

    // to return your feed as a string set second param to -1
    $xml = $feed->render('atom', -1);

});
