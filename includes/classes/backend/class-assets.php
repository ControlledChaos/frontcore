<?php
/**
 * Admin assets
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Classes\Admin;

// Alias namespaces.
use FrontCore\Classes\Core as Core,
	FrontCore\Classes\Customize as Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Assets {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Admin scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

		/**
		 * Admin styles
		 * Call late to override plugin styles.
		 */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ], 99 );
	}

	/**
	 * Admin scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {}

	/**
	 * Admin styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_styles() {

		// Get Customizer settings.
		new Customize\Customizer;
		$use_theme = Customize\mods()->admin_theme( get_theme_mod( 'fct_admin_theme' ) );

		// Enqueue admin theme styles if set in the Customizer.
		if ( $use_theme ) {
			wp_enqueue_style( 'fct-admin', get_theme_file_uri( '/assets/css/admin' . $this->suffix() . '.css' ), [], FCT_VERSION, 'all' );

			if ( is_rtl() ) {
				wp_enqueue_style( 'fct-admin-rtl', get_theme_file_uri( '/assets/css/admin-rtl' . $this->suffix() . '.css' ), [], FCT_VERSION, 'all' );
			}
		}
	}

	/**
	 * File suffix
	 *
	 * Adds the `.min` filename suffix if
	 * the system is not in debug mode.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $suffix The string returned
	 * @return string Returns the `.min` suffix or
	 *                an empty string.
	 */
	public function suffix() {

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
}
