<?php global $wdwt_front; ?>

<?php  get_header();

	$single_title_bg = $wdwt_front->get_param('single_title_bg', array(), true);
?>
</header>

	<div class="<?php echo $single_title_bg ?  'before_blog_2' : 'before_blog_1'; ?>">
		<h2><?php _e('404 Page', "business-elite"); ?></h2>
	</div>
	<?php	if($single_title_bg) { ?>
		<div class="before_blog"></div>
	<?php	} ?>
	
	<div class="container">
		
		<?php
        if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
			<aside id="sidebar1" >
				<div class="sidebar-container">			
					<?php  dynamic_sidebar( 'sidebar-1' ); 	?>	
					<div class="clear"></div>
				</div>
			</aside>
		<?php }  ?>

		
		<div id="blog" class="blog error-404">
			<div class="imgBox">
				<div class="image_404">
					<img src="<?php echo WDWT_IMG.'404.png' ?>" title="404" />
				</div>
		
				<p class="content-404"><?php _e('You are trying to reach a page that does not exist here. Either it has been moved or you typed a wrong address. Try searching:', "business-elite"); ?></p>
				
				<form role="search" method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
					<div id="searchbox">
						<div class="searchback">
							<input  type="text" id="searchinput" value="" name="s" id="s" class="searchbox_search" placeholder="<?php echo __('Type here', "business-elite"); ?>"/> 
							<input type="submit" id="searchsubmit" value="<?php echo __('GO!', "business-elite"); ?>" class="read_more" />
						</div>					
					</div>
				</form>
			</div>
			<?php $wdwt_front->bottom_advertisment(); ?>
		</div>
		
		
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<aside id="sidebar2"> 
				<div class="sidebar-container">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
					<div class="clear"></div>
				</div>
			</aside>
			<!-- #first .widget-area -->
		<?php }	?>
	</div>
	
<?php  get_footer(); ?>