<?php  /* The Template for displaying all single posts */ ?>

	<?php 
	global $wdwt_front, $post; 
	get_header(); 
	
	$business_elite_meta_data = get_post_meta($post->ID,WDWT_META,TRUE); 
	$lbox_width = $wdwt_front->get_param('lbox_image_width');
	$lbox_height = $wdwt_front->get_param('lbox_image_height');
	$lbox_disable = $wdwt_front->get_param('lbox_disable');
	$show_featured_image = $wdwt_front->get_param('show_featured_image', $business_elite_meta_data, true);
	$single_title_bg = $wdwt_front->get_param('single_title_bg', array(), true);
	
	?>
</header>

	<!--TOP_TITLE-->
	<div class="<?php echo $single_title_bg ?  'before_blog_2' : 'before_blog_1'; ?>">
		<h2><?php the_title(); ?></h2>
	</div>
	<?php	if($single_title_bg) { ?>
		<div class="before_blog"></div>
	<?php	} ?>

	<div class="container">		
		<!--SIDEBAR_1-->
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<aside id="sidebar1" >
				<div class="sidebar-container">			
					<?php  dynamic_sidebar( 'sidebar-1' ); 	?>	
					<div class="clear"></div>
				</div>
			</aside>
		<?php } ?>
		
		<div id="blog" class="blog">
			<?php $wdwt_front->integration_top(); ?>
			
			<?php 
			$id=0;
			if(have_posts()) :  while(have_posts()) : the_post(); ?>
				<div class="single-post" >
					<?php 
					if (is_sticky($post->ID)) {
						$post_class="class='sticky_post'"; 
					}
					else  $post_class=""; 
					
					$url = wp_get_attachment_url( get_post_thumbnail_id() );
					if ( has_post_thumbnail() && $url  && $show_featured_image ) { ?>
						<div class="post-thumbnail-div">
							<h2 rel="post-thumbnail-div-<?php echo $id; ?>-title"  style="display:none;" ><?php the_title(); ?></h2>
							<div class="post-thumbnail" style="background-image:url(<?php echo $url;?>); background-size:cover; border:1px solid #f4f4f4; position:relative;"> 
							  <?php if(!$lbox_disable){ ?>
									<a href="<?php echo $url; ?>" class=" " onclick="wdwt_lbox.init(this, 'wdwt-lightbox', <?php echo intval($lbox_width);?> , <?php echo intval($lbox_height);?>); return false;" rel="wdwt-lightbox" id="post-thumbnail-div-<?php echo $id; ?>">
										<div class="eye_single" id="eye_bg"></div>
									</a>
								<?php } ?>
							</div>
						</div> 
					<?php } ?>
					<div class="entry"><div id="post-<?php the_ID(); ?>" <?php echo $post_class; ?>><?php  the_content(); ?></div></div>
				</div>
				
				<div class="clear"></div> 
				
				<?php 
				if($wdwt_front->get_param('date_enable', $business_elite_meta_data, false)){ ?>
					<div class="entry-meta">
						<?php Business_elite_frontend_functions::posted_on_single(); ?>
					</div>
					<?php Business_elite_frontend_functions::entry_meta(); 
				} ?>
				
				<?php 
				$wdwt_front->integration_bottom(); 
				
				wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Page',  "business-elite" ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="page-links-number">', 'link_after' => '</span>' ) ); ?>
				
				<?php Business_elite_frontend_functions::post_nav(); ?>
		
				<?php 
				$id++;
				endwhile;  endif; 
				$id=0;
				?>

					
				<?php $wdwt_front->bottom_advertisment(); ?>
					
				<div class="clear"></div>
					
				<!--COMMENTS-->
				<?php
				if( comments_open() || get_comments_number() ) {  ?>
					<div class="comments-template">
						<?php comments_template();	?>
					</div>
				<?php }  ?>
		</div>
	
		<!--SIDEBAR_2-->
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<aside id="sidebar2"  class="widget-area">
				<div class="sidebar-container">
					<?php  dynamic_sidebar( 'sidebar-2' ); 	?>
					<div class="clear"></div>
				</div>
			</aside>
		<?php } ?>
	</div>

<?php get_footer(); ?>