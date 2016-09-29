<?php

global $flatsome_opt;

// blog categories
$args = array(
  'type'                     => 'post',
  'child_of'                 => 0,
  'parent'                   => '',
  'orderby'                  => 'name',
  'order'                    => 'ASC',
  'hide_empty'               => 1,
  'hierarchical'             => 1,
  'exclude'                  => '',
  'include'                  => '',
  'number'                   => '',
  'taxonomy'                 => 'category',
  'pad_counts'               => false
);

$categories = get_categories($args);

$output_categories = array();

$output_categories["All"] = "";

foreach($categories as $category){
  $output_categories[htmlspecialchars_decode($category->name)] = $category->slug;
}


$product_types = array(
    "Slider" => "slider",
    "Normal" => "normal",
    "Masonry" => "masonry",
    "Lookbook" => "lookbook"
);

$product_columns = array(
  "3" => "3",
  "4" => "4",
  "5" => "5",
  "6" => "6",
);

$autoplay = array(
  "Disabled" => "false",
  "2s" => "2000",
  "3s" => "3000",
  "4s" => "4000",
  "5s" => "5000",
  "6s" => "6000",
  "7s" => "7000",
  "8s" => "8000",
  "9s" => "9000",
);

$product_orderby = array(
  "Order" => "menu_order",
  "Date" => "date",
  "Name" => "title",
  "Price" => "price",
  "Random" => "rand",
  "Sales" => "sales"
);

$product_show = array(
    "All" => "all",
    "On Sale" => "onsale",
    "Featured" => "featured"
);

// margin
$padding_margin = array(  
    "0px" => "0px",
    "5px" => "5px",
    "10px" => "10px",
    "15px" => "15px",
    "20px" => "20px",
    "30px" => "30px",
    "45px" => "45px",
    "50px" => "50px",
    "60px" => "60px",
    "70px" => "70px",
    "80px" => "80px",
    "90px" => "90px",
    "100px" => "100px",
    "110px" => "110px",
    "120px" => "120px",
    "130px" => "130px",
    "140px" => "140px",
    "150px" => "150px",
    "160px" => "160px",
);

// animate
$ux_animate = array(
    "fadeInLeft" => "fadeInLeft",
    "fadeInRight" => "fadeInRight",
    "fadeInUp" => "fadeInUp",
    "fadeInDown" => "fadeInDown",
    "bounceIn" => "bounceIn",
    "bounceInUp" => "bounceInUp",
    "bounceInDown" => "bounceInDown",
    "bounceInLeft" => "bounceInLeft",
    "bounceInRight" => "bounceInRight",
    "rotateInUpLeft" => "rotateInUpLeft",
    "rotateInDownRight" => "rotateInDownRight",
    "flipInX" => "flipInX",
    "flipInY" => "flipInY",
);

$text_align = array('Left' => 0,'Center' => 'center','Right' => 'right');


// Shortcode options
$options = array();

