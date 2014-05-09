<?php

function fileNameWithoutExt($filename)
{
    return preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
}

function getFileExt($file)
{
    return substr(strrchr($file, '.'), 1);
}

function showMoreLink($post)
{
    if (strpos($post->content, '<!--more-->'))
    {
        return link_to_route('post', 'Read More ...', [$post->year, $post->month, $post->slug]);
    }
}

function fileSizeForHumans($size)
{
    $filesizename = array("Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

    return $size ? round($size / pow(1024, ( $i = floor(log($size, 1024)) )), 2) . $filesizename[$i] : '0 Bytes';
}

function getCmsVersion()
{
    $version_file = base_path() . '/version.txt';

    if (File::exists($version_file))
    {
        $version = File::get($version_file);

        if(strstr($version, '-'))
            $version = strstr($version,'-',true);

        return $version;
    }
}
