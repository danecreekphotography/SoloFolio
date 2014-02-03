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
	$output .= "<script type=\"text/javascript\" src=\"" . get_bloginfo('template_url') . "/includes/gallery/js/matchmedia.js\"></script>";
	$output .= "<script type=\"text/javascript\" src=\"" . get_bloginfo('template_url') . "/includes/gallery/js/picturefill.js\"></script>";

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
