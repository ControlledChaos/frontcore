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
use FrontCore\Tags as Tags;

// Get the navigation location setting from the Customizer.
$nav_location = Customize\nav_location( get_theme_mod( 'fct_nav_location' ) );

?>
<!doctype html>
<?php

// Hook for ACF forms & similar.
do_action( 'before_html' ); ?>

<html xmlns:og="http://opengraphprotocol.org/schema/" <?php language_attributes(); ?> class="no-js">

<?php Tags\head(); ?>

<body <?php Tags\body_class(); ?>>

<?php
Tags\body_open();
Tags\before_page();
?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_attr( esc_html_e( 'Skip to content', 'frontcore' ) ); ?></a>
<div id="page" class="site" itemscope="itemscope" itemtype="<?php esc_attr( Tags\site_schema() ); ?>">

	<div class="site-header-wrap">

		<?php
		if ( 'before' == $nav_location ) {
			Tags\nav_before_header();
		} ?>
		<?php Tags\before_header(); ?>
		<?php Tags\header(); ?>
		<?php Tags\after_header(); ?>
		<?php
		if ( 'after' == $nav_location ) {
			Tags\nav_after_header();
		} ?>

	</div>
