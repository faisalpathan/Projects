<?php

// Add editor button top top of page
function flatsome_builder_top(){
  ?>
    <h2 id="uxbuilder-enable-disable" class="nav-tab-wrapper woo-nav-tab-wrapper">
      <a id="enable-uxbuilder" href="#" class="nav-tab"><strong style="color:#627f9a; padding: 0px 5px; margin-right:5px; border: 2px solid #627f9a;">F</strong> Page Builder</a>
      <a id="disable-uxbuilder" href="#" class="nav-tab ">Editor</a>
    </h2>
  <?php
}


// Flatsome Builder Metaboxes
function ux_drag_drop_box() {

  $current_screen = get_current_screen()->id;
  $screens = array('page','blocks','product','featured_item','post');

  foreach ( $screens as $screen ) {
    // add content to top
    if($current_screen == $screen){
       add_action('edit_form_top','flatsome_builder_top');
    }

    add_meta_box(
      'ux_drag_and_drop',
      __( 'Page Builder', 'flatsome' ),
      'ux_drag_and_drop_box',
      $screen, 'normal', 'high'
    );
  }  
}
add_action( 'add_meta_boxes', 'ux_drag_drop_box' );



// Build layout
function ux_drag_and_drop_box( $post ) { 
    // load scripts
    wp_enqueue_script('ux_builder_app', get_template_directory_uri().'/inc/extensions/ux-builder/app.js?v=2.2', array('wp-color-picker' ), false, true );
    wp_enqueue_script('ux_builder_editable', get_template_directory_uri().'/inc/extensions/ux-builder/editable.js?v=2.2');

    wp_enqueue_style('ux_builder_style',get_template_directory_uri().'/inc/extensions/ux-builder/builder_style.css?v=2.2');
    wp_enqueue_style('wp-color-picker');

  ?>
  <style>#ux_drag_and_drop, #postdivrich{display: none!important;}</style>
  <div id="drag-and-drop">
   
  <div class="ux-add-elements-wrap" data-id="root">
          <div class="ux-g-add top"></div>
  </div>

    <!-- MAIN CONTENT -->
        <div id="main-sort" class="drag-drop-content ux-g-group" data-group="root"></div><!-- .drag-drop-content -->
    <!-- END MAIN CONTENT -->

  <div class="ux-add-elements-wrap" data-id="root">
          <div class="ux-g-add bottom"></div>
  </div>
  </div><!-- #drag-and-drop -->

  <p class="ux-builder-footer small">We're working on a better Page Builder for Flatome. Versiom 3.0 of Flatsome will have a brand new page builder that's much easier to use. Got any questions? <a href="mailto:support@uxthemes.com?subject=[BUILDER] < Please keep [builder] in subject...">support@uxthemes.com</a></p>

  <!-- Include shortcodes adder -->
  <?php include_once('shortcodes_insert.php'); ?>

  <!-- Shortcode Editor -->
  <div  data-edit="shortcode" class="ux-lightbox">
    <div class="ux-lightbox-inner">

      <div class="edit-shortcode-container"></div>
      <div class="ux-current-shortcode">
        <textarea id="new_shortcode"></textarea>
      </div>

      <div class="lightbox-tools bottom">
          <a href="#" class="close-lightbox button media-button button-secondary button-large">Cancel</a>
          <a href="#" class="save close-lightbox button media-button button-primary button-large">Save</a>
      </div>
    </div>
  </div>

  <!-- text editor -->
  <div data-edit="text" class="ux-lightbox">
      <div class="ux-lightbox-inner">

        <?php 
          $content = '';
          $editor_id = 'ux_edit_content';
          $settings = array('wpautop' => 'false');
          wp_editor( $content, $editor_id, $settings );
        ?>

        <div class="lightbox-tools bottom">
        <a href="#" class="close-lightbox button media-button button-secondary button-large">Cancel</a>
        <a href="#" class="save close-lightbox button media-button button-primary button-large">Save</a>
      </div>
    </div>
  </div>


  
  
  <!-- New content fixer temp-->
  <div id="new-content" style="display:none;"></div>
  
  <!-- Quick preview content-->
  <div id="quick-preview"></div>
  
  
<?php
} 

