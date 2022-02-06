<?php
/**
 * Frontend head section
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Frontend
 * @since      1.0.0
 */

namespace FrontCore\Head;

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

	// Remove unpopular meta tags.
	add_action( 'init', $ns( 'head_cleanup' ) );

	// Pingback header.
	add_action( 'wp_head', $ns( 'pingback_header' ) );

	// Swap html 'no-js' class with 'js'.
	add_action( 'wp_head', $ns( 'js_detect' ), 0 );

	// Disable emoji script.
	add_action( 'init', $ns( 'disable_emojis' ) );

	// Load the `<head>` section.
	add_action( 'FrontCore\head', $ns( 'head' ) );
}

/**
 * Clean up meta tags from the <head>
 *
 * @since  1.0.0
 * @return void
 */
function head_cleanup() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
}

/**
 * Pingback header
 *
 * Add a pingback URL auto-discovery header for single posts, pages, or attachments.
 *
 * @since  1.0.0
 * @return string Returns the link element in '<head>`.
 */
function pingback_header() {

	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

/**
 * JS Replace
 *
 * Replaces 'no-js' class with 'js' in the <html> element
 * when JavaScript is detected.
 *
 * @since  1.0.0
 * @return string
 */
function js_detect() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

/**
 * Disable emoji script
 *
 * Emojis will still work in modern browsers. This removes the script
 * that makes emojis work in old browsers.
 *
 * @since  1.0.0
 * @return void
 */
function disable_emojis() {
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
}

/**
 * Load the `<head>` section
 *
 * @since  1.0.0
 * @return void
 */
function head() {
	include get_theme_file_path( FCT_PARTS_DIR . '/header/head.php' );
}
