<?php

include_once("includes/gallery.php");     // Include gallery shortcode replacement
include_once("includes/social-widget.php");   // Include social media widget
include_once("includes/caption-widget.php");    // Include caption media widget
include_once("includes/customize.php");     // Include WP_customize structure
include_once("includes/css.php");

add_theme_support( 'post-thumbnails' );
add_image_size( 'about-image', 400, 600 );

add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );
add_filter( 'the_content', 'filter_ptags_on_images' );
add_filter( 'jpeg_quality', 'solo_jpg_quality_callback' );
add_action( 'after_setup_theme', 'solofolio_set_image_sizes' );
add_action( 'wp_enqueue_scripts', 'register_solofolio_styles' );

/**
 * Register style sheet.
 */
function register_solofolio_styles() {
  $uploads = wp_upload_dir();
  wp_register_style('solofolio', $uploads['baseurl'] . '/solofolio.css', 'style');
  wp_enqueue_style( 'solofolio' );
}

// Disable Admin Bar from frontend - More trouble than it's worth
function hide_admin_bar_from_front_end() {
  if (is_blog_admin()) {
    return true;
  }
  return false;
}

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// Force WP to make high-quality images
function solo_jpg_quality_callback($arg) {
  return (int)90;
}

// Add additional image size for large displays, change defaults for others.
function solofolio_set_image_sizes() {
	add_image_size('xlarge',1800,1200, false);
	update_option('thumbnail_size_w', 150);
	update_option('thumbnail_size_h', 100);
	update_option('medium_size_w', 300);
	update_option('medium_size_h', 200);
	update_option('large_size_w', 900);
	update_option('large_size_h', 600);
}

// Remove image margins automatically added by WordPress.
// From: http://wordpress.org/support/topic/10px-added-to-width-in-image-captions
class fixImageMargins{
    public function __construct(){
        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
    }
    public function fixme($x=null, $attr, $content){
        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));
        if ( 1 > (int) $width || empty($caption) ) {return $content;}
        if ( $id ) $id = 'id="' . $id . '" ';
    return '<div ' . $id . 'class="wp-caption ' . $align . '">' . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}
$fixImageMargins = new fixImageMargins();

// Register theme widget areas
if(function_exists('register_sidebar')){

  register_sidebar(array('name' => 'Main Navigation',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array('name' => 'Under Main Navigation on Blog',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
}
?>
