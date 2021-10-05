<?php
/**
 * Navigation menus
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Navigation
 * @since      1.0.0
 */

namespace FrontCore\Classes\Navigation;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Navigation {

	/**
	 * Instance of the class
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Variable for the instance to be used outside the class.
		static $instance = null;

		if ( is_null( $instance ) ) {

			// Set variable for new instance.
			$instance = new self;

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Register navigation menus.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Add navigation menu items.
		add_filter( 'wp_nav_menu_items', [ $this, 'nav_menu_items' ], 10, 2 );
	}

	/**
	 * Register navigation menus
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Register theme menus.
		$menus = apply_filters( 'fct_nav_menus', [
			'main'   => __( 'Main Menu', 'frontcore' ),
			'footer' => __( 'Footer Menu', 'frontcore' ),
			'social' => __( 'Social Menu', 'frontcore' )
		] );
		register_nav_menus( $menus );
	}

	/**
	 * Add navigation menu items
	 *
	 * Adds items to the main navigation menu.
	 * Provided for demonstration.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the markup of the item(s).
	 */
	public function nav_menu_items( $items, $args ) {

		if ( 'main' == $args->theme_location && is_user_logged_in() ) {
			$items .= '<li><a href="'. esc_url( wp_logout_url( site_url( '/' ) ) ) .'">' . __( 'Log Out', 'frontcore' ) . '</a></li>';
		} elseif ( 'main' == $args->theme_location ) {
			$items .= '<li><a href="'. esc_url( wp_login_url( site_url( '/' ) ) ) .'">' . __( 'Log In', 'frontcore' ) . '</a></li>';
		}
		return $items;
	}

	/**
	 * Main navigation fallback
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function main_nav_fallback() {
		get_template_part( FCT_PARTS_DIR . '/navigation/main-nav-fallback' );
	}
}
