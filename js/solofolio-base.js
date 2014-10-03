/*global jQuery */
/*!
* SoloFolio base JS
*
* By Joel Hawksley, included with SoloFolio Theme
*/
jQuery(window).load(function(){
  jQuery("p:has(img)").css('margin' , '0').css('padding' , '0');

  jQuery("#wrapper").fitVids();

  jQuery('.entry img').each(function(){
    var width = jQuery(this).attr('width');
    jQuery(this).attr('style', 'max-width:' + width + 'px');

    jQuery(this).removeAttr('width').removeAttr('height');
  });

  jQuery('#menu-icon').click(function(){
    jQuery("#header-content").slideToggle();
    jQuery(this).toggleClass("active");
  });
});
