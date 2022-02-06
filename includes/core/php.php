<?php
/**
 * Check PHP version
 *
 * Operations contingent on the version of PHP used
 * on the theme's server, notably disable functionality
 * if the minimum version is not met.
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Core
 * @since      1.0.0
 */

namespace FrontCore\PHP;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Minimum PHP version
 *
 * @since  1.0.0
 * @access public
 * @return self
 */
function minimum() {
	return FCT_PHP_VERSION;
}

/**
 * Version compare
 *
 * @since  1.0.0
 * @access public
 * @return boolean Returns true if the minimum is met.
 */
function version() {

	// Compare versions.
	if ( version_compare( phpversion(), minimum(), '<' ) ) {

		// Return false if the minimum is not met.
		return false;
	}

	// Return true by default.
	return true;
}

/**
 * Frontend message
 *
 * Conditional message displayed on the front end if
 * the minimum PHP version is not met.
 *
 * @since  1.0.0
 * @access public
 * @return string Returns the markup of the message.
 */
function frontend_message() {

	/**
	 * Constant: Templates directory
	 *
	 * @since 1.0.0
	 * @var   string File path without trailing slash.
	 */
	$templates_dir = 'templates';
	if ( ! defined( 'FCT_TMPL_DIR' ) ) {
		define( 'FCT_TMPL_DIR', $templates_dir );
	}

	/**
	 * Constant: Template partials directory
	 *
	 * @since 1.0.0
	 * @var   string File path without trailing slash.
	 */
	$parts_dir = FCT_TMPL_DIR . '/template-parts';
	if ( ! defined( 'FCT_PARTS_DIR' ) ) {
		define( 'FCT_PARTS_DIR', $parts_dir );
	}

	// Look first for a message template file.
	$template = get_theme_file_path( FCT_PARTS_DIR . '/partials/frontend-php-message.php' );
	if ( file_exists( $template ) ) {
		$html = get_template_part( FCT_PARTS_DIR . '/partials/frontend-php-message' );
	}

	// Message if the user is logged in and can switch themes.
	elseif ( is_user_logged_in() && current_user_can( 'switch_themes' ) ) {

		$html = sprintf(
			'<h1>%s</h1>',
			__( 'Theme Disabled', 'frontcore' )
		);

		$html .= sprintf(
			__( '<p>The active theme has been disabled because the minimum PHP version of <strong>%s</strong> has not been met. Go to the <a href="%s">%s</a> to activate another theme.</p>', 'frontcore' ),
			minimum(),
			esc_attr( esc_url( self_admin_url( 'themes.php' ) ) ),
			__( 'themes page', 'frontcore' )
		);

	// Message for users who do not meet the conditions above.
	} else {

		$html = sprintf(
			'<h1>%s</h1>',
			__( 'Down for Maintenance', 'frontcore' )
		);

		$html .= sprintf(
			__( '<p>The %s website is down for maintenance. Please check back soon!.</p>', 'frontcore' ),
			get_bloginfo( 'name' )
		);
	}

	// Return the message output.
	return $html;
}
