<?php
/**
 * Single Product tabs / and sections
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version    2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

global $flatsome_opt;

if ($flatsome_opt['product_display'] == 'tabs' || $flatsome_opt['product_display'] == 'tabs_center' || $flatsome_opt['product_display'] == 'tabs_pills' && !empty( $tabs ) )  : ?>

	<div class="tabbed-content  wc-tabs-wrapper woocommerce-tabs <?php if($flatsome_opt['product_display'] == 'tabs_center') echo "pos_center"; if($flatsome_opt['product_display'] == 'tabs_pills') echo "pos_pills"; ?>">
		<ul class="tabs wc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab <?php if($key == 'description') echo 'active';?>">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ) ?></a>
				</li>
			<?php endforeach; ?>
		</ul>

		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="panel wc-tab entry-content <?php if($key == 'description') echo 'active';?>" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>
		<?php endforeach; ?>

	</div><!-- .tabbed-content -->

<?php elseif ($flatsome_opt['product_display'] == 'sections' && !empty( $tabs ) )  : ?>


		<div class="product-page-sections">
		<?php foreach ( $tabs as $key => $tab ) : ?>

				<div class="row">
					<div class="section">
						<div class="large-12 columns"><hr></div>
						<div class="large-2 columns">
							<h5><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></h5>
						</div><!-- .large-3 -->
						<div class="large-10 columns">

							<div class="entry-content" id="section-<?php echo $key ?>">
									<?php call_user_func( $tab['callback'], $key, $tab ) ?>
							</div>
						</div><!-- .large-10 -->
					</div><!-- .section -->
				</div><!-- .row -->

			
		<?php endforeach; ?>
	</div><!-- .product-page-sections -->

<?php elseif ($flatsome_opt['product_display'] == 'accordian' && !empty( $tabs ) )  : ?>

			<div class="accordion small" rel="1">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<div class="accordion-title">
					<a href="#"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</div>
				<div class="accordion-inner">
					<?php call_user_func( $tab['callback'], $key, $tab ) ?>
				</div>
			<?php endforeach; ?>
			</div><!-- accordion -->
<?php elseif ($flatsome_opt['product_display'] == 'tabs_vertical' && !empty( $tabs ) )  : ?>

		<div class="row collapse vertical-tabs shortcode_tabgroup_vertical">
			<div class="large-3 columns">	
				<ul class="tabs-nav wc-tabs">
					<?php $first = true; foreach ( $tabs as $key => $tab ) : ?>
						<li class="tab <?php if($first) { echo 'current-menu-item'; $first = false; } ?>"><a href="#panel<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div><!-- large-3 -->

			<div class="large-9 columns">
				<?php $first = true; foreach ( $tabs as $key => $tab ) : ?>
						<div class="tabs-inner wc-tab <?php if($first) { echo 'active'; $first = false; } ?>" id="panel<?php echo $key ?>"> <?php call_user_func( $tab['callback'], $key, $tab ) ?></div>
				<?php endforeach; ?>
			</div><!-- large-9 -->
		</div><!-- vertical-tabs -->

<?php endif;?>