<?php  namespace Brewski\Repositories;


use Media;
use Input;
use File;
use Auth;
use Redirect;
use Image;
use Config;
use Str;

/**
 *Repository for media objects
 * @todo prevent overwriting of files with the same name
 */
class MediaEloquent extends BaseEloquent implements MediaInterface {

    /**
     *
     */
    public function find($id)
    {
        return Media::find($id);
    }

    /**
     *
     */
    public function paginate($num = 5, $column = 'created_at', $order = 'DESC')
    {
        return Media::orderBy($column, $order)->paginate($num);
    }

    /**
     *
     */
    public function create()
    {
        $this->validator->validate(Input::all(), Media::$rules, Media::$messages);
        $this->errors = $this->validator->getErrors();

        if (!$this->getErrors())
        {
            $original_file = Input::file('file');
            $new_file_name = Str::slug(fileNameWithoutExt($original_file->getClientOriginalName()))
                             . '.' . getFileExt($original_file->getClientOriginalName());

            $original_file->move(Config::get('blog.media_path'), $new_file_name);

            $image = Image::make(Config::get('blog.media_path') . $new_file_name);
            $image->resize(700, null, true, false);
            $image->save(Config::get('blog.media_path') . $new_file_name);

            $media             = new Media;
            $media->name       = ( ( Input::get('name') !== '' ) ? Input::get('name') : $new_file_name );
            $media->creator_id = Auth::user()->id;
            $media->type       = $image->mime;
            $media->filename   = $new_file_name;
            $media->dimensions = $image->width . 'x' . $image->height;
            $media->file_size  = File::size(Config::get('blog.media_path') . $new_file_name);
            $media->save();

            //Create Thumbnail
            $image->resize(120, null, true, false);
            $image->save(Config::get('blog.media_path') . 'thumb_' . $new_file_name);
        }

    }

    /**
     *
     */
    public function update($input)
    {

    }

    /**
     *
     */
    public function destroy($id)
    {
        $media = Media::find($id);

        $media->delete();

        return $media;
    }
}
