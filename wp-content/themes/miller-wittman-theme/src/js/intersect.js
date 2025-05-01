
jQuery( function ($){
    const observer = new IntersectionObserver(
    function(entries, observer){
        entries.forEach((entry) => {
            if( entry.isIntersecting ) {
                entry.target.classList.add('active');
            }
        });
    }, {
        threshold: 0.25
    });

    $('.intersect').each(function(i,el){
        observer.observe( el );
    });
});