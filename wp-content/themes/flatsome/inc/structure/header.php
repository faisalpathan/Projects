<?php

global $flatsome_opt;

/* Favicon Fallback */
function flatsome_favicons(){
    global $flatsome_opt;
?>
    <link rel="shortcut icon" href="<?php if (isset($flatsome_opt['site_favicon']) && $flatsome_opt['site_favicon']) { echo $flatsome_opt['site_favicon']; ?>
    <?php } else { ?><?php echo get_template_directory_uri(); ?>/favicon.png<?php } ?>" />

    <!-- Retina/iOS favicon -->
    <link rel="apple-touch-icon-precomposed" href="<?php if (isset($flatsome_opt['site_favicon_large']) && $flatsome_opt['site_favicon_large']) { echo $flatsome_opt['site_favicon_large']; ?>
    <?php } else { ?><?php echo get_template_directory_uri(); ?>/apple-touch-icon-precomposed.png<?php } ?>" />
<?php
}

if(!function_exists('wp_site_icon')){
    add_action('wp_head','flatsome_favicons', 0);
}

if(function_exists('has_site_icon')){
    if(!has_site_icon()){
        add_action('wp_head','flatsome_favicons', 0);
    }
}


/* Insert custom header script */
function flatsome_custom_header_js() {
  global $flatsome_opt;
  if($flatsome_opt['html_scripts_header']){
    echo $flatsome_opt['html_scripts_header'];
  }
}
add_action( 'wp_head', 'flatsome_custom_header_js');


/* Add IE fixer to header */
function add_ieFix () {
  $ie_css = get_template_directory_uri() .'/css/ie8.css';
    echo '<!--[if lt IE 9]>';
    echo '<link rel="stylesheet" type="text/css" href="'.$ie_css.'">';
    echo '<script src="//cdn.jsdelivr.net/g/mutationobserver/"></script>';
    echo '<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo "<script>var head = document.getElementsByTagName('head')[0],style = document.createElement('style');style.type = 'text/css';style.styleSheet.cssText = ':before,:after{content:none !important';head.appendChild(style);setTimeout(function(){head.removeChild(style);}, 0);</script>";
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ieFix');


/* Custom Nav Walker */
class FlatsomeNavDropdown extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array()) {

        $display_depth = ($depth + 1); // because it counts the first submenu as 0
        if($display_depth == '1'){$class_names = 'nav-dropdown';}
        else {$class_names = 'nav-column-links';}

        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=".$class_names."><ul>\n";
    }

    function end_lvl( &$output, $depth = 1, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }

    function start_el ( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    // Most of this code is copied from original Walker_Nav_Menu
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = ' class="' . esc_attr( $class_names ) . '"';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    // Check if menu item is in main menu
    if ( $depth == 0 ) {
        // These lines adds your custom class and attribute
        $attributes .= ' class="nav-top-link"';
    }

    $description = '';
    if(strpos($class_names,'image-column') !== false){$description = '<img src="'.$item->description.'" alt=" "/>';}

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= $description;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  } 

}


add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'menu-parent-item'; 
		}
	}
	
	return $items;    
}


/* Mobile Menu */
function flatsome_mobile_menu(){ 
 global $flatsome_opt, $woocommerce; ?>

<!-- Mobile Popup -->
<div id="jPanelMenu" class="mfp-hide">
    <div class="mobile-sidebar">
        <?php if($flatsome_opt['catalog_mode']) { ?>
        <ul class="html-blocks">
            <li class="html-block">
                 <?php echo do_shortcode($flatsome_opt['catalog_mode_header']); ?>
            </li>
        </ul>
        <?php } ?>

        <ul class="mobile-main-menu">
        <?php if ($flatsome_opt['search_pos'] !== 'hide') { ?>
        <li class="search">
            <?php if(function_exists('get_product_search_form')) {
                get_product_search_form();
            } else {
                get_search_form();
            } ?>    
        </li><!-- .search-dropdown -->
        <?php } ?>

        <?php 
        if ( has_nav_menu( 'primary_mobile' ) ) { 
        // Load custom mobile menu if set
            wp_nav_menu(array(
                'theme_location' => 'primary_mobile',
                'container'       => false,
                'items_wrap'      => '%3$s',
                'depth'           => 0,
            ));

        } else {
        // Load default menu
            wp_nav_menu(array(
            'theme_location' => 'primary',
            'container'       => false,
            'items_wrap'      => '%3$s',
            'depth'           => 0,
           ));

        }
        ?>

        <?php if(ux_is_woocommerce_active() && $flatsome_opt['myaccount_dropdown']) { ?>

        <li class="menu-item menu-account-item menu-item-has-children">
            <?php
            if ( is_user_logged_in() ) { ?> 
                <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                    <?php _e('My Account', 'woocommerce'); ?>
                </a>
                <ul class="sub-menu">
                <?php if ( has_nav_menu( 'my_account' ) ) : ?>
                <?php  
                wp_nav_menu(array(
                    'theme_location' => 'my_account',
                    'container'       => false,
                    'items_wrap'      => '%3$s',
                    'depth'           => 0,
                ));
                ?>
                <?php else: ?>
                    <li>Define your My Account dropdown menu in <b>Appearance > Menus</b></li>
                <?php endif; ?> 
                </ul>

            <?php } else { ?>
            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e('Login', 'woocommerce'); ?></a>
            <?php } ?>                      
        </li>
        <?php } // end My account dropdown ?>
        </ul>

        <?php if($flatsome_opt['topbar_show']) { ?>
        <ul class="top-bar-mob">
             <?php if ( has_nav_menu( 'top_bar_nav' ) ) : ?>
            <?php  
                wp_nav_menu(array(
                    'theme_location' => 'top_bar_nav',
                    'menu_class' => 'top-bar-mob',
                    'container'       => false,
                    'items_wrap'      => '%3$s',
                    'depth' => 2,
                ));
            ?>
            <?php endif; ?>

             <?php if($flatsome_opt['top_right_text']) { ?>
            <li class="html-block">
                <?php echo do_shortcode($flatsome_opt['top_right_text']); ?>
            </li>
            <?php } ?>

            <?php if($flatsome_opt['topbar_right']) { ?>
            <li class="html-block">
               <?php echo do_shortcode($flatsome_opt['topbar_right']); ?>
            </li>
            <?php } ?>

        </ul>
        <?php } // end top bar ?>

       <?php if($flatsome_opt['nav_position'] == 'bottom') { ?>
        <ul class="html-blocks">
            <li class="html-block">
                <?php echo do_shortcode($flatsome_opt['nav_position_text']); ?>
            </li>
            <li class="html-block">
                <?php echo do_shortcode($flatsome_opt['nav_position_text_top']); ?>
            </li>
        </ul>
        <?php } ?>

        <?php if($flatsome_opt['nav_position'] == 'bottom_center') { ?>
        <ul class="html-blocks">
            <li class="html-block">
                 <?php echo do_shortcode($flatsome_opt['nav_position_text_top']); ?>
            </li>
        </ul>
        <?php } ?>
    </div><!-- inner -->
</div><!-- #mobile-menu -->

<?php
}

add_action('wp_footer', 'flatsome_mobile_menu');