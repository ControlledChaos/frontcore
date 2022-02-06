<?php
/**
 * Page footer template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Footers
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Tags as Tags;

?>
	<?php Tags\before_footer(); ?>
	<?php Tags\footer(); ?>
	<?php Tags\after_footer(); ?>

</div><!-- #page -->

<?php Tags\after_page(); ?>
<?php wp_footer(); ?>

<style>.no-js body { visibility: visible !important; }</style>
</body>
</html>
