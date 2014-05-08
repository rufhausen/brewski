<?php  namespace Brewski\Composers;

use Category;

class CategoryList {

    public function compose($view)
    {
        $view->with('categoryList', Category::all());
    }
}
