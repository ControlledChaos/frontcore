<?php
/**
 * Frontend assets
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Assets
 * @since      1.0.0
 */

namespace FrontCore\Front_Assets;

use function FrontCore\Shared_Assets\suffix;

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

	// Frontend scripts.
	add_action( 'wp_enqueue_scripts', $ns( 'frontend_scripts' ) );

	// Frontend styles.
	add_action( 'wp_enqueue_scripts', $ns( 'frontend_styles' ) );

	// Print footer scripts.
	add_action( 'wp_footer', $ns( 'print_scripts' ) );
}

/**
 * Frontend scripts
 *
 * @since  1.0.0
 * @return void
 */
function frontend_scripts() {

	// Enqueue jQuery.
	wp_enqueue_script( 'jquery' );

	// Navigation toggle and dropdown.
	wp_enqueue_script( 'fct-navigation', get_theme_file_uri( '/assets/js/navigation' . suffix() . '.js' ), [], FCT_VERSION, true );

	// Skip link focus, for accessibility.
	wp_enqueue_script( 'fct-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix' . suffix() . '.js' ), [], FCT_VERSION, true );

	// FitVids for responsive video embeds.
	wp_enqueue_script( 'fct-fitvids', get_theme_file_uri( '/assets/js/jquery.fitvids' . suffix() . '.js' ), [ 'jquery' ], FCT_VERSION, true );
	wp_add_inline_script( 'fct-fitvids', 'jQuery(document).ready(function($){ $( ".entry-content" ).fitVids(); });', true );

	// Comments scripts.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Frontend styles
 *
 * @since  1.0.0
 * @return void
 */
function frontend_styles() {

	// Google fonts.
	// wp_enqueue_style( 'fct-google-fonts', 'add-url-here', [], FCT_VERSION, 'screen' );

	/**
	 * Theme stylesheet
	 *
	 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
	 * The main stylesheet, in the root directory, only contains the theme header but
	 * it is necessary for theme activation. DO NOT delete the main stylesheet!
	 */
	wp_enqueue_style( 'fct-theme', get_theme_file_uri( '/assets/css/style' . suffix() . '.css' ), [], FCT_VERSION, 'all' );

	// Right-to-left languages.
	if ( is_rtl() ) {
		wp_enqueue_style( 'fct-theme-rtl', get_theme_file_uri( '/assets/css/style-rtl' . suffix() . '.css' ), [ 'fct-theme' ], FCT_VERSION, 'all' );
	}

	// Block styles.
	if ( function_exists( 'has_blocks' ) ) {
		wp_enqueue_style( 'fct-blocks', get_theme_file_uri( '/assets/css/blocks' . suffix() . '.css' ), [ 'wp-block-library', 'fct-theme' ], FCT_VERSION, 'all' );

		if ( is_rtl() ) {
			wp_enqueue_style( 'fct-blocks-rtl', get_theme_file_uri( '/assets/css/blocks-rtl' . suffix() . '.css' ), [ 'fct-blocks' ], FCT_VERSION, 'all' );
		}
	}

	// Print styles.
	wp_enqueue_style( 'fct-print', get_theme_file_uri( '/assets/css/print' . suffix() . '.css' ), [], FCT_VERSION, 'print' );
}

/**
 * Print footer scripts
 *
 * @since  1.0.0
 * @return void
 */
function print_scripts() {

	?>
	<script>
	// Reveal body element once DOM is loaded.
	jQuery(document).ready( function ($) {
		$( 'body' ).css( 'visibility', 'visible' );
	});
	</script>
	<?php
}
