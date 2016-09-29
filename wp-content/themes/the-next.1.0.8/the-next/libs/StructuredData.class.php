<?php

class StructuredData {

    function __construct(){
        add_action('thenext_mainframe_div_attrs', array($this, 'ItemType'));
        add_filter('thenext_page_heading_main', array($this, 'ItemName'));
    }

    function ItemType(){
        echo 'itemscope itemtype="http://schema.org/Product"';
    }

    function ItemName($name){
        return '<span itemprop="name">'.$name.'</span>';
    }

}

new StructuredData();