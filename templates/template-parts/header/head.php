<?php
/**
 * The default head section
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace FrontCore;

// Conditional canonical link.
if ( is_home() && ! is_front_page() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} else {
    $canonical = get_permalink();
}

?>
<head id="<?php echo esc_attr( get_bloginfo( 'url' ) ); ?>" data-template-set="<?php echo esc_attr( get_template() ); ?>">

	<meta charset="<?php esc_attr( bloginfo( 'charset' ) ); ?>">
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php if ( is_singular() && pings_open() ) {
		echo sprintf( '<link rel="pingback" href="%s" />', esc_attr( get_bloginfo( 'pingback_url' ) ) );
	} ?>

	<link href="<?php echo esc_attr( $canonical ); ?>" rel="canonical" />

	<?php if ( is_search() ) { echo '<meta name="robots" content="noindex,nofollow" />'; } ?>

	<link rel="preconnect" href="//fonts.adobe.com" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<?php
	// Hook into the head.
	do_action( 'before_wp_head' );
	wp_head();
	do_action( 'after_wp_head' );
	?>

</head>
