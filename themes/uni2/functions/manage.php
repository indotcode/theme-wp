<?php
add_filter( 'manage_portfolio_posts_columns', 'filter_function_name_portfolio' );
function filter_function_name_portfolio( $columns ){
    $columns = array_merge(
        array_slice( $columns, 0, 5 ),
        array('home' => 'На главной'),
        array_slice( $columns, 5 )
    );

    $columns = array_merge(
        array_slice( $columns, 0, 1 ),
        array('images' => 'Картинка'),
        array_slice( $columns, 1 )
    );

    return $columns;
}
add_action('manage_portfolio_posts_custom_column', 'fill_views_column', 5, 2 );
function fill_views_column( $colname, $post_id ){
    if($colname === 'home'){
        if(get_post_meta( $post_id, 'home', 1 ) == 1){
            echo '<span class="dashicons dashicons-admin-post"></span>';
        }
    }
    if($colname === 'images'){
        $url = get_the_post_thumbnail_url( $post_id, 'full' );
        if($url != ''){
            ?>
            <img src="<?=$url?>" width="80" alt="">
            <?
        }
    }
}


add_filter( 'manage_post_posts_columns', 'filter_function_name_blog' );
function filter_function_name_blog( $columns ){
    $columns = array_merge(
        array_slice( $columns, 0, 5 ),
        array('home' => 'На главной'),
        array_slice( $columns, 5 )
    );

    $columns = array_merge(
        array_slice( $columns, 0, 1 ),
        array('images' => 'Картинка'),
        array_slice( $columns, 1 )
    );

    return $columns;
}
add_action('manage_post_posts_custom_column', 'fill_views_column2', 5, 2 );
function fill_views_column2( $colname, $post_id ){
    if($colname === 'pop'){
        if(get_post_meta( $post_id, 'pop', 1 ) == 1){
            echo '<span class="dashicons dashicons-admin-post"></span>';
        }
    }
    if($colname === 'images'){
        $url = get_the_post_thumbnail_url( $post_id, 'full' );
        if($url != ''){
            ?>
            <img src="<?=$url?>" width="80" alt="">
            <?
        }
    }
}