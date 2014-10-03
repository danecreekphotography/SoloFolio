var setResponsive = function () {
  var pageHeight = jQuery(window).height();
  var headerHeight = jQuery("#header").outerHeight();
  var wrapperWidth = jQuery("#wrapper").innerWidth();
  var imgHeight = jQuery(".cycle-slide-active div img").outerHeight();
  var imgWidth = jQuery(".cycle-slide-active div img").outerWidth();

  var n = jQuery("#header").css('right');

  if (jQuery(window).width() < 1025) {
    jQuery('#wrapper').css('top', headerHeight);
  }

  if (n == '0px') {
    var barHeight = jQuery("#solofolio-cyclereact-bar").outerHeight();
    jQuery('#solofolio-cyclereact-images img').css('max-height', pageHeight - barHeight - headerHeight);
  }
  else {
    var barHeight = 0;
    jQuery('#solofolio-cyclereact-images img').css('max-height', pageHeight - barHeight - 60);
  }
  jQuery('#solofolio-cyclereact-images img').css('max-width', wrapperWidth);
}

var showThumbs = function () {
  jQuery(".solofolio-cyclereact-sidebar, #solofolio-cyclereact-stage").hide();
  jQuery("#solofolio-cyclereact-thumbs").show();
}

var hideThumbs = function () {
  jQuery(".solofolio-cyclereact-sidebar, #solofolio-cyclereact-stage").show();
  jQuery("#solofolio-cyclereact-thumbs").hide();
}

jQuery(window).load(function(){
  jQuery('#solofolio-cyclereact-thumbs img').load(function() {
    jQuery(this).fadeIn('slow');
    jQuery('.solofolio-cyclereact-fill img').fadeIn('slow');
  });
  jQuery('.solofolio-cyclereact-fill').each(function(i, elm) {
    jQuery(elm).attr('data-picture', '');
  });

  jQuery('.picturefill-background').each(function(i, elm) {
    url = jQuery(this).data().image
    jQuery(elm).css('background-image', 'url(' + url + ')').fadeIn('slow');
  });

  window.picturefill();
  setResponsive();
  jQuery(".thumbs").click(function(){
    showThumbs();
  });
  jQuery(".thumb a").click(function(){
    hideThumbs();
  });
});

jQuery(window).resize(setResponsive);

jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-after', function( event, opts ) {
  jQuery("#solofolio-cyclereact-thumbs").hide();
  jQuery("#solofolio-cyclereact-stage, .solofolio-cyclereact-sidebar").show();
  jQuery(".thumbs").removeClass("show-full");
});

jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-before', function( event, opts ) {
  window.picturefill();
  setResponsive();
});

jQuery( '#solofolio-cyclereact-images' ).on( 'cycle-update-view', function( event, opts ) {
  jQuery(".solofolio-cyclereact-count").html((opts.currSlide + 1) + " / " + opts.slideCount);
});

jQuery(document.documentElement).keyup(function (e) {
  if (e.keyCode == 37) { jQuery('#solofolio-cyclereact-images').cycle('prev') }
  if (e.keyCode == 38) { jQuery('.thumbs').trigger('click') }
  if (e.keyCode == 39) { jQuery('#solofolio-cyclereact-images').cycle('next') }
});
