<?php

$output .="<div id=\"solofolio-cyclereact-wrap\">";

$output .="<ul id=\"solofolio-cyclereact-thumbs\">";

$i = 0;
foreach ($attachment_ids as $id) {
	$attachment = get_post($id);
	$i++;

	$thumb = wp_get_attachment_image_src($id, 'thumbnail');
	$medium = wp_get_attachment_image_src($id, 'medium');

	$output .= "<li class=\"thumb\">
								<a href=\"#" . $i . "\">
									<img src=\"" . $thumb[0] . "\" data-retina=\"" . $medium[0] . "\" alt=\"" .  wptexturize($attachment->post_excerpt) . "\">
								</a>
							</li>";
}

$output .="</ul>";

$output .="<div id=\"solofolio-cyclereact-stage\">";

$output .="<div id=\"solofolio-cyclereact-images\"
								class=\"cycle-slideshow manual\"
								data-cycle-slides=\".solofolio-cycelereact-slide\"
								data-cycle-prev=\".prev\"
								data-cycle-next=\".next\"
								data-cycle-fx=\"fade\"
								data-cycle-log=\"false\"
								data-cycle-manual-speed=\"300\"
								data-cycle-caption=\".solofolio-cyclereact-caption\"
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
foreach ($attachment_ids as $id) {
	$attachment = get_post($id);
	$i++;

	$link = wp_get_attachment_url($id);
	$link2 = wp_get_attachment_url($id);
	$link3 = wp_get_attachment_image_src($id, 'thumbnail');
	$link4 = wp_get_attachment_image_src($id, 'large');
	$link5 = wp_get_attachment_image_src($id, 'xlarge');
	$link6 = wp_get_attachment_image_src($id, 'medium');

	$output .= "
		<div class=\"solofolio-cycelereact-slide\"
				 data-cycle-title=\"" .  wptexturize($attachment->post_excerpt) . "\"
				 data-cycle-hash=\"" .  $i . "\">
			<div class=\"solofolio-cyclereact-fill picturefill-background\">
				<div data-src=\"" . $link6[0] . "\"></div>
				<div data-src=\"" . $link4[0] . "\" data-media=\"(min-width: 320px)\" style=\"max-width: 900px;\"></div>
				<div data-src=\"" . $link5[0] . "\" data-media=\"(min-width: 920px)\" style=\"max-width: 1800px;\"></div>
				<noscript><img src=\"" . $link6[0] . "\" alt=\"" .  wptexturize($attachment->post_excerpt) . "\"></noscript>
			</div>
		</div>";
}

$output .= "</div>\n";

$output .="<div class=\"solofolio-cyclereact-image-nav\">
		<div class=\"solofolio-cyclereact-nav-right next\"></div>
		<div class=\"solofolio-cyclereact-nav-left prev\"></div>
	</div>";

$output .= "</div>";

$output .= "</div>";

$output .= '<div class="solofolio-cyclereact-sidebar">
      <p class="solofolio-cyclereact-caption"></p>
      <span class="solofolio-cyclereact-controls">
        <a class="thumbs" href="#">
          <i class="fa fa-th"></i>
          <i class="fa fa-expand"></i>
        </a>
        <span class="arrows">
          <a class="prev" href="#"><i class="fa fa-angle-left"></i></a>
          <a class="next" href="#"><i class="fa fa-angle-right"></i></a>
        </span>
      </span>
    	</div>';

add_action('wp_footer', 'sl_cyclereact_js');

function sl_cyclereact_js() {
	$output = "<script type=\"text/javascript\">window.matchMedia=window.matchMedia||(function(e,f){var c,a=e.documentElement,b=a.firstElementChild||a.firstChild,d=e.createElement(\"body\"),g=e.createElement(\"div\");g.id=\"mq-test-1\";g.style.cssText=\"position:absolute;top:-100em\";d.appendChild(g);return function(h){g.innerHTML='&shy;<style media=\"'+h+'\"> #mq-test-1 { width: 42px; }</style>';a.insertBefore(d,b);c=g.offsetWidth==42;a.removeChild(d);return{matches:c,media:h}}})(document);</script>";
	$output .= "<script src=\"" . get_template_directory_uri() . "/includes/gallery/js/cyclereact.js\"></script>";
	$output .= "<script src=\"" . get_template_directory_uri() . "/includes/gallery/js/picturefill-background.js\"></script>";
	$output .= "<script src=\"" . get_template_directory_uri() . "/includes/gallery/js/jquery.cycle2.min.js\"></script>";
	$output .= "
	<style type=\"text/css\">
	#header #header-content .solofolio-cyclereact-sidebar {
		display: block;
	}
	#wrapper {
		bottom: 20px;
		left: 20px;
	}
	</style>
	";

  echo $output;
}

?>
