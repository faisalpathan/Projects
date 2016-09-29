<?php
if(!defined('THENEXT_HIDE_PAGE_HEADER')): ?>
<!-- Page Header Template: Narrow -->
        <div class="arc-header page-header-narrow">
            <div class="container"><div class="row"><div class="col-md-12">
                        <h1 class="entry-title page-heading-main">

                            <?php TheNextFramework::PageHeadingMain(); ?>

                            <?php if ( function_exists('yoast_breadcrumb') ) { ?>
                                <div class="pull-right thenext-breadcrumb">
                                    <?php
                                    add_filter( 'wp_seo_get_bc_title', create_function('$title, $id','return "";'), 10, 2 );
                                    echo apply_filters('thenext_page_header1_breadcrumb',yoast_breadcrumb('<a>','</a>', false));
                                    ?>
                                </div>
                            <?php } ?><div class="clear"></div>
                        </h1>
                    </div> </div> </div>
        </div>



<?php endif; ?>