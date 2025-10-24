<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('single-page-layout'); ?>>
<?php wp_body_open(); ?>

<div class="page-wrapper">
    <header class="site-header">
        <div class="container">
            <div class="header-inner">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></h1>';
                    }
                    ?>
                </div>

                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-toggle-bar"></span>
                        <span class="menu-toggle-bar"></span>
                        <span class="menu-toggle-bar"></span>
                    </button>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'primary-menu',
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="' . esc_url(home_url('/shop')) . '"><i class="fas fa-store"></i> Shop</a></li><li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="' . esc_url(home_url('/my-account')) . '"><i class="fas fa-user"></i> My Account</a></li><li class="menu-item menu-item-cart"><a href="' . esc_url(home_url('/cart')) . '" class="cart-link"><i class="fas fa-shopping-cart"></i><span class="cart-count">0</span></a></li></ul>',
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </header>

    <main id="main-content">
        <!-- Hero Section -->
        <section class="fullscreen-section hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/hero.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="hero-content">
                    <h1><?php bloginfo('name'); ?></h1>
                    <p class="tagline"><?php bloginfo('description'); ?></p>
                    <div class="cta-buttons">
                        <a href="#about" class="btn btn-primary">About Us</a>
                        <a href="#contact" class="btn btn-outline">Contact</a>
                    </div>
                </div>
            </div>
            <a href="#about" class="scroll-down">
                <span>Scroll Down</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </section>

        <!-- About Section -->
        <section id="about" class="section-padding">
            <div class="container">
                <div class="section-header">
                    <h2>About Us</h2>
                    <div class="divider"></div>
                </div>
                <div class="about-content">
                    <div class="about-text">
                        <p>Welcome to <?php bloginfo('name'); ?>, where we create amazing experiences and deliver exceptional results. Our team of professionals is dedicated to providing the best service in the industry.</p>
                        <p>With years of experience and a passion for excellence, we strive to exceed our clients' expectations with every project we undertake.</p>
                        <div class="features-grid">
                            <div class="feature">
                                <div class="feature-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3>Quality</h3>
                                <p>We never compromise on quality and always deliver the best.</p>
                            </div>
                            <div class="feature">
                                <div class="feature-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <h3>Innovation</h3>
                                <p>We stay ahead with the latest trends and technologies.</p>
                            </div>
                            <div class="feature">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3>Team</h3>
                                <p>Our team consists of dedicated professionals.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="section-padding bg-light">
            <div class="container">
                <div class="section-header">
                    <h2>Get In Touch</h2>
                    <div class="divider"></div>
                    <p>Have questions? We'd love to hear from you.</p>
                </div>
                <div class="contact-container">
                    <div class="contact-info">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <h3>Email Us</h3>
                                <p>info@example.com</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-content">
                                <h3>Call Us</h3>
                                <p>(123) 456-7890</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="info-content">
                                <h3>Visit Us</h3>
                                <p>123 Business Street, City, Country</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form">
                        <?php echo do_shortcode('[contact-form-7 id="123" title="Contact form 1"]'); ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<?php wp_footer(); ?>
</body>
</html>

<div class="mobile-navigation" id="mobile-menu">
    <div class="mobile-menu-container">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class'     => 'mobile-menu',
            'container'      => false,
            'fallback_cb'    => false,
        ));
        ?>
        
        <div class="mobile-account-actions">
            <a href="#" class="btn btn-outline">
                <?php esc_html_e('My Account', 'aldin-halimi'); ?>
            </a>
        </div>
    </div>
</div>

<main id="main" class="site-main">
