<?php
/**
 * Aldin Halimi Theme Customizer
 *
 * @package Aldin_Halimi
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function aldin_halimi_customize_register($wp_customize) {
    // Add theme options panel
    $wp_customize->add_panel('aldin_halimi_theme_options', array(
        'title'    => __('Theme Options', 'aldin-halimi'),
        'priority' => 130,
    ));

    // Header Section
    $wp_customize->add_section('aldin_halimi_header_options', array(
        'title'    => __('Header Options', 'aldin-halimi'),
        'panel'    => 'aldin_halimi_theme_options',
        'priority' => 10,
    ));

    // Footer Section
    $wp_customize->add_section('aldin_halimi_footer_options', array(
        'title'    => __('Footer Options', 'aldin-halimi'),
        'panel'    => 'aldin_halimi_theme_options',
        'priority' => 20,
    ));

    // Add settings and controls for header text color
    $wp_customize->add_setting('header_textcolor', array(
        'default'           => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_textcolor', array(
        'label'    => __('Header Text Color', 'aldin-halimi'),
        'section'  => 'colors',
        'settings' => 'header_textcolor',
    )));

    // Add footer copyright text
    $wp_customize->add_setting('aldin_halimi_footer_text', array(
        'default'           => sprintf(esc_html__('© %d Aldin Halimi. All rights reserved.', 'aldin-halimi'), date('Y')),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('aldin_halimi_footer_text_control', array(
        'label'    => __('Footer Copyright Text', 'aldin-halimi'),
        'section'  => 'aldin_halimi_footer_options',
        'settings' => 'aldin_halimi_footer_text',
        'type'     => 'text',
    ));

    // Add social media links
    $social_networks = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'pinterest');
    
    foreach ($social_networks as $network) {
        $wp_customize->add_setting('aldin_halimi_' . $network . '_url', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('aldin_halimi_' . $network . '_control', array(
            'label'    => ucfirst($network) . ' URL',
            'section'  => 'aldin_halimi_footer_options',
            'settings' => 'aldin_halimi_' . $network . '_url',
            'type'     => 'url',
        ));
    }

    // Add theme layout option
    $wp_customize->add_section('aldin_halimi_layout_options', array(
        'title'    => __('Layout Options', 'aldin-halimi'),
        'panel'    => 'aldin_halimi_theme_options',
        'priority' => 30,
    ));

    $wp_customize->add_setting('aldin_halimi_layout', array(
        'default'           => 'right-sidebar',
        'sanitize_callback' => 'aldin_halimi_sanitize_layout',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('aldin_halimi_layout_control', array(
        'label'    => __('Default Layout', 'aldin-halimi'),
        'section'  => 'aldin_halimi_layout_options',
        'settings' => 'aldin_halimi_layout',
        'type'     => 'radio',
        'choices'  => array(
            'right-sidebar' => __('Right Sidebar', 'aldin-halimi'),
            'left-sidebar'  => __('Left Sidebar', 'aldin-halimi'),
            'no-sidebar'    => __('No Sidebar', 'aldin-halimi'),
            'full-width'    => __('Full Width', 'aldin-halimi'),
        ),
    ));
}
add_action('customize_register', 'aldin_halimi_customize_register');

/**
 * Sanitize the layout options.
 */
function aldin_halimi_sanitize_layout($input) {
    $valid = array(
        'right-sidebar' => __('Right Sidebar', 'aldin-halimi'),
        'left-sidebar'  => __('Left Sidebar', 'aldin-halimi'),
        'no-sidebar'    => __('No Sidebar', 'aldin-halimi'),
        'full-width'    => __('Full Width', 'aldin-halimi'),
    );

    if (array_key_exists($input, $valid)) {
        return $input;
    }

    return '';
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function aldin_halimi_customize_preview_js() {
    wp_enqueue_script('aldin-halimi-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), wp_get_theme()->get('Version'), true);
}
add_action('customize_preview_init', 'aldin_halimi_customize_preview_js');

/**
 * Add custom CSS to wp_head
 */
function aldin_halimi_customizer_css() {
    ?>
    <style type="text/css">
        .site-header {
            background-color: <?php echo esc_attr(get_theme_mod('header_background_color', '#ffffff')); ?>;
        }
        .site-title a {
            color: <?php echo esc_attr(get_theme_mod('header_textcolor', '#333333')); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'aldin_halimi_customizer_css');
