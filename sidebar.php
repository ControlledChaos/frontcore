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
use FrontCore\Tags as Tags;

?>
<?php Tags\before_sidebar(); ?>
<?php Tags\sidebar(); ?>
<?php Tags\after_sidebar(); ?>