switch ($shortcode_id) {

case 'section':
case 'background':
  $options = array(
  array(
  "type" => "dropdown",
  "class" => "",
  "heading" => "Text color",
  "param_name" => "dark",
  "value" => array(
    "Normal (Light background)" => "false",
    "White (Dark background)" => "true",
  )
  ),array(
  "type" => "dropdown",
  "class" => "",
  "heading" => "Padding",
  "param_name" => "padding",
  "value" => $padding_margin
  ),array(
  "type" => "dropdown",
  "class" => "",
  "heading" => "Margin bottom",
  "param_name" => "margin",
  "value" => $padding_margin
  ),
  array(
  "type" => "dropdown",
  "class" => "",
  "group" => "Parallax",
  "heading" => "Parallax Background",
  "param_name" => "parallax",
  "value" => array(
    "0 - Disabled" => "0",
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5",
    "6" => "6",
    "7" => "7",
    "8" => "8",
    "9" => "9",
  )
  ),
  array(
  "type" => "dropdown",
  "class" => "",
  "group" => "Parallax",
  "heading" => "Parallax Content",
  "param_name" => "parallax_text",
  "value" => array(
    "0 - Disabled" => "0",
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5",
    "6" => "6",
    "7" => "7",
    "8" => "8",
    "9" => "9",
  )
),array(
    "type" => "attach_image",
    "group" => "Background",
    "heading" => "Background",
    "param_name" => "bg",
    "value" => ""
  ),
  array(
  "type" => "textfield",
  "class" => "",
  "group" => "Background",
  "heading" => "Row Background - OGG Video",
  "param_name" => "video_ogg",
  "value" => ""
),
array(
  "type" => "textfield",
  "class" => "",
  "group" => "Background",
  "heading" => "Row Background - MP4 Video",
  "param_name" => "video_mp4",
  "value" => ""
  ),array(
  "type" => "textfield",
  "heading" => "Class",
  "param_name" => "class",
  "value" => ""
  ),array(
  "type" => "textfield",
  "heading" => "ID",
  "param_name" => "id",
  "value" => ""
  ),array(
    "type" => "attach_image",
    "group" => "Image",
    "heading" => "Image",
    "param_name" => "img",
    "value" => ""
  ),
  array(
  "type" => "dropdown",
  "group" => "Image",
  "heading" => "Image position",
  "param_name" => "img_pos",
  "value" => array(
    "Left" => "left",
    "Right" => "right",
    "Top" => "top",
    "Bottom" => "bottom",
  )
  ),
  array(
  "type" => "textfield",
   "group" => "Image",
  "heading" => "Image width",
  "param_name" => "img_width",
  "value" => "50%"
  ),array(
  "type" => "textfield",
  "group" => "Image",
  "heading" => "Image margin",
  "param_name" => "img_margin",
  "value" => ""
  )
)
;
break;

case 'col':
  $options = array(
  array(
  "type" => "textfield",
  "class" => "",
  "heading" => "Span",
  "param_name" => "span",
  "value" => "1/3"
  ),
    array(
  "type" => "dropdown",
  "class" => "",
  "heading" => "Mobile width",
  "param_name" => "mobile_width",
  "value" => array(
    "1 column (full width)" => "12",
    "1/2 Column (50% width)" => "6",
    "1/3 Column (33% width)" => "4",
  )
  ),array(
  "type" => "dropdown",
  "class" => "",
  "heading" => "Hover effect",
  "param_name" => "hover",
  "value" => array(
    "None" => "",
    "Fade In" => "fade",
    "Focus" => "focus",
    "Blur In" => "blur",
  )
  ),
  array(
  "type" => "dropdown",
  "class" => "",
  "heading" => "Animate",
  "param_name" => "animate",
  "value" => $ux_animate
  ),
  array(
  "type" => "dropdown",
  "class" => "",
  "heading" => "Text align",
  "param_name" => "align",
  "value" => $text_align
  ),
  array(
  "type" => "textfield",
  "heading" => "Padding",
  "param_name" => "padding",
  "value" => ""
),
  array(
  "type" => "textfield",
  "class" => "tooltip",
  "heading" => "Tooltip",
  "param_name" => "tooltip",
  "value" => ""
),array(
  "type" => "dropdown",
  "class" => "",
  "heading" => "Parallax",
  "param_name" => "parallax",
  "value" => array(
    "0 - Disabled" => "0",
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5",
    "6" => "6",
    "7" => "7",
    "8" => "8",
    "9" => "9",
  )
),array(
  "type" => "textfield",
  "class" => "",
  "heading" => "Class",
  "param_name" => "class",
  "value" => ""
  ),

  );
  break;


case 'row':
  $options = array(
  array(
  "type" => "dropdown",
  "class" => "",
  "heading" => "Column Style",
  "admin_label" => true,
  "param_name" => "style",
  "value" => array(
    "Blank (default)" => "",
    "Collapsed (no padding)" => "collapse",
    "Divided" => "divided",
    "Boxed" => "boxed",
  )
  ),
  array(
  "type" => "textfield",
  "class" => "",
  "heading" => "Width (px)",
  "param_name" => "width",
  "value" => "",
  ),array(
  "type" => "textfield",
  "class" => "",
  "heading" => "Class",
  "param_name" => "class",
  "value" => ""
  ),array(
  "type" => "textfield",
  "class" => "",
  "heading" => "ID",
  "param_name" => "id",
  "value" => ""
  )
  );
  break;

case 'ux_banner': 
$name = 'UX Banner';
$options = array(
     array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Banner height",
      "description" => "Add default banner height. Use '100%' if you want to fill the whole screen height. (full screen banner)",
      "admin_label" => true,
      "param_name" => "height",
      "value" => ""
    ),
      array(
      "type" => "textfield",
      "group" => "Responsive",
      "heading" => "Tablet height",
      "description" => "Add banner height for screen smaller than 768px wide",
      "param_name" => "tablet_height",
      "value" => ""
    ),
      array(
      "type" => "textfield",
      "group" => "Responsive",
      "heading" => "Mobile height",
      "description" => "Add banner height for screen smaller than 480px wide",
      "param_name" => "mob_height",
      "value" => ""
    ),
    array(
      "type" => "attach_image",
      "heading" => "Background",
      "param_name" => "bg",
      "value" => "bg"
      ),
    array(
      "type" => "dropdown",
      "heading" => "Background Image Size",
      "param_name" => "bg_size",
      "value" => array(
        "Original" => "original",
        "Large" => "large",
        'Medium' => 'Medium',
        'thumbnail' => 'thumbnail'
      )
    ),
    array(
      "type" => "textfield",
      "heading" => "Link",
      "description" => "Banner link",
      "param_name" => "link",
      "value" => ""
    ),array(
      "type" => "dropdown",
      "heading" => "Link Target",
      "param_name" => "target",
      "value" => array(
        "Current window (_self)" => "_self",
        "New Tab (_blank)" => "_blank",
        )
    ),
    array(
      "type" => "dropdown",
      "heading" => "Text color",
      "group" => "Layout",
      "param_name" => "text_color",
      "value" => array(
        "Light" => "light",
        "Dark" => "dark",
      )
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Text box Animate",
      "group" => "Layout",
      "param_name" => "animated",
      "value" => array(
        "none" => "none",
        "fadeIn" => "fadeIn",
        "fadeInLeft" => "fadeInLeft",
        "fadeInRight" => "fadeInRight",
        "fadeInUp" => "fadeInUp",
        "fadeInDown" => "fadeInDown",
        "bounceIn" => "bounceIn",
        "bounceInUp" => "bounceInUp",
        "bounceInDown" => "bounceInDown",
        "bounceInLeft" => "bounceInLeft",
        "bounceInRight" => "bounceInRight",
        "rotateInUpLeft" => "rotateInUpLeft",
        "rotateInDownRight" => "rotateInDownRight",
        "flipInX" => "flipInX",
        "flipInY" => "flipInY",
      )
    ),  
    array(
      "type" => "textfield",
      "class" => "",
      "group" => "Layout",
      "heading" => "Text box width",
      "param_name" => "text_width",
      "value" => "60%"
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "group" => "Layout",
      "heading" => "Text align",
      "param_name" => "text_align",
      "value" => array(
      "Center" => "center",
      "Left" => "left",
      "Right" => "right",
      )
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Text box position",
      "param_name" => "text_pos",
      "group" => "Layout",
      "value" => array(
      "[---*---] Center" => "center",
      "[---^---] Center - Top" => "center top",
      "[---v---] Center - Bottom" => "center bottom",
      "[-*-----] Left - Center" => "left center",
      "[-v-----] Left - bottom" => "left bottom",
      "[-^-----] Left - top" => "left top",
      "[-----*-] Right - Center" => "right center",
      "[-----^-] Right - Top" => "right top",
      "[-----v-] Right - Bottom" => "right bottom",
      "[------*] Far Right Center" => "far-right center",
      "[*------] Far Left Center" => "far-left center",
      "[^^^^^^] Full Width - Top" => "full-width top",
      "[vvvvvvv] Full Width - Far Bottom " => "full-width far-bottom",
      "[^^^^^^^] Full width - bottom" => "full-width bottom",
      "[vvvvvv] Full Width - Far Top" => "full-width far-top",
      )
    ),
    array(
      "type" => "colorpicker",
      "class" => "",
      "group" => "Layout",
      "heading" => "Text box background",
      "param_name" => "text_bg",
      "value" => ""
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "group" => "Layout",
      "heading" => "Text box padding",
      "param_name" => "padding",
      "value" => ""
    ),
    array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Background parallax",
    "param_name" => "parallax",
     "group" => "Parallax",
    "value" => array(
    "0" => "0",
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5",
    "6" => "6",
    "7" => "7",
    "8" => "8",
    "9" => "9",
  )
  ),  
    array(
    "type" => "dropdown",
    "class" => "",
    "heading" => "Text box parallax",
    "group" => "Parallax",
    "param_name" => "parallax_text",
    "value" => array(
    "0" => "0",
    "0,5" => "05",
    "0,75" => "075",
    "1" => "1",
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5",
    "6" => "6",
    "7" => "7",
    "8" => "8",
    "9" => "9",
  )
  ),array(
      "type" => "colorpicker",
      "heading" => "Background Overlay",
      "group" => "Effects",
      "param_name" => "bg_overlay",
      "description" => "Add a transparent color overlay",
      "value" => ""
      ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Background Effect",
      "param_name" => "effect",
       "group" => "Effects",
      "value" => array(
        "No effect" => "",
        "Snow" => "snow",
        "Confetti" => "confetti",
        "Sliding Glass" => "sliding-glass",
        "Sparkle" => "sparkle",
        "Rain" => "rain",
      )
    ),
     array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Hover Effect",
      "param_name" => "hover",
      "group" => "Effects",
      "value" => array(
        "No effect" => "",
        "Zoom" => "zoom",
        "Fade out" => "fade",
         "Blur" => "blur",
      )
    ),
     array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Slide Effect (NEW)",
      "param_name" => "slide_effect",
      "group" => "Effects",
      "value" => array(
        "No effect" => "",
        "Zoom In" => "zoom-in",
        "Zoom Out" => "zoom-out",
      )
    ),
    array(
      "type" => "textfield",
      "group" => "Video",
      "class" => "",
      "heading" => "Video MP4",
      "param_name" => "video_mp4",
      "description" => "Nice tool to convert videos: https://cloudconvert.org/",
      "value" => ""
    ),
    array(
      "type" => "textfield",
      "class" => "",
        "group" => "Video",
      "heading" => "Video OGG ",
      "param_name" => "video_ogg",
      "value" => ""
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "group" => "Video",
      "heading" => "Video WEBM",
      "param_name" => "video_webm",
      "value" => ""
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "group" => "Video",
      "heading" => "Youtube (BETA)",
      "param_name" => "youtube",
      "description" => "Add a youtube ID here. F.ex 9d8wWcJLnFI",
      "value" => ""
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "group" => "Video",
      "heading" => "Sound",
      "param_name" => "video_sound",
      "value" => array('false' => 'false','true' => 'true')
    ),
     array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Excerpts",
      "param_name" => "excerpt",
      "value" => array(
        "Hide" => "false"
      )
    ),
    array(
      "type" => "checkbox",
      "class" => "",
      "group" => "Video",
      "heading" => "Loop",
      "param_name" => "video_loop",
       "value" => array(
        "Disable" => "false"
      )
    ),
    );
    // end params
