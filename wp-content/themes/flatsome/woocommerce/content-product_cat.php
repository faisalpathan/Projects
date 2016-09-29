<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop, $flatsome_opt;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid.
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count
$woocommerce_loop['loop']++;

// set cat style
if(isset($flatsome_opt['cat_style'])){
	if($flatsome_opt['cat_style'] && !isset($style)) $style = $flatsome_opt['cat_style'];
}
if(!isset($style)) $style = "text-badge";

?>

<li class="product-category ux-box text-center ux-<?php echo $style; ?>">
<?php do_action( 'woocommerce_before_subcategory', $category ); ?>
<div class="inner">
    <div class="ux-box-image">
         <?php
			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );
		?>
    </div><!-- .ux-box-image -->
    <div class="ux-box-text  show-first">
       	<h3 class="uppercase header-title">
       	<?php 	echo $category->name; ?>
		</h3>
		<p class="smallest-font uppercase count"><?php if ( $category->count > 0 ) echo apply_filters( 'woocommerce_subcategory_count_html', ' ' . $category->count . ' '.__('Products','woocommerce').'', $category); ?></p>
		<?php
			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );
		?>
       
    </div><!-- .ux-box-text-overlay -->
</div>
<?php do_action( 'woocommerce_after_subcategory', $category ); ?>
</li>