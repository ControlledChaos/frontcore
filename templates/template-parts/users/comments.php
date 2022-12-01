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
	<h2><?php Tags\comments_title() ?></h2>

	<?php Tags\comments_navigation(); ?>
	<?php Tags\comments_list(); ?>
	<?php Tags\comments_navigation(); ?>
	<?php if ( ! comments_open() ) {
		Tags\comments_closed();
	} ?>
	<?php endif; // have_comments(). ?>
	<?php Tags\comment_form(); ?>
</div>
