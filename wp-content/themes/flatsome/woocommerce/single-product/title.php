<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>


<?php do_action('flatsome_product_before_title'); ?>

<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
<div class="tx-div small"></div>