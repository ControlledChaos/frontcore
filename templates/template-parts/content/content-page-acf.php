<?php
/**
 * ACF content template for no posts in blog, archives
 * or in search results
 *
 * Used if the Advanced Custom Fields plugin is active.
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Tags as Tags;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>

	<?php
	if (
		! is_page_template( FCT_TMPL_DIR . '/no-featured.php' ) ||
		! is_page_template( FCT_TMPL_DIR . '/no-sidebar-no-featured.php' )
	) {
		Tags\post_thumbnail();
	}
	?>

	<div class="entry-content" itemprop="articleBody">

		<?php

		the_content();

		wp_link_pages( [
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'frontcore' ),
			'after'  => '</div>',
		] );

		?>

	</div>
</article>
