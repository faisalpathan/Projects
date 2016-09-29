<!doctype html>
<!--[if lt IE 7 ]>
<html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9 ie-lt10 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $kyma_theme_options = kyma_theme_options(); ?>
    <?php wp_head(); ?>
</head>
<?php $class = "";
if ($kyma_theme_options['site_layout'] != "") {
    $class = 'site_boxed ';
}
$class .= isset($kyma_theme_options['headercolorscheme']) ? $kyma_theme_options['headercolorscheme'] : ''; ?>
<body <?php body_class("menu_button_mode preloader3 menu_button_mode " . $class); ?>>
<span id="stickymenu"
      style="display:none;"><?php echo isset($kyma_theme_options['headersticky']) ? esc_attr($kyma_theme_options['headersticky']) : 1 ; ?></span>

<div id="preloader">
    <div class="spinner">
        <div class="sk-dot1"></div>
        <div class="sk-dot2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
</div>
<div id="main_wrapper">
    <header id="site_header">
        <div class="topbar <?php echo esc_attr($kyma_theme_options['topbarcolor']); ?>">
            <!-- class ( topbar_colored  ) -->
            <div class="content clearfix">
				<?php if ($kyma_theme_options['contact_info_header']) { ?>
                <div class="top_details clearfix f_left"><?php
                    if ($kyma_theme_options['contact_phone']) {
                        ?>
                        <span><i class="fa fa-phone"></i><span
                            class="title"><?php _e('Call Us :', 'kyma') ?></span><a href="tel:<?php echo esc_attr($kyma_theme_options['contact_phone']); ?>"><?php echo esc_attr($kyma_theme_options['contact_phone']); ?></a>
                        </span><?php
                    }
                    if ($kyma_theme_options['contact_email']) {
                        ?>
                        <span><i class="fa fa-envelope-o"></i><span
                                class="title"><?php _e('Email :', 'kyma') ?></span>
							<a href="mailto:<?php echo sanitize_email($kyma_theme_options['contact_email']); ?>"><?php echo sanitize_email($kyma_theme_options['contact_email']); ?></a></span>
                    <?php } ?>
                </div>
                <?php } if ($kyma_theme_options['social_media_header']) { ?>
                    <div class="top-socials box_socials f_right">
                    <?php if ($kyma_theme_options['social_facebook_link'] != '') { ?>
                    <a href="<?php echo esc_url($kyma_theme_options['social_facebook_link']); ?>" target="_blank">
                        <span class="soc_name"><?php _e('Facebook', 'kyma'); ?></span>
                        <span class="soc_icon_bg"></span>
                        <i class="fa fa-facebook"></i>
                        </a><?php
                    }
                    if ($kyma_theme_options['social_facebook_link'] != '') {
                        ?>
                    <a href="<?php echo esc_url($kyma_theme_options['social_twitter_link']); ?>" target="_blank">
                        <span class="soc_name"><?php _e('Twitter', 'kyma'); ?></span>
                        <span class="soc_icon_bg"></span>
                        <i class="fa fa-twitter"></i>
                        </a><?php
                    }
                    if ($kyma_theme_options['social_google_plus_link'] != '') {
                        ?>
                    <a href="<?php echo esc_url($kyma_theme_options['social_google_plus_link']); ?>" target="_blank">
                        <span class="soc_name"><?php _e('Google+', 'kyma'); ?></span>
                        <span class="soc_icon_bg"></span>
                        <i class="fa fa-google-plus"></i>
                        </a><?php
                    }
                    if ($kyma_theme_options['social_skype_link'] != '') {
                        ?>
                    <a href="skype:<?php echo esc_url($kyma_theme_options['social_skype_link']); ?>">
                        <span class="soc_name"><?php _e('Skype', 'kyma'); ?></span>
                        <span class="soc_icon_bg"></span>
                        <i class="fa fa-skype"></i>
                        </a><?php
                    }
                    if ($kyma_theme_options['social_vimeo_link'] != '') {
                        ?>
                    <a href="<?php echo esc_url($kyma_theme_options['social_vimeo_link']); ?>" target="_blank">
                        <span class="soc_name"><?php _e('Vimeo', 'kyma'); ?></span>
                        <span class="soc_icon_bg"></span>
                        <i class="fa fa-vimeo-square"></i>
                        </a><?php
                    }
                    if ($kyma_theme_options['social_youtube_link'] != '') {
                        ?>
                    <a href="<?php echo esc_url($kyma_theme_options['social_youtube_link']); ?>" target="_blank">
                        <span class="soc_name"><?php _e('YouTube', 'kyma'
                            ); ?></span>
                        <span class="soc_icon_bg"></span>
                        <i class="fa fa-youtube"></i>
                        </a><?php
                    } ?>
                    </div><?php
                } ?>
            </div>
            <!-- End content -->
			<span class="top_expande not_expanded">
				<i class="no_exp fa fa-angle-double-down"></i>
				<i class="exp fa fa-angle-double-up"></i>
			</span>
        </div>
        <!-- End topbar -->
        <div id="navigation_bar"
             style="<?php if (get_header_image()) : ?> background-image:url('<?php header_image();?>'); <?php endif; ?>">
            <div class="content">
                <div id="logo" <?php if ($kyma_theme_options['logo_layout'] == "right") {
                    echo 'style="float:right;"';
                } ?>>
                    <?php if ( version_compare( $wp_version, '4.5.2', '>=' ) ) {
						if (!strrpos(get_custom_logo(), "src")===false) {
								the_custom_logo();
							} else { ?>
								<a href="<?php echo esc_url(home_url('/')); ?>"
                       title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><h3><?php echo esc_attr(get_bloginfo('name')); ?></h3></a>
                        <?php }
						} else { ?>
					<a href="<?php echo esc_url(home_url('/')); ?>"
                       title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                        <?php if ($kyma_theme_options['upload_image_logo']!="") {
                            ?>
                            <img id="logoimg" src="<?php echo esc_url($kyma_theme_options['upload_image_logo']); ?>"
                                 alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"/>
                        <?php } else { ?>
                            <h3><?php echo esc_attr(get_bloginfo('name')); ?></h3>
                        <?php }
						} ?>
					</a>
                </div>
                <nav id="main_nav">
                    <div id="nav_menu">
						<span class="mobile_menu_trigger">
						    <a href="#" class="nav_trigger"><span></span></a>
						</span>
                        <?php wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_class' => 'clearfix horizontal_menu',
                                'menu_id' => 'navy',
                                'fallback_cb' => 'kyma_fallback_page_menu',
                                'link_before' => '<span>',
                                'link_after' => '</span>',
                                'walker' => new kyma_nav_walker(),
                            )
                        ); ?>
                    </div>
                </nav>
                <!-- End Nav -->
                <div class="clear"></div>
            </div>
        </div>
    </header>
    <!-- End Main Header -->