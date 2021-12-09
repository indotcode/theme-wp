<?php
$parent = array();
$h1 = '';
$gladiator = array();
$term = array();
$link = '';
$filter = '';
$title_pod = '';
if(is_tax('portfolio-categories')){
    $term = get_queried_object();
    $parent = get_terms(array('taxonomy' => 'portfolio-categories', 'hide_empty' => false, 'parent' => $term->term_id));
    $h1 = $term->name;
    $link = get_term_link($term->term_id);
    if($term->parent != 0){
        $gladiator = get_term($term->parent, 'portfolio-categories');
        $parent = get_terms(array('taxonomy' => 'portfolio-categories', 'hide_empty' => false, 'parent' => $gladiator->term_id));
        $h1 = $term->name;
    }
    $filter = App::FilterTag();
}
if(is_post_type_archive('portfolio')){
    $term = get_queried_object();
    $h1 = $term->labels->name;
    $link = '/portfolio/';
    $filter = App::FilterTag();
}
if(is_singular('portfolio')){
    $_SESSION['filter-portfolio']['active'] = 0;
    $_SESSION['filter-portfolio']['sort'] = 'all';
    $h1 = get_post_meta(get_the_ID(), 'pod', true);
    $link = '/portfolio/';
    $filter = App::FilterTag();
    $activate_single = App::SingleOfSetFilter();
    $parent = $activate_single['parent'];
    $parent_id = $activate_single['result_term'];
    $term = $activate_single['term_rod'];
}
?>
<section class="menu-portfolio">
    <div class="container">
        <h1><?=$h1?><?=$filter['title']?></h1>
        <div class="tabs">
            <ul>
                <li><a href="/portfolio/" class="<?=is_post_type_archive('portfolio') ? 'active' : ''?>">Все проекты</a></li>
                <?php foreach (get_terms(array('taxonomy' => 'portfolio-categories', 'hide_empty' => false, 'parent' => 0)) as $key => $val){ ?>
                    <li><a href="<?=get_term_link($val->term_id)?>" class="<?=($term->parent == 0 && $term->term_id == $val->term_id) ? 'active' : ''?><?=$gladiator->term_id == $val->term_id ? 'active' : ''?>"><?=$val->name?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="parent">
        <?php if(is_tax('portfolio-categories')){ ?>
            <ul>
                <li><a href="<?=$term->parent == 0 ? get_term_link($term->term_id) : get_term_link($gladiator->term_id)?>" class="<?=$term->parent == 0 ? 'active' : ''?>">Все</a></li>
                <?php foreach ($parent as $key => $val){ ?>
                    <li><a href="<?=get_term_link($val->term_id)?>" class="<?=$term->term_id == $val->term_id ? 'active' : ''?>"><?=$val->name?></a></li>
                <?php } ?>
            </ul>
        <?php } ?>
        <?php if(is_singular('portfolio')){ ?>
            <ul>
                <li><a href="<?=get_term_link($term->term_id)?>">Все</a></li>
                <?php foreach ($parent as $key => $val){ ?>
                    <li><a href="<?=get_term_link($val->term_id)?>" class="<?=in_array($val->term_id, $parent_id) ? 'active' : ''?>"><?=$val->name?></a></li>
                <?php } ?>
            </ul>
        <?php } ?>
        </div>
        <div class="sort">
            <div class="filter<?=$_SESSION['filter-portfolio']['active'] != 0 ? ' active' : ''?>" data-active="<?=$_SESSION['filter-portfolio']['active']?>" onclick="filterAp(this)">
                <span>Фильтровать</span> 
               <?=$_SESSION['filter-portfolio']['active'] != 0 ? '<i class="fa fa-angle-up" aria-hidden="true"></i>' : '<i class="fa fa-angle-down" aria-hidden="true"></i>'?>
            </div>
        </div>
        <div data-sort-parent class="sort-parent" style="display: <?=$_SESSION['filter-portfolio']['active'] != 0 ? 'block' : 'none'?>">
            <a href="<?=$link?>" class="item<?=$_SESSION['filter-portfolio']['sort'] == 'all' ? ' active' : ''?>" data-tab="all">Все</a>
            <div class="item<?=$_SESSION['filter-portfolio']['sort'] == 'branches' ? ' active' : ''?>" data-tab="branches">По отраслям</div>
            <div class="item<?=$_SESSION['filter-portfolio']['sort'] == 'development' ? ' active' : ''?>" data-tab="development">По типу разработки</div>
        </div>
        <div class="tab-sort" data-sort-tab-parent style="display: <?=$_SESSION['filter-portfolio']['active'] != 0 ? 'block' : 'none'?>">
            <div class="list" data-tabs="branches" style="display: <?=$_SESSION['filter-portfolio']['sort'] == 'branches' ? 'block' : 'none'?>">
                <ul>
                    <?php foreach (get_terms(array('taxonomy' => 'branches', 'hide_empty' => true)) as $key => $val){
                        ?>
                        <li><a class="<?=$val->slug == $filter['result']->slug ? 'active' : ''?>" href="<?=$link?>/filter-<?=$val->slug?>"><?=$val->name?></a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="list" data-tabs="development" style="display: <?=$_SESSION['filter-portfolio']['sort'] == 'development' ? 'block' : 'none'?>">
                <ul>
                    <?php foreach (get_terms(array('taxonomy' => 'development', 'hide_empty' => true)) as $key => $val){ ?>
                        <li><a class="<?=$val->slug == $filter['result']->slug ? 'active' : ''?>" href="<?=$link?>/filter-<?=$val->slug?>"><?=$val->name?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php