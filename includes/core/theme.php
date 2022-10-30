<?php
/**
 * Theme setup
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Core
 * @since      1.0.0
 */

namespace FrontCore\Theme;

use function FrontCore\Shared_Assets\suffix;

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

	// Theme setup.
	add_action( 'after_setup_theme', $ns( 'setup_theme' ) );

	// Post format templates.
	add_filter( 'template_include', $ns( 'post_format_templates' ) );

	// jQuery UI fallback for HTML5 Contact Form 7 form fields.
	add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

	// Remove WooCommerce styles.
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	// Login title.
	add_filter( 'login_headertext', $ns( 'login_title' ) );

	// Login URL.
	add_filter( 'login_headerurl', $ns( 'login_url' ) );

	// User color scheme classes.
	add_filter( 'body_class', $ns( 'color_scheme_classes' ) );

	// Append blog excerpts.
	add_filter( 'excerpt_more', $ns( 'excerpt_more_auto' ) );
	add_filter( 'get_the_excerpt', $ns( 'excerpt_more_manual' ) );
}

/**
 * Theme setup
 *
 * @since  1.0.0
 * @return void
 */
function setup_theme() {

	// Load domain for translation.
	load_theme_textdomain( 'frontcore' );

	// Browser title tag support.
	add_theme_support( 'title-tag' );

	// Core block visual styles.
	add_theme_support( 'wp-block-styles' );

	// Background color & image support.
	add_theme_support( 'custom-background' );

	// Responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// RSS feed links support.
	add_theme_support( 'automatic-feed-links' );

	// HTML 5 tags support.
	add_theme_support( 'html5', [
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
		'style',
		'script'
		] );

	// Post format support.
	add_theme_support( 'post-formats', [
		'aside',
		'image',
		'video',
		'audio',
		'link',
		'quote',
		'status',
		'chat'
	 ] );

	// Refresh widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Featured image support.
	add_theme_support( 'post-thumbnails' );

	/**
	 * Default header images
	 *
	 * These appear in the customizer as "Suggested" images.
	 * If no header image is set then the `default-header.jpg`
	 * image in the `assets/images` directory is used.
	 */
	$default_headers = apply_filters( 'fct_default_headers', [
		'avocado_green' => [
			'url'           => '%s/assets/images/avocado-green.jpg',
			'thumbnail_url' => '%s/assets/images/avocado-green.jpg',
			'description'   => __( 'Green Avocado', 'frontcore' ),
		],
		'avocado_blue' => [
			'url'           => '%s/assets/images/avocado-blue.jpg',
			'thumbnail_url' => '%s/assets/images/avocado-blue.jpg',
			'description'   => __( 'Blue Avocado', 'frontcore' ),
		],
		'avocado_violet' => [
			'url'           => '%s/assets/images/avocado-violet.jpg',
			'thumbnail_url' => '%s/assets/images/avocado-violet.jpg',
			'description'   => __( 'Violet Avocado', 'frontcore' ),
		]
	] );
	$headers = register_default_headers( $default_headers );

	// Add header support.
	add_theme_support( 'custom-header', apply_filters( 'fct_custom_header', [
		'width'              => 2048,
		'height'             => 878,
		'flex-height'        => true,
		'default-image'      => $headers,
		'video'              => false,
		'wp-head-callback'   => __NAMESPACE__ . '\\header_style'
	] ) );

	// Add logo support.
	add_theme_support( 'custom-logo', apply_filters( 'fct_custom_logo', [
		'width'       => 160,
		'height'      => 160,
		'flex-width'  => true,
		'flex-height' => true
	] ) );

	// Set content width.
	if ( ! isset( $content_width ) ) {
		$content_width = apply_filters( 'fct_content_width', 1280 );
	}

	// Embed sizes.
	$embed = apply_filters( 'fct_embed_size', [
		'embed_size_w' => 1280,
		'embed_size_h' => 720
	] );
	update_option( 'embed_size_w', $embed['embed_size_w'] );
	update_option( 'embed_size_h', $embed['embed_size_h'] );

	// Add stylesheet for the content editor.
	add_editor_style( 'assets/css/editor' . suffix() . '.css', [ 'fct-admin' ], '', 'screen' );
}

/**
 * Page template check
 *
 * Return true if page template is being used.
 * Works in the back end.
 *
 * @since  1.0.0
 * @param  string $page_template The filename of the template to check against.
 *                               Example: FCT_TMPL_DIR . '/abc-123.php'.
 * @global object $post
 * @return bool Returns true if the page template is being used.
 */
function is_page_template( $page_template ) {

	// Access global variables.
	global $post;

	// False if no post object.
	if ( ! $post ) {
		return false;
	}

	return $page_template === get_post_meta( $post->ID, '_wp_page_template', true );
}

/**
 * Style the header image and text
 *
 * @since  1.0.0
 * @return string Returns an HTML style block.
 *
 */
