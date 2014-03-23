<?php
class solofolio_captions extends WP_Widget {

  function solofolio_captions() {
    parent::WP_Widget(false, $name = 'Solofolio Captions');
  }

  function widget($args, $instance) {
    extract( $args );
    global $wpdb;

    echo $before_widget;
    echo '<div class="solofolio-cyclereact-sidebar">';
      echo '<p class="solofolio-cyclereact-caption"></p>';
      echo '<span class="solofolio-cyclereact-controls">';
        echo '<a class="thumbs" href="#">';
          echo '<i class="fa fa-th"></i>';
          echo '<i class="fa fa-expand"></i>';
        echo '</a>';
        echo '<span class="arrows">';
          echo '<a class="prev" href="#"><i class="fa fa-angle-left"></i></a>';
          echo '<a class="next" href="#"><i class="fa fa-angle-right"></i></a>';
        echo '</span>';
      echo '</span>';
    echo '</div>';
	echo $after_widget;
  }
}
add_action('widgets_init', create_function('', 'return register_widget("solofolio_captions");'));
?>
