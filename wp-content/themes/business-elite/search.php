<?php
  global $wdwt_front, $post;
	get_header();
	$blog_style = $wdwt_front->blog_style();
	$grab_image = $wdwt_front->get_param('grab_image');
	$single_title_bg = $wdwt_front->get_param('single_title_bg', array(), true);
	?>	
</header>
	
	<!--TOP_TITLE-->
	<div class="<?php echo $single_title_bg ?  'before_blog_2' : 'before_blog_1'; ?>">
		<h2><?php echo __('Search Results',"business-elite"); ?></h2>
	</div>
	<?php	if($single_title_bg) { ?>
		<div class="before_blog"></div>
	<?php	} ?>

	<div class="container">
		<div id="blog" class="search-page">
			<?php get_search_form(); ?>

			<?php 
			if( have_posts() ) {   
				while( have_posts()) : the_post(); ?>
					<div class="search-result">
						<!--title-->
						<h3 class="search-header">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<!--image-->
						<?php
							if(has_post_thumbnail() || (Business_elite_frontend_functions::post_image_url() && $blog_style && $grab_image)){
							?>
								<div class="img_container fixed size250x180">
									<?php echo Business_elite_frontend_functions::fixed_thumbnail(250,180, $grab_image); ?>
								</div>
						<?php
						} ?>
						<!--content-->
						<div class="entry">
							<?php 
							if($blog_style) { 
								Business_elite_frontend_functions::the_excerpt_max_charlength(350); 
							}
							else{ the_content(); }
							?>
						</div>
						<!--date-->
						<?php
						if($wdwt_front->get_param('date_enable')){ ?>
							<div class="home-post-date">
								<?php Business_elite_frontend_functions::posted_on_single(); ?>
							</div>
						<?php }   ?>
					</div>
				<?php 
				endwhile; ?>
				
				<!--NAVIGATION-->
				<?php Business_elite_frontend_functions::posts_nav($wp_query); ?>
				
			<?php
			}
			else { ?>
				<div class="search-no-result">
					<?php echo __(" Nothing was found. Please try another keyword.","business-elite");  ?>
					
				</div>
			<?php } ?>
			<div class="clear"></div>
			
			<?php $wdwt_front->bottom_advertisment(); ?>
			
			<?php wp_reset_query(); ?>
		</div>
	</div>
<?php get_footer(); ?>
