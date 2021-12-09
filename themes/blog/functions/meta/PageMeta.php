<?php
add_action('admin_head', 'admin_head_style_page');
function admin_head_style_page() {
    if(get_current_screen()->post_type == 'page' && get_current_screen()->base == 'post' && get_post()->ID == 487){
        ?>
        <script>
            $(document).ready(function () {
                $('#postdivrich, #pageparentdiv').remove();
            })
        </script>
        <?php
    }
}

add_action('add_meta_boxes', function () {
    //Страница контактов
    if(get_current_screen()->post_type == 'page' && get_current_screen()->base == 'post' && get_post()->ID == 487){
        add_meta_box( 'extra_page_contact', 'Контакты', 'extra_page_box_func_contact', 'page', 'normal', 'high'  );
        add_meta_box( 'extra_page_requisites', 'Реквизиты', 'extra_page_box_func_requisites', 'page', 'normal', 'high'  );
    }
}, 1);

function extra_page_box_func_contact($post){
    ?>
    <table class="form-table">
        <tr>
            <th><label for="phone">Телефон</label></th>
            <td><input id="phone" type="text" name="extra[phone]" value="<?=get_post_meta($post->ID, 'phone', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="email">E-mail</label></th>
            <td><input id="email" type="text" name="extra[email]" value="<?=get_post_meta($post->ID, 'email', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="address">Адрес</label></th>
            <td><textarea id="address" name="extra[address]" class="regular-text"><?=get_post_meta($post->ID, 'address', 1)?></textarea></td>
        </tr>
    </table>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

function extra_page_box_func_requisites($post){
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ip">Индивидуальный предприниматель</label></th>
            <td><input id="ip" type="text" name="extra[ip]" value="<?=get_post_meta($post->ID, 'ip', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="ogrn-ip">ОГРН ИП</label></th>
            <td><input id="ogrn-ip" type="text" name="extra[ogrn-ip]" value="<?=get_post_meta($post->ID, 'ogrn-ip', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="inn">ИНН</label></th>
            <td><input id="inn" type="text" name="extra[inn]" value="<?=get_post_meta($post->ID, 'inn', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="rs">Расчётный счёт</label></th>
            <td><input id="rs" type="text" name="extra[rs]" value="<?=get_post_meta($post->ID, 'rs', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="od">Отделение банка: к/сч</label></th>
            <td><input id="od" type="text" name="extra[od]" value="<?=get_post_meta($post->ID, 'od', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="bik">БИК</label></th>
            <td><input id="bik" type="text" name="extra[bik]" value="<?=get_post_meta($post->ID, 'bik', 1)?>" class="regular-text"></td>
        </tr>
    </table>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}
