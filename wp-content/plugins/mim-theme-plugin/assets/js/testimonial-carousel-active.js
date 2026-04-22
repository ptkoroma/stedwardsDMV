(function ($) {
	"use strict";
    
     $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/mimtesticarousel.default", function (scope, $) {        			   
       
            var Mimtestimonial = $(scope).find(".testimonial-area");
            var widgetid = Mimtestimonial.data('widgetid');
            var mimLoop = Mimtestimonial.data('loop');
            var mimNumber = Mimtestimonial.data('number');
            var mimDirection = Mimtestimonial.data('direction');
            var mimAutoplay = Mimtestimonial.data('autoplay');
            var mimAutoDelay = Mimtestimonial.data('auto-delay');
            var mimSpeed = Mimtestimonial.data('speed');
            var autoplay_hover_pause = Mimtestimonial.data('autoplay_hover_pause');
            var nav = Mimtestimonial.data('nav');
            var mimdots = Mimtestimonial.data('dots');

            if (mimLoop == 'yes') { var m_loop = true; } else { var m_loop = false;}
            if (mimAutoplay == 'yes') { var m_autoplay = true; } else { var m_autoplay = false;}
            if (mimdots == 'yes') { var m_dots = true; } else { var m_dots = false;}
            if (autoplay_hover_pause == 'yes') { var m_autoplay_hover_pause = true; } else { var m_autoplay_hover_pause = false;}
            if (nav == 'yes') { var m_nav = true; } else { var m_nav = false;}

			$('#olw-active-'+widgetid).owlCarousel({
		        loop: m_loop,
		        items: mimNumber,
		        dots: m_dots,
		        autoplay: m_autoplay,
		        autoplayTimeout: mimAutoDelay,
		        autoplaySpeed: mimSpeed,
		        autoplayHoverPause: m_autoplay_hover_pause,
		        nav: m_nav,
		        navContainer: '.navigation-owl-'+widgetid,
		        navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
		    });


        });
    });


})(jQuery);