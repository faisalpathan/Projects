jQuery(document).ready(function(){
  var zoom = 1.1
  move = 0;

  if(navigator.userAgent.match(/(iPod|iPhone|iPad)/)){
    jQuery('#videos-block').css('background-attachment','scroll');  // iosfix
  }

  var aj_qashi = jQuery(".before_blog").width()/2 + 15;
  jQuery('head').append('<style>.before_blog:before{right:'+aj_qashi+'px !important;}</style>');

  /*---- GO_TO_TOP ----*/
  jQuery( window ).scroll(function() {
    var height = jQuery(window).scrollTop();
    if(height > 400){
      jQuery('#go-to-top').css('display', 'inline');
    }
    else {
      jQuery('#go-to-top').css('display', 'none');
    }
  });
  jQuery('#go-to-top').click(function(){
    jQuery("html, body").animate({ scrollTop: 0 }, 600);
    return false;
  });
  /*---- ACTIVE_MENU ----*/
  jQuery( window ).scroll(function() {
    var height = jQuery(window).scrollTop();
    if(jQuery('#top-posts').length==1) var height_canvas  = jQuery('#top-posts').offset().top - 650;

    if(jQuery('#wd-categories-tabs').length==1) var height_canvas1 = jQuery('#wd-categories-tabs').offset().top - 650;
    else var height_canvas1 = 0;

    if(jQuery('#videos-block').length==1) var height_canvas2 = jQuery('#videos-block').offset().top - 650;
    else var height_canvas2 = 0;

    if(jQuery('#blog_home').length==1) var height_canvas3 = jQuery('#blog_home').offset().top - 650;
    else var height_canvas3 = 0;

    if(jQuery('#portfolio-block').length==1) var height_canvas4 = jQuery('#portfolio-block').offset().top - 650;
    else var height_canvas4 = 0;

    if(jQuery('#contact_us').length==1) var height_canvas5 = jQuery('#contact_us').offset().top - 650;
    else var height_canvas5 = 0;


    /*--- Top Posts ---*/
    if(height  > height_canvas + 450 && height < height_canvas1 + 400) {
      jQuery('a[href$="top_posts"]').parent().addClass('active_menu');
      var active_menu = jQuery('a[href$="top_posts"]').parent().attr('id');
    }
    else { jQuery('a[href$="top_posts"]').parent().removeClass('active_menu') }
    /*--- Category Tabs ---*/
    if(height  > height_canvas1 + 450 && height < height_canvas2 + 400) {
      jQuery('a[href$="category_tabs"]').parent().addClass('active_menu');
      var active_menu = jQuery('a[href$="category_tabs"]').parent().attr('id');
    }
    else { jQuery('a[href$="category_tabs"]').parent().removeClass('active_menu') }
    /*--- Featured Posts ---*/
    if(height  > height_canvas2 + 450 && height < height_canvas3 + 400) {
      jQuery('a[href$="featurd_post"]').parent().addClass('active_menu');
      var active_menu = jQuery('a[href$="featurd_post"]').parent().attr('id');
    }
    else { jQuery('a[href$="featurd_post"]').parent().removeClass('active_menu') }
    /*--- Content Posts ---*/
    if(height  > height_canvas3 + 450 && height < height_canvas4 + 400) {
      jQuery('a[href$="blog"]').parent().addClass('active_menu');
      var active_menu = jQuery('a[href$="blog"]').parent().attr('id');
    }
    else { jQuery('a[href$="blog"]').parent().removeClass('active_menu') }
    /*--- Portfolio ---*/
    if(height  > height_canvas4 + 450 && height < height_canvas5 + 400) {
      jQuery('a[href$="portfolio"]').parent().addClass('active_menu');
      var active_menu = jQuery('a[href$="portfolio"]').parent().attr('id');
    }
    else { jQuery('a[href$="portfolio"]').parent().removeClass('active_menu') }
    /*--- Portfolio ---*/
    if(height  > height_canvas5 + 450) {
      jQuery('a[href$="contact_us"]').parent().addClass('active_menu');
      var active_menu = jQuery('a[href$="contact_us"]').parent().attr('id');
    }
    else { jQuery('a[href$="contact_us"]').parent().removeClass('active_menu') }
  });
  /*----- NAVIGATION_MENU ------*/
  var cat_tab_is_animated = 0;
  jQuery('#top-nav li:has(> ul)').addClass('haschild');

  jQuery("#top-nav > div > ul  li,#top-nav > div > div > ul  li").hover(function() {
    if(matchMedia('only screen and (max-width : 767px)').matches){return false;}
    jQuery(this).parent("ul").children().removeClass("active");

    jQuery(this).addClass("active");
    jQuery(this).find("ul").eq(0).css({'z-index': jQuery(this).css('z-index')+1});
    /*horizontall scroll prevention*/

    {
      if(jQuery(this).find('ul').eq(0).length){
        open_submenu = jQuery(this).find('ul').eq(0);
        sub_left = open_submenu.offset().left;
        sub_width = open_submenu.width();
        current_left = open_submenu.position().left;
        parent_class = function(classname) {

          return open_submenu.parent().parent().hasClass(classname);
        }

        if(current_left + /*parent_left +*/  sub_left + sub_width > jQuery(window).width() ){
          if(!jQuery(this).parent().hasClass("sub-menu")){
            open_submenu.addClass('first_sub_shift');
          }
          else if(parent_class('sub_shift')){
            /*parent also shifted*/
            /* parent_w = open_submenu.parent().parent().width();*/
            open_submenu.addClass('sub_d_shift');
            /* open_submenu.css({left:current_left + jQuery(window).width()-24 - parent_w- sub_left - sub_width });  */
          }
          else{
            open_submenu.addClass('sub_shift');
            jQuery(this).addClass('sub_shift_parent');
            //open_submenu.css({left:current_left + jQuery(window).width()-24 - sub_left - sub_width });
          }
        }
      }
    }

  }, function(){
    if(matchMedia('only screen and (max-width : 767px)').matches){return false;}
    jQuery(this).parent("ul").children().removeClass("active");
    jQuery(".opensub").removeClass("opensub");
    /*jQuery(this).find('.sub_shift').removeClass('sub_shift');
     jQuery(this).find('.sub_d_shift').removeClass('sub_d_shift');*/
  });

  jQuery(window).resize(function(){
    wdwt_reset_submenus();

  });

  jQuery("#top-nav > div > ul  li.haschild > a,#top-nav > div > div > ul  li.haschild > a").click(function(){
    if(matchMedia('only screen and (max-width : 767px)').matches) {
      if(jQuery(this).parent().hasClass("open")) {
        jQuery(this).parent().parent().find(".haschild ul").slideUp(100);
        jQuery(this).parent().removeClass("open");
        return false;
      }
      jQuery(this).parent().parent().find(".haschild ul").slideUp(100);
      jQuery(this).parent().parent().find(".haschild").removeClass("open");
      jQuery(this).next("ul").slideDown("fast");
      jQuery(this).parent().addClass("open");
      return false;
    }
  });

  jQuery( '#top-nav ul  li > a:not(#top-nav li.haschild > a)').on('click' , function(){ /* the same code as in wdwt_attach_event_addedli, cannot delegate*/
    if(matchMedia('only screen and (max-width : 767px)').matches) {
      jQuery("#header #top-nav").slideUp("fast");
      jQuery("#top-nav").removeClass("open");
    }
  });

  jQuery("#header .phone-menu-block").on("click","#phone-menu-toggle,#menu-button-block:not(.title-img)", function() {
    if(jQuery("#top-nav").hasClass("open")){
      jQuery("#header #top-nav").slideUp("fast");
      jQuery("#top-nav").removeClass("open");
    }
    else {
      jQuery("#header #top-nav").slideDown("slow");
      jQuery("#top-nav").addClass("open");
    }
  });
  /*---- TOP_POSTS -----*/
  if(jQuery('#top-posts').length==1){
    jQuery("#top_posts_list > li").addClass('animate');
    var call_once = 0;
    jQuery( window ).scroll(function() {
      var height = jQuery(window).scrollTop();
      var height_canvas = jQuery('#top-posts').offset().top - 500;
      if(height  > height_canvas) {
        if (call_once==0){
          call_once++;
          jQuery("#top_posts_list > li").addClass(business_elite_effects.top_post_effect);
        }
      }
    });
  }
  /*---- CATEGORIES_TABS ------*/
  jQuery("#wd-categories-tabs ul.tabs li a").click(function() {
    if(jQuery(this).parent().hasClass("active")){return false;}
    if(cat_tab_is_animated) return false;
    cat_tab_is_animated=1;
    jQuery("#wd-categories-tabs ul.tabs li").removeClass("active");
    var id=jQuery(this).attr("href").replace("#","");
    var width_of_catigory_tab_li=jQuery("#wd-categories-tabs ul.content > li.active").eq(0).width();
    jQuery(this).parent().addClass("active");
    if(jQuery("#wd-categories-tabs ul.content > li.active").eq(0).index()>jQuery("#categories-tabs-content-"+id).index()){
      jQuery("#wd-categories-tabs ul.content > li.active").animate({'left': width_of_catigory_tab_li+"px"},{duration:500,complete:function() { jQuery(this).removeClass("active");jQuery(this).css("display","none").css("left","0px"); cat_tab_is_animated=0;} });
      jQuery("#categories-tabs-content-"+id).attr('style','left:-'+width_of_catigory_tab_li+'px');
      jQuery("#categories-tabs-content-"+id).show();
      jQuery("#categories-tabs-content-"+id).animate({'left':'0px'},{duration:500,complete:function() { jQuery(this).addClass("active")} });
    }
    else {
      jQuery("#wd-categories-tabs ul.content > li.active").animate({'left':"-" + width_of_catigory_tab_li+"px"},{duration:500,complete:function() { jQuery(this).removeClass("active");jQuery(this).css("display","none").css("left","0px");cat_tab_is_animated=0; } });
      jQuery("#categories-tabs-content-"+id).attr('style','left:'+width_of_catigory_tab_li+'px');
      jQuery("#categories-tabs-content-"+id).show();
      jQuery("#categories-tabs-content-"+id).animate({'left':'0px'},{duration:500,complete:function() { jQuery(this).addClass("active"); cat_tab_is_animated=0;} });
    }
    return false;
  }).stop();

  /*---- CATEGORIES_TABS_PHONE -----*/
  var count=jQuery("#wd-categories-tabs ul.tabs li").length;
  count=count-1;
  function nextTab(count) {
    if(count==0) return false;
    var isactive=jQuery("#wd-categories-tabs ul.tabs li.active").next().index();
    var width_of_catigory_tab_li=jQuery("#wd-categories-tabs ul.content > li.active").eq(0).width();
    if(cat_tab_is_animated) return false;
    cat_tab_is_animated=1;
    if(isactive==-1){isactive=0;}
    jQuery("#wd-categories-tabs ul.tabs li").removeClass("active");
    jQuery("#wd-categories-tabs ul.tabs li").eq(isactive).addClass("active");

    jQuery("#wd-categories-tabs ul.content > li.active").animate({'left': width_of_catigory_tab_li+"px"},{duration:0,complete:function() {
      jQuery(this).removeClass("active");jQuery(this).css("display","none").css("left","0px"); cat_tab_is_animated=0; } });
    jQuery("#wd-categories-tabs ul.content > li").eq(isactive).attr('style','left:-'+width_of_catigory_tab_li+'px');
    jQuery("#wd-categories-tabs ul.content > li").eq(isactive).show();
    jQuery("#wd-categories-tabs ul.content > li").eq(isactive).animate({'left':'0px'},{duration:0,complete:function() { jQuery(this).addClass("active"); cat_tab_is_animated=0;} });
  }
  function prevTab(count){
    if(count==0) return false;
    var isactive=jQuery("#wd-categories-tabs ul.tabs li.active").prev().index();
    var width_of_catigory_tab_li=jQuery("#wd-categories-tabs ul.content > li.active").eq(0).width();
    if(cat_tab_is_animated) return false;
    cat_tab_is_animated=1;
    if(isactive==-1){isactive=count;}
    jQuery("#wd-categories-tabs ul.tabs li").removeClass("active");
    jQuery("#wd-categories-tabs ul.tabs li").eq(isactive).addClass("active");

    jQuery("#wd-categories-tabs ul.content > li.active").animate({'left':'-'+ width_of_catigory_tab_li+"px"},{duration:0,complete:function() { jQuery(this).removeClass("active");
      jQuery(this).css("display","none").css("left","0px");cat_tab_is_animated=0; } });
    jQuery("#wd-categories-tabs ul.content > li").eq(isactive).attr('style','left:'+width_of_catigory_tab_li+'px');
    jQuery("#wd-categories-tabs ul.content > li").eq(isactive).show();
    jQuery("#wd-categories-tabs ul.content > li").eq(isactive).animate({'left':'0px'},{duration:0,complete:function() { jQuery(this).addClass("active"); cat_tab_is_animated=0;} });
  }
  jQuery(".categories-tabs-rightt").click(function(){nextTab(count);});
  jQuery(".categories-tabs-leftt").click(function(){prevTab(count);});

  jQuery("#wd-categories-tabs ul.content > li.active .text").eq(0).addClass("active");

  jQuery( "#wd-categories-tabs ul.content > li ul" ).on('click', 'li', function() {
    jQuery("#wd-categories-tabs ul.content > li.active ul li .text").css("display", "none");
    jQuery("#wd-categories-tabs ul.content > li.active .text").removeClass("active");
    var active_tab = jQuery(this).index();
    jQuery("#wd-categories-tabs ul.content > li.active .text").eq(active_tab).addClass("active");
  });
  /*------ FEATURED_POSTS --------*/
  if(jQuery('#videos-block').length==1){
    jQuery("#videos-block .full-width").addClass('animate');
    var call_once2 = 0;
    jQuery( window ).scroll(function() {
      var height = jQuery(window).scrollTop();
      var height_canvas2 = jQuery('#videos-block').offset().top - 300;
      if(height  > height_canvas2) {
        if (call_once2==0){
          call_once2++;
          jQuery("#videos-block .full-width").addClass(business_elite_effects.feautured_effect);
        }
      }
    });
  }
  /*---- CONTENT_POSTS -----*/
  business_elite_content_posts_start = 200;
  business_elite_content_posts_animated = false;
  jQuery( window ).scroll(function() {
    if(jQuery('.slide-in-right').length!==0){
      var height = jQuery(window).scrollTop();

      if( !business_elite_content_posts_animated ){
        if(jQuery(window).scrollTop()>=(jQuery('.slide-in-right').eq(0).offset().top-jQuery(window).height())){

          for (var i = 0; i < jQuery('.slide-in-right').length+1; ++i) {

            setTimeout(function() {
              jQuery('.slide-in-right').not('.animate').eq(0).addClass('animate');
            },business_elite_content_posts_start);
            business_elite_content_posts_start+=400;
          }
          business_elite_content_posts_start = 200;
          business_elite_content_posts_animated = true;
        }

      }
    }
  });
  /*---- PORTFOLIO_POSTS ----*/
  if(jQuery('#portfolio-block').length==1){
    jQuery("#portfolio-block li").addClass('animate');
    var call_once3 = 0;
    jQuery( window ).scroll(function() {
      var height = jQuery(window).scrollTop();
      var height_canvas4 = jQuery('#portfolio-block').offset().top - 300;
      if(height  > height_canvas4) {
        if (call_once3==0){
          call_once3++;
          jQuery("#portfolio-block li").addClass(business_elite_effects.portfolio_effect);
        }
      }
    });
  }
  /*---- CONTACT_HOME -----*/
  if(jQuery('#contact_us').length==1){
    jQuery("#contact_us .cont_us_top > li").addClass('animate');
    var call_once4 = 0;
    jQuery( window ).scroll(function() {
      var height = jQuery(window).scrollTop();
      var height_canvas5 = jQuery('#contact_us').offset().top - 300;
      if(height  > height_canvas5) {
        if (call_once4==0){
          call_once4++;
          jQuery("#contact_us .cont_us_top > li").addClass(business_elite_effects.contact_effect);
        }
      }
    });
  }
  /*----- GALERY_PAGE -------*/
  if(jQuery('.page-gallery').length==1){
    /* Image Hover */
    jQuery(document).ready(function(){
      jQuery(function() {
        jQuery('ul.da-thumbs > li').hoverdir();
      });
    });
  }
  /*----- FOR_IMAGES -----*/
  var image_covering={
    class_of_images_parent:'post_image',
    cavering:function() {
      width_of_parent=jQuery('.'+this.class_of_images_parent).width();
      heght_of_parent=jQuery('.'+this.class_of_images_parent).height();
      if(width_of_parent && heght_of_parent)
        kaificent_parent=heght_of_parent/width_of_parent;
      else
        kaificent_parent=31/37;
      jQuery('.'+this.class_of_images_parent+' > img').each(function(index, element) {
        jQuery(this).css('width','');
        jQuery(this).css('height','');
        width=jQuery(this).attr('width');
        height=jQuery(this).attr('height');
        if(!(width && height)){
          width=jQuery(this).width()
          height=jQuery(this).height();
        }
        kaificent_loc=height/width;
        if(kaificent_loc<=kaificent_parent) {
          jQuery(this).width( heght_of_parent*(1/kaificent_loc) );
          jQuery(this).height(heght_of_parent );
        }
        else {
          jQuery(this).width( width_of_parent);
          jQuery(this).height( width_of_parent*kaificent_loc );
        }
      });
    }
  }

  /*---- MENU_SCROLLING -----*/
  active_menu_item = '';
  active_scroll_item = '';
  array_of_elements={
    /* name from_menu : #id */
    'top_posts':'top-posts',
    'category_tabs':'wd-categories-tabs',
    'featurd_post':'videos-block',
    'blog':'blog_home',
    'portfolio':'portfolio-block',
    'contact_us':'contact_us'
  };

  /*goto item when url is pasted with hash*/
  if(business_elite_is_front == '1' && window.location.hash){
    var target = '';
    for(element in array_of_elements){
      if(element == window.location.hash.substring(1)){
        target = array_of_elements[element];
      }
    }
    wdwt_go_to(target);
  }

  activ_element = '';
  activ_key = '';
  if (typeof(localStorage) != 'undefined' ) {
    active_scroll_item = localStorage.getItem("activ_scroling_item");
  }

  if(active_scroll_item){
    wdwt_go_to(array_of_elements[active_scroll_item]);

    if (typeof(localStorage) != 'undefined' ) {
      localStorage.setItem("activ_scroling_item", '');
    }
  }
  jQuery('#top-nav a').each(function(){
    menu_elem = this;

    wdwt_scrollto_menuitem(menu_elem);
  });






  function menuHide(){
    jQuery("#top-nav").css('display','none');
    jQuery("#top-nav").removeClass('open');
  }
  if(matchMedia('only screen and (max-width : 767px)').matches){
    jQuery('#top_posts_out, .wd_tabs_dynamic, #videos-block, #blog_home, #portfolio-block, #contact_us, #blog').click(function(){
      menuHide();
    });
  }
});


