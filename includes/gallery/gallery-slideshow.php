<?php

$output .= "<script type=\"text/javascript\"
										src=\"" . get_template_directory_uri() . "/includes/gallery/js/galleria-1.3.3.min.js\">
						</script>";

$output .= "<script type=\"text/javascript\"
										src=\"" . get_template_directory_uri() . "/includes/gallery/js/galleria.history.min.js\">
						</script>";

$output .= "<script type=\"text/javascript\"
										src=\"". get_template_directory_uri() . "/includes/gallery/js/galleria.solofolio.js\">
					 </script>";

$output .= "<div class=\"galleria-wrap\"><div class=\"galleria galleria-container notouch\">";
	$i = 0;
	foreach ($attachment_ids as $id) {
		$attachment = get_post($id);

		$link2 = wp_get_attachment_url($id);
		$link3 = wp_get_attachment_image_src($id, 'thumbnail');
		$link4 = wp_get_attachment_image_src($id, 'large');

		$output .= "
		<a href=\"" . $link4[0] . "\" rel=\"" . $link2 . "\">
			<img  class=\"full\" alt=\"" .  wptexturize($attachment->post_excerpt) . "\" src=\"". $link3[0] . "\"/>
		</a>";

		$i++;
	}
$output .= "</div>";

$output .= "<div class=\"galleriabar\">";
	$output .= "<div class=\"galleria-controls\">";
		if ($shownav != "false"){$output.= "<a class=\"prev\" href=\"#\"> <i class=\"fa fa-angle-left\"></i> prev</a>";}
		if ($showcounter != "false"){$output.= "<div class=\"counter\">
			<span class=\"index\"></span> of
			<span class=\"total\"></span>
		</div>";}
		if ($shownav != "false"){$output.= "<a class=\"next\" href=\"#\">next <i class=\"fa fa-angle-right\"></i></a>";}
		if ($fullscreen != "false"){$output.= "<a class=\"fullscreen\" href=\"#\" title=\"Fullscreen\"><i class=\"fa fa-expand\"></i></a>";}
		if ($showplay != "false"){$output.= "<a class=\"play\" href=\"#\" title=\"Slideshow\"><i class=\"fa fa-play\"></i></a>";}
		if ($showthumbnails != "false"){$output.= "<a class=\"toggle\" href=\"#\" title=\"Thumbnails\"><i class=\"fa fa-th\"></i></a>";}
	$output .= "</div>";
	if ($captions != "false"){$output.= "<div class=\"galleria-info\"></div>";}
$output .= "</div></div>";

add_action('wp_footer', 'solofolio_slideshow_footer');

function solofolio_slideshow_footer() {
  global $solofolio_autoplay;
  global $solofolio_showthumbnails;
  global $solofolio_showplay;

	$output = "<link rel=\"stylesheet\" href=\"" . get_template_directory_uri() . "/includes/gallery/js/galleria.solofolio.css\" type=\"text/css\" media=\"screen\" />";

  $output .= "
  <script type=\"text/javascript\">
	  Galleria.run('.galleria', {";
	 		if ($solofolio_autoplay == "true"){ $output .= "autoplay: true,";}
	$output.="
		height: .667,
		swipe: true,
		responsive: true,
		maxScaleRatio: 1,
		trueFullscreen: true
	});

	Galleria.ready(function() {
		var gallery = this, data;
		this.addElement('exit').appendChild('container','exit');
		var btn = this.$('exit').hide().text('Close').click(function(e) {
			gallery.exitFullscreen();
		});
		this.bind('fullscreen_enter', function() {
			btn.show();
		});
		this.bind('fullscreen_exit', function() {
			btn.hide();
		});
		$('.prev').click(function() {
			gallery.prev();
		});
		$('.next').click(function() {
			gallery.next();
		});
		$('.fullscreen').click(function() {
			gallery.toggleFullscreen();
		});
		$('.play').click(function() {
			gallery.playToggle();
			$('.play').toggleClass(\"playing\");
		});
		$('.toggle').click(function() {
			gallery.$('thumblink').click();
		});
		this.bind('image', function(e) {
			data = e.galleriaData;
			$('.galleria-info').html('<div class=\"galleria-info-description\">'+data.description+'</div>' );
		});
		this.bind('image', function(e) {
			data = e.index;
			$('.index').html(data + 1);
		});
		this.bind('image', function(e) {
			data = e.index;
			$('.index').html(data + 1);
		});
		$('.total').append(this.getDataLength());
	});
	</script>
	<style>";
	if ($solofolio_showthumbnails == "false"){$output.= ".galleria-thumblink {display:none}";};
	if ($solofolio_showplay == "false"){$output .= ".galleria-play {display:none}";};
	$output.="</style>";

  echo $output;
}
?>
