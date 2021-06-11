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
use Front_Core\Classes\Front as Front;

?>
	<?php Front\tags()->before_footer(); ?>
	<?php Front\tags()->footer(); ?>
	<?php Front\tags()->after_footer(); ?>

</div><!-- #page -->

<?php Front\tags()->after_page(); ?>
<?php wp_footer(); ?>

</body>
</html>