// tempoary text shortcode
function add_ux_text_shortcode(){}
add_shortcode('text', 'add_ux_text_shortcode');

// Get shortcode editor ajax
add_action('wp_ajax_get_shortcode_editor', 'get_shortcode_editor');

function get_shortcode_editor(){
    $shortcode_id =  $_POST["shortcode"];
      include_once('shortcodes_editor.php');
    die;
}

// get content ajax
add_action('wp_ajax_ux_get_content_shortcodes', 'ux_get_content_shortcodes');

/** Get Shortcodes **/
function ux_get_content_shortcodes() {

      if(!isset($_POST["content"])) die;
      
      $new_content =  stripslashes($_POST["content"]);

      // wrap [text] around texts
      $new_content = preg_replace('/(\[text\])/',"", $new_content);
      $new_content = preg_replace('/(\[\/text\])/',"", $new_content);
      $new_content = preg_replace('/(\[[^\]]*\])/',"[/text]$1[text]", $new_content);
      $new_content = '[text]'.$new_content.'[/text]';
      $new_content = preg_replace('/(\[text\])(^\s+|\s+)(\[\/text\])/',"", $new_content);
      $new_content = preg_replace('/(\[text\])(\[\/text\])/',"", $new_content);

      $new_content = preg_replace('/\[background/',"[section", $new_content);
      $new_content = preg_replace('/\[\/background\]/',"[/section]", $new_content);

      // remove spaces inside shortcodes
      $new_content = preg_replace('/\s+(?=[^[\]]*\])/'," ", $new_content);

  
      // shortcode tools
      $tools = '<div class="ux-g-tools"><a data-action="edit" href="#" title="Edit">Edit</a><a data-action="duplicate" href="#" title="Duplicate">Duplicate</a><a data-action="delete" href="#" title="Delete">Delete</a></div>';
      
      // build content
      global $shortcode_tags;
      $tagnames = array_keys($shortcode_tags);
      
      // create elements
      foreach($tagnames as $name){
        preg_match('/\[(\[?)('.$name.')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*(?:\[(?!\/\2\])[^\[]*)*)(\[\/\2\]))?)(\]?)/', $new_content, $matches);
        if(isset($matches[6]) && $matches[6] && $matches[6] != '[/text]'){
            // shortcodes with ending
            $new_content = preg_replace('/\[(\[?)('.$name.')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*(?:\[(?!\/\2\])[^\[]*)*)(\[\/\2\]))?)(\]?)/', '<div class="ux-g  ux-g-'.$name.'" data-id="'.$name.'"><s>[${2} <em class="ux-edit">${3}</em>]</s><div class="ux-g-group" data-group="'.$name.'"><div class="drop-zone ux-g">Drop Zone</div>${5}</div> '.$tools.'<div class="ux-g-add"></div><s>${6}</s></div>', $new_content);
         } else if($name == 'embed' || $name == 'wp_caption' || $name == 'caption' || $name == 'gallery' || $name == 'playlist' || $name == 'audio' || $name == 'video'){
            // shortcodes as text
            $new_content = preg_replace('/\[(\[?)('.$name.')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*(?:\[(?!\/\2\])[^\[]*)*)(\[\/\2\]))?)(\]?)/', '<div class="ux-g ux-g-text" data-id="text"><div class="ux-g-text-inner">${0}</div>'.$tools.'</div>', $new_content);
        } else if(isset($matches[6]) && $matches[6] == '[/text]'){
            // text shortcodes
            $new_content = preg_replace('/\[(\[?)('.$name.')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*(?:\[(?!\/\2\])[^\[]*)*)(\[\/\2\]))?)(\]?)/', '<div class="ux-g ux-g-text" data-id="text"><div class="ux-g-text-inner">${5}</div>'.$tools.'</div>', $new_content);
        } else {
            // shortcodes with no ending
            $new_content = preg_replace('/\[(\[?)('.$name.')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*(?:\[(?!\/\2\])[^\[]*)*)(\[\/\2\]))?)(\]?)/', '<div class="ux-g ux-g-small ux-g-'.$name.'" data-id="'.$name.'"><s>[${2} <em class="ux-edit">${3}</em>]</s>'.$tools.'</div>', $new_content);
        }
      }
      

      echo $new_content;
      die;
} // End ajax content