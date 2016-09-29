<?php
/**
 * The Header template for our theme
 */ ?>
<!doctype html>

<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

    <?php 
        $preloader = get_theme_mod('preloader');

    if($preloader == '1')
    { ?>
        <div class="preloader"><span class="preloader-gif"></span></div>
    <?php }?>
	<div class="master-header">
        <header>
            <!-- Header with Brand -->
            <nav class="navbar-fixed-top fixed-header1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 top-menu">
                            <?php if(get_bloginfo( 'description' ) != "") : ?>
                                <div class="logo-description">
                                    <div class="header-logo">
                                        <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                                        <?php $logo_image = '';
                                            if (function_exists('get_custom_logo')) {
                                                $logo_image = has_custom_logo(); 
                                                $output_logo = get_custom_logo();
                                            } 
                                            if(empty($logo_image)){
                                                echo '<h3 class="site-title logo-box">'.get_bloginfo('name').'</h3><span class="site-description">'.get_bloginfo('description').'</span>';
                                            }else{ 
                                                echo $output_logo;
                                            } ?>
                                        </a>
                                    </div>
                                <div id="cssmenu">
                                  <?php if (has_nav_menu('primary')) {
                                    $bizzboss_defaults = array(
                                        'theme_location' => 'primary',
                                        'container'      => false, 
                                    );
                                    wp_nav_menu($bizzboss_defaults);                                        
                                  } ?> 
                                </div>   
                            </div>
                        <?php else : ?>
                                <div class="header-logo"></div>
                               <?php if (has_nav_menu('primary')) {
                                    $bizzboss_defaults = array(
                                        'theme_location' => 'primary',
                                        'container'      => 'div', 
                                        'container_id' => 'cssmenu'
                                    );
                                    wp_nav_menu($bizzboss_defaults);                                        
                                } ?>                              
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </div>