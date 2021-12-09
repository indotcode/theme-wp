<?php

class App
{
    public function __construct()
    {

    }

    public static function TagsPortfolio($post_id)
    {
        $result = array();
        $term_portfolio_categories = get_the_terms($post_id, 'portfolio-categories');
        foreach ($term_portfolio_categories as $key => $val){
            $result[] = $val;

        }
//        $term_portfolio_branches = get_the_terms($post_id, 'branches');
//        foreach ($term_portfolio_branches as $key => $val){
//            $result[] = $val;
//        }
//        $term_portfolio_development = get_the_terms($post_id, 'development');
//        foreach ($term_portfolio_development as $key => $val){
//            $result[] = $val;
//        }
        return $result;
    }

    public static function FilterTag()
    {
        $result = array();
        if(get_term_by('slug', get_query_var('filter'), 'branches')){
            $result['result'] = get_term_by('slug', get_query_var('filter'), 'branches');
            $result['title'] = ' ('.$result['result']->name.')';
            $result['title_none'] = $result['result']->name;
            $result['query'] = array(
                'taxonomy' => $result['result']->taxonomy,
                'field' => 'term_id',
                'terms' => $result['result']->term_id
            );
        }
        if(get_term_by('slug', get_query_var('filter'), 'development')){
            $result['result'] = get_term_by('slug', get_query_var('filter'), 'development');
            $result['title'] = ' ('.$result['result']->name.')';
            $result['title_none'] = $result['result']->name;
            $result['query'] = array(
                'taxonomy' => $result['result']->taxonomy,
                'field' => 'term_id',
                'terms' => $result['result']->term_id
            );
        }
        return $result;
    }

    public static function FilterNone($res, $query_result, $bd)
    {
        $my_posts = new WP_Query;

        $myposts = $my_posts->query( array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'portfolio-categories',
                'field' => 'term_id',
                'terms' => $query_result
            ),
            array(
                'taxonomy' => $bd['taxonomy'],
                'field' => 'term_id',
                'terms' => $res
            )
        ) );
        $count = count($myposts);
