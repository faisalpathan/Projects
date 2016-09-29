(function ($)
{
	"use strict";

	jQuery('#znhg_plh_form').ajaxForm({
		data: {
			action: 'znhg_post_love_save',
			url : ajaxurl
		},
		dataType: 'json',
		success : function( responseText, statusText, xhr, $form) {
			$('.znhg_ts_save_message').html('Your form has been submitted successfully').fadeOut( "2000", function() {
				$(this).html('').fadeIn('1');
			});
		}
	});

})(jQuery)