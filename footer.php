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
use FrontCore\Classes\Front as Front;

?>
	<?php Front\tags()->before_footer(); ?>
	<?php Front\tags()->footer(); ?>
	<?php Front\tags()->after_footer(); ?>

</div><!-- #page -->

<?php Front\tags()->after_page(); ?>
<?php wp_footer(); ?>

<style>.no-js body { visibility: visible !important; }</style>
</body>
</html>
