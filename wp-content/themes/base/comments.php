<?php
if ( post_password_required() ) {
	return;
}

$twenty_twenty_one_comment_count = get_comments_number(); ?>

<div id="comments" class="comments-area default-max-width <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">

	<?php
	if ( have_comments() ) : ; ?>
		<h2 class="comments-title"><?php
			if ( '1' === $twenty_twenty_one_comment_count ) :
				esc_html_e( '1 comment', 'base' );
			else :
				printf(
					esc_html( _nx( '%s comment', '%s comments', $twenty_twenty_one_comment_count, 'Comments title', 'base' ) ),
					esc_html( number_format_i18n( $twenty_twenty_one_comment_count ) )
				);
			endif; ?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 60,
					'style'       => 'ol',
					'short_ping'  => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_pagination(
			array(
				/* translators: There is a space after page. */
				'before_page_number' => esc_html__( 'Page ', 'base' ),
				'mid_size'           => 0,
				'prev_text'          => sprintf(
					'%s <span class="nav-prev-text">%s</span>',
					is_rtl() ? '-' : '-',
					esc_html__( 'Older comments', 'base' )
				),
				'next_text'          => sprintf(
					'<span class="nav-next-text">%s</span> %s',
					esc_html__( 'Newer comments', 'base' ),
					is_rtl() ? '-' : '-'
				),
			)
		);
		?>

		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'base' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php comment_form(
		array(
			'logged_in_as'       => null,
			'title_reply'        => esc_html__( 'Leave a comment', 'base' ),
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
		)
	); ?>

</div>