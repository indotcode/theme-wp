<?php get_header(); ?>

<div class="single_top">
    <div class="container">
        <div class="map">
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Ae29ce3d3bde51e7828085c458f7b0d6b2f547d975841920b9c386c0ec51b7dfc&amp;source=constructor" width="1140" height="405" frameborder="0"></iframe>
        </div>
        <div class="col-md-9 contact_left">
            <h1>Cвязаться c нами</h1>
            <form action="" method="post" onsubmit="FormContact(this); return false;">
                <input type="hidden" name="method" value="contact">
                <div class="column_2">
                    <input autocomplete="off" data-error='["Введите имя!"]' type="text" class="text" name="name"  placeholder="Имя" value="">
                    <input autocomplete="off" data-error='["Введите e-mail!", "Введите правельно e-mail!"]' type="text" class="text" name="email" placeholder="E-mail" value="" style="margin-left:2.7%">
                    <input autocomplete="off" data-error='["Введите телефон"]' type="text" class="text" name="phone" placeholder="Телефон" value="" style="margin-left:2.7%">
                </div>
                <div class="column_3">
                    <textarea data-error='["Введите текст сообшения!"]' name="text" placeholder="Текст сообшения"></textarea>
                </div>
                <div class="form-submit1">
                    <div class="processing-personal-data-contact">
                        <p>Нажимая кнопку 'Отправить', вы даете согласие на <a href="/processing-personal-data">обработку персональных данных</a>.</p>
                    </div>
                    <input type="submit" value="Отправить">
                </div>
                <div class="clearfix"> </div>
            </form>
        </div>
        <div class="col-md-3 contact_right">
            <h2>Информация</h2>
            <address class="address">
                <p>У организации 3 филиала</p>
                <dl>
                    <dd>Адреса:</dd>
                    <dd>Запорожская, 79</dd>
                    <dd>Курако, 3</dd>
                    <dd>Металлургов, 46</dd>
                </dl>
                <dl>
                    <dt></dt>
                    <dd>Режим работы:</dd>
                    <dd>Пн-Сб: 10:00–19:00</dd>
                    <dd>Вс: 10:00-17:00</dd>
                </dl>
                <dl>
                    <dd>Телефон: <span> +7–960–915–77–00</span></dd>
                    <dd>Cправочная: <span>+7 (3843) 45–84–99</span></dd>
                    <dd>E-mail: <span><a href="mailto:oboi-plus@yandex.ru">oboi-plus@yandex.ru</a></span></dd>
                </dl>
            </address>
        </div>
    </div>
</div>


<?php get_footer(); ?>