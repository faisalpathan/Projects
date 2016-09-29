<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>     
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div  id="single-post" class="page-404"> 
                <div <?php post_class('post'); ?>>
                    
                    <div class="clear"></div>
                    <h1 class="entry-title"><?php _e('404, Page not found!','the-next');?></h1>
                    <div class="entry-content">
                        <?php _e('Nothing found here! Please use navigation above or search to find what you are looking for.','the-next');?>  
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); 
