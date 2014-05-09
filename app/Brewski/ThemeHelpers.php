<?php  namespace Brewski;

use File;
use Cache;
use Request;

class ThemeHelpers {

    public static function test()
    {
        echo 'foo';
    }

    public static function getThemes()
    {
        $theme_folder = public_path() . '/themes';
        $themes       = array();
        foreach ( new \DirectoryIterator($theme_folder) as $fileInfo )
        {
            if ($fileInfo->isDot())
            {
                continue;
            }
            if (!$fileInfo->isDir())
            {
                continue;
            }

            $config = $theme_folder . '/' . $fileInfo->getFilename() . '/config.json';

            if (File::isFile($config))
            {
                $contents                         = json_decode(file_get_contents($config));
                $theme_name                       = $contents->name;
                $themes[$fileInfo->getFilename()] = $theme_name;
            }
        }

        return $themes;
    }

//    public static function getLayouts()
//    {
//        $theme        = Option::select('theme')->first();
//        $theme_folder = public_path() . '/themes/' . $theme->theme;
//        $config       = $theme_folder . '/config.json';
//
//        if (File::isFile($config)) {
//            $contents = json_decode(File::get($config));
//            $layouts  = $contents->layouts;
//            return (array)$layouts;
//        }
//
//        return null;
//    }

    public static function getViewPath()
    {
        return 'Themes::' . Cache::get('options')->theme . '.views.';
    }

    public static function getLayoutPath()
    {
        return 'Themes::' . Cache::get('options')->theme . '.views.layouts.';
    }

    public static function getPartialPath()
    {
        return 'Themes::' . Cache::get('options')->theme . '.views.partials.';
    }

    public static function getUrlPath()
    {
        return Request::root() . '/themes/' . Cache::get('options')->theme;
    }

    public static function getWidgetPath()
    {
        return 'Themes::' . Cache::get('options')->theme . '.views.widgets.';
    }

}
