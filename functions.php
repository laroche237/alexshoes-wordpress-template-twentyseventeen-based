<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enables custom line height for blocks
	 */
	add_theme_support( 'custom-line-height' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'twentyseventeen-featured-image', 2000, 2500, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'twentyseventeen' ),
			'social' => __( 'Social Links Menu', 'twentyseventeen' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://developer.wordpress.org/advanced-administration/wordpress/post-formats/
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width. When fonts are
	 * self-hosted, the theme directory needs to be removed first.
	 */
	$font_stylesheet = str_replace(
		array( get_template_directory_uri() . '/', get_stylesheet_directory_uri() . '/' ),
		'',
		(string) twentyseventeen_fonts_url()
	);
	add_editor_style( array( 'assets/css/editor-style.css', $font_stylesheet ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets'     => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'       => array(
			'home',
			'about'            => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact'          => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog'             => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/sandwich.jpg',
			),
			'image-coffee'   => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods'  => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'   => array(
			// Assign a menu to the "top" location.
			'top'    => array(
				'name'  => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name'  => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filters Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

if ( ! function_exists( 'twentyseventeen_fonts_url' ) ) :
	/**
	 * Register custom fonts.
	 *
	 * @since Twenty Seventeen 1.0
	 * @since Twenty Seventeen 3.2 Replaced Google URL with self-hosted fonts.
	 *
	 * @return string Fonts URL for the theme.
	 */
	function twentyseventeen_fonts_url() {
		$fonts_url = '';

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Libre Franklin, translate this to 'off'. Do not translate into your own language.
		 */
		$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

		if ( 'off' !== $libre_franklin ) {
			$fonts_url = get_template_directory_uri() . '/assets/fonts/font-libre-franklin.css';
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 * @deprecated Twenty Seventeen 3.2 Disabled filter because, by default, fonts are self-hosted.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
// add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'twentyseventeen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'twentyseventeen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'twentyseventeen' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Post title. Only visible to screen readers. */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$customize_preview_data_hue = '';
	if ( is_customize_preview() ) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
	?>
	<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueues scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	$font_version = ( 0 === strpos( (string) twentyseventeen_fonts_url(), get_template_directory_uri() . '/' ) ) ? '20230328' : null;
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), $font_version );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri(), array(), '20241112' );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentyseventeen-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'twentyseventeen-style' ), '20240729' );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '20240412' );
	}

	// Register the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_register_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '20161202' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Register the Internet Explorer 8 specific stylesheet.
	wp_register_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '20161202' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

	// Register the html5 shiv.
	wp_register_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '20161020' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	// Skip-link fix is no longer enqueued by default.
	wp_register_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '20161114', array( 'in_footer' => true ) );

	wp_enqueue_script(
		'twentyseventeen-global',
		get_theme_file_uri( '/assets/js/global.js' ),
		array( 'jquery' ),
		'20211130',
		array(
			'in_footer' => false, // Because involves header.
			'strategy'  => 'defer',
		)
	);

	$twentyseventeen_l10n = array(
		'quote' => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script(
			'twentyseventeen-navigation',
			get_theme_file_uri( '/assets/js/navigation.js' ),
			array( 'jquery' ),
			'20210122',
			array(
				'in_footer' => false, // Because involves header.
				'strategy'  => 'defer',
			)
		);
		$twentyseventeen_l10n['expand']   = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse'] = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']     = twentyseventeen_get_svg(
			array(
				'icon'     => 'angle-down',
				'fallback' => true,
			)
		);
	}

	wp_localize_script( 'twentyseventeen-global', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	wp_enqueue_script(
		'jquery-scrollto',
		get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ),
		array( 'jquery' ),
		'2.1.3',
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function twentyseventeen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentyseventeen-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ), array(), '20240824' );
	// Add custom fonts.
	$font_version = ( 0 === strpos( (string) twentyseventeen_fonts_url(), get_template_directory_uri() . '/' ) ) ? '20230328' : null;
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), $font_version );
}
add_action( 'enqueue_block_editor_assets', 'twentyseventeen_block_editor_styles' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filters the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 * @since Twenty Seventeen 3.7 Added larger image size for small screens.
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '(max-width: 767px) 200vw, 100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string[]     $attr       Array of attribute values for the image markup, keyed by attribute name.
 *                                 See wp_get_attachment_image().
 * @param WP_Post      $attachment Image attachment post.
 * @param string|int[] $size       Requested image size. Can be any registered image size name, or
 *                                 an array of width and height values in pixels (in that order).
 * @return string[] The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 * @return string The template to be used: blank if is_home() is true (defaults to index.php),
 *                otherwise $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'twentyseventeen_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args' );

