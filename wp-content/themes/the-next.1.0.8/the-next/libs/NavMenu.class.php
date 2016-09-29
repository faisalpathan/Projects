<?php

class TheNextNavMenu extends Walker_Nav_Menu {
    
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"dropdown-menu\" role='menu' aria-labelledby=\"dLabel\">\n";
    }

     
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        
        if(!is_object($args)&&is_array($args)){
            $tmpobj = new stdClass();
            foreach($args as $k=>$v) { $tmpobj->{$k} = $v; }
            $args = $tmpobj;
        }
        if(!is_object($item))  return;
        if($item->title=='')  return;
        $li_attributes = '';
        $class_names = $value = '';

        $menu_icon = $item->icon;
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = ($args->has_children&&$depth==0)||$item->object=='megamenu' ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;


        $meta = get_post_meta($item->object_id,'wpeden_post_meta',true);
         
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        if($args->has_children&&$depth>0) $class_names .= " dropdown-submenu";
        if(isset($meta['fullwidth']) && $meta['fullwidth']==1) $class_names .= ' static';
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

         
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        
        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

         
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
        $attributes .= ($args->has_children&&$depth==0)||$item->object=='megamenu' ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';


        $item_output = $args->before;

        if(strpos("__{$menu_icon}", "tn"))
            $menu_icon = $menu_icon?'<i class="'.$menu_icon.'"></i>':'';
        else
            $menu_icon = $menu_icon?'<i class="fa '.$menu_icon.'"></i>':'';
        $item_output .= '<a'. $attributes .'>'.$menu_icon.'&nbsp; ';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        if($item->object=='megamenu'){
            $item_output .= ' &nbsp;<i class="tn-menu"></i></a>';

            if($meta['fullwidth']==1)
            $item_output .="<div class='dropdown-menu megamenu' style='width:100%' role='menu'>".TheNextMegaMenu::Show($item->object_id)."</div>";
            else
            $item_output .="<div class='dropdown-menu megamenu' style='width:{$meta['menuwidth']}px' role='menu'>".TheNextMegaMenu::Show($item->object_id)."</div>";
            wp_reset_query();
        } else
        $item_output .= ($args->has_children&&$depth==0) ? ' &nbsp;<i class="tn-menu"></i></a>' : '</a>';

        $item_output .= $args->after;

         
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

     
    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

     
    if ( !$element || !is_object($element))
    return;

     
    $id_field = $this->db_fields['id'];


    //display this element
    if ( is_array( $args[0] ) ) 
    $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
    else if ( is_object( $args[0] ) ) 
    $args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
    $cb_args = array_merge( array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'start_el'), $cb_args);

     
    $id = $element->$id_field;

     
    // descend only when the depth is right and there are childrens for this element
    if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

     
    foreach( $children_elements[ $id ] as $child ){

     
    if ( !isset($newlevel) ) {
    $newlevel = true;
    //start the child delimiter
    $cb_args = array_merge( array(&$output, $depth), $args);
    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
    }
    $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
    }
    unset( $children_elements[ $id ] );
    }

     
    if ( isset($newlevel) && $newlevel ){
    //end the child delimiter
    $cb_args = array_merge( array(&$output, $depth), $args);
    call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
    }

     
    //end this element
    $cb_args = array_merge( array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'end_el'), $cb_args);

     
    }
     

    }



class TheNextVerticalNavMenu extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"dropdown-menu-vertical\" role='menu' aria-labelledby=\"dLabel\">\n";
    }


    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        if(!is_object($args)&&is_array($args)){
            $tmpobj = new stdClass();
            foreach($args as $k=>$v) { $tmpobj->{$k} = $v; }
            $args = $tmpobj;
        }
        if(!is_object($item))  return;
        if($item->title=='')  return;
        $li_attributes = '';
        $class_names = $value = '';

        $menu_icon = $item->icon;
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = ($args->has_children&&$depth==0)||$item->object=='megamenu' ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
        $classes[] = 'menu-item-' . $item->ID;


        $meta = get_post_meta($item->object_id,'wpeden_post_meta',true);

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        if($args->has_children&&$depth>0) $class_names .= " dropdown-submenu-vertical";
        if(isset($meta['fullwidth']) && $meta['fullwidth']==1) $class_names .= ' static';
        $class_names = ' class="' . esc_attr( $class_names ) . '"';


        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';


        $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';


        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
        $attributes .= ($args->has_children&&$depth==0)||$item->object=='megamenu' ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
        //$attributes .= ($args->has_children&&$depth==0) ? ' class="dropdown-toggle-vertical" data-toggle="dropdown"' : '';


        $item_output = $args->before;

        if(strpos("__{$menu_icon}", "tn"))
            $menu_icon = $menu_icon?'<i class="'.$menu_icon.'"></i>':'';
        else
            $menu_icon = $menu_icon?'<i class="fa '.$menu_icon.'"></i>':'';
        $item_output .= '<a'. $attributes .'>'.$menu_icon.'&nbsp; ';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        if($item->object=='megamenu'){
            $item_output .= ' &nbsp;</a><a href="#" class="pull-right dd-cont"><i class="tn-plus"></i></a>';

            if($meta['fullwidth']==1)
                $item_output .="<div class='dropdown-menu-vertical megamenu' style='width:100%' role='menu'>".TheNextMegaMenu::Show($item->object_id)."</div>";
            else
                $item_output .="<div class='dropdown-menu-vertical megamenu' style='width:{$meta['menuwidth']}px;max-width: 100%' role='menu'>".TheNextMegaMenu::Show($item->object_id)."</div>";
            wp_reset_query();
        } else
            $item_output .= ($args->has_children) ? ' &nbsp;</a><a href="#" class="pull-right dd-cont"><i class="tn-plus"></i></a>' : '</a>';

        $item_output .= $args->after;


        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }


    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {


        if ( !$element || !is_object($element))
            return;


        $id_field = $this->db_fields['id'];


        //display this element
        if ( is_array( $args[0] ) )
            $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
        else if ( is_object( $args[0] ) )
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'start_el'), $cb_args);


        $id = $element->$id_field;


        // descend only when the depth is right and there are childrens for this element
        if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {


            foreach( $children_elements[ $id ] as $child ){


                if ( !isset($newlevel) ) {
                    $newlevel = true;
                    //start the child delimiter
                    $cb_args = array_merge( array(&$output, $depth), $args);
                    call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                }
                $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
            }
            unset( $children_elements[ $id ] );
        }


        if ( isset($newlevel) && $newlevel ){
            //end the child delimiter
            $cb_args = array_merge( array(&$output, $depth), $args);
            call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
        }


        //end this element
        $cb_args = array_merge( array(&$output, $element, $depth), $args);
        call_user_func_array(array(&$this, 'end_el'), $cb_args);


    }


}

