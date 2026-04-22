(function ($) {
    "use strict"; // use strict to start
    var ajaxurl = mim.ajaxurl;

    $(document).on('click','.submit-item-registration', function(e){
        e.preventDefault();

        var $self = $(this);
        var data = $('#mim_product_registration').serialize(); 
        $(".about-description").hide('slow');
        $.ajax({
            type: "POST",
            dataType: "html",
            url: mim.ajaxurl,
            data: data,
            beforeSend: function() {
                $('#mim_product_registration .mim-loader').css({'display': 'inline-block'});
                $('#mim_product_registration .mim-loader').children().addClass('spin');
            },
            success: function (response) {  
                var obj = JSON.parse(response);        
                $('#mim_product_registration .mim-loader').css({'display': 'none'});
                $('#mim_product_registration .mim-loader').children().removeClass('spin'); 
                if(obj.status == 1 ) {
                    $('.mim-important-notice.registration-form-container .about-description-success').slideDown('slow');
                    $('.mim-important-notice.registration-form-container .mim-registration-form').slideUp();
                    $('.mim-important-notice.registration-form-container .about-description-success-before').slideUp();
                } else { 
                    $('.mim-important-notice.registration-form-container .about-description-faild-msg').slideDown('slow');
                    setTimeout(function() {
                        $('.mim-important-notice.registration-form-container .about-description-faild-msg').slideUp('slow');
                    }, 9500);
                }
            },
            error: function () { 
                console.log("Something miss. Please recheck");
            }
        });
    });



})(jQuery);