<?php
$launch_date = date('Y-m-d H:i:s', strtotime('+15 days')); // 15 days from now
$background_image = get_template_directory_uri() . '/images/coming-soon-bg.jpg';
$image1 = get_template_directory_uri() . '/images/coming-soon-1.jpg';
$image2 = get_template_directory_uri() . '/images/coming-soon-2.jpg';
?>

<section id="coming-soon" class="coming-soon-section" style="background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('<?php echo $background_image; ?>');">
    <div class="container">
        <div class="launch-badge">Limited Time Launch</div>
        <h2 class="section-title">Our New Collection Drops In</h2>
        
        <div class="countdown-wrapper">
            <div class="countdown-timer" id="countdown">
                <div class="time-block">
                    <span class="time-value" id="days">15</span>
                    <span class="time-label">Days</span>
                </div>
                <div class="time-block">
                    <span class="time-value" id="hours">00</span>
                    <span class="time-label">Hours</span>
                </div>
                <div class="time-block">
                    <span class="time-value" id="minutes">00</span>
                    <span class="time-label">Minutes</span>
                </div>
                <div class="time-block">
                    <span class="time-value" id="seconds">00</span>
                    <span class="time-label">Seconds</span>
                </div>
            </div>
        </div>

        <div class="product-showcase">
            <div class="product-item">
                <div class="product-badge">New Arrival</div>
                <div class="product-image">
                    <img src="<?php echo $image1; ?>" alt="Autumn Collection">
                    <div class="product-overlay">
                        <h3>Autumn Collection</h3>
                        <p>Launching in 15 days</p>
                    </div>
                </div>
            </div>
            
            <div class="product-item">
                <div class="product-badge">Coming Soon</div>
                <div class="product-image">
                    <img src="<?php echo $image2; ?>" alt="Winter Collection">
                    <div class="product-overlay">
                        <h3>Winter Line</h3>
                        <p>Launching in 30 days</p>
                    </div>
                </div>
            </div>
        </div>

        

<style>
.coming-soon-section {
    padding: 80px 0;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: #fff;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 2;
}

.launch-badge {
    display: inline-block;
    background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
    color: white;
    padding: 8px 25px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 14px;
    letter-spacing: 2px;
    margin-bottom: 20px;
    text-transform: uppercase;
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
}

.section-title {
    font-size: 3.5rem;
    margin: 0 0 30px;
    font-weight: 800;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    background: linear-gradient(to right, #fff, #ffd3b6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1.2;
}

.countdown-wrapper {
    margin: 40px 0 60px;
}

.countdown-timer {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 0 auto;
    max-width: 800px;
    flex-wrap: wrap;
}

.time-block {
    background: rgba(255, 255, 255, 0.1);
    padding: 25px 20px;
    border-radius: 15px;
    min-width: 120px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    transition: all 0.3s ease;
}

.time-block:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.time-value {
    font-size: 3rem;
    font-weight: 800;
    display: block;
    line-height: 1;
    margin-bottom: 5px;
    background: linear-gradient(45deg, #ff9a9e, #fad0c4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.time-label {
    font-size: 1rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
    color: #fff;
}

.product-showcase {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin: 60px 0;
    flex-wrap: wrap;
}

.product-item {
    flex: 1;
    min-width: 300px;
    max-width: 500px;
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.product-item:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
}

.product-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    z-index: 2;
}

.product-image {
    width: 100%;
    height: 400px;
    overflow: hidden;
    position: relative;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.product-item:hover .product-image img {
    transform: scale(1.1);
}

.product-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    padding: 30px;
    text-align: left;
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.4s ease;
}

.product-item:hover .product-overlay {
    transform: translateY(0);
    opacity: 1;
}

.product-overlay h3 {
    color: #fff;
    font-size: 1.8rem;
    margin: 0 0 5px;
    font-weight: 700;
}

.product-overlay p {
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    font-size: 1.1rem;
}

.newsletter-box {
    background: rgba(255, 255, 255, 0.05);
    padding: 40px;
    border-radius: 20px;
    max-width: 700px;
    margin: 60px auto 0;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.newsletter-box h3 {
    margin: 0 0 25px;
    font-size: 1.8rem;
    color: #fff;
}

.form-group {
    display: flex;
    max-width: 500px;
    margin: 0 auto;
    position: relative;
}

.form-group input {
    flex: 1;
    padding: 18px 25px;
    border: none;
    border-radius: 50px;
    font-size: 1rem;
    outline: none;
    background: rgba(255, 255, 255, 0.9);
    transition: all 0.3s ease;
}

.form-group input:focus {
    box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.3);
}

.btn-notify {
    position: absolute;
    right: 5px;
    top: 5px;
    bottom: 5px;
    background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
    color: white;
    border: none;
    padding: 0 30px;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

.btn-notify:hover {
    background: linear-gradient(45deg, #ff5252, #ff6b6b);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 82, 82, 0.3);
}

.privacy-note {
    font-size: 0.85rem;
    opacity: 0.7;
    margin: 20px 0 0;
    color: rgba(255, 255, 255, 0.8);
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

@media (max-width: 992px) {
    .section-title {
        font-size: 2.8rem;
    }
    
    .product-showcase {
        gap: 20px;
    }
    
    .product-item {
        max-width: 100%;
    }
    
    .time-block {
        min-width: 100px;
        padding: 20px 15px;
    }
    
    .time-value {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .section-title {
        font-size: 2.2rem;
    }
    
    .countdown-timer {
        gap: 10px;
    }
    
    .time-block {
        min-width: 70px;
        padding: 15px 10px;
    }
    
    .time-value {
        font-size: 2rem;
    }
    
    .time-label {
        font-size: 0.8rem;
    }
    
    .form-group {
        flex-direction: column;
    }
    
    .btn-notify {
        position: relative;
        width: 100%;
        margin-top: 15px;
        right: 0;
        top: 0;
        bottom: 0;
        padding: 15px;
    }
    
    .newsletter-box {
        padding: 30px 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set launch date to 15 days from now
    const launchDate = new Date();
    launchDate.setDate(launchDate.getDate() + 15);
    const countDownDate = launchDate.getTime();
    
    // Update countdown every second
    const countdownTimer = setInterval(updateCountdown, 1000);
    
    // Initial call
    updateCountdown();
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countDownDate - now;
        
        // Calculate time units
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Update the display
        document.getElementById('days').textContent = String(days).padStart(2, '0');
        document.getElementById('hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        
        // If countdown is over
        if (distance < 0) {
            clearInterval(countdownTimer);
            document.getElementById('countdown').innerHTML = '<div class="launch-message"><h3>We\'re Live!</h3><p>Check out our new collection now</p><a href="/shop" class="btn-shop-now">Shop Now</a></div>';
        }
    }
    
    // Form submission
    const form = document.querySelector('.notify-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            const button = this.querySelector('button');
            
            // Visual feedback
            button.textContent = 'Subscribed!';
            button.style.background = '#4CAF50';
            this.querySelector('input').value = '';
            
            // Reset after delay
            setTimeout(() => {
                button.textContent = 'Notify Me';
                button.style.background = 'linear-gradient(45deg, #ff6b6b, #ff8e8e)';
            }, 2000);
        });
    }
    
    // Animate elements on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    // Observe elements for scroll animation
    const animatedElements = document.querySelectorAll('.time-block, .newsletter-box, .product-item');
    animatedElements.forEach(el => {
        el.style.opacity = 0;
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        observer.observe(el);
    });
});
</script>