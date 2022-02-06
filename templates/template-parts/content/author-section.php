<?php
/**
 * Author info section
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Front as Front,
	FrontCore\Customize     as Customize;

// Get the author section display setting from the Customizer.
$display = Customize\author_section( get_theme_mod( 'fct_author_section' ) );

if ( (boolean) get_the_author_meta( 'description' ) && 'never' != $display ) :

$options = get_post_meta( get_the_ID(), 'fct_post_options', true );

$enable  = $options ? in_array( 'enable_author', $options, true ) : false;
$disable = $options ? in_array( 'disable_author', $options, true ) : false;

if (
	'always' == $display ||
	( 'enable_per'  == $display && true  == $enable ) ||
	( 'disable_per' == $display && false == $disable )
) :

?>
<section class="author-section">

	<div class="author-title-wrapper">

		<div class="author-avatar vcard">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), get_option( 'thumbnail_size_w' ) ); ?>
		</div>

		<h2 class="author-title">
			<?php
			printf(
				__( 'By %s', 'frontcore' ),
				esc_html( get_the_author() )
			);
			?>
		</h2>
	</div>

	<div class="author-description">

		<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>

		<?php if ( is_single() ) : ?>
		<a class="author-link button" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php _e( 'View Archive', 'frontcore' ); ?>
		</a>
		<?php endif; ?>
	</div>
</section>
<?php

endif;
endif;
