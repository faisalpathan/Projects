<?php

// Instagram Feed
function ux_instagram_feed( $atts, $content = null ){
  extract( shortcode_atts( array(
    'photos' => '10',
    'username' => 'wonderful_places',
    'text' => '',
  ), $atts ) );


  if ( class_exists('null_instagram_widget')  ) {
    
    ob_start();
    the_widget( 'null_instagram_widget', array('username'=> $username,'target' => '_blank','number' => $photos, 'link' => $text), array('before_widget' => '<div class="ux-instagram-feed">', 'after_wiget' => '</div>') );
    $w = ob_get_contents();
    ob_end_clean();
    return $w;

  } else{
    echo '<mark>You need to Activate the <b>Instagram Widget</b> plugin to make it work. <a href="'.admin_url().'/themes.php?page=tgmpa-install-plugins"><b>Click here to activate it</b></a></mark>';
  }
}
add_shortcode('ux_instagram_feed', 'ux_instagram_feed');


// Current year
function ux_show_current_year(){
    return date('Y');
}
add_shortcode('ux_current_year', 'ux_show_current_year');


// [ux_price_table]
function ux_price_table( $atts, $content = null ){
  extract( shortcode_atts( array(
    'title' => 'Title',
    'price' => '$99.99',
    'description' => 'Description',
    'button_style' => 'small alt-button',
    'button_text' => 'Buy Now',
    'button_link' => '',
    'featured' => 'false',
  ), $atts ) );
  ob_start();
?>

<div class="ux_price_table text-center <?php if($featured == 'true'){ ?>featured-table box-shadow<?php } ?>">
<ul class="pricing-table">
  <li class="title"><?php echo $title;?></li>
  <li class="price"><?php echo $price;?></li>
  <li class="description"><?php echo $description;?></li>
  <?php echo fixShortcode($content); ?>
  <?php if($button_style) { ?> 
  <li class="cta-button"><a class="button <?php echo $button_style;?>" href="<?php echo $button_link;?>"><?php echo $button_text;?></a></li>
  <?php } ?>
</ul>
</div>

<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode('ux_price_table', 'ux_price_table');

// Price bullet 
function bullet_item( $atts, $content = null ){
  extract( shortcode_atts( array(
    'text' => 'Title',
    'tooltip' => '',
  ), $atts ) );

    if($tooltip) $tooltip = '<span class="bullet-more-info tip-top circle" title="'.$tooltip.'">?</span>';
    $content = '<li class="bullet-item">'.$text.''.$tooltip.'</li>';
    return $content;
}
add_shortcode('bullet_item', 'bullet_item');


// Scroll to [scroll_to link="#this" bullet="true" bullet_title="Scroll to This"]
function ux_scroll_to($atts, $content = null) {
  if(!function_exists('scroll_to_js')){
     function scroll_to_js(){
      ?>
       <script>
      jQuery(function($){
      $('body').append('<div class="scroll-to-bullets hide-for-small"/>');
      $('.scroll-to').each(function(){
            var link = $(this).data('link');
            var end = $(this).offset().top;
            var title = $(this).data('title');
            var css_class = '';
            if(title){css_class = 'tip-left';}

            $('.scroll-to-bullets').append('<a href="'+link+'" class="'+css_class+' animated fadeInRight" title="'+title+'"><strong></strong></a>');
            
            $('a[href="'+link+'"]').click(function(){
                $.scrollTo(end,500);
                e.preventDefault();
            });

            $(this).waypoint(function(direction) {
              $('.scroll-to-bullets a').removeClass('active');
              $('.scroll-to-bullets').find('a[href="'+link+'"]').addClass('active');
              if(direction == 'up'){
                $('.scroll-to-bullets').find('a[href="'+link+'"]').removeClass('active').prev().addClass('active');
              }
            });
      });

      $('.tip-left').tooltipster({position: 'left', delay: 50, contentAsHTML: true,touchDevices: false});
      
      });
      </script>
    <?php
  }
  }
  add_action('wp_footer','scroll_to_js');

  extract(shortcode_atts(array(
    'bullet' => 'true',
    'title' => '',
    'link' => '',
  ), $atts));

  return '<span class="scroll-to" data-link="'.$link.'" data-title="'.$title.'"></span>';
}

add_shortcode("scroll_to", "ux_scroll_to");

// [logo img=""]
function ux_logo( $atts, $content = null ){
  extract( shortcode_atts( array(
    'img' => '#',
    'padding' => '15px',
    'title' => '',
    'link' => '#',
    'height' => '50px',
    'width' => '130'
  ), $atts ) );

    if (strpos($img,'http://') !== false || strpos($img,'https://') !== false) {
      $org_img = $img;
      $img = $img;
    }
    else {
      $img = wp_get_attachment_image_src($img, 'large');
      $org_height = $img[2];

      $org_img = $img[0];
      $width = $img[1];

      if($height){
        $width = ($height / $org_height) * $width + ($padding*2);
      }

    }

    $content = '<div class="ux_logo"><a title="'.$title.'" href="'.$link.'" style="width: '.$width.'px; padding: '.$padding.';"><img src="'.$org_img.'" title="'.$title.'" alt="'.$title.'" style="min-height:'.$height.'" /></a></div>';
    return $content;
}
add_shortcode('logo', 'ux_logo');


// UX IMAGE
function ux_image( $atts, $content = null ){
  extract( shortcode_atts( array(
    'id' => '',
    'title' => '',
    'image_size' => 'large',
    'image_width' => '',
    'image_pull' => '0px',
    'width' => '',
    'drop_shadow' => '',
    'lightbox' => '',
    'link' => '',
    'target' => '',
  ), $atts ) );

   $img = $id;
   if (strpos($img,'http://') !== false || strpos($img,'https://') !== false) {
      $img = $img;
    }
    else {
      $img = wp_get_attachment_image_src($img, 'large');
      $img = $img[0];
    }

    if($target) $target = 'target="'.$target.'"';



    $link_start = '';
    $link_end = '';

    if($link){
        $link_start = '<a href="'.$link.'" '.$target.'>';
        $link_end = '</a>';
    }

    if($lightbox){
       $link_start = '<a class="image-lightbox" href="'.$img.'">';
       $link_end = '</a>';
    }
   
    if($drop_shadow) $drop_shadow = 'box-shadow';
    $content = '<div class="ux-img-container '.$drop_shadow.'">'.$link_start.'<img src="'.$img.'" alt="'.$title.'" title="'.$title.'" style="bottom:-'.$image_pull.'"/>'.$link_end.'</div>';
    return $content;
}
add_shortcode('ux_image', 'ux_image');


// Phone number
function ux_phone( $atts, $content = null ){
  extract( shortcode_atts( array(
    'number' => '+000 000 000',
    'tooltip' => '',
    'border' => '2px',
  ), $atts ) );
    $tooltip_class = '';
    if($tooltip) $tooltip_class = 'tip-top';
    $content = '<div class="ux-header-element element-phone"><a href="tel:'.$number.'" class="circle '.$tooltip_class.'" title="'.$tooltip.'" style="border-width:'.$border.'"><span class="icon-phone"></span> '.$number.'</a></div>';
    return $content;
}
add_shortcode('phone', 'ux_phone');

// Header button
function ux_header_button( $atts, $content = null ){
  extract( shortcode_atts( array(
    'text' => 'Order Now',
    'link' => '',
    'tooltip' => '',
    'border' => '2px',
    'target' => '_self'
  ), $atts ) );
    $tooltip_class = '';
    if($tooltip) $tooltip_class = 'tip-top';
    $content = '<div class="ux-header-element header_button"><a href="'.$link.'" class="circle '.$tooltip_class.'" title="'.$tooltip.'" target="'.$target.'" style="border-width:'.$border.'">'.$text.'</a></div>';
    return $content;
}
add_shortcode('header_button', 'ux_header_button');