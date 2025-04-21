jQuery(function($) {

    /**
     * Marquee effect
     */

    const row_gap = 24;
    const repetition = 3;
    const speed = 30; // pixels per second

    $('.logoCarousel').each(function (i, el) {
        const $this = $(el);
        const $rows = $this.find('.logoCarousel__marquee');
        $rows.each(function (i, el) {
            const $this_row = $(el);
            repeatPhrases($this_row);
            const total_width = getRowWidth($this_row);
            const scroll_width = (total_width - (repetition - 1) * row_gap) / repetition + row_gap;
            const row_style = $this_row[0].style;
            row_style.setProperty('--marquee-row-scroll-distance', '-' + scroll_width + 'px');
            row_style.setProperty('--marquee-scroll-duration', scroll_width / speed + 's');
        });
        $this.addClass('initialized');
    });
    function repeatPhrases($row) {
        const $content = $row.find('.logoCarousel__marqueeContent');
        const row_html = $content.html();
        for (let i = 0; i < repetition - 1; i++) {
            $content.append(row_html);
        }
    }
    function getRowWidth($row) {
        const $phrases = $row.find('.logoCarousel__item');
        let total_width = 0;
        $phrases.each(function (i, el) {
            total_width += $(el).outerWidth();
        });
        total_width += ($phrases.length - 1) * row_gap;
        return total_width;
    }

});