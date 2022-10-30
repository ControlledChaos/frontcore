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
 * the Templates class.
 *
 * @see includes/classes/core/class-templates.php.
 *
 * Template Name: Front Page Content Only
 * Template Post Type: page
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
		endwhile;

		?>

		</main>
	</div>
</div>
<?php

get_footer();
