<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 4 );

	$arrows = '';
	$thumb_count = count($attachment_ids)+1;

	if($thumb_count <= 5){
		$arrows = 'slider-no-arrows';
	}

	?>
	<ul class="product-thumbnails <?php echo $arrows; ?> thumbnails js-flickity slider-nav-small"
		data-flickity-options='{ 
	            "cellAlign": "left",
	            "wrapAround": false,
	            "autoPlay": false,
	            "prevNextButtons":true,
	            "asNavFor": ".product-gallery-slider",
	            "percentPosition": true,
	            "imagesLoaded": true,
	            "pageDots": false,
	            "selectedAttraction" : 0.1,
	            "friction": 0.6,
	            "rightToLeft": false,
	            "contain": true
	        }'
		><?php
		$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
		if ( has_post_thumbnail() ) : ?>
			<li class="is-nav-selected first"><a href="<?php echo $src[0] ?>"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) ) ?></a></li>
		<?php endif;

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image_title 	= esc_attr( get_the_title( $attachment_id ) );
			$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );

			$image_class = esc_attr( implode( ' ', $classes ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><a  href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a></li>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}
	?></ul>
	<?php
} ?>