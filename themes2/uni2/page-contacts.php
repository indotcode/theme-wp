<?php get_header();?>

<div class="contact-home">
    <div class="wrapper contact-home__wrapper">
        <div class="contact-home__map">
            <?=get_post_meta(487, 'map', true)?>
        </div>
        <div class="contact-home__contact">
            <div class="contact-home__form">
                <div class="form">
                    <form class="form__action form__action--active" action="<?php echo esc_url( get_template_directory_uri() ); ?>/ajax/index.php">
                        <h2 class="form__h2">Начните проект</h2>
                        <h4>С вами свяжется наш специалист</h4>
                        <input type="hidden" name="type" value="project_form">
                        <div class="form__input">
                            <input required type="text" name="name" placeholder="Имя">
                        </div>
                        <div class="form__input">
                            <input required type="text" name="phone" placeholder="Телефон">
                        </div>
                        <div class="form__input">
                            <input required type="email" name="email" placeholder="Email">
                        </div>
                        <div class="form__button">
                            <button type="submit">Отправить</button>
                            <p>Нажимая кнопку "Отправить", вы даете согласие на обработку <a href="/politika-konfidencialnosti">персональных данных</a></p>
                        </div>
                    </form>
                    <div class="form__ok">
                        <h2 class="form__h2">СПАСИБО ЗА ЗАЯВКУ</h2>
                        <h4>С вами свяжется наш специалист</h4>
                        <a href="/portfolio.html" class="form__ok-a button button--blue">Портфолио</a>
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/f1.png" alt="" class="form__ok-images">
                    </div>
                </div>
            </div>
            <div class="contact-home__info">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/bg-footer.png" alt="">
                <div class="contact-home__info-meta">
                    <div class="contact-info contact-info--white">
                        <h3>Контакты</h3>
                        <div class="contact-info__meta">
                            <div class="contact-info__meta-element">
                                <div class="contact-info__meta-element__m">
                                    <?=get_post_meta(487, 'city', true)?>
                                </div>
                                <div class="contact-info__meta-element__b">
                                    <?=get_post_meta(487, 'address', true)?>
                                </div>
                            </div>
                            <div class="contact-info__meta-element">
                                <div class="contact-info__meta-element__b">
                                    <a href="tel:<?=get_post_meta(487, 'phone', true)?>"><?=get_post_meta(487, 'phone', true)?></a>
                                </div>
                                <div class="contact-info__meta-element__b">
                                    <a href="mailto:<?=get_post_meta(487, 'email', true)?>"><?=get_post_meta(487, 'email', true)?></a>
                                </div>
                            </div>
                            <div class="contact-info__meta-element">
                                <div class="contact-info__meta-element__m">
                                    Офис
                                </div>
                                <div class="contact-info__meta-element__b">
                                    <?=get_post_meta(487, 'office', true)?>
                                </div>
                            </div>
                            <div class="contact-info__meta-element">
                                <?php
                                App::social('white');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>