break;

case 'accordion':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "Title",
      "param_name" => "title",
      "admin_label" => true,
      "value" => ""
      ),
    // end params
   );
break;

case 'accordion-item':
$options = array(
    array(
      "type" => "textfield",
      "heading" => "Content",
      "holder" => "h3",
      "param_name" => "title",
      "value" => "Accordion title"
      )
    // end params
   );
break;

case 'ux_banner_grid':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "Grid height",
      "param_name" => "height",
      "value" => "600px"
      ),
      array(
      "type" => "image_select",
      "heading" => "Grid style",
      "param_name" => "grid",
      "value" => array(
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_1.png' => "1",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_2.png' => "2",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_3.png' => "3",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_4.png' => "4",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_5.png' => "5",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_6.png' => "6",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_7.png' => "7",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_8.png' => "8",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_9.png' => "9",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_10.png' => "10",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_11.png' => "11",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_12.png' => "12",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_13.png' => "13",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_14.png' => "14",
      )        
      ),
      array(
      "type" => "dropdown",
      "heading" => "Grid Padding",
      "param_name" => "padding",
      "value" => array(
        "0px" => "0px",
        "5px" => "5px",
        "10px" => "10px",
        "15px" => "15px",
        "20px" => "20px",
        "25px" => "25px",
        "30px" => "30px",
      )
      ));
break;

case 'blog_posts':
$options = array(
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Style",
      "admin_label" => true,
      "param_name" => "style",
      "value" => array(
        "Normal" => "normal",
        "Box Style" => "text-boxed",
        "Text Bounce" => "text-bounce",
        "Text Overlay" => "text-overlay",
      )
    ),    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Type",
      "admin_label" => true,
      "param_name" => "type",
      "value" => array(
        "Slider" => "slider",
        "Grid" => "grid",
        "Masonry" => "masonry",
      )
    ),

    array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Columns",
      "param_name" => "columns",
      "value" => '3'
    ),

    array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Image height",
      "param_name" => "image_height",
      "value" => '200px'
    ),
    
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Posts",
      "param_name" => "posts",
      "value" => '6'
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Date box",
      "param_name" => "show_date",
     "value" => array(
        "Show" => "true",
        "Hide" => "false",
      )
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "admin_label" => true,
      "heading" => "Category",
      "param_name" => "category",
      "value" => $output_categories
    ),
    array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Excerpts",
      "param_name" => "excerpt",
      "value" => array(
        "Hide" => "false"
      )
    ),
    array(
      "type" => "dropdown",
      "heading" => "Auto slide?",
      "param_name" => "auto_slide",
      "value" => $autoplay 
    )
   );
break;

case 'button':
$options = array(
    array(
      "type" => "textfield",
      "holder" => "button",
      "class" => "",
      "heading" => "Button text",
      "param_name" => "text",
      "value" => "Button"
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Link",
      "param_name" => "link",
      "value" => "http://href",
      "description" => "Add button link here. Youtube and Vimeo links will open in a ligthbox automaticly."
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Style",
      "admin_label" => true,
      "param_name" => "style",
      "value" => array(
        "Primary" => "primary",
        "Secondary" => "secondary",
        "Alert" => "alert",
        "Success" => "success",
        "White" => "white",
        "Primary bordered" => "primary alt-button",
        "Secondary bordered" => "secondary alt-button",
        "Alert bordered" => "alert alt-button",
        "Success bordered" => "success alt-button",
        "White bordered" => "white alt-button",
      )
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Button size",
      "param_name" => "size",
      "value" => array(
        "Normal" => "normal",
        "Large" => "large",
        "Small" => "small",
      )
    )
   );
break;

case 'facebook_login_button':
$options = array(
      array(
        "type" => "textfield",
        "holder" => "button",
        "class" => "",
        "heading" => "Button text",
        "param_name" => "text",
        "value" => "Login / Register with Facebook"
      ),
      array(
        "type" => "dropdown",
        "class" => "",
        "heading" => "Button size",
        "param_name" => "size",
        "value" => array(
          "Normal" => "normal",
          "Large" => "large",
          "Small" => "small",
        )
      )
     );
break;

case 'featured_box':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "Title",
      "param_name" => "title",
      "holder" => "h3",
      "value" => "Featured box title"
      ),
      array(
      "type" => "textfield",
      "heading" => "Sub title",
      "param_name" => "title_small",
      "holder" => "h4",
      "value" => ""
      ),array(
      "type" => "dropdown",
      "heading" => "Icon position",
      "group" => "Icon",
      "admin_label" => true,
      "param_name" => "pos",
      "value" => array(
        "Top left"=>"top",
        "Top center"=>"center",
        "Left"=>"left",
        )
      ),array(
      "type" => "dropdown",
      "heading" => "Text Size",
      "param_name" => "font_size",
      "value" => array(
        "Normal"=>"",
        "Smaller"=>"90%",
        "Smallest"=>"80%",
        "Bigger"=>"110%",
        "Biggest"=>"120%",
        )
      ),
      array(
      "type" => "attach_image",
       "group" => "Icon",
      "heading" => "Image / Icon",
      "holder" => "img",
      "param_name" => "img",
      "value" => "",
      ),
      array(
      "type" => "image_fix",
      "heading" => "Image fix",
      "param_name" => "bg",
      "value" => ""
       ),
       array(
      "type" => "textfield",
      "group" => "Icon",
      "heading" => "Image / Icon width",
      "param_name" => "img_width",
      "value" => "42px"
      ),
       array(
      "type" => "dropdown",
       "group" => "Icon",
      "heading" => "Icon border Size",
      "param_name" => "icon_border",
      "value" => array("0px"=>"0","1px"=>"1px","2px"=>"2px","3px"=>"3px","4px"=>"4px","5px"=>"5px","6px"=>"6px",)
      ),
       array(
      "type" => "colorpicker",
      "heading" => "Icon / border color",
      "group" => "Icon",
      "param_name" => "icon_color",
      "value" => $flatsome_opt['color_primary']
      ),
       array(
      "type" => "textfield",
      "heading" => "Tooltip text",
      "param_name" => "tooltip",
      "value" => ""
      ),
       array(
      "type" => "textfield",
      "heading" => "Link",
      "param_name" => "link",
      "value" => ""
      ),
      array(
      "type" => "dropdown",
       "group" => "Icon",
      "heading" => "Icon animate",
      "param_name" => "animated",
      "value" => $ux_animate
      ),
      

    // end params
   );
break;

case 'featured_items_grid':
case 'featured_items_slider':

