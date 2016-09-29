<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ( $wp_query->max_num_pages <= 1 )
	return;
?>

<!-- PAGINATION -->
<nav class="woocommerce-pagination">
<div class="large-12 columns">
	<div class="pagination-centered">
	<?php
		echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),			'format'       => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text' 	=> '<span class="icon-angle-left"></span>',
			'next_text' 	=> '<span class="icon-angle-right"></span>',
			'type'         => 'list',
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
	?>
</div><!--  end pagination container -->
</div><!-- end large-12 -->
</nav>
<!-- end PAGINATION -->