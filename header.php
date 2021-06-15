<?php
/**
 * Page header template
 *
 * This is the template that displays all of the <head>
 * section and everything up until <div id="content">
 *
 * @package    Front_Core
 * @subpackage Templates
 * @category   Headers
 * @since      1.0.0
 */

namespace FrontCore;

// Alias namespaces.
use FrontCore\Classes\Front     as Front,
	FrontCore\Classes\Customize as Customize;

// Conditional canonical link.
if ( is_home() && ! is_front_page() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} else {
    $canonical = get_permalink();
}

// Get the navigation location setting from the Customizer.
$nav_location = Customize\mods()->nav_location( get_theme_mod( 'fct_nav_location' ) );

?>
<!doctype html>
<?php

// Hook for ACF forms & similar.
do_action( 'before_html' ); ?>

<html xmlns:og="http://opengraphprotocol.org/schema/" <?php language_attributes(); ?> class="no-js">

<?php Front\tags()->head(); ?>

<body <?php body_class(); ?>>

<?php
Front\tags()->body_open();
Front\tags()->before_page();
?>

<div id="page" class="site" itemscope="itemscope" itemtype="<?php esc_attr( Front\tags()->site_schema() ); ?>">

	<div class="site-header-wrap">

		<?php
		if ( 'before' == $nav_location ) {
			Front\tags()->nav_before_header();
		} ?>
		<?php Front\tags()->before_header(); ?>
		<?php Front\tags()->header(); ?>
		<?php Front\tags()->after_header(); ?>
		<?php
		if ( 'after' == $nav_location ) {
			Front\tags()->nav_after_header();
		} ?>

	</div>
