<?php

include_once("includes/gallery.php");         // Include gallery shortcode replacement
include_once("includes/social-widget.php");   // Include social media widget
include_once("includes/customize.php");       // Include WP_customize structure
include_once("includes/css.php");             // Include CSS builder

add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
update_option('image_default_link_type','none');

# Adapted from http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_title
function solofolio_wp_title( $title, $sep ) {
  global $paged, $page;

  if ( is_feed() )
    return $title;

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title = "$title $sep $site_description";

  // Add a page number if necessary.
  if ( $paged >= 2 || $page >= 2 )
    $title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

  return $title;
}
add_filter( 'wp_title', 'solofolio_wp_title', 10, 2 );

function solofolio_css_cache() {
  $data = get_transient( 'solofolio_css' );
  if ( $data === false ) {
    $data = solofolio_css();
    set_transient( 'solofolio_css', $data, 3600 * 24 );
  }
  echo $data;
}
add_action( 'wp_head', 'solofolio_css_cache', 199 );

function solofolio_css_cache_reset() {
  delete_transient( 'solofolio_css' );
  solofolio_css_cache();
}
add_action( 'customize_preview_init', 'solofolio_css_cache_reset' );
add_action( 'customize_save_after', 'solofolio_css_cache_reset' );
add_action( 'after_switch_theme', 'solofolio_css_cache_reset' );

function solofolio_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'solofolio_mime_types' );

current_theme_supports( 'html5' );

if ( ! isset( $content_width ) ) $content_width = 900;

function solofolio_mimes( $existing_mimes ) {
  // add webm to the list of mime types
  $existing_mimes['svg'] = 'image/svg+xml';

  // return the array back to the function with our added mime type
  return $existing_mimes;
}
add_filter( 'mime_types', 'solofolio_mimes' );

function filter_ptags_on_images($content) {
  $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
  return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function solofolio_fonts_list() {
  $fonts = [ get_theme_mod('solofolio_font_body', 'Source+Sans+Pro'),
             get_theme_mod('solofolio_font_logo', 'Source+Sans+Pro')
           ];

  return $fonts;
}

function solofolio_load_fonts() {
  $i = 1;
  foreach(array_unique(solofolio_fonts_list()) as $font) {
    wp_enqueue_style('solofolio-font-' . $i, '//fonts.googleapis.com/css?family=' . $font);
    $i++;
  }
  wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', array(), '4.0.3' );
}
add_action('wp_print_styles', 'solofolio_load_fonts');

function solofolio_footer_scripts() {
  wp_enqueue_script('jquery-retina', get_template_directory_uri().'/js/jquery.retina.min.js', array('jquery'), null, true);
  wp_enqueue_script('jquery-fitvids', get_template_directory_uri().'/js/jquery.fitvids.min.js', array('jquery'), null, true);
  wp_enqueue_script('solofolio-base', get_template_directory_uri().'/js/solofolio-base.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'solofolio_footer_scripts');

// Add additional image size for large displays, change defaults for others.
function solofolio_set_image_sizes() {
	add_image_size('xlarge',1800,1200, false);
	update_option('thumbnail_size_w', 300);
	update_option('thumbnail_size_h', 200);
	update_option('medium_size_w', 600);
	update_option('medium_size_h', 400);
	update_option('large_size_w', 900);
	update_option('large_size_h', 600);

  # Disable thumbnail cropping
  if(false === get_option("thumbnail_crop")) {
    add_option("thumbnail_crop", "0"); }
  else {
    update_option("thumbnail_crop", "0");
  }
}
add_action( 'after_setup_theme', 'solofolio_set_image_sizes' );

function solofolio_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">
          <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
        </div>

        <?php if ($comment->comment_approved == '0') : ?>
           <em><?php _e('Your comment is awaiting moderation.', 'solofolio') ?></em>
           <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata">
          <?php printf(__('%1$s', 'solofolio'), get_comment_date('Y-m-d')) ?>
          <?php edit_comment_link(__('(Edit)', 'solofolio'),'  ','') ?>
        </div>
        <?php comment_text() ?>
     </div>
<?php
        }

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
