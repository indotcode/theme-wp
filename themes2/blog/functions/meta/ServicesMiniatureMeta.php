<?php
function fileJsonFontawesome()
{
    $part = $_SERVER['DOCUMENT_ROOT'].'/json/fontawesome-4.7.json';
    $string = file_get_contents($part);
    $jsonDecode = json_decode($string, true);
    return $jsonDecode;
}

add_action('admin_head', 'admin_head_style_services');
function admin_head_style_services() {
    if(get_current_screen()->post_type == 'services' && get_current_screen()->base == 'post' ){
        ?>
        <link rel="stylesheet" href="/css/font-awesome-admin.min.css">
        <style>
            .services-icon{
                display: flex;
                flex-wrap: wrap;
            }
            .services-icon div {
                width: 20px;
                margin: 10px;
            }
            .services-icon div input{
                display: none;
            }
            .services-icon div label{
                font-size: 20px;
            }
            .services-icon div label:hover{
                vertical-align: middle;
                color: #008bd0;
            }
            .services-icon div label.active{
                color: #008bd0;
            }
        </style>
        <script>
            function activeIcon(elm) {
                $('.services-icon label').removeClass('active');
                $(elm).addClass('active');
                console.log(elm);
            }
        </script>
        <?php
    }
}
add_action('add_meta_boxes', 'my_extra_services', 1);
function my_extra_services() {
    add_meta_box( 'extra_services', 'Миниатюра услуги', 'extra_services_box_func', 'services', 'normal', 'high'  );
}
function extra_services_box_func( $post ){
    $result_icon = fileJsonFontawesome();
    $id_icon = get_post_meta($post->ID, 'icon', true);
    $services_description = get_post_meta($post->ID, 'services-description', true);
    ?>
    <div>
        <textarea name="extra[services-description]" id="" style="width: 100%; height: 100px" placeholder="Краткое описание"><?=$services_description?></textarea>
    </div>
    <div class="services-icon">
    <?php foreach ($result_icon as $key => $val){
        ?>
        <div>
            <input id="icon<?=$key?>" <?=$val['class'] == $id_icon ? 'checked' : ''?> type="radio" name="extra[icon]" value="<?=$val['class']?>">
            <label onclick="activeIcon(this)" for="icon<?=$key?>" class="<?=$val['class'] == $id_icon ? 'active' : ''?> "><i class="<?=$val['class']?>" aria-hidden="<?=$val['aria-hidden']?>"></i></label>
        </div>
    <?php } ?>
    </div>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}