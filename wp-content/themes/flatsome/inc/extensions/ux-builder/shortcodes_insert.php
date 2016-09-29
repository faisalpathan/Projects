<?php 

$builder_url = get_template_directory_uri().'/inc/extensions/ux-builder/';
$temp_image = get_template_directory_uri().'/css/temp.jpg';

$default_elements ='
      <li><a href="#" class="ux-add-div" data-shortcode="ux_slider">Slider<textarea>[ux_slider] [/ux_slider]</textarea></a></li>
      <li><a href="#" class="ux-add-div has-lightbox" data-shortcode="ux_banner">Banner</a></li>
      <li><a href="#" class="ux-add-div has-lightbox" data-shortcode="elements">Element</a></li>
      <li><a href="#" class="ux-add-div" data-shortcode="text">Text <textarea><h3>Lorem ipsum ipsum</h3>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.re</textarea></a></li>
      <li><a href="#" class="ux-add-div" data-shortcode="image">Image <textarea>[ux_image]</textarea></a></li>
      <li><a href="#" class="ux-add-div has-lightbox" data-shortcode="products">Shop</a></li>
      <li><a href="#" class="ux-add-div" data-shortcode="block">Block <textarea>[block]</textarea></a></li>
      <li><a href="#" class="ux-add-div" data-shortcode="gap">Gap <textarea>[gap height="30px"]</textarea></a></li>
      <li><a href="#" class="ux-add-div has-lightbox" data-shortcode="code">Code</a></li>

      ';

?>

<div class="ux-add-section" data-add-section="root">
<ul class="ux-add-list">
      <li><a href="#" class="ux-add-div has-lightbox"  data-shortcode="section">Section</a></li>
      <li><a href="#" class="ux-add-div has-lightbox" data-shortcode="row">Row / Columns</a></li>
      <?php echo $default_elements; ?>
</ul>
</div><!-- Add section root -->


<div class="ux-add-section" data-add-section="row">
<ul class="ux-add-list">
      <li><a href="#" class="ux-add-div">1 / 1<textarea>[col span="1/1"] [/col]</textarea></a></li>
      <li><a href="#" class="ux-add-div">1 / 2<textarea>[col span="1/2"] [/col]</textarea></a></li>
      <li><a href="#" class="ux-add-div">1 / 3<textarea>[col span="1/3"] [/col]</textarea></a></li>
      <li><a href="#" class="ux-add-div">2 / 3<textarea>[col span="2/3"] [/col]</textarea></a></li>
      <li><a href="#" class="ux-add-div">1 / 4<textarea>[col span="1/4"] [/col]</textarea></a></li>
      <li><a href="#" class="ux-add-div">2 / 4<textarea>[col span="2/4"] [/col]</textarea></a></li>
      <li><a href="#" class="ux-add-div">3 / 4<textarea>[col span="3/4"] [/col]</textarea></a></li>
      <li><a href="#" class="ux-add-div">Divider<textarea>[col span="1/1"][divider][/col]</textarea></a></li>
</ul>
</div><!-- columns in row -->

<!-- Insert code -->
<div class="ux-add-section" data-add-section="code">
  <ul class="ux-add-list">
        <li><a href="#" class="ux-add-div">1 / 1<textarea>[col span="1/1"] [/col]</textarea></a></li>
  </ul>
</div><!-- columns in row -->



<div class="ux-add-section" data-add-section="ux_slider">
<ul class="ux-add-list">
      <li><a href="#" class="ux-add-div has-lightbox" data-shortcode="ux_banner">Banner</a></li>
      <li><a href="#" class="ux-add-div" data-shortcode="ux_banner">Banner Grid<textarea>[ux_banner_grid height="600px" grid="1"][/ux_banner_grid]</textarea></a></li>
      <li><a href="#" class="ux-add-div" data-shortcode="ux_image">Image<textarea>[ux_image]</textarea></a></li>
      <li><a href="#" class="ux-add-div" data-shortcode="logo">Logo<textarea>[logo src="imageurl"]</textarea></a></li>
</ul>
</div><!-- Add section root -->


<div class="ux-add-section" data-add-section="tabgroup">
<ul class="ux-add-list">
      <li><a href="#" class="ux-add-div" data-shortcode="tab">Tab<textarea>[tab title="Tab title"]Tab Content[/tab]</textarea></a></li>
