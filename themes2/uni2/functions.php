<?php
//include '../../../vendor/autoload.php';
include "class/Session.php";
include "class/App.php";
include "class/Template.php";
include "class/Tariffs.php";
include "class/Seo.php";
include "class/ConvertingNumNames.php";
include "functions/meta/Index.php";
include "functions/manage.php";

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
    <div class="navigation-archive__nav">
        %3$s
    </div>
	';
}
add_theme_support( 'post-thumbnails', array('portfolio', 'post'));


//add_action( 'pre_get_posts', 'wpsites_no_limit_posts' );
//function wpsites_no_limit_posts( $query ) {
//    if(!is_admin()){
//        if(is_tax(['portfolio-categories', 'branches']) || is_post_type_archive('portfolio')) {
//            $query->set( 'posts_per_page', 12 );
//        }
//    }
//}

add_action('init', 'do_rewrite');
function do_rewrite(){
    add_rewrite_rule( 'portfolio/category/(.+?)/filter-([^/]+)/?$', 'index.php?portfolio-categories=$matches[1]&filter=$matches[2]', 'top' );
    add_rewrite_rule( 'portfolio/filter-([^/]+)/?$', 'index.php?post_type=portfolio&filter=$matches[1]', 'top' );
    add_filter( 'query_vars', function($vars){
        $vars[] = 'filter';
        return $vars;
    } );
}

register_nav_menus( array(
    'home' => 'Главное меню'
) );

add_action('template_redirect', 'template_redirect_attachment');
function template_redirect_attachment() {
    global $post;
    if (is_attachment()) {
        wp_redirect(get_permalink($post->post_parent));
    }
}


function get_the_posts_pagination_uni( $args = array() ) {
    $navigation = '';

    // Don't print empty markup if there's only one page.
    if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
        // Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
        if ( ! empty( $args['screen_reader_text'] ) && empty( $args['aria_label'] ) ) {
            $args['aria_label'] = $args['screen_reader_text'];
        }

        $args = wp_parse_args(
            $args,
            array(
                'mid_size'           => 1,
                'prev_text'          => _x( 'Previous', 'previous set of posts' ),
                'next_text'          => _x( 'Next', 'next set of posts' ),
                'screen_reader_text' => __( 'Posts navigation' ),
                'aria_label'         => __( 'Posts' ),
                'class'              => 'pagination',
            )
        );

        // Make sure we get a string back. Plain is the next best thing.
        if ( isset( $args['type'] ) && 'array' === $args['type'] ) {
            $args['type'] = 'plain';
        }

        // Set up paginated links.
        $links = paginate_links_uni( $args );

        if ( $links ) {
            $navigation = _navigation_markup( $links, $args['class'], $args['screen_reader_text'], $args['aria_label'] );
        }
    }

    return $navigation;
}

function paginate_links_uni( $args = '' ) {
    global $wp_query, $wp_rewrite;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $url_parts    = explode( '?', $pagenum_link );

    // Get max pages and current page out of the current query, if available.
    $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
    $current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

    $defaults = array(
        'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
        'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
        'total'              => $total,
        'current'            => $current,
        'aria_current'       => 'page',
        'show_all'           => false,
        'prev_next'          => true,
        'prev_text'          => __( '&laquo; Previous' ),
        'next_text'          => __( 'Next &raquo;' ),
        'end_size'           => 1,
        'mid_size'           => 2,
        'type'               => 'plain',
        'add_args'           => array(), // Array of query args to add.
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
    );

    $args = wp_parse_args( $args, $defaults );

    if ( ! is_array( $args['add_args'] ) ) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if ( isset( $url_parts[1] ) ) {
        // Find the format argument.
        $format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
        $format_query = isset( $format[1] ) ? $format[1] : '';
        wp_parse_str( $format_query, $format_args );

        // Find the query args of the requested URL.
        wp_parse_str( $url_parts[1], $url_query_args );

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ( $format_args as $format_arg => $format_arg_value ) {
            unset( $url_query_args[ $format_arg ] );
        }

        $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
    }

    // Who knows what else people pass in $args.
    $total = (int) $args['total'];
    if ( $total < 2 ) {
        return;
    }
    $current  = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds? Make it the default.
    if ( $end_size < 1 ) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ( $mid_size < 0 ) {
        $mid_size = 2;
    }

    $add_args   = $args['add_args'];
    $r          = '';
    $page_links = array();
    $dots       = false;

    if ( $args['prev_next'] && $current && 1 < $current ) :
        $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current - 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="navigation-archive__nav__prev" href="%s">%s</a>',
            /**
             * Filters the paginated links for the given archive pages.
             *
             * @since 3.0.0
             *
             * @param string $link The paginated link URL.
             */
            esc_url( apply_filters( 'paginate_links', $link ) ),
            $args['prev_text']
        );
    endif;

    for ( $n = 1; $n <= $total; $n++ ) :
        if ( $n == $current ) :
            $page_links[] = sprintf(
                '<a aria-current="%s" class="navigation-archive__nav__num navigation-archive__nav__num--active">%s</a>',
                esc_attr( $args['aria_current'] ),
                $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
            );

            $dots = true;
        else :
            if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                $link = str_replace( '%#%', $n, $link );
                if ( $add_args ) {
                    $link = add_query_arg( $add_args, $link );
                }
                $link .= $args['add_fragment'];

                $page_links[] = sprintf(
                    '<a class="navigation-archive__nav__num" href="%s">%s</a>',
                    /** This filter is documented in wp-includes/general-template.php */
                    esc_url( apply_filters( 'paginate_links', $link ) ),
                    $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
                );

                $dots = true;
            elseif ( $dots && ! $args['show_all'] ) :
                $page_links[] = '<span class="page-numbers dots">' . __( '&hellip;' ) . '</span>';

                $dots = false;
            endif;
        endif;
    endfor;

    if ( $args['prev_next'] && $current && $current < $total ) :
        $link = str_replace( '%_%', $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current + 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        $page_links[] = sprintf(
            '<a class="navigation-archive__nav__next" href="%s">%s</a>',
            /** This filter is documented in wp-includes/general-template.php */
            esc_url( apply_filters( 'paginate_links', $link ) ),
            $args['next_text']
        );
    endif;

    switch ( $args['type'] ) {
        case 'array':
            return $page_links;

        case 'list':
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= join( "</li>\n\t<li>", $page_links );
            $r .= "</li>\n</ul>\n";
            break;

        default:
            $r = join( "\n", $page_links );
            break;
    }

    return $r;
}