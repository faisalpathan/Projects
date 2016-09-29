<?php
/**
 * Author Page template file
 * */
get_header();

$page_title_area = get_theme_mod('page_title_area');

if($page_title_area != 2) : ?>
<div class="heading">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="title mobile_article">
          <b><?php  _e('Published by : ', 'bizzboss'); echo get_the_author(); ?></b>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else : ?>
<div class="page-title-area"></div>
<?php endif; ?>
<?php get_template_part('content'); ?>
<?php get_footer(); ?>