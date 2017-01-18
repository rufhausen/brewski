<?php

namespace App\Http\ViewComposers;

use App\Tag;
use Illuminate\Contracts\View\View;

class TagsComposer
{

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $tags;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Tag $tags)
    {
        // Dependencies automatically resolved by service container...
        $this->tags = $tags;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('tags_list', $this->tags->all());
    }
}
