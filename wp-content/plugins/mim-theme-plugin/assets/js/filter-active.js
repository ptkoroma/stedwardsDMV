(function ($) {
    "use strict";
    
     $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/mimportfoliofilter.default", function (scope, $) {
       
            var ProjMli = $(scope).find(".portfolio-menu li");
            var ProjGrid = $(scope).find(".portfolio-grid");



            ProjMli.on('click', function() {
                ProjMli.removeClass("active");
                $(this).addClass("active");
                var selector = $(this).attr('data-filter');
                ProjGrid.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false,
                    }
                });
            });


            ProjGrid.isotope({
                itemSelector: '.grid-item',
                masonryHorizontal: {
                    rowHeight: 100
                }
            });

  
        });
    });

}(jQuery)); 


// Loading Portfolios
jQuery(window).on('load', function($) {


            var IsoGriddoload = jQuery('.portfolio-grid');
    console.log(IsoGriddoload);
            IsoGriddoload.isotope({
                itemSelector: '.grid-item',
                masonryHorizontal: {
                    rowHeight: 100
                }
            });



});
