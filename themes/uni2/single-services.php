<?php get_header();
$post = get_queried_object();
$block = get_post_meta($post->ID, 'block', true);
$tariffs = Tariffs::ResultTab(get_post_meta($post->ID, 'rate', true))['tab'][0]['result'];
//echo '<pre>';
//print_r($block);
//echo '</pre>';
?>

<div class="bread-crumbs bread-crumbs--header">
    <div class="wrapper bread-crumbs__wrapper">
        <div class="bread-crumbs__list">
            <div class="bread-crumbs__item">
                <a href="/">Главная</a>
            </div>
            <div class="bread-crumbs__separator"></div>
            <div class="bread-crumbs__item">
                <a href="/services">Услуги</a>
            </div>
            <div class="bread-crumbs__separator"></div>
            <div class="bread-crumbs__item">
                <span><?=$post->post_title?></span>
            </div>
        </div>
    </div>
</div>

<div class="heading">
    <div class="wrapper heading__wrapper">
        <div class="heading__title heading__title--short">
            <h1><?=$post->post_title?></h1>
        </div>
        <div class="heading__menu">
            <div class="menu__archive">
                <ul class="menu__archive-ul">
                    <? foreach (App::list_term_post($post->ID) as $key => $val) : ?>
                        <li class="menu__archive-li">
                            <a href="<?=get_permalink($val->ID)?>"><?=$val->post_title?></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php if(in_array('Тарифы', $block) && count($tariffs) > 1):
    $day = new ConvertingNumNames();
    ?>
    <div class="ready-made-solutions">
        <div class="wrapper ready-made-solutions__wrapper">
            <div class="ready-made-solutions__list">
                <? foreach ($tariffs as $key => $val) : ?>
                    <a href="/services.html" class="ready-made-solutions__list-item modal-link <?=($key % 2) == 1 ? 'ready-made-solutions__list-item--blue': ''?>" data-type="forms">
                        <div class="ready-made-solutions__list-item__title">
                            <span><?=$val['name']?></span>
                        </div>
                        <div class="ready-made-solutions__list-item__meta">
                            <div class="ready-made-solutions__list-item__meta-item">
                                <span>Цена</span>
                                <span><?=$day->key(['руб.', 'руб.', 'руб.', 'руб.'])->number($val['price'], ['type' => 'price'])->register(1)->pre('от')->get()?></span>
                            </div>
                            <? if($val['date'] != ''): ?>
                                <div class="ready-made-solutions__list-item__meta-item">
                                    <span>Время работы</span>
                                    <span>
                                        <?=$day->key($val['date-name'])->number($val['date'])->register(1)->pre('от')->get()?>
                                    </span>
                                </div>
                            <? endif; ?>
                        </div>
                        <? if(count($val['result']) != 0): ?>
                            <div class="ready-made-solutions__list-item__list">
                                <ul>
                                    <? foreach ($val['result'] as $item): ?>
                                        <li><?=$item['tag']?></li>
                                    <? endforeach; ?>
                                </ul>
                            </div>
                        <? endif; ?>
                    </a>
                <? endforeach; ?>
            </div>
        </div>
    </div>
