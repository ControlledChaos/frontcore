<?php
/**
 * Theme Customizer
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Customizer
 */

namespace FrontCore\Customize;

use FrontCore\Classes\Customizer as Customizer_Class;

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

	// Register control types.
	add_action( 'customize_register', $ns( 'register_control_types' ) );

	// Enqueue customizer assets.
	add_action( 'customize_controls_enqueue_scripts', $ns( 'customize_assets' ) );

	// Modify existing Customizer elements.
	add_action( 'customize_register', $ns( 'customize_modify' ) );

	// Register new panels, sections, & fields.
	add_action( 'customize_register', $ns( 'customize_register' ) );

	// Add customizer styles to the head.
	add_action( 'wp_head', $ns( 'customize_css' ), 20 );
}

/**
 * Register control types
 *
 * @since  1.0.0
 * @param \WP_Customize_Manager $wp_customize The customizer object.
 * @return void
 */
function register_control_types( \WP_Customize_Manager $wp_customize ) {
	$wp_customize->register_control_type( Customizer_Class\Title_Control :: class );
}

/**
 * Enqueue controls assets
 *
 * @since  1.0.0
 * @return void
 */
function customize_assets() {

	wp_enqueue_style( 'fct-customizer', get_theme_file_uri( '/assets/css/customizer' . suffix() . '.css' ), [], FCT_VERSION );
}

/**
 * Modify existing Customizer elements
 *
 * @since  1.0.0
 * @param  object $wp_customize The WP_Customizer class.
 * @return void
 */
function customize_modify( $wp_customize ) {

	// Change Site Identity section title.
	$wp_customize->get_section( 'title_tagline' )->title    = __( 'Identity', 'frontcore' );
	$wp_customize->get_section( 'title_tagline' )->priority = 5;

	// Site title & tagline, logo order.
	$wp_customize->get_control( 'blogname' )->priority            = 1;
	$wp_customize->get_control( 'blogdescription' )->priority     = 2;
	$wp_customize->get_control( 'display_header_text' )->priority = 3;
	$wp_customize->get_control( 'custom_logo' )->priority         = 11;

	// Rename Homepage options section & put under Layout panel.
	$wp_customize->get_section( 'static_front_page' )->panel    = 'fct_layout_panel';
	$wp_customize->get_section( 'static_front_page' )->priority = 3;
	$wp_customize->get_section( 'static_front_page' )->title    = __( 'Front Page', 'frontcore' );

	// Change label for front page option.
	$wp_customize->get_control( 'show_on_front' )->label = __( 'Front Page Displays', 'frontcore' );

	// Rename Colors section & put under Appearance panel.
	$wp_customize->get_section( 'colors' )->panel    = 'fct_appearance_panel';
	$wp_customize->get_section( 'colors' )->priority = 4;
	$wp_customize->get_section( 'colors' )->title    = __( 'Theme Colors', 'frontcore' );

	// Put Background Color control under Appearance panel.
	$wp_customize->get_control( 'background_color' )->section  = 'colors';
	$wp_customize->get_control( 'background_color' )->priority = 2;

	// Rename Background section & put under Appearance panel.
	$wp_customize->get_section( 'background_image' )->panel    = 'fct_appearance_panel';
	$wp_customize->get_section( 'background_image' )->priority = 5;

	// Put header image & color under Header Display section.
	$wp_customize->get_control( 'header_image' )->section     = 'fct_header_display_section';
	$wp_customize->get_control( 'header_image' )->priority    = 100;

	// Color disabled below.
	// $wp_customize->get_control( 'header_textcolor' )->section = 'fct_header_display_section';

	// Put CSS section under Appearance panel.
	$wp_customize->get_section( 'custom_css' )->panel    = 'fct_appearance_panel';
	$wp_customize->get_section( 'custom_css' )->priority = 100;

	// Remove settings controls.
	$wp_customize->remove_control( 'header_textcolor' );
}

/**
 * Register fields
 *
 * @since  1.0.0
 * @param  object $wp_customize The WP_Customizer class.
 * @return void
 */
