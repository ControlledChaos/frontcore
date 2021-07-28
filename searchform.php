<?php
/**
 * Default search form template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Forms
 * @since      1.0.0
 */

namespace FrontCore;

// Avoid error on widgets admin screen.
if ( is_admin() ) {
	return;
}

// Alias namespaces.
use FrontCore\Classes\Front as Front;

?>
<?php Front\tags()->before_searchform(); ?>
<?php Front\tags()->searchform(); ?>
<?php Front\tags()->after_searchform(); ?>
