<?php

define('THENEXT_THEME_PREFIX', 'TheNext_');

class TheNext {

    function __construct(){
        $this->RegisterNavMenus();
        $this->Filters();
        $this->Actions();

        add_action( 'after_setup_theme', array($this, 'ThemeSetup') );
    }

    /**
     * Usage: Load language file
     */
    function LoadTextDoamin(){
        load_theme_textdomain('the-next', get_template_directory() . '/languages');
    }

    function Filters(){
        add_filter( 'style_loader_tag', array($this, 'EnqueueLessStyles'), 5, 2);
        add_filter('template_include',array($this, 'SearchResultTemplate'));
        //add_filter( 'wp_seo_get_bc_title', array($this, 'BreadcrumbTitle'), 10, 2 );
    }

    function Actions(){
        if ( ! function_exists( '_wp_render_title_tag' ) )
            add_action( 'wp_head', array($this, 'TitleTag') );
        add_action( 'wp_enqueue_scripts', array($this, 'EnqueueScripts') );
        add_action( 'wp_head', array($this, 'WPHead') );
        add_action( 'wp', array($this, 'SignIn') );
    }

    function WPHead(){
        $this->LessVars();
    }

    /**
     * @usage Load all necessary scripts & styles
     */
    function EnqueueScripts(){
        
        $family[] = "Montserrat:400,700";
        $family[] = "Open+Sans:300,400,700,900";
        $family[] = "Quicksand:300,400,700";

        // Font Options ( From Customizer Typography Options )
        $family[] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('heading_font') );
        $family[] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('body_font') );
        $family[] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('widget_title_font') );
        $family[] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('widget_content_font') );
        $family[] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('menu_top_font') );
        $family[] = sanitize_text_field( WPEdenThemeEngine::NextGetOption('menu_dropdown_font') );

        $family = array_unique($family);
        $cssimport = "//fonts.googleapis.com/css?family=".implode("|",$family);
        $cssimport = str_replace('||','|',$cssimport);

        wp_enqueue_style('bootstrap',get_template_directory_uri().'/bootstrap/css/bootstrap.css');
        wp_enqueue_style('thenext-main',get_stylesheet_uri());
        wp_enqueue_style('thenext-button-default',get_template_directory_uri().'/css/buttons/default.css');
        wp_enqueue_style('thenext-button-flat',get_template_directory_uri().'/css/buttons/flat.css');
        wp_enqueue_style('thenext-responsive',get_template_directory_uri().'/css/responsive.css');
        wp_enqueue_style('thenext-less',get_template_directory_uri().'/css/style.less');
        wp_enqueue_style('animate',get_template_directory_uri().'/css/animate.min.css');
	    wp_enqueue_style('font-awesome',get_template_directory_uri().'/fonts/font-awesome-4.3.0/css/font-awesome.min.css');
	    wp_enqueue_style('font-tn',get_template_directory_uri().'/fonts/icons/icons.css');
        
        wp_enqueue_style('google-fonts',$cssimport);

	    wp_enqueue_script('thenext-less',get_template_directory_uri().'/js/less.js',array('jquery'));
        wp_enqueue_script('bootstrap',get_template_directory_uri().'/bootstrap/js/bootstrap.min.js',array('jquery'));
        wp_enqueue_script('wow',get_template_directory_uri().'/js/wow.min.js',array('jquery'));
        wp_enqueue_script('sticky',get_template_directory_uri().'/js/jquery.sticky.js',array('jquery'));
        wp_enqueue_script('thenext-site',get_template_directory_uri().'/js/site.js',array('jquery'));

	    wp_enqueue_script( 'comment-reply' );
    }


    function EnqueueLessStyles($tag, $handle) {
        global $wp_styles;
        $match_pattern = '/\.less$/U';
        if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
            $handle = $wp_styles->registered[$handle]->handle;
            $media = $wp_styles->registered[$handle]->args;
            $href = $wp_styles->registered[$handle]->src . '?ver=' . $wp_styles->registered[$handle]->ver;
            $rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
            $title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';

            $tag = "<link rel='stylesheet' id='$handle' $title href='$href' type='text/less' media='$media' />";
        }
        return $tag;
    }

    function sanitize_hex_color_front( $color ) {
        if ( '' === $color )
            return '';

        // 3 or 6 hex digits, or the empty string.
        if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
            return $color;
    }

    function LessVars(){
        ?>
            <script type="text/javascript">
                less.modifyVars({
                    '@color': '<?php echo $this->sanitize_hex_color_front( WPEdenThemeEngine::NextGetOption('color_scheme','#2C3E50') ); ?>',
                    '@acolor': '<?php echo $this->sanitize_hex_color_front( WPEdenThemeEngine::NextGetOption('a_color','#2C3E50') ); ?>',
                    '@ahcolor': '<?php echo $this->sanitize_hex_color_front( WPEdenThemeEngine::NextGetOption('ah_color','#2C3E50') ); ?>',
                    '@nvhcolor': '<?php echo $this->sanitize_hex_color_front( WPEdenThemeEngine::NextGetOption('menuh_color','#3399ff') ); ?>',
                    '@rgbcolor': '<?php echo Util::HEX2RGB( $this->sanitize_hex_color_front( WPEdenThemeEngine::NextGetOption('color_scheme','#3399ff')) ) ; ?>'
                });
            </script>
        <?php
    }

    /**
     * @usage: Register nav menus
     */
    function RegisterNavMenus(){
        register_nav_menus( array(
            'primary' => 'Top Menu'

        ) );
    }


    /**
     * @usage Select custom template for search result page
     * @param $template
     * @return string
     */
    function SearchResultTemplate($template){
        global $wp_query;
        $post_type = get_query_var('post_type');
        if( $wp_query->is_search && file_exists(dirname(__FILE__).'/search-'.$post_type[0].'.php'))
        {
            return locate_template('search-'.$post_type[0].'.php');  //  redirect to archive-search.php
        }

        return $template;
    }

    /**
     * @usage Post Comments
     * @param $comment
     * @param $args
     * @param $depth
     */
    public static function Comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        $GLOBALS['comment'] = $comment;

        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li class="post pingback">
                <p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( 'Edit', '<span class="edit-link">', '</span>' ); ?></p>
                <?php
                break;
            default :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
                    <div class="panel panel-default">

                        <div id="comment-<?php comment_ID(); ?>" class="clearfix media panel-body">
                            <div class="author-box pull-left">
                                <?php echo get_avatar($comment,100); ?>

                            </div> <!-- end .avatar-box -->
                            <div class="comment-wrap clearfix media-body">
                                <b><?php printf('<span class="fn">%s</span>', get_comment_author_link()) ?></b>

                                <div class="comment-content"><?php comment_text() ?></div> <!-- end comment-content-->

                            </div> <!-- end comment-wrap-->
                            <div class="comment-arrow"></div>
                        </div> <!-- end comment-body-->
                        <div class="panel-footer">
                            <?php if ($comment->comment_approved == '0') : ?>
                                <em class="moderation">Your comment is awaiting moderation.</em>

                            <?php endif; ?>
                            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf(  '<i class="fa fa-time"></i> %1$s at %2$s', get_comment_date(),  get_comment_time() ); ?></a>
                            <?php edit_comment_link( '<i class="fa fa-pencil"></i> Edit', ' ' ); ?>
                            <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="fa fa-reply"></i> Reply','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        </div>
                    </div> <!-- end comment-body-->


                <?php
                break;
        endswitch;
    }

    function SignIn(){
        if(isset($_POST['tns'])){
            $user = wp_signon( $_POST['tns'] );
            if ( is_wp_error($user) )
                echo sanitize_text_field( $user->get_error_message() );
            else echo 1;
            die();
        }
    }

    function BreadcrumbTitle($title, $id){
        return '';
    }

    function TitleTag() {
        ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
        <?php
    }

    /**
     * usage: Setup Theme
     */
    function ThemeSetup(){
        $this->LoadTextDoamin();

        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('post-formats', array( 'aside','image','chat', 'gallery','audio','video','quote','link' ) );
        add_theme_support('automatic-feed-links');
        add_theme_support('excerpt', array('post','page'));
        add_theme_support('custom-background');
    }
} 