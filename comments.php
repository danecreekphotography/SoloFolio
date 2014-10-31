<?php
if ( post_password_required() ) {
	return;
}
?>

<div class="comments-area">
	<?php if ( have_comments() ) { ?>
		<ol class="comment-list"><?php wp_list_comments('type=comment&callback=solofolio_comments'); ?></ol>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'solofolio' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'solofolio' ) ); ?></div>
			</nav>
		<?php } ?>
		<?php if ( ! comments_open() ) { ?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'solofolio' ); ?></p>
		<?php } ?>
	<?php } ?>
	<?php comment_form(array('title_reply' => 'Leave a reply',
													 'label_submit' => 'Post comment',
													 'comment_notes_after' => '',
													 'comment_notes_before' => '')); ?>
</div>
