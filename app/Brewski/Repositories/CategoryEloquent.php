<?php  namespace Brewski\Repositories;

use Category;

class CategoryEloquent implements CategoryInterface {

    public function all()
    {
        return Category::all();
    }

    public function find($id)
    {
        return Category::find($id);
    }

    public function getBySlug($slug)
    {
        return Category::whereSlug($slug)->get();
    }
}
