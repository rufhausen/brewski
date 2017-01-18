<?php

namespace App\Http\ViewComposers;

use App\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache as Cache;

class PopularCategoriesComposer
{

    /**
     * [$categories description]
     * @var [type]
     */
    protected $categories;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Category $categories)
    {
        // Dependencies automatically resolved by service container...
        $this->categories = $categories;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!Cache::get('popular_categories')) {
            Cache::put('popular_categories', $this->categories->getPopular(), 60);
        }

        $view->with('popular_categories', Cache::get('popular_categories'));
    }
}
