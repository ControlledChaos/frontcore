<?php
/**
 * Default, main navigation template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Navigation
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Front as Front;

?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_attr( esc_html_e( 'Skip to content', 'frontcore' ) ); ?></a>

<nav id="site-navigation" class="main-navigation" role="directory" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="theme-icon menu-icon"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
		<?php esc_html_e( 'Menu', 'frontcore' ); ?>
	</button>
	<?php
	wp_nav_menu( [
		'theme_location' => 'main',
		'menu_id'        => 'main-menu',
	] );
	?>
</nav>
