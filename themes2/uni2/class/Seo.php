<?php
/**
 * Created by PhpStorm.
 * User: 555
 * Date: 26.03.2019
 * Time: 17:53
 */
class Seo
{
    public static function Title()
    {
        $object = get_queried_object();
        if(!empty(get_query_var('filter'))){
            $term = get_queried_object();
            $filter = App::FilterTag();
            $title = $term->name . ' разработанные в категории «'.$filter['title_none'].'»';
            $description = $term->name . ' разработанные в категории «' . $filter['title_none'] . '». Сайты для любых устройств от веб-студии «UNIPROMO». Наше портфолио.';
        } else if(is_tax('portfolio-categories')){
            switch (get_queried_object()->slug){
                case 'grafika':
                    $title = 'Портфолио фирменных стилей в веб-студии «UNIPROMO»';
                    $description = 'Портфолио разработанных фирменных стилей в компании «UNIPROMO» . За все время мы создали множество проектов: от сайтов-визиток до крупных корпоративных сайтов.';
                    break;
                case 'veb-sajty':
                    $title = 'Портфолио разработанных сайтов в веб-студии «UNIPROMO»';
                    $description = 'Портфолио разработанных сайтов в компании «UNIPROMO» . За все время мы создали множество проектов: от сайтов-визиток до крупных корпоративных сайтов.';
                    break;
                default:
                    $title = 'Разработанные ' . get_queried_object()->name . ' от веб-студии «UNIPROMO»';
                    $description = 'Ознакомьтесь с нашим портфолио. Разработанные ' . get_queried_object()->name . ' от веб-студии «UNIPROMO». За все время мы создали множество проектов.';
                    break;
            }
        } else if(!empty($object) && $object->name == 'portfolio'){
            $title = 'Портфолио веб-студии «UNIPROMO»';
            $description = 'Портфолио разработанных проектов в компании «UNIPROMO». За все время мы создали множество проектов: от сайтов-визиток до крупных корпоративных сайтов.';
        } else {
            $title = wp_title('', false);
            $description = '';
        }
        ?>
        <title><?=$title?></title>
        <?php if($description != ''){ ?>
            <meta name="description" content="<?=$description?>">
        <?php } ?>
        <meta name="keywords" content="" />
        <?php
    }
}