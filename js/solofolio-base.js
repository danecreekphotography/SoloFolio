/*global jQuery */
/*!
* SoloFolio base JS
*
* By Joel Hawksley, included with SoloFolio Theme
*/
jQuery(window).load(function(){
  jQuery("p:has(img)").css('margin' , '0').css('padding' , '0');

  jQuery(".wrapper").fitVids();

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
});

