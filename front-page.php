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
	<?php
	if ( ! is_page_template( 'page-templates/no-sidebar.php' ) ) {
		get_sidebar();
	}
	?>
</div>
<?php

get_footer();
