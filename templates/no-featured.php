<?php
/**
 * No Featured Image template for posts & pages
 *
 * Template Name: No Featured Image
 * Template Post Type: post, page
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Posts
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
			if ( ! is_page() ) {
				comments_template();
			}
		endwhile;

		?>

		</main>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php

get_footer();
