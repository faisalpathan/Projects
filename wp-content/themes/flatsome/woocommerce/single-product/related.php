<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $flatsome_opt;


if(!isset($flatsome_opt['max_related_products'])) {$flatsome_opt['max_related_products'] = '12';}

$related = $product->get_related($flatsome_opt['max_related_products']);

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );
if(!isset($flatsome_opt['related_products_pr_row'])) {$flatsome_opt['related_products_pr_row'] = '4';}


if($flatsome_opt['related_products'] !== 'hidden' && $products->have_posts() ) : ?>

<div class="related products">
<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>
    <ul class="<?php if($flatsome_opt['related_products'] == 'slider') echo 'ux-row-slider slider-nav-push slider-nav-reveal js-flickity '; ?> 
    	large-block-grid-<?php echo $flatsome_opt['related_products_pr_row']; ?> small-block-grid-2"
			data-flickity-options='{ 
	            "cellAlign": "left",
	            "wrapAround": true,
	            "autoPlay": false,
	            "imagesLoaded": true,
	            "prevNextButtons":true,
	            "percentPosition": true,
	            "pageDots": false,
	            "rightToLeft": false,
	            "contain": true
	        }'
    		>
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>
    </ul>
	
</div><!-- Related products -->

<?php

wp_reset_postdata();
endif;
