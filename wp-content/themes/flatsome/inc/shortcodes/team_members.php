<?php 
// [team_member]
function team_member($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"name" => '',
		"title" => '',
		'twitter' => '',
		'facebook' => '',
		'pinterest' => '',
		'instagram' => '',
		'email' => '',
		'img'  => '',
    'tel' => '',
    'linkedin' => '',
    'style' => 'text-circle',
	), $atts));
	ob_start();

    if (strpos($img,'http://') !== false || strpos($img,'https://') !== false) {
      $img = $img;
    }
     else {
      $img = wp_get_attachment_image_src($img, 'thumbnail');
      $img = $img[0];
    }
	?>

<div class="ux-box team-member ux-<?php echo $style; ?> <?php if($style == 'text-overlay') echo 'dark'; ?> text-center">
    <div class="inner">
      <div class="inner-wrap">
      <div class="ux-box-image">
         <img src="<?php echo $img; ?>" />
      </div><!-- .ux-box-image -->
      <div class="ux-box-text <?php if($style  == 'text-overlay') { ?>show-first<?php } ?>">
          <h4 class="uppercase">
            <?php echo $name; ?><br/>
            <span class="thin-font"><?php echo $title; ?></span>
          </h4>
          <div class="show-next">
             <div class="tx-div small"></div>
             <div class="social-icons">
              <?php if($tel){?> 
                <a href="tel:<?php echo $tel; ?>" target="_blank"  class="icon icon_email tip-top" title="<?php echo $tel; ?>"><span class="icon-phone"></span></a>
              <?php }?>
              <?php if($facebook){?> 
                <a href="<?php echo $facebook; ?>" target="_blank"  class="icon icon_facebook tip-top" title="<?php echo $facebook; ?>"><span class="icon-facebook"></span></a>
              <?php }?>
              <?php if($twitter){?> 
                     <a href="<?php echo $twitter; ?>" target="_blank" class="icon icon_twitter tip-top" title="<?php echo $twitter; ?>"><span class="icon-twitter"></span></a>
              <?php }?>
              <?php if($email){?> 
                     <a href="mailto:<?php echo $email; ?>" target="_blank" class="icon icon_email tip-top" title="<?php echo $email; ?>"><span class="icon-envelop"></span></a>
              <?php }?>
              <?php if($pinterest){?> 
                     <a href="<?php echo $pinterest; ?>" target="_blank" class="icon icon_pintrest tip-top" title="<?php echo $pinterest; ?>"><span class="icon-pinterest"></span></a>
              <?php }?>
              <?php if($instagram){?> 
                     <a href="<?php echo $instagram; ?>" target="_blank" class="icon icon_instagram tip-top" title="<?php echo $instagram; ?>"><span class="icon-instagram"></span></a>
              <?php }?>
              <?php if($linkedin){?> 
                     <a href="<?php echo $linkedin; ?>" target="_blank" class="icon icon_linkedin tip-top" title="<?php echo $linkedin; ?>"><span class="icon-linkedin"></span></a>
              <?php }?>
         </div>
        </div>
           <p><?php if($style  != 'text-overlay') echo fixShortcode($content); ?></p>
      </div><!-- .ux-box-text-overlay -->
    </div>
  </div>
</div>
  <?php if($style  == 'text-overlay') { ?>
     <div class="small-font" style="margin-top:15px;"><?php  echo fixShortcode($content); ?></div> 
  <?php } ?>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


add_shortcode("team_member", "team_member");