<?php
/**
 * Admin menu
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Classes\Admin;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin_Menu {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Appearance submenu items.
		add_action( 'admin_menu', [ $this, 'appearance_menu' ] );
	}

	/**
	 * Appearance submenu items
	 *
	 * @since  1.0.0
	 * @access public
	 * @global array menu The admin menu array.
	 * @global array submenu The admin submenu array.
	 * @return void
	 */
	public function appearance_menu() {

		// Access global variables.
		global $menu, $submenu;

		if ( isset( $submenu['themes.php'] ) ) {

			// Look for menu items under Appearances.
			foreach ( $submenu['themes.php'] as $key => $item ) {

				if ( current_user_can( 'customize' ) ) {
					unset( $submenu['themes.php'][6] );
				}

				if ( current_theme_supports( 'custom-header' ) && current_user_can( 'customize' ) ) {
					unset( $submenu['themes.php'][15] );
				}

				if ( current_theme_supports( 'custom-background' ) && current_user_can( 'customize' ) ) {
					unset( $submenu['themes.php'][20] );
				}
			}
		}

		$customize_url = add_query_arg( 'return', urlencode( remove_query_arg( wp_removable_query_args(), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ), 'customize.php' );

		add_submenu_page(
			'themes.php',
			__( 'Customize', 'frontcore' ),
			__( 'Customize', 'frontcore' ),
			'customize',
			$customize_url,
			'',
			-1
		);
	}
}
