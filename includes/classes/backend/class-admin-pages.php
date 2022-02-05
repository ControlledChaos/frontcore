<?php
/**
 * Admin pages
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Classes\Admin;

// Alias namespaces.
use FrontCore\Classes\Customize as Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin_Pages {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		/**
		 * Add admin header
		 *
		 * Not hooked to `in_admin_header` because the screen options
		 * and contextual help buttons/sections need to load first.
		 *
		 * Add early to the relevant hook in attempt to display
		 * above any admin notices.
		 */
		if ( is_network_admin() ) {
			$hook = 'network_admin_notices';
		} elseif ( is_user_admin() ) {
			$hook = 'user_admin_notices';
		} else {
			$hook = 'admin_notices';
		}
		add_action( $hook, [ $this, 'admin_header' ], 1 );

		// Add body classes.
		add_filter( 'admin_body_class', [ $this, 'admin_body_class' ] );

		// Theme options page.
		// add_action( 'admin_menu', [ $this, 'theme_options' ] );

		// Theme info page.
		add_action( 'admin_menu', [ $this, 'theme_info' ] );
	}

	/**
	 * Admin header
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_header() {

		// Get Customizer settings.
		new Customize\Customize;
		$use_header = Customize\mods()->admin_theme( get_theme_mod( 'fct_admin_header' ) );

		if ( $use_header ) {
			get_template_part( FCT_PARTS_DIR . '/admin/admin-header' );
		}
	}

	/**
	 * Admin body classes
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $body_class Array of body classes.
	 * @return array Return the conditionally modified array of body classes.
	 */
	public function admin_body_class( $body_class ) {

		// Get Customizer settings.
		new Customize\Customize;
		$use_theme  = Customize\mods()->admin_theme( get_theme_mod( 'fct_admin_theme' ) );
		$use_header = Customize\mods()->admin_theme( get_theme_mod( 'fct_admin_header' ) );

		if ( $use_theme ) {
			$body_class .= ' fct-admin-theme';
		}

		if ( $use_header ) {
			$body_class .= ' has-admin-header';
		}

		return $body_class;
	}

	/**
	 * Theme options page
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function theme_options() {

		// Add a submenu page under Themes.
		$this->help_theme_options = add_submenu_page(
			'themes.php',
			__( 'Display Options', 'frontcore' ),
			__( 'Display Options', 'frontcore' ),
			'manage_options',
			'frontend-display-options',
			[ $this, 'theme_options_output' ],
			-1
		);

		// Add sample help tab.
		add_action( 'load-' . $this->help_theme_options, [ $this, 'help_theme_options' ] );
	}

	/**
     * Get output of the theme options page
     *
     * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function theme_options_output() {
        get_template_part( FCT_PARTS_DIR . '/admin/theme-options-page' );
	}

	/**
     * Add tabs to the about page contextual help section
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function help_theme_options() {

		// Add to the about page.
		$screen = get_current_screen();
		if ( $screen->id != $this->help_theme_options ) {
			return;
		}

		// More information tab.
		$screen->add_help_tab( [
			'id'       => 'help_theme_options_info',
			'title'    => __( 'More Information', 'frontcore' ),
			'content'  => null,
			'callback' => [ $this, 'help_theme_options_info' ]
		] );

        // Add a help sidebar.
		$screen->set_help_sidebar(
			$this->help_theme_options_sidebar()
		);
	}

	/**
     * Get theme options help tab content
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
     */
	public function help_theme_options_info() {
		include_once get_theme_file_path( FCT_PARTS_DIR . '/partials/help-theme-options-info.php' );
    }

    /**
     * The about page contextual tab sidebar content
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the HTML of the sidebar content.
     */
    public function help_theme_options_sidebar() {

        $html  = sprintf( '<h4>%1s</h4>', __( 'Author Credits', 'frontcore' ) );
        $html .= sprintf(
            '<p>%1s %2s.</p>',
            __( 'This theme was created by', 'frontcore' ),
            'Your Name'
        );
        $html .= sprintf(
            '<p>%1s <br /><a href="%2s" target="_blank" rel="nofollow">%3s</a> <br />%4s</p>',
            __( 'Visit', 'frontcore' ),
            'https://example.com/',
            'Example Site',
            __( 'for more details.', 'frontcore' )
        );
        $html .= sprintf(
            '<p>%1s</p>',
            __( 'Change this sidebar to give yourself credit for the hard work you did customizing this theme.', 'frontcore' )
         );

		return $html;
	}

	/**
	 * Theme info page
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function theme_info() {

		// Add a submenu page under Themes.
		add_submenu_page(
			'themes.php',
			__( 'Theme Info', 'frontcore' ),
			__( 'Theme Info', 'frontcore' ),
			'manage_options',
			'frontcore-info',
			[ $this, 'theme_info_output' ],
			1
		);
	}

	/**
     * Get output of the theme info page
     *
     * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function theme_info_output() {

		$output = get_theme_file_path( FCT_PARTS_DIR . '/admin/theme-info-page.php' );
        if ( file_exists( $output ) ) {
			include $output;
		} else { ?>
			<div class="wrap theme-info-page">
				<h1><?php _e( 'Template Error', 'frontcore' ); ?></h1>
				<p class="description"><?php _e( 'The template file for this page was not located.' ); ?></p>
			</div>
		<?php }
	}
}
