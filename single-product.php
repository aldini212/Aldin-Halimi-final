<?php
/**
 * Single Product Template
 */

get_header();

// Get product data (in a real scenario, this would come from a database)
$product = [
    'id' => 'prod_001',
    'name' => 'AIR JORDAN 1 RETRO HIGH',
    'price' => '$180.00',
    'description' => 'The Air Jordan 1 Retro High remakes the classic sneaker, giving you a fresh look with a familiar feel. Premium materials with new colors and textures give modern expression to an all-time favorite.',
    'images' => [
        get_template_directory_uri() . '/images/jordan-1.jpg',
        get_template_directory_uri() . '/images/jordan-1-side.jpg',
        get_template_directory_uri() . '/images/jordan-1-back.jpg',
    ],
    'sizes' => ['US 7', 'US 8', 'US 9', 'US 10', 'US 11', 'US 12'],
    'colors' => [
        ['name' => 'Black/Red', 'value' => '#000000'],
        ['name' => 'White/Red', 'value' => '#ffffff'],
        ['name' => 'Royal Blue', 'value' => '#1e3a8a']
    ],
    'features' => [
        'Leather and textile upper',
        'Rubber outsole for traction',
        'Air-Sole unit for cushioning',
        'Classic design elements',
        'High-top design for ankle support'
    ],
    'reviews' => [
        ['author' => 'Alex M.', 'rating' => 5, 'comment' => 'Amazing shoes! Super comfortable and stylish.'],
        ['author' => 'Jordan P.', 'rating' => 4, 'comment' => 'Great quality, but runs a bit small.']
    ]
];
?>

