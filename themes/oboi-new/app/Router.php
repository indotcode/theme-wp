<?php
add_action('init', 'register_post_types');
function register_post_types()
{
    register_post_type('goods', array(
        'public' => true,
        'show_ui' => true,
        'rewrite' => true,
        'has_archive' => true,
        'labels' => array(
            'name' => 'Товары',
            'singular_name' => 'Товар',
        )
    ));
    register_taxonomy('cats', array('goods'), array(
        'label'                 => 'Категории', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Категория',
            'singular_name'     => 'Категории',
            'search_items'      => 'Поиск категории',
            'all_items'         => 'Все категории',
            'view_item '        => 'Просмотр категории',
            'parent_item'       => 'Радительская категория',
            'parent_item_colon' => 'Радительская категория:',
            'edit_item'         => 'Изменить категорию',
            'update_item'       => 'Перезаписать категорию',
            'add_new_item'      => 'Добавить новую категорию',
            'new_item_name'     => 'Название категории',
            'menu_name'         => 'Категория'
        ),
        'description'           => 'Категории', // описание таксономии
        'public'                => true,
        'show_in_nav_menus'     => true, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_tagcloud'         => false, // равен аргументу show_ui
        'hierarchical'          => true,
        'rewrite'               => array('slug'=>'cats', 'hierarchical'=>true),
//        'query_var'             => 'goods',
        'show_admin_column'     => true, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
    ) );
}

class Router
{
    public static function Root()
    {
        return $_SERVER['DOCUMENT_ROOT']. '/wp-content/themes/' . get_option( 'template');
    }

    public static function include_data($url, $data = array())
    {
        include self::Root() . $url;
    }
}