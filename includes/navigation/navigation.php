<?php
/**
 * Navigation menus
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Navigation
 * @since      1.0.0
 */

namespace FrontCore\Navigation;

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

	// Register navigation menus.
	add_action( 'after_setup_theme', $ns( 'register' ) );

	// Add navigation menu items.
	add_filter( 'wp_nav_menu_items', $ns( 'nav_menu_items' ), 10, 2 );
}

/**
 * Register navigation menus
 *
 * @since  1.0.0
 * @return void
 */
function register() {

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
 * @return string Returns the markup of the item(s).
 */
function nav_menu_items( $items, $args ) {

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
 * @return void
 */
function main_nav_fallback() {
	get_template_part( FCT_PARTS_DIR . '/navigation/main-nav-fallback' );
}
