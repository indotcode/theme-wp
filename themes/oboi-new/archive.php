<?php get_header(); ?>
<?php
$query = array();
$query['post_type'] = 'post';
$query['cat'] = get_queried_object()->term_id;
$query['posts_per_page'] = -1;
$count = new WP_Query($query);
$count = count($count->posts);
$query['posts_per_page'] = $_SESSION['posts_per_page'];
$result = new WP_Query($query);
?>
<main>
    <div class="breadcrumbs">
        <div class="breadcrumbs__wrapper wrapper">
            <a class="breadcrumbs__link" href="/">
                Главная
            </a>
            <a class="breadcrumbs__link" href="/<?=get_queried_object()->slug?>">
                <?=get_queried_object()->name?>
            </a>
        </div>
    </div>
    <section class="articles">
        <div class="articles__wrapper wrapper">
            <h1 class="articles__title h2"><?=get_queried_object()->name?></h1>
            <div class="articles__cards">
                <?php while($result->have_posts()) { $result->the_post(); ?>
                    <div class="card">
                        <div class="card__banner">
                            <img class="card__img" src="<?php the_post_thumbnail_url() ?>" alt="">
                        </div>
                        <div class="card__content">
                            <div class="card__wrapper-info">
                                <time class="card__time"><?=Conversion::Date(get_the_date())['day']?> <?=Conversion::Date(get_the_date())['month']?> <?=Conversion::Date(get_the_date())['year']?> </time>
                                <h4 class="card__wrapper-title">
                                    <?php the_title()?>
                                </h4>
                                <p class="card__text">
                                    <?php the_excerpt()?>
                                </p>
                                <a class="card__link card__link--color" href="<?php the_permalink()?>">Подробнее</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!$result->have_posts()){ ?>
                    <div class="none-count">Записей нет!</div>
                <?php } ?>
            </div>
            <?php if($count > $_SESSION['posts_per_page']){ ?>
                <form class="shop__functional ajax-jq" action="/wp-ajax/index.php" method="post">
                    <input type="hidden" name="type" value="more_post">
                    <input type="hidden" name="cat" value="<?=get_queried_object()->term_id?>">
                    <input type="hidden" name="posts_per_page" value="<?=$_SESSION['posts_per_page']?>">
                    <input type="hidden" name="offset" value="<?=$_SESSION['posts_per_page']?>">
                    <input type="hidden" name="count" value="<?=$count?>">
                    <button type="submit" class="shop__btn-more btn btn--hollow">Показать ещё</button>
                </form>
            <?php } ?>
            <form action=""></form>
        </div>
    </section>
</main>

<?php get_footer();