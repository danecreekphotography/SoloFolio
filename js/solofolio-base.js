$(window).load(function(){
  $("p:has(img)").css('margin' , '0').css('padding' , '0');

  $("#wrapper").fitVids();

  $('.entry img').each(function(){
    var width = $(this).attr('width');
    $(this).attr('style', 'max-width:' + width + 'px');

    $(this).removeAttr('width').removeAttr('height');
  });

  $('#menu-icon').click(function(){
    $("#header-content").slideToggle();
    $(this).toggleClass("active");
  });
});
