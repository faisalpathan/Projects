<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 footer-area">
                <div class="row">
                    <div class="col-md-3"><?php dynamic_sidebar('footer1') ?></div>
                    <div class="col-md-3"><?php dynamic_sidebar('footer2') ?></div>
                    <div class="col-md-3"><?php dynamic_sidebar('footer3') ?></div>
                    <div class="col-md-3"><?php dynamic_sidebar('footer4') ?></div>
                </div>
                <div class="divider"></div>
                <div class="container-fluid footer-area-bottom">
                    <div class="row">
                        <div class="col-md-2 col-sm-6">
                            <?php
                            $logourl = esc_url( WPEdenThemeEngine::NextGetOption('site_logo_footer') );
                            if ($logourl)
                                echo "<img class='footer-logo' src='{$logourl}' title='" . get_bloginfo('sitename') . "' alt='" . get_bloginfo('sitename') . "' />";
                            else
                                echo get_bloginfo('sitename');
                            ?>
                        </div>
                        <div class="col-md-10">
                            <div class="text-right">
                                Theme By <a class="footer-brand" href="http://wpeden.com/">WordPress Eden</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php if (defined('THENEXT_LEFT_NAV')) echo '</div> </div> </div>'; ?>

<?php do_action(THENEXT_THEME_PREFIX . "body_content_after"); ?>

<?php wp_footer(); ?>
</body>
</html>