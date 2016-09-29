<!DOCTYPE html>
<?php global $woo_options, $woocommerce, $flatsome_opt;?>
<!--[if lte IE 9 ]><html class="ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
// HTML Homepage Before Header // Set in Theme Option > HTML Blocks
if($flatsome_opt['html_intro'] && is_front_page()) echo '<div class="home-intro">'.do_shortcode($flatsome_opt['html_intro']).'</div>' ?>

	<div id="wrapper"<?php if($flatsome_opt['box_shadow']) echo ' class="box-shadow"';?>>
		<div class="header-wrapper before-sticky">
		<?php if(!isset($flatsome_opt['topbar_show']) || $flatsome_opt['topbar_show']){ ?>
		<div id="top-bar">
			<div class="row">
				<div class="large-12 columns">
					<!-- left text -->
					<div class="left-text left">
						<div class="html"><?php echo do_shortcode( $flatsome_opt['topbar_left']);?></div><!-- .html -->
					</div>
					<!-- top bar right -->
					<div class="right-text right">

							<ul id="menu-top-bar-menu" class="top-bar-nav">
								<?php
									if ( has_nav_menu( 'top_bar_nav' ) ) {
										wp_nav_menu(array(
											'theme_location' => 'top_bar_nav',
											'container'       => false,
											'items_wrap'      => '%3$s',
											'depth' => 2,
											'walker' => new FlatsomeNavDropdown
										));
									}
									?>

			                        <?php if(ux_is_woocommerce_active() && $flatsome_opt['myaccount_dropdown'] == 'top_bar') { ?>
									<li class="account-dropdown menu-parent-item">
										<?php
										if ( is_user_logged_in() ) { ?> 
										<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="nav-top-link nav-top-login">
											<?php _e('My Account', 'woocommerce'); ?>
										</a>
										<div class="nav-dropdown">
											<ul>
											<?php if ( has_nav_menu( 'my_account' ) ) { ?>
											<?php  
												wp_nav_menu(array(
													'theme_location' => 'my_account',
													'container'       => false,
													'items_wrap'      => '%3$s',
													'depth'           => 0,
												));
											?>
											<?php } else if(!function_exists('wc_get_account_menu_items')) { ?>
							                 <li>Define your My Account dropdown menu in <b>Appearance > Menus</b></li>
					                        <?php } ?>
					                        <?php if(function_exists('wc_get_account_menu_items') && $flatsome_opt['wc_account_links']){ ?>
											    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
													<li>
														<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
													</li>
												<?php endforeach; ?>
											<?php } ?>
											</ul>
									</div><!-- end account dropdown -->
								
										<?php } else { ?>
										<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="nav-top-link nav-top-not-logged-in"><?php _e('Login', 'woocommerce'); ?></a>
										<?php } ?>						
									</li>
									<?php } // end My account dropdown ?>

			                        <?php if(ux_is_woocommerce_active() && $flatsome_opt['show_cart'] == 'top_bar') { ?>
									<li class="mini-cart-top-bar">
											<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>">
												<strong ><?php _e('Cart', 'woocommerce'); ?></strong> 
												<span>/ <?php echo $woocommerce->cart->get_cart_subtotal(); ?></span> 
												<span class="label"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
											</a>
									</li><!-- .mini-cart -->
									<?php } ?>

									<?php if($flatsome_opt['topbar_right']) { ?>
									<li class="html-block">
										<div class="html-block-inner"><?php echo do_shortcode($flatsome_opt['topbar_right']); ?></div>
									</li>
									<?php } ?>
							</ul>
					</div><!-- top bar right -->

				</div><!-- .large-12 columns -->
			</div><!-- .row -->
		</div><!-- .#top-bar -->
		<?php }?>
		<header id="masthead" class="site-header" role="banner">
			<div class="row"> 
				<div class="large-12 columns header-container">
					<div class="mobile-menu show-for-small">
						<a href="#jPanelMenu" class="off-canvas-overlay" data-pos="left" data-color="light"><span class="icon-menu"></span></a>
					</div><!-- end mobile menu -->

					<?php if($flatsome_opt['logo_position'] == 'left') : ?> 
					<div id="logo" class="logo-left">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
							<?php if($flatsome_opt['site_logo']){
								$site_title = esc_attr( get_bloginfo( 'name', 'display' ));
								$logo_class = "";
								if($flatsome_opt['site_logo_sticky']) {$logo_class = 'has_sticky_logo';} 

								echo '<img src="'.$flatsome_opt['site_logo'].'" class="header_logo '.$logo_class.'" alt="'.$site_title.'"/>';
								if ( is_page_template( 'page-transparent-header-light.php' )) {
								  if($flatsome_opt['site_logo_dark']){
								  	echo '<img src="'.$flatsome_opt['site_logo_dark'].'" class="header_logo_dark" alt="'.$site_title.'"/>';
								  }
								}
								if($flatsome_opt['site_logo_sticky']){
								  	echo '<img src="'.$flatsome_opt['site_logo_sticky'].'" class="header_logo_sticky" alt="'.$site_title.'"/>';
								 }
							} else {bloginfo( 'name' );}?>
						</a>
					</div><!-- .logo -->
					<?php endif; ?>

					<div class="left-links">
						<?php if(!isset($flatsome_opt['nav_position']) || $flatsome_opt['nav_position'] == 'top'){ ?>
							<ul id="site-navigation" class="header-nav">
								<?php if ( has_nav_menu( 'primary' ) ) : ?>
								
								<?php if (!isset($flatsome_opt['search_pos']) || $flatsome_opt['search_pos'] == 'left') { ?>
								<li class="search-dropdown">
									<a href="#" class="nav-top-link icon-search" onClick="return false;"></a>
									<div class="nav-dropdown">
										<?php if(function_exists('get_product_search_form')) {
											get_product_search_form();
										} else {
											get_search_form();
										} ?>	
									</div><!-- .nav-dropdown -->
								</li><!-- .search-dropdown -->
								<?php } ?>

									<?php  
									wp_nav_menu(array(
										'theme_location' => 'primary',
										'container'       => false,
										'items_wrap'      => '%3$s',
										'depth'           => 0,
										'walker'          => new FlatsomeNavDropdown
									));
								?>

								<?php if (isset($flatsome_opt['search_pos']) && $flatsome_opt['search_pos'] == 'right') { ?>
								<li class="search-dropdown">
									<a href="#" class="nav-top-link icon-search"></a>
									<div class="nav-dropdown">
										<?php if(function_exists('get_product_search_form')) {
											get_product_search_form();
										} else {
											get_search_form();
										} ?>		
									</div><!-- .nav-dropdown -->
								</li><!-- .search-dropdown -->
								<?php } ?>

		                        <?php else: ?>
		                            <li>Define your main navigation in <b>Appearance > Menus</b></li>
		                        <?php endif; ?>								
							</ul>
						<?php } else if($flatsome_opt['nav_position'] == 'bottom' || $flatsome_opt['nav_position'] == 'bottom_center') { ?>
 
						<div class="wide-nav-search hide-for-small">
							<?php if($flatsome_opt['search_pos'] == 'left'){ ?>
							<div>
									<?php if(function_exists('get_product_search_form')) {
											get_product_search_form();
										} else {
											get_search_form();
										} ?>		
							</div>
							<?php } ?>
							
							<div>
								<?php echo do_shortcode($flatsome_opt['nav_position_text_top']); ?>
							</div>
						</div>
						

						<?php } ?>
					</div><!-- .left-links -->

					<?php if($flatsome_opt['logo_position'] == 'center') { ?> 
					<div id="logo" class="logo-center">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
							<?php if($flatsome_opt['site_logo']){
								$site_title = esc_attr( get_bloginfo( 'name', 'display' ));
								$logo_class = "";
								if($flatsome_opt['site_logo_sticky']) {$logo_class = 'has_sticky_logo';} 

								echo '<img src="'.$flatsome_opt['site_logo'].'" class="header_logo '.$logo_class.'" alt="'.$site_title.'"/>';
								if ( is_page_template( 'page-transparent-header-light.php' )) {
								  if($flatsome_opt['site_logo_dark']){
								  	echo '<img src="'.$flatsome_opt['site_logo_dark'].'" class="header_logo_dark" alt="'.$site_title.'"/>';
								  }
								}
								if($flatsome_opt['site_logo_sticky']){
								  	echo '<img src="'.$flatsome_opt['site_logo_sticky'].'" class="header_logo_sticky" alt="'.$site_title.'"/>';
								 }
							} else {bloginfo( 'name' );}?>
						</a>
					</div><!-- .logo -->
					<?php } ?>

					<div class="right-links">
						<ul <?php if($flatsome_opt['nav_position'] == 'top_right'){ ?>id="site-navigation"<?php } ?> class="header-nav">
							
						<?php if($flatsome_opt['nav_position'] == 'top_right'){ ?>
								<?php if ( has_nav_menu( 'primary' ) ) { ?>
								
								<?php if (!isset($flatsome_opt['search_pos']) || $flatsome_opt['search_pos'] == 'left') { ?>
								<li class="search-dropdown">
									<a href="#" class="nav-top-link icon-search" onClick="return false;"></a>
									<div class="nav-dropdown">
										<?php if(function_exists('get_product_search_form')) {
											get_product_search_form();
										} else {
											get_search_form();
										} ?>	
									</div><!-- .nav-dropdown -->
								</li><!-- .search-dropdown -->
								<?php } ?>

									<?php  
									wp_nav_menu(array(
										'theme_location' => 'primary',
										'container'       => false,
										'items_wrap'      => '%3$s',
										'depth'           => 0,
										'walker'          => new FlatsomeNavDropdown
									));
								?>

								<?php if (isset($flatsome_opt['search_pos']) && $flatsome_opt['search_pos'] == 'right') { ?>
								<li class="search-dropdown">
									<a href="#" class="nav-top-link icon-search"></a>
									<div class="nav-dropdown">
										<?php if(function_exists('get_product_search_form')) {
											get_product_search_form();
										} else {
											get_search_form();
										} ?>		
									</div><!-- .nav-dropdown -->
								</li><!-- .search-dropdown -->
								<?php } ?>
		                    <?php } ?>		
		                   	<?php } // primary-nav right style ?>

							<?php if($flatsome_opt['top_right_text']) { ?>
							<li class="html-block">
								<div class="html-block-inner hide-for-small"><?php echo do_shortcode($flatsome_opt['top_right_text']); ?></div>
							</li>
							<?php } ?>

						<?php if(!$flatsome_opt['catalog_mode']) { ?>
						
						<?php if(!isset($flatsome_opt['myaccount_dropdown']) || $flatsome_opt['myaccount_dropdown'] == '1') { ?>
							<li class="account-dropdown hide-for-small">
								<?php
								if ( is_user_logged_in() ) { ?> 
								<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="nav-top-link nav-top-login">
									<?php _e('My Account', 'woocommerce'); ?>
								</a>
								<div class="nav-dropdown">
									<ul>
									<?php if ( has_nav_menu( 'my_account' ) ) { ?>
									<?php  
									wp_nav_menu(array(
										'theme_location' => 'my_account',
										'container'       => false,
										'items_wrap'      => '%3$s',
										'depth'           => 0,
									));
									?>
									<?php } else if(!function_exists('wc_get_account_menu_items')) { ?>
					                 <li>Define your My Account dropdown menu in <b>Appearance > Menus</b></li>
			                        <?php } ?>
			                        <?php if(function_exists('wc_get_account_menu_items') && $flatsome_opt['wc_account_links']){ ?>
									    <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
											<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
												<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
											</li>
										<?php endforeach; ?>
									<?php } ?>
									</ul>
								</div><!-- end account dropdown -->
								
							<?php } else { ?>
							<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
								class="nav-top-link nav-top-not-logged-in"
								<?php if($flatsome_opt['account_login_style'] == 'lightbox'){
									echo 'data-lightbox="#login-lightbox"';
								}?>>
								<?php _e('Login', 'woocommerce'); ?></a>
							<?php
						}
						?>						
						</li>
						<?php } // end My account dropdown ?>
						
					<!-- Show mini cart if Woocommerce is activated -->

					<?php if(!isset($flatsome_opt['show_cart']) || $flatsome_opt['show_cart'] == 1) { ?>
					<?php if(function_exists('wc_print_notices')) { ?>
					<li class="mini-cart <?php if($flatsome_opt['show_cart'] == 'top_bar') echo 'hide-for-medium'; ?>">
						<div class="cart-inner">
							<?php // Edit this content in inc/woocommerce/template-tags-global.php. Its gets relpaced with Ajax! ?>
							<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="cart-link">
								<strong class="cart-name hide-for-small"><?php _e('Cart', 'woocommerce'); ?></strong> 
								<span class="cart-price hide-for-small">/ <?php echo $woocommerce->cart->get_cart_subtotal(); ?></span> 
									<!-- cart icon -->
									<div class="cart-icon">
				                        <?php if ($flatsome_opt['custom_cart_icon']){ ?> 
				                        <div class="custom-cart-inner">
					                        <div class="custom-cart-count"><?php echo $woocommerce->cart->cart_contents_count; ?></div>
					                        <img class="custom-cart-icon" alt="<?php _e('Cart', 'woocommerce'); ?>" src="<?php echo $flatsome_opt['custom_cart_icon']?>"/> 
				                        </div><!-- .custom-cart-inner -->
				                        <?php } else { ?> 
				                         <strong><?php echo $woocommerce->cart->cart_contents_count; ?></strong>
				                         <span class="cart-icon-handle"></span>
				                        <?php }?>
									</div><!-- end cart icon -->
							</a>
							<div id="mini-cart-content" class="nav-dropdown">
							  	<div class="nav-dropdown-inner">
								<!-- Add a spinner before cart ajax content is loaded -->
									<?php if ($woocommerce->cart->cart_contents_count == 0) {
										echo '<p class="empty">'.__('No products in the cart.','woocommerce').'</p>';
										?> 
									<?php } else { //add a spinner ?> 
										<div class="ux-loading"></div>
									<?php } ?>
									</div><!-- nav-dropdown-innner -->
							</div><!-- .nav-dropdown -->
						</div><!-- .cart-inner -->
					</li><!-- .mini-cart -->
					<?php } ?>
					<?php } ?>
	
					<?php } else { ?>
					<li class="html-block">
						<div class="html-block-inner">
							<?php echo do_shortcode($flatsome_opt['catalog_mode_header']); ?>
						</div>
					</li>
					<?php } // catlogue mode ?>
				</ul><!-- .header-nav -->
			</div><!-- .right-links -->
		</div><!-- .large-12 -->
	</div><!-- .row -->


