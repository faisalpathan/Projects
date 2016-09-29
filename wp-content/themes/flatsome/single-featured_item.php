<?php

get_header(); ?>

<div  class="page-wrapper page-left-sidebar page-featured-item">
<div class="row">

<div id="content" class="large-3 columns left" role="main">
<header class="entry-header">
	<div class="featured_item_cats">
		<?php echo get_the_term_list( get_the_ID(), 'featured_item_category', '', ', ', '' ); ?> 
	</div>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="tx-div small"></div>
</header><!-- .entry-header -->

<div class="entry-summary">
		<?php the_excerpt();?>
		
		<?php echo do_shortcode('[share]')?>
	
	    <?php if(get_the_term_list( get_the_ID(), 'featured_item_tag')) { ?> 
	    <div class="item-tags">
	    	<span><?php _e('Tags','woocommerce'); ?>:</span><?php echo strip_tags (get_the_term_list( get_the_ID(), 'featured_item_tag', '', ' / ', '' )); ?>
	    </div>
	    <?php } ?>

</div><!-- .entry-summary -->

</div><!-- #content -->

<div  class="large-9 right columns" >
<div class="page-inner">
		<?php while ( have_posts() ) : the_post(); ?>
				<?php if(get_the_content()) {the_content();} else {
					the_post_thumbnail('large');
				}; ?>
		<?php endwhile; wp_reset_query(); // end of the loop. ?>
</div><!-- .page-inner -->
</div><!-- .#content large-9 left -->

</div><!-- .row -->
</div><!-- -page-right-sidebar .container -->

<div class="row"><div class="large-12 columns"><hr></div></div>

<?php 
// RELATED SLIDER
global $flatsome_opt;
$get_cat = get_the_terms( get_the_ID(), 'featured_item_category', '', ', ', '' );

$category = '';
if($get_cat) $category = current($get_cat)->slug;

if(!isset($flatsome_opt['featured_items_related']) || $flatsome_opt['featured_items_related'] == 'default') {
echo do_shortcode('[featured_items_slider style="1" items="999" height="'.$flatsome_opt['featured_items_related_height'].'" cat="'.$category.'"]');
} else if($flatsome_opt['featured_items_related'] == 'text_overlay') {
	echo do_shortcode('[featured_items_slider items="999" style="2" height="'.$flatsome_opt['featured_items_related_height'].'" cat="'.$category.'"]');
}


?>

<?php get_footer(); ?>