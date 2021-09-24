<?php
/**
 * 404 error page widgets
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Error
 * @since      1.0.0
 */

namespace FrontCore;

// Access widgets to check if they're registered.
global $wp_widget_factory;

?>
<div class="error-page-widgets">

<?php if ( is_active_sidebar( 'error-404' ) ) : ?>
	<?php dynamic_sidebar( 'error-404' ); ?>
<?php else : ?>

	<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'frontcore' ); ?></p>

	<?php get_search_form(); ?>

	<?php

	if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Posts'] ) ) {
		the_widget( 'WP_Widget_Recent_Posts' );
	} ?>

	<div class="widget widget_categories">

		<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'frontcore' ); ?></h2>

		<ul>
			<?php
			wp_list_categories( [
				'orderby'    => 'count',
				'order'      => 'DESC',
				'show_count' => 1,
				'title_li'   => '',
				'number'     => 10,
			] );
			?>
		</ul>
	</div>
	<?php

	$archive_content = sprintf(
		'<p>%1s</p>',
		esc_html__( 'Try looking in the monthly archives.', 'frontcore' )
	);

	if ( isset( $wp_widget_factory->widgets['WP_Widget_Archives'] ) ) {
		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
	}

	if ( isset( $wp_widget_factory->widgets['WP_Widget_Tag_Cloud'] ) ) {
		the_widget( 'WP_Widget_Tag_Cloud' );
	}

	?>
	<?php endif; // If is_active_sidebar( 'error-404' ). ?>
</div>
