<?php
/**
 * @package nav-menu-icon-fields
 * @version 0.1.0
 */
/*
Plugin Name: Nav Menu Custom Fields
*/

/*
 * Saves new field to postmeta for navigation
 */
add_action('wp_update_nav_menu_item', 'icon_nav_update',10, 3);
function icon_nav_update($menu_id, $menu_item_db_id, $args ) {
    if (isset($_REQUEST['menu-item-icon']) && is_array($_REQUEST['menu-item-icon']) ) {
        if(isset($_REQUEST['menu-item-icon'][$menu_item_db_id]))
            $icon_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
        else 
            $icon_value = '';
        update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
    }
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_icon
 */
add_filter( 'wp_setup_nav_menu_item','icon_nav_item' );
function icon_nav_item($menu_item) {
    $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
    return $menu_item;
}

add_filter( 'wp_edit_nav_menu_walker', 'icon_nav_edit_walker',10,2 );
function icon_nav_edit_walker($walker,$menu_id) {
    return 'Walker_Nav_Menu_Edit_icon';
}

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_icon extends Walker_Nav_Menu  {
    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl(&$output, $depth = 0, $args = array() ) {}

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl(&$output, $depth = 0, $args = array() ) {
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        ob_start();
        $item_id = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = '';
        if ( 'taxonomy' == $item->type ) {
            $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
            if ( is_wp_error( $original_title ) )
                $original_title = false;
        } elseif ( 'post_type' == $item->type ) {
            $original_object = get_post( $item->object_id );
            $original_title = $original_object->post_title;
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf( __( '%s (Invalid)' , 'the-next'), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf( __('%s (Pending)', 'the-next'), $item->title );
        }

        $title = empty( $item->label ) ? $title : $item->label;

        ?>
    <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html( $title ); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                        echo wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'move-up-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                            ),
                            'move-menu_item'
                        );
                        ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'the-next'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                        echo wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'move-down-menu-item',
                                    'menu-item' => $item_id,
                                ),
                                remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                            ),
                            'move-menu_item'
                        );
                        ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'the-next'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item', 'the-next'); ?>" href="<?php
                    echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                    ?>"><?php _e( 'Edit Menu Item' , 'the-next'); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
            <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                        <?php _e( 'URL' , 'the-next'); ?><br />
                        <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    <?php _e( 'Navigation Label' , 'the-next'); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                    <?php _e( 'Title Attribute', 'the-next' ); ?><br />
                    <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                    <?php _e( 'Open link in a new window/tab', 'the-next' ); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                    <?php _e( 'CSS Classes (optional)' , 'the-next'); ?><br />
                    <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                    <?php _e( 'Link Relationship (XFN)', 'the-next' ); ?><br />
                    <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                    <?php _e( 'Description' , 'the-next'); ?><br />
                    <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                    <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'the-next'); ?></span>
                </label>
            </p>

            <p class="field-icon description description-wide">
                <label for="edit-menu-item-icon-<?php echo $item_id; ?>">
                    <?php _e( 'Menu Icon' , 'the-next'); ?><br />
                    <!-- select id="edit-menu-item-icon-<?php echo $item_id; ?>" class="widefat code edit-menu-item-icon" name="menu-item-icon[<?php echo $item_id; ?>]" >
                        <option value="">No Icon</option>
                    <?php
                    $icons = wpeden_all_icons();
                    $data = maybe_unserialize(get_post_meta($post->ID,'wpeden_post_meta', true));
                    if(is_array($data))
                        $icon = $data['icon'];
                    
                    if(empty($icon)) $icon = '';
                    ?>
                    <?php //foreach($icons  as $class => $name){ echo "<option value='{$class}' ".selected($class, $item->icon).">{$name}</option>"; } ?>
                    </select -->

                </label>
            <div class="w3eden" style="height: 200px;padding: 15px;border: 1px solid #ddd;display: block;clear: both;margin-right: 12px">
                <div style="height: 200px;overflow: auto;">
                    <div style="clear: both"></div>
                    <?php
                    $ticon = $item->icon; if(strpos("_".$item->icon, 'fa')) $ticon = 'fa '.$item->icon;
                    echo "<label class='xdicon' title='No Icon'><input style='display:none;' type=radio name=\"menu-item-icon[". $item_id."]\"  value='' ><i class='fa fa-delete' style='color: transparent !important'></i></label>";
                    if($item->icon!='')
                        echo "<label class='xdicon active' title='{$item->icon}'><input style='display:none;' type=radio name=\"menu-item-icon[". $item_id."]\"  value='{$item->icon}' checked=checked ><i class='{$ticon}'></i></label>";
                    foreach($icons  as $class => $name){
                        $tclass = $class; 
                        if(!strpos("_".$class, 'fa')) { 
                            if($icon != $class)
                                echo "<label class='xdicon' title='{$name}'><i class='$tclass'></i><input type='radio' name=\"menu-item-icon[". $item_id."]\" style='display:none' value='{$class}' ".checked($class, $icon, false)." title='{$name}' /></label>";
                            }                    
                    } ?>
                    <div style="clear: both"></div></div></div>
            </p>
            <?php
            /*
             * end added field
             */
            ?>
            <div class="menu-item-actions description-wide submitbox">
                <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                    <p class="link-to-original">
                        <?php printf( __('Original: %s', 'the-next'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                echo wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                        ),
                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                    ),
                    'delete-menu_item_' . $item_id
                ); ?>"><?php _e('Remove', 'the-next'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
                ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel', 'the-next'); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }
}

