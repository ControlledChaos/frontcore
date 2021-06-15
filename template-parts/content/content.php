<?php
/**
 * Default post content template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Front     as Front,
	FrontCore\Classes\Customize as Customize;

// Get the content display setting from the Customizer.
$display = Customize\mods()->blog_format( get_theme_mod( 'fct_blog_format' ) );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php

		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( is_single() ) : ?>

		<div class="entry-meta">
			<?php
				Front\tags()->posted_on();
				Front\tags()->posted_by();
			?>
		</div>

		<?php endif; ?>

	</header>

	<?php if ( is_singular() ) {
		Front\tags()->post_thumbnail();
	} ?>

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

	<footer class="entry-footer">
		<?php  Front\tags()->entry_footer(); ?>
	</footer>

</article>

<?php if ( is_single() ) {
	echo Front\tags()->post_navigation();
} ?>
