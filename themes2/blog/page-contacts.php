<?php get_header(); ?>
<section class="contact-page">
    <div class="container">
        <div class="map">
            <div class="content">
                <div class="info">
                    <h2>Контакты</h2>
                    <div class="list">
                        <div class="item">
                            <h4>Адрес:</h4>
                            <p><?=get_post_meta(get_the_ID(), 'address', 1)?></p>
                        </div>
                        <div class="item">
                            <h4>Телефон:</h4>
                            <p><a href="tel:<?=get_post_meta(get_the_ID(), 'phone', 1)?>"><?=get_post_meta(get_the_ID(), 'phone', 1)?></a></p>
                        </div>
                        <div class="item">
                            <h4>E-mail:</h4>
                            <p><a href="mailto:<?=get_post_meta(get_the_ID(), 'email', 1)?>"><?=get_post_meta(get_the_ID(), 'email', 1)?></a></p>
                        </div>
                    </div>
                    <div class="add-requisites"><span>Показать реквизиты</span> <i class="fa fa-angle-right" aria-hidden="true"></i></div>
                </div>
                <div class="requisites">
                    <div class="block">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        <h3>Реквизиты ИП <?=get_post_meta(get_the_ID(), 'ip', 1)?></h3>
                        <div class="elements">
                            <div class="elem">
                                <span>ОГРНИП:</span>
                                <span><?=get_post_meta(get_the_ID(), 'ogrn-ip', 1)?></span>
                            </div>
                            <div class="elem">
                                <span>ИНН:</span>
                                <span><?=get_post_meta(get_the_ID(), 'inn', 1)?></span>
                            </div>
                            <div class="elem">
                                <span>Расчётный счёт:</span>
                                <span><?=get_post_meta(get_the_ID(), 'rs', 1)?></span>
                            </div>
                            <div class="elem">
                                <span>Отделение банка:</span>
                                <span><?=get_post_meta(get_the_ID(), 'od', 1)?></span>
                            </div>
                            <div class="elem">
                                <span>БИК:</span>
                                <span><?=get_post_meta(get_the_ID(), 'bik', 1)?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="gis" style="width: 100%;height: 100%"></div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
