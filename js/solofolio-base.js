/*global jQuery */
/*!
* SoloFolio base JS
*
* By Joel Hawksley, included with SoloFolio Theme
*/
jQuery(window).load(function(){
  jQuery("p:has(img)").css('margin' , '0').css('padding' , '0');

  jQuery("#wrapper").fitVids();

  jQuery('#menu-icon').click(function(){
    jQuery("#header-content").slideToggle();
    jQuery(this).toggleClass("active");
  });

  jQuery('.solofolio-custom-menu h3').click(function(e){
    jQuery(e.target).parent().find('ul').toggle();
  });
});
