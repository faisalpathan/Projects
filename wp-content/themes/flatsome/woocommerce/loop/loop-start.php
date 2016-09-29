<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $flatsome_opt, $woocommerce_loop;

$desktop_columns = 3;
$mobile_columns = 2;
$tablet_columns = 2;


if(!empty($flatsome_opt['category_row_count'])){
	$desktop_columns = $flatsome_opt['category_row_count'];
}
if(!empty($flatsome_opt['category_row_count_mobile'])){
	$mobile_columns = $flatsome_opt['category_row_count_mobile'];
}

if(!empty($woocommerce_loop['columns'])){
	$desktop_columns = $woocommerce_loop['columns'];
}

if(is_cart()){$desktop_columns = 4;} 


?>
<div class="row">
	<div class="large-12 columns">
	<ul class="products large-block-grid-<?php echo $desktop_columns;?> small-block-grid-<?php echo $mobile_columns; ?>">