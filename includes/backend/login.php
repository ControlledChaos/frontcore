<?php
/**
 * Login page
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Login;

// Alias namespaces.
use FrontCore\Customize as Customize;

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

	add_action( 'login_head', $ns( 'background_styles' ), 11 );
}

/**
 * Background_image
 *
 * Gets theme mods, if any, for the site
 * background image to be applied to
 * the login screen.
 *
 * @since  1.0.0
 * @return array Returns an array of theme mods.
 */
function background_image() {

	$image  = get_theme_mod( 'background_image' );
	$repeat = get_theme_mod( 'background_repeat' );
	$pos_x  = get_theme_mod( 'background_position_x' );
	$pos_y  = get_theme_mod( 'background_position_y' );
	$size   = get_theme_mod( 'background_size' );
	$attach = get_theme_mod( 'background_attachment' );

	$styles = [
		'image'  => $image,
		'repeat' => $repeat,
		'pos_x'  => $pos_x,
		'pos_y'  => $pos_y,
		'size'   => $size,
		'attach' => $attach
	];

	return $styles;
}

/**
 * Background styles
 *
 * Applies background styles from the
 * customizer to the login screen.
 *
 * @since  1.0.0
 * @return void
 */
function background_styles() {

	// Use styles from the customizer or not.
	$use_styles = Customize\use_login_bg_styles( get_theme_mod( 'fct_login_bg_styles' ) );
	if ( ! $use_styles ) {
		return;
	}

	$color  = get_theme_mod( 'background_color' );
	$image  = background_image();
	$styles = '<style>.login {';

	if ( $color ) {
		$styles .= sprintf(
			'background-color: #%s;',
			$color
		);
	}

	if ( $image['image'] ) {
		$styles .= sprintf(
			'background-image: url("%s");',
			$image['image']
		);
		$styles .= sprintf(
			'background-repeat: %s;',
			$image['repeat']
		);
		$styles .= sprintf(
			'background-size: %s;',
			$image['size']
		);
		$styles .= sprintf(
			'background-position: %s %s;',
			$image['pos_x'],
			$image['pos_y']
		);
		$styles .= sprintf(
			'background-attachment: %s;',
			$image['attach']
		);
	}
	$styles .= '}</style>';

	echo $styles;
}
