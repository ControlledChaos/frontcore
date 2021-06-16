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
	'core'      => FCT_PATH . 'includes/classes/core/class-',
	'settings'  => FCT_PATH . 'includes/classes/settings/class-',
	'tools'     => FCT_PATH . 'includes/classes/tools/class-',
	'media'     => FCT_PATH . 'includes/classes/media/class-',
	'users'     => FCT_PATH . 'includes/classes/users/class-',
	'widgets'   => FCT_PATH . 'includes/classes/widgets/class-',
	'vendor'    => FCT_PATH . 'includes/classes/vendor/class-',
	'admin'     => FCT_PATH . 'includes/classes/backend/class-',
	'front'     => FCT_PATH . 'includes/classes/frontend/class-',
	'customize' => FCT_PATH . 'includes/classes/customizer/class-',
	'general'   => FCT_PATH . 'includes/classes/class-',
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

	// Core classes.
	FCT_CLASS_NS . '\Core\Assets' => FCT_CLASS['core'] . 'assets.php',
	FCT_CLASS_NS . '\Core\Setup'  => FCT_CLASS['core'] . 'setup.php',

	// Widgets classes.
	FCT_CLASS_NS . '\Widgets\Register'   => FCT_CLASS['widgets'] . 'register.php',
	FCT_CLASS_NS . '\Widgets\Theme_Mode' => FCT_CLASS['widgets'] . 'theme-mode.php',

	// Media classes.
	FCT_CLASS_NS . '\Media\Images' => FCT_CLASS['media'] . 'images.php',

	// Frontend classes.
	FCT_CLASS_NS . '\Front\Head'          => FCT_CLASS['front'] . 'head.php',
	FCT_CLASS_NS . '\Front\Template_Tags' => FCT_CLASS['front'] . 'template-tags.php',
	FCT_CLASS_NS . '\Front\Assets'        => FCT_CLASS['front'] . 'assets.php',
	FCT_CLASS_NS . '\Front\Layout'        => FCT_CLASS['front'] . 'layout.php',

	// Backend classes.
	FCT_CLASS_NS . '\Admin\Admin_Menu'   => FCT_CLASS['admin'] . 'admin-menu.php',
	FCT_CLASS_NS . '\Admin\Admin_Pages'  => FCT_CLASS['admin'] . 'admin-pages.php',
	FCT_CLASS_NS . '\Admin\Assets'       => FCT_CLASS['admin'] . 'assets.php',
	FCT_CLASS_NS . '\Admin\Block_Editor' => FCT_CLASS['admin'] . 'block-editor.php',

	// Customizer classes.
	FCT_CLASS_NS . '\Customize\Customizer' => FCT_CLASS['customize'] . 'customizer.php',
	FCT_CLASS_NS . '\Customize\Sanitize'   => FCT_CLASS['customize'] . 'sanitize.php',

	// Vendor classes.
	FCT_CLASS_NS . '\Vendor\Plugin'    => FCT_CLASS['vendor'] . 'plugin.php',
	FCT_CLASS_NS . '\Vendor\Theme_ACF' => FCT_CLASS['vendor'] . 'theme-acf.php',

	// General/miscellaneous classes.
	FCT_CLASS_NS . '\Activate\Activate'   => FCT_CLASS['general'] . 'activate.php',
	FCT_CLASS_NS . '\Activate\Deactivate' => FCT_CLASS['general'] . 'deactivate.php',

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
