<?php
/**
 * Admin header template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Admin;

// Alias namespaces.
use FrontCore\Classes\Front as Front;

// Instantiate the Template_Tags class.
new Front\Template_Tags;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">

	<div class="site-branding">

		<?php echo Front\tags()->site_logo(); ?>

		<div class="site-title-description">

			<p class="site-title"><a href="<?php echo esc_attr( esc_url( get_bloginfo( 'url' ) ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php

			$site_description = get_bloginfo( 'description', 'display' );
			if ( $site_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $site_description; ?></p>
			<?php endif; ?>

		</div>
	</div>
</header>