function wdwt_reset_submenus(){
  /*reset submenu openings*/
  jQuery('#top-nav > div ul.sub-menu').css({left:''});
  jQuery('#top-nav > div ul.sub_shift').removeClass('sub_shift');
  jQuery('#top-nav > div ul.sub_d_shift').removeClass('sub_d_shift');
  jQuery('#top-nav > div ul.sub_d_shift').removeClass('first_sub_shift');
  jQuery('#top-nav .sub_shift_parent').removeClass('sub_shift_parent');

}


function wdwt_front_ajax_pagination(page, action, container, args){
  var data_send = {};

  if(typeof args != 'undefined'){
    for (var prop in args) {
      data_send[prop] = args[prop];
    }
  }

  data_send.action = 'wdwt_front_'+action;
  data_send.paged = page;


  jQuery.post(business_elite_admin_ajax, data_send, function(data) {
    if(action == 'content_posts'){
      business_elite_content_posts_animated = false;
      wdwt_go_to('blog_home_out');
    }
    if(action == 'top_posts'){
      wdwt_go_to('top_posts_out');
    }
    jQuery(container).html(data);

  }).success(function(jqXHR, textStatus, errorThrown) {

  });
}

function wdwt_attach_event_addedli($menu_elem){
  $menu_elem.on('click', function(){
    if(matchMedia('only screen and (max-width : 767px)').matches) {
      jQuery("#header #top-nav").slideUp("fast");

      jQuery("#top-nav").removeClass("open");
    }
  });
}


