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
})(jQuery);