</ul>
</div><!-- Add tab -->

<div class="ux-add-section" data-add-section="tabgroup_vertical">
<ul class="ux-add-list">
      <li><a href="#" class="ux-add-div" data-shortcode="tab">Tab<textarea>[tab title="Tab title"]Tab Content[/tab]</textarea></a></li>
</ul>
</div><!-- Add tab -->

<div class="ux-add-section" data-add-section="accordion">
<ul class="ux-add-list">
      <li><a href="#" class="ux-add-div" data-shortcode="accordion-item">Accordion Item<textarea>[accordion-item title="Tab title"]Tab Content[/accordion-item]</textarea></a></li>
</ul>
</div><!-- Add tab -->


<div class="ux-add-section" data-add-section="ux_price_table">
<ul class="ux-add-list">
      <li><a href="#" class="ux-add-div" data-shortcode="bullet_item">Bullet item<textarea>[bullet_item title="Enter text here.."]</textarea></a></li>
</ul>
</div><!-- Add tab -->



<div class="ux-add-section" data-add-section="ux_banner_grid">
<ul class="ux-add-list">
      <li><a href="#" class="ux-add-div has-lightbox" data-shortcode="ux_banner">Banner</a></li>
      <li><a href="#" class="ux-add-div" data-shortcode="ux_slider">Slider<textarea>[ux_slider][/ux_slider]</textarea></a></li>
</ul>
</div><!-- Add section root -->


<div class="ux-add-section" data-add-section="ux_banner">
<ul class="ux-add-list">
      <li><a href="#" class="ux-add-div">Text<textarea><h3>Headline</h3><p>Chage this text to anything</p></textarea></a></li>
      <li><a href="#" class="ux-add-div">Button<textarea>[button]</textarea></a></li>
      <li><a href="#" class="ux-add-div">Divider<textarea>[divider]</textarea></a></li>
      <li><a href="#" class="ux-add-div">Countdown<textarea>[ux_countdown year="2016" month="12" day="30" time="24:00" size="300%" style="clock"]</textarea></a></li>
      <li><a href="#" class="ux-add-div">Image<textarea>[ux_image]</textarea></a></li>
</ul>
</div><!-- Add section root -->


<div class="ux-add-section" data-add-section="default">
<ul class="ux-add-list">
         <?php echo $default_elements; ?>
</ul>
</div><!-- Add section default -->



<!-- Sections-->
<div class="ux-lightbox" data-add="section">
      <div class="ux-lightbox-inner ux-centered">
         <ul class="ux-add-list">
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_default.jpg'; ?>"/><textarea>[section padding="60px" parallax_text="0" parallax="0" margin="0px"] [/section]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_light.jpg'; ?>"/><textarea>[section bg="http://imageurl" padding="60px" parallax_text="0" parallax="0" margin="0px"] [/section]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_dark.jpg'; ?>"/><textarea>[section bg="http://imageurl" dark="true"  padding="60px" parallax_text="0" parallax="0" margin="0px"] [/section]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_parallax.jpg'; ?>"/><textarea>[section bg="http://imageurl"  dark="true" padding="60px" parallax_text="0" parallax="3" margin="0px"] [/section]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_text_parallax.jpg'; ?>"/><textarea>[section bg="http://imageurl"  dark="true" padding="60px" parallax_text="3" parallax="1" margin="0px"] [/section]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_video.jpg'; ?>"/><textarea>[section dark="true" video_mp4="http:/videourl" video_ogv="http://videourl" video_webm="http://videourl" padding="30px" margin="0px"] [/section]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_image_right.png'; ?>"/><textarea>[section dark="true" bg="#000" img="http://imageurl" img_pos="right" img_width="50%" img_margin="0" padding="60px" margin="0px"] [row] [col span="1/2"] Add content here [/col] [col span="1/2"]  [/col] [/row] [/section]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_image_left.png'; ?>"/><textarea>[section dark="true" bg="#000" img="http://imageurl" img_pos="left" img_width="50%" img_margin="0" padding="60px" margin="0px"] [row] [col span="1/2"]  [/col] [col span="1/2"] Add content here [/col] [/row] [/section]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_image_top.png'; ?>"/><textarea>[section dark="true" bg="#000" img="http://imageurl" img_pos="top" img_width="100%" img_margin="0" padding="60px" margin="0px"] [row] [col span="1/1"] Add content here [/col] [/row] [/section]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/section_image_bottom.png'; ?>"/><textarea>[section dark="true" bg="#000" img="http://imageurl" img_pos="bottom" img_width="100%" img_margin="0" padding="60px" margin="0px"] [row] [col span="1/1"] Add content here [/col]  [/row] [/section]</textarea></a></li>
        </ul>
           <div class="lightbox-tools bottom">
                    <a href="#" class="close-lightbox button media-button button-secondary button-large">Cancel</a>
            </div>
      </div>
