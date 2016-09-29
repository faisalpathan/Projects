(function ($) {

    $(document).ready(function () {

        // Range Tooltip
        $('input[type=range]').focus(function () {
            $('.thenext_range_tooltip').remove();
            value = $(this).attr('value');
            $(this).parent().append('<div class="thenext_range_tooltip">' + value + '</div> ');
            $(this).mousemove(function () {
                value = $(this).attr('value');
                $('.thenext_range_tooltip').text(value);
            });
            $(this).mouseup(function () {
                $('.thenext_range_tooltip').fadeOut('fast');
            });
            $(this).mousedown(function () {
                $('.thenext_range_tooltip').fadeIn('fast');
            });
        });
        
        // Font Preview Div
        var font_previews = new Array('heading', 'body', 'widget_content', 'widget_title', 'menu_top', 'menu_dropdown');
        $.each(font_previews, function(i, preview){
            
            var fontname = $('#customize-control-'+ preview +'_font select').find(":selected").text();
            var fontval = $('#customize-control-'+ preview +'_font select').find(":selected").val();
            var fontlink = "http://fonts.googleapis.com/css?family=" + fontval ;
            $('#customize-control-'+ preview +'_font').append('<link id="'+ preview +'-font" href="'+ fontlink +'" rel="stylesheet">');           
            $('#customize-control-'+ preview +'_font').append('<div class="'+ preview +'-font-preview" style="font-family:\'' + fontname + '\', sans-serif;font-size:22px;font-weight:700;">Font Preview</div> ');

            $('#customize-control-'+ preview +'_font select').on('change',function(){
               var val = this.value;
               var name = $(this).find(":selected").text();
               var gflink = "http://fonts.googleapis.com/css?family=" + val ;

               $('.'+ preview +'-font-preview').remove();
               $('#'+ preview +'-font').remove();
               $(this).parent().append('<link id="'+ preview +'-font" href="'+ gflink +'" rel="stylesheet">');

               $(this).parent().append('<div class="'+ preview +'-font-preview" style="font-family:\'' + name + '\', sans-serif;font-size:22px;font-weight:700;">Font Preview</div> ');
            });
        
        });
        
        //$('.customize-control select').chosen();

    });

})(jQuery);