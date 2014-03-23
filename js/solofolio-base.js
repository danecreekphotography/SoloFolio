$(window).load(function(){
  $("p:has(img)").css('margin' , '0');
  $("p:has(img)").css('padding' , '0');

  /* Fallback support for older images that were not uploaded with the SoloFolio format filter */
  $('.entry img').each(function() {
    // Get on screen image
    var screenImage = $(this);

    // Create new offscreen image to test
    var theImage = new Image();
    theImage.src = screenImage.attr("src");

    // Get accurate measurements from that.
    var imageWidth = theImage.width;
    var imageHeight = theImage.height;
    if (theImage.width > 0) {
      $(this).attr('style', 'max-width:' + imageWidth + 'px');
    }
  });

  $('.entry img').each(function(){
    $(this).removeAttr('width')
    $(this).removeAttr('height');
  });

  $('.entry img').retina();

  $('#menu-icon').click(function(){
    $("#header-content").slideToggle();
    $(this).toggleClass("active");
  });
});
