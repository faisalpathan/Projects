<?php
// [lightbox]
function uxLightboxShortcode($atts, $content=null) {
    $sliderrandomid = rand();
    ob_start();
    extract( shortcode_atts( array(
        'id' => 'enter-id-here',
        'width' => '600px',
        'padding' => '20px',
        'auto_open' => false,
        'auto_timer' => '2500',
        'auto_show' => 'always'
    ), $atts ) );
    ?> 

<div id="<?php echo $id; ?>" class="mfp-hide mfp-content-inner lightbox-white" style="max-width:<?php echo $width ?>;padding:<?php echo $padding; ?>">
    <?php echo fixShortcode($content); ?>
</div><!-- Lightbox-<?php echo $id; ?> -->

<script>
jQuery(document).ready(function($) {

      <?php if($auto_open) { ?>
        // auto open lightbox
         <?php if($auto_show == 'always') { ?>$.removeCookie("lightbox_<?php echo $id; ?>");<?php } ?>
        // run lightbox if no cookie is set
         if($.cookie("lightbox_<?php echo $id; ?>") !== 'opened'){
              // Open lightbox
              setTimeout(function(){ 
                  $.magnificPopup.open({midClick: true, removalDelay: 300, items: { src: '#<?php echo $id; ?>', type: 'inline'}});
              }, <?php echo $auto_timer; ?>);

              // set cookie
              $.cookie("lightbox_<?php echo $id; ?>", "opened");
          }
      <?php } ?>

      $('a[href="#<?php echo $id; ?>"]').click(function(e){
         // Close openend lightboxes
         var delay = 0;
         
         if($.magnificPopup.open){
            $.magnificPopup.close();
            delay = 300;
         }

         // Start lightbox
         setTimeout(function(){
            $.magnificPopup.open({
                  midClick: true,
                  removalDelay: 300,
                  items: {
                    src: '#<?php echo $id; ?>', 
                    type: 'inline'
                  }
            });
          }, delay);

        e.preventDefault();
      });
});
</script>
<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode("lightbox", "uxLightboxShortcode");