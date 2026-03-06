var Devfolio = (function($){

  function devfolioInit(){
    // ── Mobile nav toggle ──
    $('.devfolio-nav-toggle').on('click',function(){
      $('.devfolio-nav-links').toggleClass('devfolio-open');
    });
    $('.devfolio-nav-links a').on('click',function(){
      $('.devfolio-nav-links').removeClass('devfolio-open');
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
  }

  // Auto-init on DOM ready
  $(devfolioInit);

  // Public API
  return { init: devfolioInit };

})(jQuery);
