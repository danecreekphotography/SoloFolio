	<div class="clear"></div>
</div>
</div>

<div class="clear"></div>

<?php
global $current_user;
if ($current_user->user_level != 10 ) { echo get_theme_mod( 'solofolio_tracking' ); }
?>

<?php wp_footer() ?>

</body>
</html>
