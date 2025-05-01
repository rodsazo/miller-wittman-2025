jQuery(function ($) {
  $('.accordions__item').each(function (i, el) {
    const $this = $(el);
    const $button = $this.find('.accordions__handle');
    const $content = $this.find('.accordions__content');
    $button.on('click', function () {
      $this.toggleClass('open');
      $content.slideToggle();
    });
  });
});
jQuery(function ($) {
  /**
   * Marquee effect
   */

  const row_gap = 81;
  const repetition = 3;
  const speed = 30; // pixels per second

  $('.homeIntro').each(function (i, el) {
    const $this = $(el);
    const $rows = $this.find('.homeIntro__marquee');
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
    const $content = $row.find('.homeIntro__marqueeContent');
    const row_html = $content.html();
    for (let i = 0; i < repetition - 1; i++) {
      $content.append(row_html);
    }
  }
  function getRowWidth($row) {
    const $phrases = $row.find('.homeIntro__phrase');
    let total_width = 0;
    $phrases.each(function (i, el) {
      total_width += $(el).outerWidth();
    });
    total_width += ($phrases.length - 1) * row_gap;
    return total_width;
  }
});
jQuery(function ($) {
  const observer = new IntersectionObserver(function (entries, observer) {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        entry.target.style.setProperty('--intersectDelay', index * 0.1 + 's');
        entry.target.classList.add('active');
      }
    });
  }, {
    threshold: 0.25
  });
  $('.intersect').each(function (i, el) {
    observer.observe(el);
  });
});
jQuery(function ($) {
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
jQuery(function ($) {
  const $html = $('html');
  const $mobBtn = $('.siteHeader__mobBtn');
  const $mobMenu = $('.mobMenu');
  const $siteHeader = $('.siteHeader');
  let is_open = false;
  $mobBtn.on('click', function () {
    if (is_open) {
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
/**
 * Picol Slider
 */

jQuery(function ($) {
  $.fn.pSlider = function (options) {
    var defaults = {
      transition: 'fade',
      autoplayDelay: 7000,
      autoplay: false,
      animationTime: 500,
      noFirst: false,
      activeClass: 'active',
      debugMode: false
    };
    var settings = $.extend(true, {}, defaults, options);
    var $elements = $(this);
    $elements.each(function (i, el) {
      // Setup
      var $this = $(el);
      var slider_id = $this.data('p-slider-id');
      var selectChildFn = createSelectorFunction($this, slider_id);

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
      var debug = createDebugFn(debug_mode);
      var transitionFn = createTransitionFunction(transition, animation_duration, $this, $slides_container);
      var $height_container = $slides_container.length ? $slides_container : $this;
      var current_slide = false;
      var autoplay_timeout;
      var is_moving = false;

      // Bindings

      $next.on('click', next);
      $prev.on('click', prev);
      $slides_container.on('swipeleft', prev);
      $slides_container.on('swiperight', next);
      $controls.each(function (control_i, element) {
        $(element).on('click', function () {
          goTo(control_i);
        });
      });
      autoplay && resetAutoplay();
      $slides.hide();
      if (!no_first) {
        goTo(0);
      }
      function resetAutoplay() {
        if (autoplay_timeout) {
          clearTimeout(autoplay_timeout);
        }
        autoplay_timeout = setTimeout(next, autoplay_delay);
      }
      function goTo(i) {
        i = (i + $slides.length) % $slides.length;
        debug('Going to ' + i);
        if (is_moving || i === current_slide) {
          return;
        }
        swapStart(i);
        updateHtmlElements(i);
        autoplay && resetAutoplay();
        if (current_slide === false) {
          $slides.eq(i).show();
          swapEnd(i);
          if (transition == 'fadeHeight') {
            $height_container.height($slides.eq(i).outerHeight());
          }
        } else {
          transitionFn($slides.eq(i), $slides.eq(current_slide), function () {
            swapEnd(i);
          });
        }
      }
      function next() {
        var current = current_slide === false ? -1 : current_slide;
        goTo(current + 1);
      }
      function prev() {
        var current = current_slide === false ? 1 : current_slide;
        goTo(current - 1);
      }
      function swapStart(going_to_i) {
        is_moving = true;
        $this.trigger('p-slider.before', [going_to_i]);
      }
      function swapEnd(going_to_i) {
        is_moving = false;
        $this.trigger('p-slider.after', [going_to_i, current_slide]);
        current_slide = going_to_i;
        debug('Swap end: ' + going_to_i);
      }
      function updateHtmlElements(active_i) {
        $slides.removeClass(active_class).eq(active_i).addClass(active_class);
        $controls.removeClass(active_class).eq(active_i).addClass(active_class);
        if ($current_num.length) {
          $current_num.html(active_i + 1);
        }
      }

      // Swipe Functions

      $this.on('p-swipe.left', function (e) {
        e.stopPropagation();
        next();
      });
      $this.on('p-swipe.right', function (e) {
        e.stopPropagation();
        prev();
      });
    });
  };
  function createSelectorFunction($element, slider_id) {
    return function (selector) {
      return $element.find('[data-p-slider=' + slider_id + '__' + selector + ']');
    };
  }
  function createTransitionFunction(transition, duration, $this, $slides_container) {
    switch (transition) {
      default:
      case 'fade':
        return function ($new_slide, $old_slide, callback_fn) {
          $old_slide.fadeOut(duration);
          $new_slide.fadeIn(duration, callback_fn);
        };
      case 'fadeHeight':
        var $height_target = $slides_container.length ? $slides_container : $this;
        return function ($new_slide, $old_slide, callback_fn) {
          $new_slide.css({
            opacity: 0,
            display: 'block'
          });
          $height_target.animate({
            height: $new_slide.outerHeight()
          }, duration);
          $old_slide.fadeOut(duration);
          $new_slide.animate({
            opacity: 1
          }, duration, callback_fn);
        };
      case 'slideReplace':
        return function ($new_slide, $old_slide, callback_fn) {
          $old_slide.slideReplace($new_slide, {
            fadeSpeed: duration / 3,
            slideSpeed: duration / 3,
            callback: callback_fn
          });
        };
      case 'showhide':
        return function ($new_slide, $old_slide, callback_fn) {
          $new_slide.show();
          $old_slide.hide();
          callback_fn();
        };
    }
  }
  function createDebugFn(debug_mode) {
    return debug_mode ? function (message) {
      console.log('p-slider ', message);
    } : function () {};
  }
  $('[data-p-slider-id]').pSlider();
});
const scrollVars = {
  windowHeight: 0,
  elements: [],
  scrolling: false,
  scrollY: 0,
  start() {
    const that = this;
    document.addEventListener('DOMContentLoaded', function () {
      that.elements = document.querySelectorAll('[data-scrollvars]');
      if (!that.elements.length) {
        return;
      }
      window.addEventListener('resize', function () {
        that.onResize();
      });
      window.addEventListener('scroll', function () {
        that.onScroll();
      });
      that.onResize();
      that.onAnimationFrame();
    });
    window.scrollVarsObject = that;
  },
  onResize() {
    this.windowHeight = window.innerHeight;
    const that = this;
    this.elements.forEach(function (el, i) {
      that.calculateOffsets(el);
    });
  },
  calculateOffsets(element) {
    const coords = getCoords(element);
    if (!element.scrollVarsData) {
      const raw_data = element.dataset.scrollvars;
      element.scrollVarsData = {};
      if (raw_data) {
        element.scrollVarsData.vars = JSON.parse(raw_data);
      }
      if (!element.scrollVarsData.vars) {
        element.scrollVarsData.vars = {
          "scrollvar": [0, 1]
        };
      }
    }
    element.scrollVarsData.elementStart = coords.top;
    element.scrollVarsData.elementHeight = element.offsetHeight;
    element.scrollVarsData.elementEnd = element.scrollVarsData.elementStart + element.scrollVarsData.elementHeight;
    element.scrollVarsData.scrollStart = this.getScrollStart(element);
    element.scrollVarsData.scrollEnd = this.getScrollEnd(element);
    element.scrollVarsData.scrollLength = element.scrollVarsData.scrollEnd - element.scrollVarsData.scrollStart;
  },
  getScrollStart(element) {
    const start_str = element.scrollVarsData.start || 'bottom';
    let scroll_start = element.scrollVarsData.elementStart;
    if (start_str === 'bottom') {
      scroll_start -= this.windowHeight;
    }
    return scroll_start;
  },
  getScrollEnd(element) {
    const end_str = element.scrollVarsData.start || 'top';
    let scroll_end = element.scrollVarsData.elementEnd;
    if (end_str === 'bottom') {
      scroll_end -= this.windowHeight;
    }
    return scroll_end;
  },
  onScroll() {
    if (this.scrolling) {
      return;
    }
    window.requestAnimationFrame(this.onAnimationFrame);
  },
  onAnimationFrame() {
    const sv = window.scrollVarsObject;
    sv.scrollY = window.scrollY;
    sv.elements.forEach(function (element) {
      sv.updateVariables(element);
    });
    sv.scrolling = false;
  },
  updateVariables(element) {
    const vars = element.scrollVarsData.vars;
    for (let var_name in vars) {
      if (vars.hasOwnProperty(var_name)) {
        this.updateCssVariable(element, var_name, vars[var_name]);
      }
    }
  },
  updateCssVariable(element, var_name, var_data) {
    if (typeof var_data != 'object') {
      var_data = [0, 1];
    }
    const svd = element.scrollVarsData;
    const var_start = var_data[0];
    const var_end = var_data[1];
    const var_scroll_start = svd.scrollStart + svd.scrollLength * var_start;
    const var_scroll_end = svd.scrollStart + svd.scrollLength * var_end;
    const var_scroll_length = var_scroll_end - var_scroll_start;
    let var_value = (this.scrollY - var_scroll_start) / var_scroll_length;
    var_value = Math.max(0, Math.min(1, var_value));
    var_value = var_value.toString().substring(0, 5);
    element.style.setProperty('--' + var_name, var_value);
  }
};
function getCoords(elem) {
  // crossbrowser version
  let box = elem.getBoundingClientRect();
  let body = document.body;
  let docEl = document.documentElement;
  let scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
  let scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;
  let clientTop = docEl.clientTop || body.clientTop || 0;
  let clientLeft = docEl.clientLeft || body.clientLeft || 0;
  let top = box.top + scrollTop - clientTop;
  let left = box.left + scrollLeft - clientLeft;
  return {
    top: Math.round(top),
    left: Math.round(left)
  };
}
scrollVars.start();
(function ($) {
  $.fn.slideReplace = function ($b, args) {
    var $this = this,
      $other = $($b),
      callback,
      fade_speed,
      transition_delay = 40,
      slide_speed;
    args = args || {};
    args = $.extend({
      fadeSpeed: 200,
      slideSpeed: 200,
      callback: function () {}
    }, args);
    callback = args.callback;
    fade_speed = args.fadeSpeed;
    slide_speed = args.slideSpeed;
    $this.animate({
      opacity: 0
    }, fade_speed, function () {
      setTimeout(function () {
        $this.slideUp({
          duration: slide_speed,
          easing: 'linear'
        });
        $other.css({
          opacity: 0
        }).slideDown({
          duration: slide_speed,
          easing: 'linear',
          complete: function () {
            $other.animate({
              opacity: 1
            }, fade_speed);
            $(window).trigger('resize');
            callback();
          }
        });
      }, transition_delay);
    });
  };
})(jQuery);

// HTML init

jQuery(function ($) {
  var $body = $('body'),
    debug = false;
  function doTheReplace(e) {
    var $this = $(this),
      replace_selector = $this.data('replace') || $this.data('slide-replace'),
      with_selector = $this.data('with'),
      $replace = $(replace_selector),
      $with = $(with_selector),
      no_default = $this.data('no-default') || false,
      do_scroll = $this.data('scroll') || false,
      fade_speed = $this.data('fade-speed') || 200,
      slide_speed = $this.data('slide-speed') || 200;
    if (debug) {
      console.log('Tratando de slide replace');
      console.log('- replace_selector = ', replace_selector, 'found:', $replace.length);
      console.log('- with_selector = ', with_selector, 'found:', $with.length);
    }
    if (no_default) {
      e.preventDefault();
    }
    if ($with.length && $replace.length) {
      $replace.slideReplace($with, {
        fadeSpeed: fade_speed,
        slideSpeed: slide_speed,
        callback: function () {
          $(window).resize();
          if (do_scroll) {
            $('body, html').stop().animate({
              scrollTop: $with.offset().top - 180
            });
          }
        }
      });
    } else if (debug) {
      console.log('- No pude slide-replace');
    }
  }
  $body.on('click', '.js-slideReplace', doTheReplace);
  $body.on('click', '[data-slide-replace]', doTheReplace);
});
jQuery(function ($) {
  const $body = $('html');
  const $header = $('.siteHeader');
  let scrolling = false;
  const min_scroll_sticky = 300;
  let sticky_threshold = 0;
  let previous_scroll = window.scrollY;
  const $globalBanner = $('.topBar');
  $(window).on('scroll', function () {
    if (!scrolling) {
      scrolling = true;
      requestAnimationFrame(scroll);
    }
  });
  if ($globalBanner.length) {
    onResize();
    $(window).on('resize', onResize);
  }
  function scroll() {
    const current_scroll = window.scrollY;
    const scrolling_up = current_scroll - previous_scroll < 0;
    if (scrolling_up && current_scroll >= min_scroll_sticky) {
      $header.addClass('in');
      $header.addClass('sticky');
      $body.addClass('sticky-menu');
    } else if (!scrolling_up) {
      $header.removeClass('in');
      // $body.removeClass('sticky-menu');
    }
    if (current_scroll <= sticky_threshold) {
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