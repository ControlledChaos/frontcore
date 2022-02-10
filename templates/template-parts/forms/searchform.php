<?php
/**
 * Default search form template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Forms
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Tags as Tags;

?>
<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label for="search" class="screen-reader-text"><?php _e( 'Search for:', 'frontcore' ); ?></label>
	<input type="search" class="search" id="search" name="s" value="" placeholder="<?php _e( 'Search', 'frontcore' ); ?>" />
	<button type="submit" id="search-submit" class="search-submit">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" aria-hidden="true" role="img"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" /></svg>
		<span class="screen-reader-text"><?php _e( 'Search', 'frontcore' ); ?></span>
	</button>

</form>
