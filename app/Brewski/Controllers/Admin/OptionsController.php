<?php namespace Brewski\Controllers\Admin;

use Brewski\Repositories\PageInterface;

use View;
use Input;
use Theme;
use Cache;
use Redirect;
use File;

class OptionsController extends \BaseController {

    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    public function getIndex()
    {
        $options = json_decode(File::get(app_path() . '/Brewski/config.json'));
        $themes  = Theme::getThemes();

        //$pages   = $this->page->lists('title', 'id');

        return View::make('Admin::options.index', compact('options', 'pages', 'themes'));
    }

    public function putUpdate()
    {
        $options = [
            'site_name'           => Input::get('site_name'),
            'admin_email'         => Input::get('admin_email'),
            'home_page'           => Input::get('home_page'),
            //'home_page_id'        => Input::get('home_page_id'),
            'posts_per_page'      => Input::get('posts_per_page'),
            'google_analytics_id' => Input::get('google_analytics_id'),
            'keywords'            => Input::get('keywords'),
            'description'         => Input::get('description'),
            'theme'               => Input::get('theme'),
            'disqus_shortname'   => Input::get('disqus_shortname'),
        ];

        File::put(app_path() . '/Brewski/config.json', json_encode($options, JSON_PRETTY_PRINT));

        Cache::forget('options');

        return Redirect::back()->withSuccess('Options Updated!');
    }
}
