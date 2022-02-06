<?php
/**
 * Class autoloader
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Core
 * @since      1.0.0
 */

namespace FrontCore;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class files
 *
 * Defines the class directories and file prefixes.
 *
 * @since 1.0.0
 * @var   array Defines an array of class file paths.
 */
define( 'FCT_CLASS', [
	'core'       => FCT_PATH . 'includes/classes/core/class-',
	'settings'   => FCT_PATH . 'includes/classes/settings/class-',
	'tools'      => FCT_PATH . 'includes/classes/tools/class-',
	'media'      => FCT_PATH . 'includes/classes/media/class-',
	'users'      => FCT_PATH . 'includes/classes/users/class-',
	'navigation' => FCT_PATH . 'includes/classes/navigation/class-',
	'widgets'    => FCT_PATH . 'includes/classes/widgets/class-',
	'vendor'     => FCT_PATH . 'includes/classes/vendor/class-',
	'admin'      => FCT_PATH . 'includes/classes/backend/class-',
	'front'      => FCT_PATH . 'includes/classes/frontend/class-',
	'customize'  => FCT_PATH . 'includes/classes/customizer/class-',
	'general'    => FCT_PATH . 'includes/classes/class-',
] );

/**
 * Classes namespace
 *
 * @since 1.0.0
 * @var   string Defines the namespace of class files.
 */
define( 'FCT_CLASS_NS', __NAMESPACE__ . '\Classes' );

/**
 * Array of classes to register
 *
 * When you add new classes to your version of this theme you may
 * add them to the following array rather than requiring the file
 * elsewhere. Be sure to include the precise namespace.
 *
 * SAMPLES: Uncomment sample classes to load them.
 *
 * @since 1.0.0
 * @var   array Defines an array of class files to register.
 */
define( 'FCT_CLASSES', [

	// Widgets classes.
	FCT_CLASS_NS . '\Widgets\Theme_Mode' => FCT_CLASS['widgets'] . 'theme-mode.php',

	// Vendor classes.
	FCT_CLASS_NS . '\Vendor\Plugin'    => FCT_CLASS['vendor'] . 'plugin.php',
	FCT_CLASS_NS . '\Vendor\Theme_ACF' => FCT_CLASS['vendor'] . 'theme-acf.php',
] );

/**
 * Autoload class files
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
spl_autoload_register(
	function ( string $class ) {
		if ( isset( FCT_CLASSES[ $class ] ) ) {
			require FCT_CLASSES[ $class ];
		}
	}
);
