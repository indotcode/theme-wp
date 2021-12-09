<?php get_header(); ?>

<div class="bread-crumbs bread-crumbs--header">
    <div class="wrapper bread-crumbs__wrapper">
        <div class="bread-crumbs__list">
            <div class="bread-crumbs__item">
                <a href="/">Главная</a>
            </div>
            <div class="bread-crumbs__separator"></div>
            <? if(get_queried_object()->term_id == 26) : ?>
                <div class="bread-crumbs__item">
                    <span><?=get_queried_object()->name?></span>
                </div>
            <? else : ?>
                <div class="bread-crumbs__item">
                    <a href="/category/blog">Блог</a>
                </div>
                <div class="bread-crumbs__separator"></div>
                <div class="bread-crumbs__item">
                    <span><?=get_queried_object()->name?></span>
                </div>
            <? endif; ?>
        </div>
    </div>
</div>

<div class="heading">
    <div class="wrapper heading__wrapper">
        <div class="heading__title heading__title--short">
            <h1><?=get_queried_object()->name?></h1>
        </div>
        <div class="heading__menu">
            <div class="menu__archive">
                <ul class="menu__archive-ul">
                    <?php
                    $terms = get_terms([
                        'taxonomy' => 'category',
                        'hide_empty' => true,
                        'parent' => 26
                    ])
                    ?>
                    <li class="menu__archive-li <?=get_queried_object()->term_id == 26 ? 'menu__archive-li--active' : ''?>">
                        <a href="/category/blog/">Все посты</a>
                    </li>
                    <? foreach ($terms as $key => $val) : ?>
                        <li class="menu__archive-li <?=get_queried_object()->term_id == $val->term_id ? 'menu__archive-li--active' : ''?>">
                            <a href="<?=get_term_link($val->term_id)?>"><?=$val->name?></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
$result_pop_post = (new WP_Query())->query(array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key' => 'pop',
            'value' => 1
        )
    ),
    'order' => 'DESC',
    'orderby' => 'modified'
));
if(count($result_pop_post) != 0 && get_queried_object()->term_id == 26) : ?>
    <div class="blog">
        <div class="wrapper blog__wrapper">
            <div class="blog__title">
                <h2>Популярные посты</h2>
            </div>
            <div class="blog__list">
                <? foreach ($result_pop_post as $key => $val) : ?>
                    <div class="blog__item">
                        <div class="blog__item-images">
                            <ul>
                                <? foreach (get_the_category($val->ID) as $term) : ?>
                                    <? if($term->term_id != 26) : ?>
                                        <li><a href="<?=get_term_link($term->term_id)?>" class="button button--blue button--tag"><?=$term->name?></a></li>
                                    <? endif; ?>
                                <? endforeach; ?>
                            </ul>
                            <a href="<?=get_permalink($val->ID)?>" rel="nofollow"><img src="<?php echo get_the_post_thumbnail_url( $val->ID, 'full' );?>" alt=""></a>
                        </div>
                        <div class="blog__item-info">
                            <div class="blog__item-info-date"><?=get_the_time('d F Y', $val->ID)?></div>
                            <h3 class="blog__item-info-title">
                                <a href="<?=get_permalink($val->ID)?>"><?=get_the_title($val->ID)?></a>
                            </h3>
                            <div class="blog__item-info-desc">
                                <p><?=App::ShortDescription($val->post_content, 140)?></p>
                            </div>
                            <div class="blog__item-info-send">
                                <a href="<?=get_permalink($val->ID)?>" rel="nofollow">Читать далее</a>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <div class="line"></div>
        </div>
    </div>
<? endif; ?>

<div class="blog">
    <div class="wrapper blog__wrapper">
        <div class="blog__list">
            <?php
            while (have_posts() ) { the_post(); ?>
                <div class="blog__item">
                    <div class="blog__item-images">
                        <ul>
                            <? foreach (get_the_category(get_the_ID()) as $term) : ?>
                                <? if($term->term_id != 26) : ?>
                                    <li><a href="<?=get_term_link($term->term_id)?>" class="button button--blue button--tag"><?=$term->name?></a></li>
                                <? endif; ?>
                            <? endforeach; ?>
                        </ul>
                        <a href="<?=get_permalink(get_the_ID())?>" rel="nofollow"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );?>" alt=""></a>
                    </div>
                    <div class="blog__item-info">
                        <div class="blog__item-info-date"><?=get_the_time('d F Y', get_the_ID())?></div>
                        <h3 class="blog__item-info-title">
                            <a href="<?=get_permalink(get_the_ID())?>"><?=get_the_title(get_the_ID())?></a>
                        </h3>
                        <div class="blog__item-info-desc">
                            <p><?=App::ShortDescription(get_the_content(), 140)?></p>
                        </div>
                        <div class="blog__item-info-send">
                            <a href="<?=get_permalink(get_the_ID())?>" rel="nofollow">Читать далее</a>
                        </div>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>

<div class="navigation-archive">
    <div class="wrapper navigation-archive__wrapper">
        <?php
        echo get_the_posts_pagination_uni( array(
            'mid_size' => 2,
            'end_size' => 2,
            'prev_text'          => '',
            'next_text'          => '',
        ) );
        ?>
    </div>
</div>

<?php include "include/footer-block.php"?>

<?php get_footer(); ?>