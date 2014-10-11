var setResponsive = function () {
  var pageHeight = jQuery(window).height();
  var headerHeight = jQuery("#header").outerHeight();
  var wrapperWidth = jQuery("#wrapper").innerWidth();
  var wrapperHeight = jQuery("#wrapper").outerHeight();
  var pageSpacing = parseInt(jQuery('#wrapper').css('right'), 10);

  var n = jQuery("#header").css('right');

  if (wrapperWidth > 600) {
    if (n == '0px') {
      jQuery('.vert-scroll img').css('max-height', pageHeight - headerHeight - pageSpacing - pageSpacing);
    }
    else {
      jQuery('.vert-scroll img').css('max-height', pageHeight - pageSpacing - pageSpacing);
    }
  } else {
    jQuery('.vert-scroll img').css('max-height', pageHeight);
  }

  jQuery('.vert-scroll .wp-caption-text').each(function(i, elm) {
    width = jQuery(this).parent().find('img').outerWidth();
    jQuery(elm).css('max-width', width);
  });
}

jQuery(window).load(function(){
  setResponsive();
});

jQuery(window).resize(setResponsive);
