jQuery( function ($){
    const $html = $('html');
    const $mobBtn = $('.siteHeader__mobBtn');
    const $mobMenu = $('.mobMenu');
    const $siteHeader = $('.siteHeader');

    let is_open = false;

    $mobBtn.on('click', function(){
        if( is_open ) {
            closeMenu();
        } else {
            openMenu();
        }
        is_open = !is_open;
    });

    function openMenu() {
        $siteHeader.addClass('sticky');
        $mobMenu.fadeIn();
        $html.addClass('mob-menu-open');
        $mobBtn.addClass('active');
    }
    function closeMenu() {
        $mobMenu.fadeOut();
        $html.removeClass('mob-menu-open');
        $mobBtn.removeClass('active');
    }
});