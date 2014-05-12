<?php /* Template Name: About Page */ ?>

<?php get_header(); ?>

<div id="content-about">
	<?php if (have_posts()) : ?>
    <?php if ( has_post_thumbnail()) : ?>
      <?php $pt = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
      <div id="content-about-image" style="max-width: <?php echo $pt[1];?>px">
        <?php the_post_thumbnail('large'); ?>
        <p class="wp-caption-text"><?php echo get_post(get_post_thumbnail_id())->post_excerpt ?></p>
      </div>
    <?php endif; ?>
  	<?php while (have_posts()) : the_post(); ?>
  		<div id="content-about-content">
  			<?php the_content('Read the rest of this entry &raquo;'); ?>
  		</div>
  	<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
