<footer class="footer">
    <div class="footer__wrapper footer__wrapper--first wrapper">
        <div class="footer__object">
            <?php
            $items = wp_get_nav_menu_items(3);
            foreach ($items as $key => $val){
                ?>
                <a class="footer__object-link" href="<?=$val->url?>"><?=$val->title?></a>
                <?php
            }
            ?>
        </div>
        <div class="footer__catogory">
            <?php
            $items = wp_get_nav_menu_items(24);
            foreach ($items as $key => $val){
                ?>
                <a class="footer__catogory-link" href="<?=$val->url?>"><?=$val->title?></a>
                <?php
            }
            ?>
        </div>
        <div class="footer__form-wrapper">
            <span class="footer__form-description">Получите консультацию нашего специалиста</span>
            <a class="footer__btn btn" href="">Получить консультацию</a>
            <form class="footer__forms ajax-jq" action="/wp-ajax/index.php" method="post">
                <input required name="type" type="hidden" value="form">
                <input required name="request" type="hidden" value="to_get_consultation">
                <input required name="title" type="hidden" value="Получить консультацию">
                <div>
                    <input required type="text" name="phone" placeholder="+7 (___) ___-__-__">
                    <button onclick="yaCounter49393813.reachGoal('zakaz'); return true;" class="btn" type="submit">Отправить</button>
                </div>
                <span class="footer__forms-consert">Нажимая кнопку «Отправить», вы даете согласие на обработку <a href="/processing-personal-data">персональных данных</a></span>
            </form>
        </div>
    </div>

    <div class="footer__inner">
        <div class="footer__wrapper footer__wrapper--bootom wrapper">
            <a class="footer__web-logo" href="https://unipromo.ru">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/logo/logo-studio.svg" alt="">
            </a>

            <div class="footer__socials socials">
                <?php if(get_post_meta(173, 'vk', 1) != ''){ ?>
                    <a href="<?=get_post_meta(173, 'vk', 1)?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" y="0.5" width="23" height="23" rx="11.5" fill="white" stroke="#BDBDBD"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.8711 15.4707H12.5884C12.5884 15.4707 12.8051 15.4464 12.9157 15.3244C13.0175 15.2125 13.0143 15.0023 13.0143 15.0023C13.0143 15.0023 13.0002 14.0181 13.4469 13.8732C13.8873 13.7305 14.4527 14.8244 15.0521 15.245C15.5053 15.5633 15.8497 15.4935 15.8497 15.4935L17.4522 15.4707C17.4522 15.4707 18.2905 15.4179 17.893 14.7439C17.8605 14.6888 17.6615 14.2453 16.7015 13.3342C15.6967 12.3805 15.8313 12.5348 17.0417 10.8851C17.7788 9.88052 18.0735 9.26718 17.9815 9.00449C17.8937 8.75429 17.3515 8.82042 17.3515 8.82042L15.5472 8.83191C15.5472 8.83191 15.4134 8.81326 15.3142 8.87389C15.2173 8.93336 15.1549 9.07195 15.1549 9.07195C15.1549 9.07195 14.8693 9.84937 14.4884 10.5105C13.6849 11.9056 13.3637 11.9792 13.2324 11.8926C12.9269 11.6907 13.0032 11.0815 13.0032 10.6488C13.0032 9.29683 13.2037 8.73313 12.6127 8.58721C12.4165 8.53874 12.2722 8.50675 11.7706 8.50159C11.1268 8.49476 10.5819 8.50359 10.2733 8.65817C10.0681 8.76095 9.90971 8.99 10.0062 9.00316C10.1254 9.01948 10.3955 9.07762 10.5387 9.27701C10.7236 9.5342 10.7171 10.1119 10.7171 10.1119C10.7171 10.1119 10.8233 11.7034 10.469 11.9011C10.2258 12.0367 9.89212 11.7598 9.17581 10.4942C8.80878 9.84587 8.53167 9.12925 8.53167 9.12925C8.53167 9.12925 8.47824 8.99533 8.38294 8.9237C8.26727 8.83691 8.10567 8.80926 8.10567 8.80926L6.39106 8.82075C6.39106 8.82075 6.13366 8.82808 6.03917 8.94252C5.95511 9.0443 6.03249 9.25485 6.03249 9.25485C6.03249 9.25485 7.37486 12.4661 8.89479 14.0844C10.2885 15.5681 11.8711 15.4707 11.8711 15.4707Z" fill="#BDBDBD"/>
                        </svg>
                    </a>
                <?php } ?>
                <?php if(get_post_meta(173, 'ok', 1) != ''){ ?>
                    <a href="<?=get_post_meta(173, 'ok', 1)?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 23.5C5.64873 23.5 0.5 18.3513 0.5 12C0.5 5.64873 5.64873 0.5 12 0.5C18.3513 0.5 23.5 5.64873 23.5 12C23.5 18.3513 18.3513 23.5 12 23.5Z" fill="white" stroke="#BDBDBD"/>
                            <path d="M13.7762 12.8303C13.861 12.7964 13.9803 12.7356 14.1145 12.6673C14.425 12.5091 14.8151 12.3104 15.0407 12.3104C15.968 12.3104 16.4457 13.5047 15.7573 14.151C15.4482 14.446 14.0291 15.0923 13.5093 15.1064C13.7308 15.4281 14.1148 15.7777 14.508 16.1356C15.162 16.7309 15.8416 17.3495 15.8416 17.9023C15.8416 18.3097 15.4763 18.7874 15.0548 18.8998C14.4928 19.0544 14.1275 18.7593 13.8324 18.4502C13.7625 18.3779 13.6756 18.2865 13.5776 18.1834L13.5769 18.1827C13.1037 17.6851 12.3714 16.915 12.0341 16.694C11.7112 16.9131 10.9717 17.6907 10.4918 18.1955L10.4908 18.1965C10.3864 18.3063 10.2944 18.4031 10.2216 18.4783C9.18193 19.5461 8.24059 18.5626 8.24059 17.832C8.24059 17.3835 8.92889 16.7444 9.57743 16.1423C9.98536 15.7635 10.3776 15.3993 10.5729 15.1064C10.039 15.0923 8.56374 14.4039 8.29679 14.1229C7.60835 13.3782 8.22654 12.3104 9.04143 12.3104C9.21602 12.3104 9.45827 12.4232 9.76846 12.5676C10.6066 12.9578 11.9407 13.5789 13.7762 12.8303Z" fill="#BDBDBD"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7762 12.8303C13.861 12.7964 13.9803 12.7356 14.1145 12.6673C14.425 12.5091 14.8151 12.3104 15.0407 12.3104C15.968 12.3104 16.4457 13.5047 15.7573 14.151C15.4482 14.446 14.0291 15.0923 13.5093 15.1064C13.7308 15.4281 14.1148 15.7777 14.508 16.1356C15.162 16.7309 15.8416 17.3495 15.8416 17.9023C15.8416 18.3097 15.4763 18.7874 15.0548 18.8998C14.4928 19.0544 14.1275 18.7593 13.8324 18.4502C13.7625 18.3779 13.6756 18.2865 13.5776 18.1834L13.5769 18.1827C13.1037 17.6851 12.3714 16.915 12.0341 16.694C11.7112 16.9131 10.9717 17.6907 10.4918 18.1955L10.4908 18.1965C10.3864 18.3063 10.2944 18.4031 10.2216 18.4783C9.18193 19.5461 8.24059 18.5626 8.24059 17.832C8.24059 17.3835 8.92889 16.7444 9.57743 16.1423C9.98536 15.7635 10.3776 15.3993 10.5729 15.1064C10.039 15.0923 8.56374 14.4039 8.29679 14.1229C7.60835 13.3782 8.22654 12.3104 9.04143 12.3104C9.21602 12.3104 9.45827 12.4232 9.76846 12.5676C10.6066 12.9578 11.9407 13.5789 13.7762 12.8303ZM8.45134 8.57317C8.45134 7.81448 8.73234 7.04173 9.11168 6.50784L9.42078 6.15659C9.77203 5.77725 10.0811 5.52435 10.5729 5.3136C11.5283 4.87805 12.5539 4.8921 13.5093 5.3136C15.7011 6.28304 16.4317 9.30376 14.6333 11.0881C13.6779 12.0435 12.9894 12.1699 11.7109 12.1699C10.1514 12.1699 8.45134 10.5823 8.45134 8.57317ZM12.0621 10.0776C12.9118 10.0776 13.6006 9.3888 13.6006 8.53913C13.6006 7.68946 12.9118 7.00067 12.0621 7.00067C11.2125 7.00067 10.5237 7.68946 10.5237 8.53913C10.5237 9.3888 11.2125 10.0776 12.0621 10.0776Z" fill="#BDBDBD"/>
                        </svg>
                    </a>
                <?php } ?>
                <?php if(get_post_meta(173, 'whatsapp', 1) != ''){ ?>
                    <a href="<?=get_post_meta(173, 'whatsapp', 1)?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" y="0.5" width="23" height="23" rx="11.5" fill="white" stroke="#BDBDBD"/>
                            <path d="M12.0015 6H11.9985C8.69025 6 6 8.691 6 12C6 13.3125 6.423 14.529 7.14225 15.5168L6.3945 17.7458L8.70075 17.0085C9.6495 17.637 10.7812 18 12.0015 18C15.3097 18 18 15.3082 18 12C18 8.69175 15.3097 6 12.0015 6ZM15.4928 14.4727C15.348 14.8815 14.7735 15.2205 14.3153 15.3195C14.0017 15.3862 13.5922 15.4395 12.2137 14.868C10.4505 14.1375 9.315 12.3457 9.2265 12.2295C9.14175 12.1132 8.514 11.2808 8.514 10.4198C8.514 9.55875 8.95125 9.1395 9.1275 8.9595C9.27225 8.81175 9.5115 8.74425 9.741 8.74425C9.81525 8.74425 9.882 8.748 9.942 8.751C10.1182 8.7585 10.2067 8.769 10.323 9.04725C10.4678 9.396 10.8203 10.257 10.8622 10.3455C10.905 10.434 10.9478 10.554 10.8878 10.6702C10.8315 10.7903 10.782 10.8435 10.6935 10.9455C10.605 11.0475 10.521 11.1255 10.4325 11.235C10.3515 11.3302 10.26 11.4323 10.362 11.6085C10.464 11.781 10.8165 12.3562 11.3355 12.8182C12.0052 13.4145 12.5482 13.605 12.7425 13.686C12.8872 13.746 13.0598 13.7318 13.1655 13.6193C13.2997 13.4745 13.4655 13.2345 13.6342 12.9983C13.7543 12.8288 13.9058 12.8077 14.0648 12.8677C14.2268 12.924 15.084 13.3477 15.2603 13.4355C15.4365 13.524 15.5527 13.566 15.5955 13.6403C15.6375 13.7145 15.6375 14.0632 15.4928 14.4727Z" fill="#BDBDBD"/>
                        </svg>
                    </a>
                <?php } ?>
                <?php if(get_post_meta(173, 'instagram', 1) != ''){ ?>
                    <a href="<?=get_post_meta(173, 'instagram', 1)?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" y="0.5" width="23" height="23" rx="11.5" fill="white" stroke="#BDBDBD"/>
                            <path d="M14.25 6H9.75C7.67925 6 6 7.67925 6 9.75V14.25C6 16.3208 7.67925 18 9.75 18H14.25C16.3208 18 18 16.3208 18 14.25V9.75C18 7.67925 16.3208 6 14.25 6ZM16.875 14.25C16.875 15.6975 15.6975 16.875 14.25 16.875H9.75C8.3025 16.875 7.125 15.6975 7.125 14.25V9.75C7.125 8.3025 8.3025 7.125 9.75 7.125H14.25C15.6975 7.125 16.875 8.3025 16.875 9.75V14.25Z" fill="#BDBDBD"/>
                            <path d="M14.25 6H9.75C7.67925 6 6 7.67925 6 9.75V14.25C6 16.3208 7.67925 18 9.75 18H14.25C16.3208 18 18 16.3208 18 14.25V9.75C18 7.67925 16.3208 6 14.25 6ZM16.875 14.25C16.875 15.6975 15.6975 16.875 14.25 16.875H9.75C8.3025 16.875 7.125 15.6975 7.125 14.25V9.75C7.125 8.3025 8.3025 7.125 9.75 7.125H14.25C15.6975 7.125 16.875 8.3025 16.875 9.75V14.25Z" fill="#BDBDBD"/>
                            <path d="M15.2249 9.1745C15.4457 9.1745 15.6247 8.99552 15.6247 8.77475C15.6247 8.55397 15.4457 8.375 15.2249 8.375C15.0042 8.375 14.8252 8.55397 14.8252 8.77475C14.8252 8.99552 15.0042 9.1745 15.2249 9.1745Z" fill="#BDBDBD"/>
                            <path d="M12 9C10.3432 9 9 10.3432 9 12C9 13.6568 10.3432 15 12 15C13.6568 15 15 13.6568 15 12C15 10.3432 13.6568 9 12 9ZM12 13.875C10.9665 13.875 10.125 13.0335 10.125 12C10.125 10.9657 10.9665 10.125 12 10.125C13.0335 10.125 13.875 10.9657 13.875 12C13.875 13.0335 13.0335 13.875 12 13.875Z" fill="#BDBDBD"/>
                        </svg>
                    </a>
                <?php } ?>
            </div>

            <div class="footer__business-container">
                <span class="footer__copyright">© 2020 ОБОИPLUS</span>
                <a class="footer__privacy" href="/processing-personal-data">
                    Политика защиты и обработки персональных данных
                </a>
            </div>
        </div>
    </div>
