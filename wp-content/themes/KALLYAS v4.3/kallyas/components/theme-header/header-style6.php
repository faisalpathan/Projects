<?php if(! defined('ABSPATH')){ return; }

/**
* Display the Style 6 header
* Hooks mostly, markup loaded through own template
*/

/**
 * ==========================================================
 * CSS custom classes customisations
 * ==========================================================
 */

/**
 * Add custom CSS classes to the <header> tag
 */
$header_class[] = 'siteheader-classic siteheader-classic-normal';


/**
 * Default Text Color Scheme.
 *
 * This will define de default text color scheme of this header style.
 *
 * @Types: sh--light OR sh--gray OR sh--dark
 */
$headerTextScheme = 'sh--dark';



// LOAD THE DEFAULT STYLE
include(locate_template('components/theme-header/header-style-default.php'));