//        if($count != 0){
//            return 1;
//        } else {
//            return 0;
//        }
        print_r($count);
    }

    public static function SingleOfSetFilter()
    {
        if(is_singular('portfolio')){
            global $post;
            $term_and_post = get_the_terms(get_queried_object()->ID, 'portfolio-categories');
            $term_rod = array();
            $result = array();
            foreach ($term_and_post as $key => $val){
                $result['result_term'][] = $val->term_id;
                if($val->parent == 0){
                    $term_rod = $val;
                }
            }
            $result['parent'] = get_terms(array('taxonomy' => 'portfolio-categories', 'hide_empty' => false, 'parent' => $term_rod->term_id));
            $result['term_rod'] = $term_rod;
            $term = array();
            foreach (get_the_terms($post->ID, 'portfolio-categories') as $key => $val){
                $term[] = $val->term_id;
            }
            $result['term_set'] = get_term($term[count($term)-1], 'portfolio-categories');
            return $result;
        } else {
            return array();
        }

    }

    public static function ShortDescription($text, $maxlen){
        $string = strip_tags($text);
        $len = (mb_strlen($string) > $maxlen)? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
        $cutStr = mb_substr($string, 0, $len);
        return (mb_strlen($string) > $maxlen)? $cutStr.'...' : $cutStr;
    }

    public static function ArchiveServices()
    {
        $my_posts = new WP_Query;
        $term = get_terms(array('taxonomy' => 'cat-services', 'hide_empty' => false));
        $result = array();
        foreach ($term as $key => $val){
            $result[$key] = array(
                'term' => $val,
                'result' => $my_posts->query(array(
                    'post_type' => 'services',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'cat-services',
                            'field' => 'term_id',
                            'terms' => $val->term_id
                        )
                    )
                ))
            );
        }
        return $result;
    }

    public static function Rederect()
    {
        $part_redirect = array(
        	"https://unipromo.ru/about.html" => "https://unipromo.ru/kompany",
        	"https://unipromo.ru/portfolio.html" => "https://unipromo.ru/portfolio",
        	"https://unipromo.ru/services.html" => "https://unipromo.ru/services",
        	"https://unipromo.ru/contacts.html" => "https://unipromo.ru/contacts",
        	"https://unipromo.ru/razrabotka-sajta-dlya-medicinskogo-centra-profmedika/" => "https://unipromo.ru/portfolio/profmedica",
        	"https://unipromo.ru/sajt-dlya-zavoda-elektromontazhnyx-izdelij/" => "https://unipromo.ru/portfolio/novolyuks",
        	"https://unipromo.ru/sajt-dlya-magazina-oboev/" => "https://unipromo.ru/portfolio/oboi-plus",
        	"https://unipromo.ru/dizajn-gruppy-vkontakte-dlya-fotocentra/" => "https://unipromo.ru/portfolio/mister-print",
        	"https://unipromo.ru/dizajn-gruppy-vkontakte-getfit/" => "https://unipromo.ru/portfolio/getfit",
        	"https://unipromo.ru/sajt-dlya-igrovogo-portala/" => "https://unipromo.ru/portfolio/noobgames",
        	"https://unipromo.ru/korporativnyj-sajt-dlya-sibklimat-plyus/" => "https://unipromo.ru/portfolio/sibklimat-plyus",
        	"https://unipromo.ru/dizain-gruppy-vkontakte-avtopolis-42/" => "https://unipromo.ru/portfolio/avtopolis-42",
        	"https://unipromo.ru/oformlenie-gruppy-vkontakte-solyanaya-peshhera/" => "https://unipromo.ru/portfolio/oformlenie-gruppy-vkontakte-solyanaya-peschera",
        	"https://unipromo.ru/sajt-dlya-selxozpredpriyatiya-oao-slavino/" => "https://unipromo.ru/portfolio/oao-slavino",
        	"https://unipromo.ru/sajt-bern/" => "https://unipromo.ru/portfolio/bern",
        	"https://unipromo.ru/sajt-postavschiki-oboudovaniya/" => "https://unipromo.ru/portfolio/sibshovalyans",
        	"https://unipromo.ru/site-dlya-razreza-shahty/" => "https://unipromo.ru/portfolio/obekt-vostochnyj",
        	"https://unipromo.ru/razrabotka-medicinskih-sajtov/" => "https://unipromo.ru/portfolio/m-ama",
        	"https://unipromo.ru/sajt-almaznyj-bur/" => "https://unipromo.ru/portfolio/almaznyj-bur",
        	"https://unipromo.ru/gruppa-vkontakte-rabota-novokuzneck/" => "https://unipromo.ru/portfolio/rabota-novokuzneck",
        	"https://unipromo.ru/sajt-zgk-nk/" => "https://unipromo.ru/portfolio/zgk",
        	"https://unipromo.ru/oformlenie-gruppy-vkontakte-ishhu-poputchika/" => "https://unipromo.ru/portfolio/ishhu-poputchika",
        	"https://unipromo.ru/sajt-cherry/" => "https://unipromo.ru/portfolio/cherry",
        	"https://unipromo.ru/oformlenie-gruppy-uchebnaya-studiya-aa/" => "https://unipromo.ru/portfolio/uchebnaya-studiya-aa",
        	"https://unipromo.ru/gruppa-for-girls/" => "https://unipromo.ru/portfolio/555",
        );
        $link = $_SERVER['HTTP_X_FORWARDED_PROTO'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        foreach ($part_redirect as $key => $value) {
            if($link == $key){
                header( 'Location: ' . $value );
            }
        }
    }

    public static function CountPortfolio($result)
    {
        $result['posts_per_page'] = -1;
        $result['fields'] = 'ids';
        $my_posts = new WP_Query;
        $myposts = $my_posts->query($result);
        return count($myposts);
    }
}
