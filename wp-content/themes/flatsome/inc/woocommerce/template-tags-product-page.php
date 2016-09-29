<?php

// Add HTML before Add to Cart button
if($flatsome_opt['html_before_add_to_cart']){
    function before_add_to_cart_html(){
        global $flatsome_opt;
        echo do_shortcode($flatsome_opt['html_before_add_to_cart']);
    }
    add_action( 'woocommerce_single_product_summary', 'before_add_to_cart_html', 20);
}


// Add HTML after Add to Cart button
if($flatsome_opt['html_after_add_to_cart']){
    function after_add_to_cart_html(){
        global $flatsome_opt;
        echo do_shortcode($flatsome_opt['html_after_add_to_cart']);
    }
    add_action( 'woocommerce_single_product_summary', 'after_add_to_cart_html', 30);
}


// Add Custom HTML to top of product page
function flatsome_product_top_content(){
  global $wc_cpdf;
  if($wc_cpdf->get_value(get_the_ID(), '_top_content')){
    echo do_shortcode($wc_cpdf->get_value(get_the_ID(), '_top_content'));
  }
}

add_action('flatsome_before_product_page','flatsome_product_top_content', 10);


// Add Custom HTML to bottom of product page
function flatsome_product_bottom_content(){
  global $wc_cpdf;
  if($wc_cpdf->get_value(get_the_ID(), '_bottom_content')){
    echo do_shortcode($wc_cpdf->get_value(get_the_ID(), '_bottom_content'));
  }
}
add_action('flatsome_after_product_page','flatsome_product_bottom_content', 10);


if(!function_exists('flatsome_product_video_button')){
function flatsome_product_video_button(){
  global $wc_cpdf;
       // Add Product Video
      if($wc_cpdf->get_value(get_the_ID(), '_product_video')){ ?>
      <a class="product-video-popup tip-top" href="<?php echo $wc_cpdf->get_value(get_the_ID(), '_product_video'); ?>" title="<?php echo __( 'Video', 'flatsome' ); ?>">
        <span class="icon-play"></span>
      </a>
      <style>
       <?php
          // Set product video height
          $height = '900px';
              $width = '900px';
              $iframe_scale = '100%';
              $custom_size = $wc_cpdf->get_value(get_the_ID(), '_product_video_size');
              if($custom_size){
                $split = explode("x", $custom_size);
                
                $height = $split[0];
                $width = $split[1];
          
          $iframe_scale = ($width/$height*100).'%';
              }
              echo '.has-product-video .mfp-iframe-holder .mfp-content{max-width: '.$width.';}';
              echo '.has-product-video .mfp-iframe-scaler{padding-top: '.$iframe_scale.'}';
         ?>
      </style>
      <?php }
  }
}
add_action('flatsome_product_image_tools','flatsome_product_video_button', 1);


if(!function_exists('flatsome_product_zoom_button')){
    function flatsome_product_zoom_button(){ ?>
      <a href="#product-zoom" class="zoom-button tip-top hide-for-small" title="<?php echo __( 'Zoom', 'flatsome' ); ?>">
        <span class="icon-expand"></span>
      </a>
    <?php
  }
}
add_action('flatsome_product_image_tools','flatsome_product_zoom_button', 2);



