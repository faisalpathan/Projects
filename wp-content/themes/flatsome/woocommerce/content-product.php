<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.5.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $flatsome_opt;


// Ensure visibilty
if ( ! $product->is_visible() ) {
	return;
}

// Get avability
$post_id = $post->ID;
$stock_status = get_post_meta($post_id, '_stock_status',true) == 'outofstock';

// run add to cart variation script
if($product->is_type( array( 'variable', 'grouped') )) wp_enqueue_script('wc-add-to-cart-variation');

?>

<li class="product-small <?php if($stock_status == "1") { ?>out-of-stock<?php }?> <?php echo $flatsome_opt['grid_style']; ?> grid-<?php echo $flatsome_opt['grid_frame']; ?>">
<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
<div class="inner-wrap">
<a href="<?php the_permalink(); ?>">
      <div class="product-image hover_<?php echo $flatsome_opt['product_hover']; ?>">
      	<?php if ( has_post_thumbnail()){ ?>
         <div class="front-image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_catalog') ?></div>
		<?php if($flatsome_opt['product_hover'] != "none" ) { ?>
		<?php
			// Get back image
			$attachment_ids = $product->get_gallery_attachment_ids();
			if ( $attachment_ids ) {
				$loop = 0;				
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );
					if ( ! $image_link )
						continue;
					$loop++;
					printf( '<div class="back-image back">%s</div>', wp_get_attachment_image( $attachment_id, 'shop_catalog' ) );
					if ($loop == 1) break;
				}
			}
		?>
		<?php } ?>
		<?php } else { echo '<img src="'.wc_placeholder_img_src().'"/>';} ?>

		 <?php if(!$flatsome_opt['disable_quick_view']){ ?>
          <div class="quick-view" data-prod="<?php echo $post->ID; ?>"><?php _e('Quick View','flatsome'); ?></div>
	   	 <?php } ?>

	   	<?php if($stock_status == "1") { ?><div class="out-of-stock-label"><?php _e( 'Out of stock', 'woocommerce' ); ?></div><?php }?>
		
		<?php if($flatsome_opt['add_to_cart_icon'] == "show") {
				echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s %s add-to-cart-grid clearfix">
						<div class="cart-icon tip-top" title="%s"> <strong> <span class="icon-inner"></span></strong><span class="cart-icon-handle"></span></div></a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr( isset( $quantity ) ? $quantity : 1 ),
						esc_attr( $product->id ),
						esc_attr( $product->get_sku() ),
						esc_attr( $product->is_type( 'variable' ) ? '' : 'ajax_add_to_cart'),
						esc_attr( isset( $class ) ? $class : 'add_to_cart_button' ),
						esc_html( $product->add_to_cart_text() )
					),
				$product );
		?>
		<?php } ?>
      </div><!-- end product-image -->
</a>      	

    <div class="info style-<?php echo $flatsome_opt['grid_style']; ?>">

	<?php 
	// GRID STYLE 1
	if(!isset($flatsome_opt['grid_style']) || $flatsome_opt['grid_style'] == "grid1"){ ?>

      <div class="text-center">
      	   <?php do_action('woocommerce_before_shop_loop_item_title'); ?>
           <p class="category">
          		<?php 
          			$products_cats = $product->get_categories();
          			if($products_cats){
	  				     list($firstpart) = explode(',', $products_cats);
	       				 echo $firstpart;
          			}
                  ?>
          </p>
          <div class="tx-div small"></div>
          <a href="<?php the_permalink(); ?>"><p class="name"><?php the_title(); ?></p></a>
          <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
      </div><!-- text-center -->

     <?php } 
     // GRID STYLE 2
     else if($flatsome_opt['grid_style'] == "grid2") { ?> 
          <?php do_action('woocommerce_before_shop_loop_item_title'); ?>
          <a href="<?php the_permalink(); ?>"><p class="name"><?php the_title(); ?></p></a>
          <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
     

     <?php }
     // GRID STYLE 3
     else if($flatsome_opt['grid_style'] == "grid3") { ?> 
	    <table>
			<tr>
				<td>
				<?php do_action('woocommerce_before_shop_loop_item_title'); ?>
			  <?php $product_cats = strip_tags($product->get_categories('|', '', '')); ?>
          	  <a href="<?php the_permalink(); ?>">
          	 	 <p class="name"><?php the_title(); ?></p>
          	  </a>
	          <p class="category"><?php
	          		if($product_cats){
	  				     list($firstpart) = explode(',', $product_cats);
	       				 echo $firstpart;
          			} ?>
          	   </p>
	           </td>
				<td><?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
				</td>
			</tr>
		 </table>
	<?php } // ?>
		
	<?php // Global list ?>

	<?php 
		if(shortcode_exists( 'yith_wcwl_add_to_wishlist' ) ) {
			// Show wishlist
			echo do_shortcode('[yith_wcwl_add_to_wishlist]'); 
		}
	?>
	</div><!-- end info -->	

</div> <!-- .inner-wrap -->
<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li><!-- li.product-small -->