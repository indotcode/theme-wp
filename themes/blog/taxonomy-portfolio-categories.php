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
    ),
    $filter['query']
);
$query_result['posts_per_page'] = $_SESSION['portfolio_page'];
?>
<?php
Template::Filter($query_result);
?>
<section class="archive-portfolio">
    <div class="container">
        <div class="list" data-list>
            <?php
            $query = new WP_Query($query_result);
            while ($query->have_posts() ) { $query->the_post();
                ?>
                <a class="item" href="<?php the_permalink()?>">
                    <div class="images-portfolio"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );?>" alt=""></div>
                    <div class="text">
                        <div class="tags">
                            <?php foreach (App::TagsPortfolio(get_the_ID()) as $key => $val){ ?>
                                <span class="tag"><?=$val->name?></span>
                            <?php } ?>
                        </div>
                        <h2><?php the_title()?></h2>
                        <p><?=get_post_meta(get_the_ID(), 'card-signature', 1)?></p>
                        <span class="button">Посмотреть проект</span>
                    </div>
                </a>
                <?php
            }
            wp_reset_postdata();
            ?>
        </div>
        <a href="javascript:;" style="opacity: <?=$_SESSION['portfolio_page'] < App::CountPortfolio($query_result) ? 1 : 0?>" data-abide="<?=$_SESSION['portfolio_page']?>" data-offset="10" data-max="<?=App::CountPortfolio($query_result)?>" onclick='PostsPerPage(this, <?=json_encode($query_result, JSON_UNESCAPED_UNICODE);?>)'>
            <span>Посмотреть еще</span>
        </a>
    </div>
</section>

<?php get_footer(); ?>