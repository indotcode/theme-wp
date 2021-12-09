<div class="application">
    <div class="wrapper application__wrapper">
        <div class="form form--white form--max-550">
            <form class="form__action form__action--active" action="<?php echo esc_url( get_template_directory_uri() ); ?>/ajax/index.php">
                <h2 class="form__h2 form__h2--32">ОСТАВЬТЕ ЗАЯВКУ НА САЙТ</h2>
                <h4>С вами свяжется наш специалист</h4>
                <input type="hidden" name="type" value="project_form">
                <div class="form__input form__input--nicknames">
                    <input required type="text" name="name" placeholder="Имя"/>
                </div>
                <div class="form__input form__input--nicknames">
                    <input required type="text" name="phone" placeholder="Телефон"/>
                </div>
                <div class="form__input form__input--nicknames">
                    <input required type="text" name="email" placeholder="Email"/>
                </div>
                <div class="form__button form__button--white">
                    <button type="submit">Отправить</button>
                    <p>Нажимая кнопку "Отправить", вы даете согласие на обработку <a href="/politika-konfidencialnosti">персональных данных</a></p>
                </div>
            </form>
            <div class="form__ok">
                <h2 class="form__h2 form__h2--32">СПАСИБО ЗА ЗАЯВКУ</h2>
                <h4>С вами свяжется наш специалист</h4>
                <a href="/portfolio.html" class="form__ok-a button button--blue">Портфолио</a>
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/f1.png" alt="" class="form__ok-images">
            </div>
        </div>
    </div>
</div>