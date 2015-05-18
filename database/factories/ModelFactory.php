<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */
use Illuminate\Support\Str;

$factory->define('App\User', function ($faker) {
    return [
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->email,
        'password'       => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define('App\Post', function ($faker) {

    $title = $faker->sentence(5);
    $statuses = ['draft', 'published'];
    $status_picked = array_rand(['draft', 'published']);
    $status = $statuses[$status_picked];

    return [
        'title'          => $title,
        'slug'           => Str::slug($title),
        'status'         => $status,
        'content'        => implode("\r\n", $faker->paragraphs(rand(3, 5))),
        'creator_id'     => 1,
        'allow_comments' => 1,
        'published_at'   => ($status == 'published' ? $faker->dateTimeBetween('-3 months', 'now') : null),
        'created_at'     => $faker->dateTimeBetween('-3 months', 'now'),
        'updated_at'     => new DateTime,

    ];
});

$factory->define('App\Category', function ($faker) {

    $name = $faker->sentence(rand(1, 3));

    return [
        'name' => $name,
        'slug' => Str::slug($name),
    ];
});

$factory->define('App\Tag', function ($faker) {

    $name = $faker->sentence(rand(1, 3));

    return [
        'name' => $name,
        'slug' => Str::slug($name),
    ];
});
