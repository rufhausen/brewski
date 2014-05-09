<?php  namespace Brewski\Composers;

use Brewski\Repositories\CategoryInterface;


class CategoryList {

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }
    public function compose($view)
    {
        $view->with('categoryList', $this->category->all());
    }
}
