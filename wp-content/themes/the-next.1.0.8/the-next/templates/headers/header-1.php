<?php get_template_part('templates/head') ?>
<!-- Nav Header Template: Header 1 -->
<body <?php body_class('w3eden'); ?>>

    <?php
    /**
     * Add anything immediately after body tag
     */
    do_action("thenext_body_content_before");
    ?>

    <div id="mainframe"  class="<?php echo sanitize_text_field(WPEdenThemeEngine::Layout('wide')); ?>" <?php do_action('thenext_mainframe_div_attrs'); ?> >

        <header id="header-1" class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 header-info-wrapper">
                        <ul class="list-inline">
                            <li><i class="fa fa-mobile-phone"></i> &nbsp;<?php echo sanitize_text_field( WPEdenThemeEngine::NextGetOption('contact_phone', '(123) 456-7890') ); ?></li>
                            <li><i class="fa fa-envelope"></i> &nbsp;<a href="mailto:<?php echo esc_attr(WPEdenThemeEngine::NextGetOption('contact_email', 'contact@example.com')); ?>"><?php echo sanitize_text_field( WPEdenThemeEngine::NextGetOption('contact_email', 'contact@example.com') ); ?></a></li>
                        </ul>
                        <!-- /.list-inline -->
                    </div>
                    <!-- /.header-info-wrapper -->
                    <div class="col-xs-12 col-sm-4 social-link-wrapper">
                        <ul class="social-links">
                            <?php if (WPEdenThemeEngine::NextGetOption('facebook_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('facebook_profile_url') ); ?>"><i class="fa fa-facebook"></i></a></li>
                                <?php } ?>
                                <?php if (WPEdenThemeEngine::NextGetOption('googleplus_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('googleplus_profile_url') ); ?>"><i class="fa fa-google-plus"></i></a></li>
                                <?php } ?>
                                <?php if (WPEdenThemeEngine::NextGetOption('twitter_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('twitter_profile_url') ); ?>"><i class="fa fa-twitter"></i></a></li>
                                <?php } ?>
                                <?php if (WPEdenThemeEngine::NextGetOption('pinterest_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('pinterest_profile_url') ); ?>"><i class="fa fa-pinterest"></i></a></li>
                                <?php } ?>
                                <?php if (WPEdenThemeEngine::NextGetOption('linkedin_profile_url') != '') { ?>
                                <li><a href="<?php echo esc_url( WPEdenThemeEngine::NextGetOption('linkedin_profile_url') ); ?>"><i class="fa fa-linkedin"></i></a></li>
                                <?php } ?>
                        </ul>
                        <!-- /.social-links -->
                    </div>
                    <!-- /.social-link-wrapper -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </header>

        <header id="header-2" class="header">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container relative">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>"><?php echo WPEdenThemeEngine::SiteLogo(); ?></a>
                        <?php get_template_part('templates/menus/mobile'); ?>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left hidden-xs">
                    <?php
                    $args = array(
                        'theme_location' => 'primary',
                        'depth' => 9,
                        'container' => false,
                        'menu_class' => 'nav navbar-nav',
                        'menu_id' => 'mainmenu',
                        'fallback_cb' => false,
                        'walker' => new TheNextNavMenu()
                    );


                    wp_nav_menu($args);
                    ?>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- /.navbar -->
        </header>

        <?php WPEdenThemeEngine::PageHeader(); ?>




