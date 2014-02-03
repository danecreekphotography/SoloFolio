<?php
$output .= "
<script type=\"text/javascript\" charset=\"utf-8\">
	$( document ).ready( function(){
    		setMax();
    		$( window ).bind(\"resize\", setMax );
    		function setMax() {
    			$(\".sl-sidescroll-container img\").css(\"maxWidth\",
    				($(\"#wrapper\").innerWidth()));
    		}
});
</script>";

$output .="<table cellspacing=0 class=\"sl-sidescroll\"><tbody><tr>";

$i = 0;
foreach ($attachment_ids as $id) {
	$attachment = get_post($id);

	$link2 = wp_get_attachment_url($id);
	$link3 = wp_get_attachment_image_src($id, 'thumbnail');
	$link4 = wp_get_attachment_image_src($id, 'large');

	$output .= "\n\n
		<td><div class=\"sl-sidescroll-container\">
		<img src=\"" . $link4[0] . "\"
			   data-retina=\"" . $link2 . "\"
				 alt=\"open image\"
				 class=\"full\"
				 id=\"" . $i . "\"/
				 style=\"max-width:" . $link4[1] . "px;
				 				 max-height:" . $link4[2] . "px \"/>";

	if ($captions != "false"){
		$output .="<p>" .  wptexturize($attachment->post_excerpt) . "</p> ";
	}

	$output .= "</div></td>";

	$i++;

} // end foreach

$output .="
</tr></table>

<style type=\"text/css\">
#wrapper {
	overflow-x: scroll;
}
</style>";
?>
