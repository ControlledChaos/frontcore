<?php
/**
 * The main blog template
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
		if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>

			<div class="content-loop archive-loop home-loop">
				<?php while ( have_posts() ) : the_post(); ?>
				<?php content_template(); ?>
				<?php endwhile; ?>
			</div>

			<?php the_posts_navigation( [
					'prev_text' => __( 'Previous', 'front-core' ),
					'next_text' => __( 'Next', 'front-core' )
			] ); ?>

		<?php
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
