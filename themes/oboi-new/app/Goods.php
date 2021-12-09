<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.05.2018
 * Time: 17:08
 */
class Goods
{
    private static function _convert_price_import($string)
    {
        $str_result_price = str_split($string);
        $str_price = array();
        foreach ($str_result_price as $k){
            if(!in_array(ord($k), array("194", "160"))){
                $str_price[] = (int)$k;
            }
        }
        $str_price_implode = implode("", $str_price);
        return (int)$str_price_implode;
    }

    public static function ResultImport($url){
        $xml = @simpleXML_load_file($_SERVER['DOCUMENT_ROOT'] . '/1C/' . $url)->Каталог->Товары;
        $result = array();
        for($key = 0; $key < count($xml->Товар); $key++){
            $foto = array();
            $i = 0;
            for($key2 = 0; $key2 < count($xml->Товар[$key]->ДополнительныеДанные->Фотографии->ФотоПревью); $key2++){
                if((string)$xml->Товар[$key]->ДополнительныеДанные->Фотографии->ФотоПревью[$key2] != ''){
                    $foto[$i] = '/1C/' . (string)$xml->Товар[$key]->ДополнительныеДанные->Фотографии->ФотоПревью[$key2];
                    $i++;
                }
            }
            for($key2 = 0; $key2 < count($xml->Товар[$key]->ДополнительныеДанные->Фотографии->Фото); $key2++){
                if((string)$xml->Товар[$key]->ДополнительныеДанные->Фотографии->Фото[$key2] != ''){
                    $foto[$i] = '/1C/' . (string)$xml->Товар[$key]->ДополнительныеДанные->Фотографии->Фото[$key2];
                    $i++;
                }
            }

            $resultArt = array(
                'Ид' => (string)$xml->Товар[$key]->Ид,
                'url' => Filter::ctl_sanitize_title((string)$xml->Товар[$key]->Наименование),
                'Наименование' => (string)$xml->Товар[$key]->Наименование,
                'Цена' => self::_convert_price_import((string)$xml->Товар[$key]->Цена),
                'Остаток' => (int)$xml->Товар[$key]->Остаток,
                'Коллекция' => (string)$xml->Товар[$key]->ДополнительныеДанные->Коллекция,
                'Стиль' => (string)$xml->Товар[$key]->ДополнительныеДанные->Стиль,
                'Цвет' => (string)$xml->Товар[$key]->ДополнительныеДанные->Цвет,
                'Применение' => (string)$xml->Товар[$key]->ДополнительныеДанные->Применение,
                'Размер' => (string)$xml->Товар[$key]->ДополнительныеДанные->Размер,
                'Группы' => (string)$xml->Товар[$key]->ДополнительныеДанные->Группы->Ид,
                'Бренд' => (string)$xml->Товар[$key]->ДополнительныеДанные->Бренд,
                'Фотографии' => $foto,
            );
            $resultArt['Магазины'] = self::_ResultImportArr($xml->Товар[$key]->Магазины->Магазин);
            $result[$key] = $resultArt;
        }
        return $result;
    }

    private static function _ResultImportArr($p)
    {
        $result = array();
        $i = 0;
        for($key2 = 0; $key2 < count($p); $key2++){
            if((string)$p[$key2] != ''){
                $result[$i] = (string)$p[$key2];
                $i++;
            }
        }
        return $result;
    }

