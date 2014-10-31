  </div>
</div>

<div class="footer">
  <span class="copyright-label">copyright</span>
  <div class="copyright-hidden">
    <?php $text = get_theme_mod( 'solofolio_copyright_text' ); if (!empty($text)) { ?>
      &copy; <?php echo date("Y"); ?> <?php echo get_theme_mod( 'solofolio_copyright_text' ); ?>
    <?php } if (get_theme_mod('solofolio_show_attribution', true)) { ?>
      / Powered by <a title="The ultimate WordPress portfolio theme." href="http://solofol.io" target="_blank">SoloFolio</a>
    <?php } ?>
  </div>
</div>

<?php
global $current_user;
if ($current_user->user_level != 10 ) { echo get_theme_mod( 'solofolio_tracking' ); }

wp_footer()
?>

</body>
</html>
