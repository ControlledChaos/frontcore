<?php
/**
 * Comments and discussion
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Frontend
 * @since      1.0.0
 */

namespace FrontCore\Comments;

// Alias namespaces.
use FrontCore\Classes\Vendor as Vendor;

function setup() {

	// Return namespaced function.
	$ns = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_filter( 'comments_template', $ns( 'comment_template' ) );
}

/**
 * Comments template
 *
 * Filters the comments template path by post type.
 * Does not affect block comments in block themes.
 *
 * @since  1.0.0
 * @param  string $comment_template
 * @return string Returns the path of the associated template.
 */
function comment_template( $comment_template ) {

	// Instantiate ACF class to get the suffix.
	$acf = new Vendor\Theme_ACF;

	// Stop if no comments.
	if ( ! ( post_type_supports( get_post_type( get_the_ID() ), 'comments' ) || comments_open() ) ) {
	   return;
	}

	// Template path by post type.
	$template = sprintf(
		'/templates/template-parts/users/comments-%s%s.php',
		get_post_type( get_the_ID() ),
		$acf->suffix()
	);

	// Look for a specific template as applied above.
	$locate = locate_template( FCT_PARTS_DIR . '/users/' . $template . '.php' );

	// Use the specific template if found.
	if ( locate_template( $template ) ) {
		$template = $template;

	// Default to generic template ( always for post type: post ).
	} else {
		$template = sprintf(
			'/templates/template-parts/users/comments%s.php',
			$acf->suffix()
		);
	}

	return get_template_directory() . $template;
}
