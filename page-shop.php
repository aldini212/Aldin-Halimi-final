<?php
get_header();
?>

<div class="streetwear-shop">
    <div class="shop-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/streetwear-bg.jpg');">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>URBAN STREETWEAR</h1>
            <p>Limited Edition Drops • Exclusive Collections</p>
            <a href="#featured" class="btn btn-white">Shop Now</a>
        </div>
    </div>

    <section id="featured" class="featured-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">NEW ARRIVALS</span>
                <h2>Latest Drops</h2>
            </div>

            <div class="products-grid">
                <?php
                $products = array(
                    array(
                        'title' => 'AIR JORDAN 1 RETRO HIGH',
                        'price' => '$180',
                        'image' => get_template_directory_uri() . '/images/jordan-1.jpg',
                        'category' => 'Sneakers',
                        'tag' => 'Just Dropped'
                    ),
                    array(
                        'title' => 'NIKE DUNK LOW RETRO',
                        'price' => '$120',
                        'image' => get_template_directory_uri() . '/images/dunk-low.jpg',
                        'category' => 'Sneakers',
                        'tag' => 'Bestseller'
                    ),
                    array(
                        'title' => 'OVERSIZED T-SHIRT',
                        'price' => '$45',
                        'image' => get_template_directory_uri() . '/images/oversized-tshirt.jpg',
                        'category' => 'Tops',
                        'tag' => 'New'
                    ),
                    array(
                        'title' => 'CARGO PANTS',
                        'price' => '$85',
                        'image' => get_template_directory_uri() . '/images/cargo-pants.jpg',
                        'category' => 'Bottoms',
                        'tag' => 'Trending'
                    ),
                    array(
                        'title' => 'HOODIE ESSENTIALS',
                        'price' => '$75',
                        'image' => get_template_directory_uri() . '/images/hoodie.jpg',
                        'category' => 'Outerwear',
                        'tag' => 'Sale'
                    ),
                    array(
                        'title' => 'SNAPBACK CAP',
                        'price' => '$35',
                        'image' => get_template_directory_uri() . '/images/snapback.jpg',
                        'category' => 'Accessories',
                        'tag' => 'Limited'
                    ),
                    array(
                        'title' => 'yankee  cap',
                        'price' => '$35',
                        'image' => get_template_directory_uri() . '/images/snapback1.jpg',
                        'category' => 'Accessories',
                        'tag' => 'Limited'
                    ),
                    array(
                        'title' => 'Nike Jordan 4s',
                        'price' => '$375',
                        'image' => get_template_directory_uri() . '/images/jordan4.jpg',
                        'category' => 'sneakers',
                        'tag' => 'Limited'
                    ),
                    
                );

                foreach ($products as $product) :
                ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                            <div class="product-tag"><?php echo esc_html($product['tag']); ?></div>
                            <div class="product-actions">
                                <button class="quick-view" title="Quick View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="add-to-wishlist" title="Add to Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                            <button class="add-to-cart">
                                <span>ADD TO CART</span>
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category"><?php echo esc_html($product['category']); ?></span>
                            <h3 class="product-title"><?php echo esc_html($product['title']); ?></h3>
                            <div class="product-meta">
                                <span class="price"><?php echo esc_html($product['price']); ?></span>
                                <div class="product-sizes">
                                    <span>Size:</span>
                                    <select>
                                        <option>S</option>
                                        <option>M</option>
                                        <option>L</option>
                                        <option>XL</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <div class="categories-banner">
        <div class="category-item" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/mens-category.jpg');">
            <div class="category-content">
                <h3>MEN'S</h3>
                <a href="#" class="btn btn-outline">Shop Now</a>
            </div>
        </div>
        <div class="category-item" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/womens-category.jpg');">
            <div class="category-content">
                <h3>WOMEN'S</h3>
                <a href="#" class="btn btn-outline">Shop Now</a>
            </div>
        </div>
    </div>

    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h3>JOIN THE CREW</h3>
                <p>Subscribe to get 10% off your first order and exclusive access to new drops.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-black">SUBSCRIBE</button>
                </form>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
