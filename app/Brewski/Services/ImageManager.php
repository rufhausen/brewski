<?php  namespace Brewski\Services;

use Image;
use Config;

class ImageManager extends FileManager {

    public function __construct($file)
    {
        parent::__construct($file);

        $this->image = Image::make($file);
    }

    public function getWidth()
    {
        return $this->image->width;
    }

    public function getHeight()
    {
        return $this->image->height;
    }

    public function reSize($width, $height = null, $ratio = true, $upsize = false)
    {
        return $this->image->resize($width, $height, $ratio, $upsize);
    }

    public function save($file_path)
    {
        return $this->image->save($file_path);
    }

}
