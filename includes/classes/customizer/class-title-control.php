<?php
/**
 * Title Customizer Control
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Customizer
 * @since      1.0.0
 */

namespace FrontCore\Classes\Customizer;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class Title_Control extends \WP_Customize_Control {

	/**
	 * Holds the switcher type
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $switcher_type = 'default';

	/**
	 * The slug of this control in the customizer.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'group_title';

	/**
	 * Render content
	 *
	 * The control is rendered in JS not PHP.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function render_content() {}

	/**
	 * Content template
	 *
	 * Renders the JS template for the control.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
		?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<em>{{ data.description }}</em>
		<# } #>

		<?php
	}
}
