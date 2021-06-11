<?php
/**
 * Embedded post template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Posts
 * @since      1.0.0
 */

get_header( 'embed' );

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content/content', 'embed' );
	endwhile;
else :
	get_template_part( 'template-parts/content/content', 'none-embed' );
endif;

get_footer( 'embed' );
