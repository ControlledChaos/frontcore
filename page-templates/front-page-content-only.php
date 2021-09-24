<?php
/**
 * Front page content-only template
 *
 * Full width, no sidebar, no featured image template.
 *
 * The `Template Post Type` header is left blank to
 * keep this template from being used generally in
 * the `post` or `page` post types. The template is
 * made available only to the static front page in
 * the Page_Templates class.
 *
 * @see includes/classes/core/class-page-templates.php.
 *
 * Template Name: Front Page Content Only
 * Template Post Type:
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