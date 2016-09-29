<?php
/**
 * Template part for displaying home latest news section.
 *
 * @package Onefold
 */

?>
<?php
	$latest_news_title    = onefold_get_option( 'latest_news_title' );
	$latest_news_number   = onefold_get_option( 'latest_news_number' );
	$latest_news_column   = onefold_get_option( 'latest_news_column' );
	$latest_news_category = onefold_get_option( 'latest_news_category' );
?>
<div id="latest-news" class="home-section-latest-news">
	<div class="container">

		<h2 class="section-title"><?php echo esc_html( $latest_news_title ); ?></h2>
		<?php
		$qargs = array(
			'posts_per_page' => absint( $latest_news_number ),
			'no_found_rows'  => true,
			);

		if ( absint( $latest_news_category ) > 0  ) {
			$qargs['cat'] = absint( $latest_news_category );
		}

		// Fetch posts.
		$the_query = new WP_Query( $qargs );
		?>
		<?php if ( $the_query->have_posts() ) : ?>
			<div class="inner-wrapper latest-news-wrapper latest-news-col-<?php echo absint( $latest_news_column ) ?>">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="latest-news-item">
						<div class="latest-news-thumb">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium', array( 'class' => 'aligncenter' ) ); ?></a>
							<?php endif; ?>
							<div class="latest-news-meta">
								<span class="latest-news-date"><?php the_time( 'j M Y' ); ?></span>
							</div><!-- .latest-news-meta -->
						</div><!-- .latest-news-thumb -->
						<div class="latest-news-text-wrap">
							<h3 class="latest-news-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3><!-- .latest-news-title -->
						</div><!-- .latest-news-text-wrap -->
					</div><!-- .latest-news-item -->
				<?php endwhile; ?>
			</div><!-- .latest-news-wrapper -->
			<?php wp_reset_postdata(); ?>

		<?php endif; ?>
	</div><!-- .container -->
</div><!-- .home-section-team -->
