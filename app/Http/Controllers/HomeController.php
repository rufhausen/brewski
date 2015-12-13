<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Post as Post;
use App\Tag;
use Illuminate\Contracts\View\View as View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App as App;
use Illuminate\Support\Facades\Cache as Cache;
use Illuminate\Support\Facades\Mail as Mail;
use Illuminate\Support\Facades\Redirect as Redirect;
use Illuminate\Support\Facades\URL as URL;
use Symfony\Component\Console\Input\Input as Input;

class HomeController extends Controller
{

    protected $request;
    protected $post;
    protected $category;
    protected $tag;

    /**
     * [__construct description]
     * @param Request  $request  [description]
     * @param Post     $post     [description]
     * @param Category $category [description]
     * @param Tag      $tag      [description]
     */
    public function __construct(Request $request, Post $post, Category $category, Tag $tag)
    {
        $this->request  = $request;
        $this->post     = $post;
        $this->category = $category;
        $this->tag      = $tag;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
        $posts = $this->post->getAll('published', 10);
        return view('home.index', compact('posts'));
    }

    public function getSearch()
    {
        $q     = htmlentities($this->request->input('q'));
        $posts = $this->post->search($q);

        return view('home.search', compact('q', 'posts'));
    }

    /**
     * @param $slug
     */
    public function getPost($slug)
    {

        $slug = htmlentities($this->request->segment(3));
        $post = $this->post->getBySlug($slug);
        if (!$post) {
            return App::abort(404);
        }
        return view('posts.show', compact('post'));
    }

    /**
     *
     * @return mixed
     */
    public function getCategory()
    {
        $slug     = htmlentities($this->request->segment(2));
        $posts    = $this->post->getByCategorySlug($slug, 5);
        $category = $this->category->getBySlug($slug)->first();

        if (!$category) {
            return App::abort(404);
        }

        return view('home.category', compact('posts', 'category'));
    }

    /**
     *
     * @return mixed
     */
    public function getTag()
    {
        $slug  = htmlentities($this->request->segment(2));
        $posts = $this->post->getByTagSlug($slug, 5);
        $tag   = $this->tag->getBySlug($slug)->first();

        if (!$tag) {
            return App::abort(404);
        }

        return view('home.tag', compact('posts', 'tag'));
    }

    /**
     * @return mixed
     */
    public function getFeed()
    {
        // creating rss feed with our most recent 20 posts
        $posts = $this->post->getAll('published', null, 'published_at', 'desc', 20); //$paginate = null, $sort_by = 'created_at', $order = 'desc', $limit = null

        $feed = \Feed::make();

        // set your feed's title, description, link, pubdate and language
        $feed->title       = \Cache::get('settings')['site_name'];
        $feed->description = \Cache::get('settings')['meta_description'];
        $feed->logo        = '';
        $feed->link        = link_to('feed');
        $feed->pubdate     = $posts{0}->published_at;
        $feed->lang        = 'en';

        foreach ($posts as $post) {
            // set item's title, author, url, pubdate, description and content
            $feed->add($post->title, $post->creator->full_name, link_to($post->url), $post->published_at, htmlentities($post->intro), htmlentities($post->content));
        }

        return $feed->render('atom', 60);
    }

    /**
     * @return mixed
     */
    public function getSiteMap()
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
        // by default cache is disabled
        $sitemap->setCache('laravel.sitemap', 3600);

        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(link_to('contact'), date('Y-m-d') . 'T12:30:00+02:00', '0.5', 'monthly');
        // get all posts from db
        $posts = $this->post->getAll('published');

        foreach ($posts as $post) {
            $sitemap->add($post->url, $post->updated_at, '1.0', 'daily', null, htmlspecialchars($post->title));
        }

        $categories = $this->category->all();

        foreach ($categories as $category) {
            $sitemap->add($this->request->root() . '/category/' . $category->slug, $category->updated_at, '1.0', 'daily', null, htmlspecialchars($category->name));
        }

        $tags = $this->tag->all();

        foreach ($tags as $tag) {
            $sitemap->add($this->request->root() . '/tag/' . $tag->slug, $tag->updated_at, '1.0', 'daily', null, htmlspecialchars($tag->name));
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }

    public function getContact()
    {
        return view('home.contact');
    }

    /**
     * @param ContactRequest $request
     */
    public function postContact(ContactRequest $request)
    {
        $data = $request->all();

        Mail::send('emails.contact', $data, function ($message) use ($request) {
            $message
            ->from($request->input('email'), $request->input('name'))
            ->to(Cache::get('settings')['admin_email'])
            ->subject(Cache::get('settings')['site_name'] . ' Contact Form Message');
        });

        return redirect()->to('contact')->with('success', 'You message has been sent! We\'ll be in touch soon.');
    }
}
