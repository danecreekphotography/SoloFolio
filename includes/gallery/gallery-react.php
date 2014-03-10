<?php
foreach ($attachment_ids as $id) {
	$attachment = get_post($id);

	$link2 = wp_get_attachment_url($id);
	$link3 = wp_get_attachment_image_src($id, 'thumbnail');
	$link4 = wp_get_attachment_image_src($id, 'large');
	$link5 = wp_get_attachment_image_src($id, 'xlarge');

	$helper = get_theme_mod( 'solofolio_header_width' ) + 900; // Calculates the break point dynamically

	$output .= "
	<div class=\"sl-react\" data-picture data-alt=\"" .  wptexturize($attachment->post_excerpt) . "\">
		<div data-src=\"" . $link4[0] . "\"></div>
		<div data-src=\"" . $link5[0] . "\"      data-media=\"(min-width: 800px) and (min-device-pixel-ratio: 2.0)\"></div>
		<div data-src=\"" . $link5[0] . "\" data-media=\"(min-width: " . $helper . "px)\"></div>

		<!-- Fallback content for non-JS browsers. Same img src as the initial, unqualified source element. -->
		<noscript><img src=\"" . $link6[0] . "\" alt=\"" .  wptexturize($attachment->post_excerpt) . "\"></noscript>
	</div>
	<p class=\"solofolio-caption sl-react-caption\">" .  wptexturize($attachment->post_excerpt) . "</p>";
} // End ForEach

add_action('wp_footer', 'sl_react');

function sl_react() {
	$output .= "<script type=\"text/javascript\">window.matchMedia=window.matchMedia||(function(e,f){var c,a=e.documentElement,b=a.firstElementChild||a.firstChild,d=e.createElement(\"body\"),g=e.createElement(\"div\");g.id=\"mq-test-1\";g.style.cssText=\"position:absolute;top:-100em\";d.appendChild(g);return function(h){g.innerHTML='&shy;<style media=\"'+h+'\"> #mq-test-1 { width: 42px; }</style>';a.insertBefore(d,b);c=g.offsetWidth==42;a.removeChild(d);return{matches:c,media:h}}})(document);</script>";
	$output .= "<script type=\"text/javascript\" src=\"" . get_template_directory_uri() . "/includes/gallery/js/picturefill.js\"></script>";

	$output .= "
	<script type=\"text/javascript\">
	$(window).load(function(){
		var setResponsive = function () {
		  var pageHeight = jQuery(window).height();
		  var blockHeight = $(\".sl-react-caption\").outerHeight();
		  $('.sl-react img').css('max-height', pageHeight - blockHeight);
		}
		$(window).resize(setResponsive);
		setResponsive();
	});
	</script>";

	$output .="
	<style type=\"text/css\">
	#wrapper {
		overflow: scroll;
	}
	</style>";

	echo $output;
}
?>
