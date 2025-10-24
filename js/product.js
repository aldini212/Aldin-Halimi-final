// Product Page Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Image Gallery
    const mainImage = document.getElementById('main-product-image');
    const thumbnails = document.querySelectorAll('.thumbnail');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Update main image
            const newSrc = this.dataset.image;
            mainImage.src = newSrc;
            
            // Update active thumbnail
            document.querySelector('.thumbnail.active').classList.remove('active');
            this.classList.add('active');
        });
    });

    // Color Selection
    const colorOptions = document.querySelectorAll('.color-option input');
    colorOptions.forEach(option => {
        option.addEventListener('change', function() {
            // In a real implementation, you would update the product image/variants here
            console.log('Selected color:', this.value);
        });
    });

    // Size Selection
    const sizeOptions = document.querySelectorAll('.size-option input');
    sizeOptions.forEach(option => {
        option.addEventListener('change', function() {
            // Update active state
            document.querySelector('.size-option input:checked').parentElement.classList.remove('active');
            this.parentElement.classList.add('active');
        });
    });

    // Quantity Selector
    const quantityInput = document.getElementById('quantity');
    const minusBtn = document.querySelector('.quantity-btn.minus');
    const plusBtn = document.querySelector('.quantity-btn.plus');
    
    minusBtn.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    });
    
    plusBtn.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if (value < 10) {
            quantityInput.value = value + 1;
        }
    });

    // Rating Stars
    const stars = document.querySelectorAll('.rating-input .fa-star');
    const ratingValue = document.getElementById('rating-value');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.dataset.rating;
            ratingValue.value = rating;
            
            // Update star display
            stars.forEach((s, index) => {
                if (index < rating) {
                    s.classList.remove('far');
                    s.classList.add('fas');
                } else {
                    s.classList.remove('fas');
                    s.classList.add('far');
                }
            });
        });
        
        // Hover effect
        star.addEventListener('mouseover', function() {
            const hoverRating = this.dataset.rating;
            stars.forEach((s, index) => {
                if (index < hoverRating) {
                    s.classList.add('hover');
                } else {
                    s.classList.remove('hover');
                }
            });
        });
        
        star.addEventListener('mouseout', function() {
            stars.forEach(s => s.classList.remove('hover'));
        });
    });

    // Tabs
    const tabLinks = document.querySelectorAll('.tabs-nav li');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const tabId = this.dataset.tab;
            
            // Update active tab
            document.querySelector('.tabs-nav li.active').classList.remove('active');
            this.classList.add('active');
            
            // Show corresponding tab content
            tabPanes.forEach(pane => {
                if (pane.id === tabId) {
                    pane.classList.add('active');
                } else {
                    pane.classList.remove('active');
                }
            });
            
            // If reviews tab, scroll to it
            if (tabId === 'reviews') {
                document.getElementById('reviews').scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Size Guide Modal
    const sizeGuideBtn = document.querySelector('.size-guide-link');
    const sizeGuideModal = document.getElementById('size-guide-modal');
    const closeModalBtns = document.querySelectorAll('.close-modal');
    
    if (sizeGuideBtn) {
        sizeGuideBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sizeGuideModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    }
    
    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            sizeGuideModal.style.display = 'none';
            document.body.style.overflow = '';
        });
    });
    
    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === sizeGuideModal) {
            sizeGuideModal.style.display = 'none';
            document.body.style.overflow = '';
        }
    });

    // Add to Cart
    const addToCartBtn = document.querySelector('.btn-add-to-cart');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const product = {
                id: '<?php echo $product["id"]; ?>',
                name: '<?php echo $product["name"]; ?>',
                price: '<?php echo $product["price"]; ?>',
                size: document.querySelector('.size-option input:checked').value,
                color: document.querySelector('.color-option input:checked').value,
                quantity: parseInt(quantityInput.value),
                image: mainImage.src
            };
            
            addToCart(product);
            updateCartCount();
            showNotification('Added to cart: ' + product.name);
        });
    }

    // Wishlist
    const wishlistBtn = document.querySelector('.btn-wishlist');
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.toggle('active');
            
            if (this.classList.contains('active')) {
                this.innerHTML = '<i class="fas fa-heart"></i> In Wishlist';
                showNotification('Added to wishlist');
            } else {
                this.innerHTML = '<i class="far fa-heart"></i> Add to Wishlist';
                showNotification('Removed from wishlist');
            }
        });
    }
});

// Cart Functions
function addToCart(product) {
    const cart = JSON.parse(localStorage.getItem('streetwearCart')) || [];
    const existingItemIndex = cart.findIndex(item => 
        item.id === product.id && 
        item.size === product.size && 
        item.color === product.color
    );
    
    if (existingItemIndex > -1) {
        cart[existingItemIndex].quantity += product.quantity;
    } else {
        cart.push(product);
    }
    
    localStorage.setItem('streetwearCart', JSON.stringify(cart));
}

function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('streetwearCart')) || [];
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    const cartCount = document.querySelector('.cart-count');
    
    if (cartCount) {
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    document.body.appendChild(notification);
    
    // Trigger the animation
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // Remove the notification after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});
