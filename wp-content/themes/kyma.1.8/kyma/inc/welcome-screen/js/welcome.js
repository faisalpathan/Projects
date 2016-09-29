jQuery(document).ready(function() {
	
	/* If there are required actions, add an icon with the number of required actions in the About kyma page -> Actions required tab */
    var Kyma_nr_actions_required = kymaLiteWelcomeScreenObject.nr_actions_required;

    if ( (typeof Kyma_nr_actions_required !== 'undefined') && (Kyma_nr_actions_required != '0') ) {
        jQuery('li.kyma-lite-w-red-tab a').append('<span class="kyma-lite-actions-count">' + Kyma_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".kyma-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        console.log(id);
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'Kyma_lite_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : kymaLiteWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.kyma-lite-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + kymaLiteWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var Kyma_lite_actions_count = jQuery('.kyma-lite-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof Kyma_lite_actions_count !== 'undefined' ) {
                    if( Kyma_lite_actions_count == '1' ) {
                        jQuery('.kyma-lite-actions-count').remove();
                        jQuery('.kyma-lite-tab-pane#actions_required').append('<p>' + kymaLiteWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.kyma-lite-actions-count').text(parseInt(Kyma_lite_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });
	
	/* Tabs in welcome page */
	function Kyma_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".kyma-lite-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}
	
	var Kyma_actions_anchor = location.hash;
	
	if( (typeof Kyma_actions_anchor !== 'undefined') && (Kyma_actions_anchor != '') ) {
		Kyma_welcome_page_tabs('a[href="'+ Kyma_actions_anchor +'"]');
	}
	
    jQuery(".kyma-lite-nav-tabs a").click(function(event) {
        event.preventDefault();
		Kyma_welcome_page_tabs(this);
    });

});