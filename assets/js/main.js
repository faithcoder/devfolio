var Devfolio = (function($){

  function devfolioInit(){
    // ── Mobile nav toggle ──
    var $navToggle = $('.devfolio-nav-toggle');
    var $navLinks = $('.devfolio-nav-links');

    function devfolioCloseMenu() {
      $navLinks.removeClass('devfolio-open');
      $navToggle.removeClass('devfolio-open').attr('aria-expanded', 'false');
      $('body').removeClass('devfolio-menu-open');
    }

    function devfolioOpenMenu() {
      $navLinks.addClass('devfolio-open');
      $navToggle.addClass('devfolio-open').attr('aria-expanded', 'true');
      $('body').addClass('devfolio-menu-open');
    }

    $navToggle.on('click',function(){
      if ($navLinks.hasClass('devfolio-open')) {
        devfolioCloseMenu();
      } else {
        devfolioOpenMenu();
      }
    });
    $navLinks.find('a').on('click',function(){
      devfolioCloseMenu();
    });
    $(document).on('click', function(e) {
      if ($(window).width() > 768 || !$navLinks.hasClass('devfolio-open')) {
        return;
      }
      if ($(e.target).closest('.devfolio-navbar-inner').length) {
        return;
      }
      devfolioCloseMenu();
    });
    $(window).on('resize', function() {
      if ($(window).width() > 768) {
        devfolioCloseMenu();
      }
    });
    $(document).on('keydown', function(e) {
      if (e.key === 'Escape' && $navLinks.hasClass('devfolio-open')) {
        devfolioCloseMenu();
      }
    });
    // Brand scroll to top
    $('.devfolio-nav-brand').on('click',function(){
      $('html,body').animate({scrollTop:0},600);
    });

    // ── Scroll animations ──
    function devfolioCheckAnim(){
      $('.devfolio-anim, .devfolio-anim-left').each(function(){
        var top=$(this).offset().top;
        var trigger=$(window).scrollTop()+$(window).height()*0.88;
        if(top<trigger) $(this).addClass('devfolio-visible');
      });
    }
    $(window).on('scroll',devfolioCheckAnim);
    devfolioCheckAnim();

    // ── Tilt effect ──
    var $tilt=$('#devfolio-tilt-container');
    $tilt.on('mousemove',function(e){
      var rect=this.getBoundingClientRect();
      var x=(e.clientX-rect.left)/rect.width-0.5;
      var y=(e.clientY-rect.top)/rect.height-0.5;
      $(this).css('transform','rotateY('+x*24+'deg) rotateX('+(-y*24)+'deg)');
    });
    $tilt.on('mouseleave',function(){
      $(this).css('transform','rotateY(0) rotateX(0)');
    });

    // ── Shared 3D carousels ──
    var devfolioLightboxCarousel = null;
    var devfolioLightboxIdx = 0;
    var devfolioVideoLightboxCarousel = null;

    function devfolioInitCarousel($carousel) {
      var $slides = $carousel.find('.devfolio-carousel-slide');
      var total = $slides.length;
      var active = 0;
      var autoPlay = null;
      var lightboxType = String($carousel.data('carousel-lightbox') || '');
      var lightboxEnabled = !!lightboxType;
      var items = $slides.map(function(){
        var $slide = $(this);
        return {
          src: String($slide.data('src') || $slide.find('img').attr('src') || ''),
          title: String($slide.data('title') || $slide.find('.devfolio-carousel-caption-title').text() || ''),
          subtitle: String($slide.data('subtitle') || $slide.find('.devfolio-carousel-caption-subtitle').text() || ''),
          description: String($slide.data('description') || ''),
          videoType: String($slide.data('video-type') || ''),
          videoSrc: String($slide.data('video-src') || '')
        };
      }).get();

      function update() {
        $slides.each(function() {
          var idx = parseInt($(this).data('slide'), 10);
          var diff = idx - active;
          if (diff > total / 2) diff -= total;
          if (diff < -total / 2) diff += total;
          var abs = Math.abs(diff);
          var $el = $(this);
          $el.removeClass('devfolio-slide-active');
          if (abs > 2) {
            $el.css({ opacity: 0, transform: 'translate(-50%,-50%) scale(0.6)', zIndex: 0 });
          } else {
            var tx = diff * 280;
            var sc = 1 - abs * 0.15;
            var ry = diff * -15;
            var op = 1 - abs * 0.3;
            $el.css({
              opacity: op,
              transform: 'translate(-50%,-50%) translateX(' + tx + 'px) scale(' + sc + ') rotateY(' + ry + 'deg)',
              zIndex: 10 - abs
            });
            if (abs === 0) {
              $el.addClass('devfolio-slide-active');
            }
          }
        });
        $carousel.find('.devfolio-carousel-dot').removeClass('devfolio-dot-active');
        $carousel.find('.devfolio-carousel-dot[data-dot="' + active + '"]').addClass('devfolio-dot-active');
      }

      function next() {
        active = (active + 1) % total;
        update();
      }

      function prev() {
        active = (active - 1 + total) % total;
        update();
      }

      function startAutoPlay() {
        if (autoPlay) {
          clearInterval(autoPlay);
        }
        autoPlay = setInterval(next, 4000);
      }

      function stopAutoPlay() {
        if (autoPlay) {
          clearInterval(autoPlay);
          autoPlay = null;
        }
      }

      if (!total) {
        return null;
      }

      var dotsHtml = '';
      for (var d = 0; d < total; d++) {
        dotsHtml += '<button class="devfolio-carousel-dot' + (d === 0 ? ' devfolio-dot-active' : '') + '" data-dot="' + d + '" aria-label="Slide ' + (d + 1) + '"></button>';
      }
      $carousel.find('.devfolio-carousel-dots').html(dotsHtml);

      $carousel.find('.devfolio-carousel-next').on('click', function() {
        stopAutoPlay();
        next();
        startAutoPlay();
      });
      $carousel.find('.devfolio-carousel-prev').on('click', function() {
        stopAutoPlay();
        prev();
        startAutoPlay();
      });
      $carousel.find('.devfolio-carousel-dots').on('click', '.devfolio-carousel-dot', function() {
        stopAutoPlay();
        active = parseInt($(this).data('dot'), 10);
        update();
        startAutoPlay();
      });
      $slides.on('click', function() {
        var idx = parseInt($(this).data('slide'), 10);
        if (idx === active && lightboxEnabled) {
          stopAutoPlay();
          if ('video' === lightboxType) {
            devfolioOpenVideoLightbox($carousel, idx);
          } else {
            devfolioOpenEventsLightbox($carousel, idx);
          }
          return;
        }
        if (idx !== active) {
          stopAutoPlay();
          active = idx;
          update();
          startAutoPlay();
        }
      });
      $carousel.find('.devfolio-carousel-wrap').on('mouseenter', stopAutoPlay).on('mouseleave', startAutoPlay);

      update();
      startAutoPlay();

      var carouselApi = {
        items: items,
        startAutoPlay: startAutoPlay
      };
      $carousel.data('devfolioCarousel', carouselApi);
      return carouselApi;
    }

    $('.devfolio-carousel').each(function() {
      devfolioInitCarousel($(this));
    });

    // ── Events Lightbox ──
    function devfolioOpenEventsLightbox($carousel, idx) {
      var carouselData = $carousel.data('devfolioCarousel');
      if (!carouselData || !carouselData.items.length) { return; }

      devfolioLightboxCarousel = carouselData;
      devfolioLightboxIdx = idx;
      var item = devfolioLightboxCarousel.items[idx];
      if (!item) { return; }
      $('.devfolio-events-lightbox-img').attr('src', item.src);
      $('.devfolio-events-lightbox-title').text(item.title);
      $('.devfolio-events-lightbox-loc').text(item.subtitle);
      $('.devfolio-events-lightbox').addClass('devfolio-active');
      $('body').css('overflow', 'hidden');
    }
    function devfolioCloseEventsLightbox() {
      $('.devfolio-events-lightbox').removeClass('devfolio-active');
      $('body').css('overflow', '');
      if (devfolioLightboxCarousel) {
        devfolioLightboxCarousel.startAutoPlay();
      }
    }

    $('.devfolio-events-lightbox-close').on('click', devfolioCloseEventsLightbox);
    $('.devfolio-events-lightbox').on('click', function(e) {
      if ($(e.target).hasClass('devfolio-events-lightbox')) devfolioCloseEventsLightbox();
    });
    $('.devfolio-events-lightbox-prev').on('click', function() {
      if (!devfolioLightboxCarousel || !devfolioLightboxCarousel.items.length) { return; }
      devfolioLightboxIdx = (devfolioLightboxIdx - 1 + devfolioLightboxCarousel.items.length) % devfolioLightboxCarousel.items.length;
      $('.devfolio-events-lightbox-img').attr('src', devfolioLightboxCarousel.items[devfolioLightboxIdx].src);
      $('.devfolio-events-lightbox-title').text(devfolioLightboxCarousel.items[devfolioLightboxIdx].title);
      $('.devfolio-events-lightbox-loc').text(devfolioLightboxCarousel.items[devfolioLightboxIdx].subtitle);
    });
    $('.devfolio-events-lightbox-next').on('click', function() {
      if (!devfolioLightboxCarousel || !devfolioLightboxCarousel.items.length) { return; }
      devfolioLightboxIdx = (devfolioLightboxIdx + 1) % devfolioLightboxCarousel.items.length;
      $('.devfolio-events-lightbox-img').attr('src', devfolioLightboxCarousel.items[devfolioLightboxIdx].src);
      $('.devfolio-events-lightbox-title').text(devfolioLightboxCarousel.items[devfolioLightboxIdx].title);
      $('.devfolio-events-lightbox-loc').text(devfolioLightboxCarousel.items[devfolioLightboxIdx].subtitle);
    });
    $(document).on('keydown', function(e) {
      if ($('.devfolio-events-lightbox').hasClass('devfolio-active') && e.key === 'Escape') devfolioCloseEventsLightbox();
    });

    // ── Video Lightbox ──
    function devfolioBuildVideoLightboxMedia(item) {
      if (!item) {
        return null;
      }

      if ('youtube' === item.videoType && item.videoSrc) {
        return $('<iframe>', {
          src: item.videoSrc,
          title: item.title || 'Video',
          allow: 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share',
          allowfullscreen: 'allowfullscreen',
          referrerpolicy: 'strict-origin-when-cross-origin'
        });
      }

      if ('hosted' === item.videoType && item.videoSrc) {
        return $('<video>', {
          src: item.videoSrc,
          controls: true,
          autoplay: true,
          playsinline: true
        });
      }

      return null;
    }

    function devfolioOpenVideoLightbox($carousel, idx) {
      var carouselData = $carousel.data('devfolioCarousel');
      if (!carouselData || !carouselData.items.length) { return; }

      var item = carouselData.items[idx];
      if (!item || !item.videoSrc) { return; }

      devfolioVideoLightboxCarousel = carouselData;
      var $media = devfolioBuildVideoLightboxMedia(item);
      if (!$media) { return; }

      $('.devfolio-video-lightbox-media').empty().append($media);
      $('.devfolio-video-lightbox-title').text(item.title);
      $('.devfolio-video-lightbox-subtitle').text(item.subtitle);
      $('.devfolio-video-lightbox-desc').text(item.description);
      $('.devfolio-video-lightbox').addClass('devfolio-active');
      $('body').css('overflow', 'hidden');
    }

    function devfolioCloseVideoLightbox() {
      $('.devfolio-video-lightbox-media').empty();
      $('.devfolio-video-lightbox').removeClass('devfolio-active');
      $('body').css('overflow', '');
      if (devfolioVideoLightboxCarousel) {
        devfolioVideoLightboxCarousel.startAutoPlay();
      }
    }

    $('.devfolio-video-lightbox-close').on('click', devfolioCloseVideoLightbox);
    $('.devfolio-video-lightbox').on('click', function(e) {
      if ($(e.target).hasClass('devfolio-video-lightbox')) devfolioCloseVideoLightbox();
    });
    $(document).on('keydown', function(e) {
      if ($('.devfolio-video-lightbox').hasClass('devfolio-active') && e.key === 'Escape') devfolioCloseVideoLightbox();
    });

    // ── Tab switching ──
    $('.devfolio-tab-trigger').on('click',function(){
      var tab=$(this).data('tab');
      $('.devfolio-tab-trigger').removeClass('devfolio-tab-active');
      $(this).addClass('devfolio-tab-active');
      $('.devfolio-tab-panel').removeClass('devfolio-tab-panel-active');
      $('.devfolio-tab-panel[data-panel="'+tab+'"]').addClass('devfolio-tab-panel-active');
    });

    // ── Testimonial Slider ──
    var tSlideIdx = 0;
    var $tTrack = $('.devfolio-testimonial-track');
    var tTotal = $tTrack.children('.devfolio-testimonial-card').length;
    var tAnimating = false;

    if (tTotal > 0) {
      function devfolioTestimonialCardWidth() {
        return $tTrack.children('.devfolio-testimonial-card').first().outerWidth(true) || 0;
      }

      function devfolioBuildTestimonialDots() {
        var maxDots = Math.max(1, tTotal);
        var dotsHtml = '';
        for (var td = 0; td < maxDots; td++) {
          dotsHtml += '<button class="devfolio-testimonial-dot' + (td === tSlideIdx ? ' devfolio-dot-active' : '') + '" data-tdot="' + td + '"></button>';
        }
        $('.devfolio-testimonial-dots').html(dotsHtml);
      }

      function devfolioUpdateTestimonialSlider() {
        $('.devfolio-testimonial-dot').removeClass('devfolio-dot-active');
        $('.devfolio-testimonial-dot[data-tdot="' + tSlideIdx + '"]').addClass('devfolio-dot-active');
      }

      function devfolioTestimonialNext() {
        if (tAnimating || tTotal <= 1) return;
        var cardWidth = devfolioTestimonialCardWidth();
        if (!cardWidth) return;

        tAnimating = true;
        $tTrack.css('transition', 'transform .4s ease');
        $tTrack.css('transform', 'translateX(' + (-cardWidth) + 'px)');

        $tTrack.one('transitionend webkitTransitionEnd', function() {
          $tTrack.css('transition', 'none');
          $tTrack.append($tTrack.children('.devfolio-testimonial-card').first());
          $tTrack.css('transform', 'translateX(0)');
          tSlideIdx = (tSlideIdx + 1) % tTotal;
          devfolioUpdateTestimonialSlider();
          tAnimating = false;
        });
      }

      function devfolioTestimonialPrev() {
        if (tAnimating || tTotal <= 1) return;
        var cardWidth = devfolioTestimonialCardWidth();
        if (!cardWidth) return;

        tAnimating = true;
        $tTrack.css('transition', 'none');
        $tTrack.prepend($tTrack.children('.devfolio-testimonial-card').last());
        $tTrack.css('transform', 'translateX(' + (-cardWidth) + 'px)');
        // Force reflow before animating back.
        // eslint-disable-next-line no-unused-expressions
        $tTrack[0].offsetHeight;
        $tTrack.css('transition', 'transform .4s ease');
        $tTrack.css('transform', 'translateX(0)');

        $tTrack.one('transitionend webkitTransitionEnd', function() {
          tSlideIdx = (tSlideIdx - 1 + tTotal) % tTotal;
          devfolioUpdateTestimonialSlider();
          tAnimating = false;
        });
      }

      function devfolioJumpToDot(target) {
        if (target === tSlideIdx) return;
        var safety = 0;
        while (tSlideIdx !== target && safety < tTotal) {
          if (((target - tSlideIdx + tTotal) % tTotal) <= ((tSlideIdx - target + tTotal) % tTotal)) {
            $tTrack.append($tTrack.children('.devfolio-testimonial-card').first());
            tSlideIdx = (tSlideIdx + 1) % tTotal;
          } else {
            $tTrack.prepend($tTrack.children('.devfolio-testimonial-card').last());
            tSlideIdx = (tSlideIdx - 1 + tTotal) % tTotal;
          }
          safety++;
        }
        $tTrack.css('transition', 'none');
        $tTrack.css('transform', 'translateX(0)');
        devfolioUpdateTestimonialSlider();
      }

      devfolioBuildTestimonialDots();

      $('.devfolio-testimonial-next').on('click', function () {
        devfolioTestimonialNext();
      });
      $('.devfolio-testimonial-prev').on('click', function () {
        devfolioTestimonialPrev();
      });
      $('.devfolio-testimonial-dots').on('click', '.devfolio-testimonial-dot', function () {
        var target = parseInt($(this).data('tdot'), 10);
        if (isNaN(target)) return;
        devfolioJumpToDot(target);
      });
      $(window).on('resize', function () {
        $tTrack.css('transition', 'none');
        $tTrack.css('transform', 'translateX(0)');
      });

      devfolioUpdateTestimonialSlider();
    }
  }

  // Auto-init on DOM ready
  $(devfolioInit);

  // Public API
  return { init: devfolioInit };

})(jQuery);
