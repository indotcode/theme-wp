<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.05.2018
 * Time: 15:52
 */
class Category
{

    public static function ResultImport($url)
    {
        $xml = @simpleXML_load_file($_SERVER['DOCUMENT_ROOT'] . '/1C/' . $url);
        $result_cat = array();
        for ($key = 0; $key < count($xml->Группы->Группа); $key++) {
            $result_cat[$key] = array(
                'Ид' => (string)$xml->Группы->Группа[$key]->Ид,
                'Наименование' => (string)$xml->Группы->Группа[$key]->Наименование,
                'ИдРодителя' => (string)$xml->Группы->Группа[$key]->ИдРодителя,
            );
        }
        return $result_cat;
    }
    
    public static function Import($url)
    {
        $result = self::ResultImport($url);
        foreach ($result as $item){
            $id = $item['Ид'];
            $parent = count(self::MetaId($item['ИдРодителя'])) == 0 ? 0 : self::MetaId($item['ИдРодителя'])[0]->term_id;
            if(count(self::MetaId($id)) != 0){
                wp_update_term( self::MetaId($id)[0]->term_id, 'cats', array(
                    'description' => '',
                    'parent'      => $parent,
                    'slug'        => Filter::ctl_sanitize_title($item['Наименование']),
                ) );
                update_term_meta( self::MetaId($id)[0]->term_id, 'Ид', $id, false);
            } else {
                $data = wp_insert_term( $item['Наименование'], 'cats', array(
                    'description' => '',
                    'parent'      => $parent,
                    'slug'        => Filter::ctl_sanitize_title($item['Наименование']),
                ) );
                if(empty($data->errors)){
                    add_term_meta( $data['term_id'], 'Ид', $id, false);
                }
            }
        }
    }

    public static function MetaId($id){
        $terms = get_terms('cats', array(
            'hide_empty' => false,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'Ид',
                    'value' => $id,
                    'compare' => '='
                )
            )
        ));
        return $terms;
    }
}