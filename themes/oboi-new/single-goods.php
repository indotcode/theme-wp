<?php
global $post;
$item = Goods::Id($post->ID);
$you_watched_recently = Goods::you_watched_recently($post->ID, 0, 4);
$with_these_goods_buy = Plugins::get_with_these_goods_buy($post->ID, 0, 4);
$get_with_these_goods = Goods::get_with_these_goods($post->ID);
get_header(); ?>
<main>
    <div class="breadcrumbs">
        <div class="breadcrumbs__wrapper wrapper">
            <a class="breadcrumbs__link" href="/">
                Главная
            </a>
            <a class="breadcrumbs__link" href="/goods">
                Каталог
            </a>
            <a class="breadcrumbs__link" href="<?=get_term_link($item['category']['result'][0]['term_id'])?>">
                <?=$item['category']['result'][0]['name']?>
            </a>
            <a class="breadcrumbs__link" href="<?=get_permalink($item['ID'])?>">
                <?=$item['post_title']?>
            </a>
        </div>
    </div>
    <section class="grid-card grid-card--big">
        <div class="grid-card__wrapper wrapper">
            <h2 class="grid-card__h2 h2"><?=$item['post_title']?></h2>
            <div class="grid-card__inner">
                <div class="grid-card__card card">
                    <div class="slider-single">
                        <?php if(count($item['meta']['Фотографии']) != 0){ ?>
                            <div class="slider-single__block">
                                <a href="<?=Ceo::$domain?><?=$item['meta']['Фотографии'][0]?>" class="images-box" data-fancybox="images">
                                    <img class="slider-single__block-img" src="<?=Ceo::$domain?><?=$item['meta']['Фотографии'][0]?>" alt="">
                                </a>
                            </div>
                            <?php if(count($item['meta']['Фотографии']) > 1){ ?>
                                <div style="display: none">
                                    <?php foreach ($item['meta']['Фотографии'] as $key => $val){
                                        if($key > 0){ ?>
                                            <a href="<?=Ceo::$domain?><?=$val?>" class="images-box" data-fancybox="images">
                                                <img src="<?=Ceo::$domain?><?=$val?>" alt="">
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <div class="slider-single__list">
                                <?php foreach ($item['meta']['Фотографии'] as $key => $val){ ?>
                                    <div class="slider-single__item <?=$key == 0 ? 'slider-single__item--active' : ''?>">
                                        <img class="slider-single__item-img" src="<?=Ceo::$domain?><?=$val?>" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } else { ?>
                            <div class="slider-single__block">
                                <img class="slider-single__block-img-none" src="<?=Ceo::$domain?>/1C/foto0_04472c97-41f0-11e8-ab4d-309c236cb1c6.jpg" alt="">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="card__content">
                        <div class="card__wrapper-info">
                            <h1 class="card__wrapper-title">
                                <?=$item['post_title']?>
                            </h1>
                            <div class="card__data-wrapper">
                                <?php if(count($item['meta']['Магазины']) != 0){ ?>
                                    <div class="card__data-info">
                                        <span class="card__name">
                                            Доступно в магазине
                                        </span>
                                        <span class="card__value">
                                            <?php
                                            echo implode("<br>", $item['meta']['Магазины']);
                                            ?>
                                        </span>
                                    </div>
                                <?php } ?>
                                <?php if($item['meta']['Коллекция'] != ''){ ?>
                                    <div class="card__data-info">
                                        <span class="card__name">
                                            Коллекция
                                        </span>
                                        <a class="card__value" href="/cats/<?=$item['category']['result'][0]['slug']?>?collection=<?=$item['meta']['Коллекция']?>">
                                            <?=$item['meta']['Коллекция']?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <?php if($item['meta']['Стиль'] != ''){ ?>
                                    <div class="card__data-info">
                                        <span class="card__name">
                                            Стиль
                                        </span>
                                        <a class="card__value" href="/cats/<?=$item['category']['result'][0]['slug']?>?style=<?=$item['meta']['Стиль']?>">
                                            <?=$item['meta']['Стиль']?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <?php if($item['meta']['Цвет'] != ''){ ?>
                                    <div class="card__data-info">
                                        <span class="card__name">
                                            Цвет
                                        </span>
                                        <a class="card__value" href="/cats/<?=$item['category']['result'][0]['slug']?>?color=<?=$item['meta']['Цвет']?>">
                                            <?=$item['meta']['Цвет']?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <?php if($item['meta']['Размер'] != ''){ ?>
                                    <div class="card__data-info">
                                        <span class="card__name">
                                            Размер
                                        </span>
                                        <a class="card__value" href="/cats/<?=$item['category']['result'][0]['slug']?>?size=<?=$item['meta']['Размер']?>">
                                            <?=$item['meta']['Размер']?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <?php if($item['meta']['Бренд'] != ''){ ?>
                                    <div class="card__data-info">
                                        <span class="card__name">
                                            Бренд
                                        </span>
                                        <a class="card__value" href="/cats/<?=$item['category']['result'][0]['slug']?>?brand=<?=$item['meta']['Бренд']?>">
                                            <?=$item['meta']['Бренд']?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <?php if(count($item['category']['result']) != 0){ ?>
                                    <div class="card__data-info">
                                        <span class="card__name">
                                            Категории
                                        </span>
                                        <a class="card__value" href="/cats/<?=$item['category']['result'][0]['slug']?>">
                                            <?=$item['category']['result'][0]['name']?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <? if($item['meta']['Остаток'] != 0) : ?>
                                    <div class="card__data-info-wrapper">
                                        <div class="card__data-info">
                                            <span class="card__name">
                                                Цена
                                            </span>
                                            <span class="card__value card__value--price">
                                                <?=$item['meta']['Цена']?> руб
                                            </span>
                                        </div>
                                        <a class="btn btn--share"><span>Поделиться</span></a>
                                        <form class="basket-control ajax-jq" action="/wp-ajax/index.php" method="post">
                                            <input type="hidden" name="type" value="change_basket">
                                            <input type="hidden" name="ID" value="<?=$item['ID']?>">
                                            <div class="basket-control__elm">
                                                <button class="basket-control__elm-minus" type="button">-</button>
                                                <input readonly type="text" name="count" value="1" data-min="1" data-max="999">
                                                <button class="basket-control__elm-plus" type="button">+</button>
                                            </div>
                                            <button onclick="yaCounter49393813.reachGoal('korzina'); return true;" type="submit" class="btn grid-card__btn">
                                                <?php if(!empty($_SESSION['basket'][$data['ID']])){
                                                    echo 'В корзине';
                                                } else {
                                                    echo 'В корзину';
                                                }?>
                                                </button>
                                            <?php Router::include_data('/patterns/basket-control__elm-count.php', array('ID' => $item['ID'])) ?>
                                        </form>
                                        <div class="share-block">
                                            <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                                            <script src="https://yastatic.net/share2/share.js"></script>
                                            <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,twitter,viber,whatsapp,skype,telegram"></div>
                                        </div>
                                    </div>
                                <? else : ?>
                                    <div class="card__data-info-wrapper">
                                        <div class="card__data-info">
                                            <span class="card__value card__value--price">
                                                Товара нет на складе!
                                            </span>
                                        </div>
                                    </div>
                                <? endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(count($with_these_goods_buy) != 0){ ?>
        <section class="grid-card grid-card--color">
            <div class="grid-card__wrapper wrapper">
                <h2 class="grid-card__h2 h2">С эти товаром покупают</h2>
                <div class="grid-card__inner">
                    <?php foreach ($with_these_goods_buy as $item){
                        ?>
                        <a href="<?=get_permalink($item['ID'])?>" class="grid-card__card card">
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
    <?php } else { ?>
        <?php if(count($get_with_these_goods) != 0){ ?>
            <section class="grid-card grid-card--color">
                <div class="grid-card__wrapper wrapper">
                    <h2 class="grid-card__h2 h2">С эти товаром покупают</h2>
                    <div class="grid-card__inner">
                        <?php foreach ($get_with_these_goods as $item){
                            ?>
                            <a href="<?=get_permalink($item['ID'])?>" class="grid-card__card card">
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
    <?php } ?>
    <?php if(count($you_watched_recently) != 0){ ?>
        <section class="grid-card">
            <div class="grid-card__wrapper wrapper">
                <h2 class="grid-card__h2 h2">Вы недавно смотрели</h2>
                <div class="grid-card__inner">
                    <?php foreach ($you_watched_recently as $item){?>
                        <a href="<?=get_permalink($item['ID'])?>" class="grid-card__card card">
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
