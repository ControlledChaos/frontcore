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
<nav id="site-navigation" class="main-navigation" role="directory" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<div class="menu-toggle">
		<button aria-controls="main-menu" aria-expanded="false">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="theme-icon menu-icon menu-open"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="theme-icon menu-icon menu-close"><path d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z"/></svg>
			<?php esc_html_e( 'Menu', 'frontcore' ); ?>
		</button>
	</div>
	<?php
	wp_nav_menu( [
		'theme_location' => 'main',
		'container_id'   => 'main-menu-wrap',
		'menu_id'        => 'main-menu',
		'fallback_cb'    => [ 'FrontCore\Classes\Navigation\Navigation', 'main_nav_fallback' ],
	] );
	?>
</nav>
