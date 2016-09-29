<?php

// Flatsome Products
function ux_products($atts, $content = null, $tag) {
	global $woocommerce;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'title' => '',
		'products' => '8',
		'product' => '',
		'columns' => '4',
		'orderby' => '', // normal, sales, rand, date
		'type' => 'slider', // slider, masonry, normal, lookbook.
		'cat' => '', 
		'show' => '', //featured, onsale
		'tags' => '',
		'ids' => '',
	 	'infinitive' => 'true',
	 	'auto_slide' => 'false',
	 	'bullets' => 'false',
	 	'arrows' => 'true',
	), $atts));

	if($product) $products = $product;

	if($tag == 'ux_bestseller_products') {
		if(!$orderby) $atts['orderby'] = 'sales';
	} else if($tag == 'ux_featured_products'){
		$atts['show'] = 'featured';
		
	} else if($tag == 'ux_sale_products'){
		$atts['show'] = 'onsale';

	} else if($tag == 'ux_custom_products'){

	} else if($tag == 'product_lookbook'){
		$type = 'lookbook';

	} else if($tag == 'products_pinterest_style'){
		$type = 'masonry';
		if($products == '8') {
			$atts['products'] = '999';
			$columns = '3';
		}
	}

	if($type== 'lookbook' ){
		$infinitive = 'true';
	}

	ob_start();
	?>
    
		<?php if($title){?> 
		<div class="row">
			<div class="large-12 columns">
				<h3 class="section-title"><span><?php echo $title ?></span></h3>
			</div>
		</div><!-- end .title -->
		<?php } ?>

	    <?php if($type !== 'lookbook') { ?><div class="row"><?php } ?>
		
		<?php if($type == 'normal') { ?>
			<div class="large-12 columns"> 
			<ul class="large-block-grid-<?php echo $columns; ?> small-block-grid-2">
        <?php } else if($type == 'lookbook') { ?>
        	<div class="lookbook-slider">
			<ul class="ux-slider js-flickity slider-nav-small slider-nav-circle large-block-grid-<?php echo $columns; ?> small-block-grid-2"
            	data-flickity-options='{ 
	                "cellAlign": "left",
	                "autoPlay" : <?php echo $auto_slide; ?>,
	                "wrapAround": <?php echo $infinitive; ?>,
	                "percentPosition": true,
	                "imagesLoaded": true,
	                "selectedAttraction" : 0.05,
         		    "friction": 0.6,
	                "pageDots": <?php echo $bullets; ?>,
	                "contain": true
	            }'>
       	<?php } else if($type == 'masonry') { ?>
        	<div class="large-12 columns">
            <ul class="pinterest-style large-block-grid-<?php echo $columns; ?> small-block-grid-2">
        <?php } else if($type == 'slider') { ?>
      	  <div class="large-12 columns">
            <ul class="ux-row-slider js-flickity slider-nav-small  slider-nav-reveal  slider-nav-push large-block-grid-<?php echo $columns; ?> small-block-grid-2"
            	data-flickity-options='{ 
	                "cellAlign": "left",
	                "autoPlay" : <?php echo $auto_slide; ?>,
	                "wrapAround": <?php echo $infinitive; ?>,
	                "percentPosition": true,
	                "imagesLoaded": true,
	                "pageDots": <?php echo $bullets; ?>,
	                "selectedAttraction" : 0.05,
         		    "friction": 0.6,
	                "contain": true
	            }'>
        	<?php }

			$r = ux_list_products($atts);
            
            if ( $r->have_posts() ) : ?>
                        
                <?php while ( $r->have_posts() ) : $r->the_post(); ?>

                <?php
                    if($type == 'lookbook'){
                    	woocommerce_get_template_part( 'content', 'product-lookbook' );
                    }
                    else if($type == 'masonry'){
                   		 woocommerce_get_template_part( 'content', 'product-pinterest-style' );
                    }
                    else {
                    	woocommerce_get_template_part( 'content', 'product' );
                    }
                ?>
                <?php endwhile; // end of the loop. ?>
                
            <?php
            
            endif; 
            wp_reset_query();
            
            ?>
          </ul>   <!-- .products -->  
		</div>
	<?php if($type !== 'lookbook') { ?></div><!-- .row --><?php } ?>

   	<?php if($type == 'masonry') { ?> 
	 <script>
		/* PACKERY GRID */
		jQuery(document).ready(function ($) {
		    var $container = $(".pinterest-style");
		    // initialize
		    $container.packery({
		      itemSelector: "li",
		      gutter: 0
		    });

		    imagesLoaded( document.querySelector('.pinterest-style'), function( instance, container ) {
	  			$container.packery('layout');
			});
		 });
	</script>
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("ux_bestseller_products", "ux_products");
add_shortcode("ux_featured_products", "ux_products");
add_shortcode("ux_sale_products", "ux_products");
add_shortcode("ux_latest_products", "ux_products");
add_shortcode("ux_custom_products", "ux_products");
add_shortcode("product_lookbook", "ux_products");
add_shortcode("products_pinterest_style", "ux_products");
add_shortcode("ux_products", "ux_products");


// Normal Product Lists
function ux_products_list($atts, $content = null, $tag) {
	extract(shortcode_atts(array(
		'title' => '',
		'products' => '8',
		'product' => '',
		'columns' => '4',
		'orderby' => '', // normal, sales, rand, date
		'type' => 'slider', // slider, masonry, normal, lookbook.
		'cat' => '', 
		'show' => '', //featured, onsale
	), $atts));


	$r = ux_list_products($atts);
    
    if ( $r->have_posts() ) :

    if($title) echo '<h3 class="widget-title">'.$title.'</h3><div class="tx-div small"></div>';

    echo '<ul class="product_list_widget">';
                
    while ( $r->have_posts() ) : $r->the_post(); 

	wc_get_template( 'content-widget-product.php', array( 'show_rating' => true ) );

	endwhile;

	echo '</ul>';

    endif; 
    wp_reset_query();
}

add_shortcode("ux_products_list", "ux_products_list");