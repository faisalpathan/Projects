<?php

define("THENEXT_THEME_DIR", dirname(dirname(__FILE__)));
define("THENEXT_THEME_URL", get_stylesheet_directory_uri());
define("THENEXT_TEMPLATE_URL", get_template_directory_uri());

require_once dirname(__FILE__).'/Util.class.php';
require_once dirname(__FILE__).'/OptionFields.class.php';


class WPEdenThemeEngine{


    function __construct(){
        $this->Actions();
        $this->Filters();
    }

    function Filters(){
        add_filter( 'body_class', array($this, 'BodyClass'), 10, 2 );
        add_filter( 'thenext_layout_type', array($this, 'PageLayout') );
    }

    function Actions(){
        add_action( 'admin_enqueue_scripts', array($this, 'AdminEnqueueScripts'));
        add_action( 'wp_before_admin_bar_render', array($this, 'ToolBarMenu'));
        add_action('wp_head', array($this, 'WPHead'));
        add_action('admin_head', array($this, 'AdminHead'));
        add_action( 'widgets_init', array($this, 'InitiateWidgets') );
    }

    function WPHead(){
        $this->CustomCSS();
        $this->PageCSS();
        $this->CustomPageBG();
    }

    function AdminHead(){
        ?>
        <script>var wpeden_theme_url='<?php echo esc_url( THENEXT_THEME_URL ); ?>';</script>
        <?php
    }


    function PageCSS(){
        wp_reset_query();
        global $post;
        if(!is_404())
            $data = maybe_unserialize(get_post_meta($post->ID,'wpeden_post_meta', true));
        
        if(isset($data['page_css'])) {
            ?>
            <!-- custom page css -->
            <style>
                <?php echo wp_filter_nohtml_kses($data['page_css']); ?>
            </style>
            <!-- // custom page css -->
        <?php
        }

    }

    /**
     * @usage Custom Page Background for specific pages
     */
    function CustomPageBG(){
        global $post;
        if(!is_404())
            $data = maybe_unserialize(get_post_meta($post->ID,'wpeden_post_meta', true));
        $css = "";
        
        if(isset($data['pagebg']['image']) && $data['pagebg']['image']!='')
        {
            $pbg = esc_url( $data['pagebg']['image'] );
            $css .= "background-image: url({$pbg}) !important;";
        }
        
        if(isset($data['pagebg']['color']) && $data['pagebg']['color']!='') $css .= "background-color: {$data['pagebg']['color']} !important;";
        if(isset($data['pagebg']['repeat']) && $data['pagebg']['repeat']!='') $css .= "background-repeat: {$data['pagebg']['repeat']} !important;";
        if(isset($data['pagebg']['attachment']) && $data['pagebg']['attachment']!='') $css .= "background-attachment: {$data['pagebg']['attachment']} !important;";
        if(isset($data['pagebg']['position_h']) && $data['pagebg']['position_h']!='') $css .= "background-position: {$data['pagebg']['position_h']} {$data['pagebg']['position_v']} !important;";
        if(is_page() && $post->ID!=''){
            ?>
            <!-- Custom page background -->
            <style>body.page-id-<?php echo intval($post->ID); ?>{ <?php echo wp_filter_nohtml_kses($css); ?> }</style>
            <!-- / Custom page background -->
        <?php
        }
    }


