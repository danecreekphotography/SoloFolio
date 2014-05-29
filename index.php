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
					<?php if (get_theme_mod('solofolio_blog_showcat')) {?><span class="post-cat"><?php the_category(', ') ?></span><?php } ?>
					<h2 class="post-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
					</h2>
					<span class="date">
						<?php if (get_theme_mod('solofolio_blog_showdate')) { echo get_the_date(); } ?>
						<?php if (get_theme_mod('solofolio_blog_showauthor')) {?>by <?php the_author() ?><?php } ?>
					</span>
				</div>
				<?php the_content('Continue reading <i class="icon-angle-right"></i>'); ?>
				<?php wp_link_pages(); ?>
				<?php if (get_theme_mod('solofolio_blog_showtags')) { the_tags( '<span class="tag-links">Tags: ', ' ', '</span>' ); } ?>
				<div class="clear"></div>
			</div>
		<?php endwhile; ?>

		<?php if (is_single()) : ?>
			<div class="pagination-nav">
				<div class="left">
					<?php previous_post_link('%link', '<h4>Previous</h4> <span>%title</span>'); ?>
				</div>
				<div class="right">
					<?php next_post_link('%link', '<h4>Next</h4> <span>%title</span>'); ?>
				</div>
				<div class="clear"></div>
			</div>
			<div id="comments">
				<?php comments_template(); ?>
			</div>
		<?php else : ?>
			<div class="pagination-nav">
				<div class="left"><?php next_posts_link('<i class="fa fa-angle-left"></i> Previous') ?></div>
				<div class="right"><?php previous_posts_link('Next <i class="fa fa-angle-right"></i>') ?></div>
				<div class="clear"></div>
			</div>
		<?php endif; ?>

	<?php endif; ?>
</div>

<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
<?php get_footer(); ?>
