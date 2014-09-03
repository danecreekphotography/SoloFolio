var setResponsive = function () {
  var pageHeight = jQuery(window).height();
  var headerHeight = $("#header").outerHeight();
  var wrapperWidth = $("#wrapper").innerWidth();
  var imgHeight = $(".cycle-slide-active div img").outerHeight();
  var imgWidth = $(".cycle-slide-active div img").outerWidth();

  var n = $("#header").css('right');

  if ($(window).width() < 1025) {
    $('#wrapper').css('top', headerHeight);
  }

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

var showThumbs = function () {
  $(".solofolio-cyclereact-sidebar, #solofolio-cyclereact-stage").hide();
  $("#solofolio-cyclereact-thumbs").show();
}

var hideThumbs = function () {
  $(".solofolio-cyclereact-sidebar, #solofolio-cyclereact-stage").show();
  $("#solofolio-cyclereact-thumbs").hide();
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
    showThumbs();
  });
  $(".thumb a").click(function(){
    hideThumbs();
  });
});

jQuery(window).resize(setResponsive);

jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-after', function( event, opts ) {
  $("#solofolio-cyclereact-thumbs").hide();
  $("#solofolio-cyclereact-stage, .solofolio-cyclereact-sidebar").show();
  $(".thumbs").removeClass("show-full");
});

jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-before', function( event, opts ) {
  window.picturefill();
  setResponsive();
});

jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-update-view', function( event, opts ) {
  $(".solofolio-cyclereact-count").html((opts.currSlide + 1) + " / " + opts.slideCount);
});

jQuery(document.documentElement).keyup(function (e) {
  if (e.keyCode == 37) { jQuery('#solofolio-cyclereact-images').cycle('prev') }
  if (e.keyCode == 38) { jQuery('.thumbs').trigger('click') }
  if (e.keyCode == 39) { jQuery('#solofolio-cyclereact-images').cycle('next') }
});
