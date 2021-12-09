<?php get_header(); ?>

    <div class="basket-page container">
        <div class="check">
            <div class="col-md-9 cart-items">
                <h1 data-changes="h1">Моя корзина (<?=count($_SESSION['basket'])?>)</h1>
                <?php foreach (Basket::Goods()['goods'] as $item){
                    ?>
                    <div class="cart-header basket-page__item" data-id="<?=$item['post']->ID?>">
                        <div class="close1" onclick="delete_goods_basket(this)"> </div>
                        <div class="basket-page__info">
                            <div class="basket-page__images">
                                <img src="<?=Ceo::$domain?><?=$item['meta']['Фотографии'][0]?>" alt=""/>
                            </div>
                            <div class="cart-item-info">
                                <h3>
                                    <a href="<?=get_permalink($item['post']->ID)?>"><?=$item['post']->post_title?></a>
                                    <?php if($item['meta']['Бренд'] != ''){ ?>
                                        <span>Бренд: <?=$item['meta']['Бренд']?></span>
                                    <?php } ?>
                                </h3>
                                <ul class="qty basket-page__info__qty">
                                    <?php if($item['meta']['Стиль'] != ''){ ?>
                                        <li><p>Стиль: <?=$item['meta']['Стиль']?></p></li>
                                    <?php } ?>
                                    <?php if($item['meta']['Цвет'] != ''){ ?>
                                        <li><p>Цвет: <?=$item['meta']['Цвет']?></p></li>
                                    <?php } ?>
                                    <?php if($item['meta']['Размер'] != ''){ ?>
                                        <li><p>Размер: <?=$item['meta']['Размер']?></p></li>
                                    <?php } ?>
                                </ul>
                                <div class="basket-page__delivery">
                                    <div class="basket-page__price" data-changes="basket-page__price">
                                        Цена: <?=$item['price']?> руб.
                                    </div>
                                    <div class="basket__goods-che__counter">
                                        <button type="button" class="but counterBut dec" onclick="basket_goods_che_counter(this, 1)"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                        <input readonly type="text" class="field fieldCount" name="goods[count]" value="<?=$item['count']?>" data-min="1" data-max="999">
                                        <button type="button" class="but counterBut inc" onclick="basket_goods_che_counter(this, 2)"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-3 cart-total" data-changes="basket">
                <?php
                include Router::Root() . '/ajax-temp/basket.php'
                ?>
            </div>
        </div>
    </div>
<?php
//echo '<pre>';
//print_r(Basket::Goods());
//echo '</pre>';
?>

<?php get_footer(); ?>