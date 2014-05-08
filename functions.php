<?php

include_once("includes/gallery.php");         // Include gallery shortcode replacement
include_once("includes/social-widget.php");   // Include social media widget
include_once("includes/caption-widget.php");  // Include caption media widget
include_once("includes/customize.php");       // Include WP_customize structure
include_once("includes/css.php");             // Include CSS builder

add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );
add_filter( 'the_content', 'filter_ptags_on_images' );

add_action( 'after_setup_theme', 'solofolio_set_image_sizes' );
add_action( 'wp_enqueue_scripts', 'register_solofolio_styles' );
add_action( 'init', 'solofolio_editor_styles' );
add_filter( 'upload_mimes', 'solofolio_mime_types' );

function solofolio_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

current_theme_supports( 'html5' );

if ( ! isset( $content_width ) ) $content_width = 900;

function solofolio_editor_styles() {
  add_editor_style( get_stylesheet_uri() );
}

function solofolio_mimes( $existing_mimes ) {
  // add webm to the list of mime types
  $existing_mimes['svg'] = 'image/svg+xml';

  // return the array back to the function with our added mime type
  return $existing_mimes;
}
add_filter( 'mime_types', 'solofolio_mimes' );

function register_solofolio_styles() {
  $uploads = wp_upload_dir();
  wp_register_style( 'solofolio', $uploads['baseurl'] . '/solofolio.css', 'style' );
  wp_enqueue_style( 'solofolio' );
}

// Use jQuery Google API
function modify_jquery() {
  if (!is_admin()) {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js', false, '2.0.3' );
    wp_enqueue_script( 'jquery' );
  }
}
add_action('init', 'modify_jquery');

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

// Add additional image size for large displays, change defaults for others.
function solofolio_set_image_sizes() {
	add_image_size('xlarge',1800,1200, false);
	update_option('thumbnail_size_w', 300);
	update_option('thumbnail_size_h', 200);
	update_option('medium_size_w', 600);
	update_option('medium_size_h', 400);
	update_option('large_size_w', 900);
	update_option('large_size_h', 600);
}

function solofolio_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
          <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
        </div>

        <?php if ($comment->comment_approved == '0') : ?>
           <em><?php _e('Your comment is awaiting moderation.') ?></em>
           <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata">
          <?php printf(__('%1$s'), get_comment_date('Y-m-d')) ?>
          <?php edit_comment_link(__('(Edit)'),'  ','') ?>
        </div>

        <?php comment_text() ?>
     </div>
<?php
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
    'before_widget' => '<div class="sidebar-widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array('name' => 'Under Main Navigation on Blog',
    'before_widget' => '<div class="sidebar-widget blog-sidebar">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  ));
}
?>
