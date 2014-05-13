<?php

class Post extends \Eloquent {

    //protected $fillable = ['title', 'content', 'status','creator_id'];

    protected $appends = ['year', 'month'];

    public static $rules = [
        'title'   => 'required',
        'content' => 'required',
    ];
    public static $messages = [
        'title.required'   => 'You gotta have a title, dummy!',
        'content.required' => 'Where\'s the content?!',
    ];

    public function scopePublished($query)
    {
        return $query->whereStatus('published')->whereRaw('published_at <= TIMESTAMP(NOW())');
    }

    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    public function getDates()
    {
        return ['created_at', 'updated_at', 'published_at'];
    }

    public function getMonthAttribute()
    {
        if ($this->published_at)
        {
            return $this->published_at->format('m');
        }
    }

    public function getYearAttribute()
    {
        if ($this->published_at)
        {
            return $this->published_at->format('Y');
        }
    }

    public function getUrlAttribute()
    {
        return url($this->year . '/' . $this->month . '/' . $this->slug);
    }

    public function getIntroAttribute()
    {
        if (strpos($this->content, '<!--more-->'))
        {
            $arr = explode("<!--more-->", $this->content, 2);

            $intro = $arr[0];

            return $intro;
        }

        return $this->content;

    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo('User', 'creator_id');
    }

    public function categories()
    {
        return $this->belongsToMany('Category');
    }

    public function tags()
    {
        return $this->belongsToMany('Tag');
    }
}
