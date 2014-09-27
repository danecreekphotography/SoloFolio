<?php
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
  WP_Filesystem();
  global $wp_filesystem;

  $layout_spacing           = get_theme_mod('solofolio_layout_spacing', '20');
  $header_width             = get_theme_mod('solofolio_header_width', '200');
  $entry_width              = get_theme_mod('solofolio_entry_width', '900');
  $is_heights               = get_theme_mod('solofolio_layout_mode') == 'heights';
  $is_horizon               = get_theme_mod('solofolio_layout_mode') == 'horizon';
  $center_blog              = get_theme_mod('solofolio_blog_center_layout');
  $background_color         = get_theme_mod('solofolio_background_color');
  $header_background_color  = get_theme_mod('solofolio_header_background_color');

  $styles = "<style>";

  $styles .= "
  @import url(http://fonts.googleapis.com/css?family=".get_theme_mod('solofolio_font_body').");
  @import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);
  ";

  $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/base.css");

  if ($is_horizon) {
    $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/horizon.css");
  } elseif ($is_heights) {
    $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/heights.css");
  }

  $styles .= "
  body {
    background-color: ". $background_color . ";
    color: " . get_theme_mod('solofolio_body_font_color') . ";
    font-size: " . get_theme_mod('solofolio_body_font_size') .";
    font-family: '" . str_replace("+"," ", get_theme_mod('solofolio_font_body')) . "';
  }

  #logo-img {
    width: " . get_theme_mod('solofolio_logo_width') . "px;
  }

  #solofolio-cyclereact-thumbs .thumb {
    border-color: ". $background_color . ";
  }

  .galleria-container .galleria-stage, .galleria-container .galleria-thumbnails-container {
    background-color: " . $background_color . ";
  }

  a:link, a:visited, #header-location, #sidebar-footer {
    color: " . get_theme_mod('solofolio_body_link_color') . ";
  }

  a:hover, a:active {
    color: " . get_theme_mod('solofolio_body_link_color_hover') . ";
  }

  #header {
    background-color: ". $header_background_color . ";
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

  .post-date, .post-cat {
    color: " . get_theme_mod('solofolio_blog_entry_byline_color') . ";
  }

  .wp-caption .wp-caption-text, .solofolio-cyclereact-caption {
    color: " . get_theme_mod('solofolio_body_caption_color') . ";
  }

  .solofolio-cyclereact-controls a {
    color: " . get_theme_mod('solofolio_navigation_link_color') . ";
  }

  .solofolio-cyclereact-controls a:hover {
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
    background-color: " . colorBrightness($background_color, -0.9) . ";
  }

  .galleria-info {
      color: " . get_theme_mod('solofolio_body_caption_color') . ";
  }
  ";

  if ($is_horizon) {
    $styles .="
      .solofolio-cyclereact-sidebar.buttons a {
        border: 1px solid " . colorBrightness($background_color, -0.9) . ";
        background-color: " . colorBrightness($background_color, -0.9) . ";
      }";
  } elseif ($is_heights) {
    $styles .="
      #header {
        width: " . $header_width . "px;
      }

      .solofolio-cyclereact-sidebar.buttons a {
        border: 1px solid " . colorBrightness($header_background_color, -0.9) . ";
        background-color: " . colorBrightness($header_background_color, -0.9) . ";
      }";
  }

  $styles .= "
  .galleria-image-nav-left, .solofolio-cyclereact-nav-left {
    cursor: url(\"" . get_template_directory_uri() . "/img/prev.dark.cur\"), move;
  }

  .galleria-image-nav-right, .solofolio-cyclereact-nav-right {
    cursor: url(\"" . get_template_directory_uri() . "/img/next.dark.cur\"), move;
  }";

  if ($is_horizon) {
    $styles .= "
      #wrapper {
        bottom: " . $layout_spacing . "px;
        top: " . ($layout_spacing + 45) . "px;
        right: " . $layout_spacing . "px;
      }
      #solofolio-cyclereact-stage {
        right: " . ($header_width + 20) . "px;
      }
      #solofolio-cyclereact-thumbs {
        top: 45px;
        padding-top: " . $layout_spacing . "px;
        padding-right: " . ($layout_spacing - 20) . "px;
        padding-bottom: " . $layout_spacing . "px;
      }
      .solofolio-cyclereact-title {
        padding-top: " . ($layout_spacing + 45) . "px;
        padding-right: " . ($layout_spacing - 20) . "px;
        padding-bottom: " . $layout_spacing . "px;
      }
      #header-inner {
        padding-left: " . $layout_spacing . "px;
        padding-right: " . $layout_spacing . "px;
      }
      .solofolio-cyclereact-sidebar {
        top: " . ($layout_spacing + 45) . "px;
        right: " . $layout_spacing . "px;
      }
      @media (max-width: 1024px) {
        #solofolio-cyclereact-stage, #solofolio-cyclereact-thumbs {
          left: " . ($header_width + 20) . "px;
        }
      }
      ";
  } elseif ($is_heights) {
    $styles .= "
      #solofolio-cyclereact-stage, #solofolio-cyclereact-thumbs, .solofolio-cyclereact-title {
        left: " . $header_width . "px !important;
      }
      @media (min-width: 1025px) {
        #wrapper {
          bottom: " . $layout_spacing . "px;
          left: " . $layout_spacing . "px;
          right: " . $layout_spacing . "px;
          top: " . $layout_spacing . "px;
        }

        .solofolio-cyclereact-sidebar {
          bottom: " . $layout_spacing . "px;
        }

        #solofolio-cyclereact-thumbs, .solofolio-cyclereact-title {
          padding-top: " . $layout_spacing . "px;
          padding-right: " . ($layout_spacing - 20) . "px;
          padding-bottom: " . $layout_spacing . "px;
        }

        #header-inner {
          left: " . $layout_spacing . "px;
          top: " . $layout_spacing . "px;
        }
      }

    ";
  }

  if ($is_heights && !$center_blog) {
    $styles .= "
      #wrapper {
        left: " . ($header_width + $layout_spacing) . "px;
        width: auto;
      }";
  }

  if ($is_heights && $center_blog) {
    $styles .= "
      #wrapper {
        left: " . ($header_width + $layout_spacing) . "px;
        width: auto;
      }

      @media (min-width: " . ($header_width + $entry_width + 20) . "px) {
        #wrapper {
          max-width: 100%;
          }

        #post #outerWrap {
          margin: 0 auto;
          position: relative;
          max-width: " . ($header_width + $entry_width + 20) . "px;
        }

        #post #header {
          left: auto;
        }
      }";
  }

  $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/breakpoints.css");

  $styles .= "</style>"; 

  $styles = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $styles);
  $styles = str_replace(': ', ':', $styles);
  $styles = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $styles);

  return $styles;
}

?>
