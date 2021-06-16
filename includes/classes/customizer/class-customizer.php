<?php
/**
 * Theme Customizer
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Customizer
 */

namespace FrontCore\Classes\Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Customizer {

	/**
	 * The class object
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected static $class_object;

	/**
	 * Instance of the class
	 *
	 * This method can be used to call an instance
	 * of the class from outside the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns an instance of the class.
	 */
	public static function instance() {

		if ( is_null( self :: $class_object ) ) {
			self :: $class_object = new self();
		}

		// Return the instance.
		return self :: $class_object;
	}

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Modify existing Customizer elements.
		add_action( 'customize_register', [ $this, 'customize_modify' ] );

		// Register new panels, sections, & fields.
		add_action( 'customize_register', [ $this, 'customize_register' ] );
	}

	/**
	 * Modify existing Customizer elements
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize The WP_Customizer class.
	 * @return void
	 */
	public function customize_modify( $wp_customize ) {

		// Change Site Identity section title.
		$wp_customize->get_section( 'title_tagline' )->title = __( 'Identity', 'frontcore' );
		$wp_customize->get_section( 'title_tagline' )->priority = 5;

		// Put the logo filed below site title & tagline.
		$wp_customize->get_control( 'custom_logo' )->priority = 11;

		// Rename Homepage options section & put under Layout panel.
		$wp_customize->get_section( 'static_front_page' )->panel    = 'fct_layout_panel';
		$wp_customize->get_section( 'static_front_page' )->priority = 3;
		$wp_customize->get_section( 'static_front_page' )->title    = __( 'Front Page', 'frontcore' );

		// Rename Background section & put under Appearance panel.
		$wp_customize->get_section( 'background_image' )->panel    = 'fct_appearance_panel';
		$wp_customize->get_section( 'background_image' )->priority = 5;
		$wp_customize->get_section( 'background_image' )->title    = __( 'Background Display', 'frontcore' );
		$wp_customize->get_control( 'background_color' )->section  = 'background_image';

		// Put header image & color under Header Display section.
		$wp_customize->get_control( 'header_image' )->section     = 'fct_header_display_section';
		$wp_customize->get_control( 'header_image' )->priority    = 100;
		$wp_customize->get_control( 'header_textcolor' )->section = 'fct_header_display_section';

		// Put CSS section under Appearance panel.
		$wp_customize->get_section( 'custom_css' )->panel    = 'fct_appearance_panel';
		$wp_customize->get_section( 'custom_css' )->priority = 100;
	}

	/**
	 * Register fields
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize The WP_Customizer class.
	 * @return void
	 */
	public function customize_register( $wp_customize ) {

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

		// Main navigation location.
		$wp_customize->add_setting( 'fct_nav_location', [
			'default'	        => 'before',
			'sanitize_callback' => [ $this, 'nav_location' ]
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
					'before' => __( 'Before Header', 'frontcore' ),
					'after'  => __( 'After Header', 'frontcore' )
				]
			]
		) );

		// Blog/archive content.
		$wp_customize->add_setting( 'fct_blog_format', [
			'default'	        => 'content',
			'sanitize_callback' => [ $this, 'blog_format' ]
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

		// Main navigation location.
		$wp_customize->add_setting( 'fct_admin_theme', [
			'default'	        => false,
			'sanitize_callback' => [ $this, 'admin_theme' ]
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
			'sanitize_callback' => [ $this, 'admin_header' ]
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
	}

	/**
	 * Main navigation location
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function nav_location( $input ) {

		$valid = [ 'before', 'after' ];

		if ( in_array( $input, $valid ) ) {
			return $input;
		}
		return 'before';
	}

	/**
	 * Blog/archive content
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function blog_format( $input ) {

		$valid = [ 'content', 'excerpt' ];

		if ( in_array( $input, $valid ) ) {
			return $input;
		}
		return 'content';
	}

	/**
	 * Admin theme
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function admin_theme( $input ) {

		if ( true == $input ) {
			return true;
		}
		return false;
	}

	/**
	 * Admin header
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function admin_header( $input ) {

		if ( true == $input ) {
			return true;
		}
		return false;
	}
}

/**
 * Instance of the class
 *
 * @since  1.0.0
 * @access public
 * @return object Customizer Returns an instance of the class.
 */
function mods() {
	return Customizer :: instance();
}
