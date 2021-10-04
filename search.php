<?php
/**
 * Search results template
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Archives
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Front as Front;

get_header();

?>
<div id="content" class="site-content">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" itemscope itemprop="mainContentOfPage">

		<?php
		if ( have_posts() ) :

		?>
			<header class="page-header">
				<h1 class="page-title">
					<?php printf( esc_html__( 'Search Results for: %s', 'frontcore' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header>

			<?php while ( have_posts() ) : the_post();

				get_template_part( FCT_PARTS_DIR . '/content/content', 'search' . $fct_acf->suffix() );
				endwhile;

				the_posts_navigation( [
					'prev_text' => __( 'Previous', 'frontcore' ),
					'next_text' => __( 'Next', 'frontcore' )
				] );

		else :
			get_template_part( FCT_PARTS_DIR . '/content/content', 'none' . $fct_acf->suffix() );
		endif;
		?>

		</main>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php

get_footer();