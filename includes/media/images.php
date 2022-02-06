<?php
/**
 * Images and galleries
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Media
 * @since      1.0.0
 */

namespace FrontCore\Images;

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

	// Stop adding inline styles to figure element.
	add_filter( 'img_caption_shortcode_width', '__return_false' );

	// Add image sizes.
	add_action( 'after_setup_theme', $ns( 'image_sizes' ) );

	// Add image sizes to insert media UI.
	add_filter( 'image_size_names_choose', $ns( 'insert_image_sizes' ) );
}

/**
 * Add image sizes
 *
 * @since  1.0.0
 * @return void
 */
function image_sizes() {

	// Thumbnail size.
	update_option( 'thumbnail_size_w', 160 );
	update_option( 'thumbnail_size_h', 160 );
	update_option( 'thumbnail_crop', 1 );

	// Medium size.
	update_option( 'medium_size_w', 320 );
	update_option( 'medium_size_h', 240 );
	update_option( 'medium_crop', 1 );

	// Medium-large size.
	update_option( 'medium_large_size_w', 480 );
	update_option( 'medium_large_size_h', 360 );

	// Large size.
	update_option( 'large_size_w', 640 );
	update_option( 'large_size_h', 480 );
	update_option( 'large_crop', 1 );

	// Set the post thumbnail size, 16:9 HD Video.
	set_post_thumbnail_size( 1280, 720, [ 'center', 'center' ] );

	// Add wide image support for the block editor.
	add_theme_support( 'align-wide' );

	/**
	 * Add image sizes
	 *
	 * Three sizes per aspect ratio so that srcset
	 * will be used for responsive images.
	 *
	 * @since 1.0.0
	 */
	$center = [
		'center',
		'center'
	];

	// 1:1 square.
	add_image_size( 'large-thumbnail', 240, 240, $center );
	add_image_size( 'x-large-thumbnail', 320, 320, $center );

	// 16:9 HD Video.
	add_image_size( 'large-video', 1280, 720, $center );
	add_image_size( 'medium-video', 960, 540, $center );
	add_image_size( 'small-video', 640, 360, $center );

	// 21:9 Cinemascope.
	add_image_size( 'large-banner', 1280, 549, $center );
	add_image_size( 'medium-banner', 960, 411, $center );
	add_image_size( 'small-banner', 640, 274, $center );
}

/**
 * Add image sizes to media UI
 *
 * Adds custom image sizes to "Insert Media" user interface
 * and adds custom class to the `<img>` tag.
 *
 * @since  1.0.0
 * @param  array $sizes Gets the array of image size names.
 * @global array $_wp_additional_image_sizes Gets the array of custom image size names.
 * @return array $sizes Returns an array of image size names.
 */
function insert_image_sizes( $sizes ) {

	// Access global variables.
	global $_wp_additional_image_sizes;

	// Return default sizes if no custom sizes.
	if ( empty( $_wp_additional_image_sizes ) ) {
		return $sizes;
	}

	// Capitalize custom image size names and remove hyphens.
	foreach ( $_wp_additional_image_sizes as $id => $data ) {

		if ( ! isset( $sizes[$id] ) ) {
			$sizes[$id] = ucwords( str_replace( '-', ' ', $id ) );
		}
	}

	// Return the modified array of sizes.
	return $sizes;
}
