<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $flatsome_opt, $wc_cpdf;

$is_sale = null;

?>

<?php if($wc_cpdf->get_value(get_the_ID(), '_bubble_new')) { ?>
<div class="callout large <?php if($product->is_on_sale()) echo 'has-sale'; ?> <?php echo $flatsome_opt['bubble_style']; ?>">
            <div class="inner callout-new-bg">
              <div class="inner-text ">
              	<?php
              	if($wc_cpdf->get_value(get_the_ID(), '_bubble_text')){
              		echo $wc_cpdf->get_value(get_the_ID(), '_bubble_text');
              	} else {
              	   	_e('New','flatsome');	
              	}?>
              </div>
            </div>
</div><!-- end callout -->
<?php } ?>

<?php if ($is_sale || $product->is_on_sale() && !$flatsome_opt['sale_bubble_percentage'] ) : ?>
	 <div class="callout large <?php echo $flatsome_opt['bubble_style']; ?>">
            <div class="inner">
              <div class="inner-text"><?php echo apply_filters('woocommerce_sale_flash',__( 'Sale!', 'woocommerce' ), $post, $product); ?></div>
            </div>
     </div><!-- end callout -->

<?php elseif ($product->is_on_sale() && $flatsome_opt['sale_bubble_percentage'] && $product->product_type == 'variable') : ?>
 <div class="callout large <?php echo $flatsome_opt['bubble_style']; ?>">
        <div class="inner">
          <div class="inner-text">
          	<?php 
	        $price = '';	
			$available_variations = $product->get_available_variations();								
			$maximumper = 0;
			for ($i = 0; $i < count($available_variations); ++$i) {
				$variation_id=$available_variations[$i]['variation_id'];
				$variable_product1= new WC_Product_Variation( $variation_id );
				$regular_price = $variable_product1 ->regular_price;
				$sales_price = $variable_product1 ->sale_price;
				$percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),0) ;
					if ($percentage > $maximumper) {
						$maximumper = $percentage;
					}
				}
			echo '-'.$price . sprintf( __('%s', 'woocommerce' ), $maximumper . '%' ); ?>
          </div>
        </div>
 </div><!-- end callout -->

<?php elseif($product->is_on_sale() && $flatsome_opt['sale_bubble_percentage'] && $product->product_type == 'simple') : ?>
<div class="callout large <?php echo $flatsome_opt['bubble_style']; ?> ">
    <div class="inner">
      <div class="inner-text"><?php 
    	$price = '';
		$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100,0);
		echo '-'.$price . sprintf( __('%s', 'woocommerce' ), $percentage . '%' ); ?></div>
    </div>
</div><!-- end callout -->
<?php endif; ?>