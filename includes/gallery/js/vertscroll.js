var setResponsive = function () {
  var pageHeight = jQuery(window).height();
  var headerHeight = $("#header").outerHeight();
  var wrapperWidth = $("#wrapper").innerWidth();

  var n = $("#header").css('right');

  if (wrapperWidth > 600) {
    if (n == '0px') {
      $('.vert-scroll img').css('max-height', pageHeight - headerHeight - 40);
    }
    else {
      var barHeight = 0;
      $('.vert-scroll img').css('max-height', pageHeight - 60);
    }
  } else {
    $('.vert-scroll img').css('max-height', pageHeight);
  }

  $('.vert-scroll .wp-caption-text').each(function(i, elm) {
    width = $(this).parent().find('img').outerWidth();
    $(elm).css('max-width', width);
  });
}

jQuery(window).load(function(){
  setResponsive();
});

jQuery(window).resize(setResponsive);
