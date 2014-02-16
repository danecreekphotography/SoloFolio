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
    $('#solofolio-cyclereact-images img').css('max-height', pageHeight - barHeight - 40);
  }
  $('#solofolio-cyclereact-images img').css('max-width', wrapperWidth);
}

jQuery(window).load(function(){
  setResponsive();
  $(".thumbs").click(function(){
    $("#solofolio-cyclereact-thumbs").toggle();
    $(".solofolio-cyclereact-controls p").toggle();
    $("#solofolio-cyclereact-stage").toggle();
    $(".toggle-thumbs").toggleClass("show-full");
    $(".toggle-arrows").toggleClass("show-arrows");
  });
  $(".thumb a").click(function(){
    $("#solofolio-cyclereact-thumbs").hide();
    $("#solofolio-cyclereact-stage").show();
  });
});

jQuery(window).resize(setResponsive);

// jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-after', function( event, opts ) {
//   $("#solofolio-cyclereact-thumbs").hide();
//   $("#solofolio-cyclereact-stage").show();
// });

jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-before', function( event, opts ) {
  window.picturefill();
  setResponsive();
});

jQuery(document.documentElement).keyup(function (e) {
  if (e.keyCode == 39) { jQuery('#solofolio-cyclereact-images').cycle('next') }
  if (e.keyCode == 37) { jQuery('#solofolio-cyclereact-images').cycle('prev') }
});
