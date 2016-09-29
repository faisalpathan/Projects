jQuery(function($){

    $('input[type=button]').addClass('btn');
    $('input#s').addClass('form-control').attr('placeholder','Search...');
    $('input[type=submit]:not(.btn)').addClass('btn btn-primary');
    $('#nav-single a').addClass('btn btn-bordered btn-xs');
    $('#commentform input[type=text], #commentform textarea').addClass('form-control');

    $('body').on('click','.dd-cont', function(e){
        e.preventDefault();
        $(this).next('.dropdown-menu-vertical').slideToggle();
        if($(this).find('i').hasClass('tn-plus'))
        $(this).find('i').removeClass('tn-plus').addClass('tn-close');
        else
        $(this).find('i').removeClass('tn-close').addClass('tn-plus');
    });

    $('#search').popover({placement:'left',html:true});
    $('#search').click(function(){$(this).parent('li').toggleClass('open');});

    $('.package-block').hover(function(){
        $(this).children('.relative').children('.mask').removeClass('animated fadeOut').addClass('animated fadeIn');
    },function(){
        $(this).children('.relative').children('.mask').removeClass('animated fadeIn').addClass('animated fadeOut');
    });

    $('.ttip').tooltip();

    $('#loadmore').click(function(){
        var paged = $(this).attr('rel');
        $(this).attr('disabled','disabled').html('<i class="fa fa-spin fa-spinner"></i> Loading...');
        $.get('index.php',{pg:paged,task:'loadmore'},function(res){
            if(res=='eop') $('#loadmore').fadeOut();
            else {
            $('#content-area').append(res);
            $('#loadmore').attr('rel', parseInt(paged)+1);
            $('#loadmore').removeAttr('disabled').html('Load More ...');

                $('.package-block').hover(function(){
                    $(this).children('.relative').children('.mask').removeClass('animated fadeOut').addClass('animated fadeIn');
                },function(){
                    $(this).children('.relative').children('.mask').removeClass('animated fadeIn').addClass('animated fadeOut');
                });
            }
        });

    });

    $('.input-group input').on('focus', function(){
       $(this).parent().find('.input-group-addon').addClass('input-group-addon-active');
    });
    $('.input-group input').on('blur', function(){
        $(this).parent().find('.input-group-addon').removeClass('input-group-addon-active');
    });


});

jQuery(function($){
    $('.product-pane').hover(function(){
    //alert(jQuery(this).attr('class'));
        $(this).children().children('.breadcrumb').removeClass('fadeOutUp').addClass('fadeInDown');
    },function(){
        $(this).children().children('.breadcrumb').removeClass('fadeInDown').addClass('fadeOutUp');
    });

    $('.ppreview').popover({trigger:'hover',placement:'bottom',html:true});
    $('.cpreview').popover({trigger:'hover',placement:'top',html:true});

    $("#header-2").sticky({ topSpacing: 0 });
    $('#logos img, .ttip').tooltip({html:true});

    $(window).scroll(function() {
        var scroll = getCurrentScroll();
        if ( scroll >= 400 ) {
            $('#header-2').addClass('shrinked');
        }
        else {
            $('#header-2').removeClass('shrinked');
        }
    });

    $('#logos img, .ttip').tooltip({html: true});

    new WOW().init();

});

function getCurrentScroll() {
    return window.pageYOffset || document.documentElement.scrollTop;
}