(function($){

    $.fn.slideReplace = function( $b, args ) {

        var $this = this,
            $other = $($b),
            callback,
            fade_speed,
            transition_delay = 40,
            slide_speed;

        args = args || {};

        args = $.extend({
            fadeSpeed : 200,
            slideSpeed : 200,
            callback : function(){}
        }, args);

        callback = args.callback;
        fade_speed = args.fadeSpeed;
        slide_speed = args.slideSpeed;

        $this.animate({
            opacity: 0
        }, fade_speed, function(){

            setTimeout(function(){

                $this.slideUp( {
                    duration: slide_speed,
                    easing : 'linear'
                } );
                $other
                    .css({opacity: 0})
                    .slideDown({
                        duration : slide_speed,
                        easing : 'linear',
                        complete : function(){
                            $other.animate({opacity:1}, fade_speed);
                            $(window).trigger('resize');
                            callback();
                        }
                    });

            }, transition_delay);


        });
    };

}(jQuery));

// HTML init

jQuery(function($){

    var $body = $('body'),
        debug = false;

    function doTheReplace(e){

        var $this = $(this),
            replace_selector = $this.data('replace')  || $this.data('slide-replace'),
            with_selector = $this.data('with'),
            $replace = $(replace_selector),
            $with = $(with_selector),
            no_default = $this.data('no-default') || false,
            do_scroll = $this.data('scroll') || false,
            fade_speed = $this.data('fade-speed') || 200,
            slide_speed = $this.data('slide-speed') || 200;

        if(debug){
            console.log('Tratando de slide replace');
            console.log('- replace_selector = ', replace_selector, 'found:', $replace.length);
            console.log('- with_selector = ', with_selector, 'found:', $with.length);
        }

        if(no_default){
            e.preventDefault();
        }

        if($with.length && $replace.length){
            $replace.slideReplace($with, {
                fadeSpeed : fade_speed,
                slideSpeed : slide_speed,
                callback : function(){
                    $(window).resize();

                    if(do_scroll){
                        $('body, html').stop().animate({
                            scrollTop : $with.offset().top - 180
                        });
                    }
                }
            });
        } else if(debug) {
            console.log('- No pude slide-replace');
        }
    }

    $body.on('click', '.js-slideReplace', doTheReplace );
    $body.on('click', '[data-slide-replace]', doTheReplace );
});