/**
 * Picol Slider
 */

jQuery( function($){

    $.fn.pSlider = function( options ){

        var defaults = {
            transition: 'fade',
            autoplayDelay: 7000,
            autoplay: false,
            animationTime: 500,
            noFirst : false,
            activeClass : 'active',
            debugMode : false
        };

        var settings = $.extend(true, {}, defaults, options);

        var $elements = $(this);

        $elements.each(function(i,el){
            // Setup
            var $this = $(el);
            var slider_id = $this.data('p-slider-id');
            var selectChildFn = createSelectorFunction( $this, slider_id );

            // Elements
            var $slides = selectChildFn('slide');
            var $controls = selectChildFn('control');
            var $current_num = selectChildFn('currentnum');
            var $next = selectChildFn('next');
            var $prev = selectChildFn('prev');
            var $slides_container = selectChildFn('slides');

            // Other params
            var autoplay = $this.data('autoplay') || settings.autoplay;
            var autoplay_delay = $this.data('autoplay-delay') || settings.autoplayDelay;
            var animation_duration = $this.data('animation-duration') || settings.animationTime;
            var transition = $this.data('transition') || settings.transition;
            var no_first = $this.data('no-first') || settings.noFirst;
            var active_class = $this.data('active-class') || settings.activeClass;
            var debug_mode = $this.data('debug-mode') || settings.debugMode;
            var debug = createDebugFn( debug_mode );

            var transitionFn = createTransitionFunction( transition, animation_duration, $this, $slides_container );

            var $height_container = $slides_container.length ? $slides_container : $this;

            var current_slide = false;
            var autoplay_timeout;

            var is_moving = false;

            // Bindings

            $next.on('click', next );
            $prev.on('click', prev );
            $slides_container.on('swipeleft', prev);
            $slides_container.on('swiperight', next);
            $controls.each(function(control_i, element){
                $(element).on('click', function(){
                    goTo( control_i );
                })
            });

            autoplay && resetAutoplay();

            $slides.hide();

            if(!no_first){
                goTo(0);
            }

            function resetAutoplay() {
                if( autoplay_timeout ) {
                    clearTimeout( autoplay_timeout );
                }
                autoplay_timeout = setTimeout( next, autoplay_delay );
            }


            function goTo( i ) {

                i = (i + $slides.length) % $slides.length;
                debug( 'Going to ' + i );

                if( is_moving || i === current_slide ) {
                    return;
                }

                swapStart(i);
                updateHtmlElements(i);
                autoplay && resetAutoplay();

                if( current_slide === false ){
                    $slides.eq(i).show();
                    swapEnd(i);
                    if( transition == 'fadeHeight'){
                        $height_container.height( $slides.eq(i).outerHeight() );
                    }
                } else {
                    transitionFn( $slides.eq(i), $slides.eq( current_slide), function(){
                        swapEnd( i );
                    } );
                }

            }

            function next() {
                var current = current_slide === false ? -1 : current_slide;
                goTo( current + 1 );
            }

            function prev() {
                var current = current_slide === false ? 1 : current_slide;
                goTo( current - 1);
            }

            function swapStart( going_to_i ) {
                is_moving = true;
                $this.trigger('p-slider.before', [ going_to_i ]);
            }

            function swapEnd( going_to_i ) {
                is_moving = false;
                $this.trigger('p-slider.after', [ going_to_i, current_slide ]);
                current_slide = going_to_i;
                debug('Swap end: ' + going_to_i);
            }

            function updateHtmlElements( active_i ) {

                $slides.removeClass( active_class )
                    .eq( active_i ).addClass( active_class );

                $controls.removeClass( active_class )
                    .eq( active_i ).addClass( active_class );

                if( $current_num.length ) {
                    $current_num.html( active_i + 1 );
                }
            }

            // Swipe Functions

            $this.on('p-swipe.left', function (e){
                e.stopPropagation();
                next();
            });
            $this.on('p-swipe.right', function (e){
                e.stopPropagation();
                prev();
            });

        });
    }

    function createSelectorFunction( $element, slider_id ) {
        return function(selector) {
            return $element.find('[data-p-slider=' + slider_id + '__' + selector + ']' );
        };
    }

    function createTransitionFunction( transition, duration, $this, $slides_container ) {
        switch (transition) {

            default:
            case 'fade':
                return function($new_slide, $old_slide, callback_fn ) {
                    $old_slide.fadeOut(duration);
                    $new_slide.fadeIn(duration, callback_fn );
                };
            case 'fadeHeight':

                var $height_target = $slides_container.length ? $slides_container : $this;

                return function($new_slide, $old_slide, callback_fn){
                    $new_slide.css({
                        opacity: 0,
                        display: 'block'
                    });
                    $height_target.animate({ height: $new_slide.outerHeight() }, duration );
                    $old_slide.fadeOut( duration );
                    $new_slide.animate({opacity: 1}, duration, callback_fn );
                }

            case 'slideReplace':
                return function ($new_slide, $old_slide, callback_fn ) {
                    $old_slide.slideReplace($new_slide, {
                        fadeSpeed : duration / 3,
                        slideSpeed: duration / 3,
                        callback : callback_fn
                    });
                };

            case 'showhide':
                return function ($new_slide, $old_slide, callback_fn ) {
                    $new_slide.show();
                    $old_slide.hide();
                    callback_fn();
                };
        }
    }

    function createDebugFn( debug_mode ) {
        return debug_mode
            ? function( message ){ console.log( 'p-slider ', message ); }
            : function () {}
    }

    $('[data-p-slider-id]').pSlider();

});