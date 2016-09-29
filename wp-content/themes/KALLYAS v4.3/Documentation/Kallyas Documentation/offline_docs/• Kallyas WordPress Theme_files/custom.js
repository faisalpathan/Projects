/* responsiveness of sidebar starts */
jQuery(document).ready(function ($) {

	$( '.pado-back-top a' ).click( function ( e ) {
		$( 'body,html' ).animate( { scrollTop: 0 }, 800 );
		e.preventDefault();
	});
	
	$('#pado-sidebar').css({ position: 'relative', top: 30 });

	var scroll_resize = function(){
		
		var stickyTop = $('#pado-sidebar').offset().top; // returns number
		var windowWidth = jQuery(window).width()
		var windowTop = $(window).scrollTop(); // returns number
		var widthContent = parseInt($("#pado-main").css("width")) ;
		var documentMainTop = $("#pado-main").offset().top;
		var windowHeight = $( window ).height();
		var documentSidebarTop = document.getElementById( 'pado-sidebar' ).getBoundingClientRect().top;

		widthContent *= 0.3 ;
	
		if ( 767 >= windowWidth ) {
			$('#pado-sidebar').perfectScrollbar( 'destroy' );
		} else {
			$('#pado-sidebar').perfectScrollbar();
			$('#pado-sidebar').height( windowHeight - documentSidebarTop ).perfectScrollbar( 'update' );
		}

		if ( documentMainTop < windowTop ){
			if ( 767 >= windowWidth ) {
				$('#pado-sidebar').css({ position: 'relative', top: 30 });
				$('#pado-sidebar').css({ width: widthContent });
			} else {
				$('#pado-sidebar').css({ position: 'fixed', top: 30 });
				$('#pado-sidebar').css({ width: widthContent });
			}
			
		} else {
			$('#pado-sidebar').css({ position: 'relative', top: 30 });
			$('#pado-sidebar').css({ width: widthContent });
		}

		return;
	};

	$(window).scroll(scroll_resize);
	$(window).resize(scroll_resize);

	// Resize once
	$(window).trigger( 'scroll' );
});
/* responsiveness of sidebar ends */

jQuery().ready(function($){
	$('.sidebar_cat_title').parent().find('.sidebar_doc_title').hide();
	$('.sidebar_cat_title a').click(function(){
		$this = $(this);
		if($this.parent().parent().hasClass('open_arrow')) {
			$this.parent().parent().removeClass('open_arrow');
			$this.parents('ul').find('.sidebar_doc_title').slideUp('fast');
		} else {
			$('.sidebar_doc_title').slideUp();
			$('.open_arrow').removeClass('open_arrow');
			$this.parent().parent().addClass('open_arrow');
			$this.parents('ul').find('.sidebar_doc_title').slideDown('fast');
		}
	}).first().trigger('click');

	$( '.sidebar_doc_title a' ).each( function () {
		var destination = '';
		$( this ).click( function( e ) {
			e.preventDefault();
			var elementClicked = $( this ).attr( 'href' );
			var elementOffset = jQuery( 'body' ).find( elementClicked ).offset();
			destination = elementOffset.top;
			jQuery( 'html,body' ).animate( { scrollTop: destination - 40 }, 300 );
		} );
	});
});


/***************************************************
      Docs Voting
***************************************************/
jQuery().ready(function(){
	jQuery('a.pado-like-btn').click(function(){
		response_div = jQuery(this).parent().parent();
		jQuery.ajax({
			url         : PADO.base_url,
			data        : {'vote_like':jQuery(this).attr('post_id')},
			beforeSend  : function(){},
			success     : function(data){
				response_div.hide().html(data).fadeIn(400);
			},
			complete    : function(){}
		});
	})
	
	jQuery('a.pado-dislike-btn').click(function(){
		response_div = jQuery(this).parent().parent();
		jQuery.ajax({
			url         : PADO.base_url,
			data        : {'vote_dislike':jQuery(this).attr('post_id')},
			beforeSend  : function(){},
			success     : function(data){
				response_div.hide().html(data).fadeIn(400);
			},
			complete    : function(){}
		});
	})
});

jQuery(document).ready(function ($) {
	$('p.pado-likes').tooltip({
		'placement' : 'top'
	});
	
	$('p.pado-dislikes').tooltip({
		'placement' : 'top'
	});
});