</header><!-- .header -->

<?php if($flatsome_opt['nav_position'] == 'bottom' || $flatsome_opt['nav_position'] == 'bottom_center') { ?>
<!-- Main navigation - Full width style -->
<div class="wide-nav <?php echo $flatsome_opt['nav_position_color']; ?> <?php if($flatsome_opt['nav_position'] == 'bottom_center') {echo 'nav-center';} else {echo 'nav-left';} ?>">
	<div class="row">
		<div class="large-12 columns">
		<div class="nav-wrapper">
		<ul id="site-navigation" class="header-nav">
				<?php if ( has_nav_menu( 'primary' ) ) : ?>
					<?php  
					wp_nav_menu(array(
						'theme_location' => 'primary',
						'container'       => false,
						'items_wrap'      => '%3$s',
						'depth'           => 3,
						'walker'          => new FlatsomeNavDropdown
					));
				?>

				<?php if($flatsome_opt['search_pos'] == 'right' && $flatsome_opt['nav_position'] == 'bottom_center'){ ?>
					<li class="search-dropdown">
					<a href="#" class="nav-top-link icon-search" onClick="return false;"></a>
					<div class="nav-dropdown">
						<?php if(function_exists('get_product_search_form')) {
							get_product_search_form();
						} else {
							get_search_form();
						} ?>	
					</div><!-- .nav-dropdown -->
				</li><!-- .search-dropdown -->
				<?php } ?>
              <?php else: ?>
                  <li>Define your main navigation in <b>Appearance > Menus</b></li>
              <?php endif; ?>								
		</ul>
		<?php if($flatsome_opt['nav_position'] == 'bottom') { ?>
		<div class="right hide-for-small">
			<div class="wide-nav-right">
				<div>
				<?php echo do_shortcode($flatsome_opt['nav_position_text']); ?>
			</div>
				<?php if($flatsome_opt['search_pos'] == 'right'){ ?>
							<div>
									<?php if(function_exists('get_product_search_form')) {
											get_product_search_form();
										} else {
											get_search_form();
										} ?>		
							</div>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
		</div><!-- .nav-wrapper -->
		</div><!-- .large-12 -->
	</div><!-- .row -->
</div><!-- .wide-nav -->
<?php } ?>
</div><!-- .header-wrapper -->

<div id="main-content" class="site-main hfeed <?php echo $flatsome_opt['content_color']; ?>">
<?php 
//adds a border line if header is white
if (strpos($flatsome_opt['header_bg'],'#fff') !== false && $flatsome_opt['nav_position'] == 'top') {
		  echo '<div class="row"><div class="large-12 columns"><div class="top-divider"></div></div></div>';
} ?>

<?php if($flatsome_opt['html_after_header']){
	// AFTER HEADER HTML BLOCK
	echo '<div class="block-html-after-header" style="position:relative;top:-1px;">';
	echo do_shortcode($flatsome_opt['html_after_header']);
	echo '</div>';
} ?>

<!-- woocommerce message -->
<?php  if(function_exists('wc_print_notices')) {wc_print_notices();}?>