/**
 * Gets unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Twenty Seventeen 2.0
 *
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function twentyseventeen_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'twentyseventeen' );
	}
endif;

/**
 * Show the featured image below the header on single posts and pages, unless the
 * page is the front page.
 *
 * Use the filter `twentyseventeen_should_show_featured_image` in a child theme or
 * plugin to change when the image is shown. This example prevents the image
 * from showing:
 *
 *     add_filter(
 *         'twentyseventeen_should_show_featured_image',
 *         '__return_false'
 *     );
 *
 * @since Twenty Seventeen 3.7
 *
 * @return bool Whether the post thumbnail should be shown.
 */
function twentyseventeen_should_show_featured_image() {
	$show_featured_image = ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() );
	return apply_filters( 'twentyseventeen_should_show_featured_image', $show_featured_image );
}

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Register block patterns and pattern categories.
 *
 * @since Twenty Seventeen 3.8
 */
function twentyseventeen_register_block_patterns() {
	require get_template_directory() . '/inc/block-patterns.php';
}

add_action( 'init', 'twentyseventeen_register_block_patterns' );

/****************Personnalisation********************************* */

function enqueue_font_awesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );


function customizer_menu_icons($wp_customize) {
    $wp_customize->add_section('menu_icons_section', array(
        'title'    => __('Menu Icons', 'twentyseventeen'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('show_menu_icons', array(
        'default'   => true,
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('show_menu_icons_control', array(
        'label'    => __('Show menu icons', 'twentyseventeen'),
        'section'  => 'menu_icons_section',
        'settings' => 'show_menu_icons',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'customizer_menu_icons');

/*************Slider****************************************** */

function twentyseventeen_enqueue_slider_scripts() {
    // Enqueue Slick CSS and JS
    wp_enqueue_style( 'slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
    wp_enqueue_style( 'slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css' );
    wp_enqueue_script( 'slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_enqueue_slider_scripts' );

function mytheme_customize_register($wp_customize) {
    // Ajout d'une section
    $wp_customize->add_section('custom_images_section', array(
        'title'    => __('Images des Divs', 'mytheme'),
        'priority' => 30,
    ));

    // Ajout d'un paramètre pour chaque image
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting("custom_image_$i", array(
            'default'   => '', // Pas d'image par défaut
            'transport' => 'refresh',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "custom_image_$i", array(
            'label'    => __("Image pour le div $i", 'mytheme'),
            'section'  => 'custom_images_section',
            'settings' => "custom_image_$i",
        )));
    }

	  // Assurez-vous que la section "custom_section" existe, sinon créez-en une
	  $wp_customize->add_section('custom_shopbutton_section', array(
        'title'    => __('Personnalisation du Bouton Shop Now', 'mytheme'),
        'priority' => 30,
    ));

    // Texte du bouton
    $wp_customize->add_setting('shop_button_text', array(
        'default' => 'Shop Now',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('shop_button_text', array(
        'label' => 'Texte du bouton Shop Now',
        'section' => 'custom_shopbutton_section',
        'type' => 'text',
    ));

    // Lien du bouton
    $wp_customize->add_setting('shop_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url',
    ));

    $wp_customize->add_control('shop_button_link', array(
        'label' => 'Lien du bouton Shop Now',
        'section' => 'custom_shopbutton_section',
        'type' => 'url',
    ));

    // Couleur du bouton
    $wp_customize->add_setting('shop_button_color', array(
        'default' => '#7e1212',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'shop_button_color', array(
        'label' => 'Couleur du bouton Shop Now',
        'section' => 'custom_shopbutton_section',
    )));

	// section image about
	$wp_customize->add_section('custom_imageabout_section', array(
        'title'    => __('Image About', 'mytheme'),
        'priority' => 30,
    ));

    // Image de la section abput
    $wp_customize->add_setting('about_image', array(
        'default'   => '', // Pas d'image par défaut
        'transport' => 'refresh',
    ));

  
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "about_image", array(
		'label'    => __("Image pour la section about", 'mytheme'),
		'section'  => 'custom_imageabout_section',
		'settings' => "about_image",
	)));

	// section texte about
	$wp_customize->add_section('custom_texteabout_section', array(
        'title'    => __('About Description', 'mytheme'),
        'priority' => 30,
    ));

   
	$wp_customize->add_setting('about_box_text', array(
        'default' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet bibendum ipsum. Fusce auctor erat euismod velit consectetur, vel tempus leo vulputate. Vivamus tincidunt vitae ligula eu volutpat. Sed malesuada ante sit amet nulla tempor, et dignissim magna lobortis. Nunc in lectus ut sapien feugiat tincidunt. Integer vel sem eu risus pharetra facilisis. Curabitur convallis libero et libero cursus, at tristique purus convallis.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('about_box_text', array(
        'label' => 'About Description',
        'section' => 'custom_texteabout_section',
        'type' => 'text',
    ));


	//Bouton About Section
	// Assurez-vous que la section "custom_section" existe, sinon créez-en une
	$wp_customize->add_section('custom_aboutbutton_section', array(
        'title'    => __('Personnalisation du Bouton About', 'mytheme'),
        'priority' => 30,
    ));

    // Texte du bouton
    $wp_customize->add_setting('about_button_text', array(
        'default' => 'Discover More',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('about_button_text', array(
        'label' => 'Texte du bouton About',
        'section' => 'custom_aboutbutton_section',
        'type' => 'text',
    ));

    // Lien du bouton
    $wp_customize->add_setting('about_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url',
    ));

    $wp_customize->add_control('about_button_link', array(
        'label' => 'Lien du bouton About',
        'section' => 'custom_aboutbutton_section',
        'type' => 'url',
    ));

    // Couleur du bouton
    $wp_customize->add_setting('about_button_color', array(
        'default' => '#7e1212',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'about_button_color', array(
        'label' => 'Couleur du bouton About',
        'section' => 'custom_aboutbutton_section',
    )));

	// section image discover 1
	$wp_customize->add_section('custom_imagedisc1_section', array(
        'title'    => __('Image Discover 1', 'mytheme'),
        'priority' => 30,
    ));

    // Image de la section abput
    $wp_customize->add_setting('disc_1_image', array(
        'default'   => '', // Pas d'image par défaut
        'transport' => 'refresh',
    ));

  
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "disc_1_image", array(
		'label'    => __("Image pour la section disc", 'mytheme'),
		'section'  => 'custom_imagedisc1_section',
		'settings' => "disc_1_image",
	)));

	
	// section image discover 2
	$wp_customize->add_section('custom_imagedisc2_section', array(
        'title'    => __('Image Discover 2', 'mytheme'),
        'priority' => 30,
    ));

    // Image de la section abput
    $wp_customize->add_setting('disc_2_image', array(
        'default'   => '', // Pas d'image par défaut
        'transport' => 'refresh',
    ));

  
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "disc_2_image", array(
		'label'    => __("Image pour la section disc", 'mytheme'),
		'section'  => 'custom_imagedisc2_section',
		'settings' => "disc_2_image",
	)));

	// bouton disc1
	$wp_customize->add_section('custom_disc1button_section', array(
        'title'    => __('Personnalisation du Bouton Disc', 'mytheme'),
        'priority' => 30,
    ));

    // Texte du bouton
    $wp_customize->add_setting('disc1_button_text', array(
        'default' => 'Discover More',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('disc1_button_text', array(
        'label' => 'Texte du bouton About',
        'section' => 'custom_disc1button_section',
        'type' => 'text',
    ));

    // Lien du bouton
    $wp_customize->add_setting('disc1_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url',
    ));

    $wp_customize->add_control('disk1_button_link', array(
        'label' => 'Lien du bouton About',
        'section' => 'custom_disc1button_section',
        'type' => 'url',
    ));

    // Couleur du bouton
    $wp_customize->add_setting('disc1_button_color', array(
        'default' => '#7e1212',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'disc1_button_color', array(
        'label' => 'Couleur du bouton About',
        'section' => 'custom_disc1button_section',
    )));

	// bouton disc2
	$wp_customize->add_section('custom_disc2button_section', array(
        'title'    => __('Personnalisation du Bouton Disc', 'mytheme'),
        'priority' => 30,
    ));

    // Texte du bouton
    $wp_customize->add_setting('disc2_button_text', array(
        'default' => 'ALL SHOES',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('disc2_button_text', array(
        'label' => 'Texte du bouton disc2',
        'section' => 'custom_disc2button_section',
        'type' => 'text',
    ));

    // Lien du bouton
    $wp_customize->add_setting('disc2_button_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url',
    ));

    $wp_customize->add_control('disk2_button_link', array(
        'label' => 'Lien du bouton disc2',
        'section' => 'custom_disc2button_section',
        'type' => 'url',
    ));

    // Couleur du bouton
    $wp_customize->add_setting('disc2_button_color', array(
        'default' => '#7e1212',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'disc2_button_color', array(
        'label' => 'Couleur du bouton disc2',
        'section' => 'custom_disc2button_section',
    )));

	//Image press

	$wp_customize->add_section('custom_imagepress_section', array(
        'title'    => __('Image Press', 'mytheme'),
        'priority' => 30,
    ));

    // Image de la section abput
    $wp_customize->add_setting('press_image', array(
        'default'   => '', // Pas d'image par défaut
        'transport' => 'refresh',
    ));

  
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "press_image", array(
		'label'    => __("Image pour la section press", 'mytheme'),
		'section'  => 'custom_imagepress_section',
		'settings' => "press_image",
	)));

	//footer
	$wp_customize->add_section('custom_footer_section', array(
        'title' => __('Footer Settings', 'yourtheme'),
        'priority' => 130,
    ));

    // Logo Text
    $wp_customize->add_setting('footer_logo_text', array('default' => 'ALEX SHOES'));
    $wp_customize->add_control('footer_logo_text', array(
        'label' => __('Footer Logo Text', 'yourtheme'),
        'section' => 'custom_footer_section',
        'type' => 'text',
    ));

    // Copyright Text
    $wp_customize->add_setting('footer_copyright_text', array('default' => 'ALEX SHOES'));
    $wp_customize->add_control('footer_copyright_text', array(
        'label' => __('Copyright Text', 'yourtheme'),
        'section' => 'custom_footer_section',
        'type' => 'text',
    ));

  

    // Social Links
    $wp_customize->add_setting('footer_instagram', array('default' => '#'));
    $wp_customize->add_control('footer_instagram', array(
        'label' => __('Instagram Link', 'yourtheme'),
        'section' => 'custom_footer_section',
        'type' => 'url',
    ));

    $wp_customize->add_setting('footer_tiktok', array('default' => '#'));
    $wp_customize->add_control('footer_tiktok', array(
        'label' => __('Tiktok Link', 'yourtheme'),
        'section' => 'custom_footer_section',
        'type' => 'url',
    ));

	 // Ajouter une section pour les liens utiles
	 $wp_customize->add_section('useful_links_section', array(
        'title'    => __('Useful Links', 'mytheme'),
        'priority' => 30,
    ));

    // Ajouter un paramètre pour chaque lien
    $links = array('Privacy Policy', 'Terms and Condition', 'General Condition', 'Cookie Policy', 'Download Modules');
    foreach ($links as $index => $link) {
        $setting_id = 'useful_link_' . $index;
        
        $wp_customize->add_setting($setting_id, array(
            'default'   => '#',
            'sanitize_callback' => 'esc_url',
        ));

        $wp_customize->add_control($setting_id, array(
            'label'   => sprintf(__('Link for %s', 'mytheme'), $link),
            'section' => 'useful_links_section',
            'type'    => 'url',
        ));
    }

}
add_action('customize_register', 'mytheme_customize_register');
//Afficher les icones au lieu des titres
function add_menu_icons($item_output, $item, $depth, $args) {
    if ($args->theme_location === 'primary') {
        $icons = array(
            'My Account' => '<i class="fas fa-user"></i>',
            'Cart' => '<i class="fas fa-shopping-bag"></i>',
            'Search' => '<i class="fas fa-search"></i>',
        );

        if (array_key_exists($item->title, $icons)) {
            return '<a href="' . $item->url . '">' . $icons[$item->title] . '</a>';
        }
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'add_menu_icons', 10, 4);
