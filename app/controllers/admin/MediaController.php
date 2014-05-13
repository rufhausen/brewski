<?php

use Brewski\Repositories\MediaInterface;

class MediaController extends \BaseController {

    public function __construct(MediaInterface $media)
    {
        $this->media = $media;
    }

    public function getIndex()
    {
        $media = $this->media->paginate();

        return View::make('admin.media.index', compact('media'));
    }

    public function getCreate()
    {
        return View::make('admin.media.create');
    }

    public function postStore()
    {
        $this->media->create();

        if ($this->media->getErrors())
        {
            return Redirect::back()->withErrors($this->media->getErrors());
        }

        return Redirect::action('MediaController@getIndex')
                       ->withSuccess('Media has been created.');
    }

    public function deleteDestroy()
    {
        if (!Input::get('id'))
        {
            return Redirect::back()->withErrors('Invalid Media Object');
        }

        $media = $this->media->destroy(Input::get('id'));

        File::delete(Config::get('brewski.media_path') . $media->filename);
        File::delete(Config::get('brewski.media_path') . 'thumb_' . $media->filename);


        return Redirect::action('MediaController@getIndex')
                       ->withSucess('Media object has been deleted');
    }

}
