<?php
/**
 * Front page header content template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Front     as Front,
	FrontCore\Classes\Customize as Customize;

// Get the navigation location setting from the Customizer.
$nav_location = Customize\mods()->nav_location( get_theme_mod( 'fct_nav_location' ) );

// Get the author section display setting from the Customizer.
$header_image = Customize\mods()->header_image( get_theme_mod( 'fct_header_image' ) );

$options = get_post_meta( get_the_ID(), 'fct_post_options', true );
$enable  = $options ? in_array( 'enable_header', $options, true ) : false;
$disable = $options ? in_array( 'disable_header', $options, true ) : false;

?>
<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

	<div class="site-branding-wrap<?php do_action( 'FrontCore\site_branding_wrap_class' ); ?>">
		<div class="site-branding">

			<?php echo Front\tags()->site_logo(); ?>

			<div class="site-title-description">

				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>

				<?php

				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $site_description; ?></p>
				<?php endif; ?>

			</div>
		</div>
		<?php if ( 'aside' == $nav_location ) {
				Front\tags()->nav_aside_branding();
		} ?>
	</div>

	<?php if ( 'never' != $header_image ) :

	if (
		'always' == $header_image ||
		( 'enable_per'  == $header_image && true  == $enable ) ||
		( 'disable_per' == $header_image && false == $disable )
	) :
	?>
	<div class="site-header-image" role="presentation">
		<figure>
			<?php
			if ( has_header_image() ) {
				$attributes = [
					'alt'  => ''
				];
				the_header_image_tag( $attributes );
			} else {
				echo sprintf(
					'<img src="%1s" alt="" width="2048" height="878" />',
					esc_attr( get_theme_file_uri( '/assets/images/default-header.jpg' ) )
				);
			} ?>
		</figure>
	</div>
	<?php endif; endif; ?>
</header>
