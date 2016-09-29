/*global jQuery */
/*jshint browser:true */

// Localized javascript through: ZN_EXPORT_LOCALE
jQuery(function ($) {
    if (typeof(window.ZN_EXPORT_LOCALE) == 'undefined') {
        throw new Error('ZN_EXPORT_LOCALE is not defined');
    }

//<editor-fold desc=">>> THEME DEMO EXPORT">

    var inputDemoName = $('#input_demo_name');
    if (!inputDemoName) {
        throw new Error('The form is not valid. Demo Name input missing');
    }
    var infoWrapper = $('#zn-export-ajax-info');
    if (!infoWrapper) {
        throw new Error('The form is not valid. Ajax Info Wrapper missing');
    }

    var submitButton = $('#zn-export-button');
    if (!submitButton) {
        throw new Error('The form is not valid. Submit button missing');
    }

    submitButton.on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        infoWrapper.empty();

        $.ajax({
            method: 'POST',
            url: ajaxurl,
            cache: false,
            async: true,
            data: {
                action: 'ajax_demo_export',
                security: ZN_EXPORT_LOCALE.nonce,
                demo_dir_name: inputDemoName.val()
            }
        }).done(function (response) {
            // Check for info messages
            if (typeof(response.success) != 'undefined')
            {
                if(response.success) {
                    infoWrapper.html('<p>Export complete! Your download should automatically start in 3 seconds</p>');
                    // trigger the download
                    window.setTimeout(function () {
                        window.location.href = ZN_EXPORT_LOCALE.nonce_url + '&f='+response.data;
                    }, 3000);
                }
                else {
                    infoWrapper.html('<pre>'+response.data.message+'</pre>');
                    infoWrapper.append('<p>Your download should automatically start in 3 seconds</p>');
                    // trigger the download
                    window.setTimeout(function () {
                        window.location.href = ZN_EXPORT_LOCALE.nonce_url + '&f='+response.data.file_name;
                    }, 3000);
                }
            }
        }).fail(function (a, b) {
            console.error('Error: ', b);
        });
    });
//</editor-fold desc=">>> THEME DEMO EXPORT">


//<editor-fold desc=">>> THEME DEMO IMAGE MANAGER">

    var ImageManager = {
        init: function ()
        {
            var self = this,
                changeLink = $('.change-image-link');

//<editor-fold desc=">>> CHANGE IMAGE">
            if(typeof(changeLink) == 'undefined'){
                console.info('[ImageManager] <ChangeLink: .change-image-link> not found');
                return false;
            }
            changeLink.on('click', function(e)
            {
                e.preventDefault();
                e.stopPropagation();

                // Get references
                var parent = $(this).parent(),
                    hiddenInput = parent.find('.im-input-hidden').first();
                if(typeof(hiddenInput) == 'undefined'){
                    console.error('[ImageManager] Error: hidden input not found!');
                    return false;
                }
                var targetElement = parent.find('.target-file');
                if(typeof(targetElement) == 'undefined'){
                    console.error('[ImageManager] Error: target element not found!');
                    return false;
                }
                // Check what attribute we need to update on change
                var attr = '';
                if(targetElement.data('type') == 'image' || targetElement.data('type') == 'video'){
                    attr = 'src'
                }

                // Clear the info wrapper
                infoWrapper.empty();

                // Open the media popup
                self._changeImage(hiddenInput, targetElement, attr);
            });
//</editor-fold desc=">>> CHANGE IMAGE">

//<editor-fold desc=">>> EXPORT & DOWNLOAD">
            var exportButton = $('#zn-im-export-button');
            if(typeof(exportButton) == 'undefined'){
                console.info('[ImageManager] <exportButton: #zn-export-button> not found');
                return false;
            }
//</editor-fold desc=">>> EXPORT & DOWNLOAD">
        },
        _changeImage: function(hiddenInput, targetElement, attr)
        {
            var self = this,
                oldUrl = hiddenInput.val(),
                file_frame;

            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select image',
                button: {
                    text: "Select image"
                },
                multiple: false
            });

            file_frame.on( 'close', function() {
                file_frame.detach();
            });

            // When an image is selected, run a callback.
            file_frame.on( 'select', function() {
                // We set multiple to false so only get one image from the uploader
                var attachment = file_frame.state().get('selection').first().toJSON();

                // Update dependencies
                hiddenInput.val(attachment.url);
                if(attr && attr.length > 0) {
                    targetElement.attr(attr, attachment.url);
                    self.__ajaxUpdateDependencies( oldUrl, attachment.url );
                }
            });

            // Open the modal
            file_frame.open();
        },

        // this function will update the dependant posts/pages/whatever with the new image URL/ID
        __ajaxUpdateDependencies: function( oldURL, newURL )
        {
            $.ajax({
                method: 'POST',
                url: ajaxurl,
                cache: false,
                async: true,
                data: {
                    action: 'ajax_update_posts',
                    security: ZN_EXPORT_LOCALE.nonce,
                    old_url: oldURL,
                    new_url: newURL
                }
            }).done(function(response){
                infoWrapper.html('Server response: <pre>'+ response.data+'</pre>');
            }).fail(function(a,b){
                alert('Server response: '+ b);
                console.error('Server response: ', b);
            });
        }
    };
    ImageManager.init();
//</editor-fold desc=">>> THEME DEMO IMAGE MANAGER">

});

