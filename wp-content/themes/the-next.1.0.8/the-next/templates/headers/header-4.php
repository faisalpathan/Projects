<?php define('THENEXT_LEFT_NAV', 1); ?>
<?php get_template_part('templates/head') ?>
<!-- Nav Header Template: Left Nav -->

<body <?php body_class('w3eden'); ?>>

<?php

/**
 * Add anything immediately after body tag
 */
do_action(THENEXT_THEME_PREFIX."body_content_before");

?>

<div id="mainframe" class="wide left-nav-layout" <?php do_action('thenext_mainframe_div_attrs'); ?> >
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-4 left-nav">
                <div id="header-style-4">

                    <header id="header-left" class="header">
                        <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>"><?php echo WPEdenThemeEngine::SiteLogo(); ?></a>
                        <?php get_template_part('templates/menus/mobile'); ?>
                        
                        <nav role="navigation">
                                <?php
                                $args = array(
                                    'theme_location' => 'primary',
                                    'depth' => 9,
                                    'container' => false,
                                    'menu_class' => 'left-nav-menu collapse-xs',
                                    'menu_id' => 'mainmenu-left',
                                    'fallback_cb' => false,
                                    'walker' => new TheNextVerticalNavMenu()
                                );
                                wp_nav_menu($args);
                                ?>
                        </nav>
                    </header>
                    
                </div>
                
                <div id="left-side-bar"></div>
            </div>
            <div class="col-md-9 col-sm-8 content-area">
                <?php WPEdenThemeEngine::PageHeader(); ?>



        
