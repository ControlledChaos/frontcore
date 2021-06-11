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
				esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'frontcore' ),
				'<span>' . get_the_title() . '</span>'
			);

		} else {
			printf(
				esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $fct_comment_count, 'comments title', 'frontcore' ) ),
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
	<?php comment_form(); ?>
</div>
