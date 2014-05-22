<?php
$i = 0;
foreach ($attachment_ids as $id) {
	$attachment = get_post($id);

	$link2 = wp_get_attachment_url($id);
	$link3 = wp_get_attachment_image_src($id, 'thumbnail');
	$link4 = wp_get_attachment_image_src($id, 'large');
	$link5 = wp_get_attachment_image_src($id, 'xlarge');

	$output .= "\n\n<div class='vert-scroll' style=\"max-width:" . $link5[1] . "px; \">";

	$output .= "<picture id='" . $i . "'>
								<!--[if IE 9]><video style='display: none;''><![endif]-->
								<source srcset='" . $link5[0] . "' media='(min-width: 450px) and (-webkit-min-device-pixel-ratio: 1.5)'>
								<source srcset='" . $link5[0] . "' media='(min-width: 850px)'>
								<source srcset='" . $link4[0] . "' media='(min-width: 300px)'>
								<!--[if IE 9]></video><![endif]-->
								<img srcset='" . $link4[0] . "' alt='" .  wptexturize($attachment->post_excerpt) . "'>
							</picture>";

	if ($captions != "false"){
		$output .= "<p class=\"wp-caption-text\">" .  wptexturize($attachment->post_excerpt) . "</p> ";
	}

	$output .= "</div>";
	$i += 1;
}

add_action('wp_footer', 'sl_vertscroll_js');

function sl_vertscroll_js() {
	$output = "<style>
							#wrapper {
								padding-top: 0;
							}

							#content-page {
								max-width: none;
							}

							@media only screen and (max-width: 1024px) {
								#wrapper {
									padding-top: 20px;
								}

								#content-page {
									margin-left: auto;
									margin-right: auto;
								}
							}
						</style>
						";


	$output .= "<script> document.createElement('picture');</script>";
	$output .= "<script src=\"" . get_template_directory_uri() . "/includes/gallery/js/picturefill.js\" async></script>";
	$output .= "<script src=\"" . get_template_directory_uri() . "/includes/gallery/js/vertscroll.js\"></script>";

  echo $output;
}
?>
