<?php
/*
Template name: Default Template (No title)
*/
get_header(); ?>

<?php if( has_excerpt() ) { ?>
<div class="page-header">
	<?php the_excerpt(); ?>
</div>
<?php } ?>

<div  class="page-wrapper">
<div class="row">
<div id="content" class="large-12 columns" role="main">

		
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>
			
			<?php endwhile; // end of the loop. ?>

</div><!-- #content -->
</div><!-- .row  -->
</div><!-- .page-wrapper -->

<?php get_footer(); ?>
