<?php /* Template Name: About Page */ ?>

<?php get_header(); ?>

<div id="content-about">
	<?php if (have_posts()) : ?>
	<?php the_post_thumbnail('medium');; ?>
		<?php while (have_posts()) : the_post(); ?>
			<div id="content-about-right">
				<?php the_content('Read the rest of this entry &raquo;'); ?>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
