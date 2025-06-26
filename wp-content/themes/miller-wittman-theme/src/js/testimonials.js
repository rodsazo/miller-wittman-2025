jQuery( function ($){
    /*
    1) Inicializar: calcular el tamaño del slide actual, y ponerselo al contenedor
    2) Al cambiar a otro slide
        - Desaparecer el slide actual
        - Aparecer el nuevo slide
        - calcular el tamaño del slide actual, y ponerselo al contenedor
    3) Al hacer click a las flechitas cambio de slide
        - Next: siguiente
        - Back: anterior
     */

    $('.testimonials').each(function(i, el){
        const $this = $(el);
        const $sliderContainer = $this.find('.testimonials__slides');
        const $slides = $this.find('.testimonials__slide');
        const $arrows = $this.find('.testimonials__arrow');
        const $back = $arrows.eq(0);
        const $next = $arrows.eq(1);

        let current_index = 0;
        let timeout;

        resizeContainer();
        restartTimer();

        $(window).on('resize', resizeContainer );

        $sliderContainer.addClass('active');

        $next.on('click', next );
        $back.on('click', back );

        function restartTimer(){
            if( timeout ) {
                clearTimeout( timeout );
            }
            timeout = setTimeout( next, 8000);
        }

        function resizeContainer() {
            const current_slide_height = $slides.eq( current_index ).outerHeight();
            $sliderContainer.height( current_slide_height );
        }

        function goTo( index ) {
            $slides.eq( current_index ).fadeOut();
            $slides.eq( index ).fadeIn();
            current_index = index;
            resizeContainer();
            restartTimer()
        }

        function next() {
            const next_index = ( current_index + 1) % $slides.length;
            goTo( next_index );
        }
        function back() {
            const next_index = ( current_index - 1 + $slides.length ) % $slides.length;
            goTo( next_index );
        }




    });

});