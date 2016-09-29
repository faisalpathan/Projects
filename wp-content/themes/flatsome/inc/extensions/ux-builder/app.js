// UX BUILDER JS

var uxcreateCookie = function(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
};

function uxgetCookie(c_name) {
  var c_start, c_end;
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start !== -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end === -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}

function ux_UploadImage(div){
    // Uploading files
    var file_frame;

    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.open();
      return;
    }
    
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
        title: 'Select image',
        button: {
        text: 'Select',
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });
 
    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get('selection').first().toJSON();
      var ux_selected_image = attachment.id;
      jQuery(div).find('input').val(ux_selected_image).change();
    });
    // Finally, open the modal
    file_frame.open();
}


// Set UXBuilder visibility on load
if(uxgetCookie('uxbuilder') === 'enabled'){
  var doc = document.documentElement; doc.setAttribute('data-uxbuilder', 'enabled');
} else {
  var doc = document.documentElement; doc.setAttribute('data-uxbuilder', 'disabled');
}


// Load builder script on document ready
jQuery( document ).ready(function($) {



// start ux builder on start if set
if($('html[data-uxbuilder="enabled"]').length){
  $('a#enable-uxbuilder').addClass('nav-tab-active');
    setTimeout(function(){
        getAllContent();
    }, 300);
} else{
  $('a#disable-uxbuilder').addClass('nav-tab-active');
}

// update content on save or change
$('#disable-uxbuilder, .button[name="save"],  .button[name="publish"], .preview.button').click(function(){
  if($('html[data-uxbuilder="enabled"]').length){
      updateContent();
  }
});

// enable ux-builder
$('a#enable-uxbuilder').click(function(e){
  uxcreateCookie('uxbuilder','enabled');
  $(this).parent().addClass('disabled');
  $('#uxbuilder-enable-disable a').removeClass('nav-tab-active');
  $('html').attr('data-uxbuilder','enabled');
  $(this).addClass('nav-tab-active');
  getAllContent();
  $(window).resize();
  e.preventDefault();
});

// disable ux-builder
$('a#disable-uxbuilder').click(function(e){
  uxcreateCookie('uxbuilder','disabled');
  $('#uxbuilder-enable-disable a').removeClass('nav-tab-active');
  $('html').attr('data-uxbuilder','disabled');
  $(this).addClass('nav-tab-active');
  $(window).resize();
  e.preventDefault();
});

// close lightbox

$('.close-lightbox').click(function(){
  $('.ux-lightbox').removeClass('active');
});



// Clean empty lines
function multilineTrim(htmlString) {
   return htmlString.split("\n\n").map($.trim).filter(function(line) { return line !== ""; }).join("\n\n");
}

// Get shortcodes
function addContentAjax(shortcode){
  var new_content = shortcode;
  var data = { action: 'ux_get_content_shortcodes', content: new_content};
  $.post(ajaxurl, data, function(response) {
    $('.ux-g-new').html(response);
    updateLayout('.ux-g-new > .ux-g');
    $('.ux-g-new > .ux-g').unwrap();
  });
}

// Get content from editor
function get_content(id){
      var content = "";
      if ($(id).hasClass("tmce-active")){
                $(id).find('.switch-html').one().click();
                content = $(id).find('textarea.wp-editor-area').val();
                 $(id).find('.switch-tmce').one().click().click();
          } else {
                content = $(id).find('textarea.wp-editor-area').val();
          }
        return content;
  
}

// Save content to editor
function set_content(id,content){
    if ($(id).hasClass("tmce-active")){
          $(id).find('.switch-html').one().click();
          $(id).find('textarea.wp-editor-area').val(content);
          $(id).find('.switch-tmce').one().click().click();
    } else {
          $(id).find('textarea.wp-editor-area').val(content);
    }
}


function setRows(){

// SET SORTABLES 
  $('.ux-g-group').sortable({
  item: "> .ux-g",
  connectWith: '.ux-g-group:not([data-group="row"])',
  tolerance: "pointer",
  forceHelperSize: true,
  forcePlaceholderSize: false,
  cursorAt: { left: 100, top:-1 },
    start: function(event, ui) {
      $('#drag-and-drop').addClass('dragging');
    },
    stop: function( event, ui ) {
      $('#drag-and-drop').removeClass('dragging');
    },
    beforeStop: function(ev, ui) {
        var id = $(ui.item).data('id');
        if ($(ui.placeholder).parents().data('group') === id) {
            $(this).sortable('cancel');
            $('#drag-and-drop').removeClass('dragging');
        }
        // only columns
         if ($(ui.placeholder).parent().data('group') === 'row' && id !== 'col') {
            $(this).sortable('cancel');
            $('#drag-and-drop').removeClass('dragging');
        }
    }
  });

  // connect rows
  $('[data-group="row"]').sortable({ connectWith: '[data-group="row"]' });
  $('[data-group="ux_banner"]').sortable({ connectWith: '[data-group="ux_banner"], [data-group="col"], [data-group="root"]' });
  $('[data-group="col"]').sortable({ connectWith: '[data-group="col"],[data-group="section"],[data-group="tab"],[data-group="root"]' });
  $('[data-group="ux_price_table"]').sortable({ connectWith: '[data-group="ux_price_table"]' });
  $('[data-group="tabgroup"],[data-group="tabgroup_vertical"]').sortable({ connectWith: '[data-group="tabgroup"],[data-group="tabgroup_vertical"]' });
  $('[data-group="accordion"]').sortable({ connectWith: '[data-group="accordion"]' });

}


// EDIT SHORTCODES
function createEditor(edit_div){
    // set default div if not selected
    if(!edit_div) {edit_div = '.ux-g';}
    $(edit_div+' s').each(function(){
        // add editable shortcode attributes
        var text = $(this).find('em').text();
        text = text.replace(/((([^=]+)=((?:"|'))([^"']+)\4) ?)/g,'<span class="edit-shortcode" data-edit="$3"><strong>$3</strong>="<span>$5</span>"</span> ');
        text = text.replace(/="\s/g, '="');
        $(this).find('em').html(text);

        // editable  
        $('span.edit-shortcode span').editable(function(value) {
             setTimeout(function(){updateColumns();}, 100);
             return(value);
          }, { 
            tooltip   : "Click to edit...",
            style  : "inherit"
         });
    });

    // remove temp div it have content

    updateColumns(edit_div);

}


function updateColumns(edit_div){
  if(!edit_div) {edit_div = '.ux-g';}
  $(edit_div+'[data-id="col"],'+edit_div+' [data-id="col"]').each(function(){
       $(this).removeClass (function (index, css) {
         return (css.match (/(^|\s)span\S+/g) || []).join(' ');
       });

      var col = $(this).find('.edit-shortcode[data-edit="span"]').find('span').text();
      col = col.replace('/','_');
      $(this).addClass('span'+col);
    });
}


// ACTIONS
function toolBarAction(edit_div){

   // set default div if not selected
    if(!edit_div) {edit_div = '.ux-g';}

    // ADD CONTENT CLICK
     $(edit_div+' .ux-g-add, .ux-add-elements-wrap .ux-g-add').off('click').on( 'click', function(e) {

          $('#drag-and-drop .ux-add-section').remove();

          var data_id = $(this).parent().data('id');
          var div_clone = " ";
          if($('.ux-add-section[data-add-section="'+data_id+'"]').length){
            div_clone = $('.ux-add-section[data-add-section="'+data_id+'"]').clone().css('display','block');
          } else {
            div_clone = $('.ux-add-section[data-add-section="default"]').clone().css('display','block');
          }
      
          var current = $(this);

          // CREATE CONTENT
          $(div_clone).find('.ux-add-div').off('click').on( 'click', function(e) {

              $('.ux-g .ux-add-section, .ux-add-elements-wrap .ux-add-section').remove();
              var new_div = '<div class="ux-g-new ux-g"><span class="spinner is-active" style="display:block;float:none;"></span></div>';
              
              // has-more links
              if($(this).hasClass('ux-has-more')){
                   $(this).find('ul').css('display','block');
                   e.preventDefault();
                   return false;
              }
              // lightbox links
              else if($(this).hasClass('has-lightbox')){
                          var lightbox_div = $('.ux-lightbox[data-add="'+$(this).data('shortcode')+'"]');

                          $(lightbox_div).addClass('active');
                          // lightbox click actions
                          $(lightbox_div).find('.ux-add-div:not(.ux-has-more)').off('click').on( 'click', function(e) {
                                 if($(current).hasClass('top')){
                                      $('.drag-drop-content').prepend(new_div);
                                  } else if($(current).hasClass('bottom')){
                                      $('.drag-drop-content').append(new_div);
                                  } else {
                                      $(current).parent().find('> .ux-g-group').append(new_div);
                                  }
                                  var content = $(this).find('textarea').val();

                                  // insert code fix
                                  if($(this).hasClass('ux-get-code')){content = $(this).parent().parent().find('textarea').val();}

                                  $(lightbox_div).removeClass('active');
                                  // add Content with ajax
                                  addContentAjax(content);
                                  e.preventDefault();
                                  return false;
                          });
                        
              // normal links
              } else {
                    var content = $(this).find('textarea').val();

                    if($(current).hasClass('top')){
                      $('.drag-drop-content').prepend(new_div);
                    } else if($(current).hasClass('bottom')){
                      $('.drag-drop-content').append(new_div);
                    } else {

                      $(current).parent().find('> .ux-g-group').append(new_div);
                    }
                    // add Content with ajax
               addContentAjax(content);


              }
             e.preventDefault();
          });


          $(this).after(div_clone);
          e.preventDefault();
          return false;
     });


    // EDIT Shortcodes
      $(edit_div+' [data-action="edit"]').off('click').on( 'click', function(e) {
        $(this).parent().parent().addClass('ux-current');
        var currentShortcode = $(this).parent().parent().find('> s > em.ux-edit');
        $('textarea#new_shortcode').html('');
        var id = $(this).parent().parent().data('id');
        var data = { action: 'get_shortcode_editor', shortcode: id};
         $('.edit-shortcode-container').html('<span class="spinner is-active" style="display:block;float:none;margin:30px;"></span>');
         $('.ux-lightbox[data-edit="shortcode"]').addClass('active');

          $.post(ajaxurl, data, function(response) {
              $('.edit-shortcode-container').html(response);
                // fill options
                $(currentShortcode).find('.edit-shortcode').each(function(){
                  var edit = $(this).data('edit');
                  var content = $(this).find('span').text();
                  $('#shortcode-editor').find('[data-id="'+edit+'"]').val(content);
                  $('textarea#new_shortcode').append(edit+'="'+content+'" ');
                  });

                   $('.ux-color-picker').wpColorPicker();

                   $('#block-select').change();

                  // settings tabs
                  $('[data-group="Settings"],[data-grouping="Settings"]').addClass('active');

                  $('.ux-shortcode-group').find('input').keypress(function(e) { if(e.which === 13 || e.which === 9) { $(this).change().blur(); e.preventDefault(); }  });

                  $('[data-grouping]').click(function(e){
                      $('[data-grouping], [data-group]').removeClass('active');
                      $(this).addClass('active');
                      $(this).parent().parent().find('[data-group="'+$(this).data('grouping')+'"]').addClass('active');
                      e.preventDefault();
                  });

                  $('.ux-edit-checkbox').each(function(){
                      var box = $(this).find('input[type="text"]');
                      if( $(this).find('input[type="text"]').val().length){
                          $(this).find('input[type="checkbox"]').attr('checked','true');
                      }
                      $(this).find('input[type="checkbox"]').change(function() {
                          if($(this).is(":checked")) {
                              $(box).val($(this).val());
                          } else {
                            $(box).val('');
                          }
                      });
                  });

                  $('#shortcode-editor input, #shortcode-editor select').change(function(){
                    $('textarea#new_shortcode').html('');
                      $('#shortcode-editor [data-id]').each(function(){
                          var edit = $(this).data('id');
                          var content = $(this).val();
                          if(content){
                            $('textarea#new_shortcode').append(edit+'="'+content+'" ');
                          }
                         
                      });
                  });

                   // save
                  $('.close-lightbox').off('click').on( 'click', function(e) {
                      if($(this).hasClass('save')){

                          $(currentShortcode).text($('textarea#new_shortcode').val());
                          createEditor('.ux-current');
                      }
                      $('.ux-current').removeClass('ux-current');
                      $('.ux-lightbox').removeClass('active');

                      e.preventDefault();
                  });
                  


          });
          e.preventDefault();
      });
      
    // duplicate
    $(edit_div+' [data-action="duplicate"]').off('click').on( 'click', function(e) {
            $('#drag-and-drop .ux-add-section').remove();
            var new_element = $(this).parent().parent().clone().removeClass('active').addClass('ux-g-added');
            
            $(this).parent().parent().after(new_element);

            setTimeout(function(){
              $(new_element).removeClass('ux-g-added');
            }, 300);
          
            updateLayout('.ux-g-added');
            e.preventDefault();
    });
     
     // delete
    $(edit_div+' [data-action="delete"]').off('click').on( 'click', function(e) {
              $('#drag-and-drop .ux-add-section').remove();
              $(this).parent().parent().slideUp(100, function() { $(this).remove();  });
              e.preventDefault();
    });


    // edit text
    $(edit_div+' .ux-g-text-inner').off('click').on( 'click', function(e) {
        var ux_current_edit_div = $(this);
        var content = multilineTrim($(this).html());
        set_content('#wp-ux_edit_content-wrap',content);
        $('.ux-lightbox[data-edit="text"]').addClass('active');
        e.preventDefault();
            // save
            $('.close-lightbox').off('click').on( 'click', function(e) {
              $('.ux-lightbox').removeClass('active');
                if($(this).hasClass('save')){
                   $(ux_current_edit_div).html(get_content('#wp-ux_edit_content-wrap'));
                   $(ux_current_edit_div).find('.button:first').before('<p></p>');
                } else if($(this).hasClass('delete')){
                   $(ux_current_edit_div).slideUp(100, function() { $(this).remove();  });
                }
              e.preventDefault();
            });
    });

}


// Update content to Editor
function updateContent(){
          $('#new-content').html($('#drag-and-drop .drag-drop-content').html());

          // remove elements
          $('#new-content .ux-add-section, #new-content .drop-zone.ux-g,  #new-content .ux-g-tools, #new-content .ux-g-add, #new-content .temp-div').remove();
    

          // unwrap elements
          $("#new-content .ux-g-text-inner, #new-content .ui-sortable-handle,  #new-content .ux-g-group, #new-content .ux-g-content,#new-content .ux-edit, #new-content .ux-g s,#new-content .edit-shortcode > strong,.edit-shortcode > span, #new-content span.edit-shortcode, #new-content .ux-g").each(function() {
                $(this).replaceWith(this.childNodes);
          });

            
           var content =  $.trim($('#new-content').html());

           content =  content.replace(/\[text\]/g,'');
           content =  content.replace(/\[\/text\]/g,'');

           content =  content.replace(/(\[[^\/](.*?)\])/g,'$1\n');
           content =  content.replace(/(\[[\/](.*?)\])/g,'\n$1\n');
           content =  multilineTrim(content);


           content =  content.replace(/(\[[^\/](.*?)\])/g,'$1\n');
           content =  content.replace(/(\[[\/](.*?)\])/g,'\n$1\n');
           content =  multilineTrim(content);

           // remove spaces
           content =  content.replace(/\s+(?=[^[\]]*\])/g,' ');
           content =  content.replace(/\s]/g,']');
      
          // update content
          set_content('#wp-content-wrap',content);
}




// Get all content
function getAllContent(){
   var new_content = get_content('#wp-content-wrap');
   if(new_content){
      $('.drag-drop-content').html('<div class="ux-g"><span class="spinner is-active" style="display:block;float:none;"></span></div>');

     var data = { action: 'ux_get_content_shortcodes', content: new_content};
      $.post(ajaxurl, data, function(response) {
         $('#drag-and-drop .drag-drop-content').html(response);
         $('.ux-g-text-inner').find('.button:first').before('<p></p>');
         $('#uxbuilder-enable-disable').removeClass('disabled');
         updateLayout();
      }); 
   } else {
       $('.drag-drop-content').html('');
       $('#uxbuilder-enable-disable').removeClass('disabled');
       updateLayout();
   }

  }


function updateLayout(selected_div){
        // Mouse over effect 
        $('.ux-g').off('mouseover').on('mouseover', function(e){
              e.stopPropagation();
              $(this).addClass('active');
          }).on('mouseout', function(){
              $(this).removeClass('active');
         });

        setRows();
        createEditor(selected_div);
        toolBarAction(selected_div);
}




});