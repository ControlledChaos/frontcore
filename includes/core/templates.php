<?php
/**
 * Page templates
 *
 * Make page templates available to select post types and page types.
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Setup
 * @since      1.0.0
 */

namespace FrontCore\Templates;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Execute functions
 *
 * Theme templates filter is dynamic, using a post type name.
 * @example `add_filter( 'theme_{$post_type}_templates', $ns( 'post_type_templates' ) );`
 *
 * @since  1.0.0
 * @return void
 */
function setup() {

	// Return namespaced function.
	$ns = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// Static front page templates.
	add_filter( 'default_page_template_title', $ns( 'front_page_default_template_title' ) );
	add_filter( 'theme_page_templates', $ns( 'front_page_templates' ) );

	// Post templates.
	add_filter( 'theme_post_templates', $ns( 'post_templates' ) );

	// Sample post type templates.
	add_filter( 'theme_sample_type_templates', $ns( 'sample_templates' ) );
}

/**
 * Front page templates
 *
 * Make select page templates available to the static front page.
 *
 * @since  1.0.0
 * @param  array $post_templates Array of available templates.
 * @return array Returns an array of templates for the front page.
 */
function front_page_default_template_title( $default_title ) {

	global $typenow;

	// Get the front page option.
	$front_show = (string) get_option( 'show_on_front' );
	$front_page = (int) get_option( 'page_on_front' );

	if ( 'page' == $typenow && 'page' == $front_show && get_the_ID() == $front_page ) {
		$default_title = __( 'Front Page Default', 'frontcore' );
	}
	return $default_title;
}

/**
 * Front page templates
 *
 * Make select page templates available to the static front page.
 *
 * @since  1.0.0
 * @param  array $post_templates Array of available templates.
 * @return array Returns an array of templates for the front page.
 */
function front_page_templates( $post_templates ) {

	// Stop here if version does not support post type templates.
	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		return;
	}

	global $typenow;

	// Get the front page option.
	$front_show = get_option( 'show_on_front' );
	$front_page = get_option( 'page_on_front' );

	if ( 'page' == $typenow && 'page' == $front_show && get_the_ID() == $front_page ) {

		// Unset general templates.
		unset( $post_templates[FCT_TMPL_DIR . '/no-sidebar.php'] );
		unset( $post_templates[FCT_TMPL_DIR . '/no-featured.php'] );
		unset( $post_templates[FCT_TMPL_DIR . '/no-sidebar-no-featured.php'] );

		// Set specific front page templates.
		$post_templates[FCT_TMPL_DIR . '/front-page-content-only.php'] = __( 'Front Page Content Only', 'frontcore' );
	}

	return $post_templates;
}

/**
 * Post templates
 *
 * Make select page templates available to the `post` post type.
 *
 * @since  1.0.0
 * @param  array $post_templates Array of available templates.
 * @return array Returns an array of templates for the post type.
 */
function post_templates( $post_templates ) {

	// Stop here if version does not support post type templates.
	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		return;
	}

	$post_templates[FCT_TMPL_DIR . '/no-sidebar.php']  = __( 'No Sidebar', 'frontcore' );
	$post_templates[FCT_TMPL_DIR . '/no-featured.php'] = __( 'No Featured Image', 'frontcore' );
	$post_templates[FCT_TMPL_DIR . '/no-sidebar-no-featured.php'] = __( 'No Sidebar, No Featured Image', 'frontcore' );

	return $post_templates;
}

/**
 * Sample post type templates
 *
 * Make select page templates available to the `sample_type` post type.
 *
 * This method is not only for demonstration in itself, it corresponds
 * with the sample post type in this theme's companion plugin boilerplate.
 *
 * @since  1.0.0
 * @param  array $post_templates Array of available templates.
 * @return array Returns an array of templates for the post type.
 */
function sample_templates( $post_templates ) {

	// Stop here if version does not support post type templates.
	if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
		return;
	}

	$post_templates[FCT_TMPL_DIR . '/no-sidebar.php']  = __( 'No Sidebar', 'frontcore' );
	$post_templates[FCT_TMPL_DIR . '/no-featured.php'] = __( 'No Featured Image', 'frontcore' );
	$post_templates[FCT_TMPL_DIR . '/no-sidebar-no-featured.php'] = __( 'No Sidebar, No Featured Image', 'frontcore' );

	return $post_templates;
}
