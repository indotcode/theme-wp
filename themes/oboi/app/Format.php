<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.05.2018
 * Time: 15:49
 */
class Format
{
    public static function Description($text, $maxlen){
        $string = strip_tags($text);
        $len = (mb_strlen($string) > $maxlen)? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
        $cutStr = mb_substr($string, 0, $len);
        return (mb_strlen($string) > $maxlen)? $cutStr : $cutStr;
    }

    public static function PostMeta($id)
    {
        $result = array();
        foreach (get_post_meta($id) as $key => $val){
            switch ($key){
                case 'Фотографии':
                    $result[$key] = @unserialize($val[0]);
                    break;
                default:
                    $result[$key] = $val[0];
                    break;
            }
        }
        return $result;
    }
}