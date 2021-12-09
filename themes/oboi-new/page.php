<?php get_header(); ?>

<main>
    <div class="breadcrumbs">
        <div class="breadcrumbs__wrapper wrapper">
            <a class="breadcrumbs__link" href="/">
                Главная
            </a>
            <a class="breadcrumbs__link" href="<?=get_permalink($post->ID)?>">
                <?php the_title() ?>
            </a>
        </div>
    </div>
    <?php while (have_posts()) { the_post(); ?>
        <section class="post">
            <div class="post__wrapper wrapper">
                <div class="post__text">
                    <h1 class="post__main-title"><?php the_title() ?></h1>
                    <?php the_content() ?>
                </div>
            </div>
        </section>
    <?php } ?>
</main>

<?php get_footer(); ?>