</div>


<!-- Rows / Columns -->
<div class="ux-lightbox" data-add="row">
      <div class="ux-lightbox-inner ux-centered">
         <ul class="ux-add-list">
            <li><a href="#" class="ux-add-div" data-shortcode="row"><img src="<?php echo $builder_url.'img/shortcodes/col_1_1.jpg'; ?>"/><span>1/1 - Full Width</span><textarea>[row] [col span="1/1"]  [/col] [/row]</textarea></a></li>
            <li><a href="#" class="ux-add-div" data-shortcode="row"><img src="<?php echo $builder_url.'img/shortcodes/col_1_2.jpg'; ?>"/><span>1/2 | 1/2 </span><textarea>[row] [col span="1/2"]  [/col] [col span="1/2"]  [/col] [/row]</textarea></a></li>
            <li><a href="#" class="ux-add-div" data-shortcode="row"><img src="<?php echo $builder_url.'img/shortcodes/col_1_3.jpg'; ?>"/><span>1/3 | 1/3 | 1/3 </span><textarea>[row] [col span="1/3"]  [/col] [col span="1/3"]  [/col][col span="1/3"]  [/col] [/row]</textarea></a></li>
            <li><a href="#" class="ux-add-div" data-shortcode="row"><img src="<?php echo $builder_url.'img/shortcodes/col_1_4.jpg'; ?>"/><span>1/4 | 1/4 | 1/4 | 1/4</span><textarea>[row] [col span="1/4"]  [/col] [col span="1/4"]  [/col][col span="1/4"]  [/col][col span="1/4"]  [/col] [/row]</textarea></a></li>
            <li><a href="#" class="ux-add-div" data-shortcode="row"><img src="<?php echo $builder_url.'img/shortcodes/col_1_4_2_4_1_4.jpg'; ?>"/><span>1/4 | 2/4 | 1/4</span><textarea>[row] [col span="1/4"]  [/col] [col span="2/4"]  [/col][col span="1/4"]  [/col] [/row]</textarea></a></li>
            <li><a href="#" class="ux-add-div" data-shortcode="row"><img src="<?php echo $builder_url.'img/shortcodes/col_1_4_3_4.jpg'; ?>"/><span>1/4 | 3/4</span><textarea>[row] [col span="1/4"] [/col] [col span="3/4"]  [/col] [/row]</textarea></a></li>
        </ul>
             <div class="lightbox-tools bottom">
                    <a href="#" class="close-lightbox button media-button button-secondary button-large">Cancel</a>
            </div>
      </div>
</div>


<!--Add Code -->
<div class="ux-lightbox" data-add="code">
      <div class="ux-lightbox-inner ux-centered">
            <div style="margin:30px;">
              <textarea style="display:block!important;width:100%;height:300px;" placeholder="Paste shortcodes here"></textarea>
            </div>     
             <div class="lightbox-tools bottom">
                    <a href="#" class="close-lightbox button media-button button-secondary button-large">Cancel</a>
                    <a href="#" class="ux-add-div ux-get-code button media-button button-primary button-large">Insert</a>
            </div>
      </div>
</div>



