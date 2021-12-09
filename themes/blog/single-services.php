<?php get_header();
$post = get_queried_object();
$block = get_post_meta($post->ID, 'block', true);
?>

<section class="blog-header" data-views-post="<?=$post->ID?>">
    <div class="container">
        <h1><?=$post->post_title?></h1>
        <?php
        if(function_exists('yoast_breadcrumb')){
            yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
        }
        ?>
    </div>
</section>

<?php if(in_array('Тарифы', $block)){ ?>
    <?php
    $tariffs = Tariffs::ResultTab(get_post_meta($post->ID, 'rate', true));
    ?>
    <section class="tariffs">
        <div class="container">
            <h2>Тарифы</h2>
            <?php if($tariffs['status'] == 'tab'){ ?>
                <div class="tab">
                    <?php foreach ($tariffs['tab'] as $key => $val){ ?>
                        <a class="<?=$key == 0 ? 'active' : ''?>" href="javascript:;" data-tab="<?=$key?>"><?=$val['name']?></a>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="tabs">
                <?php foreach ($tariffs['tab'] as $key => $val){ ?>
                    <div class="tabs-item" data-tabs="<?=$key?>" style="display: <?=$key == 0 ? 'block' : 'none'?>">
                        <div class="list">
                            <?php foreach ($val['result'] as $key2 => $val2){ ?>
                                <div class="item">
                                    <h3><?=$val2['name']?></h3>
                                    <div class="meta">
                                        <span class="price">от <?=number_format($val2['price'], 0, '', ' ')?> <i class="fa fa-rouble" aria-hidden="true"></i></span>
                                        <?php if($val2['date'] != '' || $val2['date-name'] != ''){ ?>
                                            <span class="date">/<?=$val2['date']?> <?=$val2['date-name']?></span>
                                        <?php } ?>
                                        <?php if($val2['description'] != ''){ ?>
                                            <span class="description">
                                                <i class="fa fa-info-circle" aria-hidden="true" data-description-tariffs></i>
                                                <b><?=$val2['description']?></b>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <?php if(count($val2['result']) != 0){ ?>
                                        <div class="list-tag">
                                            <?php foreach ($val2['result'] as $key3 => $val3){ ?>
                                                <div class="item-tag">
                                                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                                    <span><?=$val3['tag']?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <a class="add-order" href="javascript:;" onclick="addModal('startProjectTitle', {title:'<?=$val2['name']?>', post_id:<?=$post->ID?>})">Заказать</a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<?php if(in_array('Портфолио', $block)){ ?>
    <?php
    $portfolio_services = get_post_meta($post->ID, 'portfolio', true);
    ?>
    <section class="portfolio-services">
        <div class="container">
            <h2>Примеры работ</h2>
            <div class="list">
                <?php foreach ($portfolio_services as $key => $val){
                    $val = get_post($val);
                    ?>
                    <a class="item" href="<?php the_permalink($val->ID)?>">
                        <div class="images-portfolio"><img src="<?php echo get_the_post_thumbnail_url( $val->ID, 'full' );?>" alt=""></div>
                        <div class="text">
                            <div class="tags">
                                <?php foreach (App::TagsPortfolio($val->ID) as $key2 => $val2){ ?>
                                    <span class="tag"><?=$val2->name?></span>
                                <?php } ?>
                            </div>
                            <h2><?=$val->post_title?></h2>
                            <p><?=get_post_meta($val->ID, 'card-signature', true)?></p>
                            <span class="button">Посмотреть проект</span>
                        </div>
                    </a>
                <?php } ?>
            </div>
            <a href="/portfolio/" class="uni-mob">Все проекты</a>
        </div>
    </section>
<?php } ?>

<?php if(get_the_content() != ''){ ?>
    <section class="description-services">
        <div class="container">
            <h2>Описание</h2>
            <div class="text">
                <?php the_content()?>
            </div>
        </div>
    </section>
<?php } ?>

<?php Template::LikeSite('Заказать услугу')?>

<?php get_footer(); ?>