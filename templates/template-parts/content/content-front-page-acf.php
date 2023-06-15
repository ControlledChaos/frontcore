<?php
/**
 * ACF template part for displaying page content in front-page.php
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

if ( Customize\hide_front_heading( get_theme_mod( 'fct_hide_front_heading' ) ) ) {
	$heading_class = 'entry-title screen-reader-text';
} else {
	$heading_class = 'entry-title';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php the_title( "<h2 class='{$heading_class}'>", '</h2>' ); ?>
	</header>

	<?php if ( is_singular() ) {
		if ( ! is_page_template( [
			FCT_TMPL_DIR . '/no-featured.php',
			FCT_TMPL_DIR . '/no-sidebar-no-featured.php'
		] ) ) {
			Tags\post_thumbnail();
		}
	} ?>

	<div class="entry-content" itemprop="articleBody">

		<?php

		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'frontcore' ),
			'after'  => '</div>',
		] );

		?>

	</div>

	<?php if ( is_single() ) :

	?>
	<footer class="entry-footer">
		<?php  Tags\entry_footer(); ?>
	</footer>
	<?php

	endif; ?>

</article>
