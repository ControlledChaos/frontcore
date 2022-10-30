<?php
/**
 * Site front page template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Front Page
 * @since      1.0.0
 */

namespace FrontCore;

use function FrontCore\Tags\content_template;

get_header();

?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php

		while ( have_posts() ) : the_post();
			content_template();
		endwhile;

		?>
		<?php
		/**
		 * This posts navigation is provided to avoid confusion.
		 * If this template is to be used for a static front page,
		 * as is most often the case, then this ought to be removed.
		 */
		if ( is_home() ) {
			the_posts_navigation( [
				'prev_text' => __( 'Previous', 'frontcore' ),
				'next_text' => __( 'Next', 'frontcore' )
			] );
		}
		?>
		</main>
	</div>
	<?php
	if ( ! is_page_template( FCT_TMPL_DIR . '/front-page-content-only.php' ) ) {
		get_sidebar();
	}
	?>
</div>
<?php

get_footer();
