<?php
//include '../../../vendor/autoload.php';
include "class/Session.php";
include "class/App.php";
include "class/Template.php";
include "class/Tariffs.php";
include "class/Seo.php";
include "functions/meta/Index.php";

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action ('wp_head', 'rel_canonical');
remove_action( 'wp_head', 'rest_output_link_wp_head');
remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function remove_json_ld_output( $data ) {
    $data = array();
    return $data;
}
add_filter('wpseo_json_ld_output', 'remove_json_ld_output', 10, 1);

function ShortDescription($text, $maxlen){
    $string = strip_tags($text);
    $len = (mb_strlen($string) > $maxlen)? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
    $cutStr = mb_substr($string, 0, $len);
    return (mb_strlen($string) > $maxlen)? $cutStr.'...' : $cutStr;
}
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>
	';
}
add_theme_support( 'post-thumbnails', array('portfolio', 'post'));


add_action('init', 'do_rewrite');
function do_rewrite(){
    add_rewrite_rule( 'portfolio/category/(.+?)/filter-([^/]+)/?$', 'index.php?portfolio-categories=$matches[1]&filter=$matches[2]', 'top' );
    add_rewrite_rule( 'portfolio/filter-([^/]+)/?$', 'index.php?post_type=portfolio&filter=$matches[1]', 'top' );
    add_filter( 'query_vars', function($vars){
        $vars[] = 'filter';
        return $vars;
    } );
}

add_action('template_redirect', 'template_redirect_attachment');
function template_redirect_attachment() {
    global $post;
    if (is_attachment()) {
        wp_redirect(get_permalink($post->post_parent));
    }
}
