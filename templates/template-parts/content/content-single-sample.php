<?php
/**
 * Content for singular sample post type
 *
 * This is provided for compatibility with the
 * Site Core plugin and its content filter classes.
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

$object = get_post_type_object( get_post_type( get_the_ID() ) );

if ( $object->labels->singular_name ) {
	$name = $object->labels->singular_name;
} else {
	$name = $object->labels->name;
}

printf(
	__( '<p>Filtered content for %s #%s</p>', 'sitecore' ),
	$name,
	get_the_ID()
);

printf(
	__( '<p>This template is being displayed because the sample content filter class in the companion plugin has been instantiated.</p>', 'sitecore' )
);
