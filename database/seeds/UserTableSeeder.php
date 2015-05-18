<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Gary',
            'last_name'  => 'Taylor',
            'email'      => 'gtaylor@electricwerks.com',
            'password'   => bcrypt('password'),
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
        factory('App\User', 9)->create();
    }
}
