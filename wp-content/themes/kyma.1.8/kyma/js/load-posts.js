jQuery(document).ready(function () {
    var count1 = (load_more_posts_variable.counts_posts);
    var count2 = (load_more_posts_variable.blog_post_count);
    var $container = jQuery('.masonry1');
    var totalPosts = parseInt(count1);
    var view_post = parseInt(count2);
    var show_after = 1 + parseInt(view_post);
    var j;
    var i;
    var totPost = totalPosts;
    j = i = totalPosts - view_post; //  Show only 3 posts
    for (totalPosts; i >= 1; i--, totalPosts--) {
        jQuery('#row-' + totalPosts).hide();
    }
    if (totPost <= view_post) {
        jQuery('.post-btn1').hide();
    } else if (totPost >= show_after) {
        jQuery('.post-btn1').show();
    }
    jQuery(".append-button").click(function () {
        var showPosts = view_post;
        while (!showPosts == 0 && totalPosts < totPost) {
            var plusOne = totalPosts + 1;
            jQuery('#row-' + plusOne).show();
            if (showPosts % 3 == 0) {
                jQuery('#row-' + totalPosts).after('<div class="clearfix"></div>');
            }
            showPosts--;
            totalPosts++;
        }
        if (totPost == totalPosts) {
            jQuery('.append-button').hide();
        }
    });
});