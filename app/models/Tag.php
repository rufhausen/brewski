<?php

class Tag extends \Eloquent {

    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany('Post');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

}
