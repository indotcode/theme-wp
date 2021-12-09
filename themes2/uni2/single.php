<?php get_header();
$terms = array_values(array_filter(get_the_category(get_the_ID()), function($e){
    return $e->term_id !== 26;
}));
?>

<div class="bread-crumbs bread-crumbs--header">
    <div class="wrapper bread-crumbs__wrapper">
        <div class="bread-crumbs__list">
            <div class="bread-crumbs__item">
                <a href="/">Главная</a>
            </div>
            <div class="bread-crumbs__separator"></div>
            <div class="bread-crumbs__item">
                <a href="/category/blog">Блог</a>
            </div>
            <div class="bread-crumbs__separator"></div>
            <div class="bread-crumbs__item">
                <a href="<?=get_term_link($terms[0]->term_id)?>"><?=$terms[0]->name?></a>
            </div>
            <div class="bread-crumbs__separator"></div>
            <div class="bread-crumbs__item">
                <span><?php the_title()?></span>
            </div>
        </div>
    </div>
</div>

<div class="heading heading--mb-30">
    <div class="wrapper heading__wrapper">
        <div class="heading__title">
            <h1><?php the_title()?></h1>
        </div>
    </div>
</div>

<div class="blog blog--mb-50">
    <div class="wrapper blog__wrapper">
        <div class="blog__single">
            <div class="blog__single-info">
                <div class="blog__single-info__date"><?=get_the_time('d F Y', get_the_ID())?></div>
                <div class="blog__single-info__tag">
                    <ul>
                        <? foreach ($terms as $term) : ?>
                            <li><a href="<?=get_term_link($term->term_id)?>" class="button button--blue button--tag"><?=$term->name?></a></li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <div class="blog__single-info__images">
                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );?>" alt="">
                </div>
            </div>
            <div class="blog__single-content">
                <?php the_content();?>
            </div>
        </div>
    </div>
</div>

<?php include "include/footer-block.php"?>

<?php get_footer(); ?>