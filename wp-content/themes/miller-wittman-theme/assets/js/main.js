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
    const $content = $row.find('.marquee-block__content');
    const row_html = $content.html();
    for (let i = 0; i < repetition - 1; i++) {
      $content.append(row_html);
    }
  }
  function getRowWidth($row) {
    const $phrases = $row.find('.marquee-block__phrase');
    let total_width = 0;
    $phrases.each(function (i, el) {
      total_width += $(el).outerWidth();
    });
    total_width += ($phrases.length - 1) * row_gap;
    return total_width;
  }
  var resizeCta = function () {
    var $thisStepWrap = $('.call-cta__step-wrap--active');
    $('.call-cta__inner').css("min-height", $thisStepWrap.outerHeight());
  };
  var timeout;
  window.onresize = function () {
    clearTimeout(timeout);
    timeout = setTimeout(resizeCta, 100);
  };
  $(window).resizeEn;
  var animateStep = function (index) {
    if (index === 3) {
      if ($("#calendlyScript").length === 0) {
        var calendlyScript = document.createElement('script');
        calendlyScript.id = "calendlyScript";
        calendlyScript.src = "https://assets.calendly.com/assets/external/widget.js";
        document.head.appendChild(calendlyScript);
        calendlyScript.onload = function () {
          var report_request = $('[name="report_type"]:checked').val();
          var report_request_index = 0;
          if (report_request === "Partial report") {
            var report_category = $('[name="report_category"]:checked').val();
            if (report_category === "website") {
              report_request_index = 2;
            } else if (report_category === "SEO and content strategy") {
              report_request_index = 3;
            } else {
              report_request_index = 4;
            }
          } else {
            report_request_index = 1;
          }
          Calendly.initInlineWidget({
            url: "https://calendly.com/conveydigital/30min?hide_landing_page_details=1&hide_event_type_details=1&background_color=000224&text_color=ffffff&primary_color=1A92D6",
            parentElement: document.getElementById('calendly'),
            prefill: {
              customAnswers: {
                a1: report_request_index,
                a2: $(".call-cta__comments").val()
              }
            },
            utm: {},
            resize: true
          });
        };
      }
    }
    $('.call-cta__step-wrap--active').addClass('call-cta__step-wrap--animate-out');
    $('.call-cta__step-wrap').removeClass('call-cta__step-wrap--active');
    var $thisStepWrap = $('.call-cta__step-wrap').eq(index);
    $thisStepWrap.addClass('call-cta__step-wrap--active');
    resizeCta();
    setTimeout(function () {
      $('.call-cta__step-wrap--animate-out').removeClass('call-cta__step-wrap--animate-out');
    }, 300);
  };
  animateStep(0);
  $('[data-goto]').on('click', function () {
    var goto_index = $(this).data('goto');
    if (goto_index === 1 && $('[name="report_type"]:checked').val() === "Full report") {
      if ($(this).hasClass("call-cta__step-next")) {
        goto_index = 2;
      } else {
        goto_index = 0;
      }
    }
    animateStep(goto_index);
  });
  $('[name="report_type"]').on("change", function () {
    $(this).closest(".call-cta__step-wrap").removeClass("call-cta__step-wrap--not-ready");
  });
  $('[name="report_category"]').on("change", function () {
    $(this).closest(".call-cta__step-wrap").removeClass("call-cta__step-wrap--not-ready");
  });
  $(".call-cta__comments").on("keyup", function () {
    if ($(this).val() === "") {
      $(this).closest(".call-cta__step-wrap").addClass("call-cta__step-wrap--not-ready");
    } else {
      $(this).closest(".call-cta__step-wrap").removeClass("call-cta__step-wrap--not-ready");
    }
  });
  const $wrapper = $('.scroll-steps');
  const $video = $('.scroll-steps video');
  const $track = $('.scroll-steps__track');
  let playback_start_scroll = 0;
  let playback_max_scroll = 0;
  if (!$video.length) {
    return;
  }
  const video_node = $video[0];
  function setVideoOffset() {
    $wrapper[0].style.setProperty('--scroll-steps-video-offset', getVideoStickyOffset() + 'px');
  }
  function getVideoStickyOffset() {
    let offset = (window.innerHeight - $video.outerHeight()) / 2;
    return Math.max(40, offset);
  }
  function setScrollMinAndMax() {
    playback_start_scroll = $track.offset().top - getVideoStickyOffset();
    playback_max_scroll = playback_start_scroll + $track.outerHeight() - $video.outerHeight();
  }
  setTimeout(setupVideo, 400);
  function setupVideo() {
    if (window.innerWidth < 750) {
      addVideoControls();
    } else {
      removeVideoControls();
      setVideoOffset();
      setScrollMinAndMax();
    }
  }
  $(window).on('resize', setupVideo);
  function addVideoControls() {
    $video.attr('controls', 'controls');
  }
  function removeVideoControls() {
    $video.removeAttr('controls');
  }
  $(window).on('scroll', function () {
    const current_scroll = window.scrollY;
    console.log("current", current_scroll);
    console.log("playback_start_scroll", playback_start_scroll);
    console.log("playback_max_scroll", playback_max_scroll);
    if (current_scroll > playback_start_scroll && current_scroll < playback_max_scroll) {
      $video.trigger('play');
    } else {
      $video.trigger('pause');
    }
  });
});