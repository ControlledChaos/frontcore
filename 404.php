<?php
/**
 * 404 error template
 *
 * Used if the requested permalink is not found (404 error).
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Errors
 * @since      1.0.0
 */

namespace FrontCore;

use function FrontCore\Tags\content_template;

get_header();

?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">
			<?php content_template(); ?>
		</main>
	</div>
</div>
<?php

get_footer();
