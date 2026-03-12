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

    // ── Portfolio Popup ──
    var devfolioPortfolioItems = $('.devfolio-portfolio-card').map(function(){
      var $card = $(this);
      var techRaw = String($card.data('tech') || '');
      return {
        title: String($card.data('title') || ''),
        category: String($card.data('category') || ''),
        image: String($card.data('image') || ''),
        description: String($card.data('description') || ''),
        tech: techRaw ? techRaw.split(',').map(function(t){ return $.trim(t); }).filter(Boolean) : [],
        liveUrl: String($card.data('live-url') || ''),
        githubUrl: String($card.data('github-url') || '')
      };
    }).get();

    $('.devfolio-portfolio-card').on('click',function(){
      var idx=parseInt($(this).data('index'),10);
      var item=devfolioPortfolioItems[idx];
      if(!item){ return; }

      $('.devfolio-portfolio-popup-image img').attr('src',item.image);
      $('.devfolio-portfolio-popup-cat').text(item.category);
      $('.devfolio-portfolio-popup-title').text(item.title);
      $('.devfolio-portfolio-popup-desc').text(item.description);

      var tags='';
      item.tech.forEach(function(t){tags+='<span class="devfolio-tech-tag">'+t+'</span>';});
      $('.devfolio-portfolio-popup-tags').html(tags);

      var links='';
      if(item.liveUrl) links+='<a href="'+item.liveUrl+'" target="_blank" class="devfolio-link-live">↗ Live Preview</a>';
      if(item.githubUrl) links+='<a href="'+item.githubUrl+'" target="_blank" class="devfolio-link-code">⌥ Source Code</a>';
      $('.devfolio-portfolio-popup-links').html(links);

      $('.devfolio-portfolio-popup').addClass('devfolio-active');
      $('body').css('overflow','hidden');
    });

    $('.devfolio-portfolio-popup-close').on('click',function(){
      $('.devfolio-portfolio-popup').removeClass('devfolio-active');
      $('body').css('overflow','');
    });
    $('.devfolio-portfolio-popup').on('click',function(e){
      if($(e.target).hasClass('devfolio-portfolio-popup')){
        $('.devfolio-portfolio-popup').removeClass('devfolio-active');
        $('body').css('overflow','');
      }
    });
    $(document).on('keydown',function(e){
      if($('.devfolio-portfolio-popup').hasClass('devfolio-active')&&e.key==='Escape'){
        $('.devfolio-portfolio-popup').removeClass('devfolio-active');
        $('body').css('overflow','');
      }
    });

    // ── Events data from DOM ──
    var devfolioEventsData = $('.devfolio-carousel-slide').map(function(){
      var $slide = $(this);
      return {
        src: String($slide.data('src') || $slide.find('img').attr('src') || ''),
        title: String($slide.data('title') || $slide.find('.devfolio-carousel-caption-title').text() || ''),
        loc: String($slide.data('loc') || $slide.find('.devfolio-carousel-caption-loc').text() || '')
      };
    }).get();

    // ── Events Carousel ──
    var devfolioCarouselActive = 0;
    var devfolioCarouselTotal = $('.devfolio-carousel-slide').length;
    var devfolioAutoPlay = null;

    function devfolioStartAutoPlay() {}
    function devfolioStopAutoPlay() {}

    if (devfolioCarouselTotal > 0) {
      // Build dots
      var dotsHtml = '';
      for (var d = 0; d < devfolioCarouselTotal; d++) {
        dotsHtml += '<button class="devfolio-carousel-dot' + (d === 0 ? ' devfolio-dot-active' : '') + '" data-dot="' + d + '" aria-label="Slide ' + (d + 1) + '"></button>';
      }
      $('.devfolio-carousel-dots').html(dotsHtml);

      function devfolioUpdateCarousel() {
        $('.devfolio-carousel-slide').each(function() {
          var idx = parseInt($(this).data('slide'),10);
          var diff = idx - devfolioCarouselActive;
          var total = devfolioCarouselTotal;
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
            if (abs === 0) $el.addClass('devfolio-slide-active');
          }
        });
        $('.devfolio-carousel-dot').removeClass('devfolio-dot-active');
        $('.devfolio-carousel-dot[data-dot="' + devfolioCarouselActive + '"]').addClass('devfolio-dot-active');
      }

      function devfolioCarouselNext() {
        devfolioCarouselActive = (devfolioCarouselActive + 1) % devfolioCarouselTotal;
        devfolioUpdateCarousel();
      }
      function devfolioCarouselPrev() {
        devfolioCarouselActive = (devfolioCarouselActive - 1 + devfolioCarouselTotal) % devfolioCarouselTotal;
        devfolioUpdateCarousel();
      }

      devfolioStartAutoPlay = function() {
        if (devfolioAutoPlay) { clearInterval(devfolioAutoPlay); }
        devfolioAutoPlay = setInterval(devfolioCarouselNext, 4000);
      };
      devfolioStopAutoPlay = function() {
        if (devfolioAutoPlay) {
          clearInterval(devfolioAutoPlay);
          devfolioAutoPlay = null;
        }
      };

      $('.devfolio-carousel-next').on('click', function() {
        devfolioStopAutoPlay();
        devfolioCarouselNext();
        devfolioStartAutoPlay();
      });
      $('.devfolio-carousel-prev').on('click', function() {
        devfolioStopAutoPlay();
        devfolioCarouselPrev();
        devfolioStartAutoPlay();
      });
      $('.devfolio-carousel-dots').on('click', '.devfolio-carousel-dot', function() {
        devfolioStopAutoPlay();
        devfolioCarouselActive = parseInt($(this).data('dot'),10);
        devfolioUpdateCarousel();
        devfolioStartAutoPlay();
      });

      // Click active slide to open lightbox
      $('.devfolio-carousel-slide').on('click', function() {
        var idx = parseInt($(this).data('slide'),10);
        if (idx === devfolioCarouselActive) {
          devfolioStopAutoPlay();
          devfolioOpenEventsLightbox(idx);
        } else {
          devfolioStopAutoPlay();
          devfolioCarouselActive = idx;
          devfolioUpdateCarousel();
          devfolioStartAutoPlay();
        }
      });

      $('.devfolio-carousel-wrap').on('mouseenter', devfolioStopAutoPlay).on('mouseleave', devfolioStartAutoPlay);

      devfolioUpdateCarousel();
      devfolioStartAutoPlay();
    }

    // ── Events Lightbox ──
    var devfolioLightboxIdx = 0;

    function devfolioOpenEventsLightbox(idx) {
      devfolioLightboxIdx = idx;
      var item = devfolioEventsData[idx];
      if (!item) { return; }
      $('.devfolio-events-lightbox-img').attr('src', item.src);
      $('.devfolio-events-lightbox-title').text(item.title);
      $('.devfolio-events-lightbox-loc').text(item.loc);
      $('.devfolio-events-lightbox').addClass('devfolio-active');
      $('body').css('overflow', 'hidden');
    }
    function devfolioCloseEventsLightbox() {
      $('.devfolio-events-lightbox').removeClass('devfolio-active');
      $('body').css('overflow', '');
      devfolioStartAutoPlay();
    }

    $('.devfolio-events-lightbox-close').on('click', devfolioCloseEventsLightbox);
    $('.devfolio-events-lightbox').on('click', function(e) {
      if ($(e.target).hasClass('devfolio-events-lightbox')) devfolioCloseEventsLightbox();
    });
    $('.devfolio-events-lightbox-prev').on('click', function() {
      if (!devfolioEventsData.length) { return; }
      devfolioLightboxIdx = (devfolioLightboxIdx - 1 + devfolioEventsData.length) % devfolioEventsData.length;
      devfolioOpenEventsLightbox(devfolioLightboxIdx);
    });
    $('.devfolio-events-lightbox-next').on('click', function() {
      if (!devfolioEventsData.length) { return; }
      devfolioLightboxIdx = (devfolioLightboxIdx + 1) % devfolioEventsData.length;
      devfolioOpenEventsLightbox(devfolioLightboxIdx);
    });
    $(document).on('keydown', function(e) {
      if ($('.devfolio-events-lightbox').hasClass('devfolio-active') && e.key === 'Escape') devfolioCloseEventsLightbox();
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
