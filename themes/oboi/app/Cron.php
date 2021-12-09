<?php
add_filter( 'cron_schedules', 'mycron_add_schedule' );
function mycron_add_schedule(){
//    $schedules['my_cron_category'] = array( 'interval' => 60 * 60, 'display' => 'Импорт категорий' );
    $schedules['my_cron_goods'] = array( 'interval' => 60 * 60 , 'display' => 'Импорт каталога' );
    return $schedules;
}
//
//if ( ! wp_next_scheduled( 'my_cron_worker_category' ) ) {
//    wp_schedule_event( time(), 'my_cron_category', 'my_cron_worker_category' );
//}
if ( ! wp_next_scheduled( 'my_cron_worker_goods' ) ) {
    wp_schedule_event( time(), 'my_cron_goods', 'my_cron_worker_goods' );
}
//
//add_action( 'my_cron_worker_category', 'import_category_function' );
//function import_category_function() {
//    Category::Import("Full.xml");
//}
add_action( 'my_cron_worker_goods', 'import_goods_function' );
function import_goods_function() {
    Category::Import("Full.xml");
    Goods::Import("Full.xml");
}

//wp_unschedule_event( wp_next_scheduled('my_cron_worker_category'), 'my_cron_worker_category' );

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.05.2018
 * Time: 19:35
 */
class Cron
{

}