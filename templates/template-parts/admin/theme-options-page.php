<?php
/**
 * Theme options page template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Admin
 * @since      1.0.0
 */

namespace FrontCore\Admin\Options;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Page title.
$title = sprintf(
	'<h1 class="wp-heading-inline">%1s %2s</h1>',
	get_bloginfo( 'name' ),
	__( 'Display Options', 'frontcore' )
);

// Page description.
$description = sprintf(
	'<p class="description">%1s</p>',
	__( 'This is a starter/example page. Use it or remove it.', 'frontcore' )
);

?>

<div class="wrap frontcore-options-page">
	<?php echo $title; ?>
	<?php echo $description; ?>
	<hr />
</div>