</footer>
<div class="model model--top">
    <div class="model__bg model__close"></div>
    <div class="model__wrapper">
        <a class="basket__card-close model__close" href="">
            <button type="submit">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L11 11" stroke="white" stroke-linecap="round"/>
                    <path d="M1 11L11 0.999999" stroke="white" stroke-linecap="round"/>
                </svg>
            </button>
        </a>
        <div class="model__wrapper-object">
            <form action="/wp-ajax/index.php" method="post" class="basket__form-model ajax-jq">
                <span class="basket__form-info-title">
                    Заказать звонок
                </span>
                <input required name="type" type="hidden" value="form"/>
                <input required name="request" type="hidden" value="request_call"/>
                <input required name="title" type="hidden" value="Заказать звонок"/>
                <div class="basket__form-wrapper">
                    <label for="name">Имя</label>
                    <input required class="basket__form-input" name="name" id="name" type="text" placeholder="Введите имя"/>
                </div>
                <div class="basket__form-wrapper">
                    <label for="phone">Телефон</label>
                    <input required class="basket__form-input" name="phone" id="phone" type="text" placeholder="+7 (___) ___-__-__"/>
                </div>
                <div class="basket__form-wrapper basket__form-wrapper--btn">
                    <button class="btn basket__btn" onclick="yaCounter49393813.reachGoal('zakaz'); return true;" type="submit">Отправить</button>
                </div>
                <div class="basket__form-wrapper basket__form-wrapper--text">
                    Нажимая кнопку «Отправить», вы даете согласие на обработку <a href="/processing-personal-data">персональных данных</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="back_to_top" title="Наверх">
    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/arrow-circle-up.png" alt=""/>
</div>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/script.js"></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(49393813, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/49393813" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<?php wp_footer(); ?>
</body>
</html>
