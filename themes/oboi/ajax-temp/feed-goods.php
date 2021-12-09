<?php
$filter = $_SESSION['filter'];
$count_goods = Plugins::FilterP($filter, -1)->post_count;
$count_max = 0;
if(isset($_POST['search'])){
    if(isset($_POST['search'])){
        $_SESSION['filter'] = array();
        $count_max = -1;
        $filter =  array('search' => $_POST['search']);
        $count_goods = Plugins::FilterP($filter, -1)->post_count;
    }
} else {
    if(!empty($filter['status']) && $filter['status'] == 'full'){
        $count_max = $count_goods;
    } else {
        if(!empty($_POST['type']) && $_POST['type'] == 'LoadPage'){
            $count_max = 12 + $_POST['count'];
        } else {
            $count_max = 12;
        }
    }
}
$query = Plugins::FilterP($filter, $count_max);
?>
<div class="women">
    <?php if(!isset($_POST['search'])){ ?>
        <a href="#"><h4>Обоев - <span><?=$count_goods?> шт</span> </h4></a>
    <?php } else { ?>
        <a href="#"><h4 style="text-transform: unset;">Результаты поиска: <?=$_POST['search']?></h4></a>
    <?php } ?>

    <div class="clearfix"></div>
</div>
<div class="col-md-12">
    <div class="row">
        <?php if ( $query->have_posts() ) {?>
            <?php while ( $query->have_posts() ) { $query->the_post();?>
                <?php
                $meta = Format::PostMeta(get_the_ID());
                ?>
                <div class="col-md-3 simpleCart_shelfItem" data-item-goods>
                    <div class="content_box">
                        <a href="<?php the_permalink(); ?>">
                            <div class="view view-fifth">
                                <?php if(count($meta['Фотографии']) != 0){ ?>
                                    <div class="img-category">
                                        <img src="<?=Ceo::$domain?><?=$meta['Фотографии'][0]?>" class="img-responsive" alt=""/>
                                    </div>
                                <?php } else { ?>
                                    <div class="img-category">
                                        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no_photo.jpg" class="img-responsive" alt=""/>
                                    </div>
                                <?php } ?>
                            </div>
                        </a>
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h5>
                        <h6><?=$meta['Бренд']?> <?=$meta['Цвет']?></h6>
                        <div class="size_2">
                            <div class="size_35">
                                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                <span>
                                    <?=$meta['Остаток'] > 0 ? 'В наличии' : 'Не в наличии'?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-md-3 none-goods">
                <span>Товаров нет!</span>
            </div>
        <?php } ?>
        <?php wp_reset_postdata();?>
    </div>
</div>
<?php if($count_goods > $count_max && !isset($_POST['search'])){ ?>
    <div class="col-md-12 oboi-click-load">
        <span class="e" data-max="<?=$count_max?>" data-goods-max="<?=$count_goods?>" onclick="LoadPage(this); return false;">Загрузить еще</span>
        <span class="w" data-max="<?=$count_max?>" data-goods-max="<?=$count_goods?>" onclick="LoadPageFull(this); return false;">Все..</span>
    </div>
<?php } ?>