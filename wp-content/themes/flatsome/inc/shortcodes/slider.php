<?php

// [ux_slider]
function shortcode_ux_slider($atts, $content=null) {

    extract( shortcode_atts( array(
        'timer' => '6000',
        'bullets' => 'true',
        'auto_slide' => 'true',
        'slide_align' => 'center',
        'arrows' => 'circle',
        'style' => 'normal',
        'nav_pos' => 'inside',
        'nav_color' => 'light',
        'infinitive' => 'true',
        'freescroll' => 'false',
        'margin' => '',
        'padding' => '',
        'columns' => '1',
        'friction' => '0.6',
        'selectedattraction' => '0.1',
        'height' => '',
        'rtl' => 'false',
        'draggable' => 'true',
        'mobile' => 'true'

    ), $atts ) );

    ob_start();

    $slider_classes = '';
    if($mobile  !==  'true') {$slider_classes = 'hide-for-small';}
    if(is_rtl()) $rtl = 'true';
    if($auto_slide == 'true') $auto_slide = $timer;

    // Slider Nav visebility
    $is_arrows = 'true';
    $is_bullets = 'true';

    if($arrows == 'false') $is_arrows = 'false';
    if($arrows == 'true') $arrows = 'circle';
    if($bullets == 'false') $is_bullets = 'false';

    $css = '';
    // Custom CSS
    if($margin){
        $css = 'margin-bottom:'.$margin.'!important';
    }

    ?> 
<div class="ux-slider-wrapper relative">
    <div class="ux-slider iosSlider <?php echo $slider_classes; ?> slider-style-<?php echo $style;?>  slider-nav-<?php echo $nav_color;?> slider-nav-<?php echo $nav_pos; ?> slider-nav-<?php echo $arrows;?> js-flickity" 
        data-flickity-options='{ 
            "cellAlign": "<?php echo $slide_align; ?>",
            "imagesLoaded": true,
            "lazyLoad": 1,
            "freeScroll": <?php echo $freescroll; ?>,
            "wrapAround": <?php echo $infinitive; ?>,
            "autoPlay": <?php echo $auto_slide;?>,
            "prevNextButtons": <?php echo $is_arrows; ?>,
            "contain" : true,
            "percentPosition": true,
            "pageDots": <?php echo $is_bullets; ?>,
            "selectedAttraction" : <?php echo $selectedattraction; ?>,
            "friction": <?php echo $friction; ?>,
            "rightToLeft": <?php echo $rtl; ?>,
            "draggable": <?php echo $draggable; ?>
        }'
        style="<?php echo $css;?>"
        >
        <?php echo fixShortcode($content); ?>
     </div>
    <div class="ux-loading dark"></div>
</div><!-- .ux-slider-wrapper -->

<?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode("ux_slider", "shortcode_ux_slider");