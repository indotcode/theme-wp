<?php get_header(); ?>
<?php
while (have_posts() ) { the_post();
    ?>
    <div class="bread-crumbs bread-crumbs--header">
        <div class="wrapper bread-crumbs__wrapper">
            <div class="bread-crumbs__list">
                <div class="bread-crumbs__item">
                    <a href="/">Главная</a>
                </div>
                <div class="bread-crumbs__separator"></div>
                <div class="bread-crumbs__item">
                    <a href="/portfolio">Портфолио</a>
                </div>
                <div class="bread-crumbs__separator"></div>
                <div class="bread-crumbs__item">
                    <span><?php the_title()?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="heading">
        <div class="wrapper heading__wrapper heading__wrapper--flex">
            <div class="heading__title heading__title--fiw">
                <h1><?php the_title()?></h1>
            </div>
            <? if(get_post_meta(get_the_ID(), 'link', true) != '') : ?>
                <div class="heading__behanse">
                    <a href="<?=get_post_meta(get_the_ID(), 'link', true)?>" rel="nofollow" target="_blank" class="button-behanse">Смотреть проект</a>
                </div>
            <? endif; ?>
            <div class="heading__navigate">
                <?php
                $prev = get_adjacent_post(false, '', true, 'portfolio-categories');
                $next = get_adjacent_post(false, '', false, 'portfolio-categories');
                ?>
                <a href="<?php the_permalink($prev->ID)?>" class="heading__navigate-prev"></a>
                <a href="<?php the_permalink($next->ID)?>" class="heading__navigate-next"></a>
            </div>
        </div>
    </div>

    <div class="portfolio-single">
        <div class="wrapper portfolio-single__wrapper">
            <? if(get_post_meta(get_the_ID(), 'task', true) != '' || get_post_meta(get_the_ID(), 'desc', true) != '') : ?>
                <div class="portfolio-single__info">
                    <? if(get_post_meta(get_the_ID(), 'task', true) != '') : ?>
                        <div class="portfolio-single__info-item">
                            <div class="portfolio-single__info-title">Задача</div>
                            <div class="portfolio-single__info-text">
                                <?=get_post_meta(get_the_ID(), 'task', true)?>
                            </div>
                        </div>
                    <? endif; ?>

                    <? if(get_post_meta(get_the_ID(), 'desc', true) != '') : ?>
                        <div class="portfolio-single__info-item">
                            <div class="portfolio-single__info-title">Описание</div>
                            <div class="portfolio-single__info-text">
                                <?=get_post_meta(get_the_ID(), 'desc', true)?>
                            </div>
                        </div>
                    <? endif; ?>
                </div>
            <? endif; ?>
            <? if(count(get_post_meta(get_the_ID(), 'slider', 0)) != 0) : ?>
                <div class="portfolio-single__carousel owl-carousel">
                    <? foreach (get_post_meta(get_the_ID(), 'slider', 0) as $item) : ?>
                        <div class="portfolio-single__carousel-item">
                            <img src="<?=$item['guid']?>" alt="">
                        </div>
                    <? endforeach; ?>
                </div>
            <? endif; ?>
        </div>
        <? if(get_post_meta(get_the_ID(), 'implemented', 1) != ''
            && count(get_post_meta(get_the_ID(), 'implemented-images', 0)) != 0
            && get_post_meta(get_the_ID(), 'prototipirovaniye-images', 1) != ''
            && get_post_meta(get_the_ID(), 'prototipirovaniye', 1) != ''
            ) : ?>
            <div class="portfolio-single__design">
                <div class="wrapper portfolio-single__design-wrapper">
                    <div class="portfolio-single__design-block">
                        <div class="portfolio-single__design-implemented portfolio-single__design-block-item">
                            <h2>Реализовано</h2>
                            <div class="portfolio-single__design-implemented__text">
                                <?=get_post_meta(get_the_ID(), 'implemented', 1)?>
                            </div>
                        </div>
                        <div class="portfolio-single__design-mobility portfolio-single__design-block-item">
                            <? foreach (get_post_meta(get_the_ID(), 'implemented-images', 0) as $item) : ?>
                                <div class="portfolio-single__design-mobility__images">
                                    <img src="<?=$item['guid']?>" alt="">
                                </div>
                            <? endforeach; ?>
                        </div>
                        <div class="portfolio-single__design-prototip portfolio-single__design-block-item">
                            <div class="portfolio-single__design-prototip-images">
                                <img src="<?=get_post_meta(get_the_ID(), 'prototipirovaniye-images', 1)['guid']?>" alt="">
                            </div>
                        </div>
                        <div class="portfolio-single__design-prototip-info portfolio-single__design-block-item">
                            <h2>Прототипирование</h2>
                            <div class="portfolio-single__design-prototip-info__text">
                                <?=get_post_meta(get_the_ID(), 'prototipirovaniye', 1)?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <? endif; ?>
    </div>

    <div class="portfolio-single portfolio-single--bg mt-50">
        <div class="wrapper portfolio-single__wrapper">
            <div class="portfolio-single__stages">
                <div class="portfolio-single__stages-list">
                    <div class="portfolio-single__stages-item">
                        <div class="portfolio-single__stages-item__number">01</div>
                        <div class="portfolio-single__stages-item__info">
                            <h2>Продажи</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. P</p>
                        </div>
                    </div>
                    <div class="portfolio-single__stages-item">
                        <div class="portfolio-single__stages-item__number">02</div>
                        <div class="portfolio-single__stages-item__info">
                            <h2>Посещяемость</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. P</p>
                        </div>
                    </div>
                    <div class="portfolio-single__stages-item">
                        <div class="portfolio-single__stages-item__number">03</div>
                        <div class="portfolio-single__stages-item__info">
                            <h2>Конверсия</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. P</p>
                        </div>
                    </div>
                </div>
                <div class="portfolio-single__stages-button">
                    <a href="/portfolio.html" class="button button--blue">Все проекты</a>
                </div>
            </div>
        </div>
    </div>

    <?php
    }
wp_reset_postdata();
include "include/application.php";
include "include/footer-block.php";
get_footer();