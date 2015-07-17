/**
 * Created by chadsfather on 30/5/15.
 */

(function($) {
    $('.carousel').carousel({
      interval: 9000
    })

    $.fn.preload = function() {
        this.each(function(){
            $('<img/>')[0].src = this;
        });
    }

    $(picsjs).preload();

    setTimeout(function() {
        $('.transition-txt-1').addClass('transition-txt-in');
    }, 2000);

    setTimeout(function() {
        $('.transition-txt-2').addClass('transition-txt-in');
    }, 2300);

    setTimeout(function() {
        $('.transition-txt-3').addClass('transition-txt-in');
    }, 2600);
})(jQuery);