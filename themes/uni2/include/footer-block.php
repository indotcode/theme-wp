<div class="footer">
    <div class="wrapper footer__wrapper">
        <div class="footer__block">
            <div class="footer__logos">
                <a href="/" class="footer__logo-copy">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-footer.png" alt="">
                    &#169; 2019 UNIPROMO
                </a>
                <a href="/politika-konfidencialnosti" class="footer__policy">Политика конфиденциальности</a>
            </div>
            <div class="footer__menu">
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
            <div class="footer__social">
                <?php
                App::social('blue');
                ?>
            </div>
        </div>
    </div>
</div>