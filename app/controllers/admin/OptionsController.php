<?php

class OptionsController extends \BaseController {

    public function __construct()
    {

    }

    public function getIndex()
    {
        $options = json_decode(File::get(app_path() . '/Brewski/config.json'));
        $themes  = Theme::getThemes();

        return View::make('admin.options.index', compact('options', 'themes'));
    }

    public function putUpdate()
    {
        $options = [
            'site_name'             => Input::get('site_name'),
            'admin_email'           => Input::get('admin_email'),
            'posts_per_page'        => Input::get('posts_per_page'),
            'google_analytics_id'   => Input::get('google_analytics_id'),
            'keywords'              => Input::get('keywords'),
            'cache_time'            => Input::get('cache_time'),
            'description'           => Input::get('description'),
            'theme'                 => Input::get('theme'),
            'disqus_shortname'      => Input::get('disqus_shortname'),
            'recaptcha_enabled'     => Input::get('recaptcha_enabled'),
            'recaptcha_public_key'  => trim(Input::get('recaptcha_public_key')),
            'recaptcha_private_key' => trim(Input::get('recaptcha_private_key')),
            'facebook_url'          => Input::get('facebook_url'),
            'twitter_handle'        => Input::get('twitter_handle'),
            'linked_in_url'         => Input::get('linked_in_url'),
            'rss_feed_url'          => Input::get('rss_feed_url'),
            'google_plus_url'       => Input::get('google_plus_url'),
        ];

        File::put(app_path() . '/Brewski/config.json', json_encode($options, JSON_PRETTY_PRINT));

        \File::cleanDirectory(app('http_cache.cache_dir'));
        Cache::forget('options');

        return Redirect::back()->withSuccess('Options Updated!');
    }

    public function getClearCache()
    {
        \File::cleanDirectory(app('http_cache.cache_dir'));
        \Artisan::call('cache:clear');

        return Redirect::back()->withSuccess('Cache Cleared!');
    }
}
