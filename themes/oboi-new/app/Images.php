<?php
use \Gumlet\ImageResize;
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16.07.2020
 * Time: 16:09
 */
class Images
{
    public static $width = 300;

    public static function ResizeImagesFullConvert()
    {
//        array_map('unlink', glob($_SERVER['DOCUMENT_ROOT'] . '/1C/mini/*'));
        $images_result = self::ImagesGlogResult($_SERVER['DOCUMENT_ROOT'] . "/1C", array('mini', 'Full.xml'));
        foreach ($images_result as $key => $val){
            self::Resize($_SERVER['DOCUMENT_ROOT'] . '/1C/' . $val, $_SERVER['DOCUMENT_ROOT'] . '/1C/mini/' . $val);
        }
    }

    public static function Resize($path_file, $path_resize)
    {
        $image = new ImageResize($path_file);
        $image->resizeToWidth(self::$width);
        $image->save($path_resize);
    }

    private static function ImagesGlogResult($path, $noy_files = array())
    {
        $file = scandir($path);
        unset($file[0], $file[1]);
        $images_result = array();
        $i = 0;
        foreach ($file as $key => $val){
            if(!in_array($val, $noy_files)){
                $images_result[$i] = $val;
                $i++;
            }
        }
        return $images_result;
    }

    public static function ImagesPath($link)
    {
        $path = explode("/", $link)[2];
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/1C/mini/' . $path)) {
            return Ceo::$domain . '/1C/mini/' . $path;
        } else {
            return Ceo::$domain . '/1C/' . $path;
        }
    }
}