$options = array(
     array(
      "type" => "featured_items_category",
      "class" => "",
      "heading" => "Category",
      "admin_label" => true,
      "param_name" => "cat",
      "value" => ""
    ),
      array(
      "type" => "textfield",
      "heading" => "Number of items",
      "param_name" => "items",
      "value" => "8"
      ),
      array(
      "type" => "textfield",
      "heading" => "Image height",
      "param_name" => "height",
      "value" => "250px"
      ),
      array(
      "type" => "dropdown",
      "heading" => "Grid Style",
      "admin_label" => true,
      "param_name" => "style",
        "value" => array(
          "Text Bounce (Default)" => "1",
          "Text Overlay" => "2",
        )
      ),
      array(
      "type" => "dropdown",
      "heading" => "Open in lightbox",
      "admin_label" => true,
      "param_name" => "lightbox",
        "value" => array(
          "False" => "false",
          "True" => "true",
        )
      ),
      array(
      "type" => "dropdown",
      "heading" => "Columns",
      "admin_label" => true,
      "param_name" => "columns",
      "value" => array(
        "3" => "3",
        "4" => "4",
        "5" => "5",
        "6" => "6",
        "7" => "7",
        "8" => "8",
      )
      ),
    // end params
   );

break;

case 'featured_items_category':
$options = array(
     array(
      "type" => "featured_items_category",
      "class" => "",
      "heading" => "Category",
      "admin_label" => true,
      "param_name" => "cat",
      "value" => ""
    ),
      array(
      "type" => "textfield",
      "heading" => "Number of Items",
      "param_name" => "items",
      "value" => "8"
      ),
      array(
      "type" => "textfield",
      "heading" => "Image height",
      "param_name" => "height",
      "value" => "250px"
      ),
      array(
      "type" => "dropdown",
      "heading" => "Style",
      "admin_label" => true,
      "param_name" => "style",
        "value" => array(
          "Text Bounce (Default)" => "1",
          "Text Overlay" => "2",
        )
      ),
      array(
      "type" => "dropdown",
      "heading" => "Open in lightbox",
      "admin_label" => true,
      "param_name" => "lightbox",
        "value" => array(
          "False" => "false",
          "True" => "true",
        )
      ),
      array(
      "type" => "dropdown",
      "heading" => "Columns",
      "admin_label" => true,
      "param_name" => "columns",
      "value" => array(
        "3" => "3",
        "4" => "4",
        "5" => "5",
        "6" => "6",
        "7" => "7",
        "8" => "8",
      )
      ),
    // end params
);
break;


case 'map':

$options = array(
      array(
      "type" => "textfield",
      "heading" => "Latitude",
      "description" => "Use this tool to find Latitud and Longitude: http://universimmedia.pagesperso-orange.fr/geo/loc.htm",
      "param_name" => "lat",
      "value" => ""
      ),
      array(
      "type" => "textfield",
      "heading" => "Longitude",
      "param_name" => "long",
      "value" => "" 
      ),
      array(
      "type" => "textfield",
      "heading" => "Map height",
      "param_name" => "height",
      "value" => "500px"
      ),
      array(
      "type" => "colorpicker",
      "heading" => "Map color",
      "param_name" => "color",
      "value" => "#58728a"
      ),
      array(
      "type" => "textfield",
      "heading" => "Zoom level",
      "param_name" => "zoom",
      "value" => "17"
      ),
    );
break;

case 'lightbox':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "ID",
      "param_name" => "id",
      "admin_label" => true,
      "description" => "Enter the ID of lightbox here. This will be opned by any link or button having the ID in it. F.ex &lt;a href='<b>#my_id</b>'&gt;",
      "value" => "my_id"
      ),
      array(
      "type" => "textfield",
      "heading" => "width",
      "param_name" => "width",
      "value" => "600px"
      ),
       array(
      "type" => "textfield",
      "heading" => "padding",
      "param_name" => "padding",
      "value" => "20px"
      ),
        array(
      "type" => "checkbox",
      "heading" => "Auto open?",
      "param_name" => "auto_open",
      "value" => array('True' => 'true'),
      ),
        array(
      "type" => "textfield",
      "heading" => "Auto open timer",
      "param_name" => "auto_timer",
      "description" => "After how many scounds should the lightbox open? 3000 = 3 secounds",
      "value" => "3000"
      ),
         array(
      "type" => "dropdown",
      "heading" => "Auto show",
      "param_name" => "auto_show",
      "description" => "Should the lightbox always show or only once for each customer?",
      "value" => array('Always' => 'always', 'Only Once' => 'once'),
      )

    );
break;

case 'message_box':
$options = array(
      array(
      "type" => "attach_image",
      "heading" => "Background",
      "description" => "Enter background image URL or a #HEX code here.",
      "param_name" => "bg",
      "value" => "#000"
      ),
      array(
      "type" => "dropdown",
      "heading" => "Text Color",
      "param_name" => "text_color",
      "value" => array('Light' => 'light', 'Dark' => 'dark'),
      )
);
break;


case 'ux_product_categories_grid':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "Grid height",
      "param_name" => "height",
      "admin_label" => true,
      "value" => "600px"
      ),
      array(
      "type" => "image_select",
      "heading" => "Grid style",
      "param_name" => "grid",
      "value" => array(
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_1.png' => "1",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_2.png' => "2",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_3.png' => "3",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_4.png' => "4",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_5.png' => "5",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_6.png' => "6",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_7.png' => "7",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_8.png' => "8",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_9.png' => "9",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_10.png' => "10",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_11.png' => "11",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_12.png' => "12",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_13.png' => "13",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/shortcodes/grid_14.png' => "14",
      )        
      ),
      array(
      "type" => "textfield",
      "heading" => "Number of Categories",
      "param_name" => "number",
      "admin_label" => true,
      "value" => "10"
      ),
      array(
      "type" => "product_category_id",
      "heading" => "Category",
      "param_name" => "parent",
      "admin_label" => true,
      "value" => "",
      ),array(
      "type" => "dropdown",
      "heading" => "Grid Padding",
      "param_name" => "padding",
      "value" => array(
        "0px" => "0px",
        "5px" => "5px",
        "10px" => "10px",
        "15px" => "15px",
        "20px" => "20px",
        "25px" => "25px",
        "30px" => "30px",
      )
      ),
      array(
      "type" => "textfield",
      "heading" => "Offset",
      "param_name" => "offset",
      "admin_label" => true,
      "value" => "0"
      ),
      array(
      "type" => "colorpicker",
      "heading" => "Color overlay",
      "param_name" => "bg_overlay",
      "description" => "Set category overlay color. Remember to have a transparent color (Drag the right slider down)",
      "value" => "#000",
      )
);
break;


case 'ux_product_categories':
$options =  array(
      array(
      "type" => "textfield",
      "heading" => "Title",
      "param_name" => "title",
      "admin_label" => true,
      "value" => ""
      ),
      array(
      "type" => "textfield",
      "heading" => "Number of Categories",
      "param_name" => "number",
      "admin_label" => true,
      "value" => "10"
      ),
      array(
      "type" => "product_category_id",
      "heading" => "Category",
      "param_name" => "parent",
      "admin_label" => true,
      "value" => "",
      ),
      array(
      "type" => "dropdown",
      "heading" => "Style",
      "admin_label" => true,
      "param_name" => "style",
      "value" => array(
      "Badge (normal)" => "text-badge",
      "Text normal" => "text-normal",
      "Box Style" => "text-boxed",
      "Text Overlay" => "text-overlay",
      "Text Bounce" => "text-bounce",   
      )
      ),
      array(
      "type" => "dropdown",
      "heading" => "Type",
      "admin_label" => true,
      "param_name" => "type",
      "value" => array(
      "Slider" => "slider",
      "Grid" => "grid",   
      )
      ),
      array(
      "type" => "dropdown",
      "heading" => "Columns",
      "admin_label" => true,
      "param_name" => "columns",
      "value" => array(
        "3" => "3",
        "4" => "4",
        "5" => "5",
        "6" => "6",
        "7" => "7",
        "8" => "8",
      )
      ),
      array(
      "type" => "textfield",
      "heading" => "Offset",
      "param_name" => "offset",
      "value" => "0"
      ),
    // end params
);

