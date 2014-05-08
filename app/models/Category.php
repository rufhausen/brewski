<?php

class Category extends \Eloquent {

    protected $fillable = ['name', 'slug'];

    public function post()
    {
        return $this->belongsToMany('Post');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

}
