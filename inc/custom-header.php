<?php
/**
 * Custom header implementation
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Aldin_Halimi
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Set up the WordPress core custom header feature.
 */
function aldin_halimi_custom_header_setup() {
    $args = array(
        'default-image'      => '',
        'default-text-color' => '000000',
        'width'              => 1920,
        'height'             => 500,
        'flex-width'         => true,
        'flex-height'        => true,
        'wp-head-callback'   => 'aldin_halimi_header_style',
    );

    add_theme_support('custom-header', apply_filters('aldin_halimi_custom_header_args', $args));
}
add_action('after_setup_theme', 'aldin_halimi_custom_header_setup');

if (!function_exists('aldin_halimi_header_style')) :
    /**
     * Styles the header image and text displayed on the blog.
     */
    function aldin_halimi_header_style() {
        $header_text_color = get_header_textcolor();
        $header_image      = get_header_image();

        // If no custom options for text are set, let's bail.
        if (empty($header_image) && get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
            return;
        }

        // If we get this far, we have custom styles.
        ?>
        <style type="text/css" id="aldin-halimi-header-css">
        <?php
        // Has the text been hidden?
        if (!display_header_text()) :
            ?>
            .site-title,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }
            <?php
            // If the user has set a custom color for the text use that.
        else :
            ?>
            .site-title a,
            .site-description {
                color: #<?php echo esc_attr($header_text_color); ?>;
            }
        <?php endif; ?>

        <?php if (!empty($header_image)) : ?>
            .site-header {
                background-image: url(<?php header_image(); ?>);
                background-size: cover;
                background-position: center;
            }
        <?php endif; ?>
        </style>
        <?php
    }
endif;
