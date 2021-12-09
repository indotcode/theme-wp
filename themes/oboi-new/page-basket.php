<?php
get_header(); ?>
    <main>
        <div class="breadcrumbs">
            <div class="breadcrumbs__wrapper wrapper">
                <a class="breadcrumbs__link" href="/">
                    Главная
                </a>
                <a class="breadcrumbs__link" href="/basket">
                    Корзина
                </a>
            </div>
        </div>
        <section class="basket">
            <div class="basket__wrapper wrapper">
                <h1 class="basket__title h2">Корзина</h1>
                <div class="basket__content">
                    <?php if(!empty($_GET) && $_GET['success'] == 'ok'){ ?>
                        <div class="basket__success">
                            <h3 class="basket__success-title">Спасибо за заказ </h3>
                            <p class="basket__success-description">Наш специалист свяжется с вами в ближайшее время</p>
                        </div>
                    <?php } else { ?>
                        <?php if(Basket::Goods()['count'] != 0){ ?>
                            <div class="basket__cards">
                                <?php foreach (Basket::Goods()['goods'] as $item){ ?>
                                    <div class="basket__card">
                                        <div class="basket__img-container">
                                            <?php if(count($item['meta']['Фотографии']) != 0){ ?>
                                                <img src="<?=Ceo::$domain?><?=$item['meta']['Фотографии'][0]?>" alt="">
                                            <?php } else { ?>
                                                <img src="<?=Ceo::$domain?>/1C/foto0_04472c97-41f0-11e8-ab4d-309c236cb1c6.jpg" alt="">
                                            <?php } ?>
                                        </div>
                                        <div class="basket__card-content">
                                            <h3 class="basket__card-title">
                                                <?=$item['post']->post_title?>
                                            </h3>
                                            <form class="basket__card-close ajax-jq" action="/wp-ajax/index.php" method="post">
                                                <input type="hidden" name="type" value="delete_basket_item">
                                                <input type="hidden" name="ID" value="<?=$item['post']->ID?>">
                                                <button type="submit">
                                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1 1L11 11" stroke="white" stroke-linecap="round"/>
                                                        <path d="M1 11L11 0.999999" stroke="white" stroke-linecap="round"/>
                                                    </svg>
                                                </button>
                                            </form>
                                            <div class="basket__card-info-container">
                                            <span class="basket__card-name">
                                                Категория
                                            </span>
                                            <span class="basket__card-value">
                                                <?=$item['term'][0]->name?>
                                            </span>
                                            </div>
                                            <div class="basket__card-info-container">
                                            <span class="basket__card-name">
                                                Количество
                                            </span>
                                                <form action="/wp-ajax/index.php" method="post" class="basket__card-count ajax-jq">
                                                    <input type="hidden" name="type" value="change_basket_list">
                                                    <input type="hidden" name="ID" value="<?=$item['post']->ID?>">
                                                    <div class="basket-control__elm">
                                                        <button value="1" class="basket-control_submitter basket-control__elm-minus" type="submit">-</button>
                                                        <input readonly type="text" name="count" value="<?=$item['count']?>" data-min="1" data-max="999">
                                                        <button value="2" class="basket-control_submitter basket-control__elm-plus" type="submit">+</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="basket__card-info-container">
                                                <span class="basket__card-name">
                                                    Цена
                                                </span>
                                                <span class="basket__card-value basket__card-value--color">
                                                    <?=$item['price']?> руб.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="basket__order">
                                <div class="basket__order-inner">
                                    <div class="basket__order-info">
                                        <div class="basket__order-info-box">
                                            <?php Router::include_data('/patterns/basket__order-info-box.php') ?>
                                        </div>
                                    </div>
                                </div>
                                <form action="/wp-ajax/index.php" method="post" class="basket__form-inner ajax-jq">
                                <span class="basket__form-info-title">
                                    Оформить заказ
                                </span>
                                    <input required name="type" type="hidden" value="form">
                                    <input required name="request" type="hidden" value="checkout">
                                    <input required name="title" type="hidden" value="Оформить заказ">
                                    <div class="basket__form-wrapper">
                                        <label for="name">Имя</label>
                                        <input required class="basket__form-input" name="name" id="name" type="text" placeholder="Введите имя">
                                    </div>
                                    <div class="basket__form-wrapper">
                                        <label for="phone">Телефон</label>
                                        <input required class="basket__form-input" name="phone" id="phone" type="text" placeholder="+7 (___) ___-__-__">
                                    </div>
                                    <div class="basket__form-wrapper basket__form-wrapper--btn">
                                        <button onclick="yaCounter49393813.reachGoal('klikzakaz'); return true;" class="btn basket__btn" type="submit">Отправить</button>
                                    </div>
                                    <div class="basket__form-wrapper basket__form-wrapper--text">
                                        Нажимая кнопку «Отправить», вы даете согласие на обработку <a href="/processing-personal-data">персональных данных</a>
                                    </div>
                                </form>
                            </div>
                        <?php } else { ?>
                            <?php Router::include_data('/patterns/empty.php') ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>