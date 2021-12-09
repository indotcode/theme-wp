<?php get_header(); ?>

<div class="bread-crumbs bread-crumbs--header">
    <div class="wrapper bread-crumbs__wrapper">
        <div class="bread-crumbs__list">
            <div class="bread-crumbs__item">
                <a href="/">Главная</a>
            </div>
            <div class="bread-crumbs__separator"></div>
            <div class="bread-crumbs__item">
                <span>Услуги</span>
            </div>
        </div>
    </div>
</div>

<div class="heading heading--mb-30">
    <div class="wrapper heading__wrapper">
        <div class="heading__title heading__title--short">
            <h1>Услуги</h1>
        </div>
    </div>
</div>

<div class="services">
        <div class="wrapper services__wrapper">
            <div class="services__list services__list--mt-0 services__list--mb-50">
                <? foreach (App::ServicesHome() as $key => $val) :
                    if($key == 0){
                        $class = 'services__item--blue';
                    } else {
                        $class = 'services__item--white';
                    }
                    ?>
                    <div class="services__item <?=$class?>">
                        <div class="services__item-title">
                            <a href="<?php the_permalink($val->home_post)?>"><?=$val->name?></a>
                        </div>
                        <? if(count($val->post) != 0) : ?>
                            <div class="services__item-elem">
                                <ul>
                                    <? foreach ($val->post as $id) : ?>
                                        <li><a href="<?php the_permalink($id)?>"><?=get_the_title($id)?></a></li>
                                    <? endforeach; ?>
                                </ul>
                            </div>
                        <? endif; ?>
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/f<?=$key+1?>.png" alt="" class="services__mobile-images services__mobile-images--<?=in_array($key+1, [2, 3]) ? 'two' : 'one'?>">
                    </div>
                    <div class="services__item services__item--empty">
                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/f<?=$key+1?>.png" alt="" class="services__item__images services__item__images--<?=in_array($key+1, [2, 3]) ? 'two' : 'one'?>">
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>

<?php include "include/footer-block.php"?>

<?php get_footer(); ?>