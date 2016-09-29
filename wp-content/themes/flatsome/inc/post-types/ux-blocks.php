<?php
/* Registrer post menu */
register_post_type('blocks',
  array(
                    'labels' => array(
                        'add_new_item' => __('Add block', "blocks"),
                        'name' => __('Blocks', "blocks"),
                        'singular_name' => __('Block', "blocks"),
                        'edit_item' => __('Edit Block', "blocks"),
                        'view_item' => __('View Block', "blocks"),
                        'search_items' => __('Search Blocks', "blocks"),
                        'not_found' => __('No Blocks found', "blocks"),
                        'not_found_in_trash' => __('No Blocks found in Trash', "blocks"),
                    ),
                    'public' => true,
                    'has_archive' => true,
                    'show_in_menu' => true,
                    'supports' => array('thumbnail','editor','title','revisions','custom-fields'),
                    'show_in_nav_menus' => true,
                    'exclude_from_search' => true,
                    'rewrite' => array('slug' => ''),
                    'exclude_from_search' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'query_var' => true,
                    'capability_type' => 'page',
                    'hierarchical' => true,
                    'menu_position' => null,
                    'menu_icon' => 'dashicons-tagcloud',
  )
);


add_filter( 'manage_edit-blocks_columns', 'my_edit_blocks_columns' ) ;

function my_edit_blocks_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',

		'title' => __( 'Title' , 'blocks'),
         'quick_preview' => __( 'Preview' , 'blocks'),

		'shortcode' => __( 'Shortcode' , 'blocks'),
   
		'date' => __( 'Date' , 'blocks'),
	);

	return $columns;
}


add_action( 'manage_blocks_posts_custom_column', 'my_manage_blocks_columns', 10, 2 );
function my_manage_blocks_columns( $column, $post_id ) {
	global $post;
	 $post_data = get_post($post_id, ARRAY_A);
	 $slug = $post_data['post_name'];
   add_thickbox();
	switch( $column ) {
		case 'shortcode' :
			echo '<textarea style="min-width:100%; max-height:30px; background:#eee;">[block id="'.$slug.'"]</textarea>';
		break;
    case 'quick_preview' :
      echo '<a title="'.get_the_title().'" href="'.get_the_permalink().'?preview&TB_iframe=true&width=1100&height=600" rel="logos1" class="thickbox button">+ Quick Preview</a>';
    break;
	}
}

// UPDATE BLOCK PREVIEW URL
function ux_block_scripts() {
	global $typenow;
    if( 'blocks' == $typenow && isset($_GET["post"])){
    ?>
    <script>
    	jQuery( document ).ready(function($) {
        if (window.frameElement) {
          $('html').addClass('blocks-iframe');
        }
		var preview_url = $('input[value="preview_url"]').parent().parent().find('textarea').val();
		var preview_title = $('input[value="preview_title"]').parent().parent().find('textarea').val();
        var block_id = $('input#post_name').val();
        $('#submitdiv').after('<div class="postbox"><div class="inside"><p><b>Shortcode:</b><br><textarea style="width:100%; max-height:30px;">[block id="'+block_id+'"]</textarea></p></div></div>');
    		if(preview_url){
	    		$('#view-post-btn a').attr('href',preview_url+'?block=block-'+block_id);
	    		$('#view-post-btn a').html('View block in <b>'+preview_title+'</b>');
	    		$('#edit-slug-box a[href="#"]').remove();
    		}
		});
    </script>
    <?php
    }
    if (isset($_GET["preview_url"])) { 
  	$permalink = get_the_permalink($_GET["preview_url"]);
  	$preview_title = get_the_title($_GET["preview_url"]);
 		add_post_meta( $_GET["post"], 'preview_url', $permalink , true ) || update_post_meta( $_GET["post"], 'preview_url', $permalink );
 		add_post_meta( $_GET["post"], 'preview_title', $preview_title , true ) || update_post_meta( $_GET["post"], 'preview_title', $preview_title );
    }
    
}
add_action( 'admin_head', 'ux_block_scripts' );

function ux_block_frontend() {
	if(isset($_GET["block"])){
    ?>
    <script>
    	jQuery( document ).ready(function($) {
    		 $.scrollTo('#<?php echo $_GET["block"];?>',300,{offset:-200});
    	});
    </script>
    <?php
    }
}
add_action( 'wp_footer', 'ux_block_frontend');


function block_shortcode($atts, $content = null) {  
     extract( shortcode_atts( array(
        'id' => ''
     ), $atts ) );


    // get Page ID by slug
    global $wpdb,$post;
    $post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$id'");


    // Polylang support
    if(function_exists('pll_get_post') && pll_get_post($post_id)){
        $lang_id = pll_get_post($post_id);
        if($lang_id) $post_id = $lang_id;
    }

    // WPML Support
    if(function_exists('icl_object_id')){
         $lang_id = icl_object_id($post_id, 'blocks', false, ICL_LANGUAGE_CODE);
         if($lang_id) $post_id = $lang_id;
    }


    $permalink =  get_permalink($post_id);
  
        if($post_id){

        $html = apply_filters( 'the_content', get_post_field( 'post_content', $post_id), $atts );
        
        // add edit link for admins
        if (current_user_can('edit_pages')) {
           $edit_link = get_edit_post_link( $post_id ); 
           $html = '<div id="block-'.$id.'" class="ux_block"><a class="edit-link" href="'.$edit_link.'&preview_url='.$post->ID.'">Edit Block</a>'.$html.'</div>';
        }

        $html = do_shortcode( $html );

        } else{
            
            $html = '<p><mark>Block <b>"'.$id.'"</b> not found!</mark></p>';   
        
        }
    return $html;
}
add_shortcode('block', 'block_shortcode');


/* ADD CATEGOIRES SUPPORT */
if ( ! function_exists( 'blocks_categories' ) ) {

// Register Custom Taxonomy
function blocks_categories() {
  $args = array(
    'hierarchical'               => true,
    'public'                     => false,
    'show_ui'                    => true,
    'show_in_nav_menus'          => true,
  );
  register_taxonomy( 'block_categories', array( 'blocks' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'blocks_categories', 0 );
}