break;

case 'ux_product_flip':
$options = array(
    array(
      "type" => "product_category",
      "class" => "",
      "heading" => "Category",
      "admin_label" => true,
      "param_name" => "cat",
      "value" => ""
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Number of products",
      "param_name" => "products",
      "value" => "8"
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Height",
      "param_name" => "height",
      "value" => "510px"
    ),

   );
break;// end params


case 'product_lookbook':
case 'products_pinterest_style':
case 'ux_featured_products':
case 'ux_bestseller_products':
case 'ux_latest_products':
case 'ux_sale_products':
case 'ux_custom_products':
case 'featured_products':
case 'recent_products':

$options = array(
    array(
      "type" => "textfield",
      "heading" => "Title",
      "admin_label" => true,
      "param_name" => "title",
      "description" => "Leave empty to hide title.",
      "value" => ""
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Number of products",
      "param_name" => "products",
      "value" => "12"
    ),
     array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Columns",
      "param_name" => "columns",
      "value" => "4"
    ),
     array(
      "type" => "product_category",
      "class" => "",
      "heading" => "Category",
      "admin_label" => true,
      "description" => "Get products by category",
      "param_name" => "cat",
      "value" => ""
    ),
     array(
      "type" => "textfield",
      "heading" => "Tags",
      "param_name" => "tags",
      "description" => "Get products by tag",
      "value" => ""
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Show",
      "param_name" => "show",
      "value" => $product_show
    ),
     array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Order By",
      "param_name" => "orderby",
      "value" => $product_orderby
    ),
     array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Order",
      "param_name" => "order",
      "value" => array('Desc' => 'desc', 'Asc' => 'asc')
    ),
     array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Display type",
      "param_name" => "type",
      "value" => $product_types
    ),
     array(
      "type" => "checkbox",
      "class" => "",
      "heading" => "Infinitive slider?",
      "param_name" => "infinitive",
      "value" => array('Disable' => 'false'),
    ),
    array(
      "type" => "dropdown",
      "heading" => "Auto slide?",
      "param_name" => "auto_slide",
      "value" => $autoplay 
    ),
);// end params

break;

case 'ux_products_list':

$options = array(
    array(
      "type" => "textfield",
      "heading" => "Title",
      "admin_label" => true,
      "param_name" => "title",
      "description" => "Leave empty to hide title.",
      "value" => ""
    ),
    array(
      "type" => "textfield",
      "class" => "",
      "heading" => "Number of products",
      "param_name" => "products",
      "value" => "12"
    ),
    array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Show",
      "param_name" => "show",
      "value" => $product_show
     ),
     array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Order By",
      "param_name" => "orderby",
      "value" => $product_orderby
    ),
     array(
      "type" => "dropdown",
      "class" => "",
      "heading" => "Order",
      "param_name" => "order",
      "value" => array('Desc' => 'desc', 'Asc' => 'asc')
    ),
);// end params

break;


case 'follow':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "Title",
      "param_name" => "title",
      "value" => ""
      ), array(
      "type" => "dropdown",
      "heading" => "Size",
      "admin_label" => true,
      "param_name" => "size",
      "value" => array('Normal' => '', 'Small' => 'small')
      ), array(
       "type" => "textfield",
      "heading" => "Facebook",
         "admin_label" => true,
      "param_name" => "facebook",
      "value" => ""
      ), array(
       "type" => "textfield",
      "heading" => "Twitter",
         "admin_label" => true,
      "param_name" => "twitter",
      "value" => ""
      ), array(
       "type" => "textfield",
      "heading" => "Email",
         "admin_label" => true,
      "param_name" => "email",
      "value" => ""
      ), array(
       "type" => "textfield",
      "heading" => "Pinterest",
         "admin_label" => true,
      "param_name" => "pinterest",
      "value" => ""
      ), array(
       "type" => "textfield",
      "heading" => "Tumblr",
         "admin_label" => true,
      "param_name" => "tumblr",
      "value" => ""
      ), array(
      "type" => "textfield",
      "heading" => "RSS Feed",
         "admin_label" => true,
      "param_name" => "rss",
      "value" => ""
      ), array(
      "type" => "textfield",
      "heading" => "Instagram",
         "admin_label" => true,
      "param_name" => "instagram",
      "value" => ""
      ), array(
      "type" => "textfield",
      "heading" => "Google plus",
         "admin_label" => true,
      "param_name" => "googleplus",
      "value" => ""
      ), array(
      "type" => "textfield",
      "heading" => "Linked In",
         "admin_label" => true,
      "param_name" => "linkedin",
      "value" => ""
      ), array(
      "type" => "textfield",
      "heading" => "Youtube",
         "admin_label" => true,
      "param_name" => "youtube",
      "value" => ""
      ),array(
      "type" => "textfield",
      "heading" => "Flickr",
         "admin_label" => true,
      "param_name" => "flickr",
      "value" => ""
      ),array(
      "type" => "textfield",
      "heading" => "VKontakte",
         "admin_label" => true,
      "param_name" => "vkontakte",
      "value" => ""
      )
);

break;


case 'share':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "Title",
      "param_name" => "title",
      "description" => "You can select which share icons to show in Theme Option > Account and Social",
      "value" => ""
      ),
);
break;


case 'ux_slider':

$options = array(
     array(
      "type" => "image_select",
      "heading" => "Style",
      "param_name" => "style",
      "value" => array(
        get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-full-width.png' => "normal, Normal",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-container.png' => "container, Container",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-focus.png' => "focus, Focused",
     )
    ),
    array(
      "type" => "image_select",
      "heading" => "Navigation",
      "param_name" => "arrows",
      "value" => array(
        get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-nav-circle.png' => "circle, Circle",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-nav-simple.png' => "simple, Simple",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-nav-reveal.png' => "reveal, Reveal",
        get_template_directory_uri().'/inc/extensions/ux-builder/img/options/disabled.png' => "false, Disabled",
     )
    ),
    array(
      "type" => "image_select",
      "heading" => "Bullets",
      "param_name" => "bullets",
      "value" => 
        array(
          get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-dots-circle.png' => "circle, Circle",
          get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-dots-dots.png' => "simple, Simple",
          get_template_directory_uri().'/inc/extensions/ux-builder/img/options/disabled.png' => "false, Disabled"
        ),
    ),
    array(
      "type" => "image_select",
      "heading" => "Navigation color",
      "param_name" => "nav_color",
      "value" =>  array(
          get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-nav-dark.png' => "light, Light",
          get_template_directory_uri().'/inc/extensions/ux-builder/img/options/slider-nav-light.png' => "dark, Dark",
        ), 
    
    ),
    array(
      "type" => "dropdown",
      "heading" => "Infinitive slider",
      "param_name" => "infinitive",
      "value" => 
          array(
          "true" => "true",
          "false" => "false",
          ),
    ),

    array(
      "type" => "dropdown",
      "heading" => "Auto slide",
      "param_name" => "auto_slide",
      "value" => 
          array(
          "true" => "true",
          "false" => "false",
          ),
    ),
     array(
      "type" => "dropdown",
      "heading" => "Columns",
      "param_name" => "columns",
      "value" => 
          array('1' => '1','2' => '2','3' => '3','4' => '4'),
    ),array(
      "type" => "checkbox",
      "heading" => "Hide on Mobile",
      "param_name" => "mobile",
      "value" => array(
        "Hide on mobile" => "false",
        )
      )
     /*array(
      "type" => "dropdown",
      "heading" => "Content Top padding",
      "param_name" => "top_padding",
      "description" => "Use this to fix slider content position if you use Transparent page template",
      "value" => 
          array('25px' => '25px','50px' => '50px','75px' => '75px','100px' => '100px','125px' => '125px','150px' => '150px'),
    ), */
    // end params
);

