$(function () {
  feedback_form_handler();
  // HOMEPAGE
  if ($('body.home').length) {
    // Большой слайдер
    var slider = $('.main-slider ul').bxSlider({
        pager: false,
        controls: false
      });
    // 1 слайдер : пр-во сайтов
    var slider1 = $('.slider-1 ul').bxSlider({
        pager: false,
        controls: false,
        minSlides: 3,
        maxSlides: 3,
        slideWidth: 320,
        slideMargin: 30
      });
    // 2 слайдер : Дизайн
    var slider2 = $('.slider-2 ul').bxSlider({
        pager: false,
        controls: false,
        minSlides: 3,
        maxSlides: 3,
        slideWidth: 320,
        slideMargin: 30
      });
    // 3 слайдер : Фото
    var slider3 = $('.slider-3 ul').bxSlider({
        pager: false,
        controls: false,
        minSlides: 3,
        maxSlides: 3,
        slideWidth: 320,
        slideMargin: 30
      });
    //--
    /*
		*/
    $(document).ready(function () {
    }).on('click', '.main-slider .controls a', function (event) {
      event.preventDefault();
      $(this).hasClass('prev') && slider.goToPrevSlide();
      $(this).hasClass('next') && slider.goToNextSlide();
    }).on('click', '.slider-1 .controls a', function (event) {
      event.preventDefault();
      $(this).hasClass('prev') && slider1.goToPrevSlide();
      $(this).hasClass('next') && slider1.goToNextSlide();
    }).on('click', '.slider-2 .controls a', function (event) {
      event.preventDefault();
      $(this).hasClass('prev') && slider2.goToPrevSlide();
      $(this).hasClass('next') && slider2.goToNextSlide();
    }).on('click', '.slider-3 .controls a', function (event) {
      event.preventDefault();
      $(this).hasClass('prev') && slider3.goToPrevSlide();
      $(this).hasClass('next') && slider3.goToNextSlide();
    });
  }
  // HOMEPAGE
  $(document).ready(function () {
  }).on('click', '.login a.login', function (event) {
    event.preventDefault();
    if ($(this).next('.login-form').is(':hidden')) {
      $(this).next('.login-form').fadeIn(300);
    } else {
      $(this).next('.login-form').fadeOut(300);
    }
  }).on('mouseenter', '.chapter figure', function (event) {
    event.preventDefault();
    if ($(this).find('figcaption').length) {
      $(this).find('figcaption').slideDown(300);
    }
  }).on('mouseleave', '.chapter figure', function (event) {
    event.preventDefault();
    $(this).find('figcaption').slideUp(300);
  }).on('click', '.chapter figure a.imglink', function (event) {
    event.preventDefault();
    $('.fullscreen').load('/ajax/fullScreenImg.php', { 'imgSrc': $(this).attr('href') }, function (response, status, xhr) {
      if (status == 'error') {
        console.log('Error: ' + xhr.status + ' ' + xhr.statusText);
      } else {
        console.log('All fun!\r\t' + response);
        fullscreenImg($('.fullscreen .img-block img'));
        $('.fullscreen .help').show();
        $('.fullscreen .help').fadeOut(2000);
      }
    });
  }).on('click', '.fullscreen', function (event) {
    // event.preventDefault();
    $(this).fadeOut(300, function () {
      $('.fullscreen .img-block img').remove();
    });
  }).on('keydown', function (event) {
    if (event.which == 27) {
      $('.fullscreen').fadeOut(300, function () {
        $('.fullscreen .img-block img').remove();
      });
    }
  });
  ;
  // рассчет полноэкранного изображения
  $(window).resize(function () {
    if ($('.fullscreen').is(':visible')) {
      fullscreenImg($('.fullscreen .img-block img'));
    }
  });
});
/*
*/
function fullscreenImg(img_el, mode) {
  $('.fullscreen').fadeIn(300);
  var ww = $(window).width();
  var wh = $(window).height();
  var imw = $(img_el).width();
  var imh = $(img_el).height();
  // console.log('imw = '+imw+'; imh = '+imh);
  var imk = imw / imh;
  var borderw = 16;
  // толщина контура	
  if (mode == 1) {
    // заполнение окна
    if (ww / wh > imk) {
      imw = ww;
      imh = Math.round(imw / imk);
    } else {
      imh = wh;
      imw = Math.round(imh * imk);
    }
  } else {
    // вписывание изображения
    if (ww / wh > imk) {
      imh = wh;
      imw = Math.round(imh * imk);
    } else {
      imw = ww;
      imh = Math.round(imw / imk);
    }
  }
  $(img_el).width(imw);
  $(img_el).height(imh);
  // console.log('ww='+ww+'; wh='+wh+'; imw='+imw+'; imh='+imh);
  $('.fullscreen .img-block').css({
    'margin-left': -imw / 2,
    'margin-top': -imh / 2
  });
}
// работа с формой обратной связи в футере
function feedback_form_handler() {
  $(document).ready(function () {
    if ($('form#feedback .form-report-block').length) {
      var report_block = $('form#feedback .form-report-block');
      $('html, body').scrollTop($('footer').position().top + 320);
      $(report_block).slideDown(300);
    }
  }).on('click', 'form#feedback .form-report-block a.close1', function (event) {
    event.preventDefault();
    $('form#feedback .form-report-block').slideUp(300);
  });
}
function feedback_submit(event) {
}