<?php get_header(); ?>
<?php
$filter = App::FilterTag();

$term = get_queried_object();
$query_result = array();
$query_result['post_type'] = 'portfolio';
$query_result['tax_query'] = array(
    'relation' => 'AND',
    array(
        'taxonomy' => 'portfolio-categories',
        'field' => 'term_id',
        'terms' => $term->term_id
    )
);
if(count($filter['query']) != 0){
    $query_result['tax_query']['1'] =  $filter['query'];
}
$query_result['posts_per_page'] = $_SESSION['portfolio_page'];
?>

    <div class="bread-crumbs bread-crumbs--header">
        <div class="wrapper bread-crumbs__wrapper">
            <div class="bread-crumbs__list">
                <div class="bread-crumbs__item">
                    <a href="/">Главная</a>
                </div>
                <div class="bread-crumbs__separator"></div>
                <div class="bread-crumbs__item">
                    <a href="/portfolio">Портфолио</a>
                </div>
                <div class="bread-crumbs__separator"></div>
                <div class="bread-crumbs__item">
                    <span><?=$term->name?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="heading">
        <div class="wrapper heading__wrapper">
            <div class="heading__title heading__title--short">
                <h1><?=$term->name?> <?=$filter['title']?></h1>
            </div>
            <div class="heading__menu">
                <div class="menu__archive">
                    <?php
                    Template::Filter($query_result, 'menu_archive');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="portfolio">
        <div class="portfolio__list">
            <?php
            $query = new WP_Query($query_result);
            while ($query->have_posts() ) { $query->the_post(); ?>
                <a href="<?php the_permalink()?>" class="portfolio__list-item">
                    <?php
                    $color = get_post_meta(get_the_ID(), 'color', true);
                    ?>
                    <div class="portfolio__list-item__images">
                        <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );?>" alt="">
                    </div>
                    <div class="portfolio__list-item__bd" style="background-color: <?=$color != '' ? $color : '#2A54EA'?>"></div>
                    <div class="portfolio__list-item__info">
                        <h4><?php the_title()?></h4>
                        <h5><?=get_post_meta(get_the_ID(), 'card-signature', true)?></h5>
                        <span class="portfolio__list-item__info-btn button button--white">Подробнее</span>
                    </div>
                </a>
                <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>

    <div class="navigation-archive">
        <div class="wrapper navigation-archive__wrapper">
            <div class="navigation-archive__more">
                <a href="javascript:;"
                   class="button button--blue"
                   style="opacity: <?=$_SESSION['portfolio_page'] < App::CountPortfolio($query_result) ? 1 : 0?>"
                   data-abide="<?=$_SESSION['portfolio_page']?>" data-offset="<?=$_SESSION['portfolio_page']?>" data-max="<?=App::CountPortfolio($query_result)?>"
                   data-json='<?=json_encode($query_result, JSON_UNESCAPED_UNICODE);?>'>
                    Еще проекты
                </a>
            </div>
            <div class="navigation-archive__menu">
                <div class="menu__category">
                    <?php
                    Template::Filter($query_result, 'all');
                    Template::Filter($query_result, 'menu_archive_pod');
                    Template::Filter($query_result, 'branches');
                    Template::Filter($query_result, 'development');
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php include "include/footer-block.php"?>

<?php get_footer(); ?>