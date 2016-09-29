<?php
/**
 *	The template for dispalying the bottom header section in blog.
 *
 *	@package WordPress
 *	@subpackage illdy
 */
?>
<div class="bottom-header blog">
	<div class="container">
		<div class="row">
			<?php if( is_page_template( 'page-templates/blog.php' ) || is_singular() ): ?>
				<div class="col-sm-12">
					<h2><?php the_title(); ?><span class="span-dot"><?php _e( '.', 'illdy' ); ?></span></h2>
				</div><!--/.col-sm-12-->
			<?php else: ?>
				<div class="col-sm-12">
					<?php the_archive_title( '<h2>', '<span class="span-dot">'. esc_html__( '.', 'illdy' ) .'</span></h2>' ); ?>
				</div><!--/.col-sm-12-->
				<div class="col-sm-8 col-sm-offset-2">
					<?php the_archive_description( '<p>', '</p>' ); ?>
				</div><!--/.col-sm-8.col-sm-offset-2-->
			<?php endif; ?>
		</div><!--/.row-->
	</div><!--/.container-->
</div><!--/.bottom-header.blog-->