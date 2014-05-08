<?php

class PagesTableSeeder extends Seeder {

    public function run()
    {
        Page::create([
            'title'      => 'About',
            'content'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur at eros tellus. Phasellus pellentesque orci in dolor feugiat id
    volutpat erat aliquet. Nullam non purus sapien, a aliquet ante. Vivamus quis massa non massa dignissim vehicula mattis vitae risus.
    In hac habitasse platea dictumst. Ut augue sem, mattis quis ullamcorper at, imperdiet in velit.
    Donec enim leo, adipiscing in varius quis, faucibus a augue. Duis vitae varius tellus.
    Vestibulum semper tellus sed elit convallis ac ullamcorper risus tempu',
            'status'     => 'published',
            'creator_id' => 1,
            'created_at' => new DateTime,
        ]);

        Page::create([
            'title'      => 'Contact',
            'content'    => 'Contact Form',
            'status'     => 'published',
            'creator_id' => 1,
            'created_at' => new DateTime,
        ]);

    }

}
