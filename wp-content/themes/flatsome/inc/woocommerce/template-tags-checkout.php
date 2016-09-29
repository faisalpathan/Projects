<?php

/* Continue Shopping Button */
if(isset($flatsome_opt['continue_shopping']) && $flatsome_opt['continue_shopping']){
    function flatsome_continue_shopping(){
     ?> 
     <a class="button-continue-shopping button alt-button small left"  href="<?php echo wc_get_page_permalink( 'shop' ); ?>">
        &#8592; <?php echo __( 'Continue Shopping', 'woocommerce' ) ?></a> 
     <?php
    }

    add_action('woocommerce_cart_actions', 'flatsome_continue_shopping', 0);
    add_action('woocommerce_thankyou', 'flatsome_continue_shopping');
}

// Move Cross sells
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );



// Add HTML after Cart content
if($flatsome_opt['html_cart_footer']){
    function html_cart_footer(){
        global $flatsome_opt;
        echo do_shortcode($flatsome_opt['html_cart_footer']);
    }
    add_action( 'woocommerce_after_cart', 'html_cart_footer', 0);
}

// Disable copon for checkout.
if(!$flatsome_opt['coupon_checkout']){
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}

// Add HTML After Checkout sidebar
if(isset($flatsome_opt['html_checkout_sidebar'])){
    function flatsome_html_checkout(){
       global $flatsome_opt;
       echo '<div style="padding-top:15px">'.do_shortcode($flatsome_opt['html_checkout_sidebar']).'</div>';
    }
    add_action('woocommerce_checkout_after_order_review', 'flatsome_html_checkout');
}