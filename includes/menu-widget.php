<?php
class Solofolio_Custom_Menu extends WP_Widget {
  public function __construct() {
    parent::__construct(
      'solofolio-custom-menu',
      __( 'SoloFolio Custom Menu', 'scm' ),
      array(
        'classname'   =>  'Solofolio_Custom_Menu',
        'description' =>  __( 'Add a custom menu to display it using SoloFolio collapsed/dropdown design.', 'scm' )
      )
    );
  }

  public function widget( $args, $instance ) {
    extract( $args, EXTR_SKIP );

    echo '<div class="solofolio-custom-menu">';

    echo $before_title . strip_tags( $instance['title'] ) . $after_title;

    $args = array(
        'menu'          => $instance['menu'],
        'container'     => false,
        'depth'         => -1,
    );

    wp_nav_menu( $args );

    echo '</div>';

  } // end widget

  /**
   * Processes the widget's options to be saved.
   *
   * @param array new_instance  The new instance of values to be generated via the update.
   * @param array old_instance  The previous instance of values before the update.
   */
  public function update( $new_instance, $old_instance ) {

    $instance = $old_instance;

    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['menu']  = strip_tags( $new_instance['menu'] );

    return $instance;

  } // end widget

  /**
   * Generates the administration form for the widget.
   *
   * @param array instance  The array of keys and values for the widget.
   */
  public function form( $instance ) {

      // TODO:  Define default values for your variables
    $instance = wp_parse_args(
      (array) $instance,
      array( 'menu' => '', 'title' => '' )
    );

    $title = strip_tags( $instance['title'] );
    $menu  = strip_tags( $instance['menu'] );
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'bcmw' ); ?>:
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
      </label>
    </p>

    <p>
      <label for="<?php echo $this->get_field_id( 'menu' ); ?>"><?php _e( 'Choose menu', 'bcmw' ); ?>:
        <select id="<?php echo $this->get_field_id( 'menu' ); ?>" name="<?php echo $this->get_field_name( 'menu' ); ?>">

          <?php foreach( $menus as $custom_menu ): ?>

            <option value="<?php echo $custom_menu->term_id; ?>" <?php if( $menu == $custom_menu->term_id ): ?>selected="selected"<?php endif; ?>><?php echo $custom_menu->name; ?></option>

          <?php endforeach; ?>

        </select>
      </label>
    </p>
    <?php

  }
}

add_action( 'widgets_init', create_function( '', 'register_widget("Solofolio_Custom_Menu");' ) );
?>