    /**
     * @usage: Initiate Widgets
     */
    function InitiateWidgets(){

        register_sidebar(array(
            'name' => 'Left',
            'id' => 'left',
            'description' => 'Left Sidebar',
            'before_widget' => '<div class="widget widget-default">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-heading widget-title">',
            'after_title' => '</div>'
        ));
                
        register_sidebar(array(
            'name' => 'Right',
            'id' => 'right',
            'description' => 'Right Sidebar',
            'before_widget' => '<div class="widget widget-default">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-heading widget-title">',
            'after_title' => '</div>'
        ));
                
        register_sidebar(array(
            'name' => 'Footer Left',
            'id' => 'footer1',
            'description' => 'Footer Left',
            'before_widget' => '<div class="footer-widget  widget">',
            'after_widget' => '</div>',
            'before_title' => '<div class="footer-heading">',
            'after_title' => '</div>'
        ));

        register_sidebar(array(
            'name' => 'Footer Middle',
            'id' => 'footer2',
            'description' => 'Footer Middle',
            'before_widget' => '<div class="footer-widget  widget">',
            'after_widget' => '</div>',
            'before_title' => '<div class="footer-heading">',
            'after_title' => '</div>'
        ));

        register_sidebar(array(
            'name' => 'Footer Right',
            'id' => 'footer3',
            'description' => 'Footer Right',
            'before_widget' => '<div class="footer-widget  widget">',
            'after_widget' => '</div>',
            'before_title' => '<div class="footer-heading">',
            'after_title' => '</div>'
        ));
        register_sidebar(array(
            'name' => 'Footer Last',
            'id' => 'footer4',
            'description' => 'Footer Last',
            'before_widget' => '<div class="footer-widget  widget">',
            'after_widget' => '</div>',
            'before_title' => '<div class="footer-heading">',
            'after_title' => '</div>'
        ));

        $sidebar_styles = array(
            'default' =>array(
                'style_name' => 'Default',
                'before_widget' => '<div class="widget widget-default">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-heading widget-title">',
                'after_title' => '</h3>'
            )
        );
        
        $sidebar_styles = apply_filters("thenext_sidebar_styles", $sidebar_styles);

        /*$custom_sidebars = WPEdenThemeEngine::GetOption('custom_sidebars', array());

        foreach($custom_sidebars as $id => $custom_sidebar){
            $custom_sidebar['id'] = $id;
            $style = (isset($sidebar_styles[$custom_sidebar['style']]))?$custom_sidebar['style']:'default';
            $custom_sidebar = array_merge($custom_sidebar, $sidebar_styles[$style]);
            register_sidebar($custom_sidebar);

        }*/

    }


    function AdminEnqueueScripts($hook){
        
        if(!in_array($hook, array('post-new.php','post.php','profile.php','user-new.php'))) return;
        
        wp_enqueue_style('metabox', THENEXT_TEMPLATE_URL.'/admin/css/metabox.css');
        wp_enqueue_style('chosen-ui', THENEXT_TEMPLATE_URL.'/admin/css/chosen.css');
        wp_enqueue_script('bootstrap', THENEXT_TEMPLATE_URL.'/bootstrap/js/bootstrap.min.js',array('jquery'));
        wp_enqueue_script('chosen-js', THENEXT_TEMPLATE_URL.'/admin/js/chosen.jquery.js',array('jquery'));
        wp_enqueue_script('blockui-js', THENEXT_TEMPLATE_URL.'/admin/js/jquery.blockUI.js',array('jquery'));
        wp_enqueue_script('wpeden-js', THENEXT_TEMPLATE_URL.'/admin/js/wpeden.js',array('jquery','chosen-js','blockui-js'));
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style('wp-color-picker');
    }

    function ToolBarMenu() {
        global $wp_admin_bar;

        if(!current_user_can('manage_options')) return;

        $args = array(
            'id'     => 'wpeden-themeopts',
            'title'  => '<i class="tn-paint-roller" style="font-family: linecons"></i> &nbsp;'.__( 'Customize', 'the-next' ),
            'href'   => admin_url('customize.php'),
        );
        $wp_admin_bar->add_menu( $args );

    }

    public static function Layout($default='wide'){
        $lot = WPEdenThemeEngine::NextGetOption('layout_type',$default);
        echo sanitize_text_field( apply_filters('thenext_layout_type', $lot) );
    }

    function BodyClass($classes, $class){
        if(is_user_logged_in())
            $classes[] = 'thenext-logged-in';
        else
            $classes[] = 'thenext-not-logged-in';
        return $classes;
    }


