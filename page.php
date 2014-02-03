<?php get_header(); ?>

<div id="content-page">
	<?php if (have_posts()) : ?>
  	<?php while (have_posts()) : the_post(); ?>
  		<?php the_content('Read the rest of this entry &raquo;'); ?>
  	<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
