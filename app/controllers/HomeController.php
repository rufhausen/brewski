<?php

use Brewski\Repositories\PostInterface;
use Illuminate\Support\Facades\Request;

class HomeController extends BaseController {

    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->paginate(Cache::get('options')->posts_per_page, 'published', 'published_at', 'DESC');

        return View::make('Themes::' . Cache::get('options')->theme . '.views.home', compact('posts'));
    }

    public function post()
    {
        $slug = htmlentities(Request::segment(3));
        $post = $this->post->findBySlug($slug);

        if (!$post)
        {
            return App::abort(404);
        }

        return View::make('Themes::' . Cache::get('options')->theme . '.views.post', compact('post'));
    }

    public function category()
    {
        $slug  = htmlentities(Request::segment(2));
        $posts = $this->post->getByCategorySlug($slug, 5);

        $category = Category::whereSlug($slug)->first();

        if (!$category)
        {
            return App::abort(404);
        }

        return View::make('Themes::' . Cache::get('options')->theme . '.views.category', compact('posts', 'category'));
    }

    public function contact()
    {
        return View::make('Themes::' . Cache::get('options')->theme . '.views.contact');
    }

    public function postContact()
    {

        $rules= array(
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

        Mail::send('Themes::' . Cache::get('options')->theme . '.views.email.contact' , $data, function($message)
        {
            $message
                ->from(Input::get('email'), Input::get('name'))
                ->to(Cache::get('options')->admin_email)
                ->subject(Cache::get('options')->site_name . ' Contact Form Message');
        });

        return Redirect::to('contact')->with('success','You message has been sent! We\'ll be in touch soon.');
    }

}
