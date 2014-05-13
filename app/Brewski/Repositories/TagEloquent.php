<?php  namespace Brewski\Repositories;

use Tag;

class TagEloquent implements TagInterface {

    public function getBySlug($slug)
    {
        return Tag::whereSlug($slug)->get();
    }
}
