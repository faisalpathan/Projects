<?php get_header();
global $wdwt_front;
$blog_style = $wdwt_front->blog_style();
$grab_image = $wdwt_front->get_param('grab_image');
?>

<div class="container">
	<!--SIDEBAR_1-->
	<?php 
	if ( is_active_sidebar( 'sidebar-1' ) ){ ?>
		<aside id="sidebar1" >
			<div class="sidebar-container">			
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>
				<div class="clear"></div>
			</div>
		</aside>
	<?php } ?>
		
	<div class="blog">
		<?php Business_elite_frontend_functions:: category_tab(); ?>
		
		<div class="clear"></div>
		
		<div id="blog" class="content-inner-block">
			<?php
			if(have_posts()) { 
				while (have_posts()) {
					the_post();  ?>
					<div class="blog-post">			 
						<a href="<?php echo get_permalink() ?>">
							<h2><?php the_title(); ?></h2>
						</a>
						<?php
						if($wdwt_front->get_param('date_enable')){ ?>
							<div class="home-post-date">
								<?php echo Business_elite_frontend_functions::posted_on();?>
							</div>
						<?php 
						} 
						if(has_post_thumbnail() || (Business_elite_frontend_functions::post_image_url() && $blog_style && $grab_image)){
							?>
								<div class="img_container unfixed ">
									<?php echo Business_elite_frontend_functions::auto_thumbnail($grab_image); ?>
								</div>
						<?php
							}

					  if($blog_style){
						  the_excerpt();
						}
						else {
						  the_content(__('More', "business-elite"));
						}  
						?>
						<div class="clear"></div>
					</div>
				<?php } ?>
				
				<!--NAVIGATION-->
				<?php
				if( $wp_query->max_num_pages > 2 ){ ?>
					<div class="page-navigation">
						<?php posts_nav_link(); ?>
					</div>	   
				<?php }	
			} ?>
			<div class="clear"></div>
			<?php  $wdwt_front->bottom_advertisment();  wp_reset_query(); ?>			
		</div>
	</div>
	<!--SIDEBAR_2-->
	<?php
	if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<aside id="sidebar2">
			<div class="sidebar-container">
			  <?php  dynamic_sidebar( 'sidebar-2' ); 	?>
			  <div class="clear"></div>
			</div>
		</aside>
	<?php } ?>
</div>
<?php get_footer(); ?>