    public static function Import($url)
    {
        $result = self::ResultImport($url);
        echo '<pre>';
        print_r(array_slice($result, 5, 15));
        echo '</pre>';
        foreach ($result as $item){
            $id = $item['Ид'];
            $url = Filter::ctl_sanitize_title($item['Наименование']);
            $post_data = array(
                'post_title'    => wp_strip_all_tags( $item['Наименование'] ),
                'post_content'  => $item['Применение'],
                'post_status'   => 'publish',
                'post_type' => 'goods',
                'post_name' => $url,
                'post_author'   => 1,
                'meta_input' => array(
                    'Ид' => $id,
                    'Остаток' => $item['Остаток'],
                    'Коллекция' => $item['Коллекция'],
                    'Стиль' => $item['Стиль'],
                    'Цвет' => $item['Цвет'],
                    'Размер' => $item['Размер'],
                    'Группы' => $item['Группы'],
                    'Бренд' => $item['Бренд'],
                    'Фотографии' => $item['Фотографии'],
                    'Цена' => $item['Цена'],
                    'Магазины' => $item['Магазины']
                )
            );
            if(count(self::PostMetaId($id)) == 0){
                $post_id = wp_insert_post( $post_data );
                $category = Category::MetaId($item['Группы']);
                if(count($category) != 0){
                    wp_set_post_terms( $post_id, $category[0]->term_id, 'cats' );
                }
            } else {
                $post_data['ID'] = self::PostMetaId($id)[0];
                unset($post_data['post_name'], $post_data['post_author'], $post_data['post_status'], $post_data['post_type']);
                $category = Category::MetaId($item['Группы']);
                if(count($category) != 0){
                    wp_set_post_terms( $post_data['ID'], $category[0]->term_id, 'cats' );
                }
                wp_update_post( $post_data );
            }
        }
    }

    public static function PostMetaId($id)
    {
        $args = array(
            'post_type' => 'goods',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'Ид',
                    'value' => $id
                )
            ),
            'fields' => 'ids'
        );
        $query = new WP_Query();
        $myposts = $query->query($args);
        return $myposts;
    }

    public static function Result($array)
    {
        $array['fields'] = 'ids';
        $my_posts = new WP_Query;
        $myposts = $my_posts->query($array);
        $result = array();
        foreach ($myposts as $id){
            $result[] = self::Id($id);
        }
        return $result;
    }

    public static function Id($id)
    {
        $result = get_post($id, "ARRAY_A");
        $result['meta'] = Format::PostMeta($id);
        if(!empty($result['meta']['Группы'])){
            $category_result = array();
            $category_string = array();
            foreach (Category::MetaId($result['meta']['Группы']) as $key => $val){
                $val = (array)$val;
                $category_string[] = $val['name'];
                $category_result[] = $val;
            }
            $result['category']['string'] = implode(", ", $category_string);
            $result['category']['result'] = $category_result;
        }

        return $result;
    }

    public static function you_watched_recently($post_id, $offset, $post_per_page)
    {
        @session_start();
        if(!in_array($post_id, $_SESSION['you_watched_recently'])){
            $i = 0;
            $result_post = array();
            $result_post[$i++] = $post_id;
            foreach ($_SESSION['you_watched_recently'] as $id){
                if($i < 10){
                    $result_post[$i] = $id;
                    $i++;
                }
            }
            $_SESSION['you_watched_recently'] = $result_post;
        }
        $resultAr = array();
        foreach ($_SESSION['you_watched_recently'] as $key => $val){
            if($post_id != $val){
                $goods_result = Goods::Id($val);
                if($goods_result['meta']['Остаток'] > 0){
                    $resultAr[] = $goods_result;
                }
            }
        }
        return array_slice($resultAr, $offset, $post_per_page);
    }

    public static function get_with_these_goods($post_id)
    {
        @session_start();
        $my_posts = new WP_Query;

        $result = array();
        $post = get_post($post_id);
        $term_id = get_the_terms($post->ID, 'cats')[0]->term_id;
        $term_oboi = array(11, 16, 14, 12, 10, 23, 13, 15);
        $term_oboi_view = array(17, 19, 18);
        if(in_array($term_id, $term_oboi)){
            foreach ($term_oboi_view as $key => $val){
                $myposts = $my_posts->query(array(
                    'post_type' => 'goods',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'cats',
                            'field'    => 'term_id',
                            'terms'    => $val
                        )
                    ),
                    'fields' => 'ids',
                    'orderby' => 'rand',
                    'posts_per_page' => 1
                ));
                foreach ($myposts as $id){
                    $result[] = $id;
                }
            }
        }

        $resultAr = array();
        foreach ($result as $id){
            $resultAr[] = Goods::Id($id);
        }
        return $resultAr;
    }
}