function thenext_menupage_css($hook){
    global $pagenow;
    if($pagenow!='nav-menus.php') return;
    ?>
    <link href="<?php echo get_template_directory_uri().'/fonts/icons/icons.css'; ?>" rel="stylesheet" type="text/css" />

    <style type="text/css">
        #TB_window{
            z-index:99999999;
        }

        label.xdicon{
            float: left;
            width: 16px !important;
            height: 16px;
            text-align: center;
            line-height: 16px;
            font-size: 14px;
            padding:5px 7px;
            display: inline-table;
            border: 1px solid #dddddd;
            border-radius: 2px;
            transition: all 0.3s ease-in-out;
            margin: 3px;
        }
        label.xdicon i{
            width: 16px !important;
        }
        .xdicon:hover{
            border: 1px solid #1E8CBE;
            transition: all 0.3s ease-in-out;
        }
        .xdicon.active{
            border: 1px solid #1E8CBE;
            background: #1E8CBE;
            color: #ffffff;
            transition: all 0.3s ease-in-out;
        }

        .w3eden .tooltip {
            position: absolute;
            z-index: 1030;
            display: block;
            visibility: visible;
            font-size: 12px;
            line-height: 1.4;
            opacity: 0;
            filter: alpha(opacity=0);
        }
        .w3eden .tooltip.in {
            opacity: .9;
            filter: alpha(opacity=90);
        }
        .w3eden .tooltip.top {
            margin-top: -3px;
            padding: 5px 0;
        }
        .w3eden .tooltip.right {
            margin-left: 3px;
            padding: 0 5px;
        }
        .w3eden .tooltip.bottom {
            margin-top: 3px;
            padding: 5px 0;
        }
        .w3eden .tooltip.left {
            margin-left: -3px;
            padding: 0 5px;
        }
        .w3eden .tooltip-inner {
            max-width: 200px;
            padding: 3px 8px;
            color: #fff;
            text-align: center;
            text-decoration: none;
            background-color: #000;
            border-radius: 2px;
            font-size: 8pt;
        }
        .w3eden .tooltip-arrow {
            position: absolute;
            width: 0;
            height: 0;
            border-color: transparent;
            border-style: solid;
        }
        .w3eden .tooltip.top .tooltip-arrow {
            bottom: 0;
            left: 50%;
            margin-left: -5px;
            border-width: 5px 5px 0;
            border-top-color: #000000;
        }
        .w3eden .tooltip.top-left .tooltip-arrow {
            bottom: 0;
            left: 5px;
            border-width: 5px 5px 0;
            border-top-color: #000000;
        }
        .w3eden .tooltip.top-right .tooltip-arrow {
            bottom: 0;
            right: 5px;
            border-width: 5px 5px 0;
            border-top-color: #000000;
        }
        .w3eden .tooltip.right .tooltip-arrow {
            top: 50%;
            left: 0;
            margin-top: -5px;
            border-width: 5px 5px 5px 0;
            border-right-color: #000000;
        }
        .w3eden .tooltip.left .tooltip-arrow {
            top: 50%;
            right: 0;
            margin-top: -5px;
            border-width: 5px 0 5px 5px;
            border-left-color: #000000;
        }
        .w3eden .tooltip.bottom .tooltip-arrow {
            top: 0;
            left: 50%;
            margin-left: -5px;
            border-width: 0 5px 5px;
            border-bottom-color: #000000;
        }
        .w3eden .tooltip.bottom-left .tooltip-arrow {
            top: 0;
            left: 5px;
            border-width: 0 5px 5px;
            border-bottom-color: #000000;
        }
        .w3eden .tooltip.bottom-right .tooltip-arrow {
            top: 0;
            right: 5px;
            border-width: 0 5px 5px;
            border-bottom-color: #000000;
        }
    </style>
    <script>
        jQuery(function($){
            $('.xdicon').click(function(){
                $('.xdicon').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>

<?php
}

add_action('admin_head','thenext_menupage_css');

?>