<div class="single-product-page section-padding">
    <div class="container">
        <div class="product-breadcrumb">
            <a href="<?php echo home_url('/shop'); ?>">Shop</a>
            <span>/</span>
            <a href="#">Sneakers</a>
            <span>/</span>
            <span><?php echo $product['name']; ?></span>
        </div>

        <div class="product-detail">
            <div class="product-gallery">
                <div class="main-image">
                    <img src="<?php echo $product['images'][0]; ?>" alt="<?php echo $product['name']; ?>" id="main-product-image">
                </div>
                <div class="thumbnail-images">
                    <?php foreach ($product['images'] as $index => $image): ?>
                        <div class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?>" data-image="<?php echo $image; ?>">
                            <img src="<?php echo $image; ?>" alt="<?php echo $product['name']; ?> - View <?php echo $index + 1; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="product-info">
                <h1 class="product-title"><?php echo $product['name']; ?></h1>
                <div class="product-price"><?php echo $product['price']; ?></div>
                
                <div class="product-rating">
                    <div class="stars">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <a href="#reviews" class="review-link">(24 reviews)</a>
                </div>

                <div class="product-description">
                    <p><?php echo $product['description']; ?></p>
                </div>

                <form class="product-options">
                    <div class="option-group">
                        <label>Color:</label>
                        <div class="color-options">
                            <?php foreach ($product['colors'] as $color): ?>
                                <label class="color-option">
                                    <input type="radio" name="color" value="<?php echo strtolower($color['name']); ?>" 
                                        <?php echo $color['name'] === 'Black/Red' ? 'checked' : ''; ?>>
                                    <span class="color-swatch" style="background-color: <?php echo $color['value']; ?>"></span>
                                    <span class="color-name"><?php echo $color['name']; ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="option-group">
                        <label for="size">Size:</label>
                        <div class="size-selector">
                            <?php foreach ($product['sizes'] as $size): ?>
                                <label class="size-option">
                                    <input type="radio" name="size" value="<?php echo $size; ?>" 
                                        <?php echo $size === 'US 9' ? 'checked' : ''; ?>>
                                    <span class="size-value"><?php echo $size; ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <a href="#size-guide" class="size-guide-link">Size Guide</a>
                    </div>

                    <div class="quantity-selector">
                        <label for="quantity">Quantity:</label>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn minus">-</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="10">
                            <button type="button" class="quantity-btn plus">+</button>
                        </div>
                    </div>

                    <div class="product-actions">
                        <button type="submit" class="btn btn-black btn-add-to-cart">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                        <button type="button" class="btn btn-outline btn-wishlist">
                            <i class="far fa-heart"></i> Add to Wishlist
                        </button>
                    </div>
                </form>

                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">SKU:</span>
                        <span class="meta-value"><?php echo $product['id']; ?></span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Category:</span>
                        <a href="#" class="meta-value">Sneakers</a>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Share:</span>
                        <div class="social-share">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-tabs">
            <ul class="tabs-nav">
                <li class="active" data-tab="description">Description</li>
                <li data-tab="features">Features</li>
                <li data-tab="reviews" id="reviews-tab">Reviews (<?php echo count($product['reviews']); ?>)</li>
                <li data-tab="shipping">Shipping & Returns</li>
            </ul>

            <div class="tabs-content">
                <div class="tab-pane active" id="description">
                    <h3>Product Description</h3>
                    <p><?php echo $product['description']; ?></p>
                    <p>The Air Jordan 1 Retro High features a full-grain leather upper with perforations on the toe box for breathability. The shoe has a padded collar and a Nike Air cushioning unit in the midsole for comfort. The rubber outsole provides excellent traction on a variety of surfaces.</p>
                </div>

                <div class="tab-pane" id="features">
                    <h3>Product Features</h3>
                    <ul class="feature-list">
                        <?php foreach ($product['features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="tab-pane" id="reviews">
                    <h3>Customer Reviews</h3>
                    <div class="reviews-summary">
                        <div class="average-rating">
                            <div class="rating-number">4.8</div>
                            <div class="stars">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <div class="total-reviews">Based on 24 reviews</div>
                        </div>
                        <div class="rating-bars">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <div class="rating-bar">
                                    <span class="star-count"><?php echo $i; ?> <i class="fas fa-star"></i></span>
                                    <div class="bar-container">
                                        <div class="bar" style="width: <?php echo (100 - (($i - 1) * 10)); ?>%"></div>
                                    </div>
                                    <span class="percentage"><?php echo (100 - (($i - 1) * 10)); ?>%</span>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="review-form">
                        <h4>Write a Review</h4>
                        <form>
                            <div class="form-group">
                                <label>Your Rating</label>
                                <div class="rating-input">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="far fa-star" data-rating="<?php echo $i; ?>"></i>
                                    <?php endfor; ?>
                                    <input type="hidden" name="rating" id="rating-value" value="5">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="review-title">Review Title</label>
                                <input type="text" id="review-title" name="review-title" placeholder="Give your review a title" required>
                            </div>
                            <div class="form-group">
                                <label for="review-comment">Your Review</label>
                                <textarea id="review-comment" name="review-comment" rows="5" placeholder="What did you think of this product?" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="review-name">Your Name</label>
                                <input type="text" id="review-name" name="review-name" required>
                            </div>
                            <div class="form-group">
                                <label for="review-email">Email Address (will not be published)</label>
                                <input type="email" id="review-email" name="review-email" required>
                            </div>
                            <button type="submit" class="btn btn-black">Submit Review</button>
                        </form>
                    </div>
                </div>

                <div class="tab-pane" id="shipping">
                    <h3>Shipping Information</h3>
                    <div class="shipping-info">
                        <div class="shipping-method">
                            <h4><i class="fas fa-truck"></i> Standard Shipping</h4>
                            <p>Estimated delivery: 3-5 business days</p>
                            <p>Free shipping on all orders over $100</p>
                        </div>
                        <div class="shipping-method">
                            <h4><i class="fas fa-rocket"></i> Express Shipping</h4>
                            <p>Estimated delivery: 1-2 business days</p>
                            <p>Flat rate: $15.00</p>
                        </div>
                        <div class="shipping-method">
                            <h4><i class="fas fa-undo"></i> Returns</h4>
                            <p>30-day return policy. Items must be unworn and in original condition.</p>
                            <a href="#" class="return-policy-link">View full return policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="related-products">
            <h3>You May Also Like</h3>
            <div class="products-grid">
                <?php
                $related_products = [
                    [
                        'title' => 'NIKE DUNK LOW RETRO',
                        'price' => '$120',
                        'image' => get_template_directory_uri() . '/images/dunk-low.jpg',
                        'category' => 'Sneakers',
                        'tag' => 'Bestseller'
                    ],
                    [
                        'title' => 'OVERSIZED T-SHIRT',
                        'price' => '$45',
                        'image' => get_template_directory_uri() . '/images/oversized-tshirt.jpg',
                        'category' => 'Tops',
                        'tag' => 'New'
                    ],
                    [
                        'title' => 'CARGO PANTS',
                        'price' => '$85',
                        'image' => get_template_directory_uri() . '/images/cargo-pants.jpg',
                        'category' => 'Bottoms',
                        'tag' => 'Trending'
                    ]
                ];

                foreach ($related_products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <a href="<?php echo home_url('/product/sample-product'); ?>">
                                <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['title']); ?>">
                            </a>
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
                            <h3 class="product-title">
                                <a href="<?php echo home_url('/product/sample-product'); ?>">
                                    <?php echo esc_html($product['title']); ?>
                                </a>
                            </h3>
                            <div class="product-meta">
                                <span class="price"><?php echo esc_html($product['price']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Size Guide Modal -->
<div id="size-guide-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Size Guide</h3>
        <div class="size-guide-content">
            <div class="size-chart">
                <table>
                    <thead>
                        <tr>
                            <th>US Size</th>
                            <th>UK Size</th>
                            <th>EU Size</th>
                            <th>CM</th>
                            <th>Inches</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>7</td>
                            <td>6</td>
                            <td>40</td>
                            <td>25.1</td>
                            <td>9.9</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>7</td>
                            <td>41</td>
                            <td>26</td>
                            <td>10.2</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>8</td>
                            <td>42</td>
                            <td>26.7</td>
                            <td>10.5</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>9</td>
                            <td>43</td>
                            <td>27.3</td>
                            <td>10.7</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>10</td>
                            <td>44</td>
                            <td>28</td>
                            <td>11</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="size-guide-tips">
                <h4>How to measure your foot</h4>
                <ol>
                    <li>Place a piece of paper on the floor against a wall.</li>
                    <li>Stand on the paper with your heel against the wall.</li>
                    <li>Mark the end of your longest toe on the paper.</li>
                    <li>Measure from the edge of the paper to your mark in centimeters.</li>
                    <li>Use the size chart above to find your perfect fit.</li>
                </ol>
                <p class="note">Note: If you're between sizes, we recommend sizing up.</p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
