<?php

// [ux_product_categories]
function ux_product_categories($atts, $content = null) {
  $sliderrandomid = rand();
  extract( shortcode_atts( array (
      'number'     => null,
      'title' => '',
      'orderby'    => 'name',
      'order'      => 'ASC',
      'type' => 'slider',
      'columns'    => '4',
      'cat' => '',
      'hide_empty' => 1,
      'parent'     => '',
      'infinitive' => 'true',
      'bullets' => 'false',
      'style' => 'text-badge',
      'offset' => '',

      ), $atts ) );
    if ( isset( $atts[ 'ids' ] ) ) {
      $ids = explode( ',', $atts[ 'ids' ] );
      $ids = array_map( 'trim', $ids );
    } else {
      $ids = array();
    }

    $hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

    // get terms and workaround WP bug with parents/pad counts
      $args = array(
        'orderby'    => $orderby,
        'order'      => $order,
        'hide_empty' => $hide_empty,
        'include'    => $ids,
        'pad_counts' => true,
        'child_of'   => 0,
        'offset' => $offset,
    );

      $product_categories = get_terms( 'product_cat', $args );

      if($cat && !$parent) $parent = $cat;

      if ( $parent !== "" )
        $product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );

      if ( $number )
        $product_categories = array_slice( $product_categories, 0, $number );



  ob_start();

  ?>
    
    <?php if($title){?> 
    <div class="row">
      <div class="large-12 columns">
        <h3 class="section-title"><span><?php echo $title ?></span></h3>
      </div>
    </div><!-- end .title -->
    <?php } ?>

   <div class="row">
    <div class="large-12 columns">
          <ul class="<?php if($type == 'slider') { ?>ux-row-slider js-flickity slider-nav-small slider-nav-reveal<?php } ?> large-block-grid-<?php echo $columns; ?> small-block-grid-2"
           data-flickity-options='{ 
              "cellAlign": "left", 
              "wrapAround": <?php echo $infinitive; ?>,
              "percentPosition": true,
              "imagesLoaded": true,
              "pageDots": <?php echo $bullets; ?>,
              "selectedAttraction" : 0.08,
              "friction": 0.8,
              "contain": true
          }'>
          <?php
          if ( $product_categories ) {
            foreach ( $product_categories as $category ) {
              woocommerce_get_template( 'content-product_cat.php', array(
                'category' => $category,
                'style' => $style
              ) );
            }
          }
          woocommerce_reset_loop();  ?>     
          </ul>
      </div>            
    </div><!-- .row .column-slider -->

  
  <?php

  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}



