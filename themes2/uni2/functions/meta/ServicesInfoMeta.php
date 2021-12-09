<?php
add_action('admin_head', 'admin_head_style_info');
function admin_head_style_info() {
    if(!empty(get_post()) && IsPost(get_post()->ID, 'Инфо блок') == true){
        ?>
        <script>
            $(document).ready(function () {
                $('.extra-info__etp__item-title-a').on('click', function (e) {
                    e.preventDefault();
                    var template = wp.template('infoBlockAdd');
                    var html = template({
                        count: $(this).parent().next().find('.extra-info__ini').length,
                        id: $(this).attr('data-id'),
                        site: $(this).parents('[data-site]').attr('data-site')
                    });
                    $(this).parent().next().append(html);
                })
            });

            function bottomInfo(elm) {
                var item = $(elm).parents('.extra-info__ini');
                console.log(item);
                var next_item = item.next();
                next_item.after(item);
                sortInfo(elm);
            }
            function topInfo(elm) {
                var item = $(elm).parents('.extra-info__ini');
                var prev_item = item.prev();
                prev_item.before(item);
                sortInfo(elm);
            }
            function deleteInfo(elm) {
                $(elm).parents('.extra-info__ini').remove();
                sortInfo();
            }
            function sortInfo(elm) {
                var data_tag = $(elm).parents('.extra-info__ins');
                var tag_item = data_tag.find('.extra-info__ini');
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
        </script>
        <script type="text/html" id="tmpl-infoBlockAdd">
            <div class="extra-info__ini">
                <div class="extra-info__ini-nav">
                    <i class="fa fa-caret-down" aria-hidden="true" onclick="bottomInfo(this)"></i>
                    <i class="fa fa-caret-up" aria-hidden="true" onclick="topInfo(this)"></i>
                    <i class="fa fa fa-trash" aria-hidden="true" onclick="deleteInfo(this)"></i>
                </div>
                <input class="mb-15" type="text" name="extra[infoBlock][{{data.site}}][{{data.id}}][{{data.count}}][name]" value="" placeholder="Название">
                <textarea name="extra[infoBlock][{{data.site}}][{{data.id}}][{{data.count}}][description]" placeholder="Краткое описание"></textarea>
                <# if(data.id == 'youGet'){ #>
                    <div class="extra-info__ini-icon mt-15">
                        <?php foreach (App::IconInfoBlock() as $key => $val){ ?>
                            <div class="extra-info__ini-icon__item">
                                <input <?=$key == 1 ? 'checked' : ''?> id="{{data.site}}{{data.id}}{{data.count}}_<?=$key?>" type="radio" name="extra[infoBlock][{{data.site}}][{{data.id}}][{{data.count}}][icon]" value="<?=$key?>">
                                <label for="{{data.site}}{{data.id}}{{data.count}}_<?=$key?>"><img src="<?=$val?>" alt=""></label>
                            </div>
                        <?php } ?>
                    </div>
                <# } #>
            </div>
        </script>
        <?php
    }
}
add_action('add_meta_boxes', 'my_extra_info', 1);
function my_extra_info() {
    if(!empty(get_post()) && IsPost(get_post()->ID, 'Инфо блок') == true){
        add_meta_box( 'extra_info', 'Инфо блок', 'extra_info_box_func', 'services', 'normal', 'high'  );
    }
}
function extra_info_box_func( $post ){
    $result = get_post_meta($post->ID, 'infoBlock', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="infoBlockTitle">Заголовок инфа блока</label></th>
            <td><input id="infoBlockTitle" type="text" name="extra[infoBlockTitle]" value="<?=get_post_meta($post->ID, 'infoBlockTitle', 1)?>" class="regular-text"></td>
        </tr>
    </table>
    <hr>
    <div class="extra-info">
        <div class="extra-info__item">
            <div class="extra-info__title">Быстрый сайт</div>
            <div class="extra-info__etp">
                <div class="extra-info__etp__list" data-site="fastSite">
                    <div class="extra-info__etp__item">
                        <div class="extra-info__etp__item-title">
                            <span>Этапы работы</span>
                            <a href="" data-id="stagesWork" class="extra-info__etp__item-title-a"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                        <div class="extra-info__ins">
                            <?php infoItemTemp($result, 'fastSite', 'stagesWork');?>
                        </div>
                    </div>
                    <div class="extra-info__etp__item">
                        <div class="extra-info__etp__item-title">
                            <span>Вы получите</span>
                            <a href="" data-id="youGet" class="extra-info__etp__item-title-a"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                        <div class="extra-info__ins">
                            <?php infoItemTemp($result, 'fastSite', 'youGet');?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="extra-info__item">
            <div class="extra-info__title">Эксклюзивный сайт</div>
            <div class="extra-info__etp">
                <div class="extra-info__etp__list" data-site="exclusiveSite">
                    <div class="extra-info__etp__item">
                        <div class="extra-info__etp__item-title">
                            <span>Этапы работы</span>
                            <a href="" data-id="stagesWork" class="extra-info__etp__item-title-a"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                        <div class="extra-info__ins">
                            <?php infoItemTemp($result, 'exclusiveSite', 'stagesWork');?>
                        </div>
                    </div>
                    <div class="extra-info__etp__item">
                        <div class="extra-info__etp__item-title">
                            <span>Вы получите</span>
                            <a href="" data-id="youGet" class="extra-info__etp__item-title-a"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                        <div class="extra-info__ins">
                            <?php infoItemTemp($result, 'exclusiveSite', 'youGet');?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}

function infoItemTemp($result, $site, $id)
{

    if(!empty($result[$site]) && !empty($result[$site][$id]) && count($result[$site][$id]) != 0) {
        foreach ($result[$site][$id] as $key => $val) { ?>
            <div class="extra-info__ini">
                <div class="extra-info__ini-nav">
                    <i class="fa fa-caret-down" aria-hidden="true" onclick="bottomInfo(this)"></i>
                    <i class="fa fa-caret-up" aria-hidden="true" onclick="topInfo(this)"></i>
                    <i class="fa fa fa-trash" aria-hidden="true" onclick="deleteInfo(this)"></i>
                </div>
                <input class="mb-15" type="text" name="extra[infoBlock][<?=$site?>][<?=$id?>][<?=$key?>][name]" value="<?=$val['name']?>" placeholder="Название">
                <textarea name="extra[infoBlock][<?=$site?>][<?=$id?>][<?=$key?>][description]" placeholder="Краткое описание"><?=$val['description']?></textarea>
                <?php if($id == 'youGet'){ ?>
                    <div class="extra-info__ini-icon mt-15">
                        <?php foreach (App::IconInfoBlock() as $key2 => $val2) { ?>
                            <div class="extra-info__ini-icon__item">
                                <input <?=$val['icon'] == $key2 ? 'checked' : ''?>
                                    id="<?=$site?><?=$id?><?=$key?>_<?=$key2?>" type="radio"
                                    name="extra[infoBlock][<?=$site?>][<?=$id?>][<?=$key?>][icon]"
                                    value="<?=$key2?>">
                                <label for="<?=$site?><?=$id?><?=$key?>_<?=$key2?>">
                                    <img src="<?=$val2?>" alt="">
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php }
    }
}