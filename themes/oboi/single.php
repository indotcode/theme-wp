<?php get_header(); ?>
    <h3 class="m_2"><?=the_title();?></h3>

    <div class="container">
        <div class="bg">
            <a href="/">Главная</a>
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
            <a href="/<?=get_the_category(get_the_ID())[0]->slug;?>"><?=get_the_category(get_the_ID())[0]->name;?></a>
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
            <span class="bg3"><?=the_title();?></span>
        </div>
        <div class="row">
            <div class="col-md-12 content">
                <?php while ( have_posts() ) { the_post(); ?>
                    <?php the_content()?>
                <?php } ?>
                <div class="meta">
                    <span class="date" title="Дата публикации"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?=Conversion::Date(get_the_date())['day']?> <?=Conversion::Date(get_the_date())['month']?> <?=Conversion::Date(get_the_date())['year']?></span>
                    <span class="viw" title="Количество просмотров"><i class="fa fa-users" aria-hidden="true"></i> 0</span>
                </div>
            </div>
        </div>
    </div>

<?php get_footer();