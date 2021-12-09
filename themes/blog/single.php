<?php get_header();
$post = get_queried_object();
?>
<section class="blog-header" data-views-post="<?=$post->ID?>">
    <div class="container">
        <h1><?=$post->post_title?></h1>
        <?php
        if(function_exists('yoast_breadcrumb')){
            yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
        }
        ?>
    </div>
</section>
<section class="blog-single">
    <div class="container">
        <div class="row">
            <div class="left">
                <div class="meta">
                    <div class="images">
                        <img src="<?=get_the_post_thumbnail_url( $post->ID, 'full' );?>" alt="">
                    </div>
                    <div class="date"><?=get_the_date('j F Y', $post->ID)?></div>
                </div>

                <div class="content">
                    <?php the_content()?>
                    <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="large" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div>
                </div>
            </div>
            <div class="right">
                <?php get_template_part( 'template-parts/sitebar', 'blog' )?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
