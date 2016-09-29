<?php

// [featured_items_slider]
function ux_featured_items($atts, $content = null, $tag) {
  $sliderrandomid = rand();
  extract(shortcode_atts(array(
        'items'  => '8',
        'columns' => '4',
        'cat' => '',
        'style' => '1',
        'height' => '',
        'type' => 'grid',
        'infinitive' => 'true',
        'lightbox' => 'false',
        'order' => 'menu_order',
  ), $atts));
  ob_start();
  if($tag == 'featured_items_slider') {
      $type = 'slider';
  } 
  ?>
  <div class="row">
    <div class="large-12 columns">
  <ul class="<?php if($type == 'slider') { ?>js-flickity slider-nav-circle <?php if($style == '1') { echo 'slider-nav-push';} ?> <?php } ?>  large-block-grid-<?php echo $columns; ?> small-block-grid-2"
       <?php if($type == 'slider') { ?>
        data-flickity-options='{ 
            "cellAlign": "left", 
            "wrapAround": <?php echo $infinitive; ?>,
            "percentPosition": true,
            "imagesLoaded": true,
            "pageDots": false,
            "contain": true,
            "selectedAttraction" : 0.05,
            "friction": 0.6
        }'
        <?php } ?> 
        >
         <?php
        global $wp_query;
        $wp_query = new WP_Query(array(
          'post_type' => 'featured_item',
          'featured_item_category' => $cat,
          'posts_per_page' => $items,
          'orderby'=> $order,
        ));
        while ($wp_query->have_posts()) : $wp_query->the_post();
          $link = get_permalink(get_the_ID());
            
          if($lightbox == 'true'){
            $link = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
            $link = $link[0];
          }
        ?>

          <li class="ux-box text-center featured-item <?php if($style == '1') echo 'ux-text-bounce'; ?> <?php if($style == '2') echo 'ux-text-overlay dark'; ?> ">
            <div class="inner">
             <div class="inner-wrap">
              <a href="<?php echo $link; ?>" title="<?php the_title(); ?>">
                <div class="ux-box-image" style="<?php if($height){ echo 'max-height:'.$height;} ?>">
                      <?php the_post_thumbnail('thumbnail'); ?>
                </div><!-- .ux-box-image -->
                <div class="ux-box-text">
                    <h4 class="uppercase"><?php the_title(); ?></h4>
                    <p class="show-next smaller-font uppercase">
                      <?php  echo strip_tags ( get_the_term_list( get_the_ID(), 'featured_item_category', "",", " ) );?>
                    </p>
                     <div class="tx-div small show-next"></div>
                </div><!-- .ux-box-text-overlay -->
              </a>
           </div>
          </div>
          </li>

        <?php endwhile; wp_reset_query(); ?>
  </ul>   <!-- .slider -->
</div>
</div>
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

add_shortcode("featured_items_slider", "ux_featured_items");
add_shortcode("featured_items_grid", "ux_featured_items");