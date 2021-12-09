<ul class="total_price">
    <li class="last_price"> <h4>Цена</h4></li>
    <li class="last_price"><span><?=Basket::Goods()['price']?> руб.</span></li>
</ul>
<div class="clearfix"></div>
<?php if(Basket::Goods()['count'] > 0){ ?>
    <a href="#test-popup" class="order basket__order" onclick="yaCounter49393813.reachGoal('klikzakaz'); return true;">Заказать</a>
    <div id="test-popup" class="white-popup mfp-hide">
        <div class="wrap-box form"></div>
        <div class="forms-goods">
            <h2>Оформление заказа</h2>
            <form action="" method="post" onsubmit="FormContact(this); return false;">
                <input type="hidden" name="method" value="basket_goods">
                <div class="form-grop">
                    <label for="name">Имя</label>
                    <input autocomplete="off" data-error='["Введите имя!"]' id="name" placeholder="" type="text" class="text" name="name" value="">
                </div>
                <div class="form-grop">
                    <label for="phone">Телефон</label>
                    <input autocomplete="off" data-error='["Введите телефон"]' id="phone" placeholder="+7(***)***-**-**" type="text" class="text" name="phone" value="">
                </div>
                <div class="processing-personal-data">
                    <p>Нажимая кнопку 'Отправить', вы даете согласие на <a href="/processing-personal-data">обработку персональных данных</a>.</p>
                </div>
                <div class="submit">
                    <input onclick="yaCounter49393813.reachGoal('zakaz'); return true;" type="submit" value="Отправить">
                </div>
            </form>
        </div>
    </div>
<?php } ?>