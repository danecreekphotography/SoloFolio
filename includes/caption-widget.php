<?php
class solofolio_captions extends WP_Widget {

    function solofolio_captions() {
        parent::WP_Widget(false, $name = 'Solofolio Captions');
    }

    function widget($args, $instance) {
        extract( $args );
        global $wpdb;

        if(!$size)
            $size = 40;

        echo $before_widget;
        echo '<div class="solofolio-cyclereact-sidebar">';
          	echo '<p class="solofolio-cyclereact-caption"></p>';
            echo '<span class="solofolio-cycleract-controls">';
                echo '<a class="prev" href="#">prev</a> / ';
                echo '<a class="next" href="#">next</a>';
            echo '</span>';
        echo '</div>';
		echo $after_widget;
    }
}
add_action('widgets_init', create_function('', 'return register_widget("solofolio_captions");'));
?>
