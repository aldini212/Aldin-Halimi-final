<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Aldin_Halimi
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Enqueue scripts and styles.
 */
function aldin_halimi_scripts() {
    // Theme stylesheet
    wp_enqueue_style('aldin-halimi-style', get_stylesheet_uri(), array(), ALDIN_HALIMI_VERSION);
    
    // Google Fonts
    wp_enqueue_style('aldin-halimi-google-fonts', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Futura+PT:wght@400;500;600;700&display=swap', array(), null);
    
    // Main stylesheet
    wp_enqueue_style('aldin-halimi-main', get_template_directory_uri() . '/assets/css/main.css', array(), ALDIN_HALIMI_VERSION);
    
    // Main JavaScript
    wp_enqueue_script('aldin-halimi-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), ALDIN_HALIMI_VERSION, true);
    
    // Main theme script
    wp_enqueue_script('aldin-halimi-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), ALDIN_HALIMI_VERSION, true);
    
    // Localize script with theme settings
    wp_localize_script('aldin-halimi-script', 'aldinHalimiSettings', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'homeUrl' => home_url(),
        'isMobile' => wp_is_mobile()
    ));

    // Add comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'aldin_halimi_scripts');

/**
 * Enqueue block editor styles.
 */
function aldin_halimi_editor_styles() {
    // Add custom fonts to the editor
    wp_enqueue_style('aldin-halimi-editor-fonts', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Futura+PT:wght@400;500;600;700&display=swap', array(), null);
    
    // Add editor styles
    add_editor_style(array(
        'assets/css/editor-style.css',
        'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Futura+PT:wght@400;500;600;700&display=swap'
    ));
}
add_action('admin_init', 'aldin_halimi_editor_styles');

/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls          HTML link tags.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array $urls          HTML link tags.
 */
function aldin_halimi_resource_hints($urls, $relation_type) {
    if (wp_style_is('aldin-halimi-google-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'aldin_halimi_resource_hints', 10, 2);

/**
 * Add async/defer attributes to enqueued scripts that have the specified script as a dependency.
 *
 * @param string $tag    The script tag.
 * @param string $handle The script handle.
 * @return string
 */
function aldin_halimi_script_loader_tag($tag, $handle) {
    // Add async to main.js
    if ('aldin-halimi-script' === $handle) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    // Add async to navigation.js
    if ('aldin-halimi-navigation' === $handle) {
        return str_replace(' src', ' async src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'aldin_halimi_script_loader_tag', 10, 2);
