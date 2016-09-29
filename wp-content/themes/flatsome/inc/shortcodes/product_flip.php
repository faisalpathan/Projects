<?php
// [ux_product_flip]
function ux_product_flip($atts, $content = null) {
	global $woocommerce;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'products'  => '8',
    'cat' => '',

	), $atts));
	ob_start();

   $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'product_cat' => $cat,
            'products' => $products
        );
	?>
<div class="row">
<div class="large-12 columns flip-container">
      <div class="flipContainer js-flickity slider-nav-circle slider-nav-slide-in"
              data-flickity-options='{ 
                  "cellAlign": "center", 
                  "wrapAround": true,
                  "percentPosition": true,
                  "imagesLoaded": true,
                  "pageDots": true,
                  "contain": true
              }'>
              <?php if($content) { ?>
               <div class="row collapse">
                <div class="large-12 columns">
                   <?php echo fixShortcode($content); ?>
                </div><!-- large-6 -->
               </div><!-- row -->
               <?php } ?>

               <?php
                  $products = new WP_Query( $args );
                  if ( $products->have_posts() ) : ?>
                      <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                          <?php woocommerce_get_template_part( 'content', 'product-flipbook' ); ?>
                      <?php endwhile; // end of the loop. ?>
                  <?php
                  endif; 
                  wp_reset_query();
              ?>
      </div>
</div>
</div><!-- row -->

<style>
.flipContainer{
  background: #FFF;
  box-shadow: 1px 1px 10px 0px rgba(0,0,0,.2);
}
.flipContainer .featured-product{
  margin-bottom: 0;
}

.flip-slide .product-info{
  padding: 10%;
}
.flip-slide .product_meta{
  margin-bottom: 15px;
}

</style>

<?php
$content = ob_get_contents();
ob_end_clean();
return $content;
}

add_shortcode("ux_product_flip", "ux_product_flip");