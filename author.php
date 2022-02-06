<?php
/**
 * Author archive template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Archives
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
		if ( have_posts() ) :

		?>
			<header class="page-header">
				<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$post  = get_post_type_object( get_post_type() );
				$name  = ucwords( $post->labels->menu_name );

				if ( is_main_query() && ( is_paged() && 1 == $paged ) || ! is_paged() ) {
					get_template_part( FCT_PARTS_DIR . '/content/author-section' );
				} else {
					printf(
						'<h1 class="page-title">%s %s %s</h1>',
						$name,
						__( 'Authored By', 'frontcore' ),
						esc_html( get_the_author() )
					);
				}
				?>
			</header>

			<?php while ( have_posts() ) : the_post();

				content_template();
				endwhile;

				the_posts_navigation( [
					'prev_text' => __( 'Previous', 'frontcore' ),
					'next_text' => __( 'Next', 'frontcore' )
				] );

		else :
			content_template();
		endif;
		?>

		</main>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php

get_footer();
