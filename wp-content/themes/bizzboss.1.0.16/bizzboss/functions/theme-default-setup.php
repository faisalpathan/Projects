<?php
/*
 * bizzboss theme default setup
 */
function bizzboss_widgets_init() {
    register_sidebar(array(
        'name' => __('Main Sidebar', 'bizzboss'),
        'id' => 'sidebar-1',
        'description' => __('Main sidebar that appears on the right.', 'bizzboss'),
        'before_widget' => '<aside id="%1$s" class="widget widget_recent_entries %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));
    register_sidebar(array(
        'name' => __('Footer Area One', 'bizzboss'),
        'id' => 'footer-1',
        'description' => __('Footer Area One that appears on footer.', 'bizzboss'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Area Two', 'bizzboss'),
        'id' => 'footer-2',
        'description' => __('Footer Area Two that appears on footer.', 'bizzboss'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Area Three', 'bizzboss'),
        'id' => 'footer-3',
        'description' => __('Footer Area Three that appears on footer.', 'bizzboss'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Area Four', 'bizzboss'),
        'id' => 'footer-4',
        'description' => __('Footer Area Four that appears on footer.', 'bizzboss'),
        'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'bizzboss_widgets_init');

/**
 * Set up post entry meta.    
 * Meta information for current post: categories, tags, permalink, author, and date.    
 * */
function bizzboss_entry_meta() {
	$bizzboss_categories_list = get_the_category_list(', ','');
	$bizzboss_tag_list = get_the_tag_list('', ', ' );
	$bizzboss_author= ucfirst(get_the_author());
	$bizzboss_author_url= esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
	$bizzboss_comments = wp_count_comments(get_the_ID()); 	
	$bizzboss_date = sprintf('<time datetime="%1$s">%2$s</time>', esc_attr(get_the_date(get_option('date_format'))), esc_html(get_the_date(get_option('date_format')))); ?>	
    <ul class="metaData">
       <li><?php printf( '%s', $bizzboss_date ); ?></li>
       <li><?php _e('By : ', 'bizzboss'); ?><a href="<?php echo esc_url($bizzboss_author_url); ?>" rel="tag"><?php echo $bizzboss_author; ?></a></li>
        <?php if (!is_page_template('page-template/front-page.php')) { ?>
       <li><?php if(!empty($bizzboss_categories_list)) { ?><?php _e('Category : ', 'bizzboss'); ?><?php echo $bizzboss_categories_list; ?></li><?php } ?>    <?php if(!empty($bizzboss_tag_list)) { ?>
    	<li><?php _e('Tags : ', 'bizzboss'); ?><?php echo $bizzboss_tag_list; ?></li><?php } ?>
        <?php } ?>
       <li><?php $bizzboss_comment = comments_number(__('Comment : 0', 'bizzboss'), __('Comment : 1', 'bizzboss'), __('Comments : %', 'bizzboss')); ?></li>
    </ul>
<?php }
/*
 * Comments placeholder function
 * 
 */
add_filter( 'comment_form_default_fields', 'bizzboss_comment_placeholders' );
function bizzboss_comment_placeholders( $fields ) {
	$fields['author'] = str_replace(
		'<input',
		'<input placeholder="' . _x( 'Name *', 'comment form placeholder', 'bizzboss' ) . '" required', $fields['author']
	);
	$fields['email'] = str_replace(
		'<input',
		'<input id="email" name="email" type="text" placeholder="' . _x( 'Email Id *', 'comment form placeholder', 'bizzboss') . '" required', $fields['email']
	);
	$fields['url'] = str_replace(
		'<input',
		'<input id="url" name="url" type="text" placeholder="' . _x( 'Website URL', 'comment form placeholder', 'bizzboss' ) . '" required', $fields['url']
	);
	return $fields;
}

add_filter( 'comment_form_defaults', 'bizzboss_textarea_insert' );
function bizzboss_textarea_insert( $fields ) {
	$fields['comment_field'] = str_replace(
		'<textarea',
		'<textarea id="comment" aria-required="true" rows="8" cols="45" name="comment" placeholder="'
		. _x(
		'Comment',
		'comment form placeholder',
		'bizzboss'
		)
	. '" ',
	$fields['comment_field']
	);
    return $fields;
} ?>