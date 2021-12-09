<?php get_header(); ?>

<main>
    <div class="breadcrumbs">
        <div class="breadcrumbs__wrapper wrapper">
            <a class="breadcrumbs__link" href="/">
                Каталог
            </a>
            <a class="breadcrumbs__link" href="/kontaktyi">
                Контакты
            </a>
        </div>
    </div>

    <section class="contact">
        <div class="contact__wrapper wrapper">
            <div class="contact__content">
                <h2 class="contact__title h2">
                    Контакты
                </h2>
                <div class="contact__inner">
                    <div class="contact__container">
                        <span class="contact__name">Город</span>
                        <span class="contact__value"><?=get_post_meta($post->ID, 'city', 1)?></span>
                    </div>
                    <div class="contact__container">
                        <span class="contact__name">Адреса</span>
                        <span class="contact__value">
                            <?php if(get_post_meta($post->ID, 'address_1', 1) != ''){ ?>
                                <span><?=get_post_meta($post->ID, 'address_1', 1)?></span>
                            <?php } ?>
                            <?php if(get_post_meta($post->ID, 'address_2', 1) != ''){ ?>
                                <span><?=get_post_meta($post->ID, 'address_2', 1)?></span>
                            <?php } ?>
                            <?php if(get_post_meta($post->ID, 'address_3', 1) != ''){ ?>
                                <span><?=get_post_meta($post->ID, 'address_3', 1)?></span>
                            <?php } ?>
                        </span>
                    </div>
                    <div class="contact__container">
                        <span class="contact__name">Телефоны</span>
                        <span class="contact__value">
                            <?php if(get_post_meta($post->ID, 'phone_1', 1) != ''){ ?>
                                <span><?=get_post_meta($post->ID, 'phone_1', 1)?></span>
                            <?php } ?>
                            <?php if(get_post_meta($post->ID, 'phone_2', 1) != ''){ ?>
                                <span><?=get_post_meta($post->ID, 'phone_2', 1)?></span>
                            <?php } ?>
                            <?php if(get_post_meta($post->ID, 'phone_3', 1) != ''){ ?>
                                <span><?=get_post_meta($post->ID, 'phone_3', 1)?></span>
                            <?php } ?>
                        </span>
                    </div>
                    <div class="contact__container">
                        <span class="contact__name">Email</span>
                        <span class="contact__value">
                            <?php if(get_post_meta($post->ID, 'email_1', 1) != ''){ ?>
                                <span><?=get_post_meta($post->ID, 'email_1', 1)?></span>
                            <?php } ?>
                            <?php if(get_post_meta($post->ID, 'email_2', 1) != ''){ ?>
                                <span><?=get_post_meta($post->ID, 'email_2', 1)?></span>
                            <?php } ?>
                        </span>
                    </div>
                    <div class="contact__container">
                        <span class="contact__name">Режим работы</span>
                        <span class="contact__value">
                            <?php if(get_post_meta($post->ID, 'rr', 1) != ''){ ?>
                                <span><?=get_post_meta($post->ID, 'rr', 1)?></span>
                            <?php } ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact__map">
            <?=get_post_meta($post->ID, 'map', 1)?>
        </div>
    </section>
</main>

<?php get_footer(); ?>