<?php

/**
 * author:jeffstric
 * email:jeffstricg@gmail.com
 * blog:jeffsc.info
 * datetime:2012-11-3, 17:03:33
 * */

/**
 * Override or insert variables into the html template.
 */
function grayscale_process_html(&$vars) {
// Add classes for the font styles
    $classes = explode(' ', $vars['classes']);
    $classes[] = theme_get_setting('font_family');
    $classes[] = theme_get_setting('font_size');
    $vars['classes'] = trim(implode(' ', $classes));
}

/**
 * Returns HTML for a breadcrumb trail.
 *
 * @param $variables
 *   An associative array containing:
 *   - breadcrumb: An array containing the breadcrumb links.
 */
//function grayscale_breadcrumb($variables) {
//  $breadcrumb = $variables['breadcrumb'];
//
//  if (!empty($breadcrumb)) {
//    // Provide a navigational heading to give context for breadcrumb links to
//    // screen-reader users. Make the heading invisible with .element-invisible.
//    $output = '<h2 class="element-invisible">' . 'I will rich' . '</h2>';
//
//    $output .= '<div class="breadcrumb">' . implode(' » ', $breadcrumb) . '</div>';
//    return $output;
//  }
//}

?>