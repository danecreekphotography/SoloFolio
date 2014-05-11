<?php /* Template Name: About Page */ ?>

<?php get_header(); ?>

<div id="content-about">
	<?php if (have_posts()) : ?>
    <div id="content-about-image">
      <?php the_post_thumbnail('medium');; ?>
  	</div>
  	<?php while (have_posts()) : the_post(); ?>
  		<div id="content-about-content">
  			<?php the_content('Read the rest of this entry &raquo;'); ?>
  		</div>
  	<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
