<?php
/**
 * Theme deactivation
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Activation
 * @since      1.0.0
 */

namespace FrontCore\Deactivate;

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

	add_action( 'switch_theme', $ns( 'deactivate' ) );
}

/**
 * Function to be fired when theme is deactivated
 *
 * @since  1.0.0
 * @return void
 *
 * @link   https://codex.wordpress.org/Function_Reference/remove_theme_mods
 */
function deactivate() {
	// update_option( 'fresh_site', 0 );
}
