<?php

class TheNextPreLoader{

    function  __construct(){
        add_action(THENEXT_THEME_PREFIX."body_content_before", array($this, 'BeforeBodyContent'));
        add_action(THENEXT_THEME_PREFIX."body_content_after", array($this, 'AfterBodyContent'));
    }

    function BeforeBodyContent(){
        ?>
        <div id="preloader" style="display:none;top:0;position: fixed;width: 100%;height: 100%;vertical-align: middle; text-align: center;background: rgba(255,255,255,0.95);z-index: 999999999">
            <div class="signal"></div>
        </div>
        <style>
            .signal {
                border:3px solid <?php echo WPEdenThemeEngine::NextGetOption('color_scheme', '#2C3E50') ?>;
                border-radius:30px;
                height:30px;
                left:50%;
                margin:-15px 0 0 -15px;
                opacity:0;
                position:absolute;
                top:50%;
                width:30px;
                animation: pulsate 1s ease-out;
                animation-iteration-count:infinite;
            }
            @keyframes pulsate {
                0% {
                    transform:scale(.1);
                    opacity: 0.0;
                }
                50% {
                    opacity:1;
                }
                100% {
                    transform:scale(1.2);
                    opacity:0;
                }
            }
        </style>

        <?php
    }

    function AfterBodyContent(){
        ?>
        <script>
            jQuery(function($){
                $(window).on('load', function(){
                    setTimeout(function(){ $('#preloader').fadeOut(1000); }, 10000)
                    $('#preloader').fadeOut(1000);
                    $('#mainframe').animate({opacity:1});
                });
                $(window).on('unload', function(){
                    $('#preloader').fadeIn(100);
                });
                $('body').on('click','a', function(e){
                    e.preventDefault();
                    if($(this).attr('target')==undefined && this.href.indexOf('#')==-1) {
                        $('#preloader').fadeIn(100);
                        location.href = this.href;
                    }
                });

                $('#preloader').on('click', function(){
                    alert(1);
                    $('#preloader').fadeOut(1000);
                });

                setTimeout(function(){ $('#preloader').fadeOut(1000); }, 15000)
            });
        </script>

        <?php
    }
}
new TheNextPreLoader();