<?php get_header(); ?>

<div class="single_top">
    <?php while (have_posts()) { the_post(); ?>
        <?php
        $meta = Format::PostMeta(get_the_ID());
        $term = get_the_terms(get_the_ID(), 'cats');
        ?>
        <div class="container">
            <div class="single_grid">
                <div class="row">
                    <?php if(count($meta['Фотографии']) != 0){ ?>
                        <div class="col-md-5 slider-slick">
                            <div class="slider-for">
                                <?php foreach ($meta['Фотографии'] as $key => $val){ ?>
                                    <div>
                                        <a href="<?=Ceo::$domain?><?=$val?>" data-fancybox="images">
                                            <img src="<?=Ceo::$domain?><?=$val?>" alt="">
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if(count($meta['Фотографии']) >= 2){ ?>
                                <div class="slider-nav">
                                    <?php foreach ($meta['Фотографии'] as $key => $val){ ?>
                                        <div><img src="<?=Ceo::$domain?><?=$val?>" alt=""></div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <div class="<?=count($meta['Фотографии']) == 0 ? 'col-md-12' : 'col-md-7'?> ">
                        <ul class="back">
                            <li><i class="back_arrow"> </i>Назад к <a href="/goods">поиску обоев</a></li>
                        </ul>
                        <h1 class="h1-single-goods"><?php the_title()?></h1>
                        <p><?=$meta['Коллекция']?></p>
                        <div class="dropdown_top">
                            <div class="row">
                                <div class="col-md-2"><strong>Категория:</strong> </div>
                                <div class="col-md-10">
                                    <?='<a href="/goods" data-cat="' . $term[0]->term_id . '" onclick="LoadCatLink(this)">' . $term[0]->name . '</a>';?>
                                </div>
                            </div>
                            <?php if($meta['Цвет'] != ''){ ?>
                                <div class="row">
                                    <div class="col-md-2"><strong>Цвет:</strong> </div>
                                    <div class="col-md-10"><?=$meta['Цвет']?></div>
                                </div>
                            <?php } ?>
                            <?php if($meta['Размер'] != ''){ ?>
                                <div class="row">
                                    <div class="col-md-2"><strong>Размер:</strong> </div>
                                    <div class="col-md-10"><?=$meta['Размер']?></div>
                                </div>
                            <?php } ?>
                            <?php if($meta['Бренд'] != ''){ ?>
                                <div class="row">
                                    <div class="col-md-2"><strong>Бренд:</strong> </div>
                                    <div class="col-md-10"><?=$meta['Бренд']?></div>
                                </div>
                            <?php } ?>
                            <?php if($meta['Стиль'] != ''){ ?>
                                <div class="row">
                                    <div class="col-md-2"><strong>Стиль:</strong> </div>
                                    <div class="col-md-10"><?=$meta['Стиль']?></div>
                                </div>
                            <?php } ?>
                            <?php if($meta['Коллекция'] != ''){ ?>
                                <div class="row">
                                    <div class="col-md-2"><strong>Коллекция:</strong> </div>
                                    <div class="col-md-10"><?=$meta['Коллекция']?></div>
                                </div>
                            <?php } ?>
                            <?php if($meta['Цена'] != ''){ ?>
                                <div class="row">
                                    <div class="col-md-2"><strong>Цена:</strong> </div>
                                    <div class="col-md-10"><?=$meta['Цена']?> руб</div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="option-goods">
                            <span class="nalost">
                                <?=$meta['Остаток'] > 0 ? 'В наличии' : 'Не в наличии'?>
                            </span>
                            <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,whatsapp,telegram"></div>
                        </div>
                        <?php if($meta['Остаток'] > 0){ ?>
                            <div class="basket__goods-che">
                                <form class="basket__goods-che__form" action="" method="post" onsubmit="basket_goods_che(this); return false;">
                                    <input type="hidden" name="goods[id]" value="<?=get_the_ID()?>">
                                    <div class="basket__goods-che__counter">
                                        <button type="button" class="but counterBut dec"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                        <input readonly type="text" class="field fieldCount" name="goods[count]" value="1" data-min="1" data-max="999">
                                        <button type="button" class="but counterBut inc"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                    <button class="basket__goods-che__submit" type="submit" onclick="yaCounter49393813.reachGoal('korzina'); return true;"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Добавить в корзину</button>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="m_2">Cопутствующие товары</h3>
        <div class="container">
            <div class="box_3">
                <?php foreach (Plugins::CollectingGoods() as $item){ ?>
                    <div class="col-md-3">
                        <div class="content_box rel">
                            <a href="<?php the_permalink($item->ID); ?>">
                                <div class="img-rel">
                                    <img src="<?=Ceo::$domain?><?=$item->meta['Фотографии'][0]?>" class="img-responsive" alt="">
                                </div>
                            </a>
                        </div>
                        <h4><a href="<?php the_permalink($item->ID); ?>"><?=$item->post_title?></a></h4>
                        <div class="tags"><?=$item->meta['Бренд']?> <?=$item->meta['Цвет']?></div>
                    </div>
                <?php } ?>
                <div class="clearfix"> </div>
            </div>
        </div>
    <?php } ?>
    </div>
<?php get_footer(); ?>
