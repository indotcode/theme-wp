<?php get_header(); ?>
<?php
Template::Filter();
?>
<?php
while (have_posts() ) { the_post();
    ?>
    <div class="single-portfolio">
        <div class="container">
            <div class="content-single">
                <div class="title">
                    <?php
                    $prev = get_adjacent_post(false, '', true, 'portfolio-categories');
                    $next = get_adjacent_post(false, '', false, 'portfolio-categories');
                    ?>
                    <a href="<?php the_permalink($prev->ID)?>" class="prev">
                        <?php if($prev){ ?>
                            <i></i>
                            <span>Предыдущая работа</span>
                        <?php } ?>
                    </a>
                    <div class="name">
                        <h2><?php the_title()?></h2>
                        <?php if(get_post_meta(get_the_ID(), 'pod', true) != ''){ ?>
                            <div><?=get_post_meta(get_the_ID(), 'min-text', true)?></div>
                        <?php } ?>
                    </div>
                    <a href="<?php the_permalink($next->ID)?>" class="next">
                        <?php if($next){ ?>
                            <i></i>
                            <span>Следующая работа</span>
                        <?php } ?>
                    </a>
                </div>
                <div class="stencil">
                    <?php
                    if(get_post_meta(get_the_ID(), 'all-images', true)){
                        ?>
                        <div class="all-desktop">
                            <div class="img">
                                <img src="<?=get_post_meta(get_the_ID(), 'all-images', true)['guid']?>" alt="">
                            </div>
                        </div>
                        <?php
                    } elseif (get_post_meta(get_the_ID(), 'site', true)){
                        ?>
                        <div class="full-desktop">
                            <div class="top">
                                <i></i>
                                <i></i>
                                <i></i>
                            </div>
                            <div class="img">
                                <img src="<?=get_post_meta(get_the_ID(), 'site', true)['guid']?>" alt="">
                            </div>
                        </div>
                        <?php
                    } else {
                        $desktop = get_post_meta(get_the_ID(), 'desktop', true)['guid'];
                        $mobile = get_post_meta(get_the_ID(), 'mobile', true)['guid'];
                        ?>
                        <?php if($desktop || $mobile){ ?>
                            <div class="images">
                                <?php if($desktop){ ?>
                                    <div class="desktop <?=!$mobile ? 'no-mobile' : ''?>">
                                        <img src="<?=$desktop?>" alt="">
                                    </div>
                                <?php } ?>
                                <?php if($desktop && $mobile){ ?>
                                    <div class="mobile">
                                        <img src="<?=$mobile?>" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php if(get_the_content() != ''){ ?>
        <div class="single-portfolio-content">
            <div class="box">
                <div class="container">
                    <div class="content-single">
                        <h2>Описание</h2>
                        <div class="content">
                            <?php the_content()?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="single-portfolio-what-done">
        <div class="box">
            <div class="container">
                <div class="content-single">
                    <?php if(get_the_terms( get_the_ID(), 'what-done')){ ?>
                        <h2>Что сделано</h2>
                        <div class="content">
                            <div class="list">
                                <?php foreach (get_the_terms( get_the_ID(), 'what-done') as $key => $val){ ?>
                                    <div class="item">
                                        <div class="img"><img src="<?=get_term_meta($val->term_id, 'images', true)['guid']?>" alt=""></div>
                                        <h4><?=$val->name?></h4>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(get_post_meta(get_the_ID(), 'link', true) != ''){ ?>
                        <a href="<?=get_post_meta(get_the_ID(), 'link', true)?>" class="link-site" target="_blank" rel="nofollow">перейти на сайт</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
wp_reset_postdata();
?>

<?php Template::LikeSite('Понравился сайт? Закажите себе:')?>

<?php get_footer(); ?>