// Shopping Cart Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize cart if it doesn't exist
    if (!localStorage.getItem('streetwearCart')) {
        localStorage.setItem('streetwearCart', JSON.stringify([]));
    }

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productCard = this.closest('.product-card');
            const productId = productCard.dataset.productId || Date.now();
            const productName = productCard.querySelector('.product-title').textContent;
            const productPrice = productCard.querySelector('.price').textContent;
            const productSize = productCard.querySelector('select') ? productCard.querySelector('select').value : 'One Size';
            const productImage = productCard.querySelector('img').src;

            const product = {
                id: productId,
                name: productName,
                price: productPrice,
                size: productSize,
                image: productImage,
                quantity: 1
            };

            addToCart(product);
            updateCartCount();
            showNotification('Added to cart: ' + productName);
        });
    });

    // Quick view functionality
    document.querySelectorAll('.quick-view').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productCard = this.closest('.product-card');
            const productId = productCard.dataset.productId || '1';
            // In a real implementation, you would fetch product details via AJAX
            openQuickView(productId);
        });
    });

    // Wishlist functionality
    document.querySelectorAll('.add-to-wishlist').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productCard = this.closest('.product-card');
            const productName = productCard.querySelector('.product-title').textContent;
            this.classList.toggle('active');
            
            if (this.classList.contains('active')) {
                this.innerHTML = '<i class="fas fa-heart"></i>';
                showNotification('Added to wishlist: ' + productName);
            } else {
                this.innerHTML = '<i class="far fa-heart"></i>';
                showNotification('Removed from wishlist: ' + productName);
            }
        });
    });
});

// Cart functions
function addToCart(product) {
    const cart = JSON.parse(localStorage.getItem('streetwearCart'));
    const existingItem = cart.find(item => item.id === product.id && item.size === product.size);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push(product);
    }
    
    localStorage.setItem('streetwearCart', JSON.stringify(cart));
}

function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('streetwearCart'));
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
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
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
