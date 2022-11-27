<?php
/**
 * Page builder template for posts & pages
 *
 * Template Name: Page Builder
 * Template Post Type: post, page
 * Description: Does not load the primary sidebar or the featured image.
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Posts
 * @since      1.0.0
 */

namespace FrontCore;

use function FrontCore\Tags\content_template;

get_header( 'builder' );

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
</div>
<?php

get_footer();
