<?php get_header(); ?>
<main>

    <?php
    $slider = Goods::Result(array(
        'post_type' => 'slider',
        'posts_per_page' => 10,
        'order' => 'DESC',
        'orderby' => 'date'
    ));
    if(count($slider) != 0){ ?>
        <section class="preview">
            <div class="preview__wrapper wrapper">
                <div class="preview__card preview__slider">
                    <div class="preview__functional">
                        <?php foreach ($slider as $i => $item){ ?>
                            <a class="preview__functional-js preview__functional-btn <?=$i==0 ? 'preview__functional-btn--active' : ''?>" href="" data-index="<?=$i?>"></a>
                        <?php } ?>
                    </div>
                    <div class="preview__slider-wrapper">
                        <?php foreach ($slider as $i => $item){ ?>
                            <div class="preview__slide <?=$i==0 ? 'preview__slide--show' : ''?>" data-index="<?=$i?>" style="background: url(<?=wp_get_attachment_image_url($item['meta']['images'], "full")?>) no-repeat 100% 100%; background-size: cover">
                                <h3 class="preview__title">
                                    <?=$item['post_title']?>
                                </h3>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div style="background: url(<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/reds.png) no-repeat 100% 100%; background-size: cover;" class="preview__card preview__card--anons">
                    <span class="preview__date">До 31 декабря 2020 </span>
                    <h3 class="preview__stock">Скидка до 50%</h3>
                    <p class="preview__description">На коллекции 2019 года</p>
                </div>
            </div>
        </section>
    <?php } ?>


    <?php
    $terms = get_terms(array(
        'taxonomy' => 'cats',
        'meta_query'    => array(
            'relation' => 'AND',
            array(
                'key' => 'home',
                'value' => 1,
                'compare' => '=',
                'type' => 'NUMERIC'
            )
        ),
    ));
    if(count($terms) != 0){ ?>
        <section class="cat-home">
            <div class="cat-home__wrapper wrapper">
                <div class="cat-home__title-container">
                    <h2 class="cat-home__title h2">Категории товаров</h2>
                    <a class="cat-home__btn btn" href="/goods">В каталог</a>
                    <div class="cat-home__cards">
                        <?php foreach ($terms as $key => $val){ ?>
                            <?php
                            $images = get_term_meta($val->term_id, 'images', false)['guid'];
                            switch (true){
                                case ($key == 0):
                                    ?>
                                    <a href="<?=get_term_link($val->term_id, 'cats')?>" class="cat-home__card cat-home__card--big cat-home__card--chandelier" style="background: url(<?=$images?>) no-repeat left center #fff;">
                                        <span><?=$val->name?></span>
                                    </a>
                                    <?php
                                    break;
                                case ($key == 7):
                                    ?>
                                    <a href="<?=get_term_link($val->term_id, 'cats')?>" class="cat-home__card cat-home__card--big cat-home__card--additionally" style="background: url(<?=$images?>) no-repeat right bottom #fff;">
                                        <span><?=$val->name?></span>
                                    </a>
                                    <?php
                                    break;
                                case ($key == 3):
                                    ?>
                                    <a href="<?=get_term_link($val->term_id, 'cats')?>" class="cat-home__card cat-home__card--all">
                                        <div class="cat-home__card-text">
                                            <span><?=$val->name?></span>
                                        </div>
                                        <div class="cat-home__card-bg cat-home__card-bg--wall-murals" style="background: url(<?=$images?>) no-repeat 100% 100%;">

                                        </div>
                                    </a>
                                    <?php
                                    break;
                                default:
                                    ?>
                                    <a href="<?=get_term_link($val->term_id, 'cats')?>" class="cat-home__card cat-home__card--all">
                                        <div class="cat-home__card-text">
                                            <span><?=$val->name?></span>
                                        </div>
                                        <div class="cat-home__card-bg cat-home__card-bg--non-woven-wallpaper" style="background: url(<?=$images?>) no-repeat">

                                        </div>
                                    </a>
                                    <?php
                                    break;
                            }
                            ?>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php
    $goods_new = Goods::Result(array(
        'post_type' => 'goods',
        'posts_per_page' => 4,
        'order' => 'DESC',
        'orderby' => 'date',
        'tax_query' => [
            [
                'taxonomy' => 'cats',
                'field'    => 'id',
                'terms'    => [21, 18],
                'operator' => 'NOT IN',
            ]
        ],
        'meta_query' => [
            'relation' => 'AND',
            [
                'key' => 'Остаток',
                'value' => 0,
                'compare' => '>',
                'type' => 'NUMERIC'
            ]
        ]
    ));
    if(count($goods_new) != 0){ ?>
        <section class="grid-card">
            <div class="grid-card__wrapper wrapper">
                <h2 class="grid-card__h2 h2">Новинки</h2>
                <div class="grid-card__inner">
                    <?php foreach ($goods_new as $item){ ?>
                        <a href="<?=$item['guid']?>" class="grid-card__card card">
                            <div class="card__banner">
                                <?php if(count($item['meta']['Фотографии']) != 0){ ?>
                                    <img class="card__img" src="<?=Images::ImagesPath($item['meta']['Фотографии'][0])?>" alt="">
                                <?php } else { ?>
                                    <img class="card__img" src="<?=Ceo::$domain?>/1C/foto0_04472c97-41f0-11e8-ab4d-309c236cb1c6.jpg" alt="">
                                <?php } ?>
                            </div>
                            <div class="card__content">
                                <div class="card__wrapper-info">
                                    <h4 class="card__wrapper-title">
                                        <?=$item['post_title']?>
                                    </h4>
                                    <div class="card__data-wrapper">
                                        <div class="card__data-info">
                                        <span class="card__name">
                                                Категории
                                        </span>
                                        <span class="card__value">
                                                <?=$item['category']['string']?>
                                        </span>
                                        </div>
                                        <div class="card__data-info">
                                            <span class="card__name">
                                                Цена
                                            </span>
                                            <span class="card__value card__value--price">
                                                <?=$item['meta']['Цена']?> руб
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <a class="btn grid-card__btn" href="/goods">В каталог</a>
            </div>
        </section>
    <?php } ?>

    <?php
    $goods_popular = Goods::Result(array(
        'post_type' => 'goods',
        'posts_per_page' => 6,
        'order' => 'DESC',
        'orderby' => 'date',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'Остаток',
                'value' => 0,
                'compare' => '>',
                'type' => 'NUMERIC'
            ),
            array(
                'key' => 'popular',
                'value' => 1,
                'type' => 'NUMERIC'
            )
        )
    ));
    if(count($goods_popular) != 0){ ?>
        <section class="grid-card grid-card--color grid-card--three-row">
            <div class="grid-card__wrapper wrapper">
                <h2 class="grid-card__h2 h2">Популярное</h2>
                <div class="grid-card__inner">
                    <?php foreach ($goods_popular as $item){ ?>
                        <a href="<?=$item['guid']?>" class="grid-card__card card">
                            <div class="card__banner">
                                <?php if(count($item['meta']['Фотографии']) != 0){ ?>
                                    <img class="card__img" src="<?=Images::ImagesPath($item['meta']['Фотографии'][0])?>" alt="">
                                <?php } else { ?>
                                    <img class="card__img" src="<?=Ceo::$domain?>/1C/foto0_04472c97-41f0-11e8-ab4d-309c236cb1c6.jpg" alt="">
                                <?php } ?>
                            </div>
                            <div class="card__content">
                                <div class="card__wrapper-info">
                                    <h4 class="card__wrapper-title">
                                        <?=$item['post_title']?>
                                    </h4>
                                    <div class="card__data-wrapper">
                                        <div class="card__data-info">
                                            <span class="card__name">Категории</span>
                                            <span class="card__value"><?=$item['category']['string']?></span>
                                        </div>

                                        <div class="card__data-info">
                                            <span class="card__name">
                                                Цена
                                            </span>
                                            <span class="card__value card__value--price">
                                                <?=$item['meta']['Цена']?> руб
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <a class="btn grid-card__btn" href="/goods">В каталог</a>
            </div>
        </section>
    <?php } ?>

    <?php
    $goods_discount = Goods::Result(array(
        'post_type' => 'goods',
        'posts_per_page' => 4,
        'order' => 'DESC',
        'orderby' => 'date',
        'tax_query' => [
            [
                'taxonomy' => 'cats',
                'field'    => 'id',
                'terms'    => 21
            ]
        ],
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
    if(count($goods_discount) != 0){ ?>
    <section class="grid-card">
        <div class="grid-card__wrapper wrapper">
            <h2 class="grid-card__h2 h2">Товары со скидкой</h2>
            <div class="grid-card__inner">
                <?php foreach ($goods_discount as $item){ ?>
                    <a href="<?=$item['guid']?>" class="grid-card__card card">
                        <div class="card__banner">
                            <?php if(count($item['meta']['Фотографии']) != 0){ ?>
                                <img class="card__img" src="<?=Images::ImagesPath($item['meta']['Фотографии'][0])?>" alt="">
                            <?php } else { ?>
                                <img class="card__img" src="<?=Ceo::$domain?>/1C/foto0_04472c97-41f0-11e8-ab4d-309c236cb1c6.jpg" alt="">
                            <?php } ?>
                        </div>
                        <div class="card__content">
                            <div class="card__wrapper-info">
                                <h4 class="card__wrapper-title">
                                    <?=$item['post_title']?>
                                </h4>
                                <div class="card__data-wrapper">
                                    <div class="card__data-info">
                                        <span class="card__name">Категории</span>
                                        <span class="card__value"><?=$item['category']['string']?></span>
                                    </div>

                                    <div class="card__data-info">
                                        <span class="card__name">
                                            Цена
                                        </span>
                                        <span class="card__value card__value--price">
                                            <?=$item['meta']['Цена']?> руб
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
            <a class="btn grid-card__btn" href="/goods">В каталог</a>
        </div>
    </section>
    <?php } ?>
</main>
<?php get_footer(); ?>
