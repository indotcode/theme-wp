<?php

/**
 * Created by PhpStorm.
 * User: 555
 * Date: 24.04.2019
 * Time: 15:30
 */
class Template
{
    public static function LikeSite($h2)
    {
        ?>
        <div class="single-portfolio-like-site">
            <div class="box">
                <div class="container">
                    <div class="content-single">
                        <h2><?=$h2?></h2>
                        <div class="form">
                            <form action="" method="post" onsubmit="formSet(this, 'bottomForm'); return false;">
                                <div class="forms">
                                    <input type="text" name="name" placeholder="Имя" required autocomplete="off">
                                    <input type="text" name="phone" placeholder="Телефон" required autocomplete="off">
                                    <button type="submit">отправить</button>
                                </div>
                                <div class="pz">Наживая кнопку “отправить” вы соголашаетесь на <a href="/politika-konfidencialnosti">обработку персональных данных</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    private static function FilterTag($query_result)
    {
        $tag = array();
        if(is_tax('portfolio-categories')){ 
            unset($query_result['tax_query'][1]);
            $query_result['posts_per_page'] = -1;
            $query_result['fields'] = 'ids';
            $tag['branches'] = self::FilterTagRes($query_result, 'branches');
            $tag['development'] = self::FilterTagRes($query_result, 'development');
        }
        if(is_post_type_archive('portfolio')){
            unset($query_result['tax_query']);
            $query_result['posts_per_page'] = -1;
            $query_result['fields'] = 'ids';
            $tag['branches'] = self::FilterTagRes($query_result, 'branches');
            $tag['development'] = self::FilterTagRes($query_result, 'development');
        }
        if(is_singular('portfolio')){
            $query_result['post_type'] = 'portfolio';
            $query_result['posts_per_page'] = -1;
            $query_result['fields'] = 'ids';
            $tag['branches'] = self::FilterTagRes($query_result, 'branches');
            $tag['development'] = self::FilterTagRes($query_result, 'development');

        }
        return $tag;
    }

    private static function FilterTag404($query_result)
    {
        $news_one = new WP_Query($query_result);
        if($news_one->post_count == 0){
            header('HTTP/1.0 404 Not Found');
            header( 'Location: /404' );
        }
    }

    private static function FilterTagRes($query_result, $type)
    {
        if(is_singular('portfolio')){
            $query_result = self::ResultPostAndTax($query_result);
        }
        $tag_result = array();
        $my_posts = new WP_Query;
        $myposts = $my_posts->query($query_result);
        foreach ($myposts as $key =>$val){
            $cur_terms = get_the_terms($val, $type);
            if($cur_terms){
                foreach ($cur_terms as $key2 => $val2){
                    $tag_result[] = $val2->term_id;
                }
            }
        }
        $tag_result = array_unique($tag_result);
        $tag = array();
        foreach ($tag_result as $key => $val){
            $tag[] = get_term($val, $type);
        }
        return $tag;
    }

    private static function ResultPostAndTax($query_result)
    {
        $post_id = get_the_ID();
        $term = get_the_terms($post_id, 'portfolio-categories');
        foreach ($term as $key => $val){
            if($val->parent != 0){
                $term = $val;
            }
        }
        $query_result['tax_query'][0]['terms'] = $term->term_id;
        return $query_result;
    }
    
    public static function Filter($query_result = false, $type)
    {
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
            $gladiator = get_term($term->term_id, 'portfolio-categories');
            if($term->parent != 0){
                $gladiator = get_term($term->parent, 'portfolio-categories');
                $parent = get_terms(array('taxonomy' => 'portfolio-categories', 'hide_empty' => false, 'parent' => $gladiator->term_id));
                $h1 = $term->name;
            }
            $filter = App::FilterTag();
            if(isset($filter['result']->taxonomy)){
                $_SESSION['filter-portfolio']['sort'] = $filter['result']->taxonomy;
            } else {
                $_SESSION['filter-portfolio']['sort'] = 'all';
            }
            $tag = self::FilterTag($query_result);
        }
        if(is_post_type_archive('portfolio')){
            $_SESSION['filter-portfolio']['active'] = 0;
            $_SESSION['filter-portfolio']['sort'] = 'all';
            $term = get_queried_object();
            $h1 = $term->labels->name;
            $link = '/portfolio';
            $filter = App::FilterTag();
            $tag = self::FilterTag($query_result);

        }
        if(is_singular('portfolio')){
            $_SESSION['filter-portfolio']['active'] = 0;
            $_SESSION['filter-portfolio']['sort'] = 'all';
            $h1 = get_post_meta(get_the_ID(), 'pod', true);
            $filter = App::FilterTag();
            $activate_single = App::SingleOfSetFilter();
            $parent = $activate_single['parent'];
            $parent_id = $activate_single['result_term'];
            $term = $activate_single['term_rod'];
            $query_result['tax_query'] = array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'portfolio-categories',
                    'field' => 'term_id',
                    'terms' => $term->term_id
                )
            );
            $link = '/portfolio/category/' . $term->slug . '/' . $activate_single['term_set']->slug;
            $tag = self::FilterTag($query_result);
        }
        self::FilterTag404($query_result);
        switch ($type){
            case 'menu_archive':
                ?>
                <ul class="menu__archive-ul">
                    <li class="menu__archive-li <?=is_post_type_archive('portfolio')  ? 'menu__archive-li--active' : ''?>">
                        <a href="/portfolio">Все работы</a>
                    </li>
                    <?php foreach (get_terms(array('taxonomy' => 'portfolio-categories', 'hide_empty' => false, 'parent' => 0)) as $key => $val){ ?>
                        <li class="menu__archive-li <?=($term->parent == 0 && $term->term_id == $val->term_id) ? 'menu__archive-li--active' : ''?> <?=$gladiator->term_id == $val->term_id ? 'menu__archive-li--active' : ''?>">
                            <a href="<?=get_term_link($val->term_id)?>"><?=$val->name?> (<?=$val->count?>)</a>
                        </li>
                    <?php } ?>
                </ul>
                <?php
                break;
            case 'menu_archive_pod':
                ?>
                <?php if(is_tax('portfolio-categories')){ ?>
                    <div class="menu__category-item">
                        <div class="menu__category-item__title">
                            <a href="javascript:;" class="menu__category--show">По типу</a>
                        </div>
                        <ul class="menu__category__pod">
                            <?php foreach ($parent as $key => $val){ ?>
                                <li><a href="<?=get_term_link($val->term_id)?>" class="menu__category__pod-a <?=$term->term_id == $val->term_id ? 'menu__category__pod-a--active' : ''?>"><?=$val->name?> (<?=$val->count?>)</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if(is_singular('portfolio')){ ?>
                    <div class="menu__category-item">
                        <div class="menu__category-item__title">
                            <a href="javascript:;" class="menu__category--show">По типу</a>
                        </div>
                        <ul class="menu__category__pod">
                            <?php foreach ($parent as $key => $val){ ?>
                                <li><a href="<?=get_term_link($val->term_id)?>" class="<?=in_array($val->term_id, $parent_id) ? 'active' : ''?>"><?=$val->name?> (<?=$val->count?>)</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php
                break;
            case 'branches':
                ?>
                <div class="menu__category-item">
                    <div class="menu__category-item__title">
                        <a href="javascript:;" class="menu__category--show">По отрасля</a>
                    </div>
                    <ul class="menu__category__pod">
                        <? foreach ($tag['branches'] as $key => $val) : ?>
                            <li>
                                <a class="menu__category__pod-a <?=$val->slug == $filter['result']->slug ? 'menu__category__pod-a--active' : ''?>" href="<?=$link?>/filter-<?=$val->slug?>">
                                    <?=$val->name?> (<?=self::countPost($query_result, $val);?>)
                                </a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
                <?php
                break;
            case 'development':
                if(count($tag['development']) != 0) :
                    ?>
                    <div class="menu__category-item">
                        <div class="menu__category-item__title">
                            <a href="javascript:;" class="menu__category--show">По типу разработки</a>
                        </div>
                        <ul class="menu__category__pod">
                            <? foreach ($tag['development'] as $key => $val) : ?>
                                <li>
                                    <a class="menu__category__pod-a <?=$val->slug == $filter['result']->slug ? 'menu__category__pod-a--active' : ''?>" href="<?=$link?>/filter-<?=$val->slug?>">
                                        <?=$val->name?> (<?=self::countPost($query_result, $val);?>)
                                    </a>
                                </li>
                            <? endforeach; ?>
                        </ul>
                    </div>
                    <?php
                endif;
                break;
            case 'all':
                ?>
                <div class="menu__category-item menu__category-item--link">
                    <div class="menu__category-item__title">
                        <a href="<?=$link?>">Все</a>
                    </div>
                </div>
                <?php
                break;
        }
    }

    public static function countPost($query_result, $term)
    {
        $query_result['posts_per_page'] = -1;
        $query_result['tax_query'][(count($query_result['tax_query']) == 2 ? 1 : 0)] = [
            'taxonomy' => $term->taxonomy,
            'field' => 'term_id',
            'terms' => $term->term_id
        ];
        $news_one = new WP_Query($query_result);
        return $news_one->post_count;
    }
}