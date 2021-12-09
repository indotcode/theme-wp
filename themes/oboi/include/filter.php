<?php
$filter = $_SESSION['filter'];
?>
<form action="" method="post" onchange="goodsFilter(this); return false;">
    <section class="sky-form">
        <h4>Сортировка</h4>
        <div class="row1" style="max-height: inherit;">
            <div class="col col-4" data-checkbox="sort">
                <label class="radio"><input <?=!empty($filter['sort']) ? $filter['sort'] == 'Дата' ? 'checked' : '' : ''?> type="radio" name="sort" value="Дата"><i></i>Новое</label>
<!--                <label class="radio"><input --><?//=!empty($filter['sort']) ? $filter['sort'] == 'Остаток' ? 'checked' : '' : ''?><!-- type="radio" name="sort" value="Остаток"><i></i>Остатоки</label>-->
            </div>
        </div>
    </section>
    <section class="sky-form">
        <h4>Категории</h4>
        <div class="row1" style="max-height: inherit;">
            <div class="col col-4" data-checkbox="category">
                <?php foreach (get_terms( array('taxonomy' => 'cats','hide_empty' => false,'parent' => 0)) as $item){ ?>
                    <label class="checkbox">
                        <input <?=!empty($filter['category']) ? $filter['category'] == $item->term_id ? 'checked' : '' : ''?> type="checkbox" name="category" value="<?=$item->term_id?>"><i></i><?=$item->name?>
                    </label>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="sky-form">
        <h4>Бренды</h4>
        <div class="row1" style="max-height: inherit;">
            <div class="col col-4" data-checkbox="brend">
                <?php foreach (Goods::ResultMeta()['Бренд'] as $item){ ?>
                    <label class="checkbox">
                        <input <?=!empty($filter['brend']) ? $filter['brend'] == $item ? 'checked' : '' : ''?> type="checkbox" name="brend" value="<?=$item?>"><i></i><?=$item?>
                    </label>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="sky-form">
        <h4>Цвет</h4>
        <div class="row1" style="max-height: inherit;">
            <div class="col col-4" data-checkbox="color">
                <?php foreach (Goods::ResultMeta()['Цвет'] as $item){ ?>
                    <label class="checkbox">
                        <input <?=!empty($filter['color']) ? $filter['color'] == $item ? 'checked' : '' : ''?> type="checkbox" name="color" value="<?=$item?>"><i></i><?=$item?>
                    </label>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="sky-form">
        <h4>Стиль</h4>
        <div class="row1" style="max-height: inherit;">
            <div class="col col-4" data-checkbox="style">
                <?php foreach (Goods::ResultMeta()['Стиль'] as $item){ ?>
                    <label class="checkbox">
                        <input <?=!empty($filter['style']) ? $filter['style'] == $item ? 'checked' : '' : ''?> type="checkbox" name="style" value="<?=$item?>"><i></i><?=$item?>
                    </label>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="sky-form">
        <h4>Размер</h4>
        <div class="row1" style="">
            <div class="col col-4" data-checkbox="width">
                <?php foreach (Goods::ResultMeta()['Размер'] as $item){ ?>
                    <label class="checkbox">
                        <input <?=!empty($filter['width']) ? $filter['width'] == $item ? 'checked' : '' : ''?> type="checkbox" name="width" value="<?=$item?>"><i></i><?=$item?>
                    </label>
                <?php } ?>
            </div>
        </div>
    </section>
    <!--                        <section class="sky-form">-->
    <!--                            <h4>Бренды</h4>-->
    <!--                            <div class="row1 scroll-pane">-->
    <!--                                <div class="col col-4" data-checkbox="brend">-->
    <!--                                    <label class="checkbox"><input type="checkbox" name="brend" value="1"><i></i>shree</label>-->
    <!--                                    <label class="checkbox"><input type="checkbox" name="brend" value="2"><i></i>Anouk</label>-->
    <!--                                    <label class="checkbox"><input type="checkbox" name="brend" value="3"><i></i>biba</label>-->
    <!--                                    <label class="checkbox"><input type="checkbox" name="brend" value="4"><i></i>vishud</label>-->
    <!--                                    <label class="checkbox"><input type="checkbox" name="brend" value="5"><i></i>amari</label>-->
    <!--                                    <label class="checkbox"><input type="checkbox" name="brend" value="6"><i></i>shree</label>-->
    <!--                                    <label class="checkbox"><input type="checkbox" name="brend" value="7"><i></i>Anouk</label>-->
    <!--                                    <label class="checkbox"><input type="checkbox" name="brend" value="8"><i></i>biba</label>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </section>-->
    <div class="w_nav10">
        <a href="/goods" onclick="goodsFilterDelete(this); return false;">Сбросить фильтр</a>
    </div>
</form>