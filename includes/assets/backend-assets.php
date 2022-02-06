<?php
/**
 * Admin assets
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Admin_Assets;

// Alias namespaces.
use FrontCore\Classes\Core as Core,
	FrontCore\Customize    as Customize;

use function FrontCore\Shared_Assets\suffix;

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

	// Admin scripts.
	add_action( 'admin_enqueue_scripts', $ns( 'admin_scripts' ) );

	/**
	 * Admin styles
	 * Call late to override plugin styles.
	 */
	add_action( 'admin_enqueue_scripts', $ns( 'admin_styles' ), 99 );
}

/**
 * Admin scripts
 *
 * @since  1.0.0
 * @return void
 */
function admin_scripts() {}

/**
 * Admin styles
 *
 * @since  1.0.0
 * @return void
 */
function admin_styles() {

	// Get Customizer settings.
	$use_theme = Customize\use_admin_theme( get_theme_mod( 'fct_admin_theme' ) );

	// Enqueue admin theme styles if set in the Customizer.
	if ( $use_theme ) {
		wp_enqueue_style( 'fct-admin', get_theme_file_uri( '/assets/css/admin' . suffix() . '.css' ), [], FCT_VERSION, 'all' );

		if ( is_rtl() ) {
			wp_enqueue_style( 'fct-admin-rtl', get_theme_file_uri( '/assets/css/admin-rtl' . suffix() . '.css' ), [], FCT_VERSION, 'all' );
		}
	}
}
