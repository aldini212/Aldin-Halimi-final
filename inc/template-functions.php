<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Aldin_Halimi
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Displays the site logo, either text or image.
 *
 * @param array $args Arguments for displaying the site logo.
 * @return void
 */
function aldin_halimi_site_logo($args = array()) {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        $site_title = get_bloginfo('name');
        $tag_name   = (is_front_page() && !is_paged()) ? 'h1' : 'p';
        
        if ($site_title) {
            echo sprintf(
                '<%1$s class="site-title"><a href="%2$s" rel="home">%3$s</a></%1$s>',
                tag_escape($tag_name),
                esc_url(home_url('/')),
                esc_html($site_title)
            );
        }

        $description = get_bloginfo('description', 'display');
        if ($description && (is_front_page() || is_home())) {
            echo '<p class="site-description">' . esc_html($description) . '</p>';
        }
    }
}

/**
 * Adds a class to the body element for pages that have a featured image.
 *
 * @param array $classes CSS classes.
 * @return array Modified class list.
 */
function aldin_halimit_body_classes($classes) {
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

    return $classes;
}
add_filter('body_class', 'aldin_halimit_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function aldin_halimi_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'aldin_halimi_pingback_header');

/**
 * Get the SVG code for a given icon.
 *
 * @param string $icon The icon name.
 * @return string SVG code for the icon.
 */
function aldin_halimi_get_icon($icon = '') {
    $icons = array(
        'search' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        'menu' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>',
        'close' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
    );

    return isset($icons[$icon]) ? $icons[$icon] : '';
}


/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function aldin_halimi_post_classes($classes) {
    $classes[] = 'entry';
    
    // Add class if post has a featured image
    if (has_post_thumbnail()) {
        $classes[] = 'has-post-thumbnail';
    }
    
    return $classes;
}
add_filter('post_class', 'aldin_halimi_post_classes');
