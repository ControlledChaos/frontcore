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

// Alias namespaces.
use Front_Core\Classes\Front as Front;

?>
<?php Front\tags()->before_searchform(); ?>
<?php Front\tags()->searchform(); ?>
<?php Front\tags()->after_searchform(); ?>
