<?php get_header(); ?>
<section class="blog-header">
	<div class="container">
		<h1><?=get_search_query()?></h1>
		<?php
		if(function_exists('yoast_breadcrumb')){
			yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
		}
		?>
	</div>
</section>
<section class="blog-tax">
	<div class="container">
		<div class="row">
			<div class="left">
				<div class="list">
					<?php
					$search_query = array(
						's' => get_search_query(),
						'post_type' => 'post',
						'posts_per_page' => -1
					);
					$the_query = new WP_Query($search_query);
					if(!$the_query->have_posts()) {
						?>
						<div style="margin-top: 15px;">По данному запросу нечего не найдено!</div>
						<?php
					}
					while ($the_query->have_posts() ) { $the_query->the_post();
						$img_result = get_post_meta(get_the_ID(), 'images');
						?>
						<div class="item">
							<a href="<?php the_permalink()?>" class="image-archive-blog" rel="nofollow">
								<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'large' );?>" alt="">
							</a>
							<div class="meta">
								<span class="category">
									<?php
									$category = get_the_category(get_the_ID());
									foreach ($category as $key => $val){
										echo $key == 0 ? $val->name : ', ' . $val->name;
									}
									?>
								</span>
							</div>
							<h4 class="title"><a href="<?php the_permalink()?>"><?php the_title();?></a></h4>
							<div class="content-mini"><?=ShortDescription(get_the_content(), 120);?></div>
							<a href="<?php the_permalink()?>"></a>
						</div>
						<?php
					}
					wp_reset_postdata();
					?>
				</div>
			</div>
			<div class="right">
				<?php get_template_part( 'template-parts/sitebar', 'blog' )?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>