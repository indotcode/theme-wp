<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 06.04.2020
 * Time: 17:22
 */
class Basket
{
    public static function Goods()
    {
        $result = array();
        $result['goods'] = array();
        $price = 0;
        $count_of = 0;
        foreach ($_SESSION['basket'] as $post_id => $count){
            $meta = Format::PostMeta($post_id);
            $term = get_the_terms($post_id, 'cats');
            $price_all = preg_replace("/[^x\d|*\.]/", "", $meta['Цена']) * $count;
            $price += $price_all;
            $count_of += 1;
            $result['goods'][] = array(
                'post' => get_post($post_id),
                'meta' => $meta,
                'term' => $term,
                'count' => $count,
                'price' => $price_all
            );
        }
        $result['price'] = $price;
        $result['count'] = $count_of;
        return $result;
    }
}