<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function getBySlug($slug)
    {
        return self::whereSlug($slug)->get();
    }
}
