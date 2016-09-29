<?php
get_header(); ?>

<div  class="page-wrapper page-featured-item">
<div class="row">

<div id="content" class="large-12 columns" role="main">
	<header class="entry-header ">
		<h1 class="entry-title"><?php single_term_title(); ?></h1>
	</header>
	
 <ul class="large-block-grid-3">
	<?php							
				while ($wp_query->have_posts()) : $wp_query->the_post();
				?>
       		    <li class="ux-box featured-item text-center ux-text-bounce ">
		            <div class="inner">
		              <a href="<?php echo get_permalink(get_the_ID()); ?>" title="<?php the_title(); ?>">
		                <div class="ux-box-image">
		                      <?php the_post_thumbnail('thumbnail'); ?>
		                </div><!-- .ux-box-image -->
		                <div class="ux-box-text">
		                    <h4 class="uppercase"><?php the_title(); ?></h4>

		                     <p class="show-next small-font uppercase">
		                      <?php  echo strip_tags ( get_the_term_list( get_the_ID(), 'featured_item_category', "",", " ) );?>
		                    </p>
		                     <div class="tx-div small"></div>

		                </div><!-- .ux-box-text-overlay -->
		              </a>
		           </div>
		          </li>
				<?php endwhile; // end of the loop. ?>
</ul>

<!-- PAGINATION -->
<div class="row">
<div class="large-12 columns">
	<div class="pagination-centered">
  	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
			'format' 		=> '',
			'current' 		=> max( 1, get_query_var('paged') ),
			'total' 		=> $wp_query->max_num_pages,
			'prev_text' 	=> '<span class="icon-angle-left"></span>',
			'next_text' 	=> '<span class="icon-angle-right"></span>',
			'type'			=> 'list',
			'end_size'		=> 3,
			'mid_size'		=> 3
		) ) );
	?>

</div><!--  end pagination container -->
</div><!-- end large-12 -->
</div>
<!-- end PAGINATION -->

<?php wp_reset_query(); ?>


</div><!-- end #content large-12  -->

</div><!-- end row -->
</div><!-- end portfolio container -->


<?php get_footer(); ?>
