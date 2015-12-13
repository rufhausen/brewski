<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', 'App\Http\ViewComposers\CategoriesComposer');
        View::composer('*', 'App\Http\ViewComposers\PopularCategoriesComposer');
        View::composer('*', 'App\Http\ViewComposers\RecentPostsComposer');
        View::composer('*', 'App\Http\ViewComposers\MetaComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
