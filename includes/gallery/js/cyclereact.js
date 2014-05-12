var setResponsive = function () {
  var pageHeight = jQuery(window).height();
  var headerHeight = $("#header").outerHeight();
  var wrapperWidth = $("#wrapper").innerWidth();
  var imgHeight = $(".cycle-slide-active div img").outerHeight();
  var imgWidth = $(".cycle-slide-active div img").outerWidth();

  var n = $("#header").css('right');

  if (n == '0px') {
    var barHeight = $("#solofolio-cyclereact-bar").outerHeight();
    $('#solofolio-cyclereact-images img').css('max-height', pageHeight - barHeight - headerHeight);
  }
  else {
    var barHeight = 0;
    $('#solofolio-cyclereact-images img').css('max-height', pageHeight - barHeight - 60);
  }
  $('#solofolio-cyclereact-images img').css('max-width', wrapperWidth);
}

jQuery(window).load(function(){
  $('#solofolio-cyclereact-thumbs img').load(function() {
    $(this).fadeIn('slow');
    $('.solofolio-cyclereact-fill img').fadeIn('slow');
  });
  $('.solofolio-cyclereact-fill').each(function(i, elm) {
    $(elm).attr('data-picture', '');
  });

  $('.picturefill-background').each(function(i, elm) {
    url = $(this).data().image
    $(elm).css('background-image', 'url(' + url + ')').fadeIn('slow');
  });

  window.picturefill();
  setResponsive();
  $(".thumbs").click(function(){
    $("#solofolio-cyclereact-thumbs").toggle();
    $(".solofolio-cyclereact-caption").toggle();
    $("#solofolio-cyclereact-stage").toggle();
    $(".thumbs").toggle();
    $(".arrows").toggle();
  });
  $(".thumb a").click(function(){
    $("#solofolio-cyclereact-thumbs").hide();
    $("#solofolio-cyclereact-stage, .arrows").show();
    $(".thumbs").toggle();
  });
});

jQuery(window).resize(setResponsive);

jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-after', function( event, opts ) {
  $("#solofolio-cyclereact-thumbs").hide();
  $("#solofolio-cyclereact-stage, .arrows").show();
  $(".thumbs").removeClass("show-full");
});

jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-before', function( event, opts ) {
  window.picturefill();
  setResponsive();
});

jQuery(document.documentElement).keyup(function (e) {
  if (e.keyCode == 37) { jQuery('#solofolio-cyclereact-images').cycle('prev') }
  if (e.keyCode == 38) { jQuery('.thumbs').trigger('click') }
  if (e.keyCode == 39) { jQuery('#solofolio-cyclereact-images').cycle('next') }
});