// [ux_product_categories_grid]
function ux_product_categories_grid($atts, $content = null) {
  extract( shortcode_atts( array (
      'number'     => 9999,
      'orderby'    => 'name',
      'order'      => 'ASC',
      'hide_empty' => 0,
      'parent'     => '',
      'height' => '600px',
      'grid' => '1',
      'padding' => '15px',
      'offset' => '',
      'bg_overlay' => '#000',
      ), $atts ) );

    $hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

      $args = array(
        'orderby'    => $orderby,
        'order'      => $order,
        'hide_empty' => $hide_empty,
        'pad_counts' => true,
        'child_of'   => $parent,
        'offset' => $offset,
    );

      $product_categories = get_terms( 'product_cat', $args );
      if ( $parent !== "" )
        $product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );

      if ( $number )
        $product_categories = array_slice( $product_categories, 0, $number );

      $bannergridID = rand();
      $tall_height = $height;
      $less_tall_height = $height-($height/3)-($padding/2).'px';
      $small_height = ($height/2)-($padding/2).'px';
      $smallest_height = ($height/3)-($padding/1.5).'px';
      $g_total = '0';

            if($grid == '1'){
                    $g_total = '5';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-6 small-12',
                      'height2' => $tall_height,'span2' => 'large-3 small-6',
                      'height3' => $small_height,'span3' => 'large-3 small-6',
                      'height4' => $small_height,'span4' => 'large-3 small-6',
                      'height5' => $small_height,'span5' => 'large-3 small-6',
                      );
                  }
                  if($grid == '2'){
                    $g_total = '4';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-12 small-12',
                      'height2' => $smallest_height,'span2' => 'large-4 small-12',
                      'height3' => $smallest_height,'span3' => 'large-4 small-12',
                      'height4' => $smallest_height,'span4' => 'large-4 small-12',
                      );
                  }

                  if($grid == '3'){
                    $g_total = '3';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-6 small-12',
                      'height2' => $small_height,'span2' => 'large-6 small-6',
                      'height3' => $small_height,'span3' => 'large-3 small-6',
                      );
                  }

                  if($grid == '4'){
                    $g_total = '1';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-3 small-6',
                     
                      );
                  }

                  if($grid == '5'){
                    $g_total = '1';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-4 small-6',
                     
                      );
                  }

                  if($grid == '6'){
                    $g_total = '4';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-8 small-12',
                      'height2' => $small_height,'span2' => 'large-4 small-6',
                      'height3' => $small_height,'span3' => 'large-4 small-6',
                      'height4' => $small_height,'span4' => 'large-4 small-6',
                      );
                  }


                  if($grid == '7'){
                    $g_total = '4';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-3 small-6',
                      'height2' => $tall_height,'span2' => 'large-6 small-12',
                      'height3' => $small_height,'span3' => 'large-3 small-6',
                      'height4' => $small_height,'span4' => 'large-3 small-6',
                      );
                  }

                if($grid == '8'){
                    $g_total = '4';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-3 small-6',
                      'height2' => $tall_height,'span2' => 'large-6 small-12',
                      'height3' => $tall_height,'span3' => 'large-3 small-6',
                      'height4' => $small_height,'span4' => 'large-3 small-6',
                      );
                  }

                if($grid == '9'){
                    $g_total = '2';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-6 small-12',
                      'height2' => $small_height,'span2' => 'large-3 small-6',
                      );
                  }

                if($grid == '10'){
                    $g_total = '5';
                    $g = array(
                      'height1' => $tall_height,'span1' => 'large-6 small-12',
                      'height2' => $smallest_height,'span2' => 'large-6 small-12',
                      'height3' => $smallest_height,'span3' => 'large-3 small-12',
                      'height4' => $smallest_height,'span4' => 'large-3 small-12',
                      'height5' => $smallest_height,'span5' => 'large-6 small-12',
                      );
                  }

                 if($grid == '11'){
                    $g_total = '5';
                    $g = array(
                      'height1' => $less_tall_height,'span1' => 'large-6 small-12',
                      'height2' => $less_tall_height,'span2' => 'large-3 small-12',
                      'height3' => $tall_height,'span3' => 'large-3 small-12',
                      'height4' => $smallest_height,'span4' => 'large-3 small-12',
                      'height5' => $smallest_height,'span5' => 'large-6 small-12',
                      );
                  }

                  if($grid == '12'){
                    $g_total = '6';
                    $g = array(
                      'height1' => $smallest_height,'span1' => 'large-8 small-12',
                      'height2' => $smallest_height,'span2' => 'large-4 small-12',
                      'height3' => $smallest_height,'span3' => 'large-4 small-12',
                      'height4' => $smallest_height,'span4' => 'large-8 small-12',
                      'height5' => $smallest_height,'span5' => 'large-8 small-12',
                      'height6' => $smallest_height,'span6' => 'large-4 small-12',
                      );
                  }


                  if($grid == '13'){
                    $g_total = '6';
                    $g = array(
                      'height1' => $less_tall_height,'span1' => 'large-6 small-12',
                      'height2' => $small_height,'span2' => 'large-3 small-12',
                      'height3' => $tall_height,'span3' => 'large-3 small-12',
                      'height4' => $smallest_height,'span4' => 'large-6 small-12',
                      'height5' => $small_height,'span5' => 'large-3 small-12',
                      'height6' => $smallest_height,'span6' => 'large-6 small-12',
                      );
                  }


                  if($grid == '14'){
                    $g_total = '6';
                    $g = array(
                      'height1' => $smallest_height,'span1' => 'large-9 small-12',
                      'height2' => $tall_height,'span2' => 'large-3 small-12',
                      'height3' => $less_tall_height,'span3' => 'large-3 small-12',
                      'height4' => $smallest_height,'span4' => 'large-3 small-12',
                      'height5' => $smallest_height,'span5' => 'large-3 small-12',
                      'height6' => $smallest_height,'span6' => 'large-6 small-12',
                      );
                   }

  ob_start();

  ?>
  
  <?php if($padding){ $padding_w = $padding/2; ?>
          <style>
          #banner_grid_<?php echo $bannergridID ?> .ux_banner-grid{margin-left: -<?php echo $padding_w; ?>px !important; margin-right: -<?php echo $padding_w ?>px !important;}
          #banner_grid_<?php echo $bannergridID ?> .ux_banner-grid .columns{margin-bottom: <?php echo $padding; ?>!important} 
          #banner_grid_<?php echo $bannergridID ?> .ux_banner-grid .columns > .column-inner{padding-left: <?php echo $padding_w; ?>px !important; padding-right: <?php echo $padding_w ?>px !important;}
          </style>
  <?php } ?>
  <div id="banner_grid_<?php echo $bannergridID ?>">
    <div class="row">
      <div class="large-12 columns">
        <div class="row collapse ux_banner-grid ux_banner-grid-new">
         <?php 
        /**
        * Check if WooCommerce is active
        **/
        if(function_exists('wc_print_notices')) { ?>
         <?php
           if ( $product_categories ) {
            foreach ( $product_categories as $category ) {
              
                global $woocommerce_loop;

                  // Store loop count we're currently on
                  if ( empty( $woocommerce_loop['loop'] ) )
                    $woocommerce_loop['loop'] = 0;

                  // Increase loop count
                  $woocommerce_loop['loop']++;

                  if($woocommerce_loop['loop'] < $g_total){
                    $cat_span = $g['span'.$woocommerce_loop['loop']];
                    $cat_height = $g['height'.$woocommerce_loop['loop']];
                  }  else {
                    $cat_span = $g['span'.$g_total];
                    $cat_height = $g['height'.$g_total];
                  }

                  $idcat = $category->woocommerce_term_id;
                  $thumbnail_id = get_woocommerce_term_meta( $idcat, 'thumbnail_id', true );

                  $image =  wp_get_attachment_image_src(  $thumbnail_id, 'large' );
                  $image = $image[0];

                  if ( $category->count > 0 ) $cat_count = apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">' . $category->count . ' '.__('Products','woocommerce').'</span>', $category);
                  $cat_link = get_term_link( $category->slug, 'product_cat' );
                  ?>
                  <div class="columns ux-grid-column <?php echo $cat_span;?>" style="height:<?php echo $cat_height; ?>">
                  <div class="column-inner cat-banner">
                  <?php echo fixShortcode('
                  [ux_banner bg_overlay="'.$bg_overlay.'" link="'.$cat_link.'" hover="fade" text_color="light" bg="'.$image.'" tx_color="dark" animate="none" tx_width="60%"]
                  <h2 class="uppercase cat-title">'.$category->name.'</h2><p class="cat-count hide-for-small lead uppercase">'.$cat_count.'</p>
                  [/ux_banner]'); ?>
                  </div><!-- .column-inner -->
                  </div><!-- .columns --> <?php

            }
          }
          woocommerce_reset_loop();  
         ?>
          <?php } ?>
        </div>
      </div>
    </div>
    <script>
    jQuery(document).ready(function ($) {
        var $container = $("#banner_grid_<?php echo $bannergridID ?> .ux_banner-grid");
        $container.packery({
          itemSelector: ".columns",
          gutter: 0
        });
     });
  </script>
  </div><!-- #grid -->
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

add_shortcode("ux_product_categories", "ux_product_categories");
add_shortcode("ux_product_categories_grid", "ux_product_categories_grid");