<?php namespace Brewski;

use Illuminate\Support\ServiceProvider;
use View;

class BrewskiServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'Brewski\Repositories\PostInterface',
            'Brewski\Repositories\PostEloquent'
        );

        $this->app->bind(
            'Brewski\Repositories\PageInterface',
            'Brewski\Repositories\PageEloquent'
        );

        $this->app->bind(
            'Brewski\Repositories\CategoryInterface',
            'Brewski\Repositories\CategoryEloquent'
        );

        $this->app->bind(
            'Brewski\Repositories\MediaInterface',
            'Brewski\Repositories\MediaEloquent'
        );

        $this->app->bind('theme', function ()
        {
            return new ThemeHelpers;
        });

        //Custom Locations & Namespaces
        View::addLocation(public_path() . '/themes/');
        View::addLocation(app_path() . '/Brewski/Views');
        View::addLocation(app_path() . '/Brewski/Views/Shared');
        View::addNamespace('Shared', app_path() . '/Brewski/Views/Shared');
        View::addNamespace('Admin', app_path() . '/Brewski/Views');
        View::addNamespace('Themes', public_path() . '/themes/');

        //View Composers
        View::composer(['/', 'Admin::posts.create', 'Admin::posts.edit'], 'Brewski\Composers\CategoryList');
        View::composer('*.layouts.*', 'Brewski\Composers\RecentPosts');
        View::composer('*.layouts.*', 'Brewski\Composers\PopularCategories');

    }
}
