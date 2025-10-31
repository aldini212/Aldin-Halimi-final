<?php


get_header();
?>

<div class="cart-page section-padding">
    <div class="container">
        <div class="section-header">
            <h1>Your Cart</h1>
            <div class="divider"></div>
        </div>

        <div class="cart-container">
            <div class="cart-items">
                <div class="cart-header">
                    <div class="header-item product">Product</div>
                    <div class="header-item price">Price</div>
                    <div class="header-item quantity">Quantity</div>
                    <div class="header-item total">Total</div>
                    <div class="header-item remove"></div>
                </div>
                
                <div class="cart-items-list" id="cart-items">
                    
                    <div class="cart-empty">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Your cart is empty</p>
                        <a href="<?php echo home_url('/shop'); ?>" class="btn btn-black">Continue Shopping</a>
                    </div>
                </div>
            </div>

            <div class="cart-summary">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="cart-subtotal">$0.00</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span id="shipping-cost">Calculated at checkout</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="cart-total">$0.00</span>
                </div>
                <button id="checkout-btn" class="btn btn-black btn-block" disabled>Proceed to Checkout</button>
                <p class="continue-shopping">
                    <a href="<?php echo home_url('/shop'); ?>">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>


<div id="quick-view-modal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="quick-view-content">
        
        </div>
    </div>
</div>

<?php get_footer(); ?>
