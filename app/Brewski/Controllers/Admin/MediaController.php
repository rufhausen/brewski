<?php  namespace Brewski\Controllers\Admin;

use View;
use Input;
use Redirect;
use Brewski\Repositories\MediaInterface;
use File;
use Config;

class MediaController extends \BaseController {

    public function __construct(MediaInterface $media)
    {
        $this->media = $media;
    }

    public function getIndex()
    {
        $media = $this->media->paginate();

        return View::make('Admin::media.index', compact('media'));
    }

    public function getCreate()
    {
        return View::make('Admin::media.create');
    }

    public function postStore()
    {
        $this->media->create();

        if ($this->media->getErrors())
        {
            return Redirect::back()->withErrors($this->media->getErrors());
        }

        return Redirect::action('Brewski\Controllers\Admin\MediaController@getIndex')
                       ->withSuccess('Media has been created.');
    }

    public function deleteDestroy()
    {
        if (!Input::get('id'))
        {
            return Redirect::back()->withErrors('Invalid Media Object');
        }

        $media = $this->media->destroy(Input::get('id'));

        File::delete(Config::get('blog.media_path') . $media->filename);
        File::delete(Config::get('blog.media_path') . 'thumb_' . $media->filename);


        return Redirect::action('Brewski\Controllers\Admin\MediaController@getIndex')
                       ->withSucess('Media object has been deleted');
    }

}
