<?php

add_action('add_meta_boxes', function () {
    if(get_current_screen()->post_type == 'letters' && get_current_screen()->base == 'post'){
        add_meta_box('extra_letters', 'Опции', 'extra_letters_box_func', 'letters', 'normal', 'high');
    }
}, 1);

add_action('admin_head', 'admin_head_js_letters');
function admin_head_js_letters() {
    if(get_current_screen()->post_type == 'letters' && get_current_screen()->base == 'post'){
        ?>
        <script>
            $(document).ready(function () {
                $('#postdivrich').remove()
            });
            function FildsSw(elm) {
                var prop = $(elm).find('input').prop('checked');
                if(prop){
                    $(elm).addClass('active');
                } else {
                    $(elm).removeClass('active');
                }
            }
            function sendMail(elm, id) {
                var p = $(elm).parent();
                var interval = 3000;
                var data = new FormData();
                data.append('type', 'sendMail');
                data.append('id', id);
                $.ajax({
                    url: "/ajax/form.php",
                    type: "POST",
                    tmp_dir: 'tmp',
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "html",
                    data: data,
                    beforeSend : function () {
                        p.html('<i></i>');
                        p.find('i').animate({
                            width: '100%'
                        }, interval)
                    },
                    success: function(data){
                        setTimeout(function() {
                            p.html('<span>Писмо успешно отправленно! <a href="/wp-admin/post.php?post='+id+'&action=edit">Обновить страницу</a></span>');
                        }, interval);
                    }
                });
            }
        </script>
        <?php
    }
}

function extra_letters_box_func($post){
    $portfolio_list = get_post_meta($post->ID, 'portfolio', true);
    $short_description = get_post_meta($post->ID, 'short_description', true);
    ?>
    <div class="option">
        <a href="javascript:;" onclick="sendMail(this, <?=$post->ID?>);" class="button button-primary">Отправить письмо</a>
    </div>
    <table class="form-table">
        <tr>
            <th><label for="theme">Тема письма</label></th>
            <td><input id="theme" type="text" required name="extra[theme]" value="<?=get_post_meta($post->ID, 'theme', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="email_ot">E-mail (От)</label></th>
            <td><input id="email_ot" type="email" required name="extra[email_ot]" value="<?=get_post_meta($post->ID, 'email_ot', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="email">E-mail (Кому)</label></th>
            <td><input id="email" type="email" required name="extra[email]" value="<?=get_post_meta($post->ID, 'email', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="greeting">Приветствие</label></th>
            <td><input id="greeting" type="text" required name="extra[greeting]" value="<?=get_post_meta($post->ID, 'greeting', 1)?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="short_description">Краткое описание</label></th>
            <td><textarea style="height: 200px;" id="short_description" name="extra[short_description]" class="large-text code"><?=$short_description?></textarea></td>
        </tr>
        <tr>
            <th><label for="short_description">Выбор примеров работ</label></th>
            <td class="filds-list">
                <div class="block-filds">
                    <?php
                    $my_portfolio = new WP_Query;
                    $portfolio = $my_portfolio->query( array(
                        'posts_per_page' => -1,
                        'post_type' => 'portfolio'
                    ) );
                    foreach ($portfolio as $key => $val){ ?>
                        <div class="filds<?=in_array($val->ID, $portfolio_list) ? ' active' : ''?>" onchange="FildsSw(this);">
                            <input <?=in_array($val->ID, $portfolio_list) ? 'checked' : ''?> id="portfolio<?=$val->ID?>" type="checkbox" name="extra[portfolio][]" value="<?=$val->ID?>">
                            <label for="portfolio<?=$val->ID?>">
                                <img src="<?=get_the_post_thumbnail_url($val->ID, array(300, 300))?>" alt="">
                                <div class="text">
                                    <h2><?=$val->post_title?></h2>
                                    <div class="disc">
                                        <span class="pod"><?=get_post_meta($val->ID, 'pod', true)?></span>
                                        <p><?=App::ShortDescription($val->post_content, 200)?></p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    <?php } ?>
                </div>
                <br>
                <textarea style="height: 200px;" placeholder="Текст после" name="extra[footer_description]" class="large-text code"><?=get_post_meta($post->ID, 'footer_description', true)?></textarea>
            </td>
        </tr>
    </table>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}