function wdwt_scrollto_menuitem(menu_elem){
  menu_href = jQuery(menu_elem).attr('href');

  if(typeof menu_href != 'undefined' && menu_href.indexOf("#")!=-1){



    jQuery(menu_elem).click(function() {
      if(jQuery(menu_elem).parent().hasClass('menu-item-has-children') &&
        (matchMedia('only screen and (max-width : 1024px)').matches)){
        /*opened submenu in mobile view*/
        /* in this case scroll should not trigger sticky menu*/
        return false;
      }

      menu_href = jQuery(menu_elem).attr('href');

      /*front page , no customizer*/
      if(typeof wp.customize === 'undefined' && (document.location.href.substr(0, document.location.href.indexOf("#"))== business_elite_site_url || document.location.href.substr(0, document.location.href.indexOf("#"))== business_elite_site_url+'?' || document.location.href == business_elite_site_url )){

        loc_this=menu_elem;
        jQuery.each(array_of_elements,function(index,value){
          if(jQuery(loc_this).attr('href').indexOf(index) >= 0){
            wdwt_go_to(value);

          }
        });
        /*homepage link is clicked*/
        if((jQuery(loc_this).attr('href') == business_elite_site_url + "#" ) || (jQuery(loc_this).attr('href') == business_elite_site_url + "/#" ) || (jQuery(loc_this).attr('href') == business_elite_site_url + "?#" )){
          jQuery("html, body").animate({ scrollTop: 0 }, 600);
          return false;
        }
        //
        return false;
      }
      /*front page , customizer*/
      else if(typeof wp.customize  !== 'undefined' && business_elite_is_front){

        hash = menu_href.split('#')[1];
        var target = array_of_elements[hash];
        wdwt_go_to(target);
        //jQuery('body').animate({ scrollTop: target.offset().top- target.height()},800);
        return false;
      }
      /*not front page*/
      else{

        loc_this=menu_elem;
        jQuery.each(array_of_elements,function(index,value){
          if(jQuery(loc_this).attr('href').indexOf(index) >= 0){
            activ_key=index;
            activ_element=value;
          }
        });
        if (typeof(localStorage) != 'undefined' ) {
          localStorage.setItem("activ_scroling_item", activ_key);
        }
        window.location = business_elite_site_url;
      }


      return false;
    });
  }
}


