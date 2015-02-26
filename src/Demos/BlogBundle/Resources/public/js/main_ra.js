(function () {
  // Слайдер
  var slider = $('section#slider ul').bxSlider({
      pager: false,
      controls: false,
      onSliderLoad: function (currentIndex) {
        slogan = $('#slider').find('.slogan');
        $(slogan).animate({ top: 100 }, 200);
        // Центровка слайдов
        center_slide();
      },
      onSlideBefore: function ($slideElement) {
        $(slogan).css({ top: 485 }, 200);
      },
      onSlideAfter: function ($slideElement) {
        $(slogan).animate({ top: 100 }, 200);
      }
    });
  // центрирование изображения в слайдере
  $(window).resize(function () {
    center_slide();
  });
  $(document).ready(function () {
  }).on('click', '', function (event) {
  });
}());
function center_slide() {
  var slide_img = $('.slide').find('img');
  if ($(window).width() < 1920) {
    var ml = ($(window).width() - 1920) * 0.5 + 'px';
    slide_img.css({ 'margin-left': ml });
  } else {
    slide_img.css({ 'margin-left': 0 });
  }
}