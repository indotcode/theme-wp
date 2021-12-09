<?php
App::Rederect();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <?php Seo::Title();?>
    <meta name="yandex-verification" content="5caaaa846f5267c4" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php if(wp_is_mobile()){ ?>
        <link rel="stylesheet" href="/css/uni-mobile.min.css">
        <meta name="viewport" content="width=device-width">
    <?php } else { ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/css/uni.min.css">
    <?php } ?>
    <?php if(is_singular('post')){ ?>
        <script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
    <?php } ?>
    <link rel="icon" href="/img/favicon/favicon.ico" type="image/x-icon">
    <?php wp_head(); ?>
    <?php if(wp_is_mobile()){ ?>
        <style>html{margin-top: 0 !important;}</style>
    <?php } ?>
</head>
<body <?php body_class(); ?>>

<div class="loader">
<!--    <div>U</div>-->
    <div class="cssload-thecube">
        <div class="cssload-cube cssload-c1"></div>
        <div class="cssload-cube cssload-c2"></div>
        <div class="cssload-cube cssload-c4"></div>
        <div class="cssload-cube cssload-c3"></div>
    </div>
</div>


<?php if(wp_is_mobile()){ ?>
    <a class="menu-mobile" href="javascript:;" onclick="addModal('menuMobile')"><i class="fa fa-bars" aria-hidden="true"></i></a>
<?php } else { ?>
<section class="header">
    <div class="container">
        <div class="logo">
            <a href="/"><img src="/img/logo.png" alt=""></a>
        </div>
        <div class="menu">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="/kompany/">О нас</a></li>
                <li><a href="/portfolio/">Портфолио</a></li>
                <li><a href="/services/">Услуги</a></li>
                <li><a href="/category/blog/">Блог</a></li>
                <li><a href="/contacts/">Контакты</a></li>
            </ul>
        </div>
        <div class="contact">
            <div class="phone"><span><a href="tel:<?=get_post_meta(487, 'phone', true)?>"><?=get_post_meta(487, 'phone', true)?></a></span></div>
            <a class="request-call" href="javascript:;" onclick="addModal('startProject')">Начать проект</a>
        </div>
    </div>
</section>
<?php } ?>
