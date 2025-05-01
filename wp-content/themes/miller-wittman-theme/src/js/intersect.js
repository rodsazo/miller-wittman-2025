
jQuery( function ($){
    const observer = new IntersectionObserver(
    function(entries, observer){
        entries.forEach((entry, index) => {
            if( entry.isIntersecting ) {
                entry.target.style.setProperty('--intersectDelay', (index * 0.1) + 's')
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