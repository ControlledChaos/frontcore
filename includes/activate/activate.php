<?php
/**
 * Theme activation
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Activation
 * @since      1.0.0
 */

namespace FrontCore\Activate;

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

	add_action( 'after_switch_theme', $ns( 'activate' ) );
}

/**
 * Function to be fired when theme is activated
 *
 * Default actions provided here are samples of how to set theme mods,
 * add starter content, and redirect the user after activation.
 *
 * Remove or modify these as needed.
 *
 * @since  1.0.0
 * @return void
 *
 * @link   https://developer.wordpress.org/reference/functions/set_theme_mod/
 */
function activate() {

	// Start with a fresh site for starter content.
	add_option( 'fresh_site', 1 );
	update_option( 'fresh_site', 1 );

	// Delete the starter comment.
	if ( 0 != get_option( 'fresh_site' ) ) {
		wp_delete_comment( 1 );
	}


	/**
	 * Sample action: redirect to the Customizer on theme activation.
	 */
	global $pagenow;

	if ( ! is_customize_preview() ) {
		if ( 'themes.php' == $pagenow && is_admin() && isset( $_GET['activated'] ) ) {

			// URL returns to Dashboard on closing the Customizer.
			wp_redirect( admin_url( 'customize.php' ) . '?return=' . admin_url() );
		}
	}
}
