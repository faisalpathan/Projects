<?php

/* Add Custom Meta Box to Category Pages */
if(function_exists('get_term_meta')){
function top_text_taxonomy_edit_meta_field($term) {
	// put the term ID into a variable
	$t_id = $term->term_id;
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_term_meta($t_id,'cat_meta');
	if(!$term_meta){$term_meta = add_term_meta($t_id, 'cat_meta', '');}
	 ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[cat_header]"><?php _e( 'Top Content', 'flatsome' ); ?></label></th>
		<td>				
			<?php 
				$content = esc_attr( $term_meta[0]['cat_header'] ) ? esc_attr( $term_meta[0]['cat_header'] ) : ''; 
				echo '<textarea id="term_meta[cat_header]" name="term_meta[cat_header]">'.$content.'</textarea>'; ?>
			<p class="description"><?php _e( 'Enter a value for this field. Shortcodes are allowed. This will be displayed at top of the category.','flatsome' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'product_cat_edit_form_fields', 'top_text_taxonomy_edit_meta_field', 10, 2 );

/* ADD CUSTOM META BOX TO CATEGORY PAGES */
function bottom_text_taxonomy_edit_meta_field($term) {
  // put the term ID into a variable
  $t_id = $term->term_id;
  // retrieve the existing value(s) for this meta field. This returns an array
  $term_meta = get_term_meta($t_id,'cat_meta');
  if(!$term_meta){$term_meta = add_term_meta($t_id, 'cat_meta', '');}
   ?>
  <tr class="form-field">
  <th scope="row" valign="top"><label for="term_meta[cat_footer]"><?php _e( 'Bottom Content', 'flatsome' ); ?></label></th>
    <td>        
        <?php 
        $content = isset($term_meta[0]['cat_footer']) ? esc_attr( $term_meta[0]['cat_footer'] ) : '';
        echo '<textarea id="term_meta[cat_footer]" name="term_meta[cat_footer]">'.$content.'</textarea>'; ?>
      <p class="description"><?php _e( 'Enter a value for this field. Shortcodes are allowed. This will be displayed at bottom of the category.','flatsome' ); ?></p>
    </td>
  </tr>
<?php
}
add_action( 'product_cat_edit_form_fields', 'bottom_text_taxonomy_edit_meta_field', 10, 2 );


/* SAVE CUSTOM META*/
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_term_meta($term_id, 'cat_meta', $term_meta);
	}
}  
add_action( 'edited_product_cat', 'save_taxonomy_custom_meta', 10, 2 );
}