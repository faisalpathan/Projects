(function ($) {
	$.plhgMain = function () {
		this.zinit();
	};

	$.plhgMain.prototype = {
		zinit : function() {
			var fw = this;

			// Bind this to document in case the content is loaded with ajax
			$( document ).on('click', '.plhg-love-action', function(e){
				e.preventDefault();

				// Don't do anything if the user already loved
				if( $(this).hasClass('plhg-loved') ){
					return;
				}

				var el 				 	 = $(this),
					love_count_container = el.find('.plhg-love-count'),
					current_loves        = love_count_container.text(),
					post_id              = el.data('post-id'),
					user_id              = el.data('user-id');

				var post_data = {
					action: 'plhg_process_post_love',
					post_id: post_id,
					user_id: user_id,
					plhg_nonce: plhg_script_vars.nonce
				};

				$.post(plhg_script_vars.ajaxurl, post_data, function(response) {
					if( response.success === true ) {
						el.addClass('plhg-loved');
						love_count_container.text( parseInt(current_loves) + 1 );
					} else {
						alert(plhg_script_vars.error_message);
						console.log(response)
					}
				});

			});
		},
	}

	$(document).ready(function () {
		// Call this on document ready
		$.plhgMain = new $.plhgMain();
	});

})(jQuery);