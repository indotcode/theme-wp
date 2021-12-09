<?php get_header(); ?>
<main>
    <div class="breadcrumbs">
        <div class="breadcrumbs__wrapper wrapper">
            <a class="breadcrumbs__link" href="/">
                Главная
            </a>
            <a class="breadcrumbs__link" href="/<?=get_the_category(get_the_ID())[0]->slug;?>">
                <?=get_the_category(get_the_ID())[0]->name;?>
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
                    <time><?=Conversion::Date(get_the_date())['day']?> <?=Conversion::Date(get_the_date())['month']?> <?=Conversion::Date(get_the_date())['year']?></time>
                    <h1 class="post__main-title"><?php the_title() ?></h1>
                    <?php the_content() ?>
                    <div class="post__btn-wrapper">
                        <a class="btn btn--hollow post__btn" href="<?=get_permalink(get_adjacent_post(true)->ID)?>">Следующая новость</a>
                        <a class="post__btn-share btn--share" href="">Поделиться</a>
                        <div class="share-block">
                            <script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                            <script src="https://yastatic.net/share2/share.js"></script>
                            <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir,twitter,viber,whatsapp,skype,telegram"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
</main>

<?php get_footer();