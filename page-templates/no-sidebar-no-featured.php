<?php
/**
 * No Sidebar, No Featured Image template for posts & pages
 *
 * Template Name: No Sidebar, No Featured Image
 * Template Post Type: post, page
 * Description: Does not load the primary sidebar or the featured image.
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Posts
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

		while ( have_posts() ) : the_post();
			Front\tags()->content_template();
		endwhile;

		?>

		</main>
	</div>
</div>
<?php

get_footer();
