<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.05.2018
 * Time: 15:57
 */
class Plugins
{
    public static $get = '';

    private static $sort = array(
        'price_desc' =>  array(
            'order' => 'DESC',
            'orderby' => 'meta_value_num',
            'meta_key' => 'Цена'
        ),
        'price_asc' =>  array(
            'order' => 'ASC',
            'orderby' => 'meta_value_num',
            'meta_key' => 'Цена'
        ),
        'title' =>  array(
            'order' => 'ASC',
            'orderby' => 'title'
        ),
        'date' =>  array(
            'order' => 'DESC',
            'orderby' => 'date'
        )
    );

    private static $names_params = array(
        'size' => 'Размер',
        'brand' => 'Бренд',
        'color' => 'Цвет',
        'style' => 'Стиль',
        'collection' => 'Коллекция'
    );

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

    public static function CatsResultFilter($par = [])
    {
        $result = array();
        $result['grid'] = $_SESSION['grid'];
        $result['sort'] = $_SESSION['sort'];
        $result['posts_per_page'] = $_SESSION['posts_per_page'];
        $data['post_type'] = 'goods';
        $data = array_merge($data, self::$sort[$_SESSION['sort']]);
        $data['meta_query'] = array();
        $data['meta_query']['relation'] = 'AND';
        $mq_id = 0;
        $data['meta_query'][$mq_id++] = array(
            'key' => 'Остаток',
            'value' => 0,
            'compare' => '>',
            'type' => 'NUMERIC'
        );
        $data['meta_query'][$mq_id++] = array(
            'key' => 'Цена',
            'value' => 0,
            'compare' => '!=',
            'type' => 'NUMERIC'
        );
        if(!empty($par['term_id'])){
            $data['tax_query'] = array();
            $data['tax_query']['relation'] = 'AND';
            $data['tax_query'][0] = array(
                'taxonomy' => 'cats',
                'field' => 'id',
                'terms' => $par['term_id']
            );
        }
        $data['posts_per_page'] = $result['posts_per_page'];
        if(!empty($par['offset'])){
            $data['offset'] = $par['offset'];
        }
        self::$get = $par['get'];
        if(!empty(get_query_var('search'))){
            $data['s'] = get_query_var('search');
        }
        $result['params'] = self::FilterParams($data);
        $data = self::metaQuery($data);
        $result['count'] = self::countGoods($data);
        $result['data'] = $data;
        $result['result'] = Goods::Result($data);
        return $result;
    }

    private static function metaQuery($data)
    {
        if(self::$get != '' && empty(self::$get['p'])){
            $l = 2;
            foreach (self::$get as $key => $val_string){
                $data['meta_query'][$l] = array();
                $data['meta_query'][$l]['relation'] = 'OR';
                $val_result = explode("|", $val_string);
                foreach ($val_result as $k => $v){
                    $data['meta_query'][$l][$k] = array(
                        'key' => self::$names_params[$key],
                        'value' => $v,
                        'compare' => '='
                    );
                }
                $l++;
            }
        }
        return $data;
    }

    private static function FilterParams($data)
    {
        $query = new WP_Query;
        $data['posts_per_page'] = -1;
        $data['offset'] = 0;
        $my_posts = $query->query($data);
        $result = array();
        foreach ($my_posts as $key => $val){
            $result['Размер'][$key] = $val->Размер;
            $result['Бренд'][$key] = $val->Бренд;
            $result['Цвет'][$key] = $val->Цвет;
            $result['Стиль'][$key] = $val->Стиль;
            $result['Коллекция'][$key] = $val->Коллекция;
        }
        $params = array();
        $params['size'] = [
            'title' => 'Размер',
            'result' => self::InArrayMeta($result['Размер'], 'size')
        ];
        $params['brand'] = [
            'title' => 'Бренд',
            'result' => self::InArrayMeta($result['Бренд'], 'brand')
        ];
        $params['color'] = [
            'title' => 'Цвет',
            'result' => self::InArrayMeta($result['Цвет'], 'color')
        ];
        $params['style'] = [
            'title' => 'Стиль',
            'result' => self::InArrayMeta($result['Стиль'], 'style')
        ];
        $params['collection'] = [
            'title' => 'Коллекция',
            'result' => self::InArrayMeta($result['Коллекция'], 'collection')
        ];
        return $params;
    }

    private static function InArrayMeta($array, $type)
    {
        $result = array();
        $resultArt = array();
        $get_result = array();
        if(empty(self::$get['p'])){
            $i = 0;
            foreach ($array as $key => $val){
                if(!in_array($val, $result) && $val != ''){
                    $result[$i] = $val;
                    $i++;
                }
            }

            if(self::$get != ''){
                $get_string = self::$get[$type];
                $get_result = explode("|", $get_string);
            }
            foreach ($result as $key => $val){
                $resultArt[] = array(
                    'value' => $val,
                    'status' => in_array($val, $get_result) ? 'checked' : ''
                );
            }
        }
        return $resultArt;
    }

    private static function countGoods($data)
    {
        $my_posts = new WP_Query;
        $data['fields'] = 'ids';
        $data['posts_per_page'] = -1;
        $data['offset'] = 0;
        $myposts = $my_posts->query($data);
        return count($myposts);
    }

    public static function init_with_these_goods_buy()
    {
        $basket = $_SESSION['basket'];
        foreach ($basket as $key => $val){
            $basketAr = $basket;
            unset($basketAr[$key]);
            $basketBr = array();
            foreach ($basketAr as $k => $v){
                $basketBr[] = $k;
            }
            $goods_meta_buy = get_post_meta($key, 'goods_buy', true);
            if($goods_meta_buy == ''){
                update_post_meta($key, 'goods_buy', $basketBr);
            } else {
                $goods_meta_buy_merge = array_merge($basketBr, $goods_meta_buy);
                $goods_meta_buy_basket = array_unique($goods_meta_buy_merge);
                $goods_meta_buy_basket = array_slice($goods_meta_buy_basket, 0, 50);
                update_post_meta($key, 'goods_buy', $goods_meta_buy_basket);
            }
        }
    }

    public static function get_with_these_goods_buy($post_id, $offset, $post_per_page)
    {
        $result = array();
        $post_meta = get_post_meta($post_id, 'goods_buy', true);
        if($post_meta != ''){
            foreach ($post_meta as $key => $val){
                $goods_result = Goods::Id($val);
                if($goods_result['meta']['Остаток'] > 0){
                    $result[$key] = $goods_result;
                }
            }
        }
        return array_slice($result, $offset, $post_per_page);
    }

}