/**
 * @param value : id of element to scroll to
 */
function wdwt_go_to(value, tuned){

  if (value == '#' || jQuery('#'+value).length == 0) {
    jQuery("html, body").animate({scrollTop: 0}, 600);
    return;
  }


  wdwt_goto_y = jQuery('#'+value).offset().top;
  wdwt_goto_x = jQuery('#'+value).offset().left;

  if(wdwt_sticky_menu == '0'){
    var wdwt_goto_y1 = 0;
  }
  else{
    if(jQuery('#header.sticky_menu').length){ // already sticky
      var wdwt_goto_y1 = jQuery('#header').height();
    }
    else{ // should be opened
      var wdwt_goto_y1 = (matchMedia('only screen and (max-width : 767px)').matches) ? jQuery('#header').height()+68 : jQuery('#header').height();
    }
  }

  if(jQuery('#wpadminbar').length == 1){
    if(matchMedia('only screen and (max-width : 767px)').matches){
      var wdwt_goto_y2 = 0;
    }else{
      var wdwt_goto_y2 = jQuery('#wpadminbar').height();
    }

  }
  else{
    var wdwt_goto_y2 = 0;
  }

  jQuery(window).scrollTo( '#'+value, 800,
    {'offset':{'top':-wdwt_goto_y2-wdwt_goto_y1,'left':-wdwt_goto_x},
      onAfter: function(){
        if(typeof tuned != 'undefined'){
          //fine tuning iteration happened
          return ;
        }
        wdwt_go_to(value, 'fine_tuned');

      }
    }
  );
}