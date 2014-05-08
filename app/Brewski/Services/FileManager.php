<?php  namespace Brewski\Services;

use File;

class FileManager implements FileManagerInterface {

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function getMimeType()
    {
        return $this->file->getMimeType();
    }

    public function getSize()
    {
        return $this->file->getClientSize();
    }

    public function getOriginalName()
    {
        return $this->file->getClientOriginalName();
    }

    public function getOriginalBaseName()
    {
        return fileNameWithoutExt($this->getOriginalName());
    }

    public function getOriginalExt()
    {
        return getFileExt($this->getOriginalName());
    }


}
