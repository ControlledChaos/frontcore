<?php
/**
 * Theme mode widget
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Widgets
 * @since      1.0.0
 */

namespace FrontCore\Classes\Widgets;

// Alias namespaces.
use FrontCore\Classes\Front as Front;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Theme_Mode extends \WP_Widget {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		$options = [
			'classname'                   => 'theme-mode-widget',
			'description'                 => __( 'Add a button to toggle light & dark modes.', 'frontcore' ),
			'customize_selective_refresh' => true,
		];

		// Run the parent constructor.
		parent :: __construct(
			'fct_theme_mode',
			$name = __( 'Theme Mode', 'frontcore' ),
			$options
		);

		// Add the toggle script to the footer if the widget is active.
		if ( is_active_widget( false, false, $this->id_base, true ) ) {
			add_action( 'wp_head', [ $this, 'theme_mode_script' ], 9 );
		}
	}

	/**
	 * Theme toggle script
	 *
	 * Toggles a body class and toggles the
	 * text of the toggle button.
	 *
	 * NOTE: the script below contains PHP. Translation functions
	 * are used for the text of the toggle button.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function theme_mode_script() {

		?>
		<script><?php echo file_get_contents( FCT_URL . '/assets/js/cookie.min.js' ); ?></script>
		<script>(function(e){e(window).load(function(){var t=e(".theme-toggle"),o=e.cookie("fct_theme_mode_class"),h=e.cookie("fct_theme_mode_text"),m=e.cookie("fct_theme_mode_hover");o||(e.cookie("fct_theme_mode_class","light-mode",{path:"/",expires:7,secure:!0}),e("html, body").removeClass("dark-mode").addClass("light-mode")),h||(e.cookie("fct_theme_mode_text","<?php _e( 'Go Dark', 'frontcore' ); ?>",{path:"/",expires:7,secure:!0}),e(t).text("<?php _e( 'Go Dark', 'frontcore' ); ?>")),m||(e.cookie("fct_theme_mode_hover","<?php _e( 'Switch to dark theme', 'frontcore' ); ?>",{path:"/",expires:7,secure:!0}),e(t).attr("title","<?php _e( 'Switch to dark theme', 'frontcore' ); ?>")),o&&e("html, body").addClass(o),h&&e(t).text(h),e(t).click(function(){e("html, body").hasClass("light-mode")?(e.cookie("fct_theme_mode_class","dark-mode",{path:"/",expires:7,secure:!0}),e.cookie("fct_theme_mode_text","<?php _e( 'Go Light', 'frontcore' ); ?>",{path:"/",expires:7,secure:!0}),e.cookie("fct_theme_mode_hover","<?php _e( 'Switch to light theme', 'frontcore' ); ?>",{path:"/",expires:7,secure:!0}),e("html, body").removeClass("light-mode").addClass("dark-mode"),e(t).text("<?php _e( 'Go Light', 'frontcore' ); ?>"),e(t).attr("title","<?php _e( 'Switch to light theme', 'frontcore' ); ?>")):(e.cookie("fct_theme_mode_class","light-mode",{path:"/",expires:7,secure:!0}),e.cookie("fct_theme_mode_text","<?php _e( 'Go Dark', 'frontcore' ); ?>",{path:"/",expires:7,secure:!0}),e.cookie("fct_theme_mode_hover","<?php _e( 'Switch to dark theme', 'frontcore' ); ?>",{path:"/",expires:7,secure:!0}),e("html, body").removeClass("dark-mode").addClass("light-mode"),e(t).text("<?php _e( 'Go Dark', 'frontcore' ); ?>"),e(t).attr("title","<?php _e( 'Switch to dark theme', 'frontcore' ); ?>"))})})})(jQuery);</script>
		<?php
	}

	/**
	 * Widget UI form
	 *
	 * @since  1.0.0
	 * @access public
	 * @param array $instance Current widget settings.
	 * @return void
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, [ 'title' => '' ] );
		$title    = $instance['title'];

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'frontcore' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			<br /><span class="description"><?php _e( 'Title text will display above the toggle button (optional).', 'frontcore' ); ?></span>
		</p>
		<?php
	}

	/**
	 * Update the widget form
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $new_instance New settings for this instance as input by the user via
	 *                             WP_Widget::form().
	 * @param  array $old_instance Old settings for this instance.
	 * @return array Updated settings.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance          = $old_instance;
		$new_instance      = wp_parse_args( (array) $new_instance, [ 'title' => '' ] );
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Frontend widget display
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Display arguments including 'before_title', 'after_title',
	 *                     'before_widget', and 'after_widget'.
	 * @param  array $instance Settings for the current widget instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {

		if ( ! empty( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = '';
		}
		$title = apply_filters( 'fct_theme_mode_title', $title, $instance, $this->id_base );

		// Toggle button markup.
		$button = apply_filters( 'fct_theme_mode_widget_button', sprintf(
			'<button class="theme-toggle" type="button" name="dark_light" title="%1s">%2s</button>',
			__( 'Switch to dark theme', 'frontcore' ),
			__( 'Go Dark', 'frontcore' )
		) );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo '<div class="theme-toggle-wrap">';
		echo $button;
		echo '</div>';

		echo $args['after_widget'];
	}
}
