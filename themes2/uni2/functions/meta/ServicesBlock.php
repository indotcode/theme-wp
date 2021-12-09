<?php
add_action('admin_head', 'admin_head_block');
function admin_head_block() {
    if(!empty(get_post()) && get_post()->post_type == 'services'){
        ?>
        <link rel="stylesheet" href="/css/font-awesome-admin.min.css">
        <script>
            var $ = jQuery;
            function addBlock(elm) {
                var select = $(elm).prev();
                if(select.val().length != 0){
                    var block = $('[data-block]');
                    var template = wp.template('Block');
                    var html = template({
                        id: block.find('.item').length,
                        name: select.val()
                    });
                    block.append(html);
                    select.find('[value="'+select.val()+'"]').remove();
                    select.val("");
                }
            }
            function deleteBlock(elm) {
                var value = $(elm).parent().find('input').val();
                var template = wp.template('Option');
                var html = template({
                    value: value
                });
                $('[data-select-block]').append(html);
                $(elm).parent().remove();
                sortBlock();
            }
            function sortBlock() {
                $('[data-block]').find('[name]').each(function (i, v) {
                    $(v).attr('name', 'extra[block]['+i+']');
                });
            }
        </script>
        <script type="text/html" id="tmpl-Block">
            <div class="item">
                <input type="hidden" name="extra[block][{{data.id}}]" readonly value="{{data.name}}">
                <span>{{data.name}}</span>
                <i class="fa fa fa-trash" aria-hidden="true" onclick="deleteBlock(this)"></i>
            </div>
        </script>
        <script type="text/html" id="tmpl-Option">
            <option value="{{data.value}}">{{data.value}}</option>
        </script>
        <?php
    }
}
add_action('add_meta_boxes', 'my_extra_block', 1);
function my_extra_block() {
    if(!empty(get_post()) && get_post()->post_type == 'services'){
        add_meta_box( 'extra_block', 'Набор блоков', 'extra_block_box_func', 'services', 'normal', 'high'  );
    }
}

function extra_block_box_func( $post ){
    $type_block = get_post_meta($post->ID, 'block', true);
    $type_system = array();
    $type = array('Тарифы', 'Портфолио', "Инфо блок");
    ?>
    <div class="block">
        <div class="option">
            <select data-select-block>
                <option selected value="">Выбрать</option>
                <?php foreach ($type as $key => $val){ ?>
                    <?php if(!in_array($val, $type_block)){ ?>
                        <option value="<?=$val?>"><?=$val?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <a href="javascript:;" onclick="addBlock(this)" class="button button-primary">Добавить блок</a>
        </div>
        <div class="block-temp" data-block>
            <?php if(empty($type_block)){ ?>
                <?php foreach ($type_system as $key => $val) { ?>
                    <div class="item">
                        <input type="hidden" name="extra[block][<?=$key?>]" readonly value="<?=$val?>">
                        <span><?=$val?></span>
                        <i class="s">Системный</i>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <?php foreach ($type_block as $key => $val) { ?>
                    <div class="item">
                        <input type="hidden" name="extra[block][<?=$key?>]" readonly value="<?=$val?>">
                        <span><?=$val?></span>
                        <?php if(in_array($val, $type_system)){ ?>
                            <i class="s">Системный</i>
                        <?php } else { ?>
                            <i class="fa fa fa-trash" aria-hidden="true" onclick="deleteBlock(this)"></i>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}