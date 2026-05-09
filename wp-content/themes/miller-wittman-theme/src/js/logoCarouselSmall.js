jQuery(function ($) {
    const $tracks = $('.logoCarouselSmall__track.is-looping');

    $tracks.each(function (_, element) {
        const $track = $(element);
        const $viewport = $track.closest('.logoCarouselSmall__viewport');
        const $group = $track.find('.logoCarouselSmall__group').first();
        const groupElement = $group[0];
        let position = 0;
        let lastTimestamp = 0;
        let loopDistance = 0;
        let paused = false;
        let resizeFrame = null;
        let resizeObserver = null;

        function scheduleMeasurementUpdate() {
            if (resizeFrame) {
                window.cancelAnimationFrame(resizeFrame);
            }

            resizeFrame = window.requestAnimationFrame(function () {
                updateMeasurements();
            });
        }

        function ensureLoopCoverage() {
            const viewportWidth = $viewport.outerWidth();

            if (!viewportWidth || !loopDistance) {
                return;
            }

            let availableWidth = $track[0].scrollWidth - loopDistance;
            let safety = 0;

            while (availableWidth < viewportWidth && safety < 12) {
                const $clone = $group.clone();
                $clone.attr('aria-hidden', 'true').addClass('is-dynamic-clone');
                $track.append($clone);
                availableWidth = $track[0].scrollWidth - loopDistance;
                safety += 1;
            }
        }

        function updateMeasurements() {
            const trackGap = parseFloat($track.css('column-gap') || $track.css('gap') || 0);
            const groupWidth = $group.outerWidth(true);
            loopDistance = groupWidth + trackGap;

            if (!loopDistance) {
                return;
            }

            ensureLoopCoverage();

            if (Math.abs(position) >= loopDistance) {
                position += loopDistance;
            }

            $track.css('transform', `translateX(${position}px)`);
        }

        function step(timestamp) {
            if (!lastTimestamp) {
                lastTimestamp = timestamp;
            }

            const delta = timestamp - lastTimestamp;
            lastTimestamp = timestamp;

            if (!paused && loopDistance) {
                position -= delta * 0.04;

                if (Math.abs(position) >= loopDistance) {
                    position += loopDistance;
                }

                $track.css('transform', `translateX(${position}px)`);
            }

            window.requestAnimationFrame(step);
        }

        $viewport.on('mouseenter focusin', function () {
            paused = true;
        });

        $viewport.on('mouseleave', function () {
            paused = false;
        });

        $viewport.on('focusout', function (event) {
            if (!$viewport[0].contains(event.relatedTarget)) {
                paused = false;
            }
        });

        $(window).on('resize', function () {
            scheduleMeasurementUpdate();
        });

        if (typeof ResizeObserver === 'function' && groupElement) {
            resizeObserver = new ResizeObserver(function () {
                scheduleMeasurementUpdate();
            });

            resizeObserver.observe(groupElement);
            resizeObserver.observe($viewport[0]);
        }

        updateMeasurements();
        window.requestAnimationFrame(step);
    });
});
