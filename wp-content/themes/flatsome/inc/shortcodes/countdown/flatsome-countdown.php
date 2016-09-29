<?php

// Register scripts
function flatsome_countdown_shortcode_scripts() {
    wp_register_style( 'flatsome-countdown-style', get_template_directory_uri() . '/inc/shortcodes/countdown/flatsome-countdown.css', 'flatsome-style');
    wp_register_script( 'flatsome-countdown-script', get_template_directory_uri() . '/inc/shortcodes/countdown/flatsome-countdown.js', 'jQuery');
}
add_action( 'wp_enqueue_scripts', 'flatsome_countdown_shortcode_scripts' );

// Register Shortcode
function ux_countdown_shortcode( $atts ){
    extract( shortcode_atts( array(
      'before' => '',
      'after' => '',
      'year' => '2016',
      'month' => '1',
      'day' => '12',
      'time' => '12:00',
      'style' => 'clock',
      'color' => 'dark',
      'size' => '100%',
      't_plural' => 's',
      't_hour' => 'hour',
      't_min' => 'min',
      't_day' => 'day',
      't_week' => 'week',
      't_sec' => 'sec',
    ), $atts ) );

    wp_enqueue_style('flatsome-countdown-style');
    wp_enqueue_script('flatsome-countdown-script');

    $date = $year.'/'.$month.'/'.$day;

    // Fix Time
    if($time == '24:00') $time = '23:59:59';

    if($time) $date = $date.' '.$time;


    // Texts
    $translations = 'data-text-plural="'.$t_plural.'" data-text-hour="'.$t_hour.'" data-text-day="'.$t_day.'" data-text-week="'.$t_week.'" data-text-min="'.$t_min.'" data-text-sec="'.$t_sec.'"';

    if($style == 'clock'){
      return $before.'<div class="ux-timer '.$color.'" '.$translations.' data-countdown="'.$date.'" style="font-size: '.$size.';"><span>&nbsp;<div class="ux-loading dark"></div><strong>&nbsp;</strong></span></div>'.$after;
    } else{
      return $before.'<span class="ux-timer-text" '.$translations.' data-countdown="'.$date.'" style="font-size: '.$size.';"></span>'.$after;
    }
}
add_shortcode('ux_countdown', 'ux_countdown_shortcode');