/* Next / Prev nav on Product Pages */
function next_post_link_product() {
    global $post;
    $next_post = get_next_post(true,'','product_cat');
    if ( is_a( $next_post , 'WP_Post' ) ) { ?>
       <div class="prod-dropdown">
                <a href="<?php echo get_the_permalink( $next_post->ID ); ?>" rel="next" class="icon-angle-left next"></a>
                <div class="nav-dropdown" style="display: none;">
                  <a title="<?php echo get_the_title( $next_post->ID ); ?>" href="<?php echo get_the_permalink( $next_post->ID ); ?>">
                  <?php echo get_the_post_thumbnail($next_post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' )) ?></a>

                </div>
            </div>
    <?php }
}

function previous_post_link_product() {
    global $post;
    $prev_post = get_previous_post(true,'','product_cat');
    if ( is_a( $prev_post , 'WP_Post' ) ) { ?>
       <div class="prod-dropdown">
                <a href="<?php echo get_the_permalink( $prev_post->ID ); ?>" rel="next" class="icon-angle-right prev"></a>
                <div class="nav-dropdown" style="display: none;">
                    <a title="<?php echo get_the_title( $prev_post->ID ); ?>" href="<?php echo get_the_permalink( $prev_post->ID ); ?>">
                    <?php echo get_the_post_thumbnail($prev_post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' )) ?></a>
                </div>
            </div>
    <?php }
}



// Change product pr page if set.
if(isset($flatsome_opt['products_pr_page'])){
  $products = $flatsome_opt['products_pr_page'];
  add_filter( 'loop_shop_per_page', create_function( '$cols', "return $products;" ), 20 );
}


/* WooCommerce extra tabs */
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
  global $wc_cpdf, $flatsome_opt;
  // Adds the new tab
  if($wc_cpdf->get_value(get_the_ID(), '_custom_tab_title')){
    $tabs['ux_custom_tab'] = array(
      'title'   =>  $wc_cpdf->get_value(get_the_ID(), '_custom_tab_title'),
      'priority'  => 40,
      'callback'  => 'ux_custom_tab_content'
    );
  }

  if($flatsome_opt['tab_title']){
  $tabs['ux_global_tab'] = array(
    'title'   => $flatsome_opt['tab_title'],
    'priority'  => 50,
    'callback'  => 'ux_global_tab_content'
  );
  }
 
  return $tabs;
 
}

function ux_custom_tab_content() {
  // The new tab content
  global $wc_cpdf;
  echo do_shortcode($wc_cpdf->get_value(get_the_ID(), '_custom_tab'));
}

function ux_global_tab_content() {
  // The new tab content
  global $flatsome_opt;
  echo do_shortcode($flatsome_opt['tab_content']);
}



/* WooCommerce Single Page Reviews */
function ProductShowReviews(){
global $flatsome_opt;

if ( comments_open() && !$flatsome_opt['disable_reviews']) {
    global $wpdb;
    global $post;

    $count = $wpdb->get_var("
        SELECT COUNT(meta_value) FROM $wpdb->commentmeta
        LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
        WHERE meta_key = 'rating'
        AND comment_post_ID = $post->ID
        AND comment_approved = '1'
        AND meta_value > 0
    ");

    $rating = $wpdb->get_var("
        SELECT SUM(meta_value) FROM $wpdb->commentmeta
        LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
        WHERE meta_key = 'rating'
        AND comment_post_ID = $post->ID
        AND comment_approved = '1'
    ");

    if ( $count > 0 ) {

        $average = number_format($rating / $count, 2);

        echo '<a href="#tab-reviews" class="scroll-to-reviews"><div class="star-rating tip-top" title="'.$count.' review(s)"><span style="width:'.($average*16).'px"><span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="rating"><span itemprop="ratingValue">'.$average.'</span><span itemprop="reviewCount" class="hidden">'.$count.'</span></span> '.__('out of 5', 'woocommerce').'</span></div></a>';

    }
    
}}

add_action('woocommerce_single_product_summary','ProductShowReviews', 15);

function flatsome_add_product_page_filter() {
    global $flatsome_opt;
    if($flatsome_opt['product_offcanvas_sidebar']){ ?>
    <div class="product-page-filtering show-for-small">
      <a href="#product-sidebar" style="font-size: 1em;" class="off-canvas-overlay filter-button" data-pos="left" data-color="light"><span class="icon-menu"></span><?php echo __( 'Categories', 'woocommerce' ); ?></a>
    </div><!-- Category filtering -->
<?php }
}

add_action('woocommerce_before_single_product', 'flatsome_add_product_page_filter', 20);

?>