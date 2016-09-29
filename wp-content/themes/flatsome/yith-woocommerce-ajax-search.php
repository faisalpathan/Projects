<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.0.0
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly

wp_enqueue_script('yith_wcas_jquery-autocomplete' );


if( defined( 'YITH_WCAS_PREMIUM' ) ) {
    wp_enqueue_script('yith_wcas_frontend' );
}

$research_post_type = ( get_option('yith_wcas_default_research') ) ? get_option('yith_wcas_default_research') : 'product';

$rand_id = rand();
?>

<div class="row yith-search-premium collapse search-wrapper yith-ajaxsearchform-container yith-ajaxsearchform-container <?php echo $rand_id; ?>_container">
<form role="search" method="get" class="yith-search-premium" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
      <div class="large-10 small-10 columns">
        <input type="hidden" name="post_type" class="yit_wcas_post_type" id="yit_wcas_post_type" value="<?php echo $research_post_type ?>" />
        <input type="search" 
        value="<?php echo get_search_query() ?>" 
        name="s"
        id="<?php echo $rand_id; ?>_yith-s"
        class="yith-s"
        data-append-top
        placeholder="<?php echo esc_attr( get_option('yith_wcas_search_input_label') ) ?>"
        data-loader-icon="<?php echo esc_attr( str_replace( '"', '', apply_filters('yith_wcas_ajax_search_icon', '') ) ) ?>"
        data-min-chars="<?php echo esc_attr( get_option('yith_wcas_min_chars') ); ?>" />
      </div><!-- input -->
      <div class="large-2 small-2 columns">
        <button type="submit" id="yith-searchsubmit" class="button secondary postfix"><i class="icon-search"></i></button>
      </div><!-- button -->
</form>
</div><!-- row -->

<script type="text/javascript">
jQuery(function($){
    if (jQuery().yithautocomplete) {
        $('#<?php echo $rand_id; ?>_yith-s').yithautocomplete({
            minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
            appendTo: '.<?php echo $rand_id; ?>_container',
            serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
            onSearchStart: function(){
                $('.<?php echo $rand_id; ?>_container').append('<div class="ux-loading"></div>');
            },
            onSearchComplete: function(){
                $('.<?php echo $rand_id; ?>_container .ux-loading').remove();

            },
            onSelect: function (suggestion) {
                if( suggestion.id != -1 ) {
                    window.location.href = suggestion.url;
                }
            }
        });

    } else {
        $('#<?php echo $rand_id; ?>_yith-s').autocomplete({
            minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
            appendTo: '.<?php echo $rand_id; ?>_container',
            serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
            onSearchStart: function(){
                $('.<?php echo $rand_id; ?>_container').append('<div class="ux-loading"></div>');
            },
            onSearchComplete: function(){
                $('.<?php echo $rand_id; ?>_container .ux-loading').remove();

            },
            onSelect: function (suggestion) {
                if( suggestion.id != -1 ) {
                    window.location.href = suggestion.url;
                }
            }
        });

    }
});
</script>