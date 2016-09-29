<?php
if (!defined('THENEXT_HIDE_PAGE_HEADER')): ?>
    <!-- Page Header Template: Large Left -->
    <div class="page-header page-header-2 page-header-3">
        <div class="arc-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="entry-title page-heading-main wow fadeInDown">
                            <?php TheNextFramework::PageHeadingMain(); ?>
                        </h1>
                        <div class="icon-sap wow zoomIn"><?php TheNextFramework::PageIcon(get_the_ID()); ?></div>
                    </div>
                </div>

            </div>
        </div>
        <?php TheNextFramework::PageHeaderBottom(); ?>
    </div>
<?php endif; ?>