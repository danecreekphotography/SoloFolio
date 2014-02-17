<?php /* Template Name: Parent Page */ ?>

<?php get_header(); ?>

<div id="content-parent">
<?php
 $page_query = new WP_Query();
  $all_pages = $page_query->query( array('post_type' => 'page') );

  $page_children = get_page_children( get_the_id(), $all_pages );

  echo '<ul class="children">';
  foreach ($page_children as $page) {
    echo '<li>';
    echo '<h3>' . $page->post_title . '</h3>';
    echo '<a href="' . get_permalink($page->ID) . '">';
      echo get_the_post_thumbnail( $page->ID, 'medium' );
    echo '</a>';
    echo '</li>';
  }
  echo '</ul>';
?>
</div>

<?php get_footer(); ?>
