<?php

namespace App\Http\ViewComposers;

use App\Category;
use Illuminate\Contracts\View\View;

class CategoriesComposer
{

    /**
     * The user repository implementation.
     *
     * @var UserRepository
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
        $view->with('categories_list', $this->categories->all());
    }
}
