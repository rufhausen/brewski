<?php namespace App\Services;

use Illuminate\Support\Facades\Storage as Storage;

class Settings
{

    public function get($item)
    {
        $settings = $this->loadFile();

        if (isset($settings->$item)) {
            return $settings->$item;
        }
    }

    protected function loadFile()
    {
        $settings = json_decode(Storage::get('settings.json'));

        return $settings;
    }
}