<!-- Elements -->
<div class="ux-lightbox" data-add="elements">
      <div class="ux-lightbox-inner">
         <ul class="ux-add-list">
             <li><a href="#" class="ux-add-div" data-shortcode="ux_banner_grid"><img src="<?php echo $builder_url.'img/shortcodes/element_banner_grid.jpg'; ?>"/><span>UX Banner Grid</span><textarea>[ux_banner_grid] [/ux_banner_grid]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="blog_posts"><img src="<?php echo $builder_url.'img/shortcodes/element_blogposts.jpg'; ?>"/><span>Blog Posts</span><textarea>[blog_posts image_height="200px" columns="3" posts="8"]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="title"><img src="<?php echo $builder_url.'img/shortcodes/element_title.jpg'; ?>"/><span>Title</span><textarea>[title text="Title text" style="center"]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="divider"><img src="<?php echo $builder_url.'img/shortcodes/element_divider.jpg'; ?>"/><span>Divider</span><textarea>[divider width="small"]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="button"><img src="<?php echo $builder_url.'img/shortcodes/element_buttons.jpg'; ?>"/><span>Button</span><textarea>[button text="Button" link="http://"]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="follow_share"><img src="<?php echo $builder_url.'img/shortcodes/element_follow_share.jpg'; ?>"/><span>Follow icons</span><textarea>[follow twitter="http://" facebook="http://" email="email@post.com" pinterest="http://" rss="http://" instagram="http://" googleplus="http://"]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="follow_share"><img src="<?php echo $builder_url.'img/shortcodes/element_follow_share.jpg'; ?>"/><span>Share icons</span><textarea>[share]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="map"><img src="<?php echo $builder_url.'img/shortcodes/element_map.jpg'; ?>"/><span>Map</span><textarea>[map lat="48.89364" long="2.33739" height="500px" color="#58728a" zoom="17"]Enter Map content here[/map]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="message_box"><img src="<?php echo $builder_url.'img/shortcodes/element_messagebox.jpg'; ?>"/><span>Message Box</span><textarea>[message_box bg="#000" text_color="light"]Enter message text here. <a class="button white alt-button" href="#link">Button</a>[/message_box]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="accordion"><img src="<?php echo $builder_url.'img/shortcodes/element_accordion.jpg'; ?>"/><span>Accordion</span><textarea>[accordion title="Title"][accordion-item title="Accordion title"]Accordion content[/accordion-item][accordion-item title="Accordion title"]Accordion content[/accordion-item][accordion-item title="Accordion title"]Accordion content[/accordion-item][/accordion]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="tabs"><img src="<?php echo $builder_url.'img/shortcodes/element_tabs.jpg'; ?>"/><span>Tabs</span><textarea>[tabgroup style="normal"][tab title="Tab title"]Enter content here[/tab][tab title="Tab title"]Enter content here[/tab][tab title="Tab title"]Enter content here[/tab][/tabgroup]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="vertical_tabs"><img src="<?php echo $builder_url.'img/shortcodes/element_vertical_tabs.jpg'; ?>"/><span>Vertical Tabs</span><textarea>[tabgroup_vertical][tab title="Tab title"]Enter content here[/tab][tab title="Tab title"]Enter content here[/tab][tab title="Tab title"]Enter content here[/tab][/tabgroup_vertical]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="testemoial"><img src="<?php echo $builder_url.'img/shortcodes/element_testimonial.jpg'; ?>"/><span>Testimonial</span><textarea>[testimonial image="http://imageurl" name="Author name" company="Company name" stars="5"] Add testimonial text here [/testimonial]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="team_member"><img src="<?php echo $builder_url.'img/shortcodes/element_team_member.jpg'; ?>"/><span>Team Member</span><textarea>[team_member name="Name" title="Title" facebook="http://" twitter="http://" pinterest="http://"  img="http://imageurl"]Team member description[/team_member]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="featured_box"><img src="<?php echo $builder_url.'img/shortcodes/element_featured_box.jpg'; ?>"/><span>Featured Box</span><textarea>[featured_box title="Title text" img="http://iconurl" img_width="" pos="center" link=""]Featured box text[/featured_box]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="featured_items"><img src="<?php echo $builder_url.'img/shortcodes/element_featured_items.jpg'; ?>"/><span>Featured Items</span><textarea>[featured_items_slider style="1" items="8" cat="" height="250px"][featured_items_grid style="1" items="8" cat="" height="250px"]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="tabs"><img src="<?php echo $builder_url.'img/shortcodes/element_price_table.jpg'; ?>"/><span>Price Table</span><textarea>[ux_price_table title="Enter title here.." price="99$" description="Enter description here..." button_style="primary" button_link="http://link"][bullet_item text="Enter text here.."][bullet_item text="Enter text here.."][bullet_item text="Enter text here.."][/ux_price_table]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="scroll_to"><img src="<?php echo $builder_url.'img/shortcodes/element_scroll_to.jpg'; ?>"/><span>Scroll To</span><textarea>[scroll_to link="#unique_id" title="Enter a title"]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="search"><img src="<?php echo $builder_url.'img/shortcodes/element_search_box.jpg'; ?>"/><span>Search Box</span><textarea>[search]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="form"><img src="<?php echo $builder_url.'img/shortcodes/element_form.jpg'; ?>"/><span>Ninja Form</span><textarea>[ninja_forms_display_form id="1"]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="lightbox"><img src="<?php echo $builder_url.'img/shortcodes/element_lightbox.jpg'; ?>"/><span>Lightbox</span><textarea>  <a href="#lightbox"> Lightbox link </a> [button text="Lightbox button" link="#lightbox"] [lightbox id="lightbox" width="600px" padding="20px"] Add lightbox content here... [/lightbox]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="logo"><img src="<?php echo $builder_url.'img/shortcodes/element_logo.jpg'; ?>"/><span>Logo</span><textarea>[logo img="imageurl" padding="10px" height="50px"]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="ux_instagram_feed"><img src="<?php echo $builder_url.'img/shortcodes/element_insta.jpg'; ?>"/><span>Instagram Feed</span><textarea>[ux_instagram_feed username="yourusername" photos="999" text="Show more.."]</textarea></a></li>
             <li><a href="#" class="ux-add-div" data-shortcode="ux_countdown"><img src="<?php echo $builder_url.'img/shortcodes/element_countdown.jpg'; ?>"/><span>Countdown</span><textarea>[ux_countdown year="2016" month="12" day="30" time="24:00" size="400%" style="clock"]</textarea></a></li>

         </ul>
            <div class="lightbox-tools bottom">
                    <a href="#" class="close-lightbox button media-button button-secondary button-large">Cancel</a>
            </div>
      </div>
