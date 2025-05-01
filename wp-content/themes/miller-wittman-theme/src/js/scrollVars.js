const scrollVars = {

    windowHeight: 0,
    elements: [],
    scrolling: false,
    scrollY: 0,

    start()
    {
        const that = this;
        document.addEventListener('DOMContentLoaded', function(){

            that.elements = document.querySelectorAll('[data-scrollvars]');

            if( !that.elements.length ) {
                return;
            }

            window.addEventListener('resize', function(){
                that.onResize();
            } );
            window.addEventListener('scroll', function(){
                that.onScroll();
            } );

            that.onResize();
            that.onAnimationFrame();
        });

        window.scrollVarsObject = that;

    },

    onResize()
    {
        this.windowHeight = window.innerHeight;
        const that = this;
        this.elements.forEach(function(el,i){
            that.calculateOffsets( el );
        });
    },

    calculateOffsets( element )
    {

        const coords = getCoords( element );

        if( !element.scrollVarsData ) {
            const raw_data = element.dataset.scrollvars;
            element.scrollVarsData = {};
            if( raw_data ) {
                element.scrollVarsData.vars = JSON.parse( raw_data );
            }
            if( !element.scrollVarsData.vars ) {
                element.scrollVarsData.vars = {"scrollvar": [0,1] }
            }
        }

        element.scrollVarsData.elementStart = coords.top;
        element.scrollVarsData.elementHeight = element.offsetHeight;
        element.scrollVarsData.elementEnd =
            element.scrollVarsData.elementStart + element.scrollVarsData.elementHeight;

        element.scrollVarsData.scrollStart = this.getScrollStart( element );
        element.scrollVarsData.scrollEnd = this.getScrollEnd( element );
        element.scrollVarsData.scrollLength =
            element.scrollVarsData.scrollEnd - element.scrollVarsData.scrollStart;

    },

    getScrollStart( element )
    {
        const start_str = element.scrollVarsData.start || 'bottom';
        let scroll_start = element.scrollVarsData.elementStart;
        if( start_str === 'bottom' ) {
            scroll_start -= this.windowHeight;
        }
        return scroll_start;
    },

    getScrollEnd( element )
    {
        const end_str = element.scrollVarsData.start || 'top';
        let scroll_end = element.scrollVarsData.elementEnd;
        if( end_str === 'bottom' ) {
            scroll_end -= this.windowHeight;
        }
        return scroll_end;
    },


    onScroll()
    {
        if( this.scrolling ) { return }
        window.requestAnimationFrame( this.onAnimationFrame );
    },

    onAnimationFrame()
    {
        const sv = window.scrollVarsObject;
        sv.scrollY = window.scrollY;
        sv.elements.forEach(function( element ){
            sv.updateVariables( element );
        });
        sv.scrolling = false;
    },

    updateVariables( element )
    {
        const vars = element.scrollVarsData.vars;
        for( let var_name in vars ) {
            if( vars.hasOwnProperty( var_name )) {
                this.updateCssVariable( element, var_name, vars[ var_name ] );
            }
        }
    },

    updateCssVariable( element, var_name, var_data )
    {
        if(typeof var_data != 'object'){
            var_data = [0,1];
        }

        const svd = element.scrollVarsData;

        const var_start = var_data[0];
        const var_end = var_data[1];

        const var_scroll_start = svd.scrollStart + svd.scrollLength * var_start;
        const var_scroll_end = svd.scrollStart + svd.scrollLength * var_end;
        const var_scroll_length = var_scroll_end - var_scroll_start;

        let var_value = (this.scrollY - var_scroll_start) / var_scroll_length;
        var_value = Math.max(0, Math.min( 1, var_value ));

        var_value = var_value.toString().substring(0, 5);

        element.style.setProperty('--' + var_name, var_value );

    }
}

function getCoords(elem) { // crossbrowser version
    let box = elem.getBoundingClientRect();

    let body = document.body;
    let docEl = document.documentElement;

    let scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
    let scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;

    let clientTop = docEl.clientTop || body.clientTop || 0;
    let clientLeft = docEl.clientLeft || body.clientLeft || 0;

    let top  = box.top +  scrollTop - clientTop;
    let left = box.left + scrollLeft - clientLeft;

    return { top: Math.round(top), left: Math.round(left) };
}

scrollVars.start();