<?php
if (!defined('THENEXT_HIDE_PAGE_HEADER')): ?>
    <!-- Page Header Template: Simple Bordered -->
    <div class="page-header page-header-6">
        <div class="arc-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="panel panel-default">
                            <div class="panel-body">
                        <h1 class="entry-title page-heading-main wow zoomIn">
                            <?php TheNextFramework::PageHeadingMain(); ?>
                        </h1>
                            </div>
                        <?php if ( function_exists('yoast_breadcrumb') ) { ?>
                            <div class="panel-footer thenext-breadcrumb">
                                <?php
                                echo apply_filters('thenext_page_header1_breadcrumb',yoast_breadcrumb('<a>','</a>', false));
                                ?>
                            </div>
                        <?php } ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php endif; ?>