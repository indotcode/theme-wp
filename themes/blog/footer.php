<section class="footer">
    <div class="container">
        <div class="item">
            <div class="logo">
                <a href="/"><img src="/img/logo.png" alt=""></a>
            </div>
            <div class="copy"><a href="/politika-konfidencialnosti">Политика конфиденциальности</a></div>
        </div>
        <div class="item">
            <div class="phone"><a href="tel:<?=get_post_meta(487, 'phone', true)?>"><?=get_post_meta(487, 'phone', true)?></a></div>
            <div class="email"><a href="mailto:<?=get_post_meta(487, 'email', true)?>"><?=get_post_meta(487, 'email', true)?></a></div>
            <div class="social">
                <a href="https://vk.com/unipromo" target="_blank"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/unipromo.web" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/unipromoweb" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</section>

<div class="modal" data-modal="0">
    <div class="delete" onclick="deleteModal(this)"></div>
    <div class="container" data-container>

    </div>
</div>

<?php if(wp_is_mobile()){ ?>
    <script src="/js/script-uni-mobile.min.js"></script>
<?php } else { ?>
    <script src="/js/script-uni.min.js"></script>
<?php } ?>
<script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter38489875 = new Ya.Metrika({
                    id:38489875,
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
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/38489875" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://cdn.bitrix24.ru/b7210707/crm/site_button/loader_2_0b5mbx.js');
</script>

<?php if(!wp_is_mobile()){ ?>
    <?php wp_footer(); ?>
<?php } ?>
</body>
</html>