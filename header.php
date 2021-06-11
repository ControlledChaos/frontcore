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
use Front_Core\Classes\Front as Front;

// Conditional canonical link.
if ( is_home() && ! is_front_page() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
    $canonical = get_permalink( get_option( 'page_for_posts' ) );
} else {
    $canonical = get_permalink();
}

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
		<?php Front\tags()->before_header(); ?>
		<?php Front\tags()->header(); ?>
		<?php Front\tags()->after_header(); ?>
	</div>
