// Cart Page Functionality
document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cart-items');
    const cartSubtotal = document.getElementById('cart-subtotal');
    const cartTotal = document.getElementById('cart-total');
    const checkoutBtn = document.getElementById('checkout-btn');
    
    // Load cart items
    function loadCart() {
        const cart = JSON.parse(localStorage.getItem('streetwearCart')) || [];
        
        if (cart.length === 0) {
            showEmptyCart();
            return;
        }
        
        // Clear existing items
        cartItemsContainer.innerHTML = '';
        
        // Add each item to the cart
        cart.forEach((item, index) => {
            const itemElement = createCartItemElement(item, index);
            cartItemsContainer.appendChild(itemElement);
        });
        
        // Update totals
        updateCartTotals(cart);
        
        // Enable checkout button
        checkoutBtn.disabled = false;
    }
    
    // Create cart item element
    function createCartItemElement(item, index) {
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.dataset.index = index;
        
        // Calculate total price
        const price = parseFloat(item.price.replace('$', ''));
        const total = (price * item.quantity).toFixed(2);
        
        itemElement.innerHTML = `
            <div class="item-product">
                <div class="item-image">
                    <img src="${item.image}" alt="${item.name}">
                </div>
                <div class="item-details">
                    <h4>${item.name}</h4>
                    <div class="item-variants">
                        ${item.color ? `<span>Color: ${item.color}</span>` : ''}
                        ${item.size ? `<span>Size: ${item.size}</span>` : ''}
                    </div>
                </div>
            </div>
            <div class="item-price">${item.price}</div>
            <div class="item-quantity">
                <button class="quantity-btn minus">-</button>
                <input type="number" value="${item.quantity}" min="1" max="10">
                <button class="quantity-btn plus">+</button>
            </div>
            <div class="item-total">$${total}</div>
            <div class="item-remove">
                <button class="remove-btn" title="Remove item">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        // Add event listeners
        const minusBtn = itemElement.querySelector('.minus');
        const plusBtn = itemElement.querySelector('.plus');
        const quantityInput = itemElement.querySelector('input');
        const removeBtn = itemElement.querySelector('.remove-btn');
        
        minusBtn.addEventListener('click', () => updateQuantity(index, -1));
        plusBtn.addEventListener('click', () => updateQuantity(index, 1));
        quantityInput.addEventListener('change', (e) => updateQuantity(index, 0, e.target.value));
        removeBtn.addEventListener('click', () => removeItem(index));
        
        return itemElement;
    }
    
    // Update item quantity
    function updateQuantity(index, change, newQuantity = null) {
        const cart = JSON.parse(localStorage.getItem('streetwearCart')) || [];
        
        if (index >= 0 && index < cart.length) {
            if (newQuantity !== null) {
                cart[index].quantity = parseInt(newQuantity) || 1;
            } else {
                cart[index].quantity += change;
                
                // Ensure quantity is between 1 and 10
                if (cart[index].quantity < 1) cart[index].quantity = 1;
                if (cart[index].quantity > 10) cart[index].quantity = 10;
            }
            
            // Save and reload cart
            localStorage.setItem('streetwearCart', JSON.stringify(cart));
            loadCart();
            updateCartCount();
        }
    }
    
    // Remove item from cart
    function removeItem(index) {
        const cart = JSON.parse(localStorage.getItem('streetwearCart')) || [];
        
        if (index >= 0 && index < cart.length) {
            const itemName = cart[index].name;
            cart.splice(index, 1);
            
            // Save and reload cart
            localStorage.setItem('streetwearCart', JSON.stringify(cart));
            loadCart();
            updateCartCount();
            
            // Show notification
            showNotification(`Removed from cart: ${itemName}`);
        }
    }
    
    // Update cart totals
    function updateCartTotals(cart) {
        let subtotal = 0;
        
        cart.forEach(item => {
            const price = parseFloat(item.price.replace('$', ''));
            subtotal += price * item.quantity;
        });
        
        cartSubtotal.textContent = `$${subtotal.toFixed(2)}`;
        cartTotal.textContent = `$${subtotal.toFixed(2)}`; // In a real store, you'd add tax/shipping here
    }
    
    // Show empty cart message
    function showEmptyCart() {
        cartItemsContainer.innerHTML = `
            <div class="cart-empty">
                <i class="fas fa-shopping-cart"></i>
                <p>Your cart is empty</p>
                <a href="${window.location.origin}/shop" class="btn btn-black">Continue Shopping</a>
            </div>
        `;
        
        cartSubtotal.textContent = '$0.00';
        cartTotal.textContent = '$0.00';
        checkoutBtn.disabled = true;
    }
    
    // Initialize cart
    loadCart();
    
    // Checkout button
    checkoutBtn.addEventListener('click', function() {
        // In a real implementation, this would redirect to a checkout page
        alert('Proceeding to checkout!');
    });
});

// Show notification
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

// Update cart count in header
function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem('streetwearCart')) || [];
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    let cartCount = document.querySelector('.cart-count');
    
    // Create cart count element if it doesn't exist
    if (!cartCount) {
        const cartLink = document.querySelector('.cart-link');
        if (cartLink) {
            cartCount = document.createElement('span');
            cartCount.className = 'cart-count';
            cartLink.appendChild(cartCount);
        }
    }
    
    if (cartCount) {
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartCount();
});
