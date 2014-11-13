/*global jQuery */
/*!
* SoloFolio base JS
*
* By Joel Hawksley, included with SoloFolio Theme
*/
jQuery(window).load(function(){
  jQuery("p:has(img)").css('margin' , '0').css('padding' , '0');

  jQuery(".wrapper").fitVids();

  jQuery('.thumb img').retina();

  jQuery("img.lazy").unveil(600, function() {
    jQuery(this).load(function() {
      this.style.opacity = 1;
    });
  });

  jQuery('.menu-icon').click(function(){
    jQuery(".header-content").toggle();
    jQuery(this).toggleClass("active");
  });

  jQuery('.solofolio-custom-menu h3').click(function(e){
    var $target = jQuery(e.target).parent().find('ul');

    if ($target.hasClass('visible')) {
      $target.removeClass('visible').hide();
    } else {
      jQuery('.solofolio-custom-menu ul').removeClass('visible').hide();
      $target.toggle().addClass('visible');
    }
  });

  /* Open menu containing sub-page */
  jQuery('.solofolio-custom-menu .menu').has('.current_page_item').show().addClass('visible');
});

