<?php
/*
SoloFolio custom gallery
Powered by Cycle2 by Mike Alsup
*/

$output .="<div id=\"solofolio-gallery-wrapper\">";
$output .="<ul id=\"solofolio-gallery-thumbs\">";

$galleryTitle = get_post_meta($post->ID, 'solofolio-gallery-title', true);
$galleryText 	= get_post_meta($post->ID, 'solofolio-gallery-text', true);

$i = 0;
if ($galleryTitle || $galleryText) {
	$i++;
}

foreach ($attachment_ids as $id) {
	$attachment = get_post($id);
	$i++;

	$thumb = wp_get_attachment_image_src($id, 'thumbnail');
	$medium = wp_get_attachment_image_src($id, 'medium');

	if (!empty($attachment->post_excerpt)) {
		$caption = wptexturize($attachment->post_excerpt);
	} else {
		$caption = wptexturize($attachment->post_content);
	}

	$output .= "<li class=\"thumb\">
								<a href=\"#" . $i . "\">
									<img src=\"" . $thumb[0] . "\" data-retina=\"" . $medium[0] . "\" alt=\"" .  $caption . "\">
								</a>
							</li>";
}

$output .="</ul>";

$output .="<div id=\"solofolio-gallery-stage\">";

$output .="<div id=\"solofolio-gallery-images\"
								class=\"cycle-slideshow manual\"
								data-cycle-slides=\".solofolio-cycelereact-slide\"
								data-cycle-prev=\".prev\"
								data-cycle-next=\".next\"
								data-cycle-fx=\"fade\"
								data-cycle-log=\"false\"
								data-cycle-manual-speed=\"500\"
								data-cycle-auto-height=false
								data-cycle-caption=\".solofolio-gallery-caption\"
								data-cycle-caption-template=\"{{cycleTitle}}\"";
								if ( $autoplay == "true" ) {
									if (isset( $speed )) {
										$output .= "data-cycle-timeout=". $speed;
									}
								} else {
									$output .= "data-cycle-timeout=0\n";
								}
$output .= ">\n\n";

$i = 0;

if ($galleryTitle || $galleryText) {
	$i++;
	$output .= "
		<div class='solofolio-cycelereact-slide solofolio-gallery-title solofolio-gallery-title'
				 data-cycle-title=''
				 data-cycle-hash='" .  $i . "'>
			<h2>" . $galleryTitle . "</h2>
			<div>" . wpautop($galleryText) . "</div>
		</div>";
}

foreach ($attachment_ids as $id) {
	$attachment = get_post($id);
	$i++;

	$link = wp_get_attachment_url($id);
	$link3 = wp_get_attachment_image_src($id, 'thumbnail');
	$link4 = wp_get_attachment_image_src($id, 'large');
	$link5 = wp_get_attachment_image_src($id, 'xlarge');
	$link6 = wp_get_attachment_image_src($id, 'medium');

	if (!empty($attachment->post_excerpt)) {
		$caption = wptexturize($attachment->post_excerpt);
	} else {
		$caption = wptexturize($attachment->post_content);
	}

	$output .= "
		<div class=\"solofolio-cycelereact-slide solofolio-gallery-image\"
				 data-cycle-title=\"" .  $caption . "\"
				 data-cycle-hash=\"" .  $i . "\">
			<div class=\"solofolio-gallery-fill picturefill-background\"
					 style=\"max-width: ". $link5[1] . "px;\">
				<div data-src=\"" . $link6[0] . "\"></div>
				<div data-src=\"" . $link4[0] . "\" data-media=\"(min-width: 320px)\" style=\"max-width: 900px;\"></div>
				<div data-src=\"" . $link5[0] . "\" data-media=\"(min-width: 920px)\" style=\"max-width: 1800px;\"></div>
				<noscript><img src=\"" . $link6[0] . "\" alt=\"" .  $caption . "\"></noscript>
			</div>
		</div>";
}

$output .= "</div>\n";

$output .="<div class=\"solofolio-gallery-image-nav\">
		<div class=\"solofolio-gallery-nav-right next\"></div>
		<div class=\"solofolio-gallery-nav-left prev\"></div>
	</div>";

$output .= "</div></div>";

$output .= "<div class='solofolio-gallery-sidebar " . get_theme_mod( 'solofolio_gallery_controls', 'buttons') . "'>";

if ($captions != "false"){
  $output .= '<p class="solofolio-gallery-caption"></p>';
}

if (get_theme_mod( 'solofolio_gallery_controls', 'buttons') == 'text') {
	$output .= '<ul class="solofolio-gallery-controls">
        <li><a class="thumbs" href="#" data-cycle-cmd="pause">thumbs</a></li>
        <li><a class="prev" href="#">prev</a></li>
        <li><a class="next" href="#">next</a></li>
        <li><span class="solofolio-gallery-count"></span></li>
      </ul>
    	</div>';
} else {
	$output .= '<div class="solofolio-gallery-controls">
        <a class="thumbs" href="#" data-cycle-cmd="pause"><i class="fa fa-th"></i></a>
        <span class="arrows">
          <a class="prev" href="#"><i class="fa fa-caret-left"></i></a>
          <a class="next" href="#"><i class="fa fa-caret-right"></i></a>
        </span>
      </div>
    	</div>';
}

if ($thumbs == "true"){
$output .= "
<style type=\"text/css\">
#solofolio-gallery-thumbs {
	display: block;
}
.solofolio-gallery-sidebar, #solofolio-gallery-stage {
	display: none;
}
</style>";
}

add_action('wp_footer', 'sl_gallery_js');

if (!function_exists('sl_gallery_js')) {
	function sl_gallery_js() {
		$output = "<script type=\"text/javascript\">window.matchMedia=window.matchMedia||(function(e,f){var c,a=e.documentElement,b=a.firstElementChild||a.firstChild,d=e.createElement(\"body\"),g=e.createElement(\"div\");g.id=\"mq-test-1\";g.style.cssText=\"position:absolute;top:-100em\";d.appendChild(g);return function(h){g.innerHTML='&shy;<style media=\"'+h+'\"> #mq-test-1 { width: 42px; }</style>';a.insertBefore(d,b);c=g.offsetWidth==42;a.removeChild(d);return{matches:c,media:h}}})(document);</script>";
		$output .= "<script src=\"" . get_template_directory_uri() . "/includes/gallery/js/gallery.js\"></script>";
		$output .= "<script src=\"" . get_template_directory_uri() . "/includes/gallery/js/picturefill-background.js\"></script>";
		$output .= "<script src=\"" . get_template_directory_uri() . "/includes/gallery/js/jquery.cycle2.min.js\"></script>";
		$output .= "
		<style type=\"text/css\">
		#header #header-content .solofolio-gallery-sidebar {
			display: block;
		}
		#wrapper {
			padding: 0;
			position: absolute;
			overflow: hidden;
		}
		@media only screen and (min-width: 1025px) {
			#wrapper {
				left: " . get_theme_mod( 'solofolio_layout_spacing', '20' ) ."px;
			}
		}
		@media only screen and (max-width: 1024px) {
			.solofolio-gallery-sidebar {
				padding-right: 20px;
			}
			#solofolio-gallery-stage {
				right: 0;
			}
			#wrapper {
				right: 20px;
				bottom: 20px;
			}
		}
		</style>
		";

	  echo $output;
	}
}

?>
