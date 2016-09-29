<?php
/*
 * Tag Template File.
 */
get_header();

$page_title_area = get_theme_mod('page_title_area');

if($page_title_area != 2) : ?>
<div class="heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="title mobile_article">
                    <b> <?php _e('Tag', 'bizzboss'); echo " : " . single_tag_title('', false); ?>  </b>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
<div class="page-title-area"></div>
<?php endif;
get_template_part('content');
get_footer(); ?>