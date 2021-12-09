<div class="modal" id="menu">
    <div class="modal__wrapper">
        <div class="modal__menu">
            <div class="header header--absolute">
                <div class="wrapper header__wrapper">
                    <a class="header__logo header__logo--white" href="/"></a>
                    <a href="" class="header__burger header__burger--blue header__burger--rotate modal-link" data-type="menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    <a href="tel:<?=get_post_meta(487, 'phone', true)?>" class="header__phone header__phone--black" ><?=get_post_meta(487, 'phone', true)?></a>
                </div>
            </div>
            <div class="modal__menu__wrapper">
                <div class="modal__menu__left">
                    <div class="modal__menu__left-form">
                        <div class="form form--white form--max-width">
                            <form class="form__action form__action--active" action="<?php echo esc_url( get_template_directory_uri() ); ?>/ajax/index.php">
                                <h2>Начните проект</h2>
                                <h4>С вами свяжется наш специалист</h4>
                                <input type="hidden" name="type" value="project_form">
                                <div class="form__input form__input--nicknames">
                                    <input required type="text" name="name" placeholder="Имя"/>
                                </div>
                                <div class="form__input form__input--nicknames">
                                    <input required type="text" name="phone" placeholder="Телефон"/>
                                </div>
                                <div class="form__input form__input--nicknames">
                                    <input required type="email" name="email" placeholder="Email"/>
                                </div>
                                <div class="form__button form__button--white">
                                    <button type="submit">Отправить</button>
                                    <p>Нажимая кнопку "Отправить", вы даете согласие на обработку <a href="/politika-konfidencialnosti">персональных данных</a></p>
                                </div>
                            </form>
                            <div class="form__ok">
                                <h2>СПАСИБО ЗА ЗАЯВКУ</h2>
                                <h4>С вами свяжется наш специалист</h4>
                                <a href="/portfolio.html" class="form__ok-a button button--blue">Портфолио</a>
                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/f1.png" alt="" class="form__ok-images">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal__menu__right">
                    <div class="modal__menu__right-list">
                        <?php
                        $menu = wp_get_nav_menu_items( get_nav_menu_locations()['home'], [
                            'output_key'  => 'menu_order',
                        ] );
                        ?>
                        <ul>
                            <? foreach ($menu as $item) : ?>
                                <li><a href="<?=$item->url?>"><?=$item->title?></a></li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="forms">
    <div class="modal__wrapper">
        <div class="modal__forms">
            <div class="modal__forms__wrapper">
                <div class="modal__forms-block">
                    <div class="modal__forms-close">
                        <a href="" class="button-close modal-link" data-type="forms">
                            <svg width="32" height="32" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <line x1="3.06066" y1="1.93934" x2="34.1734" y2="33.052" stroke="#2A54EA" stroke-width="3"></line>
                                <line x1="1.93934" y1="33.0521" x2="33.052" y2="1.93944" stroke="#2A54EA" stroke-width="3"></line>
                            </svg>
                        </a>
                    </div>
                    <div class="modal__forms-block-form">
                        <div class="form">
                            <form class="form__action form__action--active" action="<?php echo esc_url( get_template_directory_uri() ); ?>/ajax/index.php">
                                <h2>Начните проект</h2>
                                <h4>С вами свяжется наш специалист</h4>
                                <input type="hidden" name="type" value="project_form">
                                <div class="form__input">
                                    <input required type="text" name="name" placeholder="Имя"/>
                                </div>
                                <div class="form__input">
                                    <input required type="text" name="phone" placeholder="Телефон"/>
                                </div>
                                <div class="form__input">
                                    <input required type="email" name="email" placeholder="Email"/>
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
                    <div class="modal__forms-behance">
                        <a href="<?=get_post_meta(487, 'behance', true)?>">
                            <div class="modal__forms-behance__svg">
                                <svg width="42" height="25" viewBox="0 0 28 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24.9065 3.16714H17.7706V1.516H24.9065V3.16714ZM13.999 9.93446C14.4586 10.5993 14.6893 11.4074 14.6893 12.3522C14.6893 13.3328 14.4298 14.21 13.902 14.9855C13.5664 15.499 13.1487 15.9328 12.648 16.2811C12.0835 16.6847 11.4159 16.963 10.6486 17.1119C9.87787 17.2608 9.04508 17.3333 8.14763 17.3333H0.166687V0.833252H8.7235C10.8802 0.864989 12.4094 1.44683 13.3121 2.591C13.8539 3.29165 14.1222 4.13228 14.1222 5.10961C14.1222 6.1195 13.8496 6.92595 13.3034 7.53872C12.9993 7.88294 12.5501 8.19624 11.9542 8.47781C12.8568 8.78623 13.5411 9.26879 13.999 9.93446ZM4.25285 7.33853H8.00257C8.77331 7.33853 9.39637 7.201 9.87525 6.9292C10.355 6.65659 10.5944 6.1724 10.5944 5.47744C10.5944 4.71087 10.2781 4.20145 9.6428 3.9565C9.09664 3.78561 8.39843 3.69772 7.55166 3.69772H4.25285V7.33853ZM10.9553 12.1162C10.9553 11.2593 10.5787 10.6677 9.82806 10.3487C9.40861 10.1688 8.81613 10.0752 8.05675 10.0687H4.25285V14.4655H7.99645C8.76632 14.4655 9.36142 14.3728 9.79136 14.1758C10.5665 13.8178 10.9553 13.1334 10.9553 12.1162ZM27.5534 9.43236C27.6408 9.9727 27.6801 10.7556 27.6626 11.7793H18.4224C18.474 12.9674 18.9136 13.7974 19.7498 14.2727C20.2523 14.5705 20.8631 14.7162 21.5788 14.7162C22.333 14.7162 22.9473 14.5388 23.42 14.1742C23.6778 13.9805 23.905 13.7071 24.1008 13.3637H27.4887C27.3987 14.0643 26.9924 14.7748 26.2583 15.4998C25.1232 16.6472 23.531 17.2258 21.4862 17.2258C19.7953 17.2258 18.3071 16.7376 17.0147 15.77C15.7257 14.8 15.0791 13.2221 15.0791 11.0363C15.0791 8.98641 15.6611 7.41584 16.8268 6.32457C17.996 5.23005 19.5052 4.68564 21.3665 4.68564C22.4693 4.68564 23.4637 4.86874 24.3516 5.23738C25.2359 5.60764 25.9665 6.18867 26.5415 6.9878C27.0614 7.69171 27.397 8.50548 27.5534 9.43236ZM24.2179 9.74078C24.1576 8.91969 23.8622 8.29797 23.3309 7.87318C22.804 7.44595 22.1477 7.23274 21.3647 7.23274C20.5101 7.23274 19.8538 7.4606 19.3837 7.9098C18.9127 8.35981 18.6199 8.96851 18.4993 9.74078H24.2179Z" fill="#fff"></path>
                                </svg>
                            </div>
                            <div class="modal__forms-behance__text">ПОСМОТРЕТЬ НАШИ РАБОТЫ</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/script.js"></script>
