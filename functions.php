<?php
/**
 * Front Core functions
 *
 * Develop site-specific themes for ClassicPress, WordPress, and the antibrand system.
 *
 * @package    Front_Core
 * @subpackage Functions
 * @since      1.0.0
 * @link       https://github.com/ControlledChaos/frontcore
 */

/**
 * License & Warranty
 *
 * Front Core is free software. It can be redistributed and/or modified
 * ad libidum. There is no license distributed with this product.
 *
 * Front Core is distributed WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @see DISCLAIMER.md
 */

/**
 * Author's Note
 *
 * To all who may read this,
 *
 * I hope you find this code to be easily deciphered. I have
 * learned much by examining the code of well written & well
 * documented products so I have done my best to document this
 * code with comments where necessary, even where not necessary,
 * and by using logical, descriptive names for PHP classes &
 * methods, HTML IDs, CSS classes, etc.
 *
 * Beginners, note that the short array syntax ( `[]` rather than
 * `array()` ) is used. Use of the `array()` function is encouraged
 * by some to make the code more easily read by beginners. I argue
 * that beginners will inevitably encounter the short array syntax
 * so they may as well learn to recognize this early. If the code
 * is well documented then it will be clear when the brackets (`[]`)
 * represent an array. And someday you too will be writing many
 * arrays in your code and you will find the short syntax to be
 * a time saver. Let's not unnecessarily dumb-down code; y'all
 * are smart folk if you are reading this and you'll figure it out
 * like I did.
 *
 * Greg Sweet, Controlled Chaos Design, former mule packer, cook,
 * landscaper, & janitor who learned PHP by breaking stuff and by
 * reading code comments.
 */

/**
 * Author's Note #2
 *
 * This is a note to myself as much as to anyone who may read this.
 * This product is a starter for my project or yours. It may contain
 * tools ( methods/functions, hooks, scripts ) that can speed up
 * development a bit but this cannot be flexible in layout and
 * templates and still remain a starter for a site-specific product.
 *
 * There are kitchen-sink options available but they are not the
 * right choice and they so often need a child theme to get your
 * preferred template layout. So if I or you are going to write
 * new templates anyway we may as well start here with our own
 * parent theme, then create our own child themes for variation.
 */

 /**
 * Renaming, rebranding, and defaults
 *
 * Following is a list of strings to find and replace in all theme files.
 *
 * 1. Theme Name
 *    Find `Front Core` and replace with your theme name
 *
 * 2. Package
 *    Find `Front_Core` and replace with your theme name. This will
 *    change the package name in file headers.
 *
 * 3. Namespace
 *    Find `FrontCore` and replace with something unique to your theme.
 *
 * 4. Text domain
 *    Find `frontcore` and replace with the text domain of your theme.
 *
 * 5. Theme prefix
 *    Find `fct` and replace with the unique, lowercase theme prefix.
 *    This prefix is used for applied filters, stylesheet IDs, and
 *    admin page URIs, so the prefix may be followed by an underscore
 *    or a dash. Search for `fct_` and `fct-` to find the difference.
 *
 * 6. Constant prefix
 *    Find `FCT` and replace with the unique, uppercase prefix of your theme.
 *
 * 7. Header image
 *    Replace the default image file `default-header.jpg`.
 *    @see assets/images/
 *
 * 8. Activation and deactivation
 *    Check the activation and deactivation classes for sample methods.
 *    Remove or modify the samples as needed.
 *    @see includes/class-activate
 *    @see includes/class-deactivate
 *
 * 9. README file
 *    Whether or not your theme will be kept in a version control repository,
 *    edit the content of the README file in the theme's root directory or
 *    delete it if it is not necessary.
 */

namespace FrontCore;

// Alias namespaces.
use
FrontCore\Classes        as General,
FrontCore\Classes\Core   as Core,
FrontCore\Classes\Front  as Front,
FrontCore\Classes\Admin  as Admin_Class,
FrontCore\Classes\Vendor as Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
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

// Get the PHP version class.
require_once get_parent_theme_file_path( '/includes/php.php' );

/**
 * PHP version check
 *
 * Disables theme front end if the minimum PHP version is not met.
 * Prevents breaking sites running older PHP versions.
 *
 * @since  1.0.0
 * @return void
 */
if ( ! PHP\version() && ! is_admin() ) {

	// Get the conditional message.
	$die = PHP\frontend_message();

	// Print the die message.
	die( $die );
}

// Autoload class files.
require_once FCT_PATH . 'includes/autoloader.php';

// Get compatibility functions.
require FCT_PATH . 'includes/vendor/compatibility.php';

// Load required files.
foreach ( glob( FCT_PATH . 'includes/activate/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( FCT_PATH . 'includes/core/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( FCT_PATH . 'includes/media/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( FCT_PATH . 'includes/navigation/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( FCT_PATH . 'includes/widgets/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( FCT_PATH . 'includes/customize/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( FCT_PATH . 'includes/frontend/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( FCT_PATH . 'includes/backend/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( FCT_PATH . 'includes/users/*.php' ) as $filename ) {
	require $filename;
}
foreach ( glob( FCT_PATH . 'includes/assets/*.php' ) as $filename ) {
	require $filename;
}

// Theme activation and deactivation.
Activate\setup();
Deactivate\setup();

// Theme setup.
Theme\setup();
Templates\setup();
Shared_Assets\setup();
Navigation\setup();
Widgets\setup();
Images\setup();

// Vendor (plugin) classes.
$fct_acf = new Vendor\Theme_ACF;

// ACF filters.
if ( $fct_acf->use_bundled() || class_exists( 'acf' ) ) {
	$fct_acf->filters();
}

// Frontend classes.
if ( ! is_admin() ) {
	Head\setup();
	Tags\setup();
	Front_Assets\setup();
	Layout\setup();
	Comments\setup();
}

// Backend classes.
if ( is_admin() ) {
	Admin\setup();
	Post_Options\setup();
	Admin_Assets\setup();
	Editors\setup();
}

Customize\setup();
