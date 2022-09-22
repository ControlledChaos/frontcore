<?php
/**
 * Default footer content template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Tags as Tags;

// Copyright HTML.
$copyright = sprintf(
	'<p class="copyright-text" itemscope="itemscope" itemtype="http://schema.org/CreativeWork">&copy; <span class="screen-reader-text">%1s</span><span itemprop="copyrightYear">%2s</span> <span itemprop="copyrightHolder">%3s.</span> %4s.</p>',
	esc_html__( 'Copyright ', 'frontcore' ),
	date( 'Y' ),
	get_bloginfo( 'name' ),
	esc_html__( 'All rights reserved', 'frontcore' )
);

?>
<footer id="colophon" class="site-footer">
	<div class="footer-content global-wrapper footer-wrapper">
		<?php echo apply_filters( 'fct_footer_copyright', $copyright ); ?>
	</div>
</footer>