    public static function FontCSS($typo){
        
        $fonts = WPEdenOptionFields::GetFonts();
        
        $heading_font = sanitize_text_field( self::NextGetOption('heading_font') );
        $body_font = sanitize_text_field( self::NextGetOption('body_font') );

        $widget_title_font = sanitize_text_field( self::NextGetOption('widget_title_font') );
        $widget_content_font = sanitize_text_field( self::NextGetOption('widget_content_font') );

        $menu_top_font = sanitize_text_field( self::NextGetOption('menu_top_font') );
        $menu_dropdown_font = sanitize_text_field( self::NextGetOption('menu_dropdown_font') );

        $heading_font_size = intval( self::NextGetOption('heading_font_size') );
        $body_font_size = intval( self::NextGetOption('body_font_size') );

        $body_color = self::NextGetOption('body_color');
        $header_color = self::NextGetOption('header_color');

        $widget_title_font_size = intval( self::NextGetOption('widget_title_font_size') ); 
        $widget_content_font_size = intval( self::NextGetOption('widget_content_font_size') );

        $menu_top_font_size = intval( self::NextGetOption('menu_top_font_size') );
        $menu_dropdown_font_size = intval( self::NextGetOption('menu_dropdown_font_size') );

        $heading_font_weight = intval( self::NextGetOption('heading_font_weight') );
        $body_font_weight = intval( self::NextGetOption('body_font_weight') );
        $widget_title_font_weight = intval( self::NextGetOption('widget_title_font_weight') );
        $widget_content_font_weight = intval( self::NextGetOption('widget_content_font_weight') );
        $menu_top_font_weight = intval( self::NextGetOption('menu_top_font_weight') );
        $menu_dropdown_font_weight = intval( self::NextGetOption('menu_dropdown_font_weight') );
        
        switch($typo):
            case 'body_typo':
                if($body_font != '')
                    $font_family = $fonts[$body_font]['family'] != '' ? "font-family:{$fonts[$body_font]['family']} !important;" : "";
                else
                    $font_family = '';
                $font_size = $body_font_size != '' ? "font-size:{$body_font_size}px !important;" : "";
                $font_weight = $body_font_weight != '' ? "font-weight:{$body_font_weight} !important;" : "";
                $text_color = $body_color ? "color:{$body_color} !important;" : "";
                $css = "{$font_family}{$font_size}{$font_weight}{$text_color}" ;
                break;
                
            case 'typo_h1':
            case 'typo_h2':
            case 'typo_h3':
            case 'typo_h4':
                if($typo == 'typo_h2') $heading_font_size = floor($heading_font_size * .85);
                else if($typo == 'typo_h3') $heading_font_size = floor ($heading_font_size * .72);
                else if($typo == 'typo_h4') $heading_font_size = floor ($heading_font_size * .6);
                
                if($heading_font != '')
                    $font_family = $fonts[$heading_font]['family'] != '' ? "font-family:{$fonts[$heading_font]['family']} !important;" : "";
                else
                    $font_family = '';

                $font_size = $heading_font_size != '' ? "font-size:{$heading_font_size}px !important;" : "";
                $font_weight = $heading_font_weight != '' ? "font-weight:{$heading_font_weight} !important;" : "";
                $text_color = $header_color ? "color:{$header_color} !important;" : "";

                $css = "{$font_family}{$font_size}{$font_weight}{$text_color}" ;
                break;
                
            case 'widget_content':
            case 'widget_title':
            case 'top_menu':
            case 'dropdown_menu':    
                if($typo == 'widget_content') {
                    $font_size = $widget_content_font_size;
                    $font_weight = $widget_content_font_weight != '' ? "font-weight:{$widget_content_font_weight} !important;" : "";
                    $font = $widget_content_font;
                }
                else if($typo == 'widget_title') {
                    $font_size = $widget_title_font_size;
                    $font_weight = $widget_title_font_weight != '' ? "font-weight:{$widget_title_font_weight} !important;" : "";
                    $font = $widget_title_font;
                }
                else if($typo == 'top_menu') {
                    $font_size = $menu_top_font_size;
                    $font_weight = $menu_top_font_weight != '' ? "font-weight:{$menu_top_font_weight} !important;" : "";
                    $font = $menu_top_font;
                }
                else if($typo == 'dropdown_menu') {
                    $font_size = $menu_dropdown_font_size;
                    $font_weight = $menu_dropdown_font_weight != '' ? "font-weight:{$menu_dropdown_font_weight} !important;" : "";
                    $font = $menu_dropdown_font;
                }
                
                if($font != '') $font_family = $fonts[$font]['family'] != '' ? "font-family:{$fonts[$font]['family']} !important;" : "";
                else $font_family = '';
                
                $font_size = $font_size != '' ? "font-size:{$font_size}px !important;" : "";

                $css = "{$font_family}{$font_size}{$font_weight}" ;
                break;
            
            default :
                $css = '';
                break;
        endswitch;

        return $css;
    }