break;

case 'tabgroup':

$options = array(
       array(
      "type" => "dropdown",
      "heading" => "Style",
      "param_name" => "style",
      "admin_label" => true,
      "value" => array(
        "Normal" => "normal",
        "Center" => "center",
        "Pill Style" => "pills",
  
      )
      ),
      array(
      "type" => "textfield",
      "heading" => "Tab group title",
      "param_name" => "title",
      "admin_label" => true,
      "value" => ""
      )
  );
break;

case 'tabgroup_vertical':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "Tab group title",
      "param_name" => "title",
      "value" => ""
      ),
);
break;

case 'tab':
$option = array(
        array(
        "type" => "textfield",
        "holder" => "h4",
        "heading" => "Tab title",
        "param_name" => "title",
        "value" => "Tab title"
        )
);
break;

case 'team_member':
$options = array(
     
      array(
      "type" => "textfield",
      "heading" => "Name",
      "param_name" => "name",
      "value" => "Name",
      "admin_label" => true,
      ),
      array(
      "type" => "textfield",
      "heading" => "Title",
      "param_name" => "title",
      "value" => "Profession",
      "admin_label" => true,
      ),
        array(
      "type" => "dropdown",
      "heading" => "Style",
      "param_name" => "style",
      "admin_label" => true,
            "value" => array(
                "Circle image (default)" => "text-circle",
                "Square image" => "text-square",
                "Box Style" => "text-boxed",
                "Text Overlay" => "text-overlay",
                "Text Bounce" => "text-bounce",
              ),
      ),
      array(
      "type" => "attach_image",
      "heading" => "Image",
      "param_name" => "img",
      "value" => "",
      ),
      array(
      "type" => "textfield",
      "heading" => "Phone nr.",
      "param_name" => "tel",
      "value" => "",
      ),
      array(
      "type" => "textfield",
      "heading" => "Facebook",
      "param_name" => "facebook",
      "value" => "",
      ),
      array(
      "type" => "textfield",
      "heading" => "Twitter",
      "param_name" => "twitter",
      "value" => "",
      ),
      array(
      "type" => "textfield",
      "heading" => "Email",
      "param_name" => "email",
      "value" => "",
      ),
      array(
      "type" => "textfield",
      "heading" => "Instagram",
      "param_name" => "instagram",
      "value" => "",
      ),
      array(
      "type" => "textfield",
      "heading" => "LinkedIn",
      "param_name" => "linkedin",
      "value" => "",
      ),
      array(
      "type" => "textfield",
      "heading" => "Pinterest",
      "param_name" => "pinterest",
      "value" => "",
      )
);

break;


case 'testimonial':

$options = array(
     
      array(
      "type" => "textfield",
      "heading" => "Name",
      "param_name" => "name",
      "value" => "Name",
      "admin_label" => true,
      ),
      array(
      "type" => "textfield",
      "heading" => "Company",
      "param_name" => "company",
      "value" => "Company",
      "admin_label" => true,
      ),
      array(
      "type" => "attach_image",
      "heading" => "Image",
      "param_name" => "image",
      "value" => "",
      ),
      array(
      "type" => "dropdown",
      "heading" => "Stars",
      "param_name" => "stars",
      "value" => array('5' => '5','4' => '4','3' => '3'),
       "admin_label" => true,
      ),
       array(
      "type" => "dropdown",
      "heading" => "Text align",
      "param_name" => "text_align",
      "value" => array('Left' => 'text-left','Center' => 'text-center'),
       "admin_label" => true,
      )
);

break;


case 'title':

$options = array(
      array(
      "type" => "textfield",
      "heading" => "Title",
      "param_name" => "text",
      "admin_label" => true,
      "value" => "Enter title here.."
      ),
      array(
      "type" => "dropdown",
      "heading" => "Style",
      "param_name" => "style",
      "admin_label" => true,
      "value" => array(
        "Left" => " ",
        "Left Bold" => "bold",
        "Center" => "center",
        "Center Divided" => "divided",
        "Center Bold" => "bold_center",
      )),
       array(
      "type" => "textfield",
      "heading" => "Link text",
      "param_name" => "link_text",
      "value" => ""
      ),
       array(
      "type" => "textfield",
      "heading" => "Link url",
      "param_name" => "link",
      "value" => ""
      ),
 
);

break;


case 'divider':
$options = array(
      array(
      "type" => "dropdown",
      "admin_label" => true,
      "heading" => "Width",
      "param_name" => "width",
      "value" => array(
        "Medium" => "medium",
        "Small" => "small",
        "Full Width" => "full",
        )
      ), 
      array(
        "type" => "dropdown",
        "heading" => "Height",
        "admin_label" => true,
        "param_name" => "height",
        "value" => array('3px' => '3px','2px' => '2px','1px' => '1px')
        ),
      array(
        "type" => "dropdown",
        "heading" => "Align",
        "admin_label" => true,
        "param_name" => "align",
        "value" => array('left','center')
        ),
    // end params
);

break;

case 'gap': 
$options = array(array(
        "type" => "textfield",
        "heading" => "Height",
        "param_name" => "height",
       "value" => array('3px' => '3px','2px' => '2px','1px' => '1px')
        )
    // end params
);
break;

case 'ux_image':

$options = array(
    array(
      "type" => "textfield",
      "heading" => "Tilte (Alt/title tag)",
      "param_name" => "title",
      "value" => "" 
      ),
      array(
      "type" => "attach_image",
      "heading" => "Select image",
      "holder" => "img",
      "param_name" => "id",
      "value" => "" 
      ),
      array(
      "type" => "dropdown",
      "heading" => "Image size",
      "param_name" => "image_size",
      "value" => array(
        "large" => "large",
        "medium" => "medium",
        "thumbnail" => "thumbnail",
        "original" => "Original",
        )
      ), array(
      "type" => "checkbox",
      "heading" => "Drop shadow",
      "param_name" => "drop_shadow",
      "value" => array(
        "Enable drop shadow" => "1",
        )
      ), array(
      "type" => "checkbox",
      "heading" => "Lightbox",
      "param_name" => "lightbox",
      "value" => array(
        "Open image in lightbox" => "1",
        )
      ),
      array(
      "type" => "textfield",
      "heading" => "Link",
      "admin_label" => true,
      "param_name" => "link",
      "value" => "" 
      ),array(
      "type" => "dropdown",
      "heading" => "Link Target",
      "param_name" => "target",
      "value" => array(
        "Current window (_self)" => "_self",
        "New Tab (_blank)" => "_blank",
        )
      ),array(
      "type" => "dropdown",
      "heading" => "Pull down image",
      "param_name" => "image_pull",
      "value" => array(
        "0px" => "0px",
        "15px" => "15px",
        "30px" => "30px",
        "45px" => "45px",
        "60px" => "60px",
      )
      )
);

break;


