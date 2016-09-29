<?php
/**
 * WooCommerce Nested Category Layout
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Nested Category Layout to newer
 * versions in the future. If you wish to customize WooCommerce Nested Category Layout for your
 * needs please refer to http://www.skyverge.com/product/woocommerce-nested-category-layout/ for more information.
 *
 * @package   WC-Nested-Category-Layout/Templates
 * @author    SkyVerge
 * @copyright Copyright (c) 2012-2015, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

/**
 * The Template for displaying nested category products
 *
 * Override this template by copying it to yourtheme/woocommerce/loop/nested-category.php
 *
 * @global array $woocommerce_product_category_ids an array of product id to containing category ids
 * @global object $category current category object
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop, $flatsome_opt;


	$woocommerce_loop['columns'] = $flatsome_opt['category_row_count'];

$mobile_columns = '2';
if(isset($flatsome_opt['category_row_count_mobile'])){ $mobile_columns = $flatsome_opt['category_row_count_mobile']; }


$class = isset( $category->depth ) ? 'product-category-level-' . ( $category->depth + 2 ) : 'product-category-level-1';
$see_more = false;
$woocommerce_loop['loop'] = 0;
?>

<style>
	.wc-nested-category-layout-category-title + img{display:none;}
	.wc-nested-category-layout-category-title{text-transform: uppercase;}
</style>

<?php if(!empty($woocommerce_loop)){ ?>
	<ul class="subcategory-products products small-block-grid-<?php echo $mobile_columns; ?> large-block-grid-<?php echo $woocommerce_loop["columns"]; ?> <?php echo $class; ?>">
<?php } else if (isset( $flatsome_opt['category_row_count'])) { ?>
	<ul class="subcategory-products products small-block-grid-<?php echo $mobile_columns; ?> large-block-grid-<?php echo $flatsome_opt['category_row_count']; ?> <?php echo $class; ?>">
<?php } else { ?>
	<ul class="subcategory-products products small-block-grid-<?php echo $mobile_columns; ?> large-block-grid-4 <?php echo $class; ?>">
<?php } ?>

	<?php

	if ( ! is_object( $category ) ) $term_id = 0;
	else $term_id = $category->term_id;

	// loop through all products
	if ( have_posts() ) : while ( have_posts() ) : the_post();

		global $product;

		if ( ! $product ) {
			continue;
		}

		$product_category_ids = $woocommerce_product_category_ids[ $product->id ];

		// ensure that the product is visible, and belongs to this category
		if ( ! $product->is_visible() || ! in_array( $term_id, $product_category_ids ) ) continue;

			// "view more" link
		if ( $woocommerce_loop['loop'] > get_option( 'woocommerce_subcat_posts_per_page' ) - 1 && isset( $woocommerce_loop['see_more'] ) && $woocommerce_loop['see_more'] ) {
			$see_more = true;
			break;
		}
		$woocommerce_loop['loop'] ++;

		// display the product thumbnail content
		wc_get_template_part( 'content', 'product' );


	endwhile; endif;

	?>

</ul>
<?php if ( $see_more ) : ?>
	<a class="woocommerce-nested-category-layout-see-more clearfix button small alt-button" href="<?php echo esc_attr( get_term_link( $category ) ) ?>"><?php echo apply_filters( 'wc_nested_category_layout_see_more_message', __( 'See more', WC_Nested_Category_Layout::TEXT_DOMAIN ), $category ); ?></a>
<?php endif; ?>
<hr/>