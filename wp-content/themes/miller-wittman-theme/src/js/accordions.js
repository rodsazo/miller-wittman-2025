jQuery( function ($){

    $('.accordions__item').each(function(i,el){
        const $this = $(el);
        const $button = $this.find('.accordions__handle');
        const $content = $this.find('.accordions__content');

        $button.on('click', function(){
            $this.toggleClass('open');
            $content.slideToggle();
        });
    });

});