<?php get_header(); ?>

<div id="content-index">
	<?php if (have_posts()) : ?>

		<?php if (is_search()) : ?>
			<h2>Search Results</h2>
		<?php endif; ?>

		<?php while (have_posts()) : the_post(); ?>
			<div class="entry" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail()) : ?>
					<?php $pt = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
					<div class="wp-caption blog-featured-image" style="max-width: <?php echo $pt[1];?>px">
						<?php the_post_thumbnail('large'); ?>
						<p class="wp-caption-text"><?php echo get_post(get_post_thumbnail_id())->post_excerpt ?></p>
					</div>
				<?php endif; ?>
				<div class="post-meta">
					<h2 class="post-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
					</h2>
					<h4 class="post-byline">
						<?php if (get_theme_mod('solofolio_blog_showdate')) { echo get_the_date(); } ?>
						<?php if (get_theme_mod('solofolio_blog_showauthor')) {?>by <?php the_author() ?><?php } ?>
						<?php if (get_theme_mod('solofolio_blog_showcat')) {?>in <?php the_category(', ') ?><?php } ?>
					</h4>
				</div>
				<?php the_content('Continue reading &rsaquo;'); ?>
				<?php wp_link_pages(); ?>
				<?php if (get_theme_mod('solofolio_blog_showtags')) { the_tags( '<div class="tag-links">Tags: ', ', ', '</div>' ); } ?>
				<div class="clear"></div>
			</div>
		<?php endwhile; ?>

		<?php if (is_single()) : ?>
			<div class="pagination-nav">
				<div class="left">
					<?php
					$prev_post = get_adjacent_post(false, '', true);

					if(!empty($prev_post)) { ?>
					<h4>Previous</h4>
					<?php previous_post_link('%link', '%title'); } ?>
				</div>
				<div class="right">
					<?php
					$next_post = get_adjacent_post(false, '', false);

					if(!empty($next_post)) { ?>
					<h4>Next</h4>
					<?php next_post_link('%link', '%title'); } ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="comments">
				<?php comments_template(); ?>
			</div>
		<?php else : ?>
			<div class="pagination-nav">
				<div class="left"><?php next_posts_link('&lsaquo; Previous') ?></div>
				<div class="right"><?php previous_posts_link('Next &rsaquo;') ?></div>
				<div class="clear"></div>
			</div>
		<?php endif; ?>

	<?php endif; ?>
</div>

<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
<?php get_footer(); ?>
