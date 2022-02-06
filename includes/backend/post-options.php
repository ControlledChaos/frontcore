<?php
/**
 * Post options
 *
 * Adds metaboxes with fields, saves meta data.
 *
 * @package    Front_Core
 * @subpackage Includes
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Post_Options;

// Alias namespaces.
use FrontCore\Classes\Front as Front,
	FrontCore\Customize     as Customize;

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

	// Load metaboxes.
	add_action( 'load-post.php', $ns( 'metabox_setup' ) );
	add_action( 'load-post-new.php', $ns( 'metabox_setup' ) );

	// Save post metedata.
	add_action( 'save_post', $ns( 'save_metadata' ), 10, 3 );
}

/**
 * Load metaboxes
 *
 * @since  1.0.0
 * @return void
 */
function metabox_setup() {
	add_action( 'add_meta_boxes', __NAMESPACE__ . '\\metaboxes' );
}

/**
 * Add metaboxes
 *
 * @since  1.0.0
 * @return void
 */
function metaboxes() {

	// Get public post types.
	$post_types = get_post_types( [ 'public' => true ] );

	// Remove page builder post types from `$post_types` array.
	unset( $post_types['elementor_library'], $post_types['fl-builder-template'] );

	// Display Options metabox.
	add_meta_box( 'fct_post_display', __( 'Display Options', 'frontcore' ), __NAMESPACE__ . '\\display_metabox', $post_types, 'side', 'default' );
}

/**
 * Author metabox
 *
 * @since  1.0.0
 * @param  object $post The post object.
 * @global string $typenow The post type.
 * @return void
 */
function display_metabox( $post ) {

	// Access post type of edit screen.
	global $typenow;

	// Get post type display name.
	$get_post  = get_post_type_object( get_post_type() );
	$post_name = $get_post->labels->singular_name;

	// Get header display setting from the Customizer.
	$display_header = Customize\header_image( get_theme_mod( 'fct_header_image' ) );

	// Get the author section display setting from the Customizer.
	$display_author = Customize\author_section( get_theme_mod( 'fct_author_section' ) );

	wp_nonce_field( "fct_post_{$post->ID}_options_nonce", 'fct_post_options_nonce' );

	$stored_meta = get_post_meta( $post->ID, 'fct_post_options', true );
	if ( empty( $stored_meta ) ) {
		$stored_meta = [];
	} else {
		$stored_meta = $stored_meta;
	}

	if ( in_array( 'enable_header', $stored_meta, true ) ) {
		$enable_header = 'enable_header';
	} else {
		$enable_header = false;
	}

	if ( in_array( 'disable_header', $stored_meta, true ) ) {
		$disable_header = 'disable_header';
	} else {
		$disable_header = false;
	}

	if ( in_array( 'enable_author', $stored_meta, true ) ) {
		$enable_author = 'enable_author';
	} else {
		$enable_author = false;
	}

	if ( in_array( 'disable_author', $stored_meta, true ) ) {
		$disable_author = 'disable_author';
	} else {
		$disable_author = false;
	}

?>
	<fieldset>
		<legend class="screen-reader-text"><?php _e( 'Display Options Form', 'frontcore' ); ?></legend>

		<?php if ( 'enable_per' == $display_header ) :
		?>
		<p>
			<label for="enable_header">
				<input id="enable_header" type="checkbox" name="fct_post_options[]" value="enable_header" <?php checked( $enable_header, 'enable_header' ); ?> />
				<?php printf(
					__( 'Enable the header image for this %s.', 'frontcore' ),
					strtolower( $post_name )
			); ?>
			</label>
		</p>
		<?php elseif ( 'disable_per' == $display_header ) :
		?>
		<p>
			<label for="disable_header">
				<input id="disable_header" type="checkbox" name="fct_post_options[]" value="disable_header" <?php checked( $disable_header, 'disable_header' ); ?> />
				<?php printf(
					__( 'Disable the header image for this %s.', 'frontcore' ),
					strtolower( $post_name )
			); ?>
			</label>
		</p>
		<?php endif; ?>

		<?php if ( post_type_supports( $typenow, 'author' ) && 'enable_per' == $display_author ) :
		?>
		<p>
			<label for="enable_author">
				<input id="enable_author" type="checkbox" name="fct_post_options[]" value="enable_author" <?php checked( $enable_author, 'enable_author' ); ?> />
				<?php printf(
					__( 'Enable the author profile section for this %s.', 'frontcore' ),
					strtolower( $post_name )
			); ?>
			</label>
		</p>
		<?php elseif ( post_type_supports( $typenow, 'author' ) && 'disable_per' == $display_author ) :
		?>
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
		elseif ( post_type_supports( $typenow, 'author' ) && 'always' != $display_author ) :
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
 * @param  integer $post_id The post ID.
 * @param  WP_Post $post The Instance of WP_Post object.
 * @param  bool    $update Whether this is an existing post being updated.
 * @return void
 */
function save_metadata( $post_id, $post, $update ) {

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

		if ( in_array( 'enable_header', $_POST['fct_post_options'], true ) ) {
			$checked[] .= 'enable_header';
		}

		if ( in_array( 'disable_header', $_POST['fct_post_options'], true ) ) {
			$checked[] .= 'disable_header';
		}

		if ( in_array( 'enable_author', $_POST['fct_post_options'], true ) ) {
			$checked[] .= 'enable_author';
		}

		if ( in_array( 'disable_author', $_POST['fct_post_options'], true ) ) {
			$checked[] .= 'disable_author';
		}
	}

	update_post_meta( $post_id, 'fct_post_options', $checked );
}
