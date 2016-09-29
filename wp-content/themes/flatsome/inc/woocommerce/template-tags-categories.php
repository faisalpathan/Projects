<?php


// Remove default WooCommerce thumbnails
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail', 10);


/* Show short description in grid */
if(function_exists('is_shop')){
    if($flatsome_opt['category_row_count'] == '1' || is_shop()){
       add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_excerpt', 30);
    } else if($flatsome_opt['short_description_in_grid']) {
       add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_excerpt', 30);
    }
}

// Fallback for Add To Cart
if(!ux_woocommerce_version_check('2.5')){
    function woocommerce_single_variation_add_to_cart_button() {
        global $product;
        ?>
        <div class="variations_button">
            <button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
            <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->id ); ?>" />
            <input type="hidden" name="product_id" value="<?php echo absint( $product->id ); ?>" />
            <input type="hidden" name="variation_id" class="variation_id" value="" />
            <?php woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) ); ?>
        </div>
        <?php
    }
}


// Remove default add to cart button
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart', 10);

// Show Add To Cart Button in Grid
function flatsome_add_button_in_grid(){
global $flatsome_opt;
    if($flatsome_opt['add_to_cart_icon'] == "button") {
        global $product;
        echo apply_filters( 'woocommerce_loop_add_to_cart_link',
            sprintf( '<div class="add-to-cart-button"><a href="%s" rel="nofollow" data-product_id="%s" class="%s %s product_type_%s button alt-button small clearfix">%s</a></div>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( $product->id ),
                esc_attr( $product->is_type( 'variable' ) ? '' : 'ajax_add_to_cart'),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                esc_attr( $product->product_type ),
                esc_html( $product->add_to_cart_text() )
            ),
        $product );
     }
}
add_action('woocommerce_after_shop_loop_item_title', 'flatsome_add_button_in_grid', 30);


// Change product pr page if set.
if(isset($flatsome_opt['products_pr_page'])){
    $products = $flatsome_opt['products_pr_page'];
    add_filter( 'loop_shop_per_page', create_function( '$cols', "return $products;" ), 20 );
}