<?php

// Deactivate WordPress gallery, activate custom gallery
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'solofolio_gallery_shortcode');

function solofolio_gallery_shortcode($attr) {
	global $post, $wp_locale;

	static $instance = 0;
	$instance++;

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'autoplay' => '',
		'captions' => '',
		'captiontag' => 'dd',
		'columns'    => 3,
		'fullscreen'    => '',
		'height'    => '',
		'icontag'    => 'dt',
		'id'         => $post->ID,
		'include'    => '',
		'itemtag'    => 'dl',
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'showcounter'    => '',
		'shownav'    => '',
		'showplay'    => '',
		'showthumbnails'    => '',
		'size'       => 'full-size',
		'speed'    => '',
		'thumbs'    => '',
		'transition'    => '',
		'type'    => '',
		'width'    => '',
		'exclude'    => ''
	), $attr));

	$post_content = $post->post_content;
    preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
    $attachment_ids = explode(",", $ids[1]);

	$GLOBALS['solofolio_autoplay'] = $autoplay;
	$GLOBALS['solofolio_showthumbnails'] = $showthumbnails;
	$GLOBALS['solofolio_showplay'] = $showplay;

	$id = intval($id);
	if ( 'RAND' == $order ) {
		$orderby = 'none';
	}

	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);

	$post_content = $post->post_content;
    preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
    $attachment_ids = explode(",", $ids[1]);

	$selector = "solofolio";

	if (!function_exists('detect_mobile')) {
		function detect_mobile()
		{
			$_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
			$mobile_browser = '0';

			if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
				$mobile_browser++;

			if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
				$mobile_browser++;

			if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
				$mobile_browser++;

			if(isset($_SERVER['HTTP_PROFILE']))
				$mobile_browser++;

			$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
			$mobile_agents = array(
								'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
								'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
								'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
								'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
								'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
								'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
								'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
								'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
								'wapr','webc','winw','winw','xda','xda-'
								);

			if(in_array($mobile_ua, $mobile_agents))
				$mobile_browser++;

			if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)
				$mobile_browser++;

			if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)
				$mobile_browser=0;

			if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)
				$mobile_browser++;

			if($mobile_browser>0)
				return true;
			else
				return false;
		}
	}

	$mobile = detect_mobile();

	if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])) { $type = "vert-scroll"; }

	if ($mobile === true) { $type = "vert-scroll";}
	if ( is_home() || is_single()) { $type = "vert-scroll";}

	switch ($type) {
		case "vert-scroll":
			include("gallery/gallery-vertscroll.php");
			break;
		case "react":
			include("gallery/gallery-vertscroll.php");
			break;
		case "cycle-react":
			include("gallery/gallery-cyclereact.php");
			break;
		default:
			include("gallery/gallery-cyclereact.php");
			break;
	}

	return $output;
}
?>
