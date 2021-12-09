<div class="footer">
    <div class="container">
        <div class="footer_top">
            <div class="col-md-4 box_3">
                <h3>Наши магазины</h3>
                <address class="address">
                    <p>У организации 3 филиала</p>
                    <dl>
                        <dt></dt>
                        <dd>Режим работы:</dd>
                        <dd>Пн-Сб: 10:00–19:00</dd>
                        <dd>Вс: 10:00-17:00</dd>
                    </dl>
                    <dl>
                        <dd>Телефон: <span> +7–960–915–77–00</span></dd>
                        <dd>Cправочная: <span>+7 (3843) 45–84–99</span></dd>
                    </dl>
                </address>
                <ul class="footer_social">
                    <li><a href="https://www.instagram.com/oboiplus_novokuzneck/" target="_blank" rel="nofollow"><i class="fa fa-instagram fa-1x"></i> </a></li>
                    <li><a href="https://vk.com/oboink" target="_blank" rel="nofollow"><i class="fa fa-vk fa-1x"></i> </a></li>
                    <li><a href="https://ok.ru/oboink.ru" target="_blank" rel="nofollow"><i class="fa fa-odnoklassniki-square fa-1x"></i> </a></li>
                </ul>
            </div>
            <div class="col-md-4 box_3">
                <h3>Новости и акции</h3>
                <?php
                $query_footer = new WP_Query(array(
                    'posts_per_page' => 3,
                    'taxonomy_name'=>'categoriya'
                ));
                ?>
                <?php while($query_footer->have_posts()) { $query_footer->the_post(); ?>
                    <h4><a href="<?php the_permalink()?>"><?php the_title()?></a></h4>
                    <p> <?=Format::Description(get_the_content(), 100)?></p>
                <?php } ?>
                <?php if($query_footer->post_count == 0){ ?>
                    <div class="none-blog">Новостей и акций нет!</div>
                <?php } ?>
                <?php wp_reset_postdata();?>
            </div>
            <div class="col-md-4 box_3">
                <h3>Меню</h3>
                <ul class="list_1">
                    <li><a href="/goods">Обои</a></li>
                    <li><a href="/novosti">Новости</a></li>
                    <li><a href="/aktsii">Акции</a></li>
                </ul>
                <ul class="list_1">
                    <li><a href="/kontaktyi">Контакты</a></li>
                    <li><a href="/processing-personal-data">Политика защиты и обработки персональных данных</a></li>
                </ul>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="footer_bottom">
            <div class="copy">
                <p>© 2018 oboink.ru. Разработано веб-студией <a href="http://unipromo.ru" target="_blank">UNIPROMO</a> </p>
            </div>
        </div>
    </div>
</div>
<div class="error-item"></div>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/script.min.js"></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter49393813 = new Ya.Metrika2({
                    id:49393813,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/49393813" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'qaA7jSU9Vl';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
s.src = '//code.jivosite.com/script/widget/'+widget_id
; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}
if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}
else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->
<?php wp_footer(); ?>
</body>
</html>
