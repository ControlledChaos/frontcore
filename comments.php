<?php
/**
 * Comments template
 *
 * This is the template that displays the area of the page that
 * contains both the current comments and the comment form.
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Users
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Front as Front;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) :

	?>
	<h2 class="comments-title">
		<?php

		$fct_comment_count = get_comments_number();

		if ( '1' === $fct_comment_count ) {
			printf(
				esc_html__( 'One comment on &ldquo;%1$s&rdquo;', 'frontcore' ),
				'<span>' . get_the_title() . '</span>'
			);

		} else {
			printf(
				esc_html( _nx( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $fct_comment_count, 'comments title', 'frontcore' ) ),
				number_format_i18n( $fct_comment_count ),
				'<span>' . get_the_title() . '</span>'
			);
		}
		?>
	</h2>

	<?php the_comments_navigation(); ?>

	<ol class="comment-list">
		<?php
		wp_list_comments( [
			'style'      => 'ol',
			'short_ping' => true,
		] );
		?>
	</ol>

	<?php
	the_comments_navigation();

	if ( ! comments_open() ) :

	?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'frontcore' ); ?></p>
	<?php

	endif; // comments_open().

	endif; // have_comments().
	?>
	<?php

	$before_form = sprintf(
		'<p>%s</p>',
		__( 'Your email address will not be published. Required fields are marked *.', 'frontcore' )
	);

	$moderation = get_option( 'comment_moderation' );
	if ( $moderation ) {

		$before_form .= sprintf(
			'<p>%s</p>',
			__( 'Your comment will be held for moderation before it appears here.', 'frontcore' )
		);
		$submit_title_attr = __( 'Submit your comment for approval', 'frontcore' );

	} else {
		$submit_title_attr = __( 'Submit your comment', 'frontcore' );
	}

	$args = [
		'title_reply' => __( 'Submit a Comment', 'frontcore' ),
		'comment_notes_before' => $before_form,
		'submit_button' => sprintf(
			'<input type="submit" name="%1$s" id="%2$s" class="%3$s" value="%4$s" title="%5$s" />',
			'submit',
			'submit',
			'submit',
			__( 'Submit', 'frontcore' ),
			$submit_title_attr
		)
	];
	comment_form( $args ); ?>
</div>
