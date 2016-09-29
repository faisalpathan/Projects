<div class="left-nav-layout hidden-sm hidden-md hidden-lg">
    <div class="left-nav">
        <nav role="navigation">
            <button type="button" class="btn btn-theme btn-block no-radius" onclick="jQuery('#mainmenu-left').slideToggle();"><i class="tn-menu "></i> Menu</button>

            <?php


            $args = array(
                'theme_location' => 'primary',
                'depth' => 9,
                'container' => false,
                'menu_class' => 'left-nav-menu collapse-xs nav navbar-nav',
                'menu_id' => 'mainmenu-left',
                'fallback_cb' => false,
                'walker' => new TheNextVerticalNavMenu()
            );


            wp_nav_menu($args);


            ?>


        </nav>
    </div>
</div>