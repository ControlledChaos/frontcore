<?php
/**
 * Admin pages
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Admin;

// Alias namespaces.
use FrontCore\Customize as Customize;

use function FrontCore\Layout\navigation_main;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Execute functions
 *
 * @since  1.0.0
 * @return void
 */
function setup() {

	// Return namespaced function.
	$ns = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	/**
	 * Add admin header
	 *
	 * Not hooked to `in_admin_header` because the screen options
	 * and contextual help buttons/sections need to load first.
	 *
	 * Add early to the relevant hook in attempt to display
	 * above any admin notices.
	 */
	if ( is_network_admin() ) {
		$hook = 'network_admin_notices';
	} elseif ( is_user_admin() ) {
		$hook = 'user_admin_notices';
	} else {
		$hook = 'admin_notices';
	}

	// Register admin navigation menu and add to theme location.
	if ( use_admin_header() ) {
		add_action( 'FrontCore\site_branding_wrap_class', $ns( 'site_branding_wrap_class' ) );
		add_action( 'after_setup_theme', 'FrontCore\Navigation\register_admin' );
		add_action( 'after_setup_theme', $ns( 'admin_menu_location' ) );
	}

	// Add the admin page header, if option set.
	add_action( $hook, $ns( 'admin_header' ), 1 );

	// Add body classes.
	add_filter( 'admin_body_class', $ns( 'admin_body_class' ) );

	// Appearance submenu items.
	add_action( 'admin_menu', $ns( 'appearance_menu' ) );

	// Theme options page.
	add_action( 'admin_menu', $ns( 'theme_options' ) );

	// Theme info page.
	add_action( 'admin_menu', $ns( 'theme_info' ) );

	// Custom admin color schemes.
	add_action( 'admin_init' , $ns( 'admin_color_schemes' ), 1 );
}

/**
 * Use admin header
 *
 * Whether to use the admin page header.
 *
 * @since  1.0.0
 * @return boolean Returns true if the customizer option
 *                 to use the admin page header is true.
 */
function use_admin_header() {

	$header = Customize\use_admin_header( get_theme_mod( 'fct_admin_header' ) );
	$use    = false;

	if ( $header ) {
		$use = true;
	}
	return $use;
}

/**
 * Admin menu location
 *
 * Adds the admin nav menu to a theme location.
 *
 * @since  1.0.0
 * @return void
 */
function admin_menu_location() {

	// Get the navigation location setting from the Customizer.
	$location = Customize\nav_location( get_theme_mod( 'fct_nav_location' ) );

	// Conditional location hook.
	if ( 'before' == $location ) {
		$action = 'FrontCore\nav_before_header';
	} elseif ( 'after' == $location ) {
		$action = 'FrontCore\nav_after_header';
	} else {
		$action = 'FrontCore\nav_aside_branding';
	}

	// Add the menu to the hook.
	add_action( $action, __NAMESPACE__ . '\get_admin_menu' );
}

/**
 * Site branding wrap class
 *
 * @since  1.0.0
 * @return string Returns the class(es) added.
 */
function site_branding_wrap_class() {

	// Get the navigation location setting from the Customizer.
	$location = Customize\nav_location( get_theme_mod( 'fct_nav_location' ) );
	$classes  = '';

	if ( 'aside' == $location ) {
		$classes = ' nav-aside-branding';
	}
	echo $classes;
}

/**
 * Get admin menu
 *
 * Gets the admin navigation template part.
 *
 * @since  1.0.0
 * @return void
 */
function get_admin_menu() {
	get_template_part( FCT_PARTS_DIR . '/navigation/navigation-admin' );
}

/**
 * Admin header
 *
 * Gets the admin header template part.
 *
 * @since  1.0.0
 * @return void
 */
function admin_header() {

	if ( use_admin_header() ) {
		get_template_part( FCT_PARTS_DIR . '/admin/admin-header' );
	}
}

/**
 * Admin body classes
 *
 * @since  1.0.0
 * @param  array $body_class Array of body classes.
 * @return array Return the conditionally modified array of body classes.
 */
function admin_body_class( $body_class ) {

	// Get Customizer settings.
	$use_theme  = Customize\use_admin_theme( get_theme_mod( 'fct_admin_theme' ) );
	$use_header = Customize\use_admin_header( get_theme_mod( 'fct_admin_header' ) );

	if ( $use_theme ) {
		$body_class .= ' fct-admin-theme';
	}

	if ( $use_header ) {
		$body_class .= ' has-admin-header';
	}

	return $body_class;
}

/**
 * Appearance submenu items
 *
 * @since  1.0.0
 * @global array menu The admin menu array.
 * @global array submenu The admin submenu array.
 * @return void
 */
