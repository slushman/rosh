<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the
 * current comments and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rosh
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) { return; }

/**
 * The rosh_comments_before action hook
 */
do_action( 'rosh_comments_before' );

if ( have_comments() ) :

	?><h2 class="comments-title"><?php

		$comment_count = get_comments_number();

		if ( 1 === $comment_count ) {

			printf(
				/* Translators: 1: title. */
				esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'rosh' ),
				'<span>' . get_the_title() . '</span>'
			);

		} else {

			printf( // WPCS: XSS OK.
				/* Translators: 1: comment count number, 2: title. */
				esc_html(
					_nx( '%1$s thought on &ldquo;%1$s&rdquo;', '%1$s thoughts on &ldquo;%1$s&rdquo;', $comment_count, 'comments title', 'rosh' )
				),
				number_format_i18n( $comment_count ),
				'<span>' . get_the_title() . '</span>'
			);

		}

	?></h2><!-- .comments-title --><?php

	the_comments_navigation();

	?><ol class="comment-list"><?php

		wp_list_comments( array(
			'style'      => 'ol',
			'short_ping' => true,
		) );

	?></ol><!-- .comment-list --><?php

	the_comments_navigation();

endif; // Check for have_comments().

// If comments are closed and there are comments, let's leave a little note, shall we?
if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :

	?><p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'rosh' ); ?></p><?php

endif;

comment_form();

/**
 * The rosh_comments_after action hook
 */
do_action( 'rosh_comments_after' );
