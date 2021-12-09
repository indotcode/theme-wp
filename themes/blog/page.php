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
                <div class="left" style="width: 100%;">
                    <div class="content">
                        <?php the_content()?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>