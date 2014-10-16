<?php
$i = 0;

$galleryTitle = get_post_meta($post->ID, 'solofolio-gallery-title', true);
$galleryText 	= get_post_meta($post->ID, 'solofolio-gallery-text', true);

if ($galleryTitle || $galleryText) {
	$i++;
	$output .= "
		<div class='solofolio-gallery-title solofolio-vertscroll-title'>
			<h2>" . $galleryTitle . "</h2>
			<div>" . wpautop($galleryText) . "</div>
		</div>";
}

foreach ($attachment_ids as $id) {
	$attachment = get_post($id);

	$link2 = wp_get_attachment_url($id);
	$link3 = wp_get_attachment_image_src($id, 'thumbnail');
	$link4 = wp_get_attachment_image_src($id, 'large');
	$link5 = wp_get_attachment_image_src($id, 'xlarge');

	if (!empty($attachment->post_excerpt)) {
		$caption = wptexturize($attachment->post_excerpt);
	} else {
		$caption = wptexturize($attachment->post_content);
	}

	$output .= "\n\n<div class='vert-scroll' style=\"max-width:" . $link5[1] . "px; \">";

	$output .= "<picture id='" . $i . "'>
								<!--[if IE 9]><video style='display: none;''><![endif]-->
								<source srcset='" . $link5[0] . "' media='(min-width: 450px) and (-webkit-min-device-pixel-ratio: 1.5)'>
								<source srcset='" . $link5[0] . "' media='(min-width: 850px)'>
								<source srcset='" . $link4[0] . "' media='(min-width: 300px)'>
								<!--[if IE 9]></video><![endif]-->
								<img srcset='" . $link4[0] . "' alt='" . $caption . "'>
							</picture>";

	if ($captions != "false" && !empty($caption)) {
		$output .= "<p class=\"wp-caption-text\">" .  $caption . "</p> ";
	}

	$output .= "</div>";
	$i += 1;
}

add_action('wp_footer', 'sl_vertscroll_js');

if (!function_exists('sl_vertscroll_js')) {
	function sl_vertscroll_js() {
		$output = "<style>
								#content-page {
									max-width: none;
								}

								@media only screen and (max-width: 1024px) {
									#content-page {
										margin-left: auto;
										margin-right: auto;
									}
								}
							</style>
							";


		$output .= "<script> document.createElement('picture');</script>";
	  echo $output;
	}
}

wp_enqueue_script('picturefill', get_template_directory_uri().'/includes/gallery/js/picturefill.js', array(), null, true );
wp_enqueue_script('solofolio-vertscroll', get_template_directory_uri().'/includes/gallery/js/vertscroll.js', array(), null, true );
?>
