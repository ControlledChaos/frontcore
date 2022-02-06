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
use FrontCore\Tags as Tags;

?>
<?php Tags\before_searchform(); ?>
<?php Tags\searchform(); ?>
<?php Tags\after_searchform(); ?>
