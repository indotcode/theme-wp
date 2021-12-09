<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.05.2018
 * Time: 15:52
 */
class Conversion
{
    /**
     * @param $date
     * @return string
     * конвертация даты из бд с нозванием
     */
    public static function Date($date)
    {
        $mas_data = explode(".", $date);
        $mas_name = array(
            '01' => 'Января',
            '02' => 'Февраля',
            '03' => 'Марта',
            '04' => 'Апреля',
            '05' => 'Мая',
            '06' => 'Июня',
            '07' => 'Июля',
            '08' => 'Августа',
            '09' => 'Сентября',
            '10' => 'Октября',
            '11' => 'Ноября',
            '12' => 'Декабря',
        );
        return array(
            'day' => $mas_data[0],
            'month' => $mas_name[$mas_data[1]],
            'year' => $mas_data[2]
        );
    }

    /**
     * @param $date
     * @return mixed
     * Конвертатыя даты из поля и запись в базу данных
     */
    public static function DateDbUpdate($date){
        $date_mas = explode(".", $date);
        $date_get = $date_mas[2].'-'.$date_mas[1].'-'.$date_mas[0].' 00:00:00';
        return $date_get;
    }
}