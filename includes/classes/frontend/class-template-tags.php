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
	 * Body classes
	 *
	 * Displays the class names for the body element.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string|string[] $class Space-separated string or array of
	 *                                class names to add to the class list.
	 */
	public function body_class( $class = '' ) {

		/**
		 * Separates class names with a single space,
		 * collates class names for body element.
		 */
		echo 'class="' . esc_attr( implode( ' ', $this->get_body_class( $class ) ) ) . '"';
	}

	/**
	 * Get body classes
	 *
	 * Retrieves an array of the class names for the body element.
	 * The `body_class` filter should still work as expected.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global WP_Query $wp_query The query object.
	 * @param  string|string[] $class Space-separated string or array of class names to add to the class list.
	 * @return string[] Array of class names.
	 */
	public function get_body_class( $class = '' ) {

		// Access global variables.
		global $wp_query;

		// Set up the array of classes.
		$classes = [];

		/**
		 * Native classes
		 *
		 * The following classes, up to the section
		 * marked as custom classes, are native to
		 * the system, copied from the WordPress
		 * `get_body_class` functions.
		 */
		if ( is_rtl() ) {
			$classes[] = 'rtl';
		}

		if ( is_front_page() ) {
			$classes[] = 'home';
		}
		if ( is_home() ) {
			$classes[] = 'blog';
		}
		if ( is_privacy_policy() ) {
			$classes[] = 'privacy-policy';
		}
		if ( is_archive() ) {
			$classes[] = 'archive';
		}
		if ( is_date() ) {
			$classes[] = 'date';
		}
		if ( is_search() ) {
			$classes[] = 'search';
			$classes[] = $wp_query->posts ? 'search-results' : 'search-no-results';
		}
		if ( is_paged() ) {
			$classes[] = 'paged';
		}
		if ( is_attachment() ) {
			$classes[] = 'attachment';
		}
		if ( is_404() ) {
			$classes[] = 'error404';
		}

		if ( is_singular() ) {
			$post_id   = $wp_query->get_queried_object_id();
			$post      = $wp_query->get_queried_object();
			$post_type = $post->post_type;

			if ( is_page_template() ) {
				$classes[] = "{$post_type}-template";

				$template_slug  = get_page_template_slug( $post_id );
				$template_parts = explode( '/', $template_slug );

				foreach ( $template_parts as $part ) {
					$classes[] = "{$post_type}-template-" . sanitize_html_class( str_replace( [ '.', '/' ], '-', basename( $part, '.php' ) ) );
				}
				$classes[] = "{$post_type}-template-" . sanitize_html_class( str_replace( '.', '-', $template_slug ) );
			} else {
				$classes[] = "{$post_type}-template-default";
			}

			if ( is_single() ) {
				$classes[] = 'single';
				if ( isset( $post->post_type ) ) {
					$classes[] = 'single-' . sanitize_html_class( $post->post_type, $post_id );
					$classes[] = 'postid-' . $post_id;

					// Post Format.
					if ( post_type_supports( $post->post_type, 'post-formats' ) ) {
						$post_format = get_post_format( $post->ID );

						if ( $post_format && ! is_wp_error( $post_format ) ) {
							$classes[] = 'single-format-' . sanitize_html_class( $post_format );
						} else {
							$classes[] = 'single-format-standard';
						}
					}
				}
			}

			if ( is_attachment() ) {
				$mime_type   = get_post_mime_type( $post_id );
				$mime_prefix = [ 'application/', 'image/', 'text/', 'audio/', 'video/', 'music/' ];
				$classes[]   = 'attachmentid-' . $post_id;
				$classes[]   = 'attachment-' . str_replace( $mime_prefix, '', $mime_type );

			} elseif ( is_page() ) {

				$classes[] = 'page';
				$page_id   = $wp_query->get_queried_object_id();
				$post      = get_post( $page_id );
				$classes[] = 'page-id-' . $page_id;
				$classes[] = 'page-slug-' . get_post_field( 'post_name', get_post() );

				if ( get_pages(
					[
						'parent' => $page_id,
						'number' => 1,
					]
				) ) {
					$classes[] = 'page-parent';
				}

				if ( $post->post_parent ) {
					$classes[] = 'page-child';
					$classes[] = 'parent-pageid-' . $post->post_parent;
				}
			}
		} elseif ( is_archive() ) {
			if ( is_post_type_archive() ) {
				$classes[] = 'post-type-archive';
				$post_type = get_query_var( 'post_type' );
				if ( is_array( $post_type ) ) {
					$post_type = reset( $post_type );
				}
				$classes[] = 'post-type-archive-' . sanitize_html_class( $post_type );
			} elseif ( is_author() ) {
				$author    = $wp_query->get_queried_object();
				$classes[] = 'author';
				if ( isset( $author->user_nicename ) ) {
					$classes[] = 'author-' . sanitize_html_class( $author->user_nicename, $author->ID );
					$classes[] = 'author-' . $author->ID;
				}
			} elseif ( is_category() ) {
				$cat       = $wp_query->get_queried_object();
				$classes[] = 'category';
				if ( isset( $cat->term_id ) ) {
					$cat_class = sanitize_html_class( $cat->slug, $cat->term_id );
					if ( is_numeric( $cat_class ) || ! trim( $cat_class, '-' ) ) {
						$cat_class = $cat->term_id;
					}

					$classes[] = 'category-' . $cat_class;
					$classes[] = 'category-' . $cat->term_id;
				}
			} elseif ( is_tag() ) {
				$tag       = $wp_query->get_queried_object();
				$classes[] = 'tag';
				if ( isset( $tag->term_id ) ) {
					$tag_class = sanitize_html_class( $tag->slug, $tag->term_id );
					if ( is_numeric( $tag_class ) || ! trim( $tag_class, '-' ) ) {
						$tag_class = $tag->term_id;
					}

					$classes[] = 'tag-' . $tag_class;
					$classes[] = 'tag-' . $tag->term_id;
				}
			} elseif ( is_tax() ) {
				$term = $wp_query->get_queried_object();
				if ( isset( $term->term_id ) ) {
					$term_class = sanitize_html_class( $term->slug, $term->term_id );
					if ( is_numeric( $term_class ) || ! trim( $term_class, '-' ) ) {
						$term_class = $term->term_id;
					}

					$classes[] = 'tax-' . sanitize_html_class( $term->taxonomy );
					$classes[] = 'term-' . $term_class;
					$classes[] = 'term-' . $term->term_id;
				}
			}
		}

		if ( is_user_logged_in() ) {
			$classes[] = 'logged-in';
		}

		if ( is_admin_bar_showing() ) {
			$classes[] = 'admin-bar';
			$classes[] = 'no-customize-support';
		}

		if ( current_theme_supports( 'custom-background' )
			&& ( get_background_color() !== get_theme_support( 'custom-background', 'default-color' ) || get_background_image() ) ) {
			$classes[] = 'custom-background';
		}

		if ( has_custom_logo() ) {
			$classes[] = 'wp-custom-logo';
		}

		if ( current_theme_supports( 'responsive-embeds' ) ) {
			$classes[] = 'wp-embed-responsive';
		}

		$page = $wp_query->get( 'page' );

		if ( ! $page || $page < 2 ) {
			$page = $wp_query->get( 'paged' );
		}

		if ( $page && $page > 1 && ! is_404() ) {
			$classes[] = 'paged-' . $page;

			if ( is_single() ) {
				$classes[] = 'single-paged-' . $page;
			} elseif ( is_page() ) {
				$classes[] = 'page-paged-' . $page;
			} elseif ( is_category() ) {
				$classes[] = 'category-paged-' . $page;
			} elseif ( is_tag() ) {
				$classes[] = 'tag-paged-' . $page;
			} elseif ( is_date() ) {
				$classes[] = 'date-paged-' . $page;
			} elseif ( is_author() ) {
				$classes[] = 'author-paged-' . $page;
			} elseif ( is_search() ) {
				$classes[] = 'search-paged-' . $page;
			} elseif ( is_post_type_archive() ) {
				$classes[] = 'post-type-paged-' . $page;
			}
		}

		/**
		 * Custom classes
		 *
		 * The following classes are specific to this theme.
		 */

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Add class for the static front page.
		if ( is_front_page() && 'page' == get_option( 'show_on_front' ) ) {
			$classes[] = 'static-front';
		 }

		// Adds a class of no-sidebar when there is no default sidebar present.
		if (
			! is_active_sidebar( 'sidebar-default' ) ||
			is_page_template( [
				FCT_TMPL_DIR . '/theme/front-page-content-only.php',
				FCT_TMPL_DIR . '/theme/no-sidebar.php',
				FCT_TMPL_DIR . '/theme/no-sidebar-no-featured.php'
			] )
		) {
			$classes[] = 'no-sidebar';
		}

		// End class conditions.

		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			// Ensure that we always coerce class to being an array.
			$class = [];
		}

		$classes = array_map( 'esc_attr', $classes );

		/**
		 * Filters the list of CSS body class names for the current post or page.
		 *
		 * @param string[] $classes An array of body class names.
		 * @param string[] $class   An array of additional class names added to the body.
		 */
		$classes = apply_filters( 'body_class', $classes, $class );

		return array_unique( $classes );
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

			} elseif ( is_page_template( FCT_TMPL_DIR . '/theme/page-builder.php' ) ) {

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

		// 494 error page.
		if ( is_404() ) {
			$template = '404' . $acf->suffix();
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
			is_page_template( FCT_TMPL_DIR . '/theme/front-page-content-only.php' ) ||
			is_page_template( FCT_TMPL_DIR . '/theme/no-featured.php' ) ||
			is_page_template( FCT_TMPL_DIR . '/theme/no-sidebar-no-featured.php' ) ||
			is_page_template( FCT_TMPL_DIR . '/theme/page-builder.php' )
		) {
			return;
		}

		// Check for the large 16:9 video image size.
		if ( has_image_size( 'large-video' ) ) {
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
	 * NOTE: the script below contains PHP. Translation functions
	 * are used for the text of the toggle button.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function theme_mode_script() {

		?>
		<script><?php echo file_get_contents( FCT_URL . '/assets/js/cookie.min.js' ); ?></script>
		<script>(function(e){e(window).load(function(){var t=e(".theme-toggle"),o=e.cookie("fct_theme_mode_class"),m=e.cookie("fct_theme_mode_text");o||(e.cookie("fct_theme_mode_class","light-mode",{path:"/",expires:7,secure:true}),e("html, body").removeClass("dark-mode").addClass("light-mode")),m||(e.cookie("fct_theme_mode_text","<?php _e('Dark Theme','totem-front'); ?>",{path:"/",expires:7,secure:true}),e(t).text("<?php _e('Dark Theme','totem-front'); ?>")),o&&e("html, body").addClass(o),m&&e(t).text(m),e(t).click(function(){e("html, body").hasClass("light-mode")?(e.cookie("fct_theme_mode_class","dark-mode",{path:"/",expires:7,secure:true}),e.cookie("fct_theme_mode_text","<?php _e('Light Theme','totem-front'); ?>",{path:"/",expires:7,secure:true}),e("html, body").removeClass("light-mode").addClass("dark-mode"),e(t).text("<?php _e('Light Theme','totem-front'); ?>")):(e.cookie("fct_theme_mode_class","light-mode",{path:"/",expires:7,secure:true}),e.cookie("fct_theme_mode_text","<?php _e('Dark Theme','totem-front'); ?>",{path:"/",expires:7,secure:true}),e("html, body").removeClass("dark-mode").addClass("light-mode"),e(t).text("<?php _e('Dark Theme','totem-front'); ?>"))})})})(jQuery);</script>
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

		// Add the toggle script to the footer if the widget is not active.
		if ( is_active_widget( false, false, 'FrontCore\Widgets\Theme_Mode', true ) ) {
			add_action( 'wp_head', [ $this, 'theme_mode_script' ] );
		}

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