case 'ux_price_table':
$options =array(
      array(
      "type" => "textfield",
      "heading" => "Title",
      "admin_label" => true,
      "param_name" => "title",
      "value" => "Enter title here.." 
      ),
      array(
      "type" => "textfield",
      "heading" => "Price",
      "admin_label" => true,
      "param_name" => "price",
      "value" => "99$" 
      ),
      array(
      "type" => "textfield",
      "heading" => "Description",
      "param_name" => "description",
      "admin_label" => true,
      "value" => "Enter description here..." 
      ),array(
      "type" => "dropdown",
      "heading" => "Button Style",
      "param_name" => "button_style",
        "value" => array(
        "No button" => "0",
        "Primary" => "primary",
        "Secondary" => "secondary",
        "Alert" => "alert",
        "Success" => "success",
        "White" => "white",
        "Primary bordered" => "primary alt-button",
        "Secondary bordered" => "secondary alt-button",
        "Alert bordered" => "alert alt-button",
        "Success bordered" => "success alt-button",
        "White bordered" => "white alt-button",
      )
      ),
      array(
      "type" => "textfield",
      "heading" => "Button link",
      "param_name" => "button_link",
      "value" => "http://link" 
      ),
      array(
      "type" => "textfield",
      "heading" => "Button text",
      "param_name" => "button_text",
      "value" => "Shop now" 
      ),
      array(
      "type" => "checkbox",
      "heading" => "Featured",
      "admin_label" => true,
      "param_name" => "featured",
      "value" => array('Enabled' => 'true')
      )
);

break;

case 'bullet_item':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "Text",
      "param_name" => "text",
      "value" => "Enter text here.." 
      ),array(
      "type" => "textfield",
      "heading" => "Tooltip",
      "param_name" => "tooltip",
      "value" => "" 
      ),
      );
break;


case 'scroll_to':
$options = array(
      array(
      "type" => "textfield",
      "heading" => "Link",
      "param_name" => "link",
      "description" => "Use this link anywhere to scroll to this element. F.ex #section_name",
      "value" => "#unique_section_id"
      ),array(
      "type" => "textfield",
      "heading" => "Bullet title",
      "Descrition" => "Remove text to hide bullet",
      "param_name" => "title",
      "value" => "Enter a Title here..." 
      ),
);

break;


case 'logo':
$options = array(
    array(
      "type" => "attach_image",
      "heading" => "Image",
      "param_name" => "img",
      "value" => ""
      ),
      array(
      "type" => "textfield",
      "heading" => "Title",
      "param_name" => "title",
      "admin_label" => true,
      "value" => "Enter logo title.."
      ),array(
      "type" => "textfield",
      "heading" => "Link",
      "param_name" => "link",
      "admin_label" => true,
      "value" => "#"
      ),
      array(
      "type" => "textfield",
      "heading" => "Padding",
      "param_name" => "padding",
      "value" => "15px"
      ),array(
      "type" => "textfield",
      "heading" => "Height",
      "param_name" => "height",
      "value" => "50px"
      )
);

break;


case 'ninja_forms_display_form':
$options = array(
  array(
    "type" => "ux_ninjaforms_select",
    "class" => "",
    "admin_label" => true,
    "heading" => "Form ID: ",
    "param_name" => "id",
    "value" => "1"
  ),
 );

break;


case 'block':
$options = array(
  array(
    "type" => "select_block",
    "class" => "",
    "heading" => "Select block:",
    "param_name" => "id",
    "value" => ""
  ),
 );

break;

case 'ux_countdown':
$options = array(
  array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Year",
    "param_name" => "year",
    "value" => "2016",
    "description" => 'The year of date. F.ex 2016'

  ),
  array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Month",
    "param_name" => "month",
    "value" => "12",
    "description" => 'The month of date. F.ex 12'
  ),
   array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Day",
    "param_name" => "day",
    "value" => "30",
    "description" => 'The day of date. F.ex 30'
  ),
   array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Time",
    "param_name" => "time",
    "value" => "24:00",
    "description" => 'The time of day. F.ex 24:00'
  ),
  array(
      "type" => "dropdown",
      "heading" => "Color",
      "param_name" => "color",
        "value" => array(
        "Dark" => "dark",
        "Light" => "light",
        "Primary" => "primary",
        "Transparent" => "transparent",
      )
  ),
   array(
      "type" => "dropdown",
      "heading" => "Size",
      "param_name" => "size",
        "value" => array(
        "Normal" => "100%",
        "Medim" => "200%",
        "Large" => "300%",
        "X-Large" => "400%",
      )
  ),
   array(
      "type" => "dropdown",
      "heading" => "Style",
      "param_name" => "style",
        "value" => array(
        "Clock" => "clock",
        "Inline text" => "text",
      )
  ),
    array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Text Before",
    "param_name" => "before",
    "value" => ""
  ),
  array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Text After",
    "param_name" => "after",
    "value" => ""
  ),
  array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Translation - Plural",
    "param_name" => "t_plural",
    "value" => "s",
    "description" => 'The plural ending character. F.ex Hour<strong>(s)</strong>, Week<strong>(s)</strong>'
  ),
  array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Translation - Week",
    "param_name" => "t_week",
    "value" => ""
  ),
  array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Translation - Day",
    "param_name" => "t_day",
    "value" => ""
  ),
  array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Translation - Hour",
    "param_name" => "t_hour",
    "value" => ""
  ),
  array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Translation - Minute",
    "param_name" => "t_min",
    "value" => ""
  ),
  array(
    "type" => "textfield",
    "class" => "",
    "heading" => "Translation - Secound",
    "param_name" => "t_sec",
    "value" => ""
  ),
 );
break;

} // end shortcode switch

?><?php
// build shortcode options
echo '<div id="shortcode-editor">';
echo '<div class="ux-shortcode-group-tabs">';
echo '<a href="#" data-grouping="Settings">Settings</a>';
$group_check = '';
foreach ($options as $group_title) {
  if(isset($group_title['group'])){
      if($group_check != $group_title['group']){
         echo  '<a href="#" data-grouping="'.$group_title['group'].'">'.$group_title['group'].'</a>';
         $group_check = $group_title['group'];
      }

  }
}
  echo '</div>';

