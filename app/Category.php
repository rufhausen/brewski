<?php namespace App;

use App\Post as Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getBySlug($slug)
    {
        return self::whereSlug($slug)->get();
    }

    public static function getPopular($limit = 5)
    {

        $categories = Post::join('category_post', 'category_post.post_id', '=', 'posts.id')
            ->join('categories', 'categories.id', '=', 'category_post.category_id')
            ->select(DB::raw('categories.name, categories.slug, count(category_post.id) as cat_count'))
            ->groupBy('categories.id')
            ->limit($limit)
            ->get();

        return $categories;

    }
}
