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
use Front_Core\Classes\Front as Front;

?>
<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

	<div class="site-branding">

		<?php echo Front\tags()->site_logo(); ?>

		<div class="site-title-description">

			<?php if ( is_front_page() ) : ?>
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_attr( esc_url( get_bloginfo( 'url' ) ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif;

			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $site_description; ?></p>
			<?php endif; ?>

		</div>
	</div>

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
</header>
