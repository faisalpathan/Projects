jQuery(function(){
    
    jQuery(document).ajaxStop(jQuery.unblockUI);


    // Uploading files
    var file_frame, dfield;

    jQuery('body').on('click', '.btn-media-upload' , function( event ){
        event.preventDefault();
        dfield = jQuery(jQuery(this).attr('rel'));

        // If the media frame already exists, reopen it.
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery( this ).data( 'uploader_title' ),
            button: {
                text: jQuery( this ).data( 'uploader_button_text' )
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });

        // When an image is selected, run a callback.
        file_frame.on( 'select', function() {
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();
            dfield.val(attachment.url);

        });

        // Finally, open the modal
        file_frame.open();
    });

    jQuery('.w3eden select').chosen();

     
    jQuery('body').on('click','.prebg', function(){
         jQuery('#cpb_image').val(jQuery(this).attr('data-url'));
         preview_cbg(jQuery(this).attr('data-rel'));
    });
    
    jQuery('.colorpicker').wpColorPicker();

});

 
  function mediaupload(id){
      var id = '#'+id;
      tb_show('Upload Image','media-upload.php?TB_iframe=1&width=640&height=624');
      window.send_to_editor = function(html) {           
              var imgurl = jQuery('img',"<p>"+html+"</p>").attr('src');                                    
              jQuery(id).val(imgurl);
              tb_remove();
              }     
    }
  
  function preview_cbg(id){
      jQuery('#hfp').css('background-image',"url('"+jQuery('#'+id+'_image').val()+"')")
                    .css('background-position',jQuery('#'+id+'_position_h').val()+" "+jQuery('#'+id+'_position_v').val())
                    .css('background-repeat',jQuery('#'+id+'_repeat').val())
                    .css('background-attachment',jQuery('#'+id+'_attachment').val())
                    .css('background-color',jQuery('#'+id+'_color').val());
  }

function convertHex(hex,opacity){
    var hex1 = hex.replace('#','');
    r = parseInt(hex1.substring(0,2), 16);
    g = parseInt(hex1.substring(2,4), 16);
    b = parseInt(hex1.substring(4,6), 16);

    result = 'rgba('+r+','+g+','+b+','+opacity+')';
    return result;
}
