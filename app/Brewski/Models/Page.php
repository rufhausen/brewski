<?php namespace Brewski\Models;

class Page extends \Eloquent {

    protected $fillable = [];

    public static $rules = [
        'title'   => 'required',
        'content' => 'required',
    ];

    public static $messages = [
        'title.required'   => 'You gotta have a title, dummy!',
        'content.required' => 'Where\'s the content?!',
    ];

    public function creator()
    {
        return $this->belongsTo('User', 'creator_id');
    }
}
