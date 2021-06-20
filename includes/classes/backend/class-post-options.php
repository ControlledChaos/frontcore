<?php
/**
 * Post options
 *
 * Adds metaboxes with fields, saves meta data.
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Classes\Admin;

// Alias namespaces.
use FrontCore\Classes\Front     as Front,
	FrontCore\Classes\Customize as Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post_Options {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Load metaboxes.
		add_action( 'load-post.php', [ $this, 'metabox_setup' ] );
		add_action( 'load-post-new.php', [ $this, 'metabox_setup' ] );

		// Save post metedata.
		add_action( 'save_post', [ $this, 'save_metadata' ], 10, 3 );
	}

	/**
	 * Load metaboxes
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function metabox_setup() {
		add_action( 'add_meta_boxes', [ $this, 'metaboxes' ] );
	}

	/**
	 * Add metaboxes
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function metaboxes() {

		// Get public post types.
		$post_types = get_post_types( [ 'public' => true ] );

		// Remove page builder post types from `$post_types` array.
		unset( $post_types['elementor_library'], $post_types['fl-builder-template'] );

		// Display Options metabox.
		add_meta_box( 'fct_post_display', __( 'Display Options', 'frontcore' ), [ $this, 'display_metabox' ], $post_types, 'side', 'default' );
	}

	/**
	 * Author metabox
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $post The post object.
	 * @return void
	 */
	public function display_metabox( $post ) {

		wp_nonce_field( "fct_post_{$post->ID}_options_nonce", 'fct_post_options_nonce' );

		$stored_meta = get_post_meta( $post->ID, 'fct_post_options', true );
		if ( empty( $stored_meta ) ) {
			$stored_meta = [];
		} else {
			$stored_meta = $stored_meta;
		}

		if ( in_array( 'disable_author', $stored_meta, true ) ) {
			$disable_author = 'disable_author';
		} else {
			$disable_author = false;
		}

		$get_post  = get_post_type_object( get_post_type() );
		$post_name = $get_post->labels->singular_name;

		// Get the author section display setting from the Customizer.
		$display_author = Customize\mods()->author_section( get_theme_mod( 'fct_author_section' ) );

	?>
		<fieldset>
			<legend class="screen-reader-text"><?php _e( 'Display Options Form', 'frontcore' ); ?></legend>

			<?php if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && (boolean) $display_author ) : ?>
			<p>
				<label for="disable_author">
					<input id="disable_author" type="checkbox" name="fct_post_options[]" value="disable_author" <?php checked( $disable_author, 'disable_author' ); ?> />
					<?php printf(
						__( 'Disable the author profile section for this %s.', 'frontcore' ),
						strtolower( $post_name )
				); ?>
				</label>
			</p>
			<?php
			elseif ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) ) :
				printf(
					'<p><a href="%s">%s</a></p>',
					esc_url( admin_url( 'customize.php?url=' . get_permalink( $post->ID ) . '&autofocus[control]=fct_author_section' ) ),
					__( 'Enable post author section', 'frontcore' )
				);
			endif; ?>
		</fieldset>
	<?php
	}

	/**
	 * Save post options metadata
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  integer $post_id The post ID.
	 * @param  WP_Post $post The Instance of WP_Post object.
	 * @param  bool    $update Whether this is an existing post being updated.
	 * @return void
	 */
	public function save_metadata( $post_id, $post, $update ) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );

		$is_valid_nonce = ( isset( $_POST['fct_post_options_nonce'] ) && wp_verify_nonce( $_POST['fct_post_options_nonce'], "fct_post_{$post_id}_options_nonce" ) ) ? true : false;

		// Stop here if autosave, revision or nonce is invalid.
		if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
			return;
		}

		// Stop if current user can't edit posts.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		// Save options metadata.
		$checked = [];

		if ( isset( $_POST['fct_post_options'] ) ) {

			if ( in_array( 'disable_author', $_POST['fct_post_options'], true ) ) {
				$checked[] .= 'disable_author';
			}
		}

		update_post_meta( $post_id, 'fct_post_options', $checked );
	}
}
