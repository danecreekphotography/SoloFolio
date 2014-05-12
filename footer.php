	<div class="clear"></div>
</div>
</div>

<div class="clear"></div>

<?php
global $current_user;
if ($current_user->user_level != 10 ) { echo get_theme_mod( 'solofolio_tracking' ); }
?>

<?php wp_footer() ?>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.retina.min.js"></script>
<script type="text/javascript"src="<?php echo get_template_directory_uri(); ?>/js/solofolio-base.js"></script>

</body>
</html>
