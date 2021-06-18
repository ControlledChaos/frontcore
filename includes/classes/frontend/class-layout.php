<?php
/**
 * Frontend template tags
 *
 * Call new instance of this class in header files.
 * Use of the `$fct_tags` variable is recommended
 * to instantiate, where the prefix matches the
 * rest of this theme's prefixes.
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Frontend
 * @since      1.0.0
 */

namespace FrontCore\Classes\Front;

// Alias namespaces.
use FrontCore\Classes\Customize as Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Layout {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		new Customize\Customizer;

		// Add nav to both actions for customizer refresh.
		add_action( 'FrontCore\nav_before_header', [ $this, 'navigation_main' ] );
		add_action( 'FrontCore\nav_after_header', [ $this, 'navigation_main' ] );

		// Add the default header.
		add_action( 'FrontCore\header', [ $this, 'page_header' ] );

		// Add the default sidebar.
		add_action( 'FrontCore\sidebar', [ $this, 'page_sidebar' ] );

		// Add the default search form.
		add_action( 'FrontCore\searchform', [ $this, 'default_searchform' ] );

		// Add the default header.
		add_action( 'FrontCore\footer', [ $this, 'page_footer' ] );
	}

	/**
	 * Load main navigation
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function navigation_main() {
		get_template_part( 'template-parts/navigation/navigation-main' );
	}

	/**
	 * Load default header
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page_header() {

		/**
		 * Conditional page header
		 *
		 * Out of the box there is no difference between the two header files.
		 * This condition is provided for demonstration primarily, also
		 * because it is common for a project to have a front page header
		 * that is bigger & bolder than those of subsequent pages.
		 */
		if ( is_front_page() ) {
			get_template_part( 'template-parts/header/header-front-page' );
		} elseif ( is_page_template( 'page-templates/page-builder.php' ) ) {
			get_template_part( 'template-parts/header/header-builder' );
		} else {
			get_template_part( 'template-parts/header/header-default' );
		}
	}

	/**
	 * Load default sidebar
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page_sidebar() {
		get_template_part( 'template-parts/aside/sidebar' );
	}

	/**
	 * Load default search form
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function default_searchform() {
		get_template_part( 'template-parts/forms/searchform' );
	}

	/**
	 * Load default footer
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page_footer() {
		get_template_part( 'template-parts/footer/footer-default' );
	}
}
