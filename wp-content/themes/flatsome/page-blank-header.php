<?php
/*
Template name: Full Width - Blank header
*/
get_header(); ?>

<?php if( has_excerpt() ) { ?>
<div class="page-header">
	<?php the_excerpt(); ?>
</div>
<?php } ?>

<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>
			
			<?php endwhile; // end of the loop. ?>
			
</div>
<?php get_footer(); ?>
