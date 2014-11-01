<?php
require_once(ABSPATH . 'wp-admin/includes/file.php');

function solofolio_css() {
  WP_Filesystem();
  global $wp_filesystem;

  $layout_spacing           = get_theme_mod('solofolio_layout_spacing', '20');
  $header_width             = get_theme_mod('solofolio_header_width', '280');
  $entry_width              = get_theme_mod('solofolio_entry_width', '900');
  $entry_text_width         = get_theme_mod('solofolio_entry_text_width', '600');
  $button_size              = get_theme_mod('solofolio_gallery_controls_size', '30');
  $is_heights               = get_theme_mod('solofolio_layout_mode') == 'heights';
  $is_horizon               = get_theme_mod('solofolio_layout_mode') == 'horizon';
  $center_blog              = get_theme_mod('solofolio_blog_center_layout');
  $background_color         = get_theme_mod('solofolio_background_color');
  $header_background_color  = get_theme_mod('solofolio_header_background_color');

  $styles = "<!-- Powered by SoloFolio v" . constant('SOLOFOLIO_VERSION') . " - http://solofol.io - ";
  $datestamp = date(' Y-m-d H:i:s');
  $styles .= "CSS generated at: " . $datestamp . " -->";

  $styles .= "<style>";

  $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/base.css");
  $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/breakpoints.css");

  if ($is_horizon) {
    $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/horizon.css");
  } elseif ($is_heights) {
    $styles .= $wp_filesystem->get_contents(get_template_directory_uri() . "/css/heights.css");
  }

  $styles .= "
  html { font-size: " . get_theme_mod('solofolio_body_font_size') ."px }
  body {
    background-color: ". $background_color . ";
    color: " . get_theme_mod('solofolio_body_font_color') . ";
    font-family: '" . str_replace("+"," ", get_theme_mod('solofolio_font_body')) . "';
  }
  h1, h2, h3, h4, h5, h6 { color: " . get_theme_mod('solofolio_blog_entry_title_color') . " }
  a:link, a:visited, .header-location {
    color: " . get_theme_mod('solofolio_body_link_color') . ";
  }

  a:hover, a:active, .content-parent .children li:hover a h3 {
    color: " . get_theme_mod('solofolio_body_link_color_hover') . ";
  }

  .site-title a {
    font-family: '" . str_replace("+"," ", get_theme_mod('solofolio_font_logo')) . "';
    color: " . get_theme_mod('solofolio_logo_color') . ";
  }

  .site-title a:hover {
     color: " . get_theme_mod('solofolio_logo_color_hover') . ";
  }

  .logo-img img {
    width: " . get_theme_mod('solofolio_logo_width') . "px;
  }

  .solofolio-cyclereact-thumbs .thumb {
    border-color: ". $background_color . ";
  }

  .solofolio-cyclereact-title,
  .footer {
    background-color: " . $background_color . ";
  }

  .header {
    background-color: ". $header_background_color . ";
  }

  .header-meta {
    font-size: " . get_theme_mod('solofolio_header_meta_font_size') . "px;
  }

  .header-content li a {
    font-size: " . get_theme_mod('solofolio_navigation_font_size') . "px;
    line-height: " . get_theme_mod('solofolio_navigation_font_size') . "px;
  }

  .header-content h3 {
    color: " . get_theme_mod('solofolio_navigation_header_color') . ";
    font-size: " . get_theme_mod('solofolio_navigation_header_font_size') . "px;
  }

  .header-content ul a:link, .header-content ul a:visited, .menu-icon {
    color: " . get_theme_mod('solofolio_navigation_link_color') . ";
  }

  .header-content ul a:hover, .header-content ul a:active {
    color: " . get_theme_mod('solofolio_navigation_link_color_hover') . ";
  }

  h2.post-title {
    font-size: " . get_theme_mod('solofolio_blog_entry_title_size') . "px;
  }

  h2.post-title, h2.post-title a {
    color: " . get_theme_mod('solofolio_blog_entry_title_color') . ";
  }

  .post-title a:hover {
    color: " . get_theme_mod('solofolio_blog_entry_title_color_hover') . ";
  }

  .post-byline {
    color: " . get_theme_mod('solofolio_blog_entry_byline_color') . ";
  }

  .wp-caption .wp-caption-text, .solofolio-cyclereact-caption {
    color: " . get_theme_mod('solofolio_body_caption_color') . ";
  }

  .solofolio-cyclereact-controls a {
    color: " . get_theme_mod('solofolio_navigation_link_color') . ";
  }

  .solofolio-cyclereact-controls a:hover, button:hover, .form-submit input:hover {
    color: " . get_theme_mod('solofolio_navigation_link_color_hover') . ";
  }

  .header .header-content .current_page_item a, .header .header-content .current_page_parent a {
    color: " . get_theme_mod('solofolio_navigation_link_color_hover') . ";
  }

  .solofolio-cyclereact-sidebar.buttons a:hover,
  input:focus,
  textarea:focus,
  button:focus,
  button:hover {
    border-color: " . get_theme_mod('solofolio_navigation_link_color_hover') . ";
  }

  input, textarea, button {
    border: 1px solid " . get_theme_mod('solofolio_navigation_link_color') . ";
    color: " . get_theme_mod('solofolio_body_font_color') . ";
  }

  .comments {
    max-width: " . $entry_width . "px;
  }

  .comments h6 {
    color: " . get_theme_mod('solofolio_blog_entry_byline_color') . ";
  }

  .solofolio-cyclereact-sidebar {
    max-width: " . ($header_width - $layout_spacing) . "px;
  }

  .solofolio-cyclereact-sidebar.buttons a {
    height: " . $button_size . "px;
    font-size: " . ($button_size * .55) . "px;
    line-height: " . $button_size . "px;
    width: " . $button_size . "px;
  }

  .solofolio-cyclereact-sidebar.buttons .fa {
    line-height: " . $button_size . "px;
  }

  .solofolio-cyclereact-caption {
    padding-top: " . ($button_size + 20) . "px;
  }

  .entry .post-meta,
  .entry p,
  .entry .tag-links,
  .pagination-nav,
  .comments {
    max-width: " . $entry_text_width . "px;
  }
  ";

  if ($is_horizon) {
    $styles .="
      .solofolio-cyclereact-sidebar.buttons a {
        border: 1px solid " . get_theme_mod('solofolio_navigation_link_color') . ";
      }";
  } elseif ($is_heights) {
    $styles .="
      .solofolio-cyclereact-sidebar {
        padding-right: " . $layout_spacing . "px;
      }

      .solofolio-cyclereact-sidebar.buttons a {
        border: 1px solid " . get_theme_mod('solofolio_navigation_link_color') . ";
      }";
  }

  if ($is_horizon) {
    $styles .= "
      .header-content h3 {
        color: " . get_theme_mod('solofolio_navigation_header_color') . ";
        line-height: " . get_theme_mod('solofolio_navigation_header_font_size') . "px;
      }
      @media (min-width: 1025px) {
        .wrapper {
          bottom: " . $layout_spacing . "px;
          top: " . ($layout_spacing + 45) . "px;
          right: " . $layout_spacing . "px;
        }
        .logo { width: " . get_theme_mod('solofolio_logo_width') . "px }
        .admin-bar.page .wrapper {
          top: " . ($layout_spacing + 77) . "px;
        }
        .logo { padding-left: " . $layout_spacing . "px }
        .header-content { padding-right: " . $layout_spacing . "px }
        .solofolio-cyclereact-title {
          padding-top: " . ($layout_spacing + 45) . "px;
          padding-right: " . ($layout_spacing - 20) . "px;
          padding-bottom: " . $layout_spacing . "px;
        }
        .solofolio-cyclereact-sidebar {
          top: " . ($layout_spacing + 45) . "px;
          right: " . $layout_spacing . "px;
        }
        #solofolio-cyclereact-stage, .solofolio-cyclereact-title {
          right: " . ($header_width + 20) . "px;
        }
        .solofolio-cyclereact-thumbs {
          top: 35px;
          padding: " . $layout_spacing . "px;
        }
      }
      @media (max-width: 1024px) {
        #solofolio-cyclereact-stage, .solofolio-cyclereact-thumbs {
          left: " . ($header_width + 20) . "px;
        }
      }
      ";
  } elseif ($is_heights) {
    $styles .= "
      @media (min-width: 1025px) {
        .wrapper {
          bottom: " . $layout_spacing . "px;
          left: " . $layout_spacing . "px;
          right: " . $layout_spacing . "px;
          top: " . $layout_spacing . "px;
        }
        .header {
          width: " . $header_width . "px;
        }
        .header-meta {
          max-width: " . ($header_width - ($layout_spacing * 2)) . "px;
        }
        .admin-bar.page .wrapper {
          top: " . ($layout_spacing + 32) . "px;
        }
        .admin-bar.page .solofolio-cyclereact-thumbs {
          padding-top: " . ($layout_spacing + 22) . "px;
        }
        #solofolio-cyclereact-stage, .solofolio-cyclereact-thumbs, .solofolio-cyclereact-title {
          left: " . $header_width . "px !important;
        }
        .solofolio-cyclereact-sidebar {
          bottom: " . $layout_spacing . "px;
          background-color: ". $header_background_color . ";
        }

        .solofolio-cyclereact-thumbs, .solofolio-cyclereact-title {
          padding: " . $layout_spacing . "px;
        }

        .solofolio-cyclereact-thumbs {
          padding-top: " . ($layout_spacing - 10) . "px;
        }

        .header-inner {
          left: " . $layout_spacing . "px;
          top: " . $layout_spacing . "px;
          bottom: " . $layout_spacing . "px;
        }
      }

    ";
  }

  if ($is_heights && !$center_blog) {
    $styles .= "
      .wrapper {
        left: " . ($header_width + $layout_spacing) . "px;
        width: auto;
      }";
  }

  if ($is_heights && $center_blog) {
    $styles .= "
      .wrapper {
        left: " . ($header_width + $layout_spacing) . "px;
        width: auto;
      }

      @media (min-width: " . ($header_width + $entry_width + 20) . "px) {
        .wrapper {
          max-width: 100%;
          }

        .single .outer-wrap,
        .blog .outer-wrap,
        .search .outer-wrap {
          margin: 0 auto;
          position: relative;
          max-width: " . ($header_width + $entry_width + 20) . "px;
        }

        .single .header,
        .blog .header,
        .search .header {
          left: auto;
        }
      }";
  }

  $styles .= "</style>";

  $styles = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $styles);
  $styles = str_replace(': ', ':', $styles);
  $styles = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $styles);

  return $styles;
}

?>
