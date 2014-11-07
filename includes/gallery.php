<?php

add_filter( 'post_gallery', 'solofolio_gallery_shortcode', 10, 2 );
function solofolio_gallery_shortcode($output, $attr) {
	global $post, $wp_locale;

	extract(shortcode_atts(array(
		'autoplay' => '',
		'captions' => '',
		'id'         => $post->ID,
		'showcounter'    => '',
		'shownav'    => '',
		'showplay'    => '',
		'showthumbnails'    => '',
		'speed'    => '',
		'thumbs'    => '',
		'transition'    => '',
		'type'    => '',
	), $attr));

  $attachment_ids = explode(",", $attr['ids']);

	$id = intval($id);

	if ( wp_is_mobile() ||
			 is_home() ||
			 is_single() ||
			 is_page_template( 'story.php' ) ||
			 preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])
		 ) {
		$type = "vert-scroll";
	}

	switch ($type) {
		case "vert-scroll":
		case "react":
			include("gallery/gallery-vertscroll.php");
			break;
		default:
			include("gallery/gallery-cyclereact.php");
			break;
	}

	return $output;
}
?>
