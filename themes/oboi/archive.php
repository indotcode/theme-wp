<?php get_header(); ?>
<h3 class="m_2"><?=single_cat_title( '', false );?></h3>

<div class="container">
    <div class="bg">
        <a href="/">Главная</a>
        <i class="fa fa-chevron-right" aria-hidden="true"></i>
        <span><?=get_queried_object()->name?></span>
    </div>
    <div class="row list-news" data-list>
        <?php
        $result = array(
            'posts_per_page' => 10,
            'cat' => get_queried_object()->term_id
        );
        $query = new WP_Query($result);
        ?>
        <?php while($query->have_posts()) { $query->the_post(); ?>
            <div class="col-md-12 item-news" data-item>
                <div class="row">
                    <div class="col-md-4 img-news">
                        <img src="<?php the_post_thumbnail_url() ?>" alt="">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 date-news"><?=Conversion::Date(get_the_date())['day']?> <?=Conversion::Date(get_the_date())['month']?> <?=Conversion::Date(get_the_date())['year']?></div>
                            <div class="col-md-12 title-news"><a href="<?php the_permalink()?>"><h2><?php the_title()?></h2></a></div>
                            <div class="col-md-12 disc-news">
                                <?php the_excerpt()?>
                            </div>
                            <div class="col-md-12 link-news"><a href="<?php the_permalink()?>">Подробнее</a></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if(!$query->have_posts()){ ?>
            <div class="col-md-12 none-post">Записей нет!</div>
        <?php } ?>
    </div>
    <?php if(get_queried_object()->count > $result['posts_per_page']){ ?>
        <script>
            var json = '<?=json_encode($result, JSON_UNESCAPED_UNICODE)?>';
        </script>
        <button data-count="<?=get_queried_object()->count?>" type="button" class="btn btn-primary btn-cat" onclick="load_post(this, json)">
            <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
            <span>Ешё <?=get_queried_object()->name?></span>
        </button>
    <?php } ?>
</div>

<?php get_footer();