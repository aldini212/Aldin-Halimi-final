<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package Aldin_Halimi
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function aldin_halimi_body_classes($classes) {
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    // Add class if the current page has a featured image.
    if (is_singular() && has_post_thumbnail()) {
        $classes[] = 'has-featured-image';
    }

    // Add class for dark/light mode support
    $classes[] = 'color-scheme-light'; // Default to light mode

    return $classes;
}
add_filter('body_class', 'aldin_halimi_body_classes');



/**
 * Change excerpt length
 */
function aldin_halimi_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'aldin_halimi_excerpt_length', 999);

/**
 * Change excerpt more
 */
function aldin_halimi_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'aldin_halimi_excerpt_more');

/**
 * Add a class to the navigation buttons
 */
function aldin_halimi_posts_link_attributes() {
    return 'class="btn btn-primary"';
}
add_filter('next_posts_link_attributes', 'aldin_halimi_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'aldin_halimi_posts_link_attributes');

/**
 * Add no-js class to the html element
 */
function aldin_halimi_js_detection() {
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'aldin_halimi_js_detection', 0);

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 */
function aldin_halimi_search_form_modify($html) {
    return str_replace('class="search-submit"', 'class="search-submit screen-reader-text"', $html);
}
add_filter('get_search_form', 'aldin_halimi_search_form_modify');

/**
 * Add a title to posts that are missing titles
 */
function aldin_halimi_post_title($title) {
    if ($title == '') {
        return esc_html__('Untitled', 'aldin-halimi');
    } else {
        return $title;
    }
}
add_filter('the_title', 'aldin_halimi_post_title');

/**
 * Add responsive container to embeds
 */
function aldin_halimi_embed_html($html) {
    return '<div class="embed-container">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'aldin_halimi_embed_html', 10, 3);
add_filter('video_embed_html', 'aldin_halimi_embed_html'); // Jetpack

/**
 * Add a class to the navigation buttons
 */
function aldin_halimi_link_pages_link($link, $i) {
    global $page;
    if ($i == $page) {
        $link = str_replace('<a', '<a class="current"', $link);
    }
    return $link;
}
add_filter('wp_link_pages_link', 'aldin_halimi_link_pages_link', 10, 2);
