<?php
/**
 * Admin page navigation template
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
	<?php
	wp_nav_menu( [
		'theme_location' => 'admin',
		'container_id'   => 'main-menu-wrap',
		'menu_id'        => 'main-menu',
		'fallback_cb'    => false,
	] );
	?>
</nav>
