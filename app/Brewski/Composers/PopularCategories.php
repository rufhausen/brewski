<?php  namespace Brewski\Composers;

use Brewski\Repositories\CategoryInterface;
use Config;

class PopularCategories {

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function compose($view)
    {
        $view->with('popular_categories', $this->category->all());
    }
}