function appearance_menu() {

	// Access global variables.
	global $menu, $submenu;

	// Customizer link position.
	if ( function_exists( 'wp_is_block_theme' ) ) {
		if ( wp_is_block_theme() || ( ! wp_is_block_theme() || has_action( 'customize_register' ) ) ) {
			if ( wp_is_block_theme() || current_theme_supports( 'block-template-parts' ) ) {
				$customize_position = 7;
			} else {
				$customize_position = 6;
			}
		}
	} elseif ( has_action( 'customize_register' ) ) {
		$customize_position = 6;
	}

	if ( isset( $submenu['themes.php'] ) ) {

		// Look for menu items under Appearances.
		foreach ( $submenu['themes.php'] as $key => $item ) {

			if ( current_user_can( 'customize' ) ) {
				unset( $submenu['themes.php'][ $customize_position ] );
			}

			if ( current_theme_supports( 'custom-header' ) && current_user_can( 'customize' ) ) {
				unset( $submenu['themes.php'][15] );
			}

			if ( current_theme_supports( 'custom-background' ) && current_user_can( 'customize' ) ) {
				unset( $submenu['themes.php'][20] );
			}
		}
	}

	$customize_url = add_query_arg(
		'return',
		urlencode(
			remove_query_arg(
				wp_removable_query_args(),
				wp_unslash( $_SERVER['REQUEST_URI'] )
			)
		),
		'customize.php'
	);

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

/**
 * Theme options page
 *
 * @since  1.0.0
 * @return void
 */
function theme_options() {

	// Add a submenu page under Themes.
	$help_theme_options = add_submenu_page(
		'themes.php',
		__( 'Display Options', 'frontcore' ),
		__( 'Display Options', 'frontcore' ),
		'manage_options',
		'frontend-display-options',
		__NAMESPACE__ . '\\theme_options_output',
		1
	);

	// Add sample help tab.
	add_action( "load-{$help_theme_options}", __NAMESPACE__ . '\\help_theme_options' );
}

/**
 * Get output of the theme options page
 *
 * @since  1.0.0
 * @return void
 */
function theme_options_output() {
	get_template_part( FCT_PARTS_DIR . '/admin/theme-options-page' );
}

/**
 * Add tabs to the about page contextual help section
 *
 * @since  1.0.0
 * @return void
 */
function help_theme_options() {

	// Add to the about page.
	$screen = get_current_screen();

	// More information tab.
	$screen->add_help_tab( [
		'id'       => 'help_theme_options_info',
		'title'    => __( 'More Information', 'frontcore' ),
		'content'  => null,
		'callback' => __NAMESPACE__ . '\\help_theme_options_info'
	] );

	// Add a help sidebar.
	$screen->set_help_sidebar(
		help_theme_options_sidebar()
	);
}

/**
 * Get theme options help tab content
 *
 * @since  1.0.0
 * @return void
 */
function help_theme_options_info() {
	include_once get_theme_file_path( FCT_PARTS_DIR . '/partials/help-theme-options-info.php' );
}

/**
 * The about page contextual tab sidebar content
 *
 * @since  1.0.0
 * @return string Returns the HTML of the sidebar content.
 */
function help_theme_options_sidebar() {

	$html  = sprintf( '<h4>%1s</h4>', __( 'Author Credits', 'frontcore' ) );
	$html .= sprintf(
		'<p>%1s %2s.</p>',
		__( 'This theme was created by', 'frontcore' ),
		'Your Name'
	);
	$html .= sprintf(
		'<p>%1s <br /><a href="%2s" target="_blank" rel="nofollow">%3s</a> <br />%4s</p>',
		__( 'Visit', 'frontcore' ),
		'https://example.com/',
		'Example Site',
		__( 'for more details.', 'frontcore' )
	);
	$html .= sprintf(
		'<p>%1s</p>',
		__( 'Change this sidebar to give yourself credit for the hard work you did customizing this theme.', 'frontcore' )
		);

	return $html;
}

/**
 * Theme info page
 *
 * @since  1.0.0
 * @return void
 */
function theme_info() {

	// Add a submenu page under Themes.
	add_submenu_page(
		'themes.php',
		__( 'Theme Info', 'frontcore' ),
		__( 'Theme Info', 'frontcore' ),
		'manage_options',
		'frontcore-info',
		__NAMESPACE__ . '\\theme_info_output',
		2
	);
}

/**
 * Get output of the theme info page
 *
 * @since  1.0.0
 * @return void
 */
function theme_info_output() {

	$output = get_theme_file_path( FCT_PARTS_DIR . '/admin/theme-info-page.php' );
	if ( file_exists( $output ) ) {
		include $output;
	} else { ?>
		<div class="wrap theme-info-page">
			<h1><?php _e( 'Template Error', 'frontcore' ); ?></h1>
			<p class="description"><?php _e( 'The template file for this page was not located.' ); ?></p>
		</div>
	<?php }
}

/**
 * Custom admin color schemes
 *
 * @since  1.0.0
 * @return void
 */
function admin_color_schemes() {

	if ( is_rtl() ) {
		$suffix = '-rtl';
	} else {
		$suffix = '';
	}

	wp_admin_css_color( 'fct_avocado', __( 'Avocado', 'frontcore' ),
		get_theme_file_uri( "/assets/css/admin-color-schemes/avocado/colors$suffix.min.css" ),
		[ '#2d4200', '#557d00', '#94ba0b', '#7d4722' ],
		[ 'base' => '#3c3c3c', 'focus' => '#666666', 'current' => '#999999' ]
	);
}
