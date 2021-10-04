<?php
/**
 * 404 error page content template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Error
 * @since      1.0.0
 */

namespace FrontCore;

?>
<section class="error-404 not-found">

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'That page can\'t be found.', 'frontcore' ); ?></h1>
	</header>

	<div class="page-content">
		<?php get_template_part( FCT_PARTS_DIR . '/widgets/404' ); ?>
	</div>
</section>
