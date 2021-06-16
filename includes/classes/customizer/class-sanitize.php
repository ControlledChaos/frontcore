<?php
/**
 * Sanitize theme customizer input
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Customizer
 */

namespace FrontCore\Classes\Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sanitize {

	/**
	 * The class object
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected static $class_object;

	/**
	 * Instance of the class
	 *
	 * This method can be used to call an instance
	 * of the class from outside the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns an instance of the class.
	 */
	public static function instance() {

		if ( is_null( self :: $class_object ) ) {
			self :: $class_object = new self();
		}

		// Return the instance.
		return self :: $class_object;
	}

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {}

	/**
	 * Main navigation location
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function nav_location( $input ) {

		$valid = [ 'before', 'after' ];

		if ( in_array( $input, $valid ) ) {
			return $input;
		}
		return 'before';
	}

	/**
	 * Blog/archive content
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function blog_format( $input ) {

		$valid = [ 'content', 'excerpt' ];

		if ( in_array( $input, $valid ) ) {
			return $input;
		}
		return 'content';
	}

	/**
	 * Admin theme
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function admin_theme( $input ) {

		if ( true == $input ) {
			return true;
		}
		return false;
	}

	/**
	 * Admin header
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function admin_header( $input ) {

		if ( true == $input ) {
			return true;
		}
		return false;
	}
}

/**
 * Instance of the class
 *
 * @since  1.0.0
 * @access public
 * @return object Sanitize Returns an instance of the class.
 */
function mods() {
	return Sanitize :: instance();
}
