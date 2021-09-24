<?php
/**
 * Register widget areas
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Widgets
 * @since      1.0.0
 */

namespace FrontCore\Classes\Widgets;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Register {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Register the theme mode widget.
		add_action( 'widgets_init', function() {
			register_widget( __NAMESPACE__ . '\Theme_Mode' );
		} );

		// Register widget areas.
        add_action( 'widgets_init', [ $this, 'widgets' ] );
	}

	/**
	 * Register widgets
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function widgets() {

		// Sidebar position.
		if ( is_rtl() ) {
			$position = __( 'left', 'frontcore' );
		} else {
			$position = __( 'right', 'frontcore' );
		}

		// Register sidebar widget area.
		register_sidebar( [
			'name'          => __( 'Default Sidebar', 'frontcore' ),
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
}
