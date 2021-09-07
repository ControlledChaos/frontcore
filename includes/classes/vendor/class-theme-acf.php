<?php
/**
 * Advanced Custom Fields (ACF) compatibility
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Vendor
 * @since      1.0.0
 *
 * This frontend framework (theme) is designed
 * to be used with a companion plugin based on
 * the Site Core plugin, which has the basic
 * version of ACF bundled. So most of this class
 * may be unnecessary to your project.
 *
 * However, if the companion plugin is not used
 * then ACF can be bundled with this product.
 * Simply add the contents of the ACF plugin
 * to the `includes/vendor/acf` directory.
 *
 * The one method of this class which is used
 * throughout the template files is `suffix()`.
 *
 * @see `includes/classes/vendor/class-plugin.php`
 * @link https://github.com/ControlledChaos/sitecore
 */

namespace FrontCore\Classes\Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Theme_ACF extends Plugin {

	/**
	 * Installed plugin directory
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The directory of the installed plugin.
	 */
	protected $installed_dir = 'advanced-custom-fields';

	/**
	 * Installed plugin file
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The core file of the installed plugin.
	 */
	protected $installed_file = 'acf.php';

	/**
	 * Bundled plugin directory
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The directory of the bundled plugin.
	 */
	protected $bundled_dir = 'acf';

	/**
	 * Bundled plugin file
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The core file of the bundled plugin.
	 */
	protected $bundled_file = 'acf.php';

	/**
	 * Upgrade plugin directory
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The directory of the upgrade plugin.
	 */
	protected $upgrade_dir = 'advanced-custom-fields-pro';

	/**
	 * Upgrade plugin file
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The core file of the upgrade plugin.
	 */
	protected $upgrade_file = 'acf.php';

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {
		parent :: __construct();
	}

	/**
	 * Filters
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function filters() {

		/**
		 * ACF local JSON
		 *
		 * Remove some of the JSON directory filters in ACFE.
		 * Set new directory for saving & loading ACF field groups.
		 */
		if ( ! has_filter( 'acf/settings/save_json' ) ) {
			add_filter( 'acf/settings/save_json', [ $this, 'save_acf_json' ] );
		}

		if ( ! has_filter( 'acf/settings/load_json' ) ) {
			add_filter( 'acf/settings/load_json', [ $this, 'load_acf_json' ] );
		}

		// Filter assets URL.
		if ( ! $this->is_active() && ! FCT_COMPANION ) {
			add_filter( 'acf/settings/url', [ $this, 'acf_settings_url' ] );
		}

		// Hide/show the ACF admin menu item.
		add_filter( 'acf/settings/show_admin', [ $this, 'acf_settings_show_admin' ] );
	}

	/**
	 * Use bundled plugin
	 *
	 * @since  1.0.0
	 * @access public
	 * @return boolean Default should be true. False only
	 *                 if defined as such elsewhere.
	 */
	public function use_bundled() {

		// Override constant.
		if ( defined( 'FCT_USE_BUNDLED_ACF' ) && false == FCT_USE_BUNDLED_ACF ) {
			return false;
		} elseif ( FCT_COMPANION ) {
			return false;
		}
		return true;
	}

	/**
	 * ACF settings URL
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $url
	 * @return string Returns the URL for ACF files.
	 */
	public function acf_settings_url( $url = '' ) {
		$url = FCT_URL . '/includes/vendor/' . $this->bundled_dir . '/';
		return $url;
	}

	/**
	 * Show ACF in admin menu
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  boolean $show_admin
	 * @return boolean ACF displays in menu if true.
	 */
	public function acf_settings_show_admin( $show_admin = null ) {

		// Show by default.
		$show_admin = true;

		// Hide if in multisite mode & not the main site.
		if ( is_multisite() && ! is_main_site() && ! is_super_admin( get_current_user_id() ) ) {
			$show_admin = false;
		}
		return apply_filters( 'fct_acf_settings_show_admin', $show_admin );
	}

	/**
	 * Save ACF JSON directory
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $path
	 * @return string Returns the directory path.
	 */
	public function save_acf_json( $path = '' ) {
		$path = FCT_PATH . 'includes/settings/acf-json';
		return $path;
	}

	/**
	 * Load ACF JSON directory
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $paths
	 * @return array Returns an array of load paths.
	 */
	public function load_acf_json( $paths = [] ) {
		unset( $paths[0] );
		$paths[] = FCT_PATH . 'includes/settings/acf-json';
		return $paths;
	}

	/**
	 * ACF file suffix
	 *
	 * Returns `-acf` if ACF is active.
	 * Used to look for template parts with that suffix.
	 *
	 * @example `front-page-acf.php`
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $paths
	 * @return string Returns the suffix or empty.
	 */
	public function suffix( $suffix = '' ) {

		// If ACF is active.
		if ( $this->is_active() || class_exists( 'acf' ) ) {
			$suffix = '-acf';
		}

		// Return the suffix.
		return $suffix;
	}
}
