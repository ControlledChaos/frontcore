<?php
/**
 * Theme deactivation
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Activation
 * @since      1.0.0
 */

namespace FrontCore\Classes\Activate;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme deactivation class
 *
 * @since  1.0.0
 * @access public
 */
class Deactivate {

    /**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		add_action( 'switch_theme', [ $this, 'deactivate' ] );

	}

    /**
	 * Function to be fired when theme is deactivated
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 *
	 * @link   https://codex.wordpress.org/Function_Reference/remove_theme_mods
	 */
    public function deactivate() {

        // update_option( 'fresh_site', 0 );

    }
}
