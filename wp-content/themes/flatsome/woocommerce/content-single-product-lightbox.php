 <?php
	global $post, $product, $woocommerce;
	$attachment_ids = $product->get_gallery_attachment_ids();

	// run quick view hooks
	do_action('wc_quick_view_before_single_product');
?> 
           
<div class="row collapse">

<div class="large-7 columns">    
     <div class="product-image images">
				<div  class="product-gallery-slider ux-slider slider-nav-circle-hover slider-nav-small js-flickity" style="margin-bottom:0"
				>
				<?php if ( has_post_thumbnail() ) { ?>
            	
				<?php
					//Get the Thumbnail URL
					$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
					$src_small = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),  apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ));
					$src_title = get_post(get_post_thumbnail_id())->post_title;
					
				?>
             
                <div class="slide first">
                	<img itemprop="image" src="<?php echo $src_small[0]; ?>" alt="<?php echo $src_title; ?>" title="<?php echo $src_title; ?>" />
                </div>
				
				<?php } else { echo '<div class="slide"><img src="'.wc_placeholder_img_src().'" title="'.get_the_title().'" alt="'.get_the_title().'"/></div>';} ?>
                
				<?php

					if ( $attachment_ids ) {
				
						$loop = 0;
						$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );						
						
						foreach ( $attachment_ids as $attachment_id ) {

							$src = wp_get_attachment_image_src( $attachment_id, false, '' );
							$image = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
							$image_small = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_thumbnail' ) );
							$image_title = esc_attr( get_the_title( $attachment_id ) );
							?>
							<div class="slide">
            					<img src="<?php echo $image_small[0]; ?>" data-flickity-lazyload="<?php echo $image[0] ?>" alt="<?php echo $image_title ?>" title="<?php echo $image_title ?>" />
           				 	</div>
							<?php
						}
					}
				?>
		</div>
        <?php if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
         	<?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
        <?php } ?>
</div><!-- end product-image -->
</div><!-- large-6 -->

<div class="large-5 columns">
	<div class="product-lightbox-inner product-info">
	<h1 itemprop="name" class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	<div class="tx-div small"></div>
	<?php do_action( 'woocommerce_single_product_lightbox_summary' ); ?>
	</div>
</div>

</div><!-- .row -->

<?php do_action('wc_quick_view_after_single_product'); ?>