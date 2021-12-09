<?php
add_action('admin_head', 'admin_head_style_tariffs');
function admin_head_style_tariffs() {
    if(!empty(get_post()) && IsPost(get_post()->ID, 'Тарифы') == true){
        ?>
        <script>
            function addRate(elm) {
                var rate = $('[data-rate]');
                var template = wp.template('Rate');
                var html = template({
                    id: rate.find('.item').length
                });
                rate.append(html);
            }
            function addTag(elm) {
                var tag = $(elm).prev();
                var template = wp.template('Tag');
                var html = template({
                    id: $(elm).attr('data-id'),
                    count: tag.find('.tag-item').length
                });
                tag.append(html);
            }

            function leftRate(elm) {
                var item = $(elm).parents('.item');
                var prev_item = item.prev();
                prev_item.before(item);
                sortRate();
            }
            function rightRate(elm) {
                var item = $(elm).parents('.item');
                var next_item = item.next();
                next_item.after(item);
                sortRate();
            }
            function deleteRate(elm) {
                $(elm).parents('.item').remove();
                sortRate();
            }
            function sortRate() {
                $('[data-rate] .item').each(function (i, v) {
                    $(v).find('[name]').each(function (i2, v2) {
                        var s = $(v2).attr('name').split('][');
                        s[1] = i;
                        var sp = s.join('][');
                        $(v2).attr('name', sp);
                    });
                })
            }

            function bottomTag(elm) {
                var item = $(elm).parent('.tag-item');
                var next_item = item.next();
                next_item.after(item);
                sortTag(elm);
            }
            function topTag(elm) {
                var item = $(elm).parent('.tag-item');
                var prev_item = item.prev();
                prev_item.before(item);
                sortTag(elm);
            }
            function deleteTag(elm) {
                $(elm).parent('.tag-item').remove();
                sortTag();
            }
            function sortTag(elm) {
                var data_tag = $(elm).parents('[data-tag]');
                var tag_item = data_tag.find('.tag-item');
                if(tag_item.length != 0){
                    $.each(tag_item, function (i, v) {
                        $(v).find('[name]').each(function (i2, v2) {
                            var s = $(v2).attr('name').split('][');
                            s[3] = i;
                            var sp = s.join('][');
                            $(v2).attr('name', sp);
                        });
                    })
                }
            }

            function addTagType(elm) {

            }
        </script>
        <script type="text/html" id="tmpl-Rate">
            <div class="item">
                <div class="item-opt">
                    <i class="fa fa-arrow-left" aria-hidden="true" onclick="leftRate(this)"></i>
                    <i class="fa fa-arrow-right" aria-hidden="true" onclick="rightRate(this)"></i>
                    <i class="fa fa fa-trash" aria-hidden="true" onclick="deleteRate(this)"></i>
                </div>
                <input type="text" name="extra[rate][{{data.id}}][name]" value="" placeholder="Название">
                <input type="number" min="0" name="extra[rate][{{data.id}}][price]" value="" placeholder="Цена">
                <div class="date">
                    <input type="number" min="0" name="extra[rate][{{data.id}}][date]" value="" placeholder="Период">
                    <select name="extra[rate][{{data.id}}][date-name]">
                        <option selected value="">Выбрать</option>
                        <?php foreach (ConvertingNumNames::name as $key => $val){ ?>
                            <option value="<?=$key?>"><?=$val[0]?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="type_rate">
                    <select name="extra[rate][{{data.id}}][type-rate]">
                        <option selected value="">Выбрать тип тарифа</option>
                        <option value="Индивидуальный проект">Индивидуальный проект</option>
                        <option value="Шаблонный проект">Шаблонный проект</option>
                    </select>
                </div>
                <div class="tag-list" data-tag>

                </div>
                <a href="javascript:;" data-id="{{data.id}}" onclick="addTag(this)"><i class="fa fa-plus" aria-hidden="true"></i> Добавить тег</a>
                <hr>
            </div>
        </script>
        <script type="text/html" id="tmpl-Tag">
            <div class="tag-item">
                <input type="text" name="extra[rate][{{data.id}}][result][{{data.count}}][tag]" value="" placeholder="Тег">
                <i class="fa fa-caret-down" aria-hidden="true" onclick="bottomTag(this)"></i>
                <i class="fa fa-caret-up" aria-hidden="true" onclick="topTag(this)"></i>
                <i class="fa fa fa-trash" aria-hidden="true" onclick="deleteTag(this)"></i>
            </div>
        </script>
        <?php
    }
}
add_action('add_meta_boxes', 'my_extra_tariffs', 1);
function my_extra_tariffs() {
    if(!empty(get_post()) && IsPost(get_post()->ID, 'Тарифы') == true){
        add_meta_box( 'extra_tariffs', 'Тарифы', 'extra_tariffs_box_func', 'services', 'normal', 'high'  );
    }
}
function extra_tariffs_box_func( $post ){
    $result = get_post_meta($post->ID, 'rate', true);
    ?>
    <div class="option">
        <a href="javascript:;" onclick="addRate(this)" class="button button-primary">Добавить тариф</a>
    </div>
    <div class="rate-list" data-rate>
        <?php if(empty($result)){ ?>

        <?php } else { ?>
            <?php foreach ($result as $key => $val) { ?>
                <div class="item">
                    <div class="item-opt">
                        <i class="fa fa-arrow-left" aria-hidden="true" onclick="leftRate(this)"></i>
                        <i class="fa fa-arrow-right" aria-hidden="true" onclick="rightRate(this)"></i>
                        <i class="fa fa fa-trash" aria-hidden="true" onclick="deleteRate(this)"></i>
                    </div>
                    <input type="text" name="extra[rate][<?=$key?>][name]" value="<?=$val['name']?>" placeholder="Название">
                    <input type="number" min="0" name="extra[rate][<?=$key?>][price]" value="<?=$val['price']?>" placeholder="Цена">
                    <div class="date">
                        <input type="number" min="0" name="extra[rate][<?=$key?>][date]" value="<?=$val['date']?>" placeholder="Период">
                        <select name="extra[rate][<?=$key?>][date-name]">
                            <option <?=$val['date-name'] == '' ? 'selected' : ''?> value="">Выбрать</option>
                            <?php foreach (ConvertingNumNames::name as $key2 => $val2){ ?>
                                <option <?=$val['date-name'] == $key2 ? 'selected' : ''?> value="<?=$key2?>"><?=$val2[0]?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="type_rate">
                        <select name="extra[rate][<?=$key?>][type-rate]">
                            <option <?=$val['type-rate'] == '' ? 'selected' : ''?> value="">Выбрать тип тарифа</option>
                            <option <?=$val['type-rate'] == 'Индивидуальный проект' ? 'selected' : ''?> value="Индивидуальный проект">Индивидуальный проект</option>
                            <option <?=$val['type-rate'] == 'Шаблонный проект' ? 'selected' : ''?> value="Шаблонный проект">Шаблонный проект</option>
                        </select>
                    </div>
                    <div class="tag-list" data-tag>
                        <?php if(isset($val['result'])){ ?>
                            <?php foreach ($val['result'] as $key2 => $val2) { ?>
                                <div class="tag-item">
                                    <input type="text" name="extra[rate][<?=$key?>][result][<?=$key2?>][tag]" value="<?=$val2['tag']?>" placeholder="Тег">
                                    <i class="fa fa-caret-down" aria-hidden="true" onclick="bottomTag(this)"></i>
                                    <i class="fa fa-caret-up" aria-hidden="true" onclick="topTag(this)"></i>
                                    <i class="fa fa fa-trash" aria-hidden="true" onclick="deleteTag(this)"></i>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <a href="javascript:;" data-id="<?=$key?>" onclick="addTag(this)"><i class="fa fa-plus" aria-hidden="true"></i> Добавить тег</a>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}