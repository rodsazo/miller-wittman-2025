jQuery( function ($){

    const $body = $('html');
    const $header = $('.siteHeader');
    let scrolling = false;
    const min_scroll_sticky = 300;
    let sticky_threshold = 0;

    let previous_scroll = window.scrollY;

    const $globalBanner = $('.topBar');

    $(window).on('scroll', function(){
        if( !scrolling ) {
            scrolling = true;
            requestAnimationFrame( scroll );
        }
    });

    if ( $globalBanner.length ) {
        onResize();
        $(window).on('resize', onResize );
    }

    function scroll() {
        const current_scroll = window.scrollY;
        const scrolling_up = current_scroll - previous_scroll < 0;

        if( scrolling_up && current_scroll >= min_scroll_sticky ) {
            $header.addClass('in');
            $header.addClass('sticky');
            $body.addClass('sticky-menu');
        } else if( !scrolling_up ) {
            $header.removeClass('in');
            // $body.removeClass('sticky-menu');
        }

        if( current_scroll <= sticky_threshold ) {
            $header.removeClass('in');
            $header.removeClass('sticky');
            $body.removeClass('sticky-menu');
        }

        previous_scroll = current_scroll;
        scrolling = false;
    }

    function onResize() {
        sticky_threshold = $globalBanner.outerHeight();
    }

});