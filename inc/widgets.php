<?php
/**
 * Register widget areas.
 *
 * @package Aldin_Halimi
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aldin_halimi_widgets_init() {
    // Main Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'aldin-halimi'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'aldin-halimi'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    // Footer Widget Area 1
    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'aldin-halimi'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'aldin-halimi'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Footer Widget Area 2
    register_sidebar(array(
        'name'          => esc_html__('Footer 2', 'aldin-halimi'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'aldin-halimi'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Footer Widget Area 3
    register_sidebar(array(
        'name'          => esc_html__('Footer 3', 'aldin-halimi'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'aldin-halimi'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));

    // Header Widget Area
    register_sidebar(array(
        'name'          => esc_html__('Header', 'aldin-halimi'),
        'id'            => 'header-widget',
        'description'   => esc_html__('Add widgets here to appear in your header.', 'aldin-halimi'),
        'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="header-widget-title">',
        'after_title'   => '</h3>',
    ));

    // Call to Action Widget Area
    register_sidebar(array(
        'name'          => esc_html__('Call to Action', 'aldin-halimi'),
        'id'            => 'cta-widget',
        'description'   => esc_html__('Add a call to action widget here.', 'aldin-halimi'),
        'before_widget' => '<div id="%1$s" class="cta-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="cta-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'aldin_halimi_widgets_init');

/**
 * Add custom classes to widgets
 */
function aldin_halimi_widget_custom_classes($params) {
    // Add custom class to all widgets
    $params[0]['before_widget'] = str_replace(
        'class="widget',
        'class="widget widget-custom',
        $params[0]['before_widget']
    );

    return $params;
}
add_filter('dynamic_sidebar_params', 'aldin_halimi_widget_custom_classes');

/**
 * Custom Widget: Recent Posts with Thumbnails
 */
class Aldin_Halimi_Recent_Posts_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'aldin_halimi_recent_posts',
            esc_html__('Recent Posts with Thumbnails', 'aldin-halimi'),
            array(
                'description' => esc_html__('Your most recent posts with thumbnails', 'aldin-halimi'),
                'customize_selective_refresh' => true,
            )
        );
    }

    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Recent Posts', 'aldin-halimi');
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;

        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        $recent_posts = new WP_Query(apply_filters('widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
        )));

        if ($recent_posts->have_posts()) :
            echo '<ul class="recent-posts-widget">';
            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                ?>
                <li class="recent-post-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="recent-post-thumbnail">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                    <?php endif; ?>
                    <div class="recent-post-content">
                        <h4 class="recent-post-title">
                            <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
                        </h4>
                        <span class="recent-post-date"><?php echo get_the_date(); ?></span>
                    </div>
                </li>
                <?php
            endwhile;
            echo '</ul>';
        endif;

        wp_reset_postdata();

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Recent Posts', 'aldin-halimi');
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'aldin-halimi'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                   type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">
                <?php esc_html_e('Number of posts to show:', 'aldin-halimi'); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>" 
                   type="number" step="1" min="1" value="<?php echo $number; ?>" size="3">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = (int) $new_instance['number'];
        return $instance;
    }
}

/**
 * Register custom widgets
 */
function aldin_halimi_register_widgets() {
    register_widget('Aldin_Halimi_Recent_Posts_Widget');
}
add_action('widgets_init', 'aldin_halimi_register_widgets');
