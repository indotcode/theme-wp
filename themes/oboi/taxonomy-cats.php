<?php
if(get_query_var('paged') != 0){
    header("Status: 301 Moved Permanently");
    header("Location: /cats/" . get_queried_object()->slug);
    exit;
}
?>
<?php get_header(); ?>
    <div class="container">
        <div class="women_main">
            <div class="col-md-9 w_content">
                <div class="row" data-cotalog>
                    <?php
                    include Router::Root() . '/ajax-temp/feed-goods.php'
                    ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="w_sidebar">
                    <?php include "include/filter.php";?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();