</div>

<!-- Products -->
<div class="ux-lightbox" data-add="products">
      <div class="ux-lightbox-inner">
         <ul class="ux-add-list">
          <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_list.jpg'; ?>"/><span>Products List</span><textarea> [ux_products_list title="Products"]</textarea></a></li>
             <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_bestsellers.jpg'; ?>"/><span>Featured</span><textarea>[ux_featured_products products="" columns="4" title="Check our Featured" products!"]</textarea></a></li>
             <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_bestsellers.jpg'; ?>"/><span>Bestsellers</span><textarea>[ux_bestseller_products products="" columns="4" title="Check our bestsellers!"]</textarea></a></li>
             <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_on_sale.jpg'; ?>"/><span>On Sale</span><textarea>[ux_sale_products columns="4" title="Check our Products on Sale!"]</textarea></a></li>
             <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_bestsellers.jpg'; ?>"/><span>Latest</span><textarea>[ux_latest_products columns="4" title="Check our Latest products!"]</textarea></a></li>
             <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_bestsellers.jpg'; ?>"/><span>Custom Category</span><textarea>[ux_custom_products cat="select" products="" columns="4" title="Check our bestsellers!"]</textarea></a></li>
             <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_product_flip.jpg'; ?>"/><span>Flip Book</span><textarea> [ux_product_flip products="8" height="500"]</textarea></a></li>
             <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_lookbook.jpg'; ?>"/><span>Lookbook</span><textarea>[product_lookbook  products="8"]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_pinterest.jpg'; ?>"/><span>Pinterest Style</span><textarea>[products_pinterest_style products=""  columns="4"]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_categories.jpg'; ?>"/><span>Category Slider</span><textarea>[ux_product_categories number="10" parent="0" columns="4" title="Our categories" ]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_categories.jpg'; ?>"/><span>Category List</span><textarea>[product_categories number="10" parent="0" columns="4" title="Our categories" ]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/products_cat_grid.jpg'; ?>"/><span>Category Grid</span><textarea>[ux_product_categories_grid number="22" parent="0"]</textarea></a></li>
            <li class="ux-divider">Default WooCommerce Shortcodes:</li>
             <li><a href="#" class="ux-add-div">Add to Cart button<textarea>[add_to_cart id="#" sku=""#]</textarea></a></li>
             <li><a href="#" class="ux-add-div">Product by SKU<textarea>[product id="#" sku="#"]</textarea></a></li>
             <li><a href="#" class="ux-add-div">Products by SKU<textarea>[product_category category="" per_page="12" columns="4" orderby="date" order="desc"]</textarea></a></li>
             <li><a href="#" class="ux-add-div">Recent products<textarea>[recent_products per_page="12" columns="4" orderby="date" order="desc"]</textarea></a></li>
             <li><a href="#" class="ux-add-div">Featured products<textarea>[featured_products per_page="12" columns="4" orderby="date" order="desc"]</textarea></a></li>
             <li><a href="#" class="ux-add-div">Page: Checkout<textarea>[woocommerce_checkout]</textarea></a></li>
             <li><a href="#" class="ux-add-div">Page: Cart<textarea>[woocommerce_cart] </textarea></a></li>
             <li><a href="#" class="ux-add-div">Page: My Account<textarea>[woocommerce_my_account]</textarea></a></li>
             <li><a href="#" class="ux-add-div">Page: Order Tracking<textarea>[woocommerce_order_tracking]</textarea></a></li>

         </ul>
            <div class="lightbox-tools bottom">
                    <a href="#" class="close-lightbox button media-button button-secondary button-large">Cancel</a>
            </div>
      </div>
</div>


<!-- UX BANNER -->
<div class="ux-lightbox" data-add="ux_banner">
      <div class="ux-lightbox-inner">
         <ul class="ux-add-list">
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_1.jpg'; ?>"/><textarea>[ux_banner height="600px" text_color="dark" animated="fadeIn" text_width="40%" text_align="center" text_pos="left center" parallax="0" parallax_text="0" ] <h3 class="alt-font">Women Tank Tops</h3> <p>___</p> <h1 class="animated fadeInLeft uppercase">HOT Summer Singlet</h1> <h3 class="animated fadeInRight">Now 19$</h3> <p>___</p> <a class="button alt-button primary" title="" href="#">Shop now</a>[/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_3.jpg'; ?>"/><textarea>[ux_banner height="600px" text_color="light" animated="fadeIn" text_width="60%" text_align="center" text_pos="center" parallax="0" parallax_text="0" ] <h3 class="alt-font">It has Finally started...</h3> <p>___</p> <h1 class="h-large">HUGE SALE</h1> <h1>UP TO 70% OFF</h1> <p>___</p> <p><a class="button alt-button white" title="" href="#">Shop men</a> <a class="button alt-button white" title="" href="#">Shop sale</a> <a class="button alt-button white" title="" href="#">Shop Women</a></p>[/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_4.jpg'; ?>"/><textarea>[ux_banner height="600px" text_color="light" animated="fadeIn" text_width="40%" text_align="center" text_pos="right center" parallax="0" parallax_text="0" ] <h3 class="alt-font">Easy to customize...</h3> <p>___</p> <h1 class="animated fadeInLeft">THIS TEXT IS</h1> <h2 class="animated fadeInRight">EASY TO CHANGE</h2> <p>___</p> <a class="button" title="" href="#">Browse products</a>[/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_5.jpg'; ?>"/><textarea>[ux_banner height="600px" text_color="light" animated="fadeIn" text_width="40%" text_align="left" text_pos="left center" text_bg="#000" parallax="0" parallax_text="0" ] <h3 class="alt-font">Welcome to our Shop</h3> <p>___</p> <h1 class="animated fadeInLeft uppercase">COME ON IN AND SAY HI</h1> <p>___</p> <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p><p><a class="button alt-button white" title="" href="#">Learn more..</a></p>[/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_6.jpg'; ?>"/><textarea>[ux_banner height="500px" text_color="dark" animated="fadeIn" text_width="35%" text_align="center" text_pos="right center" text_bg="#FFF" parallax="0" parallax_text="0" ]<h3 class="alt-font">Coming soon..</h3> <p>___</p> <h2 class="animated fadeInLeft uppercase">SUMMER / SPRING 2015 BREECHES</h2> <p>___</p> <a class="button alt-button" title="" href="#">Browse now</a>[/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_7.jpg'; ?>"/><textarea>[ux_banner height="300px" link="#" text_color="light" animated="fadeIn" text_width="50%" text_align="center" text_pos="center" parallax="0" parallax_text="0"] <h1 class="text-boarder-top-bottom-white">SUMMER VIBE</h1> [/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_13.jpg'; ?>"/><textarea>[ux_banner height="600px" text_color="light" animated="fadeIn" text_width="45%" text_align="left" text_pos="right center" parallax="0" parallax_text="0" ] <h4 class="alt-font ">Beautiful User Experience</h4> <h1><strong>GO FLATSOME</strong></h1> <p>Duis bibendum lorem non velit sodales sollicitudin. Vestibulum sed diam felis. Vivamus malesuada placerat pulvinar risus. </p> <p><a class="button white" title="" href="#">LEARN MORE</a> <a class="button alt-button white" title="" href="#">BROWSE</a></p>[/ux_banner]</textarea></a></li>

            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_8.jpg'; ?>"/><textarea>[ux_banner height="600px" text_color="light" animated="fadeIn" text_width="60%" text_align="center" text_pos="center" parallax="0" parallax_text="0" ] <h1 class="text-boarder-top-bottom-white">HIPSTER AGENCY</h1> <a class="button alt-button white" title="" href="#">Button text</a> <a class="button alt-button white" title="" href="#">Button text</a> <a class="button alt-button white" title="" href="#">Button text</a>[/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_9.jpg'; ?>"/><textarea>[ux_banner height="600px" text_color="light" animated="fadeIn" text_width="60%" text_align="center" text_pos="center" parallax="0" parallax_text="0" ] <h1 class="text-bordered-white">CREATIVE AGENCY</h1> <p>___</p> <a class="button alt-button white" title="" href="#">Button text</a> <a class="button alt-button white" title="" href="#">Button text</a>[/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_10.jpg'; ?>"/><textarea>[ux_banner height="600px" text_color="dark" animated="fadeIn" text_width="40%" text_align="left" text_pos="left center" parallax="0" parallax_text="0" ] <h2 class="uppercase">INCREDIBLE RESPONSIVE, With A Clean Design</h2> <h4 class="thin-font">The Multi-Purpose Business and eCommerce Wordpress Theme</h4> <p>___</p> <a class="button alt-button" href="http://#">SHOP NOW</a>[/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_11.jpg'; ?>"/><textarea>[ux_banner height="600px" text_color="light" animated="fadeIn" text_width="40%" text_align="left" text_pos="far-left center" parallax="0" parallax_text="0"] <h2 class="thin-font"><strong>Multi-Purpose</strong> Business and <strong>eCommerce</strong> Wordpress Theme with an Incredible <strong>User Experience</strong></h2> <p>___</p> <a class="button white" href="http://#">MAIN LINK</a> <a class="button alt-button white" href="http://">SECONDARY LINK</a>[/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_14.jpg'; ?>"/><textarea>[ux_banner height="400px" text_color="dark" animated="fadeIn" text_align="center" text_pos="full-width bottom" text_bg="#FFF" padding="10px" parallax="0" parallax_text="0"] <h4 class="thin-font">NEWS FOR WOMEN</h4> <h2 class="uppercase">2015 summer Style</h2> <h4><span style="text-decoration: underline;"><strong>SHOP NOW</strong></span></h4> [/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_2.jpg'; ?>"/><textarea>[ux_banner height="260px" link="#" text_color="light" animated="fadeIn" parallax="0" parallax_text="0" ] <h2 class="uppercase">Join our competition</h2> <p>___</p> [/ux_banner]</textarea></a></li>
            <li><a href="#" class="ux-add-div"><img src="<?php echo $builder_url.'img/shortcodes/banner_12.jpg'; ?>"/><textarea>[ux_banner height="400px" text_color="light" animated="fadeIn" text_width="66%" text_align="center" text_pos="center" parallax="0" parallax_text="0" ] <h1 class="text-boarder-top-bottom-white">NEW ARRIVALS</h1> <a class="button alt-button white" href="http://#">SHOP NOW</a>[/ux_banner]</textarea></a></li>

            </ul>
             <strong style="padding:15px;">TIP: Add normal Image instead of Banner if you want the image / slider to crop normal on smaller screens.</strong>

               <div class="lightbox-tools bottom">
                    <a href="#" class="close-lightbox button media-button button-secondary button-large">Cancel</a>
            </div>
 
      </div>
</div>