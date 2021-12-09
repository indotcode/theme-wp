<div class="search-box">
    <form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
        <input type="text" name="s" value="" placeholder="Поищи здесь...">
        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
    </form>
</div>

<div class="categories-box">
    <h3>Категории</h3>
    <?php $category = get_terms(array('taxonomy' => 'category', 'hide_empty' => true, 'parent' => 26)); ?>
    <ul>
        <?php foreach ($category as $key => $val){ ?>
            <li>
                <a href="<?=get_term_link($val->term_id)?>" class="<?=get_queried_object()->term_id == $val->term_id ? 'active' : ''?>">
                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                    <span><?=$val->name?> (<?=$val->count?>)</span>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>

<div class="tags-box">
    <h3>Теги</h3>
    <?php $tags = get_terms(array('taxonomy' => 'post_tag', 'number' => 10, 'hide_empty' => true)); ?>
    <ul>
        <?php foreach ($tags as $key => $val){ ?>
            <li>
                <a href="<?=get_term_link($val->term_id)?>" class="<?=get_queried_object()->term_id == $val->term_id ? 'active' : ''?>">
                    <?=$val->name?>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>

<div class="pop-box">
    <h3>Популярные посты</h3>
    <?php
    $pop_post = new WP_Query;
    $pop = $pop_post->query( array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'post__not_in' => array(get_queried_object()->ID),
        'order' => 'DESC',
        'orderby' => 'meta_value_num',
        'meta_key' => 'views'
    ) );
    ?>
    <div class="list">
        <?php foreach ($pop as $key => $val){ ?>
            <div class="item">
                <div class="images">
                    <a rel="nofollow" href="<?php the_permalink($val->ID)?>"><img src="<?=get_the_post_thumbnail_url( $val->ID, 'thumbnail' );?>" alt=""></a>
                </div>
                <div class="meta">
                    <div class="title">
                        <a href="<?php the_permalink($val->ID)?>"><?=App::ShortDescription($val->post_title, 50)?></a>
                    </div>
                    <div class="date"><?=get_the_date('j F Y', $val->ID)?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>