function header_style() {

	$header_text_color = get_header_textcolor();

	/*
		* Stop if no custom options for text are set.
		* get_header_textcolor() options: Any hex value, 'blank' to hide text.
		* Default: add_theme_support( 'custom-header' ).
		*/
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	if ( ! display_header_text() ) {
		$style = sprintf(
			'<style type="text/css">%1s</style>',
			'.site-title,
				.site-title a,
				.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}'
		);

	} else {
		$style = sprintf(
			'<style type="text/css">%1s</style>',
			'.site-title,
				.site-title a,
				.site-description {
				color: #' . esc_attr( $header_text_color ) . ';
			}'
		);
	}

	// Print the style block.
	echo $style;
}

/**
 * Post format templates
 *
 * @since  1.0.0
 * @param  string $template
 * @return string Returns the path to the format template.
 */
function post_format_templates( $template ) {

	if ( is_single() && has_post_format() ) {
		$post_format_template = locate_template( 'single-format-' . get_post_format() . '.php' );
		if ( $post_format_template ) {
			$template = $post_format_template;
		}
	}
	return $template;
}

/**
 * Login title
 *
 * Includes the logo if set in the customizer.
 *
 * @since  1.0.0
 * @return string Returns the title markup.
 */
function login_title() {

	// Get the custom logo URL.
	$logo   = get_theme_mod( 'custom_logo' );
	$src    = wp_get_attachment_image_src( $logo , 'full' );
	$output = '';

	// Title markup, inside the h1 > a elements.
	if ( has_custom_logo( get_current_blog_id() ) ) {
		$output .= sprintf(
			'<span class="login-title-logo site-logo"><img src="%s" /></span> ',
			$src[0]
		);
	}

	$output .= sprintf(
		'<span class="login-title-text site-title">%s</span> ',
		get_bloginfo( 'name' )
	);

	return $output;
}

/**
 * Login URL
 *
 * @since  1.0.0
 * @return string Returns the URL.
 */
function login_url() {
	return site_url( '/' );
}

/**
 * User color scheme classes
 *
 * Add a class to the body element according to
 * the user's admin color scheme preference.
 *
 * @since  1.0.0
 * @param  array $classes
 * @return array Returns a modified array of body classes.
 */
function color_scheme_classes( $classes ) {

	// Add a class if user is logged in and admin bar is showing.
	if ( is_user_logged_in() && is_admin_bar_showing() ) {

		// Get the user color scheme option.
		$scheme = get_user_option( 'admin_color' );

		// Return body classes with `user-color-$scheme`.
		return array_merge( $classes, [ 'user-color-' . $scheme ] );
	}

	// Return the unfiltered classes if user is not logged in.
	return $classes;
}

/**
 * Append auto excerpt
 *
 * Adds a "read more" link to auto-generated post excerpts.
 *
 * @since  1.0.0
 * @param  string $more
 * @return string Returns the markup of the link.
 */
function excerpt_more_auto( $more ) {

	if ( has_excerpt( get_the_ID() ) ) {
		return '';
	}

	$html = sprintf(
		'&hellip; <a class="read-more" href="%s">%s</a>',
		get_permalink( get_the_ID() ),
		__( 'Read more', 'frontcore' )
	);

	return apply_filters( 'fct_excerpt_more', $html );
}

/**
 * Append manual excerpt
 *
 * Adds a "read more" link to manual post excerpts.
 *
 * @since  1.0.0
 * @param  string $text
 * @global object $post
 * @return string Returns the markup of the link.
 */
function excerpt_more_manual( $text ) {

	// Access global variables.
	global $post;

	$post_content   = $post->post_content;
	$excerpt_length = apply_filters( 'fct_excerpt_length', 55 );
	$more_content   = substr( $post_content, 0, strpos( $post_content, '<!--more-->' ) );
	$post_excerpt   = wp_trim_words( $post_content, $excerpt_length, '' );
	$more_excerpt   = wp_trim_words( $more_content, $excerpt_length, '' );

	$post_object = get_post_type_object( get_post_type() );
	$post_name   = ucwords( $post_object->labels->singular_name );

	// Manual excerpt.
	if ( has_excerpt() ) {

		$text .= sprintf(
			'&hellip; <a class="read-more" href="%s">%s</a>',
			get_permalink( get_the_ID() ),
		__( 'Read more', 'frontcore' )
		);

	// Excerpt cut short by the "more" tag (paginated post).
	} elseif ( strpos( $post_content, '<!--more-->' ) && strlen( $more_excerpt ) < strlen( $post_excerpt ) ) {

		$text .= sprintf(
			'&hellip; <a class="read-more" href="%s">%s</a>',
			get_permalink( get_the_ID() ),
		__( 'Continue reading', 'frontcore' )
		);

	// Short excerpt.
	} elseif ( strlen( $text ) == strlen( $post_excerpt ) ) {

		$text .= sprintf(
			'<a class="read-more" href="%s">%s %s</a>',
			get_permalink( get_the_ID() ),
		__( 'Go to', 'frontcore' ),
		$post_name
		);
	}

	return $text;
}
