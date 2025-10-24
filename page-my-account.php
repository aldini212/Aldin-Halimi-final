<?php
/**
 * Template Name: My Account Dashboard
 */

get_header();

// Check if user is logged in
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url(get_permalink()));
    exit;
}

$current_user = wp_get_current_user();
?>

<div class="dashboard-page section-padding">
    <div class="container">
        <div class="dashboard-header">
            <h1>Welcome, <?php echo esc_html($current_user->display_name); ?>!</h1>
            <p>Here's your account overview</p>
        </div>

        <div class="dashboard-grid">
            <!-- User Profile -->
            <div class="dashboard-card profile-card">
                <div class="card-header">
                    <h2><i class="fas fa-user"></i> My Profile</h2>
                </div>
                <div class="card-content">
                    <div class="profile-info">
                        <div class="avatar">
                            <?php echo get_avatar($current_user->ID, 100); ?>
                        </div>
                        <div class="user-details">
                            <h3><?php echo esc_html($current_user->display_name); ?></h3>
                            <p><i class="fas fa-envelope"></i> <?php echo esc_html($current_user->user_email); ?></p>
                            <p><i class="fas fa-calendar"></i> Member since <?php echo date('F Y', strtotime($current_user->user_registered)); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="dashboard-card stats-card">
                <div class="card-header">
                    <h2><i class="fas fa-chart-line"></i> My Stats</h2>
                </div>
                <div class="card-content">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value">5</div>
                            <div class="stat-label">Orders</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">3</div>
                            <div class="stat-label">Wishlist</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">2</div>
                            <div class="stat-label">Reviews</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="dashboard-card orders-card">
                <div class="card-header">
                    <h2><i class="fas fa-shopping-bag"></i> Recent Orders</h2>
                </div>
                <div class="card-content">
                    <div class="orders-list">
                        <div class="order-item">
                            <div class="order-id">#1001</div>
                            <div class="order-date">Oct 24, 2025</div>
                            <div class="order-status">Completed</div>
                            <div class="order-total">$129.99</div>
                        </div>
                        <div class="order-item">
                            <div class="order-id">#1000</div>
                            <div class="order-date">Oct 15, 2025</div>
                            <div class="order-status">Completed</div>
                            <div class="order-total">$89.99</div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-outline view-all">View All Orders</a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="dashboard-card actions-card">
                <div class="card-header">
                    <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
                </div>
                <div class="card-content">
                    <div class="quick-actions">
                        <a href="#" class="action-item">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Continue Shopping</span>
                        </a>
                        <a href="#" class="action-item">
                            <i class="fas fa-heart"></i>
                            <span>Wishlist</span>
                        </a>
                        <a href="#" class="action-item">
                            <i class="fas fa-cog"></i>
                            <span>Account Settings</span>
                        </a>
                        <a href="<?php echo wp_logout_url(home_url()); ?>" class="action-item">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
