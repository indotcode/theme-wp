<?php
include "PageMeta.php";
include "ServicesBlock.php";
include "ServicesMiniatureMeta.php";
include "ServicesTariffsMeta.php";
include "ServicesPortfolioMeta.php";
include "LettersMeta.php";
add_action( 'save_post', 'my_extra_update', 0 );
function my_extra_update( $post_id ){
    if ( !empty( $_POST['extra'] )){
        foreach( $_POST['extra'] as $key => $value ){
            if(gettype($value) != 'array'){
                $value = trim($value);
            }
            if( empty($value) ){
                delete_post_meta( $post_id, $key ); // удаляем поле если значение пустое
                continue;
            }

            update_post_meta( $post_id, $key, $value ); // add_post_meta() работает автоматически
        }
    }
    return $post_id;
}

add_action('admin_head', 'admin_head_style');
function admin_head_style() {
    ?>
    <link rel="stylesheet" href="/css/meta.min.css">
    <?php
}

function IsPost($id, $name){
    $is = get_post_meta($id, 'block', false);
    if(!$is){
        return false;
    }
    if(count($is) == 0){
        return false;
    }
    if(in_array($name, get_post_meta($id, 'block', true))){
        return true;
    } else {
        return false;
    }
}