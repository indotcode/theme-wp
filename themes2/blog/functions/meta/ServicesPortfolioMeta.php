<?php
add_action('admin_head', 'admin_head_style_portfolio');
function admin_head_style_portfolio() {
    if(IsPost(get_post()->ID, 'Портфолио') == true){
        ?>
        <script>
            function checkedChange(elm) {
                var input_checked = $(elm).find('input:checked');
                if(input_checked.length == 8){
                    $(elm).find('label').attr('data-er', 1);
                }
                if(input_checked.length == 7){
                    $(elm).find('label').attr('data-er', 0);
                }
            }
            function checkboxPortfolio(elm){
                var item = $(elm).parent('.item');
                if($(elm).attr('data-er') == 1){
                    if($('[data-portfolio] .active').length == 8){
                        item.removeClass('active');
                        $(elm).next().prop('checked', true);
                    } else {

                    }
                } else {
                    if(item.hasClass('active')){
                        item.removeClass('active');
                    } else {
                        item.addClass('active');
                    }
                }

            }
        </script>
        <?php
    }
}
add_action('add_meta_boxes', 'my_extra_portfolio', 1);
function my_extra_portfolio() {
    if(IsPost(get_post()->ID, 'Портфолио') == true){
        add_meta_box( 'extra_portfolio', 'Портфолио', 'extra_portfolio_box_func', 'services', 'normal', 'high'  );
    }
}
function extra_portfolio_box_func( $post ){
    $result = get_post_meta($post->ID, 'portfolio', true);
    if(empty($result)){
        $result = array();
    }
    $my_posts = new WP_Query;
    $portfolio = $my_posts->query( array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1,
    ) );
    ?>
    <i>Максимальное количество 8 штук</i>
    <div class="portfolio-list" data-portfolio onchange="checkedChange(this)">
        <?php foreach ($portfolio as $key => $val){ ?>
            <div class="item<?=in_array($val->ID, $result) ? ' active' : ''?>">
                <label for="portfolio<?=$key?>" data-er="<?=count($result) == 8 ? 1 : 0?>" onclick="checkboxPortfolio(this)"></label>
                <input id="portfolio<?=$key?>" <?=in_array($val->ID, $result) ? 'checked' : ''?> type="checkbox" name="extra[portfolio][]" value="<?=$val->ID?>">
                <div class="title"><span><?=$val->post_title?></span></div>
                <div class="images">
                    <img src="<?=get_the_post_thumbnail_url( $val->ID, 'full' )?>" alt="">
                </div>
            </div>
        <?php } ?>
    </div>
    <input type="hidden" name="extra_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />
    <?php
}