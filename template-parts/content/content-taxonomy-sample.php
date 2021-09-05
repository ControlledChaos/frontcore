<?php
/**
 * Content for sample post type in taxonomy archive
 *
 * This is provided for compatibility with the
 * Site Core plugin and its content filter classes.
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

printf(
	'<p>%s%s</p>',
	__( 'Content for taxonomy post #', 'frontcore' ),
	get_the_ID()
);
