<?php
global $wdwt_front, $post;
get_header();

$business_elite_meta_data = get_post_meta($post->ID, WDWT_META, TRUE);
$blog_style = $wdwt_front->blog_style();
$grab_image = $wdwt_front->get_param('grab_image');
$show_featured_image = $wdwt_front->get_param('show_featured_image', $business_elite_meta_data, false);
$single_title_bg = $wdwt_front->get_param('single_title_bg', array(), true);

?>

	</header>

	<div class="<?php echo $single_title_bg ?  'before_blog_2' : 'before_blog_1'; ?>">
		<h2><?php the_title(); ?></h2>
	</div>
<?php	if($single_title_bg) { ?>
	<div class="before_blog"></div>
<?php	} ?>

	<div class="container">
		<!--SIDEBAR_1-->
		<?php
		if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<aside id="sidebar1" >
				<div class="sidebar-container">
					<?php  dynamic_sidebar( 'sidebar-1' ); 	?>
					<div class="clear"></div>
				</div>
			</aside>
		<?php } ?>

		<div id="blog" class="blog">
			<!-- Default page's content -->
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<div class="single-post">
					<!--image-->
					<?php
					if ( $show_featured_image){
						if(has_post_thumbnail()){ ?>
							<div class="img_container fixed size400x250">
								<?php echo Business_elite_frontend_functions::fixed_thumbnail(400,250, false); ?>
							</div>
							<?php
						}
					} ?>
					<!--content-->
					<div class="entry"> <?php the_content(); ?> </div>
				</div>
			<?php endwhile; ?>

				<div class="navigation">
					<?php				wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Page',  "business-elite" ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="page-links-number">', 'link_after' => '</span>' ) ); ?>
				</div>
			<?php endif; ?>
			<div class="clear"></div>

			<?php $wdwt_front->bottom_advertisment(); ?>
			<!--COMMENTS-->
			<?php if(comments_open()) {  ?>
				<div class="comments-template">
					<?php comments_template();	?>
				</div>
			<?php } ?>
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

		<div class="clear"></div>




	</div>

<?php get_footer(); ?>