<?php
/**
 * Assets class
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Assets
 * @since      1.0.0
 */

namespace FrontCore\Shared_Assets;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
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

	// Toolbar styles.
	add_action( 'wp_enqueue_scripts', $ns( 'toolbar_styles' ) );
	add_action( 'admin_enqueue_scripts', $ns( 'toolbar_styles' ), 99 );

	// Login styles.
	add_action( 'login_enqueue_scripts', $ns( 'login_styles' ) );

	// Embedded content styles.
	add_action( 'fct_embed_head', $ns( 'embed_styles' ) );
}

/**
 * Toolbar styles
 *
 * Enqueues if user is logged in and user toolbar is showing.
 *
 * @since  1.0.0
 * @return void
 */
function toolbar_styles() {

	if ( is_user_logged_in() && is_admin_bar_showing() ) {
		wp_enqueue_style( 'fct-toolbar', get_theme_file_uri( '/assets/css/toolbar' . suffix() . '.css' ), [], FCT_VERSION, 'screen' );
	}
}

/**
 * Login styles
 *
 * @since  1.0.0
 * @return void
 */
function login_styles() {

	wp_enqueue_style( 'fct-login', get_theme_file_uri( '/assets/css/login' . suffix() . '.css' ), [ 'login' ], FCT_VERSION, 'screen' );
}

/**
 * Embedded content styles
 *
 * @since  1.0.0
 * @return void
 */
function embed_styles() {

	wp_enqueue_style( 'fct-embed', get_theme_file_uri( '/assets/css/embed' . suffix() . '.css' ), [], FCT_VERSION, 'screen' );
}

/**
 * File suffix
 *
 * Adds the `.min` filename suffix if
 * the system is not in debug mode.
 *
 * @since  1.0.0
 * @param  string $suffix The string returned
 * @return string Returns the `.min` suffix or
 *                an empty string.
 */
function suffix() {

	// If in one of the debug modes do not minify.
	if (
		( defined( 'WP_DEBUG' ) && WP_DEBUG ) ||
		( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
	) {
		$suffix = '';
	} else {
		$suffix = '.min';
	}

	// Return the suffix or not.
	return $suffix;
}
