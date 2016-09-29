<?php
/**
 * Template part for displaying home portfolio section.
 *
 * @package Onefold
 */

?>
<?php
	$portfolio_title    = onefold_get_option( 'portfolio_title' );
	$portfolio_number   = onefold_get_option( 'portfolio_number' );
	$portfolio_column   = onefold_get_option( 'portfolio_column' );
	$portfolio_category = onefold_get_option( 'portfolio_category' );
?>
<div id="onefold-portfolio" class="home-section-portfolio">
	<div class="container">
		<h2 class="section-title"><?php echo esc_html( $portfolio_title ); ?></h2>
		<?php
		$qargs = array(
			'posts_per_page' => absint( $portfolio_number ),
			'no_found_rows'  => true,
			'meta_query'     => array(
				array(
					'key' => '_thumbnail_id',
					),
				),
			);

		if ( absint( $portfolio_category ) > 0  ) {
			$qargs['cat'] = absint( $portfolio_category );
		}

		// Fetch posts.
		$the_query = new WP_Query( $qargs );
		?>
		<?php if ( $the_query->have_posts() ) : ?>
			<div class="inner-wrapper portfolio-wrapper portfolio-col-<?php echo absint( $portfolio_column ) ?>">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="portfolio-item">
						<div class="portfolio-item-inner">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
								<?php
									$image_detail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
								 ?>
								<a href="<?php echo esc_url( $image_detail[0] ); ?>" class="popup-link"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
							<?php endif; ?>

						</div><!-- .portfolio-item-inner -->
					</div><!-- .portfolio-item -->

				<?php endwhile; ?>
			</div><!-- .portfolio-wrapper -->
			<?php wp_reset_postdata(); ?>

		<?php endif; ?>
	</div> <!-- .container -->
</div><!-- .home-section-portfolio -->
