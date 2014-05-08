<?php

class Media extends \Eloquent {

    protected $fillable = [];
    protected $table = 'media';

    public static $rules = [
        'name' => '',
        'file' => 'required|image'

    ];
    public static $messages = [];

    public function getFileSizeAttribute($value)
    {
        return fileSizeForHumans($value);
    }

    public function creator()
    {
        return $this->hasOne('User', 'id', 'creator_id');
    }

}
