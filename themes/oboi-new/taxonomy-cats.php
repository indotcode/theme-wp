<?php
$term = get_queried_object();
$goods = Plugins::CatsResultFilter(array(
    'term_id' => $term->term_id,
    'offset' => 0,
    'get' => $_GET
));
get_header(); ?>
<main>
    <section class="shop">
        <div class="shop__wrapper wrapper">
            <div id="filter" class="shop__filter filter">
                <div class="filter">
                    <div class="filter__wrapper wrapper">
                        <a id="filterClose" class="filter__close" href="/goods">

                        </a>
                        <h2 class="filter__title h2">
                            Фильтры
                        </h2>
                        <div class="filter__content">
                            <form action="/wp-ajax/index.php" method="post" class="ajax-jq">
                                <input type="hidden" name="type" value="filter_goods_cats">
                                <input type="hidden" name="term_id" value="<?=$term->term_id?>">
                                <?php
                                $none_filter = 0;
                                foreach ($goods['params'] as $params_key => $params_val){ ?>
                                    <?php if(count($params_val['result']) != 0){ ?>
                                        <div class="filter__tab filter__tab--show">
                                            <a class="filter__tab-link" href=""><?=$params_val['title']?></a>
                                            <div class="filter__tab-content">
                                                <?php foreach ($params_val['result'] as $element_key => $element_val){ ?>
                                                    <div class="filter__check">
                                                        <input <?=$element_val['status']?> class="filter__input-ckeck visiually-hidden" name="filter[<?=$params_key?>][]" id="<?=$params_key.$element_key?>" type="checkbox" value="<?=$element_val['value']?>">
                                                        <label class="filter__label" for="<?=$params_key.$element_key?>"><?=$element_val['value']?></label>
                                                        <button class="filter__check-submit" type="submit">Показать</button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php
                                        $none_filter++;
                                    } ?>
                                <?php } ?>
                                <?php if($none_filter != 0){ ?>
                                    <button class="btn" type="submit">Показать</button>
                                <?php } else { ?>
                                    <div class="none-count">Фильтров по данному товару нет!</div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shop__field">
                <div class="shop__breadcrumbs breadcrumbs">
                    <div class="breadcrumbs__wrapper wrapper">
                        <a class="breadcrumbs__link" href="/">
                            Главная
                        </a>
                        <a class="breadcrumbs__link" href="/goods">
                            Каталог
                        </a>
                        <a class="breadcrumbs__link" href="/cats/<?=$term->slug?>">
                            <?=$term->name?>
                        </a>
                    </div>
                </div>

                <div class="shop__title-wrapper">
                    <h1 class="shop__title h2">
                        <?=$term->name?>
                    </h1>
                    <a id="openFilter" class="shop__filte-btn" href="">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="20" fill="#FBCC0C"/>
                            <g clip-path="url(#clip0)">
                                <path d="M28.0325 11H11.985C11.7018 10.9995 11.4423 11.1576 11.313 11.4094C11.1818 11.6646 11.2048 11.9719 11.3724 12.2049L17.2515 20.487C17.2535 20.4899 17.2556 20.4925 17.2576 20.4954C17.4712 20.7838 17.5868 21.1332 17.5874 21.4921V28.2444C17.5861 28.4443 17.6646 28.6365 17.8054 28.7783C17.9464 28.92 18.1381 29 18.338 29C18.4395 28.9998 18.5402 28.9796 18.634 28.9406L21.9376 27.681C22.2335 27.5905 22.43 27.3112 22.43 26.975V21.4921C22.4305 21.1332 22.5462 20.7838 22.7596 20.4954C22.7616 20.4925 22.7637 20.4899 22.7657 20.487L28.645 12.2048C28.8126 11.9719 28.8356 11.6648 28.7044 11.4096C28.5752 11.1576 28.3156 10.9995 28.0325 11Z" fill="white"/>
                            </g>
                            <defs>
                                <clipPath id="clip0">
                                    <rect x="11" y="11" width="18" height="18" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
                <div class="shop__setting-wrapper">
                    <div class="shop__setting-sort">
                        <form class="shop__setting-choose ajax-jq" action="/wp-ajax/index.php" method="post">
                            <input type="hidden" name="type" value="sort">
                            <span class="shop__setting-optional">Сортировать:</span>
                            <a class="shop__setting-value">
                                <?php
                                switch ($goods['sort']){
                                    case 'price_desc':
                                        echo 'По убыванию цены';
                                        break;
                                    case 'price_asc':
                                        echo 'По возрастанию цены';
                                        break;
                                    case 'title':
                                        echo 'По наименованию';
                                        break;
                                    case 'date':
                                        echo 'По новизне';
                                        break;
                                }
                                ?>
                            </a>
                            <div class="shop__setting-container-value">
                                <button class="basket-control_submitter" type="submit" value="price_desc">По убыванию цены</button>
                                <button class="basket-control_submitter" type="submit" value="price_asc">По возрастанию цены</button>
                                <button class="basket-control_submitter" type="submit" value="title">По наименованию</button>
                                <button class="basket-control_submitter" type="submit" value="date">По новизне</button>
                            </div>
                        </form>
                    </div>
                    <form class="shop__setting-grid ajax-jq" action="/wp-ajax/index.php" method="post">
                        <input type="hidden" name="type" value="grid">
                        <button type="submit" value="row" id="rowGrid" class="basket-control_submitter <?=$goods['grid'] == 'row' ? 'shop__setting-grid-active' : ''?>">
                            <svg width="24" height="18" viewBox="0 0 24 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="24" height="7.5" fill="#BDBDBD"/>
                                <rect y="10.5" width="24" height="7.5" fill="#BDBDBD"/>
                            </svg>
                        </button>
                        <button type="submit" value="column" id="columnGrid" class="basket-control_submitter <?=$goods['grid'] == 'column' ? 'shop__setting-grid-active' : ''?>">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="7.5" height="7.5" fill="#BDBDBD"/>
                                <rect y="10.5" width="7.5" height="7.5" fill="#BDBDBD"/>
                                <rect x="10.5" width="7.5" height="7.5" fill="#BDBDBD"/>
                                <rect x="10.5" y="10.5" width="7.5" height="7.5" fill="#BDBDBD"/>
                            </svg>
                        </button>
                    </form>
                </div>
                <div id="toggleGrid" class="shop__cards <?=$_SESSION['grid'] == 'row' ? 'shop__cards--grid-first' : ''?>">
                    <?php foreach($goods['result'] as $item){ ?>
                        <a href="<?=$item['guid']?>" class="shop__card card">
                            <div class="card__banner card__banner--relative">
                                <div class="card__view">
                                    <div class="card__viewBtn btn a-model a-model--ajax" data-type="post" data-id="<?=$item['ID']?>">Быстрый просмотр</div>
                                </div>
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
                    <?php if(count($goods['result']) == 0){ ?>
                        <div class="none-count">Товаров по данному фильтру нет!</div>
                    <?php } ?>
                </div>
                <?php if($goods['count'] > $goods['posts_per_page']){ ?>
                    <form class="shop__functional ajax-jq" action="/wp-ajax/index.php" method="post">
                        <input type="hidden" name="type" value="more">
                        <input type="hidden" name="posts_per_page" value="<?=$goods['posts_per_page']?>">
                        <input type="hidden" name="offset" value="<?=$goods['posts_per_page']?>">
                        <input type="hidden" name="count" value="<?=$goods['count']?>">
                        <input type="hidden" name="term_id" value="<?=$term->term_id?>">
                        <?php if(!empty($_GET)){ ?>
                            <?php foreach ($_GET as $key => $val){ ?>
                                <input type="hidden" name="get[<?=$key?>]" value="<?=$val?>">
                            <?php } ?>
                        <?php } ?>
                        <button type="submit" class="shop__btn-more btn btn--hollow">Показать ещё</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer();