  var bwg_trans_in_progress = false;
  var bwg_transition_duration =  business_elite_slider_options.animation_speed;
	var bwg_playInterval;
	var kkk=1;
	/* Stop autoplay.*/
	window.clearInterval(bwg_playInterval);
	/* Set watermark container size.*/
	var bwg_current_key = '';
    
    function bwg_testBrowser_cssTransitions() {
        return bwg_testDom('Transition');
    }
	function bwg_testBrowser_cssTransforms3d() {
		return bwg_testDom('Perspective');
	}
	function bwg_testDom(prop) {
		/* Browser vendor CSS prefixes.*/
		var browserVendors = ['', '-webkit-', '-moz-', '-ms-', '-o-', '-khtml-'];
		/* Browser vendor DOM prefixes.*/
		var domPrefixes = ['', 'Webkit', 'Moz', 'ms', 'O', 'Khtml'];
		var i = domPrefixes.length;
		while (i--) {
			if (typeof document.body.style[domPrefixes[i] + prop] !== 'undefined') {
				return true;
			}
		}
		return false;
	}
	function bwg_cube(tz, ntx, nty, nrx, nry, wrx, wry, current_image_class, next_image_class, direction) {
		/* If browser does not support 3d transforms/CSS transitions.*/
		if (!bwg_testBrowser_cssTransitions()) {
			return bwg_fallback(current_image_class, next_image_class, direction);
		}
		if (!bwg_testBrowser_cssTransforms3d()) {
			return bwg_fallback3d(current_image_class, next_image_class, direction);
		}
		bwg_trans_in_progress = true;

		/* Set active thumbnail.*/
		jQuery(".bwg_slide_bg").css('perspective', 1000);
		jQuery(current_image_class).css({
			transform : 'translateZ(' + tz + 'px)',
			backfaceVisibility : 'hidden'
		});
		jQuery(next_image_class).css({
			opacity : 1,
			filter: 'Alpha(opacity=100)',
			backfaceVisibility : 'hidden',
			transform : 'translateY(' + nty + 'px) translateX(' + ntx + 'px) rotateY('+ nry +'deg) rotateX('+ nrx +'deg)'
		});
		jQuery(".bwg_slider").css({
			transform: 'translateZ(-' + tz + 'px)',
			transformStyle: 'preserve-3d'
		});
		/* Execution steps.*/
		setTimeout(function () {
			jQuery(".bwg_slider").css({
				transition: 'all ' + bwg_transition_duration + 'ms ease-in-out',
				transform: 'translateZ(-' + tz + 'px) rotateX('+ wrx +'deg) rotateY('+ wry +'deg)'
			});
		}, 20);
		/* After transition.*/
		jQuery(".bwg_slider").one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(bwg_after_trans));
		function bwg_after_trans() {
			/*if (bwg_from_focus) {
			bwg_from_focus = false;
			return;
			}*/
			jQuery(current_image_class).removeAttr('style');
			jQuery(next_image_class).removeAttr('style');
			jQuery(".bwg_slider").removeAttr('style');
			jQuery(current_image_class).css({'opacity' : 0, filter: 'Alpha(opacity=0)', 'z-index': 1});
			jQuery(next_image_class).css({'opacity' : 1, filter: 'Alpha(opacity=100)', 'z-index' : 2});
			bwg_trans_in_progress = false;
			if (typeof event_stack !== 'undefined' && event_stack.length > 0) {
				key = event_stack[0].split("-");
				event_stack.shift();
				bwg_change_image(key[0], key[1], data, true);
			}
		}
	}
	function bwg_cubeH(current_image_class, next_image_class, direction) {
		/* Set to half of image width.*/
		var dimension = jQuery(current_image_class).width() / 2;
		if (direction == 'right') {
			bwg_cube(dimension, dimension, 0, 0, 90, 0, -90, current_image_class, next_image_class, direction);
		}
		else if (direction == 'left') {
			bwg_cube(dimension, -dimension, 0, 0, -90, 0, 90, current_image_class, next_image_class, direction);
		}
	}
	function bwg_cubeV(current_image_class, next_image_class, direction) {
		/* Set to half of image height.*/
		var dimension = jQuery(current_image_class).height() / 2;
		/* If next slide.*/
		if (direction == 'right') {
			bwg_cube(dimension, 0, -dimension, 90, 0, -90, 0, current_image_class, next_image_class, direction);
		}
		else if (direction == 'left') {
			bwg_cube(dimension, 0, dimension, -90, 0, 90, 0, current_image_class, next_image_class, direction);
		}
	}
	/* For browsers that does not support transitions.*/
	function bwg_fallback(current_image_class, next_image_class, direction) {
		bwg_fade(current_image_class, next_image_class, direction);
	}
	/* For browsers that support transitions, but not 3d transforms (only used if primary transition makes use of 3d-transforms).*/
	function bwg_fallback3d(current_image_class, next_image_class, direction) {
		bwg_sliceV(current_image_class, next_image_class, direction);
	}
	function bwg_none(current_image_class, next_image_class, direction) {
		jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
		jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
		/* Set active thumbnail.*/
	}
	function bwg_fade(current_image_class, next_image_class, direction) {
		/* Set active thumbnail.*/
		if (bwg_testBrowser_cssTransitions()) {
			jQuery(next_image_class).css('transition', 'opacity ' + bwg_transition_duration + 'ms linear');
			jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
			jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
		}
		else {
			jQuery(current_image_class).animate({'opacity' : 0, 'z-index' : 1}, bwg_transition_duration);
			jQuery(next_image_class).animate({
			'opacity' : 1,
			'z-index': 2
			}, {
				duration: bwg_transition_duration,
				complete: function () {  }
			});
			/* For IE.*/
			jQuery(current_image_class).fadeTo(bwg_transition_duration, 0);
			jQuery(next_image_class).fadeTo(bwg_transition_duration, 1);
		}
	}
	
	function bwg_grid(cols, rows, ro, tx, ty, sc, op, current_image_class, next_image_class, direction) {
	
		/* If browser does not support CSS transitions.*/
		if (!bwg_testBrowser_cssTransitions()) {
			return bwg_fallback(current_image_class, next_image_class, direction);
		}
		bwg_trans_in_progress = true;
		/* Set active thumbnail.*/
		/* The time (in ms) added to/subtracted from the delay total for each new gridlet.*/
		var count = (bwg_transition_duration) / (cols + rows);
		/* Gridlet creator (divisions of the image grid, positioned with background-images to replicate the look of an entire slide image when assembled)*/
		function bwg_gridlet(width, height, top, img_top, left, img_left, src, imgWidth, imgHeight, c, r) {
			var delay = (c + r) * count;
			/* Return a gridlet element with styles for specific transition.*/
			return jQuery('<div class="bwg_gridlet" />').css({
				width : width,
				height : height,
				top : top,
				left : left,
				backgroundImage : 'url("' + src + '")',
				backgroundColor: jQuery(".bwg_slideshow_image_wrap").css("background-color"),
				/*backgroundColor: rgba(0, 0, 0, 0),*/
				backgroundRepeat: 'no-repeat',
				backgroundPosition : img_left + 'px ' + img_top + 'px',
				backgroundSize : imgWidth + 'px ' + imgHeight + 'px',
				transition : 'all ' + bwg_transition_duration + 'ms ease-in-out ' + delay + 'ms',
				transform : 'none'
			});
		}
		/* Get the current slider's image.*/
		var cur_img = jQuery(current_image_class).find('img');
		/* Create a grid to hold the gridlets.*/
		var grid = jQuery('<div />').addClass('bwg_grid');
		/* Pretend the grid to the next slide (i.e. so it's above the slide image).*/
		jQuery(current_image_class).prepend(grid);
		/* vars to calculate positioning/size of gridlets*/
		var cont = jQuery(".bwg_slide_bg");
		var imgWidth = cur_img.width();
		var imgHeight = cur_img.height();
		var contWidth = cont.width(),
		contHeight = cont.height(),
		imgSrc = cur_img.attr('src'),/*.replace('/thumb', ''),*/
		colWidth = Math.floor(contWidth / cols),
		rowHeight = Math.floor(contHeight / rows),
		colRemainder = contWidth - (cols * colWidth),
		colAdd = Math.ceil(colRemainder / cols),
		rowRemainder = contHeight - (rows * rowHeight),
		rowAdd = Math.ceil(rowRemainder / rows),
		leftDist = 0,
		img_leftDist = (jQuery(".bwg_slide_bg").width() - cur_img.width()) / 2;
		/* tx/ty args can be passed as 'auto'/'min-auto' (meaning use slide width/height or negative slide width/height).*/
		tx = tx === 'auto' ? contWidth : tx;
		tx = tx === 'min-auto' ? - contWidth : tx;
		ty = ty === 'auto' ? contHeight : ty;
		ty = ty === 'min-auto' ? - contHeight : ty;
		/* Loop through cols*/
		for (var i = 0; i < cols; i++) {
			var topDist = 0,
			img_topDst = (jQuery(".bwg_slide_bg").height() - cur_img.height()) / 2,
			newColWidth = colWidth;
			/* If imgWidth (px) does not divide cleanly into the specified number of cols, adjust individual col widths to create correct total.*/
			if (colRemainder > 0) {
				var add = colRemainder >= colAdd ? colAdd : colRemainder;
				newColWidth += add;
				colRemainder -= add;
			}
			/* Nested loop to create row gridlets for each col.*/
			for (var j = 0; j < rows; j++)  {
				var newRowHeight = rowHeight,
				newRowRemainder = rowRemainder;
				/* If contHeight (px) does not divide cleanly into the specified number of rows, adjust individual row heights to create correct total.*/
				if (newRowRemainder > 0) {
					add = newRowRemainder >= rowAdd ? rowAdd : rowRemainder;
					newRowHeight += add;
					newRowRemainder -= add;
				}
				/* Create & append gridlet to grid.*/
				grid.append(bwg_gridlet(newColWidth, newRowHeight, topDist, img_topDst, leftDist, img_leftDist, imgSrc, imgWidth, imgHeight, i, j));
				topDist += newRowHeight;
				img_topDst -= newRowHeight;
			}
			img_leftDist -= newColWidth;
			leftDist += newColWidth;
		}
		/* Set event listener on last gridlet to finish transitioning.*/
		var last_gridlet = grid.children().last();
		/* Show grid & hide the image it replaces.*/
		grid.show();
		cur_img.css('opacity', 0);
		/* Add identifying classes to corner gridlets (useful if applying border radius).*/
		grid.children().first().addClass('rs-top-left');
		grid.children().last().addClass('rs-bottom-right');
		grid.children().eq(rows - 1).addClass('rs-bottom-left');
		grid.children().eq(- rows).addClass('rs-top-right');
		/* Execution steps.*/
		setTimeout(function () {
			grid.children().css({
			opacity: op,
			transform: 'rotate('+ ro +'deg) translateX('+ tx +'px) translateY('+ ty +'px) scale('+ sc +')'
			});
		}, 100);
		jQuery(next_image_class).css('opacity', 1);
		/* After transition.*/
		jQuery(last_gridlet).one('webkitTransitionEnd transitionend otransitionend oTransitionEnd mstransitionend', jQuery.proxy(bwg_after_trans));

		function bwg_after_trans() {
		  /*if (bwg_from_focus) {
			bwg_from_focus = false;
			return;
		  }*/
		  jQuery(current_image_class).css({'opacity' : 0, 'z-index': 1});
		  jQuery(next_image_class).css({'opacity' : 1, 'z-index' : 2});
		  cur_img.css('opacity', 1);
		  grid.remove();
		  bwg_trans_in_progress = false;
		  if (typeof event_stack !== 'undefined' && event_stack.length > 0) {
			key = event_stack[0].split("-");
			event_stack.shift();
			bwg_change_image(key[0], key[1], data, true);
		  }
		}
	}

	function bwg_sliceH(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var translateX = 'min-auto';
		}
		else if (direction == 'left') {
			var translateX = 'auto';
		}
		bwg_grid(1, 8, 0, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
	}
	
	function bwg_sliceV(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var translateY = 'min-auto';
		}
		else if (direction == 'left') {
			var translateY = 'auto';
		}
		bwg_grid(10, 1, 0, 0, translateY, 1, 0, current_image_class, next_image_class, direction);
	}
	
	function bwg_slideV(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var translateY = 'auto';
		}
		else if (direction == 'left') {
			var translateY = 'min-auto';
		}
			bwg_grid(1, 1, 0, 0, translateY, 1, 1, current_image_class, next_image_class, direction);
	}
	function bwg_slideH(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var translateX = 'min-auto';
		}
		else if (direction == 'left') {
			var translateX = 'auto';
		}
		bwg_grid(1, 1, 0, translateX, 0, 1, 1, current_image_class, next_image_class, direction);
	}
	function bwg_scaleOut(current_image_class, next_image_class, direction) {
		bwg_grid(1, 1, 0, 0, 0, 1.5, 0, current_image_class, next_image_class, direction);
	}
	function bwg_scaleIn(current_image_class, next_image_class, direction) {
		bwg_grid(1, 1, 0, 0, 0, 0.5, 0, current_image_class, next_image_class, direction);
	}
	function bwg_blockScale(current_image_class, next_image_class, direction) {
		bwg_grid(8, 6, 0, 0, 0, .6, 0, current_image_class, next_image_class, direction);
	}
	function bwg_kaleidoscope(current_image_class, next_image_class, direction) {
		bwg_grid(10, 8, 0, 0, 0, 1, 0, current_image_class, next_image_class, direction);
	}
	function bwg_fan(current_image_class, next_image_class, direction) {
		if (direction == 'right') {
			var rotate = 45;
			var translateX = 100;
		}
		else if (direction == 'left') {
			var rotate = -45;
			var translateX = -100;
		}
		bwg_grid(1, 10, rotate, translateX, 0, 1, 0, current_image_class, next_image_class, direction);
	}
	function bwg_blindV(current_image_class, next_image_class, direction) {
		bwg_grid(1, 8, 0, 0, 0, .7, 0, current_image_class, next_image_class);
	}
	function bwg_blindH(current_image_class, next_image_class, direction) {
		bwg_grid(10, 1, 0, 0, 0, .7, 0, current_image_class, next_image_class);
	}
	function bwg_random(current_image_class, next_image_class, direction) {
		var anims = ['sliceH', 'sliceV', 'slideH', 'slideV', 'scaleOut', 'scaleIn', 'blockScale', 'kaleidoscope', 'fan', 'blindH', 'blindV'];
		/* Pick a random transition from the anims array.*/
		this["bwg_" + anims[Math.floor(Math.random() * anims.length)] + ""](current_image_class, next_image_class, direction);
	}
	function iterator() {
		var iterator = 1;
		if (0) {
		  iterator = Math.floor((data.length - 1) * Math.random() + 1);
		}
		return iterator;
	}
	function bwg_change_image(current_key, key, data, from_effect) {		
		if (data[key]) {
			if (jQuery('.bwg_ctrl_btn').hasClass('fa-pause')) {
			  play();
			}
			if (!from_effect) { 
			  jQuery("#bwg_current_image_key").val(key);
			}
			if (bwg_trans_in_progress) {
			  event_stack.push(current_key + '-' + key);
			  return;
			}
			var direction = 'right';
			if (bwg_current_key > key) {
			  var direction = 'left';
			}
			else if (bwg_current_key == key) {
			  return;
			}
			/* Set active thumbnail position.*/
			bwg_current_key = key;
			/* Change image id, title, description.*/

			/* Change image id, key, title, description. */
			jQuery("#bwg_current_image_key").val(key);
			jQuery("#bwg_slideshow_image").attr('image_id', data[key]["id"]);

			jQuery(".bwg_slideshow_title_text").html(data[key]["alt"]);
			jQuery(".bwg_slideshow_description_text").html(data[key]["description"]);
			jQuery("#bwg_slideshow_image").attr('image_id', data[key]["id"]);
			
			if (typeof data[key]["alt"] != 'undefined'){
			  jQuery(".bwg_slideshow_title_text").html(jQuery('<div>').html(data[key]["alt"]));
			} else jQuery(".bwg_slideshow_title_text").html(jQuery('<div>').css('padding','0'));
			
			if (typeof data[key]["description"] != 'undefined'){
			  jQuery(".bwg_slideshow_description_text").html(jQuery('<div>').html(data[key]["description"])); 
			} else jQuery(".bwg_slideshow_description_text").html(jQuery('<div>').css('padding','0'));
			
			
			var current_image_class = "#image_id_" + data[current_key]["id"];
			var next_image_class = "#image_id_" + data[key]["id"];
			var effect_name = "bwg_" + business_elite_slider_options.effect;
	        window[effect_name](current_image_class, next_image_class, direction);
		}
		jQuery('.bwg_slideshow_title_text').removeClass('none');
		if(jQuery('.bwg_slideshow_title_text').html()==""){jQuery('.bwg_slideshow_title_text').addClass('none');}

		jQuery('.bwg_slideshow_description_text').removeClass('none');
		if(jQuery('.bwg_slideshow_description_text').html()==""){jQuery('.bwg_slideshow_description_text').addClass('none');}
	}
	
    function bwg_popup_resize() {
		firstsize = 1024;
		var	parentWidth = jQuery(".bwg_slideshow_image_wrap").parent().width();
		var bodyWidth = jQuery(window).width();
		var str = business_elite_slider_options.image_height;
		if(parentWidth>bodyWidth){parentWidth = bodyWidth;}

		var slider_h = str*parentWidth/1024;
		
		jQuery(".bwg_slideshow_image_wrap").css({height: slider_h});
		jQuery(".bwg_slideshow_title_container>div").css({height: slider_h});
		jQuery("#slideshow .bwg_slideshow_image").css({height: slider_h});
		
		jQuery(".bwg_slideshow_image_container").css({width: (parentWidth)});
		jQuery(".bwg_slideshow_image_container").css({height: slider_h});
		
		jQuery(".bwg_slideshow_image").css({
			maxWidth: parentWidth,
			maxHeight: slider_h
		});
	}
	
	jQuery(window).resize(function() {	  
	  bwg_popup_resize();
	});
	
	jQuery(window).load(function () {
		var loading_slider_placeholder = jQuery('#slideshow').find('.wdwt_loading_slider');
		loading_slider_placeholder.css('z-index', '-1');
		loading_slider_placeholder.css('background-image', 'none');
		loading_slider_placeholder.css('background', 'transparent');

		if (typeof jQuery().swiperight !== 'undefined' && jQuery.isFunction(jQuery().swiperight)) {
			jQuery('#bwg_container1').swiperight(function () {
				bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) >= 0 ? (parseInt(jQuery('#bwg_current_image_key').val()) - iterator()) % data.length : data.length - 1, data);
				return false;
			});
		}
		if (typeof jQuery().swipeleft !== 'undefined' && jQuery.isFunction(jQuery().swipeleft)) {
			jQuery('#bwg_container1').swipeleft(function () {
				bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + iterator()) % data.length, data);
				return false;
			});
		}
		var isMobile = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
		var bwg_click = isMobile ? 'touchend' : 'click';
		bwg_popup_resize();
		jQuery("#bwg_container1").css({visibility: 'visible'});

		/* Set image container height.*/
		var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel"; /* FF doesn't recognize mousewheel as of FF3.x */

		/* Play/pause.*/
		if (1) {
			play();
		}
    });
	
	function play() {
	  window.clearInterval(bwg_playInterval);
	  bwg_playInterval = setInterval(function () {
		var iterator = 1;
		if (0) {
		  iterator = Math.floor((data.length - 1) * Math.random() + 1);
		}
		bwg_change_image(parseInt(jQuery('#bwg_current_image_key').val()), (parseInt(jQuery('#bwg_current_image_key').val()) + 1) % data.length, data)
	  }, ''+business_elite_slider_options.slideshow_interval+'');
	}
	jQuery(window).focus(function() {
	  /* event_stack = [];*/
	  if (!jQuery(".bwg_ctrl_btn").hasClass("fa-play")) {
		play();
	  }
	  var iiii = 0;
	  jQuery(".bwg_slider").children("span").each(function () {
		if (jQuery(this).css('opacity') == 1) {
		  jQuery("#bwg_current_image_key").val(iiii);
		}
	  });
	});
	jQuery(window).blur(function() {
		event_stack = [];
		window.clearInterval(bwg_playInterval);
	});
	var pausehover=business_elite_slider_options.stop_on_hover;
	
    jQuery( document ).ready(function() {
      var h = jQuery('#slideshow').height();
	  jQuery('#bwg_slideshow_image_container').height(h * jQuery(window).width()/1024);

      if(pausehover=="1"){
        jQuery("#bwg_slideshow_image_container, .bwg_slideshow_image_container").hover(function(){ 
  			event_stack = []; 
  			clearInterval(bwg_playInterval);
  		},function(){ play(); });
      }
	});