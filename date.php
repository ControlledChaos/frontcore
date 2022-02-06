<?php
/**
 * Date archive pages
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
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
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
