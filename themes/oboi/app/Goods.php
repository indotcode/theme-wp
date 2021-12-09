<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.05.2018
 * Time: 17:08
 */
class Goods
{

    public static function ResultMeta(){
        $args = array('post_type' => 'goods','posts_per_page' => -1);
        $query = new WP_Query;
        $my_posts = $query->query($args);
        $result = array();
        foreach ($my_posts as $key => $val){
            $result['Цвет'][$key] = $val->Цвет;
            $result['Бренд'][$key] = $val->Бренд;
            $result['Стиль'][$key] = $val->Стиль;
            $result['Размер'][$key] = $val->Размер;
            $result['Коллекция'][$key] = $val->Коллекция;
        }
        $result['Цвет'] = self::InArrayMeta($result['Цвет']);
        $result['Бренд'] = self::InArrayMeta($result['Бренд']);
        $result['Стиль'] = self::InArrayMeta($result['Стиль']);
        $result['Размер'] = self::InArrayMeta($result['Размер']);
        $result['Коллекция'] = self::InArrayMeta($result['Коллекция']);
        return $result;
    }
    private static function InArrayMeta($array){
        $result = array();
        $i = 0;
        foreach ($array as $key => $val){
            if(!in_array($val, $result) && $val != ''){
                $result[$i] = $val;
                $i++;
            }
        }
        return $result;
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
            $resultArt = array(
                'Ид' => (string)$xml->Товар[$key]->Ид,
                'url' => Filter::ctl_sanitize_title((string)$xml->Товар[$key]->Наименование),
                'Наименование' => (string)$xml->Товар[$key]->Наименование,
                'Цена' => (string)$xml->Товар[$key]->Цена,
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
            $result[$key] = $resultArt;
        }
        return $result;
    }

    public static function Import($url)
    {
        $result = self::ResultImport($url);
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
                    'Цена' => $item['Цена']
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
}