<?php elseif (count($tariffs) < 2) :
    $day = new ConvertingNumNames();
    ?>
    <div class="maintenance">
        <div class="wrapper maintenance__wrapper">
            <?php foreach ($tariffs as $key => $val) : ?>
                <div class="maintenance__block">
                    <h3>Обслуживание сайтов</h3>
                    <div class="maintenance__block-list">
                        <div class="maintenance__block-item">
                            <div class="maintenance__block-item-title">Цена</div>
                            <div class="maintenance__block-item-params"><?=$day->key(['руб.', 'руб.', 'руб.', 'руб.'])->number($val['price'], ['type' => 'price'])->register(1)->pre('от')->get()?></div>
                        </div>
                        <? if($val['date'] != ''): ?>
                            <div class="maintenance__block-item">
                                <div class="maintenance__block-item-title">Период</div>
                                <div class="maintenance__block-item-params"><?=$day->key($val['date-name'])->number($val['date'])->register(1)->pre('от')->get()?></div>
                            </div>
                        <? endif; ?>
                    </div>
                    <? if(count($val['result']) != 0): ?>
                        <div class="maintenance__block-ul">
                            <ul>
                                <? foreach ($val['result'] as $item): ?>
                                    <li><?=$item['tag']?></li>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    <? endif; ?>
                </div>
            <?php endforeach; ?>
            <div class="maintenance__content">
                <div class="maintenance__content-block">
                    <div class="maintenance__content-entru">
                        <?php the_content()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="portfolio">
    <?php if(in_array('Портфолио', $block)):
        $portfolio_services = get_post_meta($post->ID, 'portfolio', true);
        ?>
        <div class="wrapper portfolio__wrapper">
            <h2 class="portfolio__h2">ПРИМЕРЫ РАБОТ</h2>
        </div>
        <div class="portfolio__list">
            <? foreach ($portfolio_services as $id):
                $color = get_post_meta($id, 'color', true);
                $posts = get_post($id);
                ?>
                <a href="<?php the_permalink($id)?>" class="portfolio__list-item">
                    <div class="portfolio__list-item__images">
                        <img src="<?php echo get_the_post_thumbnail_url( $id, 'full' );?>" alt="">
                    </div>
                    <div class="portfolio__list-item__bd" style="background-color: <?=$color != '' ? $color : '#2A54EA'?>"></div>
                    <div class="portfolio__list-item__info">
                        <h4><?=$posts->post_title?></h4>
                        <h5><?=get_post_meta($id, 'card-signature', true)?></h5>
                        <span class="portfolio__list-item__info-btn button button--white">Подробнее</span>
                    </div>
                </a>
            <? endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if(in_array('Инфо блок', $block)):
        $infoBlock = get_post_meta($post->ID, 'infoBlock', true);
        ?>
        <div class="wrapper portfolio__wrapper">
            <h2 class="portfolio__h2"><?=get_post_meta($post->ID, 'infoBlockTitle', true)?></h2>
            <div class="portfolio__single">
                <div class="menu__archive menu__archive--tab">
                    <ul class="menu__archive-ul">
                        <li class="menu__archive-li menu__archive-li--active">
                            <a href="#fast-site">Быстрый сайт</a>
                        </li>
                        <li class="menu__archive-li">
                            <a href="#exclusive-site">Эксклюзивный сайт</a>
                        </li>
                    </ul>
                </div>
                <div class="portfolio__single-tab tab">
                    <div class="portfolio__single-tab-item tab__item tab__item--active" id="fast-site">
                        <div class="portfolio__stages">
                            <? foreach ($infoBlock['fastSite'] as $key => $val) : ?>
                                <div class="portfolio__stages-list">
                                    <? if($key == 'stagesWork') : ?>
                                        <div class="portfolio__stages-title">Этапы работы</div>
                                        <div class="portfolio__stages-element">
                                            <?
                                            $n = 1;
                                            foreach (array_chunk($val, round(count($val) / 2)) as $key2 => $val2) : ?>
                                                <div class="portfolio__stages-element-list">
                                                    <? foreach ($val2 as $key3 => $val3) :
                                                        $n_name = $n < 10 ? '0' . $n : $n
                                                        ?>
                                                        <div class="portfolio__stages-element-item">
                                                            <b><?=$n_name?></b>
                                                            <span><?=$val3['name']?></span>
                                                        </div>
                                                    <?
                                                    $n++;
                                                    endforeach; ?>
                                                </div>
                                            <? endforeach; ?>
                                        </div>
                                    <? endif; ?>
                                    <? if($key == 'youGet') : ?>
                                        <div class="portfolio__stages-title">Вы получаете</div>
                                        <div class="portfolio__stages-element">
                                            <? foreach (array_chunk($val, round(count($val) / 2)) as $key2 => $val2) : ?>
                                                <div class="portfolio__stages-element-list">
                                                    <? foreach ($val2 as $key3 => $val3) : ?>
                                                        <div class="portfolio__stages-element-item">
                                                            <div class="portfolio__stages-element-item__images"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/u<?=$val3['icon']?>.png" alt=""></div>
                                                            <span><?=$val3['name']?></span>
                                                        </div>
                                                    <? endforeach; ?>
                                                </div>
                                            <? endforeach; ?>
                                        </div>
                                    <? endif; ?>
                                </div>
                            <? endforeach; ?>
                            <div class="portfolio__stages-empty">
                                <div class="portfolio__stages-content">
                                    <div class="portfolio__stages-content-info">
                                        <h2>ПРЕИМУЩЕСТВА СОЗДАНИЯ САЙТА <br>В ВЕБ-СТУДИИ</h2>
                                        <div class="portfolio__stages-content-next-up">
                                            <?php the_content()?>
                                        </div>
                                    </div>
                                    <div class="portfolio__stages-content-next">
                                        <a href="">Читать далее</a>
                                    </div>
                                </div>
                                <div class="portfolio__stages-font">UNI<br>PROMO</div>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio__single-tab-item tab__item" id="exclusive-site">
                        <div class="portfolio__stages">
                            <? foreach ($infoBlock['exclusiveSite'] as $key => $val) : ?>
                                <div class="portfolio__stages-list">
                                    <? if($key == 'stagesWork') : ?>
                                        <div class="portfolio__stages-title">Этапы работы</div>
                                        <div class="portfolio__stages-element">
                                            <?
                                            $n = 1;
                                            foreach (array_chunk($val, round(count($val) / 2)) as $key2 => $val2) : ?>
                                                <div class="portfolio__stages-element-list">
                                                    <? foreach ($val2 as $key3 => $val3) :
                                                        $n_name = $n < 10 ? '0' . $n : $n
                                                        ?>
                                                        <div class="portfolio__stages-element-item">
                                                            <b><?=$n_name?></b>
                                                            <span><?=$val3['name']?></span>
                                                            <? if($val3['description'] != '') : ?>
                                                                <p>
                                                                    <?=$val3['description']?>
                                                                </p>
                                                            <? endif; ?>
                                                        </div>
                                                        <?
                                                        $n++;
                                                    endforeach; ?>
                                                </div>
                                            <? endforeach; ?>
                                        </div>
                                    <? endif; ?>
                                    <? if($key == 'youGet') : ?>
                                        <div class="portfolio__stages-title">Вы получаете</div>
                                        <div class="portfolio__stages-element">
                                            <? foreach (array_chunk($val, round(count($val) / 2)) as $key2 => $val2) : ?>
                                                <div class="portfolio__stages-element-list">
                                                    <? foreach ($val2 as $key3 => $val3) : ?>
                                                        <div class="portfolio__stages-element-item">
                                                            <div class="portfolio__stages-element-item__images"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/u<?=$val3['icon']?>.png" alt=""></div>
                                                            <span><?=$val3['name']?></span>
                                                        </div>
                                                    <? endforeach; ?>
                                                </div>
                                            <? endforeach; ?>
                                        </div>
                                    <? endif; ?>
                                </div>
                            <? endforeach; ?>
                            <div class="portfolio__stages-empty">
                                <div class="portfolio__stages-content">
                                    <div class="portfolio__stages-content-info">
                                        <h2>ПРЕИМУЩЕСТВА СОЗДАНИЯ САЙТА <br>В ВЕБ-СТУДИИ</h2>
                                        <div class="portfolio__stages-content-next-up">
                                            <?php the_content()?>
                                        </div>
                                    </div>
                                    <div class="portfolio__stages-content-next">
                                        <a href="">Читать далее</a>
                                    </div>
                                </div>
                                <div class="portfolio__stages-font">UNI<br>PROMO</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<? include "include/application.php"?>

<?php include "include/footer-block.php"?>

<?php get_footer(); ?>