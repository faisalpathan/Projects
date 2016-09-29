<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Onefold
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
	  /**
	   * Hook - onefold_single_image.
	   *
	   * @hooked onefold_add_image_in_single_display -  10
	   */
	  do_action( 'onefold_single_image' );
	?>

	<div class="entry-content-wrapper">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'onefold' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .entry-content-wrapper -->

	<footer class="entry-footer">
		<?php onefold_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
