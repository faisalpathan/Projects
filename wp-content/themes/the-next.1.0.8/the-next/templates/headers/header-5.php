<?php get_template_part('templates/head') ?>
<!-- Nav Header Template: Header 5 -->

<body <?php body_class('w3eden'); ?>>

    <?php
    /**
     * Add anything immediately after body tag
     */
    do_action(THENEXT_THEME_PREFIX . "body_content_before");
    ?>

    <div id="mainframe" class="<?php echo sanitize_text_field(WPEdenThemeEngine::Layout('wide')); ?>" <?php do_action('thenext_mainframe_div_attrs'); ?> >
        <div id="header-style-5">
            <header id="header-2" class="header">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container relative">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>"><?php echo WPEdenThemeEngine::SiteLogo(); ?></a>
                            <?php get_template_part('templates/menus/mobile'); ?>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-ex1-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left  hidden-xs">
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
        </div>

        <?php WPEdenThemeEngine::PageHeader(); ?>




