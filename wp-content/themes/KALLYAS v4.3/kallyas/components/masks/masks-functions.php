<?php if(! defined('ABSPATH')) { return; }

/**
 * Display the custom bottom mask markup
 *
 * @param  [type] $bm The mask ID
 *
 * @return [type]     HTML Markup to be used as mask
 */
if(!function_exists('zn_bottommask_markup')) {
	function zn_bottommask_markup( $bm, $bgcolor = false )
    {
        $bgfill = isset( $bgcolor ) && !empty( $bgcolor ) ? 'style="fill:' . $bgcolor . '"' : '';

        if ( $bm == 'none' ) {
            ?>
            <div class="zn_header_bottom_style"></div>
            <?php
        }
        else {
            ?>

            <div class="kl-bottommask kl-bottommask--<?php echo $bm; ?> kl-mask--<?php echo zget_option( 'zn_main_style', 'color_options', false, 'light' ); ?>">

                <?php

                if ( $bm == 'mask3' || $bm == 'mask3 mask3l' || $bm == 'mask3 mask3r' ) {

                    include(locate_template('components/masks/bottom-mask-3.php'));

                }
                else if ( $bm == 'mask4' || $bm == 'mask4 mask4l' || $bm == 'mask4 mask4r' ) {

                    include(locate_template('components/masks/bottom-mask-4.php'));

                }
                else if ( $bm == 'mask5' ) {

                    include(locate_template('components/masks/bottom-mask-5.php'));

                }
                else if ( $bm == 'mask6' ) {

                    include(locate_template('components/masks/bottom-mask-6.php'));

                }
                ?>

            </div>

            <?php
        }
    }
}


/**
 * Return Bottom masks for options list
 */
if( !function_exists('zn_get_bottom_masks') ){
    function zn_get_bottom_masks(){
        // TODO: to be prepared for future mask plugins
        return array (
            'none' => __( 'None, just rely on Background style.', 'zn_framework' ),
            'shadow_simple' => __( 'Shadow Up', 'zn_framework' ),
            'shadow_simple_down' => __( 'Shadow Down', 'zn_framework' ),
            'shadow' => __( 'Shadow Up (with border and small arrow)', 'zn_framework' ),
            'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
            'mask1' => __( 'Raster Mask 1 (Old, not recommended)', 'zn_framework' ),
            'mask2' => __( 'Raster Mask 2 (Old, not recommended)', 'zn_framework' ),
            'mask3' => __( 'Vector Mask 3 CENTER (New! From v4.0)', 'zn_framework' ),
            'mask3 mask3l' => __( 'Vector Mask 3 LEFT (New! From v4.0)', 'zn_framework' ),
            'mask3 mask3r' => __( 'Vector Mask 3 RIGHT (New! From v4.0)', 'zn_framework' ),
            'mask4' => __( 'Vector Mask 4 CENTER (New! From v4.0)', 'zn_framework' ),
            'mask4 mask4l' => __( 'Vector Mask 4 LEFT (New! From v4.0)', 'zn_framework' ),
            'mask4 mask4r' => __( 'Vector Mask 4 RIGHT (New! From v4.0)', 'zn_framework' ),
            'mask5' => __( 'Vector Mask 5 (New! From v4.0)', 'zn_framework' ),
            'mask6' => __( 'Vector Mask 6 (New! From v4.0)', 'zn_framework' ),
        );
    }
}

if( !function_exists('zn_get_top_masks') ){
    function zn_get_top_masks(){
        // TODO: to be prepared for future TOP masks plugins
        // automatically filled by plugin
        return array ();
    }
}