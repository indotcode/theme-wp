<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 25.04.2019
 * Time: 14:55
 */
class Tariffs
{
    public static function ResultTab($ar)
    {
        $status = self::OneThe($ar);
        $tariffs_result = array();
        switch ($status){
            case 'unit':
                $tariffs_result = array(
                    array(
                        'name' => 'Все',
                        'result' => $ar
                    )
                );
                break;
            case 'tab':
                $tariffs_result = self::SortTab($ar);
                break;
        }
        $result = array(
            'status' => $status,
            'tab' => $tariffs_result
        );
        return $result;
    }

    private static function SortTab($ar)
    {
        $type = self::TypeTariffs($ar);
        $result = array();
        foreach ($type as $key => $val){
            $array = array();
            $i = 0;
            foreach ($ar as $key2 => $val2){
                if($val == $val2['type-rate']){
                    $array[$i] = $val2;
                    $i++;
                }
            }
            if($val != ''){
                $result[] = array(
                    'name' => $val,
                    'result' => $array
                );
            }

        }
        return $result;
    }

    private static function TypeTariffs($ar)
    {
        $result = array();
        foreach ($ar as $key => $val){
            if(!in_array($val['type-rate'], $result)){
                $result[] = $val['type-rate'];
            }
        }
        return $result;
    }

    private static function OneThe($ar)
    {
        $status = 'unit';
        foreach ($ar as $key => $val){
            if($val['type-rate'] != ''){
                $status = 'tab';
                break;
            }
        }
        return $status;
    }
}