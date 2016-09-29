<?php

/* Fix Normal Shortcodes */
function fixShortcode($content){

    $fix = array (
            '_____' => '<div class="tx-div large"></div>',
            '____' => '<div class="tx-div medium"></div>',
            '___' => '<div class="tx-div small"></div>',
            '</div></p>' => '</div>',
            '<p><div' => '<div',
            ']</p>' => ']',
            ']<br />' => ']',
            '<p>[' => '[',
            '<br />[' => '[',
    );
    $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    $content = strtr($content, $fix);

    // Remove empty P. $content preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", '', $content);
    return do_shortcode($content);
}

/* Add shortcode fix to content */
add_filter('the_content', 'fixShortcode');

/* Add shortcode to widgets */
add_filter('widget_text', 'fixShortcode');

/* Add shortcode to excerpt */
add_filter('the_excerpt', 'fixShortcode');


/* Redirect to Homepage when customer log out */
add_filter('logout_url', 'new_logout_url', 10, 2);
function new_logout_url($logouturl, $redir)
{
  $redir = get_option('siteurl');
  return $logouturl . '&amp;redirect_to=' . urlencode($redir);
}


/* Create Shorter Excerpt */
function short_excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
}


/* Create RGBA color of a #HEX color */
function ux_hex2rgba($color, $opacity = false) {
  $default = 'rgb(0,0,0)';
  //Return default if no color provided
  if(empty($color))
          return $default; 

  //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
          $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
          if(abs($opacity) > 1)
            $opacity = 1.0;
          $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
          $output = 'rgb('.implode(",",$rgb).')';
        }
        //Return rgb(a) color string
        return $output;
}