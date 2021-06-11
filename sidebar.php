<?php
/**
 * Default sidebar template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Asides
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Front as Front;

?>
<?php Front\tags()->before_sidebar(); ?>
<?php Front\tags()->sidebar(); ?>
<?php Front\tags()->after_sidebar(); ?>
