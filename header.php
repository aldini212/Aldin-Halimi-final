<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="page-wrapper">
    <header class="site-header">
        <div class="container">
            <button id="dark-light-toggle" class="dark-light-btn">🌙</button>
            <div class="site-branding">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h1 class="site-title"><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></h1>';
                }
                ?>
            </div>

            
            <nav class="main-navigation" id="main-nav">
                <ul class="primary-menu">
                    <li class="menu-item">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo esc_url(home_url('/shop/')); ?>">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Shop</span>
                        </a>
                    </li>
                    <li class="menu-item menu-item-cart">
                        <a href="<?php echo esc_url(home_url('/cart/')); ?>">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Cart</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="main-content">
       
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
                                <p>aldinihalimi@gmail.com</p>
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
                                <p>123 Business Street, Podujev, kosova</p>
                            </div>
                        </div>
                    </div>
                    
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
