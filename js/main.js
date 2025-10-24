jQuery(document).ready(function($) {
    // Mobile menu toggle
    $('.menu-toggle').on('click', function() {
        $('.primary-menu').toggleClass('active');
        $(this).toggleClass('active');
    });

    // Close mobile menu when clicking a link
    $('.primary-menu a').on('click', function() {
        $('.primary-menu').removeClass('active');
        $('.menu-toggle').removeClass('active');
    });

    // Smooth scrolling for anchor links
    $('a[href*="#"]:not([href="#"])').on('click', function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 1000);
                return false;
            }
        }
    });

    // Header scroll effect
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.site-header').addClass('scrolled');
        } else {
            $('.site-header').removeClass('scrolled');
        }
    });
});
