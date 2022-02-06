<?php
/**
 * Block editor
 *
 * Methods for the block editor in WordPress 5.0 or greater.
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Editors;

// Alias namespaces.
use  FrontCore\Classes\Core as Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Execute functions
 *
 * @since  1.0.0
 * @return void
 */
function setup() {

	// Return namespaced function.
	$ns = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// Editor color palettes.
	add_action( 'after_setup_theme', $ns( 'color_palettes' ) );

	// Disable custom colors.
	add_action( 'after_setup_theme', $ns( 'disable_custom_colors' ) );

	// Get latest rich-text editor styles.
	add_filter( 'mce_css', $ns( 'fresh_editor_style' ) );
}

/**
 * Editor color palettes
 *
 * These basic colors are provided as an example of
 * a color palette array. They are not intended to
 * be appealing, they are intended to be neutral.
 *
 * Replace with colors of your theme.
 *
 * @since  1.0.0
 * @return void
 */
function color_palettes() {

	/**
	 * Block editor colors
	 *
	 * Match the following HEX codes with SASS color variables.
	 * @see assets/css/modules/_colors.scss
	 *
	 * Also coordinate changes here with CSS classes
	 * in the blocks & block editor stylesheets.
	 * @see assets/css/blocks.scss
	 * @see assets/css/editor-blocks.scss
	 *
	 * @since 1.0.0
	 */
	$color_args = [
		[
			'name'  => __( 'Dark Gray', 'frontcore' ),
			'slug'  => 'fct-dark-gray',
			'color' => '#333333',
		],
		[
			'name'  => __( 'Medium Gray', 'frontcore' ),
			'slug'  => 'fct-medium-gray',
			'color' => '#555555',
		],
		[
			'name'  => __( 'Light Gray', 'frontcore' ),
			'slug'  => 'fct-light-gray',
			'color' => '#888888',
		],
		[
			'name'  => __( 'Pale Gray', 'frontcore' ),
			'slug'  => 'fct-pale-gray',
			'color' => '#cccccc',
		],
		[
			'name'  => __( 'White', 'frontcore' ),
			'slug'  => 'fct-white',
			'color' => '#ffffff',
		],
		[
			'name'  => __( 'Error Red', 'frontcore' ),
			'slug'  => 'fct-error',
			'color' => '#dc3232',
		],
		[
			'name'  => __( 'Notify Orange', 'bernays' ),
			'slug'  => 'ebp-notify',
			'color' => '#ee6600',
		],
		[
			'name'  => __( 'Warning Yellow', 'frontcore' ),
			'slug'  => 'fct-warning',
			'color' => '#ffb900',
		],
		[
			'name'  => __( 'Success Green', 'frontcore' ),
			'slug'  => 'fct-success',
			'color' => '#46b450',
		]
	];

	// Apply a filter to editor arguments.
	$colors = apply_filters( 'fct_editor_colors', $color_args );

	// Add theme color support.
	add_theme_support( 'editor-color-palette', $colors );
}

/**
 * Allow custom colors by ID
 *
 * @since  1.0.0
 * @return array Returns an array of allowed users.
 */
function allow_custom_colors() {

	// Get the current user's ID.
	$user = get_current_user_id();

	/**
	 * Array user IDs to allow custom colors
	 * in the block editor.
	 */
	$allowed_ids = [];

	/**
	 * Custom colors user role
	 *
	 * The minimum capability of the current user
	 * to allow custom colors in the block editor.
	 */
	$allowed_role = 'manage_options';

	// Add administrators to the allowed list.
	$admin = [];
	if ( current_user_can( $allowed_role ) ) {
		$admin = [ $user ];
	}

	// Merge the allowed arrays.
	$allowed = array_merge( $allowed_ids, $admin );

	// Return a filtered array of allowed users.
	return apply_filters( 'fct_allow_custom_colors', $allowed );
}

/**
 * Disable custom colors
 *
 * This disables the ability of editors to pick
 * their own colors for text and background.
 *
 * @since  1.0.0
 * @return void
 */
function disable_custom_colors() {

	// Get the current user's ID.
	$user = get_current_user_id();

	// Get the allowed list.
	$allowed = allow_custom_colors();

	// Stop here if the current user is allowed custom colors.
	if ( is_array( $allowed ) && in_array( $user, $allowed ) ) {
		return;
	}

	// Add theme support if the current user is NOT allowed custom colors.
	add_theme_support( 'disable-custom-colors', [] );
}

/**
 * Latest editor styles
 *
 * Add sa parameter of the last modified time to all editor stylesheets.
 *
 * Modified copy of `_WP_Editors::editor_settings()`.
 *
 * @since  1.0.0
 * @param  string $css Comma separated stylesheet URIs
 * @return string
 */
function fresh_editor_style( $css ) {

	global $editor_styles;

	if ( empty ( $css ) or empty ( $editor_styles ) ) {
		return $css;
	}

	$mce_css = [];

	// Load parent theme styles first, so the child theme can overwrite it.
	if ( is_child_theme() )	{
		editor_styles_version(
			$mce_css,
			get_template_directory(),
			get_template_directory_uri()
		);
	}

	editor_styles_version(
		$mce_css,
		get_stylesheet_directory(),
		get_stylesheet_directory_uri()
	);

	return implode( ',', $mce_css );
}

/**
 * Editor styles version
 *
 * Adds version parameter to each stylesheet URI.
 *
 * @since  1.0.0
 * @param  array  $mce_css Passed by reference.
 * @param  string $dir
 * @param  string $uri
 * @return void
 */
function editor_styles_version( &$mce_css, $dir, $uri ) {

	global $editor_styles;

	foreach ( $editor_styles as $file )	{

		if ( ! $file or ! file_exists( "$dir/$file" ) )	{
			continue;
		}

		$mce_css[] = add_query_arg(
			'version',
			filemtime( "$dir/$file" ),
			"$uri/$file"
		);
	}
}
