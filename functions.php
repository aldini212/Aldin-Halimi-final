<?php
/**
 * Aldin Halimi - Modern Portfolio Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

// Fallback menu function
function aldin_halimi_primary_menu_fallback() {
    ?>
    <ul id="primary-menu" class="primary-menu">
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <i class="fas fa-home"></i>
                <span class="menu-text"><?php esc_html_e('Home', 'aldin-halimi'); ?></span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/sample-page')); ?>">
                <i class="fas fa-file-alt"></i>
                <span class="menu-text"><?php esc_html_e('Sample Page', 'aldin-halimi'); ?></span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/blog')); ?>">
                <i class="fas fa-blog"></i>
                <span class="menu-text"><?php esc_html_e('Blog', 'aldin-halimi'); ?></span>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/contact')); ?>">
                <i class="fas fa-envelope"></i>
                <span class="menu-text"><?php esc_html_e('Contact', 'aldin-halimi'); ?></span>
            </a>
        </li>
    </ul>
    <?php
}

// Theme setup
function aldin_halimi_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true,
        'flex-height' => true,
    ));
    
    // Register menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer'  => 'Footer Menu',
    ));
    
    // Add image sizes
    add_image_size('featured-large', 1200, 800, true);
    add_image_size('featured-medium', 800, 600, true);
    add_image_size('featured-small', 400, 300, true);
}
add_action('after_setup_theme', 'aldin_halimi_setup');

// Enqueue styles and scripts
function aldin_halimi_scripts() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    // Main stylesheet
    wp_enqueue_style('aldin-halimi-style', get_stylesheet_uri(), array(), '1.0.2');
    
    // Custom styles
    wp_enqueue_style('aldin-halimi-custom', get_template_directory_uri() . '/css/custom.css', array(), '1.0.2');
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    
    // Main script
    wp_enqueue_script('aldin-halimi-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.1', true);
    
    // Menu script
    wp_enqueue_script('aldin-halimi-menu', get_template_directory_uri() . '/js/menu.js', array(), '1.0.0', true);
    
    // Shop page script
    if (is_page('shop')) {
        wp_enqueue_script('aldin-halimi-shop', get_template_directory_uri() . '/js/shop.js', array('jquery'), '1.0.0', true);
    }
    
    // Single product script (using a custom page template)
    if (is_page_template('single-product.php')) {
        wp_enqueue_script('aldin-halimi-product', get_template_directory_uri() . '/js/product.js', array('jquery'), '1.0.0', true);
    }
    
    // Cart script (load on all pages for cart icon functionality)
    wp_enqueue_script('aldin-halimi-cart', get_template_directory_uri() . '/js/cart.js', array('jquery'), '1.0.0', true);
    
    // Localize script for AJAX and cart data
    wp_localize_script('aldin-halimi-cart', 'aldin_halimi_data', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'cart_url' => home_url('/cart/')
    ));
}
add_action('wp_enqueue_scripts', 'aldin_halimi_scripts');

// Register widget areas
function aldin_halimi_widgets_init() {
    // Main Sidebar
    register_sidebar(array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Footer Widgets
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar(array(
            'name'          => sprintf('Footer Widget %d', $i),
            'id'            => 'footer-' . $i,
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'aldin_halimi_widgets_init');

// Custom excerpt length
function aldin_halimi_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'aldin_halimi_excerpt_length', 999);

// Custom excerpt more
function aldin_halimi_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'aldin_halimi_excerpt_more');

// Add class to next/previous post links
function aldin_halimi_posts_link_attributes() {
    return 'class="btn btn-outline-primary"';
}
add_filter('next_posts_link_attributes', 'aldin_halimi_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'aldin_halimi_posts_link_attributes');

// Custom logo class
function aldin_halimi_custom_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link">' . get_bloginfo('name') . '</a>';
    }
}

/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function aldin_halimi_post_thumbnail() {
    if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
        return;
    }

    if (is_singular()) :
        ?>
        <div class="post-thumbnail">
            <?php the_post_thumbnail(); ?>
        </div>
    <?php else : ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php
            the_post_thumbnail('post-thumbnail', array(
                'alt' => the_title_attribute(array('echo' => false)),
            ));
            ?>
        </a>
        <?php
    endif;
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function aldin_halimi_entry_footer() {
    // Hide category and tag text for pages.
    if ('post' === get_post_type()) {
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list(esc_html__(', ', 'aldin-halimi'));
        if ($categories_list) {
            /* translators: 1: list of categories. */
            echo '<span class="cat-links">' . $categories_list . '</span>';
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'aldin-halimi'));
        if ($tags_list) {
            /* translators: 1: list of tags. */
            echo '<span class="tags-links">' . $tags_list . '</span>';
        }
    }

    if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
        echo '<span class="comments-link">';
        comments_popup_link(
            sprintf(
                wp_kses(
                    /* translators: %s: post title */
                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'aldin-halimi'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );
        echo '</span>';
    }

    edit_post_link(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __('Edit <span class="screen-reader-text">%s</span>', 'aldin-halimi'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post(get_the_title())
        ),
        '<span class="edit-link">',
        '</span>'
    );
}
