<?php get_header(); ?>

<div class="single_top">
    <div class="container politics">
        <div class="col-md-12">
            <h1><?php the_title() ?></h1>
        </div>
        <div class="col-md-12">
            <?php while (have_posts()) { the_post(); ?>
                <div class="entru">
                    <?php the_content() ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>