<?php

use Brewski\Repositories\PostInterface;
use Brewski\Repositories\CategoryInterface;
use Illuminate\Support\Facades\Request;

class HomeController extends BaseController {

    public function __construct(PostInterface $post, CategoryInterface $category)
    {
        $this->post     = $post;
        $this->category = $category;
    }

    public function index()
    {
        $posts = $this->post->paginate(Cache::get('options')->posts_per_page, 'published', 'published_at', 'DESC');

        return View::make(Theme::getViewPath() . 'home', compact('posts'));
    }

    public function search()
    {
        $q = htmlentities(Input::get('q'));

        return View::make(Theme::getViewPath() . 'search', compact('q'));
    }

    public function post()
    {
        $slug = htmlentities(Request::segment(3));
        $post = $this->post->findBySlug($slug);

        if (!$post)
        {
            return App::abort(404);
        }

        return View::make(Theme::getViewPath() . 'post', compact('post'));
    }

    public function category()
    {
        $slug     = htmlentities(Request::segment(2));
        $posts    = $this->post->getByCategorySlug($slug, 5);
        $category = $this->category->getBySlug($slug)->first();

        if (!$category)
        {
            return App::abort(404);
        }

        return View::make(Theme::getViewPath() . 'category', compact('posts', 'category'));
    }

    public function contact()
    {
        return View::make(Theme::getViewPath() . 'contact');
    }

    public function postContact()
    {

        $rules = array(
            'name'    => 'required|max:200',
            'email'   => 'required|email',
            'content' => 'required|max: 1000'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            return Redirect::back()->withErrors($validation)->withInput();
        }

        $data = Input::all();

        Mail::send(Theme::getViewPath() . 'email.contact', $data, function ($message)
        {
            $message
                ->from(Input::get('email'), Input::get('name'))
                ->to(Cache::get('options')->admin_email)
                ->subject(Cache::get('options')->site_name . ' Contact Form Message');
        });

        return Redirect::to('contact')->with('success', 'You message has been sent! We\'ll be in touch soon.');
    }

    public function getFeed()
    {
        // creating rss feed with our most recent 20 posts
        $posts = $this->post->getPublished(20);

        $feed = Feed::make();

        // set your feed's title, description, link, pubdate and language
        $feed->title = Cache::get('options')->site_name;
        $feed->description = Cache::get('options')->description;
        $feed->logo = '';
        $feed->link = URL::to('feed');
        $feed->pubdate = $posts{0}->published_at;
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
    }

    public function getSiteMap()
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
        // by default cache is disabled
        //$sitemap->setCache('laravel.sitemap', 3600);

        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('contact'), date('Y-m-d').'T12:30:00+02:00', '0.5', 'monthly');
        // get all posts from db
        $posts = $this->post->getPublished();

        foreach ($posts as $post)
        {
            //dd($post->url);
            $sitemap->add($post->url, $post->updated_at, '1.0', 'daily', null, htmlspecialchars($post->title));
        }

        $categories = $this->category->all();

        foreach ($categories as $category)
        {
            $sitemap->add(Request::root() . '/category/' . $category->slug, $category->updated_at, '1.0', 'daily', null, htmlspecialchars($category->name));
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }


}
