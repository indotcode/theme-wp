<?php get_header(); ?>
<section class="services-header">
    <div class="container">
        <h1>Услуги</h1>
        <?php
        if(function_exists('yoast_breadcrumb')){
            yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
        }
        ?>
    </div>
</section>
<section class="services-tax">
    <div class="container">
        <?php foreach (App::ArchiveServices() as $item){
            ?>
            <h2><?=$item['term']->name?></h2>
            <div class="list">
                <?php foreach ($item['result'] as $item2){ ?>
                    <div class="item" onclick="document.location.href = '<?php the_permalink($item2->ID)?>'">
                        <div class="icon">
                            <i class="<?=get_post_meta($item2->ID, 'icon', 1)?>" aria-hidden="true"></i>
                        </div>
                        <h4 class="title"><a href="<?php the_permalink($item2->ID)?>"><?=$item2->post_title?></a></h4>
                        <div class="services-description"><?=get_post_meta($item2->ID, 'services-description', 1)?></div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
<?php get_footer(); ?>