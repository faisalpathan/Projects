var businessEliteCurSize = 'screen';
var business_elite_slider_imgs = [];
jQuery('document').ready(function(){
	jQuery('.cont_vat_tab ul.content > li').filter(function() { return jQuery(this).css("display")!='none'}).addClass('active');
	jQuery('#wd-categories-tabs > .tabs > li').eq(0).addClass('active');
	sliderHeight = parseInt(jQuery("#slider-wrapper").height());
	sliderWidth = parseInt(jQuery("#slider-wrapper").width());
	sliderIndex = sliderHeight/sliderWidth;

	/*keep iframe, video and embed aspect ratios when resizing the window*/
	var allVideos = jQuery("iframe, object, embed");

	allVideos.each(function() {

		var el = jQuery(this);

		jQuery(this)
		// jQuery .data does not work on object/embed elements
			.attr('data-aspectRatio', this.height / this.width)
			.attr('data-origWidth', this.width)
			.removeAttr('height')
			.removeAttr('width');

	});



	if(matchMedia('only screen and (max-width : 767px)').matches){
		phone();
	}
	else if (matchMedia('only screen and (min-width: 768px) and (max-width: 1024px)').matches){
		tablet();
	}
	else{checkMedia();}

	jQuery(window).resize(function(){checkMedia();});

	/*in phone and tablet modes, menu links with submenu should not work*/
	jQuery("body #top-nav > div > ul li.menu-item-has-children>a").on('click', function(){
		if(matchMedia('only screen and (max-width : 1024px)').matches){
			return false;
		}
	});


	function checkMedia(){
		//################SCREEN
		if(matchMedia('only screen and (min-width: 1025px)').matches){screen();}
		//################TABLET
		if (matchMedia('only screen and (min-width: 768px) and (max-width: 1024px)').matches){ tablet(); }
		//################PHONE
		if(matchMedia('only screen and (max-width : 767px)').matches){ phone(false); }

		/*fix sticky menu after resize if layout has been changed*/
		if(jQuery(window).scrollTop()>100 && !jQuery('#top-nav').hasClass('open')) {
			/*i stycky menu option enabled*/
			if(wdwt_sticky_menu == 1){
				jQuery( "#header .container, #header" ).addClass('sticky_menu');
				sticky_menu();
			}

		}
	}
	function screen(){
		for(ii=0;ii<jQuery('.content-post').length;ii++){
			if(ii%2!=0){
				jQuery('.content-post > img').eq(ii).before(jQuery('.content-post > div').eq(2*ii+1));
			}
		}

		if(full_width_business_elite == 1){
			jQuery("#top-nav-list").css({'text-align':'center'});
		}

		sHeight = sliderIndex * parseInt(jQuery("#slider-wrapper").width());
		sliderSize(sHeight);
		wdwt_resize_iframes();

		if(businessEliteCurSize == 'phone'){

			jQuery(".hide_on_phone .bwg_slideshow_image").each(function(index, el){
				jQuery(this).attr("src",business_elite_slider_imgs[index]);
			});
			if(jQuery("#header-middle img").length) {
				jQuery("#header .container").prepend(jQuery("#header-middle"));
			}
			jQuery("#header-middle").prepend(jQuery("#logo"));
			jQuery("aside .sidebar-container .widget-area").removeClass("clear");

			jQuery("#top-nav .sub-menu").css("display","");
			jQuery("#top-nav").removeClass("open");
		}
		if(businessEliteCurSize == 'tablet' || businessEliteCurSize == 'phone'){
			/*homepage content, others blog*/
			jQuery('.container > #content').before(jQuery('#sidebar1'));
			jQuery('.container > #blog').before(jQuery('#sidebar1'));

			jQuery("#header").find("#menu-button-block").remove();
			jQuery("#top-nav").css({"display":"block"});

			jQuery("#top-nav > div li.addedli").remove();
			/*hide submenu in case of window resize and submenu opened*/
			jQuery("#top-nav > div li.open > ul").removeAttr('style')
			jQuery("#top-nav > div li.open").addClass('active').removeClass('open');

		}

		jQuery('.cont_vat_tab ul.content').height(jQuery('.cont_vat_tab ul.content > li.active').filter(function() { return jQuery(this).css("display") != "none" }).height());
		businessEliteCurSize	= 'screen';
	}
	function tablet() {
		if(businessEliteCurSize == 'screen') {
			/*homepage content, others blog*/
			jQuery('.container>#content').after(jQuery('#sidebar1'));
			jQuery('.container>#blog').after(jQuery('#sidebar1'));
		}

		if(businessEliteCurSize == 'phone') {
			jQuery(".hide_on_phone .bwg_slideshow_image").each(function(index, el){
				jQuery(this).attr("src",business_elite_slider_imgs[index]);
			});
			if(jQuery("#header-middle img").length) {
				jQuery("#header .container").prepend(jQuery("#header-middle"));
			}
			jQuery("#header").find("#menu-button-block").remove();
			jQuery("#top-nav").css({"display":"block"});
			jQuery("aside .sidebar-container .widget-area").removeClass("clear");
			jQuery("#top-nav .sub-menu").css("display","");
			jQuery("#top-nav > div li.open, #top-nav").removeClass('open');
		}
		jQuery('.cont_vat_tab ul.content').height(jQuery('.cont_vat_tab ul.content > li.active').filter(function() { return jQuery(this).css("display") != "none" }).height())

		sHeight = sliderIndex * parseInt(jQuery("#slider-wrapper").width());
		sliderSize(sHeight);
		wdwt_resize_iframes();

		if(businessEliteCurSize == 'screen' ) {

			/* TABLET UNIQUE STYLES */
			jQuery("#top-nav > div > ul  li:has(> ul),#top-nav > div > div > ul  li:has(> ul)").each(function() {
				var strtext = jQuery(this).children("a").html();
				var strhref = jQuery(this).children("a").attr("href");
				var strlink = '<a href="' + strhref + '">' + strtext + '</a>';
				jQuery(this).children("ul").prepend('<li class="addedli">' + strlink + '</li>');
				jQuery(this).find('.addedli a').each(function(){
					menu_elem = this;
					wdwt_attach_event_addedli(jQuery(this));
					wdwt_scrollto_menuitem(menu_elem);
				});
			});
		}
		businessEliteCurSize	= 'tablet';
	}

	function phone(full) {
		/*homepage content, others blog*/
		jQuery('.container>#content').after(jQuery('#sidebar1'));
		jQuery('.container>#blog').after(jQuery('#sidebar1'));

		sHeight = sliderIndex * parseInt(jQuery("#slider-wrapper").width());
		sliderSize(sHeight);
		wdwt_resize_iframes();
		/* PHONE UNIQUE STYLES */
		jQuery("#top-nav > div > ul  li.addedli,#top-nav > div > div > ul  li.addedli").remove();
		jQuery("#top-nav > div > ul  li:has(> ul),#top-nav > div > div > ul  li:has(> ul)").each(function() {
			var strtext = jQuery(this).children("a").html();
			var strhref = jQuery(this).children("a").attr("href");
			var strlink = '<a href="' + strhref + '">' + strtext + '</a>';
			jQuery(this).children("ul").prepend('<li class="addedli">' + strlink + '</li>');
			jQuery(this).find('.addedli a').each(function(){
				menu_elem = this;
				wdwt_attach_event_addedli(jQuery(this));
				wdwt_scrollto_menuitem(menu_elem);
			});

		});

		if(businessEliteCurSize != 'phone'){
			jQuery(".hide_on_phone .bwg_slideshow_image").each(function(){
				business_elite_slider_imgs.push(jQuery(this).attr("src"));
				jQuery(this).attr("src","");
			});

			jQuery("#header").find("#menu-button-block").remove();
			var menu_content = '<div id="menu-button-block" class="title-img"><div id="phone-menu-toggle"></div><span id="trigram-for-heaven"></span></div>';
			if(!jQuery("#header-middle img").length) {
				menu_content = '<div id="menu-button-block"><a href="#">Menu</a><span id="trigram-for-heaven"></span></div>';
			}
			jQuery("#header .phone-menu-block").append(menu_content);
			if(jQuery("#header-middle img").length) {
				jQuery("#menu-button-block").prepend(jQuery("#header-middle"));
			}
		}
		for(var i=0;i<jQuery("aside .sidebar-container .widget-area").length;i++){
			if (i%2 == 0){jQuery("aside .sidebar-container .widget-area").eq(i).addClass("clear");}
		}

		if(!jQuery("#top-nav").hasClass("open")){jQuery("#top-nav").css({"display":"none"})};
		jQuery('.cont_vat_tab ul.content').height(jQuery('.cont_vat_tab ul.content > li.active').filter(function() { return jQuery(this).css("display") != "none" }).height())
		businessEliteCurSize	= 'phone';
	}
	function sliderSize(sHeight) {
		jQuery("#slider-wrapper").css('height',sHeight);
	}
	function wdwt_resize_iframes(){
		var allVideos = jQuery("iframe, object, embed");

		allVideos.each(function() {

			var el = jQuery(this);
			fluidParent = el.parent();
			var newWidth = fluidParent.width();

			if(newWidth >= el.attr('data-origWidth')){
				newWidth = el.attr('data-origWidth');
			}
			el.width(newWidth)
				.height(newWidth * el.attr('data-aspectRatio'));

		});
	}

});