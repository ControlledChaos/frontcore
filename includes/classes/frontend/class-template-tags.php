<?php
/**
 * Frontend template tags
 *
 * Call new instance of this class in header files.
 * Use of the `$fct_tags` variable is recommended
 * to instantiate, where the prefix matches the
 * rest of this theme's prefixes.
 *
 * @package    Front_Core
 * @subpackage Classes
 * @category   Frontend
 * @since      1.0.0
 */

namespace FrontCore\Classes\Front;

// Alias namespaces.
use FrontCore\Classes\Vendor    as Vendor,
	FrontCore\Classes\Customize as Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Template_Tags {

	/**
	 * The class object
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected static $class_object;

	/**
	 * Instance of the class
	 *
	 * This method can be used to call an instance
	 * of the class from outside the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns an instance of the class.
	 */
	public static function instance() {

		if ( is_null( self :: $class_object ) ) {
			self :: $class_object = new self();
		}

		// Return the instance.
		return self :: $class_object;
	}

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Add classes to previous posts link.
		add_filter( 'previous_posts_link_attributes', function() {

			// Need to be opposite of the filter name!?!
			$attr = 'class="button nav-next"';
			return $attr;
		} );

		// Add classes to next posts link.
		add_filter( 'next_posts_link_attributes', function() {

			// Need to be opposite of the filter name!?!
			$attr = 'class="button nav-previous"';
			return $attr;
		} );
	}

	/**
	 * Load the `<head>` section
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function head() {
		do_action( 'FrontCore\head' );
	}

	/**
	 * Additional hook for scripts & styles
	 *
	 * Triggered after the opening `<body>` tag.
	 *
	 * @link https://make.wordpress.org/themes/2019/03/29/addition-of-new-wp_body_open-hook/
	 * @link https://developer.wordpress.org/reference/functions/wp_body_open/
	 */
	public function body_open() {
		do_action( 'wp_body_open' );
		do_action( 'FrontCore\body_open' );
	}

	/**
	 * Load the page header
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function header() {
		do_action( 'FrontCore\header' );
	}

	/**
	 * Load the page sidebar
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function sidebar() {
		do_action( 'FrontCore\sidebar' );
	}

	/**
	 * Load the search form
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function searchform() {
		do_action( 'FrontCore\searchform' );
	}

	/**
	 * Load the page footer
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function footer() {
		do_action( 'FrontCore\footer' );
	}

	/**
	 * Open template tags
	 *
	 * Following are template tags which may be used
	 * by this theme and are provided for further
	 * development by the theme author, child themes,
	 * or plugins.
	 *
	 * These are named generically since template part
	 * of various types may be loaded.
	 *
	 * @since  1.0.0
	 * @access public
	 */

	// Fires after opening `body` and before `#page`.
	public function before_page() {
		do_action( 'FrontCore\before_page' );
	}

	// Fires before `FrontCore\before_header`.
	public function nav_before_header() {
		do_action( 'FrontCore\nav_before_header' );
	}

	// Fires before `FrontCore\header`.
	public function before_header() {
		do_action( 'FrontCore\before_header' );
	}

	// Fires after `FrontCore\header`.
	public function after_header() {
		do_action( 'FrontCore\after_header' );
	}

	// Fires after site branding.
	public function nav_aside_branding() {
		do_action( 'FrontCore\nav_aside_branding' );
	}

	// Fires after `FrontCore\after_header`.
	public function nav_after_header() {
		do_action( 'FrontCore\nav_after_header' );
	}

	// Fires before `FrontCore\sidebar`.
	public function before_sidebar() {
		do_action( 'FrontCore\before_sidebar' );
	}

	// Fires after `FrontCore\sidebar`.
	public function after_sidebar() {
		do_action( 'FrontCore\after_sidebar' );
	}

	// Fires before `FrontCore\searchform`.
	public function before_searchform() {
		do_action( 'FrontCore\before_searchform' );
	}

	// Fires after `FrontCore\searchform`.
	public function after_searchform() {
		do_action( 'FrontCore\after_searchform' );
	}

	// Fires before `FrontCore\footer`.
	public function before_footer() {
		do_action( 'FrontCore\before_footer' );
	}

	// Fires after `FrontCore\footer`.
	public function after_footer() {
		do_action( 'FrontCore\after_footer' );
	}

	// Fires after `#page` and before `wp_footer`.
	public function after_page() {
		do_action( 'FrontCore\after_page' );
	}

	/**
	 * Site Schema
	 *
	 * Conditional Schema attributes for `<div id="page"`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the relevant itemtype.
	 */
	public function site_schema() {

		// Change page slugs and template names as needed.
		if ( is_page( 'about' ) || is_page( 'about-us' ) || is_page_template( 'page-about.php' ) || is_page_template( 'about.php' ) ) {
			$itemtype = esc_attr( 'AboutPage' );
		} elseif ( is_page( 'contact' ) || is_page( 'contact-us' ) || is_page_template( 'page-contact.php' ) || is_page_template( 'contact.php' ) ) {
			$itemtype = esc_attr( 'ContactPage' );
		} elseif ( is_page( 'faq' ) || is_page( 'faqs' ) || is_page_template( 'page-faq.php' ) || is_page_template( 'faq.php' ) ) {
			$itemtype = esc_attr( 'QAPage' );
		} elseif ( is_page( 'cart' ) || is_page( 'shopping-cart' ) || is_page( 'checkout' ) || is_page_template( 'cart.php' ) || is_page_template( 'checkout.php' ) ) {
			$itemtype = esc_attr( 'CheckoutPage' );
		} elseif ( is_front_page() || is_page() ) {
			$itemtype = esc_attr( 'WebPage' );
		} elseif ( is_author() || is_plugin_active( 'buddypress/bp-loader.php' ) && bp_is_home() || is_plugin_active( 'bbpress/bbpress.php' ) && bbp_is_user_home() ) {
			$itemtype = esc_attr( 'ProfilePage' );
		} elseif ( is_search() ) {
			$itemtype = esc_attr( 'SearchResultsPage' );
		} else {
			$itemtype = esc_attr( 'Blog' );
		}

		// Print the Schema itemtype.
		echo $itemtype;
	}

	/**
	 * Site logo
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed Returns the logo markup or null.
	 */
	public function site_logo( $html = null ) {

		// Get the custom logo URL.
		$logo = get_theme_mod( 'custom_logo' );
		$src  = wp_get_attachment_image_src( $logo , 'full' );

		// Markup if a logo has been set.
		if ( has_custom_logo( get_current_blog_id() ) ) {

			$html = '<div class="site-logo">';

			// Do not link if on the front page.
			if ( is_front_page() ) {

				$html .= sprintf(
					'<img src="%s" />',
					esc_attr( esc_url( $src[0] ) )
				);

			// Linked markup.
			} else {

				$html .= sprintf(
					'<a href="%s"><img src="%s" /></a>',
					esc_attr( esc_url( get_bloginfo( 'url' ) ) ),
					esc_attr( esc_url( $src[0] ) )
				);
			}
			$html .= '</div>';
		}

		// Return the logo markup or null.
		return $html;
	}

	/**
	 * Load main navigation
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function navigation_main() {
		get_template_part( 'template-parts/navigation/navigation-main' );
	}

	/**
	 * Content part
	 *
	 * Get the template part for content by
	 * post type and with ACF filename suffix
	 * if ACF is active.
	 */
	public function content_template() {

		// Instantiate ACF class to get the suffix.
		$acf = new Vendor\Theme_ACF;

		// Post query arguments to look for published posts.
		$args = apply_filters( 'fct_content_template_query', [
			'post_status' => [ 'publish' ],
		] );

		// New query, namespace escaped with backslash.
		$query = new \WP_Query( $args );

		// If the query has at least one post.
		if ( $query->have_posts() ) {

			// Static front page template.
			if ( 'page' == get_option( 'show_on_front' ) && is_front_page() ) {
				$template = 'content-front-page' . $acf->suffix();

			} elseif ( is_page_template( 'page-templates/page-builder.php' ) ) {

				$template = 'content-builder';

			// Look for `content-{$post-type}.php` template.
			} else {
				$template = 'content-' . get_post_type() . $acf->suffix();
			}

		// If the query has no posts.
		} else {
			$template = 'content-none' . $acf->suffix();
		}

		// Look for a specific template as applied above.
		$locate = locate_template( 'template-parts/content/' . $template . '.php' );

		// Use the specific template if found.
		if ( $locate ) {
			$template = $template;

		// Default to generic template ( always for post type: post ).
		} else {
			$template = 'content' . $acf->suffix();
		}

		// Apply a filter for unforeseen conditions.
		$template = apply_filters( 'fct_content_template', $template );

		// Get the content template part.
		return get_template_part( 'template-parts/content/' . $template );
	}

	/**
	 * Posted on
	 *
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the date posted.
	 */
	public function posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'frontcore' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}

	/**
	 * Posted by
	 *
	 * Prints HTML with meta information for the current author.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the author name.
	 */
	public function posted_by() {

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'frontcore' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}

	/**
	 * Entry footer
	 *
	 * Prints HTML with meta information for the categories, tags and comments.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns various post-related links.
	 */
	public function entry_footer() {

		// Get the content display setting from the Customizer.
		$blog_format = Customize\mods()->blog_format( get_theme_mod( 'fct_blog_format' ) );

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			$categories_list = get_the_category_list( esc_html__( ', ', 'frontcore' ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'frontcore' ) . '</span>', $categories_list );
			}

			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'frontcore' ) );

			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'frontcore' ) . '</span>', $tags_list );
			}

		}

		if ( ! is_single() && ! post_password_required() && 'content' == $blog_format && ( comments_open() || get_comments_number() ) ) {

			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'frontcore' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
	}

	/**
	 * Post thumbnail
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns HTML for the post thumbnail.
	 */
	public function post_thumbnail() {

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		} elseif (
			is_page_template( 'page-templates/no-featured.php' ) ||
			is_page_template( 'page-templates/no-sidebar-no-featured.php' ) ||
			is_page_template( 'page-templates/page-builder.php' )
		) {
			return;
		}

		// Check for the large 16:9 video image size.
		if ( has_image_size( 'image-name' ) ) {
			$size = 'large-video';
		} else {
			$size = 'post-thumbnail';
		}

		// Thumbnail image arguments.
		$args = [
			'alt'  => '',
			'role' => 'presentation'
		];


		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail( $size, $args ); ?>
			</div>

			<?php
		else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( $size, $args ); ?>
			</a>

			<?php
		endif;
	}

	/**
	 * Theme toggle script
	 *
	 * Toggles a body class and toggles the
	 * text of the toggle button.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function theme_mode_script() {

	?>
		<script>jQuery(document).ready(function(e){var t=e('.theme-toggle');localStorage.theme?(e('body').addClass(localStorage.theme),e(t).text(localStorage.text)):(e('body').addClass('light-mode'),e(t).text('<?php esc_html_e( 'Dark Theme', 'frontcore' ); ?>')),e(t).click(function(){e('body').hasClass('light-mode')?(e('body').removeClass('light-mode').addClass('dark-mode'),e(t).text('<?php esc_html_e( 'Light Theme', 'frontcore' ); ?>'),localStorage.theme='dark-mode',localStorage.text='<?php esc_html_e( 'Light Theme', 'frontcore' ); ?>'):(e('body').removeClass('dark-mode').addClass('light-mode'),e(t).text('<?php esc_html_e( 'Dark Theme', 'frontcore' ); ?>'),localStorage.theme='light-mode',localStorage.text='<?php esc_html_e( 'Dark Theme', 'frontcore' ); ?>')})});</script>
	<?php

	}

	/**
	 * Theme toggle functionality
	 *
	 * Prints the toggle button and adds the
	 * toggle script to the footer.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function theme_mode() {

		// Add the toggle script to the footer.
		add_action( 'wp_footer', [ $this, 'theme_mode_script' ] );

		// Toggle button markup.
		$button = sprintf(
			'<button class="theme-toggle" type="button" name="dark_light" title="%1s">%2s</button>',
			esc_html__( 'Toggle light/dark theme', 'frontcore' ),
			esc_html__( 'Light Theme', 'frontcore' )
		);

		// Print the toggle button.
		echo $button;
	}

	/**
	 * Get header image alt attribute
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the text of the alt attribute.
	 */
	public function get_header_image_alt() {

		$attachment_id = 0;

		if ( is_random_header_image() && $header_url = get_header_image() ) {

			// For a random header search for a match against all headers.
			foreach ( get_uploaded_header_images() as $header ) {

				if ( $header['url'] == $header_url ) {
					$attachment_id = $header['attachment_id'];
					break;
				}
			}

		// For static headers, less intensive approach.
		} elseif ( $data = get_custom_header() ) {
			$attachment_id = $data->attachment_id;
		}

		// If an attachment ID is found.
		if ( $attachment_id ) {

			$alt = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );

			// Fallback to caption (excerpt).
			if ( ! $alt ) {
				$alt = trim( strip_tags( get_post_field( 'post_excerpt', $attachment_id ) ) );
			}

			// Fallback to title.
			if ( ! $alt ) {
				$alt = trim( strip_tags( get_post_field( 'post_title', $attachment_id ) ) );
			}

		// Return an empty string if no alt could be found.
		} else {
			$alt = '';
		}

		return $alt;
	}

	/**
	 * Post navigation
	 *
	 * Next & previous navigation of singular post types.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	 public function post_navigation() {

		$prev = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $prev ) {
			return;
		}

		global $post;

		$post_id  = get_post_type( $post->ID );
		$get_type = get_post_type_object( $post_id );
		$type     = $get_type->labels->singular_name;

		// Post navigation labels.
		$prev_text = sprintf(
			'%s %s',
			__( 'Previous', 'spr-two' ),
			$type
		);

		$next_text = sprintf(
			'%s %s',
			__( 'Next', 'spr-two' ),
			$type
		);

		// Post navigation links.
		$next_url = get_permalink( $next );
		$prev_url = get_permalink( $prev );

		?>
		<nav class="post-navigation">

			<?php if ( $prev ) : ?>
			<a class="button nav-previous" href="<?php echo $prev_url; ?>" title="<?php echo get_the_title( $prev ); ?>"><?php echo $prev_text; ?></a>
			<?php endif; ?>

			<?php if ( $next ) : ?>
			<a class="button nav-next" href="<?php echo $next_url; ?>" title="<?php echo get_the_title( $next ); ?>"><?php echo $next_text; ?></a>
			<?php endif; ?>
		</nav>
		<?php
	}
}

/**
 * Instance of the class
 *
 * @since  1.0.0
 * @access public
 * @return object Template_Tags Returns an instance of the class.
 */
function tags() {
	return Template_Tags :: instance();
}
