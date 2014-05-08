<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach ( range(1, 30) as $index )
        {
            $title      = $faker->sentence(5);

            Post::create([
                'title'        => $title,
                'slug'         => \Str::slug($title),
                'status'       => 'draft', //$statuses[$status_key],
                'content'      => implode("\r\n", $faker->paragraphs(rand(3, 5))),
                'creator_id'   => 1,
                'published_at' => null,
                'created_at'   => $faker->dateTimeBetween($startDate = '-3 months', $endDate = 'now'),
                'updated_at'   => new DateTime,
            ]);
            unset( $title );
            unset( $publish_date );
        }
    }

}
