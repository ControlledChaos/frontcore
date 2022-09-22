<?php
/**
 * Content template for search results
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
		<?php

		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<?php

		if ( is_single() ) :

		?>
		<div class="entry-meta">
			<?php
			Tags\posted_on();
			Tags\posted_by();
			?>
		</div>

		<?php endif; ?>

	</header>

	<?php  Tags\post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer">
		<?php  Tags\entry_footer(); ?>
	</footer>

</article>
