<?php
/**
 * Page builder content template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Tags      as Tags,
	FrontCore\Customize as Customize;

// Get the content display setting from the Customizer.
$display = Customize\blog_format( get_theme_mod( 'fct_blog_format' ) );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header screen-reader-text">
		<?php

		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		} ?>
	</header>

	<div class="entry-content" itemprop="articleBody">

		<?php

		if ( 'excerpt' == $display ) {
			the_excerpt();
		} else {
			the_content( sprintf(
				wp_kses(
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'frontcore' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				get_the_title()
			) );
		}

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'frontcore' ),
			'after'  => '</div>',
		] );

		?>

	</div>
</article>

<?php if ( is_single() ) {
	echo Tags\post_navigation();
} ?>