echo '<div class="ux-shortcode-fields">';
foreach ($options as $option) {

  if(isset($option['group']) && $option['group']){
    echo '<div class="ux-shortcode-group" data-group="'.$option['group'].'">';
  } else {
    echo '<div class="ux-shortcode-group" data-group="Settings">';
  }
  // textfield
 if ( $option['type'] == 'textfield' ) { ?> 
   <h3><?php echo $option['heading']; ?></h3>
  <div class="ux-option">
    <input type="text" data-id="<?php echo  $option['param_name'] ?>" value="<?php echo $option['value']; ?>">
    <small><?php if(isset($option['description'])) echo $option['description']; ?></small>
  </div>
  <?php } 

  // dropdown
 else if ( $option['type'] == 'dropdown' ) { ?>
  <h3><?php echo $option['heading']; ?></h3>
  <div class="ux-option">
  <select data-id="<?php echo  $option['param_name'] ?>">
    <option value="">Default</option>
    <?php foreach ($option['value'] as $value => $key) {
        echo '<option value="'.$key.'">'.$value.'</option>';
    } ?>
  </select>
  <small><?php if(isset($option['description'])) echo $option['description']; ?></small>
</div>
 <?php }  

 // colorpicker
  else if ( $option['type'] == 'colorpicker' ) { ?>
  <h3><?php echo $option['heading']; ?></h3>
  <div class="ux-option">
  <input type="text" data-id="<?php echo  $option['param_name'] ?>" value="" placeholder="Default: <?php echo $option['value']; ?>" class="ux-color-picker" />
  <small><?php if(isset($option['description'])) echo $option['description'];  ?></small>
  </div>
  <?php } // colorpicker


  // imageselect
  else if ( $option['type'] == 'attach_image' ) { ?>
  <h3><?php echo $option['heading']; ?></h3>
  <div class="ux-option">
  <div class="attach-image-upload" data-upload="<?php echo  $option['param_name'] ?>">
  <input data-id="<?php echo  $option['param_name'] ?>" placeholder="Enter image url or #hexcode"/><a href="#" class="button">Select</a>
  </div>
  <small><?php if(isset($option['description'])) echo $option['description'];  ?></small>

  </div>
  <script>
    /* upload image */
    jQuery('.attach-image-upload[data-upload="<?php echo  $option['param_name'] ?>"] a').click(function(){
        ux_UploadImage('.attach-image-upload[data-upload="<?php echo  $option['param_name'] ?>"]');
    });
  </script>

  <?php } // image select

  //checkbox
  else if ( $option['type'] == 'checkbox' ) { ?>
  <h3><?php echo $option['heading']; ?></h3>
  <div class="ux-option">
      <div class="ux-edit-checkbox">
      <input style="display:none;" type="text" data-id="<?php echo  $option['param_name'] ?>"/>
      <?php foreach ($option['value'] as $key => $value) { ?>
        <input type="checkbox"  name="vehicle" value="<?php echo $value; ?>"/><?php echo $key; ?>
      <?php } ?>
      </div>
      <small><?php if(isset($option['description'])) echo $option['description']; ?></small>
  </div>

  <?php } 


  //block
  else if ( $option['type'] == 'select_block' ) { ?>
  <?php  $args = array(
      'posts_per_page'   => 9999,
      'offset'           => 0,
      'category'         => '',
      'orderby'          => 'title',
      'order'            => 'ASC',
      'include'          => '',
      'exclude'          => '',
      'meta_key'         => '',
      'meta_value'       => '',
      'post_type'        => 'blocks',
      'post_mime_type'   => '',
      'post_parent'      => '',
      'suppress_filters' => true 
    );


  $categories = get_posts($args); 
  $data = '<select id="block-select" data-id="'.$option['param_name'].'" style="margin-bottom:15px">';
  $data .= '<option value="">Select Block</option>';
  foreach($categories as $category) {
      $selected = '';
      $permalink = get_the_permalink($category->ID);
      if ($option['value']!=='' && $category->post_name === $option['value']) {
           $selected = ' selected="selected"';
      }
      $data .= '<option data-link="'.$permalink.'" data-block="'.$category->ID.'" value="'.$category->post_name.'"'.$selected.'>' . $category->post_title . '</option>';
  }
  $data .= '</select>';
  echo $data; ?>
  <iframe class="block-iframe" src=""/>
  <script>jQuery( document ).ready(function($) {  
  $('.ux-shortcode-group-tabs').remove();
  $('#block-select').change(function(){
    var data_id = $(this).find('option:selected').data('block');
    var data_link = $(this).find('option:selected').data('link');
    $('.block-iframe').attr('src',data_link);   
  });

  });</script>
  <small><?php if(isset($option['description'])) echo $option['description']; ?></small>
  <?php } // Block


  //product category
  else if ( $option['type'] == 'product_category' ) { ?>
  <h3><?php echo $option['heading']; ?></h3>
  <div class="ux-option">
  <?php 
      $categories = get_terms('product_cat'); 
      $data = '<select name="'.$option['param_name'].'" data-id="'.$option['param_name'].'">';
      $data .= '<option class="none" value="">All</option>';
      foreach($categories as $category) {
          $selected = '';
          if ($option['value']!=='' && $category->slug === $option['value']) {
               $selected = ' selected="selected"';
          }
          $data .= '<option class="'.$category->slug.'" value="'.$category->slug.'"'.$selected.'>' . $category->name . ' (' . $category->count . ' products)</option>';
      }
      $data .= '</select>'; 
      echo $data;
  ?>
  <small><?php if(isset($option['description'])) echo $option['description']; ?></small>
</div>

  <?php } 


  //product category by ID
  else if ( $option['type'] == 'product_category_id' ) { ?>
      <h3><?php echo $option['heading']; ?></h3>
        <div class="ux-option">

        <?php 
        $categories = get_terms('product_cat'); 
        $data = '<select name="'.$option['param_name'].'" data-id="'.$option['param_name'].'">';
        $data .= '<option value="">All Categories</option>';
        $data .= '<option value="0">All Categories - No subcategories</option>';
        $data .= '<option value="" disabled>-----</option>';
        foreach($categories as $category) {
            $selected = '';
            if ($option['value']!=='' && $category->term_id === $option['value']) {
                 $selected = ' selected="selected"';
            }
            $data .= '<option class="'.$category->term_id.'" value="'.$category->term_id.'"'.$selected.'>' . $category->name . '</option>';
        }
        $data .= '</select>';
        echo $data;
    ?>
    <small><?php if(isset($option['description'])) echo $option['description']; ?></small>
  </div>

  <?php }

   //Featured items
  else if ( $option['type'] == 'featured_items_category' ) { ?>
      <h3><?php echo $option['heading']; ?></h3>
       <div class="ux-option">
      <?php 
      $categories = get_terms('featured_item_category');
      $data = '<select name="'.$option['param_name'].'" data-id="'.$option['param_name'].'">';
      $data .= '<option class="none" value="">All</option>';
      foreach($categories as $category) {
          $selected = '';
          if ($option['value']!=='' && $category->slug === $option['value']) {
               $selected = ' selected="selected"';
          }
          $data .= '<option class="'.$category->slug.'" value="'.$category->slug.'"'.$selected.'>' . $category->name . ' (' . $category->count . ' items)</option>';
      }
      $data .= '</select>';
      echo $data;
  ?>
  <small><?php if(isset($option['description'])) echo $option['description']; ?></small>
</div>
  <?php } 


     //IMAGE SELECT
  else if ( $option['type'] == 'image_select' ) { ?>
      <h3><?php echo $option['heading']; ?></h3>
      <div class="ux-option">
       <div class="ux-image-select" data-images="<?php echo  $option['param_name'] ?>">
          <input data-id="<?php echo  $option['param_name'] ?>" style="display:none;" />
          <?php foreach ($option['value'] as $value => $key) {

            $title = '';
            // Split value
            if(strpos($key,',') !== false) {
                $split = explode(",", $key);
                $key = $split[0];
                $title = $split[1];
            }
          
            echo '<a href="#" data-select="'.$key.'"><img src="'.$value.'"/>'.$title.'</a>';
        } ?>
       </div>
      <small><?php if(isset($option['description'])) echo $option['description']; ?></small>

      <script>
       jQuery( document ).ready(function($) {
              var id = "<?php echo $option['param_name'] ?>";
              setTimeout(function(){
               var current = $('[data-images='+id+'] input').val();
               $('[data-images='+id+'] a[data-select="'+current+'"]').addClass('selected');
              }, 100);

              $('[data-images='+id+'] a').click(function(e){
                  $('[data-images='+id+'] a').removeClass('selected');
                  $(this).addClass('selected');

                  $('[data-images='+id+'] input[data-id="'+id+'"]').val($(this).data('select')).change();
                  e.preventDefault();
              });
          });
       </script>
     </div>

  <?php } 


  echo '</div>';

}
echo '</div>';