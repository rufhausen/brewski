<?php namespace Brewski\Services;

interface FileManagerInterface {

    public function getMimeType();

    public function getSize();

    public function getOriginalName();

    public function getOriginalBaseName();

    public function getOriginalExt();
}
