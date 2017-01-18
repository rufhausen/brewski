<?php

namespace App\Http\ViewComposers;

use App\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache as Cache;

class RecentPostsComposer
{

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $posts;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Post $posts)
    {
        // Dependencies automatically resolved by service container...
        $this->posts = $posts;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!Cache::get('recent_posts')) {
            Cache::put('recent_posts', $this->posts->getAll('published', null, 'published_at', 'desc', 5), 10);
        }
        $view->with('recent_posts', Cache::get('recent_posts'));
    }
}
