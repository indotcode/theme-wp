<?php get_header(); ?>
<div class="banner" data-banner style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/banner0.png)">
<!--    <div class="container">-->
<!--        <div class="banner_desc">-->
<!--            <h1>Обои для вас</h1>-->
<!--            <div class="button">-->
<!--                <a href="/goods" class="hvr-shutter-out-horizontal">Подробнее</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <a href="/goods" class="banner-link" data-banner-link></a>
    <div class="nav-slide">
        <div class="next" onclick="SlideNext()"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></div>
        <div class="prev" onclick="SlidePrev()"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></div>
    </div>
    <div style="display: none" data-list>
        <span class="active" data-id="0" data-link="/goods" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/banner0.png)"></span>
		<!-- <span class="active" data-id="0" data-link="/aktsii/nazovi-kodovoe-slovo-sayt-i-poluchi-500-rub" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/banner1.jpg)"></span>-->
        <span data-id="1" data-link="/goods" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/images/banner2.jpg)"></span>
    </div>
</div>
<div class="content_top">
    <h3 class="m_1">Новинки</h3>
    <div class="container">
        <div class="box_1">
            <div class="col-md-12">
                <div class="section group">
                    <?php
                    $query1 = new WP_Query(array(
                        'post_type' => 'goods',
                        'posts_per_page' => 5,
                        'order' => 'Контент',
                        'orderby' => 'date',
                        'meta_query' => array(
                            'relation' => 'AND',
                            array(
                                'key' => 'Остаток',
                                'value' => 0,
                                'compare' => '>',
                                'type' => 'NUMERIC'
                            )
                        )
                    ));
                    ?>
                    <?php while($query1->have_posts()) { $query1->the_post(); ?>
                        <?php
                        $meta = Format::PostMeta(get_the_ID());
                        ?>
                        <div class="col_1_of_3 span_1_of_3 simpleCart_shelfItem">
                            <div class="shop-holder">
                                <div class="product-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if(count($meta['Фотографии']) != 0){ ?>
                                            <div class="img-category index">
                                                <img src="<?=Ceo::$domain?><?=$meta['Фотографии'][0]?>" class="img-responsive" alt=""/>
                                            </div>
                                        <?php } else { ?>
                                            <div class="img-category index">
                                                <img src="<?=Ceo::$domain?>/1C/foto0_04472c97-41f0-11e8-ab4d-309c236cb1c6.jpg" class="img-responsive" alt=""/>
                                            </div>
                                        <?php } ?>
                                    </a>
                                    <a href="" class="button item_add"></a>
                                </div>
                            </div>
                            <div class="shop-content" style="height: 80px;">
                                <div class="tag"><?=$meta['Бренд']?></div>
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h4>
                            </div>
                        </div>
                    <?php } ?>
                    <?php wp_reset_postdata();?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content_bottom">
    <div class="container">
        <h2 class="m_3">Новости и акции</h2>
        <div class="grid_1">
            <?php
            $query_index = new WP_Query(array(
                'posts_per_page' => 2,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'id',
                        'terms'    => 5
                    )
                )
            ));
            ?>
            <?php while($query_index->have_posts()) { $query_index->the_post(); ?>
                <div class="col-md-6 row_2">
                    <a href="<?php the_permalink()?>">
                        <div class="item-inner">
                            <img src="<?php the_post_thumbnail_url() ?>" class="img-responsive" alt=""/>
                        </div>
                    </a>
                </div>
            <?php } ?>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="content_top">
    <h3 class="m_1">Популярное</h3>
    <div class="container">
        <div class="box_1">
            <div class="col-md-12">
                <div class="section group">
                    <?php
                    $query2 = new WP_Query(array(
                        'post_type' => 'goods',
                        'posts_per_page' => 5,
                        'order' => 'DESC',
                        'orderby' => 'meta_value',
                        'meta_key' => 'Остаток'
                    ));
                    ?>
                    <?php while($query2->have_posts()) { $query2->the_post(); ?>
                        <?php
                        $meta = Format::PostMeta(get_the_ID());
                        ?>
                        <div class="col_1_of_3 span_1_of_3 simpleCart_shelfItem">
                            <div class="shop-holder">
                                <div class="product-img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if(count($meta['Фотографии']) != 0){ ?>
                                            <div class="img-category index">
                                                <img src="<?=Ceo::$domain?><?=$meta['Фотографии'][0]?>" class="img-responsive" alt=""/>
                                            </div>
                                        <?php } else { ?>
                                            <div class="img-category index">
                                                <img src="<?=Ceo::$domain?>/1C/foto0_04472c97-41f0-11e8-ab4d-309c236cb1c6.jpg" class="img-responsive" alt=""/>
                                            </div>
                                        <?php } ?>
                                    </a>
                                    <a href="" class="button item_add"></a>
                                </div>
                            </div>
                            <div class="shop-content" style="height: 80px;">
                                <div class="tag"><?=$meta['Бренд']?> <?=$meta['Цвет']?></div>
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h4>
                            </div>
                        </div>
                    <?php } ?>
                    <?php wp_reset_postdata();?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
