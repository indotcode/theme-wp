<?php
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
header('Content-Type: text/html; charset=utf-8');
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
include $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use Twig\Letters;
$email_to = get_post_meta(487, 'email', true);
//$email_to = 'oruno999@gmail.com';


switch ($_POST['type']){
    case 'project_form':
        $headers = implode("\r\n", array(
            "From: " . $_POST['name'] . " <wordpress@yoursite.com>",
            "content-type: text/html"
        ));
        $html = "<b>Имя:</b> " . $_POST['name'] . "<br>";
        $html .= "<b>Телефон:</b> " . $_POST['phone'] . "<br>";
        $html .= "<b>E-mail:</b> " . $_POST['email'];
        wp_mail(
            $email_to,
            'Заявка на проект"',
            $html,
            $headers
        );
        break;
    case 'PostsPerPage':
        $query_result = json_decode(str_replace("\\", "", $_POST['json']), true);
        $offset = $_POST['offset'];
        $query_result['offset'] = $offset;
        ?>
        <?php
        $query = new WP_Query($query_result);
        while ($query->have_posts() ) { $query->the_post();
            ?>
            <a href="<?php the_permalink()?>" class="portfolio__list-item portfolio__list-item--none">
                <?php
                $color = get_post_meta(get_the_ID(), 'color', true);
                ?>
                <div class="portfolio__list-item__images">
                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' );?>" alt="">
                </div>
                <div class="portfolio__list-item__bd" style="background-color: <?=$color != '' ? $color : '#2A54EA'?>"></div>
                <div class="portfolio__list-item__info">
                    <h4><?php the_title()?></h4>
                    <h5><?=get_post_meta(get_the_ID(), 'card-signature', true)?></h5>
                    <span class="portfolio__list-item__info-btn button button--white">Подробнее</span>
                </div>
            </a>
            <?php
        }
        wp_reset_postdata();
        ?>
        <?php
        break;
}