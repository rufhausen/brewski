<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post as Post;
use App\Tag;
use Illuminate\Contracts\View\View as View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App as App;
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

    public function getContact()
    {
        return view('home.contact');
    }

    public function postContact()
    {

    }
}
