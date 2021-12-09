<?php
add_action('add_meta_boxes', 'my_extra_fields', 1);

function my_extra_fields() {
    add_meta_box( 'extra_fields', 'Данные о товаре', 'extra_fields_box_func', 'goods', 'normal', 'high'  );
    if(get_post()->ID == 173){
        add_meta_box( 'extra_fields2', 'Данные контактов', 'page_meta_contact', 'page', 'normal', 'high'  );
        add_meta_box( 'extra_fields3', 'Данные соц.ситей', 'page_meta_contact2', 'page', 'normal', 'high'  );
    }
}

function extra_fields_box_func($post){
    ?>
    <div class="box-info">
        <p>
            <strong>Ид в 1с:</strong> <?=get_post_meta($post->ID, 'Ид', 1);?>
        </p>
        <p>
            <strong>Остаток:</strong> <?=get_post_meta($post->ID, 'Остаток', 1);?>
        </p>
        <p>
            <strong>Коллекция:</strong> <?=get_post_meta($post->ID, 'Коллекция', 1);?>
        </p>
        <p>
            <strong>Стиль:</strong> <?=get_post_meta($post->ID, 'Стиль', 1);?>
        </p>
        <p>
            <strong>Цвет:</strong> <?=get_post_meta($post->ID, 'Цвет', 1);?>
        </p>
        <p>
            <strong>Размер:</strong> <?=get_post_meta($post->ID, 'Размер', 1);?>
        </p>
        <p>
            <strong>Бренд:</strong> <?=get_post_meta($post->ID, 'Бренд', 1);?>
        </p>
        <p>
            <strong>Цена:</strong> <?=get_post_meta($post->ID, 'Цена', 1);?>
        </p>
    </div>
    <div class="box-list">
        <div class="box-item">
            <input type="hidden" name="extra[popular]" value="0">
            <input type="checkbox" id="home" name="extra[popular]"  value="1" <?php checked( get_post_meta($post->ID, 'popular', 1), 1 );?> style="margin-top: 3px;" />
            <label for="home"><strong>Вывод на главной (Популярное)</strong></label>
        </div>
    </div>

    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

function _page_meta_contact_style(){
    ?>
    <style>
        .box-list{

        }
        .box-item{
            display: flex;
            flex-wrap: wrap;
        }
        .box-item label{
            vertical-align: middle;
            width: 100%;
            margin-bottom: 5px;
            margin-top: 10px;
        }
        .box-item p{
            width: 100%;
            margin-top: 0;
            font-size: 12px;
            color: #9c9c9c;
        }
        .box-item input{
            width: 100%;
            margin-bottom: 15px;
        }
        .box-item textarea{
            width: 100%;
            height: 120px;
            margin-bottom: 15px;
        }
        #postdivrich{
            display: none;
        }
    </style>
    <?php
}

function page_meta_contact($post){
    _page_meta_contact_style();
    ?>
    <div class="box-list">
        <div class="box-item">
            <label for="city">Город</label>
            <input id="city" type="text" name="extra[city]" value="<?=get_post_meta($post->ID, 'city', 1)?>">
        </div>
        <div class="box-item">
            <label for="phone">Телефоны</label>
            <input type="text" name="extra[phone_1]" value="<?=get_post_meta($post->ID, 'phone_1', 1)?>" placeholder="">
            <input type="text" name="extra[phone_2]" value="<?=get_post_meta($post->ID, 'phone_2', 1)?>" placeholder="">
            <input type="text" name="extra[phone_3]" value="<?=get_post_meta($post->ID, 'phone_3', 1)?>" placeholder="">
        </div>
        <div class="box-item">
            <label for="phone">Адреса</label>
            <input type="text" name="extra[address_1]" value="<?=get_post_meta($post->ID, 'address_1', 1)?>" placeholder="">
            <input type="text" name="extra[address_2]" value="<?=get_post_meta($post->ID, 'address_2', 1)?>" placeholder="">
            <input type="text" name="extra[address_3]" value="<?=get_post_meta($post->ID, 'address_3', 1)?>" placeholder="">
        </div>
        <div class="box-item">
            <label for="phone">Email</label>
            <input type="email" name="extra[email_1]" value="<?=get_post_meta($post->ID, 'email_1', 1)?>" placeholder="">
            <input type="email" name="extra[email_2]" value="<?=get_post_meta($post->ID, 'email_2', 1)?>" placeholder="">
        </div>
        <div class="box-item">
            <label for="rr">Режим работы</label>
            <textarea name="extra[rr]" id="rr" rows="10"><?=get_post_meta($post->ID, 'rr', 1)?></textarea>
        </div>
        <div class="box-item">
            <label for="map">Карта</label>
            <textarea name="extra[map]" id="map" rows="10"><?=get_post_meta($post->ID, 'map', 1)?></textarea>
        </div>
    </div>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

function page_meta_contact2($post){
    _page_meta_contact_style()
    ?>
    <div class="box-list">
        <div class="box-item">
            <label for="vk">ВКонтакте</label>
            <input type="text" id="vk" name="extra[vk]" value="<?=get_post_meta($post->ID, 'vk', 1)?>">
        </div>
        <div class="box-item">
            <label for="ok">Одноклассники</label>
            <input type="text" id="ok" name="extra[ok]" value="<?=get_post_meta($post->ID, 'ok', 1)?>">
        </div>
        <div class="box-item">
            <label for="whatsapp">WhatsApp</label>
            <input type="text" id="whatsapp" name="extra[whatsapp]" value="<?=get_post_meta($post->ID, 'whatsapp', 1)?>">
        </div>
        <div class="box-item">
            <label for="instagram">Instagram</label>
            <input type="text" id="instagram" name="extra[instagram]" value="<?=get_post_meta($post->ID, 'instagram', 1)?>">
        </div>
    </div>

    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

add_action( 'save_post', 'my_extra_fields_update', 0 );

function my_extra_fields_update( $post_id ){
    // базовая проверка
//    echo '<pre>';
//    print_r($_POST['extra']);
//    echo '</pre>';
    if (
         empty( $_POST['extra'] )
         || ! wp_verify_nonce( $_POST['extra_fields_nonce'], __FILE__ )
         || wp_is_post_autosave( $post_id )
         || wp_is_post_revision( $post_id )
     )
         return false;

     // Все ОК! Теперь, нужно сохранить/удалить данные
     foreach( $_POST['extra'] as $key => $value ){
         if( empty($value) ){
             delete_post_meta( $post_id, $key );
             continue;
         }
         update_post_meta( $post_id, $key, $value );
     }

     return $post_id;
}