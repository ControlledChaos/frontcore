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

		// Register fields.
		add_action( 'customize_register', [ $this, 'customize_register' ] );
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

		// Content panel.
		$wp_customize->add_panel( 'fct_options_panel' , [
			'priority'    => 15,
			'capability'     => 'edit_theme_options',
			'title'       => __( 'Display Options', 'frontcore' ),
			'description' => __( '', 'frontcore' )
		] );

		$wp_customize->add_section( 'fct_content_section' , [
			'priority'    => 10,
			'title'       => __( 'Content Options', 'frontcore' ),
			'description' => __( '', 'frontcore' ),
			'panel'       => 'fct_options_panel'
		] );

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
	}

	/**
	 * Blog/archive content
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the format.
	 */
	public function blog_format( $input ) {

		$valid = [ 'content', 'excerpt' ];

		if ( in_array( $input, $valid ) ) {
			return $input;
		}
		return 'content';
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