    /**
     * @usage Generate custom css
     */
    function CustomCSS(){
        
        // Widget Heading(:before) margin top
        $whbmt = floor(self::NextGetOption('heading_font_size') * .72) + 7;
        if($whbmt < 20 ) $whbmt = 20;

        // Main Nav Colors ( From Customizer General Options )
        $main_nav_bg = WPEdenThemeEngine::NextGetOption('main_nav_bg', '');
        if($main_nav_bg != '') $main_nav_bg = "background: $main_nav_bg;";
        $main_nav_color = WPEdenThemeEngine::NextGetOption('main_nav_color', '#333');
        
        // Custom CSS ( From Customizer Custom CSS )
        $thenext_custom_css = wp_filter_nohtml_kses( WPEdenThemeEngine::NextGetOption('custom_css') );
        $thenext_custom_css = stripslashes($thenext_custom_css);
echo "<style>
$thenext_custom_css
body, p{".self::FontCSS('body_typo')."}
    
h1, h1 a, .entry-content h1{".self::FontCSS('typo_h1')."}
h2, h2 a, .entry-content h2{".self::FontCSS('typo_h2')."}
h3, h3 a, .entry-content h3{".self::FontCSS('typo_h3')."}
h4, h4 a, .entry-content h4{".self::FontCSS('typo_h4')."}
    
h3.widget-heading::before, h3.comment-reply-title::before {margin-top : ". $whbmt ."px}
    
*.widget, *.widget li, *.widget p, *.widget a {".self::FontCSS('widget_content')."; }
*.widget .widget-title {".self::FontCSS('widget_title')."; line-height:normal; }

#mainframe.left-nav-layout, #header-2, #header-2 .navbar-default{ $main_nav_bg }



@media (min-width: 768px) {
    #mainmenu .dropdown-menu { color: $main_nav_color; text-shadow:none !important; }
    #mainmenu .dropdown-menu *, #topnav-area .dropdown-menu a, #mainmenu>li>a { color: $main_nav_color }
    #navmenu > li > a, #mainmenu a {" . self::FontCSS('top_menu') . "}
    #navmenu .dropdown-menu > li > a, #mainmenu .dropdown-menu > li > a {" . self::FontCSS('dropdown_menu') . "}
}
</style>";
        
    }

    public static function NextGetOption($index = null, $default = null){
        global $thenext_options;
        
        $thenext_options = get_option('thenext_options'); //print_r($thenext_options);
        if( !empty( $thenext_options[$index]) )
            return $thenext_options[$index];
        else
            return $default;
    }
    

    public static function SiteLogo(){
        $logourl = esc_url( self::NextGetOption('site_logo') );

        if($logourl)
            return "<img src='{$logourl}' title='".get_bloginfo('sitename')."' alt='".get_bloginfo('sitename')."' />";
        else 
            return get_bloginfo('sitename');
    }


    function PageLayout($type){
        global $post;
        $data = maybe_unserialize(get_post_meta($post->ID,'wpeden_post_meta', true));
        
        if(is_page() && $post->ID != '' && isset($data['pagelayout']) && $data['pagelayout']!=''){
            $type = sanitize_text_field ($data['pagelayout']);
        }
        return $type;
    }


    public static function HeaderStyle(){

        $style = '';
        if( is_page() || is_single() ) {
            $wpeden_post_meta = get_post_meta(get_the_ID(), 'wpeden_post_meta', true);
            $style = isset( $wpeden_post_meta['nav_header'] ) ? sanitize_text_field( $wpeden_post_meta['nav_header'] ) : '';
        }

        if(!isset($style) || $style == '')
            $style = sanitize_text_field ( self::NextGetOption('nav_header','header-1') );

        if(!locate_template("templates/headers/".$style.".php")) $style = 'header-1';
        load_template(locate_template("templates/headers/".$style.".php"));
        wp_reset_query();
    }

    public static function PageHeader(){
        $page_header_style = sanitize_text_field( self::NextGetOption('page_header_style', 'style2') );
        $data = get_post_meta(get_the_ID(), 'wpeden_post_meta', true);
        $page_specific_header = isset($data['page_header_style']) ? sanitize_text_field ($data['page_header_style']) : '';
        $page_header_style = $page_specific_header ? $page_specific_header : $page_header_style;

        get_template_part( 'page-headers/' . $page_header_style );
    }

}

new WPEdenThemeEngine();
 

