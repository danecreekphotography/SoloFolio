<?php
add_action( 'customize_save_after', 'solofolio_css_cache' );

function solofolio_css_cache() {
  $data = solofolio_css();
  $uploads = wp_upload_dir();
  file_put_contents($uploads['basedir'] . '/solofolio.css', $data);
}

// http://lab.clearpixel.com.au/2008/06/darken-or-lighten-colours-dynamically-using-php/
function colorBrightness($hex, $percent) {
  $hash = '';
  if (stristr($hex,'#')) {
    $hex = str_replace('#','',$hex);
    $hash = '#';
  }
  $rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
  for ($i=0; $i<3; $i++) {
    if ($percent > 0) {
      $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
    } else {
      $positivePercent = $percent - ($percent*2);
      $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
    }
    if ($rgb[$i] > 255) {
      $rgb[$i] = 255;
    }
  }
  $hex = '';
  for($i=0; $i < 3; $i++) {
    $hexDigit = dechex($rgb[$i]);
    if(strlen($hexDigit) == 1) {
    $hexDigit = "0" . $hexDigit;
    }
    $hex .= $hexDigit;
  }
  return $hash.$hex;
}

function solofolio_css() {
  $styles .= file_get_contents(get_bloginfo('template_url') . "/css/base.css");

  $styles .= "
  #header {
    width: " . get_theme_mod( 'solofolio_header_width', '200') . "px;
  }\n";

  if (get_theme_mod('solofolio_logo') == '') {
    $styles .= "
    #logo-noimg { display: block; }
    #logo-img   { display: none; }\n";
  } else {
    $styles .= "
    #logo-noimg { display: none; }
    #logo-img   { display: block;}\n";
  }

  $styles .= "
  body {
    background-color: ". get_theme_mod('solofolio_background_color') . ";
    color: " . get_theme_mod('solofolio_body_font_color') . ";
    font-size: " . get_theme_mod('solofolio_body_font_size') .";
  }

  #solofolio-cyclereact-thumbs .thumb {
    border: 10px solid ". get_theme_mod('solofolio_background_color') . ";
  }

  #header {
    background-color: " . get_theme_mod('solofolio_background_color') . ";
  }

  .galleria-container .galleria-stage, .galleria-container .galleria-thumbnails-container {
    background-color: " . get_theme_mod('solofolio_background_color') . ";
  }

  a:link, a:visited {
    color: " . get_theme_mod('solofolio_body_link_color') . ";
  }

  a:hover, a:active {
    color: " . get_theme_mod('solofolio_body_link_color_hover') . ";
  }

  #header-content li a {
    font-size: " . get_theme_mod('solofolio_navigation_font_size') . ";
  }

  #header-content h3 {
    color: " . get_theme_mod('solofolio_navigation_header_color') . ";
    font-size: " . get_theme_mod('solofolio_navigation_header_font_size') . ";
  }

  #header-content a:link, #header-content a:visited {
    color: " . get_theme_mod('solofolio_navigation_link_color') . ";
  }

  #header-content a:hover, #header-content a:active {
    color: " . get_theme_mod('solofolio_navigation_link_color_hover') . ";
  }

  h2.post-title {
    font-size: " . get_theme_mod('solofolio_blog_entry_title_size') . ";
  }

  h2.post-title, h2.post-title a {
    color: " . get_theme_mod('solofolio_blog_entry_title_color') . ";
  }

  .post-title a:hover {
    color: " . get_theme_mod('solofolio_blog_entry_title_color_hover') . ";
  }

  .date, .post-cat {
    color: " . get_theme_mod('solofolio_blog_entry_byline_color') . ";
  }

  .wp-caption p.wp-caption-text, .solofolio-caption {
    color: " . get_theme_mod('solofolio_body_caption_color') . ";
  }

  .solofolio-cyclereact-controls i {
    color: " . get_theme_mod('solofolio_navigation_link_color') . ";
  }

  .solofolio-cyclereact-controls a:hover i {
    color: " . get_theme_mod('solofolio_navigation_link_color_hover') . ";
  }

  #sidebar-footer p {
    color: " . get_theme_mod('solofolio_navigation_link_color') . ";
  }

  /* Highlight current page item */

  #header #header-content .current_page_item a, #header #header-content .current_page_parent a {
    color: " . get_theme_mod('solofolio_navigation_link_color_hover') . ";
    }

  #footer ul li a:hover {
    color: " . get_theme_mod('solofolio_body_link_color_hover') . ";
  }

  input, textarea {
    color: " . get_theme_mod('solofolio_body_link_color') . ";
    background-color: " . colorBrightness(get_theme_mod('solofolio_background_color'), -0.9) . ";
  }

  .solofolio-cyclereact-controls a {
    color: " . get_theme_mod('solofolio_body_font_color') . ";
    border: 1px solid " . colorBrightness(get_theme_mod('solofolio_background_color'), -0.9) . ";
    background-color: " . colorBrightness(get_theme_mod('solofolio_background_color'), -0.9) . ";
  }

  /* Gallery Styles */

  .galleria-info {
    color: " . get_theme_mod('solofolio_body_caption_color') . ";
  }

  .sl-sidescroll-container {
    padding-right: " . get_theme_mod('solofolio_gallery_sidescroll_padding') . "px;
  }

    .sl-sidescroll-container:last-child {
      padding-right: 0;
      }
  ";

  if (get_theme_mod('solofolio_gallery_cursor_color') == 'light') {
    $styles .= "
    .galleria-image-nav-left, .solofolio-cyclereact-nav-left {
      cursor: url(\"" . get_bloginfo('template_url') . "/img/prev.light.cur\"), move;

    }
    .galleria-image-nav-right, .solofolio-cyclereact-nav-right {
      cursor: url(\"" . get_bloginfo('template_url') . "/img/next.light.cur\"), move;
      }";
  } else {
    $styles .= "
    .galleria-image-nav-left, .solofolio-cyclereact-nav-left {
      cursor: url(\"" . get_bloginfo('template_url') . "/img/prev.dark.cur\"), move;
    }

    .galleria-image-nav-right, .solofolio-cyclereact-nav-right {
      cursor: url(\"" . get_bloginfo('template_url') . "/img/next.dark.cur\"), move;
    }";
  }

  if (get_theme_mod('solofolio_gallery_icon_color') == 'dark') {
    $styles .= "
    .galleria-controls .galleria-counter, .galleria-controls a {
      color: #000000;
    }

    .galleria-thumbnails-container {
      background-color: #ffffff;
    }";
  }

  $styles .= "
  #wrapper {
    left: " . (get_theme_mod( 'solofolio_header_width', '200' ) + 60) . "px;
    width: auto;
  }

  @media (min-width: " . (get_theme_mod( 'solofolio_header_width', '200' ) + 900 + 50) . "px) {
    #wrapper {
      max-width: 100%;
      }

    #post #outerWrap {
      margin: 0 auto;
      position: relative;
      max-width: " . (get_theme_mod( 'solofolio_header_width', '200' ) + 920 + 40) . "px;
    }

    #post #header {
      left: auto;
    }
  }";

  $styles .= file_get_contents(get_bloginfo('template_url') . "/css/breakpoints.css");

  $styles = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $styles);
  $styles = str_replace(': ', ':', $styles);
  $styles = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $styles);

  return $styles;
}

?>
