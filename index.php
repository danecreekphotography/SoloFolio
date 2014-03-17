<?php get_header(); ?>

<div id="content-index">
	<?php if (have_posts()) : ?>

		<?php if (is_search()) : ?>
			<h2>Search Results</h2>
		<?php endif; ?>

		<?php while (have_posts()) : the_post(); ?>
			<div class="entry" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post-meta">
					<?php if (get_theme_mod('solofolio_blog_showcat')) {?><span class="post-cat"><?php the_category(', ') ?></span><?php } ?>
					<h2 class="post-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
					</h2>
					<span class="date">
						<?php the_time('Y-m-d') ?>
						<?php if (get_theme_mod('solofolio_blog_showauthor')) {?>by <?php the_author() ?><?php } ?>
						<?php the_tags( '<span class="tag-links">', '', '</span>' ); ?>
					</span>
				</div>
				<?php the_content('Continue reading <i class="icon-angle-right"></i>'); ?>
				<?php wp_link_pages(); ?>
				<div class="clear"></div>
			</div>
		<?php endwhile; ?>

		<?php if (is_single()) : ?>
			<div class="pagination-nav">
				<div class="left"><?php previous_post_link('%link', '<i class="icon-angle-left"></i> %title'); ?></div>
				<div class="right"><?php next_post_link('%link', '%title <i class="icon-angle-right"></i>'); ?></p></div>
				<div class="clear"></div>
			</div>
			<div id="comments">
				<?php comments_template(); ?>
			</div>
		<?php else : ?>
			<div class="pagination-nav">
				<div class="left"><?php next_posts_link('<i class="icon-angle-left"></i> Past') ?></div>
				<div class="right"><?php previous_posts_link('Future <i class="icon-angle-right"></i>') ?></div>
				<div class="clear"></div>
			</div>
		<?php endif; ?>

	<?php endif; ?>
</div>

<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
<?php get_footer(); ?>
