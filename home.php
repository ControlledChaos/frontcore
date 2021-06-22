<?php
/**
 * The main blog template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Archives
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Front as Front;

get_header();

?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();

			Front\tags()->content_template();
			endwhile;

			the_posts_navigation( [
				'prev_text' => __( 'Previous', 'frontcore' ),
				'next_text' => __( 'Next', 'frontcore' )
			 ] );

		else :
			Front\tags()->content_template();
		endif;
		?>

		</main>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php

get_footer();
