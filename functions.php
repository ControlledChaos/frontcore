<?php
/**
 * Front Core functions
 *
 * Develop site-specific themes for ClassicPress, WordPress, and the antibrand system.
 *
 * @package    Front_Core
 * @subpackage Functions
 * @since      1.0.0
 *
 * @link       https://github.com/ControlledChaos/frontcore
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 */

 /**
 * Renaming, rebranding, and defaults
 *
 * Following is a list of strings to find and replace in all theme files.
 *
 * 1. Theme Name
 *    Find `Front Core` and replace with your theme name
 *
 * 2. Theme namespace
 *    Find `Front_Core` and replace with your theme namespace, include
 *    underscores between words. This will change the namespace and the package
 *    name in file headers.
 *
 * 3. Text domain
 *    Find `frontcore` and replace with the text domain of your theme.
 *
 * 4. Theme prefix
 *    Find `fct` and replace with the unique, lowercase theme prefix.
 *    This prefix is used for applied filters, stylesheet IDs, and
 *    admin page URIs, so the prefix may be followed by an underscore
 *    or a dash. Search for `fct_` and `fct-` to find the difference.
 *
 * 5. Constant prefix
 *    Find `FCT` and replace with the unique, uppercase prefix of your theme.
 *
 * 6. Header image
 *    Replace the default image file `default-header.jpg`.
 *    @see assets/images/
 *
 * 7. Activation and deactivation
 *    Check the activation and deactivation classes for sample methods.
 *    Remove or modify the samples as needed.
 *    @see includes/class-activate
 *    @see includes/class-deactivate
 *
 * 8. README file
 *    Whether or not your theme will be kept in a version control repository,
 *    edit the content of the README file in the theme's root directory or
 *    delete it if it is not necessary.
 */

namespace FrontCore;

// Alias namespaces.
use
FrontCore\Classes           as General,
FrontCore\Classes\Activate  as Activate,
FrontCore\Classes\Core      as Core,
FrontCore\Classes\Front     as Front,
FrontCore\Classes\Widgets   as Widgets,
FrontCore\Classes\Media     as Media,
FrontCore\Classes\Admin     as Admin,
FrontCore\Classes\Customize as Customize,
FrontCore\Classes\Vendor    as Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get the PHP version class.
require_once get_parent_theme_file_path( '/includes/classes/core/class-php-version.php' );

/**
 * PHP version check
 *
 * Disables theme front end if the minimum PHP version is not met.
 * Prevents breaking sites running older PHP versions.
 *
 * @since  1.0.0
 * @return void
 */
if ( ! Core\php()->version() && ! is_admin() ) {

	// Get the conditional message.
	$die = Core\php()->frontend_message();

	// Print the die message.
	die( $die );
}

/**
 * Get plugins path
 *
 * Used to check for active plugins with the `is_plugin_active` function.
 * Namespace escaped in example ( \ ) as it sometimes causes an error.
 *
 * @link https://developer.wordpress.org/reference/functions/is_plugin_active/
 *
 * @example The following would check for the Advanced Custom Fields plugin:
 *          ```
 *          if ( \is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
 *          	// Execute code.
 *           }
 *          ```
 */
$get_plugin = ABSPATH . 'wp-admin/includes/plugin.php';
if ( file_exists( $get_plugin ) ) {
	include_once( $get_plugin );
}

// Get theme configuration file.
require get_parent_theme_file_path( '/includes/config.php' );

// Autoload class files.
require_once FCT_PATH . 'includes/autoloader.php';

/**
 * Instantiate theme classes
 *
 * @since 1.0.0
 * @see   `includes/autoloader.php`
 */

// Activation classes.
$fct_activate   = new Classes\Activate\Activate;
$fct_deactivate = new Classes\Activate\Deactivate;

// Theme setup.
$fct_core_setup   = new Core\Setup;
$fct_core_assets  = new Core\Assets;
$fct_core_widgets = new Widgets\Register;
$fct_core_media   = new Media\Images;

// Vendor (plugin) classes.
$fct_acf = new Vendor\Theme_ACF;

// Frontend classes.
if ( ! is_admin() ) {
	$fct_head   = new Front\Head;
	$fct_tags   = new Front\Template_Tags;
	$fct_assets = new Front\Assets;
	$fct_layout = new Front\Layout;
}

// Backend classes.
if ( is_admin() ) {
	$fct_admin_pages  = new Admin\Admin_Pages;
	$fct_admin_assets = new Admin\Assets;
	if ( fct_has_blocks() ) {
		$fct_blocks = new Admin\Block_Editor;
	}
}

// Customizer classes.
if ( is_customize_preview() ) {
	$fct_customize = new Customize\Customizer;
}