function customize_register( $wp_customize ) {

	// Return namespaced function.
	$ns = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// Add Layout panel.
	$wp_customize->add_panel( 'fct_layout_panel' , [
		'priority'    => 10,
		'capability'  => 'edit_theme_options',
		'title'       => __( 'Layout', 'frontcore' )
	] );

	// Add Content panel.
	$wp_customize->add_panel( 'fct_content_panel' , [
		'priority'    => 15,
		'capability'  => 'edit_theme_options',
		'title'       => __( 'Content', 'frontcore' )
	] );

	// Add Appearance panel.
	$wp_customize->add_panel( 'fct_appearance_panel' , [
		'priority'    => 20,
		'capability'  => 'edit_theme_options',
		'title'       => __( 'Appearance', 'frontcore' )
	] );

	// Add Header Layout section.
	$wp_customize->add_section( 'fct_header_layout_section' , [
		'priority'    => 5,
		'title'       => __( 'Header Layout', 'frontcore' ),
		'description' => __( '', 'frontcore' ),
		'panel'       => 'fct_layout_panel'
	] );

	// Add Header Display section.
	$wp_customize->add_section( 'fct_header_display_section' , [
		'priority'    => 10,
		'title'       => __( 'Header Display', 'frontcore' ),
		'description' => __( 'Choose which header elements to display and how to display them.', 'frontcore' ),
		'panel'       => 'fct_appearance_panel'
	] );

	// Add Content Display section.
	$wp_customize->add_section( 'fct_content_section' , [
		'priority'    => 10,
		'title'       => __( 'Content Display', 'frontcore' ),
		'description' => __( '', 'frontcore' ),
		'panel'       => 'fct_content_panel'
	] );

	// Add Admin section.
	$wp_customize->add_section( 'fct_admin_options_section' , [
		'priority'    => 135,
		'capability'  => 'manage_options',
		'title'       => __( 'Admin', 'frontcore' ),
		'description' => __( '', 'frontcore' )
	] );

	// Hide front page heading.
	$wp_customize->add_setting( 'fct_hide_front_heading', [
		'default'	        => false,
		'transport'         => 'refresh',
		'sanitize_callback' => $ns( 'hide_front_heading' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'fct_hide_front_heading',
		[
			'section'     => 'title_tagline',
			'settings'    => 'fct_hide_front_heading',
			'label'       => __( 'Front Page Heading', 'frontcore' ),
			'description' => __( 'Hide the static front page heading. Still available to screen readers.', 'frontcore' ),
			'type'        => 'checkbox',
			'priority'    => 5,
		]
	) );

	// Site logo type.
	$wp_customize->add_setting(
		'site_logo_type',
		[
			'default'           => 'upload',
			'transport'         => 'postMessage',
			'sanitize_callback' => __NAMESPACE__ . '\site_logo_type',
		]
	);
	$wp_customize->add_control(
		'site_logo_type',
		[
			'type'     => 'radio',
			'label'    => __( 'Logo Type', 'frontcore' ),
			'choices'  => [
				'upload' => __( 'Image Upload', 'frontcore' ),
				'svg'    => __( 'Inline SVG', 'frontcore' )
			],
			'section'  => 'title_tagline',
			'priority' => 5,
		]
	);

	// Site logo SVG code.
	$wp_customize->add_setting(
		'site_logo_svg',
		[
			'default'           => '',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'site_logo_svg',
		]
	);
	$wp_customize->add_control(
		'site_logo_svg',
		[
			'type'     => 'textarea',
			'label'    => __( 'Logo SVG Code', 'frontcore' ),
			'section'  => 'title_tagline',
			'priority' => 5,
		]
	);

	// Page elements colors group.
	$wp_customize->add_setting(
		'page_colors',
		array(
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		new Customizer_Class\Title_Control(
			$wp_customize,
			'page_colors',
			array(
				'type'        => 'group_title',
				'label'       => __( 'Page Elements', 'frontcore' ),
				'description' => __( 'Customize page element colors.', 'frontcore' ),
				'section'     => 'colors',
				'priority'    => 1,
			)
		)
	);

	// General Text colors group.
	$wp_customize->add_setting(
		'text_colors',
		array(
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		new Customizer_Class\Title_Control(
			$wp_customize,
			'text_colors',
			array(
				'type'        => 'group_title',
				'label'       => __( 'General Text', 'frontcore' ),
				'description' => __( 'Customize general text colors.', 'frontcore' ),
				'section'     => 'colors',
				'priority'    => 10,
			)
		)
	);

	// General text color.
	$wp_customize->add_setting(
		'text_color',
		array(
			'transport'         => 'refresh',
			'default'           => null,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'text_color',
			array(
				'label'    => __( 'Text', 'frontcore' ),
				'section'  => 'colors',
				'settings' => 'text_color',
				'priority' => 11,
			)
		)
	);

	// General links color.
	$wp_customize->add_setting(
		'links_color',
		array(
			'transport'         => 'refresh',
			'default'           => null,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'links_color',
			array(
				'label'    => __( 'Links', 'frontcore' ),
				'section'  => 'colors',
				'settings' => 'links_color',
				'priority' => 12,
			)
		)
	);

	// General links action color.
	$wp_customize->add_setting(
		'links_action_color',
		array(
			'transport'         => 'refresh',
			'default'           => null,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'links_action_color',
			array(
				'label'    => __( 'Links Action', 'frontcore' ),
				'section'  => 'colors',
				'settings' => 'links_action_color',
				'priority' => 13,
			)
		)
	);

	// General heading color.
	$wp_customize->add_setting(
		'headings_color',
		array(
			'transport'         => 'refresh',
			'default'           => null,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'headings_color',
			array(
				'label'    => __( 'Headings', 'frontcore' ),
				'section'  => 'colors',
				'settings' => 'headings_color',
				'priority' => 14,
			)
		)
	);

	// Page header colors group.
	$wp_customize->add_setting(
		'header_colors',
		array(
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		new Customizer_Class\Title_Control(
			$wp_customize,
			'header_colors',
			array(
				'type'        => 'group_title',
				'label'       => __( 'Page Header', 'frontcore' ),
				'description' => __( 'Customize page header colors.', 'frontcore' ),
				'section'     => 'colors',
				'priority'    => 20,
			)
		)
	);

	// Header background color.
	$wp_customize->add_setting(
		'header_background_color',
		array(
			'transport'         => 'refresh',
			'default'           => null,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color',
			array(
				'label'    => __( 'Header Background', 'frontcore' ),
				'section'  => 'colors',
				'settings' => 'header_background_color',
				'priority' => 20,
			)
		)
	);

	// Header text color.
	$wp_customize->add_setting(
		'header_text_color',
		array(
			'transport'         => 'refresh',
			'default'           => null,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'header_text_color',
			array(
				'label'    => __( 'Header Text', 'frontcore' ),
				'section'  => 'colors',
				'settings' => 'header_text_color',
				'priority' => 20,
			)
		)
	);

	// Page footer colors group.
	$wp_customize->add_setting(
		'footer_colors',
		array(
			'sanitize_callback' => 'esc_html',
		)
	);
	$wp_customize->add_control(
		new Customizer_Class\Title_Control(
			$wp_customize,
			'footer_colors',
			array(
				'type'        => 'group_title',
				'label'       => __( 'Page Footer', 'frontcore' ),
				'description' => __( 'Customize page footer colors.', 'frontcore' ),
				'section'     => 'colors',
				'priority'    => 100,
			)
		)
	);

	// Footer background color.
	$wp_customize->add_setting(
		'footer_background_color',
		array(
			'transport'         => 'refresh',
			'default'           => null,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_background_color',
			array(
				'label'    => __( 'Footer Background', 'frontcore' ),
				'section'  => 'colors',
				'settings' => 'footer_background_color',
				'priority' => 100,
			)
		)
	);

	// Footer text color.
	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'transport'         => 'refresh',
			'default'           => null,
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			array(
				'label'    => __( 'Footer Text', 'frontcore' ),
				'section'  => 'colors',
				'settings' => 'footer_text_color',
				'priority' => 100,
			)
		)
	);

	// Header image display.
	$wp_customize->add_setting( 'fct_header_image', [
		'default'	        => 'always',
		'sanitize_callback' => $ns( 'header_image' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'fct_header_image',
		[
			'priority'    => 10,
			'section'     => 'fct_header_display_section',
			'settings'    => 'fct_header_image',
			'label'       => __( 'Header Image Display', 'frontcore' ),
			'description' => __( 'Choose when to display the header image.', 'frontcore' ),
			'type'        => 'select',
			'choices'     => [
				'never'       => __( 'Never Display', 'frontcore' ),
				'always'      => __( 'Always Display', 'frontcore' ),
				'enable_per'  => __( 'Enable Per Post/Page', 'frontcore' ),
				'disable_per' => __( 'Disable Per Post/Page', 'frontcore' )
			]
		]
	) );

	// Main navigation location.
	$wp_customize->add_setting( 'fct_nav_location', [
		'default'	        => 'aside',
		'sanitize_callback' => $ns( 'nav_location' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'fct_nav_location',
		[
			'section'     => 'fct_header_layout_section',
			'settings'    => 'fct_nav_location',
			'label'       => __( 'Main Navigation Location', 'frontcore' ),
			'description' => __( 'Display the main navigation menu before or after the header branding and image.', 'frontcore' ),
			'type'        => 'select',
			'choices'     => [
				'aside'  => __( 'Aside Site Branding', 'frontcore' ),
				'before' => __( 'Before Header', 'frontcore' ),
				'after'  => __( 'After Header', 'frontcore' )
			]
		]
	) );

	// Blog/archive content.
	$wp_customize->add_setting( 'fct_blog_format', [
		'default'	        => 'content',
		'sanitize_callback' => $ns( 'blog_format' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'fct_blog_format',
		[
			'section'     => 'fct_content_section',
			'settings'    => 'fct_blog_format',
			'label'       => __( 'Post Archive Content', 'frontcore' ),
			'description' => __( 'Should the blog index and archive pages show the full post or an excerpt?', 'frontcore' ),
			'type'        => 'select',
			'choices'     => [
				'content' => __( 'Full Content', 'frontcore' ),
				'excerpt' => __( 'Excerpt/Summary', 'frontcore' )
			]
		]
	) );

	// Author section on single posts.
	$wp_customize->add_setting( 'fct_author_section', [
		'default'	        => 'never',
		'sanitize_callback' => $ns( 'author_section' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'fct_author_section',
		[
			'section'     => 'fct_content_section',
			'settings'    => 'fct_author_section',
			'label'       => __( 'Author Section', 'frontcore' ),
			'description' => __( 'Display the name, bio, and profile picture of the author on single post pages. Requires the author to have entered text into the "Biographical Info" section of the profile screen.', 'frontcore' ),
			'type'        => 'select',
			'choices'     => [
				'never'       => __( 'Never Display', 'frontcore' ),
				'always'      => __( 'Always Display', 'frontcore' ),
				'enable_per'  => __( 'Enable Per Post', 'frontcore' ),
				'disable_per' => __( 'Disable Per Post', 'frontcore' )
			]
		]
	) );

	// Use admin theme.
	$wp_customize->add_setting( 'fct_admin_theme', [
		'default'	        => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => $ns( 'use_admin_theme' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'fct_admin_theme',
		[
			'section'     => 'fct_admin_options_section',
			'settings'    => 'fct_admin_theme',
			'label'       => __( 'Admin Theme', 'frontcore' ),
			'description' => __( 'Enqueue styles for a custom admin pages theme.', 'frontcore' ),
			'type'        => 'checkbox'
		]
	) );

	// Load admin header.
	$wp_customize->add_setting( 'fct_admin_header', [
		'default'	        => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => $ns( 'use_admin_header' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'fct_admin_header',
		[
			'section'     => 'fct_admin_options_section',
			'settings'    => 'fct_admin_header',
			'label'       => __( 'Admin Header', 'frontcore' ),
			'description' => __( 'Load a page header on admin pages.', 'frontcore' ),
			'type'        => 'checkbox'
		]
	) );

	// Use login background styles.
	$wp_customize->add_setting( 'fct_login_bg_styles', [
		'default'	        => false,
		'transport'         => 'postMessage',
		'sanitize_callback' => $ns( 'use_login_bg_styles' )
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'fct_login_bg_styles',
		[
			'section'     => 'background_image',
			'settings'    => 'fct_login_bg_styles',
			'label'       => __( 'Apply to Login', 'frontcore' ),
			'description' => __( 'Use background styles on the login screen.', 'frontcore' ),
			'type'        => 'checkbox'
		]
	) );
}

/**
 * Hide front page heading
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function hide_front_heading( $input ) {

	if ( true == $input ) {
		return true;
	}
	return false;
}

/**
 * Logo type
 *
 * @since  1.0.0
 * @param string $input Logo type.
 * @return string Returns the theme mod.
 */
function site_logo_type( $input ) {

	$valid = [ 'upload', 'svg' ];

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'upload';
}

/**
 * Header image
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function header_image( $input ) {

	$valid = [ 'never', 'always', 'enable_per', 'disable_per' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'always';
}

/**
 * Main navigation location
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function nav_location( $input ) {

	$valid = [ 'aside', 'before', 'after' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'aside';
}

/**
 * Blog/archive content
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function blog_format( $input ) {

	$valid = [ 'content', 'excerpt' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'content';
}

/**
 * Author section
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function author_section( $input ) {

	$valid = [ 'never', 'always', 'enable_per', 'disable_per' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'never';
}

/**
 * Admin theme
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function use_admin_theme( $input ) {

	if ( true == $input ) {
		return true;
	}
	return false;
}

/**
 * Admin header
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function use_admin_header( $input ) {

	if ( true == $input ) {
		return true;
	}
	return false;
}

/**
 * Login styles
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function use_login_bg_styles( $input ) {

	if ( true == $input ) {
		return true;
	}
	return false;
}

/**
 * Customizer colors to head
 *
 * @since  1.0.0
 * @return void
 */
function customize_css() {

	// Get theme mods.
	$mods = [
		'text_color'         => get_theme_mod( 'text_color' ),
		'links_color'        => get_theme_mod( 'links_color' ),
		'links_action_color' => get_theme_mod( 'links_action_color' ),
		'headings_color'     => get_theme_mod( 'headings_color' ),
		'header_background_color' => get_theme_mod( 'header_background_color' ),
		'header_text_color'       => get_theme_mod( 'header_text_color' ),
		'footer_background_color' => get_theme_mod( 'footer_background_color' ),
		'footer_text_color'       => get_theme_mod( 'footer_text_color' )
	];

	// Filter array of mods to check for key values.
	$filter_mods = array_filter( $mods );

	// Print the style block if at least one mod is set.
	if ( ! empty( $filter_mods ) ) :

	ob_start();
	?>
	<style>
		:root {
			<?php if ( ! empty( $mods['text_color'] ) ) : ?>
			--fct-text-color: <?php echo $mods['text_color']; ?>;
			<?php endif; ?>
			<?php if ( ! empty( $mods['links_color'] ) ) : ?>
			--fct-link-color: <?php echo $mods['links_color']; ?>;
			<?php endif; ?>
			<?php if ( ! empty( $mods['links_action_color'] ) ) : ?>
			--fct-link-action-color: <?php echo $mods['links_action_color']; ?>;
			<?php endif; ?>
			<?php if ( ! empty( $mods['headings_color'] ) ) : ?>
			--fct-primary-heading--color: <?php echo $mods['headings_color']; ?>;
			--fct-secondary-heading--color: <?php echo $mods['headings_color']; ?>;
			--fct-heading--color: <?php echo $mods['headings_color']; ?>;
			<?php endif; ?>

			<?php if ( ! empty( $mods['header_background_color'] ) ) : ?>
				--fct-header--background-color: <?php echo $mods['header_background_color']; ?>;
			<?php endif; ?>
			<?php if ( ! empty( $mods['header_text_color'] ) ) : ?>
				--fct-site-title-color: <?php echo $mods['header_text_color']; ?>;
				--fct-site-description-color: <?php echo $mods['header_text_color']; ?>;
				--fct-main-nav--link-text-color: <?php echo $mods['header_text_color']; ?>;
				--fct-main-nav--link-action-text-color: <?php echo $mods['header_text_color']; ?>;
			<?php endif; ?>

			<?php if ( ! empty( $mods['footer_background_color'] ) ) : ?>
				--fct-footer--background-color: <?php echo $mods['footer_background_color']; ?>;
			<?php endif; ?>
			<?php if ( ! empty( $mods['footer_text_color'] ) ) : ?>
				--fct-footer--color: <?php echo $mods['footer_text_color']; ?>;
				--fct-footer--link--color: <?php echo $mods['footer_text_color']; ?>;
			<?php endif; ?>
		}
	</style>
	<?php

	echo ob_get_clean();
	endif;
}
