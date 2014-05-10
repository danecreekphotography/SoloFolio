$(window).load(function(){
  $("p:has(img)").css('margin' , '0');
  $("p:has(img)").css('padding' , '0');

  $('.entry img').each(function(){
    var width = $(this).attr('width');
    $(this).attr('style', 'max-width:' + width + 'px');

    $(this).removeAttr('width');
    $(this).removeAttr('height');
  });

  $('#menu-icon').click(function(){
    $("#header-content").slideToggle();
    $(this).toggleClass("active");
  });
});
