(function($, _) {

    $("div.lazy").lazyload({
        effect : "fadeIn"
    });

    function cartHash() {
        return Math.random().toString(36).substr(2);
    };

    if(!$.cookie('cart')) {
        $.cookie('cart', cartHash(), {
            expires : 1,
            path    : '/',
            domain  : host
        });
    }

    $.material.init();

    $('#ir-a-cesta').on('click', function() {
        if($.cookie('cart')) {
            window.top.location = '/cart?id=' + $.cookie('cart');
        }
    });

    $('#menu-responsive-link').on('click', function() {
        $('#menu').toggleClass('enabled').slideToggle();
    });
})(jQuery, _);