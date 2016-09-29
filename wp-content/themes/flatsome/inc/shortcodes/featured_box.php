<?php 
// [featured_box]
function featured_box($atts, $content = null) {
  global $flatsome_opt;
  $sliderrandomid = rand();
  extract(shortcode_atts(array(
    'title' => '',
    'title_small' => '',
    'animated' => '',
    'font_size' => '',
    'bg' => '',
    'img'  => '',
    'img_width' => '',
    'pos' => '',
    'link' => '',
    'tooltip' => '',
    'icon_border' => '0',
    'icon_color' => $flatsome_opt['color_primary'],
    'icon' => '',
  ), $atts));
  ob_start();

  if($font_size) $font_size = 'font-size:'.$font_size;
  ?>

  <div class="featured-box  <?php if($pos) echo 'pos-'.$pos; ?>  <?php if($tooltip){echo 'tip-top';} ?>" title="<?php echo $tooltip; ?>"  style="<?php if($pos == "left" && $img_width) echo 'padding-left:'.($img_width+15).'px;'; ?><?php echo $font_size; ?>">
  <div class="box-inner">
  <?php if($link) { echo '<a href="'.$link.'">'; } ?>
  <?php if($img) {
   ?><div  class="featured-img <?php if($animated){echo 'scroll-animate';} ?> <?php if($icon_border){ ?>featured-img-circle <?php } ?>" <?php if($animated) echo 'data-animate="'.$animated.'"'; ?> style="<?php if($img_width){?>width:<?php echo $img_width; ?>;max-height:<?php echo $img_width; ?>;<?php } ?> <?php if($icon_border){?>border-width:<?php echo $icon_border; ?>; border-color:<?php echo $icon_color; ?><?php }?>"><?php 

  if (strpos($img,'.jpg') !== false || strpos($img,'.gif') !== false || strpos($img,'.png') !== false) {
          $img = $img;
  } else{
     $img = wp_get_attachment_image_src($img, 'medium');
     $img = $img[0];
  } 

  if(strpos($img,'.svg') !== false) {
    $svg = new SimpleXMLElement( wp_remote_fopen($img));
      $padding = "0";
      if($icon_border) $padding = ($img_width*0.2);
      echo '<svg viewBox="0 0 32 32" style="width:100%; fill:'.$icon_color.'; padding:'.$padding.'px"';
      echo '<g id="'.$svg->g->attributes()->id.'"><line stroke-width="1" x1="" y1="" x2="" y2="" opacity=""></line></g>';
      echo '<path d="'.$svg->path->attributes()->d.'"></path>';
      echo '</svg>';
  }
  else {
        ?><img src="<?php echo  $img; ?>" alt="<?php echo $title; ?>" style="width:100%;"><?php
  }
  echo '</div><!-- end icon -->';
  } ?>
  <?php if($link) { echo '</a>'; } ?>
  <?php if($link) { echo '<a href="'.$link.'">'; } ?>
    <h4><?php echo $title; ?> <span><?php echo $title_small; ?> </span></h4>
    <?php if($link) { echo '</a>'; } ?>
    <?php echo fixShortcode($content); ?>
  </div>
  </div>

  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}


add_shortcode("featured_box", "featured_box");