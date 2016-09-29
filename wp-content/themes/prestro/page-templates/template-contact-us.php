<?php
/*
Template Name: Contact Us
*/
?>
<?php get_header(); ?>
<div class="content-top">
<section class="contact-form">        
    <div class="container">
            <div class="row">
                <div id="contact-us">
                    <div class="col-md-8 col-xs-12">
                        <h3 class="text-center"><?php if(get_theme_mod("contact_sec_title")) echo get_theme_mod("contact_sec_title"); ?></h3>
                        <div class="line-center"></div>
                        <?php
                        $code = get_theme_mod("contact-form");
                        if(isset($code) && !empty($code)){
                            echo do_shortcode(".$code."); 
                        }
                        ?>
                    </div>
                    <div class="col-md-3 col-md-offset-1 col-xs-12">
                        <div class="contact-side">
                            <?php dynamic_sidebar('contact-widget'); ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
</div>
<?php get_footer(); ?>