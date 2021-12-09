<?php
@session_start();
if(empty($_SESSION['basket'])){
    $_SESSION['basket'] = array();
}

if(empty($_SESSION['filter'])){
    $_SESSION['filter'] = array();
}

if(empty($_SESSION['posts_per_page'])){
    $_SESSION['posts_per_page'] = 12;
}

if(empty($_SESSION['grid'])){
    $_SESSION['grid'] = 'column';
}

if(empty($_SESSION['sort'])){
    $_SESSION['sort'] = 'date';
}

//if(empty($_SESSION['orderby'])){
//    $_SESSION['orderby'] = 'meta_value';
//}

if(empty($_SESSION['you_watched_recently'])){
    $_SESSION['you_watched_recently'] = array();
}

require $_SERVER['DOCUMENT_ROOT'] .'/vendor/autoload.php';
include "app/Images.php";
include "app/Ceo.php";
include "app/Basket.php";
include "app/Format.php";
include "app/Conversion.php";
include "app/Category.php";
include "app/Plugins.php";
include "app/Goods.php";
include "app/Cron.php";
include "app/Router.php";
include "app/Filter.php";
include "app/meta.php";

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link' );
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head','rel_canonical');
remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
remove_action( 'wp_head', 'rest_output_link_wp_head');

add_theme_support( 'post-thumbnails' );

register_nav_menus(array(
    'top_menu' => 'Главное меню',
    'footer_cat' => 'Меню категорий в низу',
    'footer_bot' => 'Нижнее меню'
));


add_filter( 'excerpt_length', 'filter_function_excerpt_length' );
function filter_function_excerpt_length( $number ){
    if(is_category('news')){
        $number = 20;
    }
    return $number;
}

add_filter( 'excerpt_more', 'filter_function_excerpt_more' );
function filter_function_excerpt_more( $more_string ){
    $more_string = "...";
    return $more_string;
}

function true_post_type_rewrite() {
    global $wp_rewrite;
    add_rewrite_rule( '^(search-goods)/([^/]*)?', 'index.php?pagename=$matches[1]&search=$matches[2]', 'top' );
    add_filter( 'query_vars', function( $vars ){
        $vars[] = 'search';
        return $vars;
    } );

}
add_action( 'init', 'true_post_type_rewrite');