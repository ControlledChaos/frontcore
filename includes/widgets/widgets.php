<?php
/**
 * Register widget areas
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Widgets
 * @since      1.0.0
 */

namespace FrontCore\Widgets;

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

	// Register the theme mode widget.
	add_action( 'widgets_init', function() {
		register_widget( 'FrontCore\Classes\Widgets\Theme_Mode' );
	} );

	// Register widget areas.
	add_action( 'widgets_init', $ns( 'register' ) );
}

/**
 * Register widgets
 *
 * @since  1.0.0
 * @return void
 */
function register() {

	// Sidebar position.
	if ( is_rtl() ) {
		$position = __( 'left', 'frontcore' );
	} else {
		$position = __( 'right', 'frontcore' );
	}

	// Register sidebar widget area.
	register_sidebar( [
		'name'          => __( 'Sidebar Widgets', 'frontcore' ),
		'id'            => 'sidebar-default',
		'description'   => sprintf(
			__( 'Displays to the %s of the main content.', 'frontcore' ),
			$position
		),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	] );

	register_sidebar( [
		'name'          => __( '404 Error', 'frontcore' ),
		'id'            => 'error-404',
		'description'   => __( 'Displays on the 404, page not found error page.', 'frontcore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );
}
