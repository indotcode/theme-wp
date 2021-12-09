<a href="/basket" class="basket__top__a">
    <div class="basket__top-ket">
        <?php if(count(Basket::Goods()['goods']) != 0){ ?>
            <span>Корзина:</span>
            <span><?=Basket::Goods()['price']?> руб.</span>
            <span>(<?=Basket::Goods()['count']?>)</span>
        <?php } else { ?>
            <span>Корзина</span>
        <?php } ?>
    </div>
    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
</a>