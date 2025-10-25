jQuery(document).ready(function($) {
    // Mobile menu toggle
    $('.menu-toggle').on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $('body').toggleClass('menu-open');
        $('.header-actions').toggleClass('active');
    });

    // Close mobile menu when clicking a link
    $('.header-menu a').on('click', function() {
        $('body').removeClass('menu-open');
        $('.menu-toggle').removeClass('active');
        $('.header-actions').removeClass('active');
    });

    // Close menu when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.header-actions').length && !$(e.target).is('.menu-toggle')) {
            $('body').removeClass('menu-open');
            $('.menu-toggle').removeClass('active');
            $('.header-actions').removeClass('active');
        }
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

    // Add body class for touch devices
    if ('ontouchstart' in window || navigator.maxTouchPoints) {
        $('body').addClass('touch-device');
    }
});
