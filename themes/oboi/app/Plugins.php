<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.05.2018
 * Time: 15:57
 */
class Plugins
{

    public static function FilterP($filter, $posts_per_page)
    {
        $args = array();
        $t = 0;
        $m = 0;
        $args['post_type'] = 'goods';
        $args['posts_per_page'] = $posts_per_page;
        $args['tax_query']['relation'] = 'OR';
        $args['meta_query']['relation'] = 'AND';
        if(!empty($filter['category'])){
            $args['tax_query'][$t++] = array('taxonomy' => 'cats', 'field' => 'id', 'terms' => $filter['category']);
        }
        $args['meta_query'][$m++] = array('key' => 'Остаток', 'value' => 0, 'compare' => '!=');
        if(!empty($filter['brend'])){
            $args['meta_query'][$m++] = array('key' => 'Бренд', 'value' => $filter['brend']);
        }
        if(!empty($filter['color'])){
            $args['meta_query'][$m++] = array('key' => 'Цвет', 'value' => $filter['color']);
        }
        if(!empty($filter['style'])){
            $args['meta_query'][$m++] = array('key' => 'Стиль', 'value' => $filter['style']);
        }
        if(!empty($filter['width'])){
            $args['meta_query'][$m++] = array('key' => 'Размер', 'value' => $filter['width']);
        }
        if(!empty($filter['sort'])){
            $args['order'] = 'DESC';
            $args['orderby'] = 'DESC';
        }
        if(!empty($filter['sort'])){
            if($filter['sort'] == 'Дата'){
                $args['order'] = 'DESC';
                $args['Цвет'] = 'date';
            }
            if($filter['sort'] == 'Остаток'){
                $args['order'] = 'DESC';
                $args['orderby'] = 'meta_value';
                $args['meta_key'] = 'Остаток';
            }
        }
        if(isset($filter['search'])){
            $args['s'] = $filter['search'];
        }
//        $args['meta_query'][$m++] = array('key' => 'Остаток', 'value' => 0, 'compare' => '>');
        return new WP_Query($args);
    }

    public static function CollectingGoods()
    {
        $meta = Format::PostMeta(get_the_ID());
        $my_posts = new WP_Query();
        $result =  array(
            'post_type' => 'goods',
            'posts_per_page' => 4,
            'orderby' => 'rand'
        );
        $result['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => 'Бренд',
                'value' => $meta['Бренд']
            ),
            array(
                'key' => 'Остаток',
                'value' => 0,
                'compare' => '>',
                'type' => 'NUMERIC'
            )
        );

        $myposts = $my_posts->query($result);
        $resultArt = array();
        foreach ($myposts as $key => $val){
            $val->meta = Format::PostMeta($val->ID);
            $resultArt[$key] = $val;
        }
        return $resultArt;
    }

}