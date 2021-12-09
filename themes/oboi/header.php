<!DOCTYPE HTML>
<html>
<head>
    <title><?php wp_title()?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <link href='http://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/style.min.css">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    
    <?php wp_head(); ?>


    <?php if(is_singular('goods')){ ?>
        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
        <script src="//yastatic.net/share2/share.js"></script>
    <?php } ?>
</head>
<body <?php body_class(); ?>>
<div class="new_header">
        <div class="one_header">
            <div class="block_header">
                <div class="info_header">
                    <span class="phone_header"><b>Телефон: </b> <a href="tel:+7–960–915–77–00">+7–960–915–77–00</a></span>
<!--                    <span class="email_header"><b>Email: </b> <a href="mailto:oboi-plus@yandex.ru"></a>oboi-plus@yandex.ru</span>-->
                </div>
                <div class="header__address">
                    <div class="header__address__item">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        Курако проспект, 3
                    </div>
                    <div class="header__address__item">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        Металлургов проспект, 46
                    </div>
                    <div class="header__address__item">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        Запорожская, 79
                    </div>
                </div>
<!--                <div class="social_header">-->
<!--                    <a href="https://www.instagram.com/oboiplus_novokuzneck/" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i> </a>-->
<!--                    <a href="https://vk.com/oboink" target="_blank" rel="nofollow"><i class="fa fa-vk"></i> </a>-->
<!--                    <a href="https://ok.ru/oboink.ru" target="_blank" rel="nofollow"><i class="fa fa-odnoklassniki-square"></i> </a>-->
<!--                </div>-->
            </div>
        </div>
        <div class="two_header">
            <div class="block_header">
                <div class="logo_header">
                    <a href="/"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/images51.png" alt=""></a>
                </div>
                <div class="menu_header">
                    <ul class="menu_list_header">
                        <li>
                            <span>Каталог <i class="fa fa-angle-down" aria-hidden="true"></i></span>
                            <ul class="full">
                                <?php foreach (get_terms(array('taxonomy' => 'cats', 'hide_empty' => false, 'parent' => 0)) as $key => $val){ ?>
                                    <li><a href="<?=get_term_link($val->term_id)?>" data-cat="<?=$val->term_id?>" onclick="LoadCatLink(this)"><i class="fa fa-angle-right" aria-hidden="true"></i><?=$val->name?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li><a class="color5" href="/statii">Статьи</a></li>
                        <li><a class="color7" href="/aktsii">Акции</a></li>
                        <li><a class="color6" href="/kontaktyi">Контакты</a></li>
                    </ul>
                    <ul class="menu_list_header_mobile">
                        <li>
                            <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                            <ul>
                                <li><a class="color5" href="/goods"><i class="fa fa-angle-right" aria-hidden="true"></i>Каталог</a></li>
                                <li><a class="color5" href="/statii"><i class="fa fa-angle-right" aria-hidden="true"></i>Статьи</a></li>
                                <li><a class="color7" href="/aktsii"><i class="fa fa-angle-right" aria-hidden="true"></i>Акции</a></li>
                                <li><a class="color6" href="/kontaktyi"><i class="fa fa-angle-right" aria-hidden="true"></i> Контакты</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="search_header">
                        <span><i class="fa fa-search" aria-hidden="true"></i></span>
                        <form action="/goods" method="post">
                            <input autocomplete="off" type="text" name="search" value="<?=isset($_POST['search']) ? $_POST['search'] : ''?>" placeholder="Поиск">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <div class="basket__top" data-changes="basket__top">
                        <?php
                        include Router::Root() . '/ajax-temp/basket-top.php'
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
