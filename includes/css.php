<?php
add_action( 'customize_save_after', 'solofolio_css_cache' );

function solofolio_css_cache() {
  if ( ! WP_Filesystem($creds) ) {
    request_filesystem_credentials($url, '', true, false, null);
    return;
  }

  WP_Filesystem();
  global $wp_filesystem;

  set_theme_mod( 'solofolio_css_version', time() );

  $data = solofolio_css();
  $uploads = wp_upload_dir();
  $wp_filesystem->put_contents($uploads['basedir'] . '/solofolio.css', $data);
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
  if ( ! WP_Filesystem($creds) ) {
    request_filesystem_credentials($url, '', true, false, null);
    return;
  }

  WP_Filesystem();
  global $wp_filesystem;

  $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/base.css");

  if (get_theme_mod('solofolio_layout_mode') == 'horizon') {
    $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/horizon.css");
  } elseif (get_theme_mod('solofolio_layout_mode') == 'heights') {
    $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/heights.css");
  }

  $styles .= "
  body {
    background-color: ". get_theme_mod('solofolio_background_color') . ";
    color: " . get_theme_mod('solofolio_body_font_color') . ";
    font-size: " . get_theme_mod('solofolio_body_font_size') .";
  }

  #logo-img {
    width: " . get_theme_mod('solofolio_logo_width') . "px;
  }

  #solofolio-cyclereact-thumbs .thumb {
    border-color: ". get_theme_mod('solofolio_background_color') . ";
  }

  .galleria-container .galleria-stage, .galleria-container .galleria-thumbnails-container {
    background-color: " . get_theme_mod('solofolio_background_color') . ";
  }

  a:link, a:visited, #header-location, #sidebar-footer {
    color: " . get_theme_mod('solofolio_body_link_color') . ";
  }

  a:hover, a:active {
    color: " . get_theme_mod('solofolio_body_link_color_hover') . ";
  }

  #header {
    background-color: ". get_theme_mod('solofolio_header_background_color') . ";
  }

  #header-content li a {
    font-size: " . get_theme_mod('solofolio_navigation_font_size') . ";
    line-height: " . get_theme_mod('solofolio_navigation_font_size') . ";
  }

  #header-content h3 {
    color: " . get_theme_mod('solofolio_navigation_header_color') . ";
    font-size: " . get_theme_mod('solofolio_navigation_header_font_size') . ";
    line-height: " . get_theme_mod('solofolio_navigation_font_size') . ";
  }

  #header-content ul a:link, #header-content ul a:visited {
    color: " . get_theme_mod('solofolio_navigation_link_color') . ";
  }

  #header-content ul a:hover, #header-content ul a:active {
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

  .wp-caption .wp-caption-text, .solofolio-cyclereact-caption {
    color: " . get_theme_mod('solofolio_body_caption_color') . ";
  }

  .solofolio-cyclereact-controls i {
    color: " . get_theme_mod('solofolio_navigation_link_color') . ";
  }

  .solofolio-cyclereact-controls a:hover i {
    color: " . get_theme_mod('solofolio_navigation_link_color_hover') . ";
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

  .galleria-info {
      color: " . get_theme_mod('solofolio_body_caption_color') . ";
  }

  .solofolio-cyclereact-controls a {
    color: " . get_theme_mod('solofolio_body_font_color') . ";
  }
  ";

  if (get_theme_mod('solofolio_layout_mode') == 'horizon') {
    $styles .="
      .solofolio-cyclereact-controls a {
        border: 1px solid " . colorBrightness(get_theme_mod('solofolio_background_color'), -0.9) . ";
        background-color: " . colorBrightness(get_theme_mod('solofolio_background_color'), -0.9) . ";
      }";
  } elseif (get_theme_mod('solofolio_layout_mode') == 'heights') {
    $styles .="
      #header {
        width: " . get_theme_mod( 'solofolio_header_width', '200') . "px;
      }

      .solofolio-cyclereact-controls a {
        border: 1px solid " . colorBrightness(get_theme_mod('solofolio_header_background_color'), -0.9) . ";
        background-color: " . colorBrightness(get_theme_mod('solofolio_header_background_color'), -0.9) . ";
      }";
  }

  $styles .= "
  .galleria-image-nav-left, .solofolio-cyclereact-nav-left {
    cursor: url(\"" . get_template_directory_uri() . "/img/prev.dark.cur\"), move;
  }

  .galleria-image-nav-right, .solofolio-cyclereact-nav-right {
    cursor: url(\"" . get_template_directory_uri() . "/img/next.dark.cur\"), move;
  }";

  if (get_theme_mod('solofolio_layout_mode') == 'horizon') {
    $styles .= "
      #solofolio-cyclereact-stage {
        right: " . (get_theme_mod( 'solofolio_header_width', '200' ) + 40) . "px;
      }";
  } elseif (get_theme_mod('solofolio_layout_mode') == 'heights') {
    $styles .= "
      #solofolio-cyclereact-stage, #solofolio-cyclereact-thumbs {
        left: " . get_theme_mod( 'solofolio_header_width', '200' ) . "px;
      }";
  }

  if (get_theme_mod('solofolio_layout_mode') == 'heights') {
    $styles .= "
      #wrapper {
        left: " . (get_theme_mod( 'solofolio_header_width', '200' ) + 20) . "px;
        width: auto;
      }

      @media (min-width: " . (get_theme_mod( 'solofolio_header_width', '200' ) + get_theme_mod( 'solofolio_entry_width', '900' ) + 20) . "px) {
        #wrapper {
          max-width: 100%;
          }

        #post #outerWrap {
          margin: 0 auto;
          position: relative;
          max-width: " . (get_theme_mod( 'solofolio_header_width', '200' ) + get_theme_mod( 'solofolio_entry_width', '900' ) + 20) . "px;
        }

        #post #header {
          left: auto;
        }
      }";
  }

  $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/breakpoints.css");

  $styles = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $styles);
  $styles = str_replace(': ', ':', $styles);
  $styles = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $styles);

  return $styles;
}

?>
