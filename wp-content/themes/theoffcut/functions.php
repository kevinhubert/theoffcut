<?php
/**
 * Atik functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Atik
 */

/**
 * The current version of the theme.
 */
define( 'ATIK_VERSION', '1.1.1' );

/**
 * The suffix to use for scripts.
 */
if ( ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) ) {
	define( 'ATIK_SUFFIX', '' );
} else {
	define( 'ATIK_SUFFIX', '.min' );
}


if ( ! function_exists( 'atik_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function atik_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Atik, use a find and replace
		 * to change 'atik' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'atik', get_template_directory() . '/languages' );

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
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Header Menu', 'atik' ),
			'menu-2' => esc_html__( 'Top Header Right', 'atik' ),
			'menu-3' => esc_html__( 'Top Header Left', 'atik' ),
		) );

		global $atik_settings;
		$atik_settings = new ATIK_Settings();

		$google_request = str_replace( ',', '%2C', atik_get_google_font_uri() );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style( array( 'assets/css/editor-style.css', $google_request ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Enable support for site logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 110,
			'width'       => 470,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Enable custom background
		 */
		$args = array(
			'default-color' => 'f4f4f4',
		);
		add_theme_support( 'custom-background', $args );

		/**
		 * Set up the WordPress core custom header feature.
		 *
		 * @since 1.0.0
		 */
		add_theme_support( 'custom-header', apply_filters( 'atik_custom_header_args', array(
			'width'       => 2000,
			'height'      => 800,
			'uploads'     => true,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => false,
			'video'       => true,
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Declare WooCommerce support.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

	}
endif;
add_action( 'after_setup_theme', 'atik_setup' );

/**
 * Load global variables used on the front end.
 *
 * @since 1.0.0.
 *
 * @return void
 */
function atik_frontend_globals() {
	global $atik_settings;
	$atik_settings = new ATIK_Settings();
}

add_action( 'template_redirect', 'atik_frontend_globals' );

/**
 * Add dynamic CSS to WordPress editor.
 *
 * @param  array $mce_init An array of keys.
 * @return array
 */
function atik_wp_editor_dynamic_styles( $mce_init ) {
	$styles  = 'body.mce-content-body a { border-bottom-color: ' . atik_get_thememod_value( 'color-accent' ) . '; }';
	$styles .= 'body.mce-content-body a.button.alt, body.mce-content-body a.button { background-color: ' . atik_get_thememod_value( 'color-accent' ) . '; }';
	$styles .= 'body.mce-content-body { font-family: ' . atik_get_thememod_value( 'font-body' ) . '; }';
	$styles .= 'body.mce-content-body h1,body.mce-content-body h2,body.mce-content-body h3,body.mce-content-body h4,body.mce-content-body h5,body.mce-content-body h6 { font-family: ' . atik_get_thememod_value( 'font-headers' ) . '; }';
	if ( isset( $mce_init['content_style'] ) ) {
		$mce_init['content_style'] .= ' ' . $styles . ' ';
	} else {
		$mce_init['content_style'] = $styles . ' ';
	}
	return $mce_init;
}
add_filter( 'tiny_mce_before_init', 'atik_wp_editor_dynamic_styles' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function atik_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'atik_content_width', 770 );
}
add_action( 'after_setup_theme', 'atik_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function atik_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', 'atik' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Default site sidebar, appears in footer.', 'atik' ),
		'before_widget' => '<div class="grid__col grid__col--1-of-3"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar(array(
		'name'          => esc_html__( 'Featured Slider Section', 'atik' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Use only &ldquo;Featured Slide Item&rdquo; widget here.', 'atik' ),
		'before_widget' => '<li class="slide"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></li>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	if ( function_exists( 'is_woocommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop', 'atik' ),
			'id'            => 'shop-sidebar',
			'description'   => esc_html__( 'Widgets that appears only when choose 3 columns + sidebar at Shop Settings (Customizer).', 'atik' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title heading-strike">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'atik_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function atik_scripts() {
	// Google fonts.
	$google_request = atik_get_google_font_uri();
	if ( '' !== $google_request ) {
		// Enqueue the fonts.
		wp_enqueue_style(
			'atik-google-fonts',
			$google_request,
			'',
			ATIK_VERSION
		);
	}

	wp_enqueue_style( 'genericons', get_parent_theme_file_uri() . '/assets/css/genericons/genericons.css', array(), '3.4.1' );

	wp_enqueue_style( 'atik-style', get_stylesheet_uri() );

	// RTL Support.
	wp_style_add_data( 'atik-style', 'rtl', 'replace' );

	// Theme option styles
	// Note: in the Customizer, these rules are output inline in the document head,
	// because Ajax calls won't recognize the preview values of settings.
	$version = absint( get_theme_mod( 'version', 0 ) );
	if ( ! is_customize_preview() ) {
		wp_enqueue_style(
			'atik-dynamic-style',
			add_query_arg( 'action', 'atik-css-rules', admin_url( 'admin-ajax.php' ) ),
			array( 'atik-style' ),
			$version,
			'screen'
		);
	}

	wp_enqueue_script( 'flexslider', get_parent_theme_file_uri( '/assets/js/jquery.flexslider.js' ), array( 'jquery' ), '2.6.3', true );

	wp_enqueue_script( 'atik-custom', get_parent_theme_file_uri( '/assets/js/jquery.custom.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'atik-navigation', get_parent_theme_file_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'atik-skip-link-focus-fix', get_parent_theme_file_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'atik_scripts' );

if ( ! function_exists( 'atik_required_plugins' ) ) :
/**
 * Require plugins with TGMPA library.
 *
 * @since 1.0.1
 * @return void
 */
function atik_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'WooCommerce - excelling eCommerce',
			'slug'     => 'woocommerce',
			'required' => false,
		),
		array(
			'name'     => 'StagTools',
			'slug'     => 'stagtools',
			'required' => false,
		),
		array(
			'name'     => 'LayerSlider WP',
			'slug'     => 'LayerSlider',
			'source'   => get_parent_theme_file_path() . '/config-layerslider/layerslider.zip',
			'required' => false,
			'version'  => '6.6.8',
		),
	);

	tgmpa( $plugins );
}
endif; // End of atik_required_plugins.
add_action( 'tgmpa_register', 'atik_required_plugins' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_parent_theme_file_path() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_parent_theme_file_path() . '/inc/jetpack.php';

/**
 * Load Atik theme functions file.
 */
require get_parent_theme_file_path() . '/inc/theme-functions.php';
require get_parent_theme_file_path() . '/inc/class-tgm-plugin-activation.php';

if ( atik_is_woocommerce_activated() ) {
	require get_parent_theme_file_path() . '/inc/woocommerce/class-atik-woocommerce.php';
}

/**
 * Widget related files.
 */
require get_parent_theme_file_path() . '/inc/class-widget.php';
require get_parent_theme_file_path() . '/inc/class-widgetized-pages.php';
require get_parent_theme_file_path() . '/inc/widgets/section-category-boxes.php';
require get_parent_theme_file_path() . '/inc/widgets/static-content.php';
require get_parent_theme_file_path() . '/inc/widgets/featured-slide.php';
require get_parent_theme_file_path() . '/inc/widgets/section-featured-slides.php';
require get_parent_theme_file_path() . '/inc/widgets/section-feature-callout.php';
require get_parent_theme_file_path() . '/inc/widgets/section-blog-post.php';

if ( atik_is_woocommerce_activated() ) {
	require get_parent_theme_file_path() . '/inc/widgets/section-feature-product.php';
}

/**
 * Load customizer files.
 */
require get_parent_theme_file_path() . '/inc/customizer/settings.php';
require get_parent_theme_file_path() . '/inc/customizer/css.php';
require get_parent_theme_file_path() . '/inc/customizer/style.php';
require get_parent_theme_file_path() . '/inc/customizer/load.php';
require get_parent_theme_file_path() . '/config-layerslider/layerslider.php';
