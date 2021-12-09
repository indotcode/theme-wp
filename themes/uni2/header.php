<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <?php Seo::Title();?>
    <meta name="yandex-verification" content="5caaaa846f5267c4" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/css/style.css">
    <link rel="icon" href="/img/favicon/favicon.ico" type="image/x-icon">
<!--    --><?php //wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="header header--fixed">
    <div class="wrapper header__wrapper">
        <a class="header__logo" href="/"></a>
        <a href="" class="header__burger modal-link" data-type="menu">
            <span></span>
            <span></span>
            <span></span>
        </a>
        <a href="tel:<?=get_post_meta(487, 'phone', true)?>" class="header__phone" ><?=get_post_meta(487, 'phone', true)?></a>
    </div>
</div>
