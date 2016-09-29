<?php
/**
 * Load files.
 *
 * @package Onefold
 */

/**
 * Include default theme options.
 */
require_once get_template_directory() . '/inc/customizer/default.php';

/**
 * Load helpers.
 */
require_once get_template_directory() . '/inc/helper/common.php';
require_once get_template_directory() . '/inc/helper/options.php';

/**
 * Load theme core functions.
 */
require_once get_template_directory() . '/inc/core.php';

/**
 * Load hooks.
 */
require_once get_template_directory() . '/inc/hook/structure.php';
require_once get_template_directory() . '/inc/hook/basic.php';
require_once get_template_directory() . '/inc/hook/custom.php';
require_once get_template_directory() . '/inc/hook/slider.php';
require_once get_template_directory() . '/inc/hook/css.php';

/**
 * Load metabox.
 */
require_once get_template_directory() . '/inc/metabox.php';

/**
 * Include Widgets.
 */
require_once get_template_directory() . '/inc/widgets.php';

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';