<!--<script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>-->

<!-- Yandex.Metrika counter -->
<!--<script type="text/javascript">-->
<!--    (function (d, w, c) {-->
<!--        (w[c] = w[c] || []).push(function() {-->
<!--            try {-->
<!--                w.yaCounter38489875 = new Ya.Metrika({-->
<!--                    id:38489875,-->
<!--                    clickmap:true,-->
<!--                    trackLinks:true,-->
<!--                    accurateTrackBounce:true,-->
<!--                    webvisor:true-->
<!--                });-->
<!--            } catch(e) { }-->
<!--        });-->
<!---->
<!--        var n = d.getElementsByTagName("script")[0],-->
<!--            s = d.createElement("script"),-->
<!--            f = function () { n.parentNode.insertBefore(s, n); };-->
<!--        s.type = "text/javascript";-->
<!--        s.async = true;-->
<!--        s.src = "https://mc.yandex.ru/metrika/watch.js";-->
<!---->
<!--        if (w.opera == "[object Opera]") {-->
<!--            d.addEventListener("DOMContentLoaded", f, false);-->
<!--        } else { f(); }-->
<!--    })(document, window, "yandex_metrika_callbacks");-->
<!--</script>-->
<!--<noscript><div><img src="https://mc.yandex.ru/watch/38489875" style="position:absolute; left:-9999px;" alt="" /></div></noscript>-->
<!-- /Yandex.Metrika counter -->
<!--<script>-->
<!--        (function(w,d,u){-->
<!--                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);-->
<!--                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);-->
<!--        })(window,document,'https://cdn.bitrix24.ru/b7210707/crm/site_button/loader_2_0b5mbx.js');-->
<!--</script>-->
<?php //wp_footer(); ?>
</body>
</html>