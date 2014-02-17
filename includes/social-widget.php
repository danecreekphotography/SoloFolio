<?php
class solofolio_social_widget extends WP_Widget {

  function solofolio_social_widget() {
    parent::WP_Widget(false, $name = 'Solofolio Social Media');
  }

  function widget( $args, $instance ) {
    extract( $args );
    global $wpdb;

	$facebook = apply_filters('widget_title', $instance['facebook']);
  $twitter = apply_filters('widget_title', $instance['twitter']);
  $instagram = apply_filters('widget_title', $instance['instagram']);
  $blink = apply_filters('widget_title', $instance['blink']);
  $vimeo = apply_filters('widget_title', $instance['vimeo']);
  $linkedin = apply_filters('widget_title', $instance['linkedin']);

  if(!$size)
    $size = 40;

  echo $before_widget;
  echo "<div id=\"solofolio-social\">";
    if ($facebook != "") {echo "<a target=\"_blank\" href=\"" . $facebook . "\"><i class=\"fa fa-facebook\"></i></a>";}
    if ($twitter != "") {echo "<a target=\"_blank\" href=\"" . $twitter . "\"><i class=\"fa fa-twitter\"></i></a>";}
    if ($instagram != "") {echo "<a target=\"_blank\" href=\"" . $facebook . "\"><i class=\"fa fa-instagram\"></i></a>";}
    if ($blink != "") {echo "<a target=\"_blank\" href=\"" . $facebook . "\"><i class=\"fa fa-map-marker\"></i></a>";}
    if ($vimeo != "") {echo "<a target=\"_blank\" href=\"" . $vimeo . "\"><i class=\"fa fa-vimeo-square\"></i></a>";}
    if ($linkedin != "") {echo "<a target=\"_blank\" href=\"" . $linkedin . "\"><i class=\"fa fa-linkedin\"></i></a>";}
	echo "</div>";
	echo $after_widget;
  }

  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['facebook'] = strip_tags($new_instance['facebook']);
    $instance['twitter'] = strip_tags($new_instance['twitter']);
    $instance['instagram'] = strip_tags($new_instance['instagram']);
    $instance['blink'] = strip_tags($new_instance['blink']);
    $instance['vimeo'] = strip_tags($new_instance['vimeo']);
    $instance['linkedin'] = strip_tags($new_instance['linkedin']);

    return $instance;
  }

  function form( $instance ) {
    $facebook = esc_attr($instance['facebook']);
    $twitter = esc_attr($instance['twitter']);
    $instagram = esc_attr($instance['instagram']);
    $blink = esc_attr($instance['blink']);
    $vimeo = esc_attr($instance['vimeo']);
    $linkedin = esc_attr($instance['linkedin']); ?>
    <p>
      <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo $facebook; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo $twitter; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('Instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo $instagram; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('blink'); ?>"><?php _e('Blink:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('blink'); ?>" name="<?php echo $this->get_field_name('blink'); ?>" type="text" value="<?php echo $blink; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('Vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo $vimeo; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('LinkedIn:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo $linkedin; ?>" />
    </p>
    <?php
  }
}
add_action('widgets_init', create_function('', 'return register_widget("solofolio_social_widget");'));
?>
