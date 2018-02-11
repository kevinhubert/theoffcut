<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.com/
 *
 * @package Atik
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function atik_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container'       => 'posts-container',
		'render'          => 'atik_infinite_scroll_render',
		'footer'          => 'colophon',
		'footer_callback' => 'atik_jetpack_infinite_scroll_footer',
		'wrapper'         => false,
		'posts_per_page'  => get_option( 'posts_per_page' ),
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Jetpack Social Menu.
	add_theme_support( 'jetpack-social-menu' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'atik-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
		),
	));
}
add_action( 'after_setup_theme', 'atik_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function atik_infinite_scroll_render() {
	if ( ! isset( $count ) ) {
		$count = 0;
	}
	while ( have_posts() ) {
		the_post();
	    atik_get_template_part( 'partials/blog-layout-template', array( 'count' => $count ) );
	    $count++;
	}
}

if ( ! function_exists( 'atik_jetpack_infinite_scroll_footer' ) ) :
	/**
	 * Callback for the floating footer when Infinite Scroll is active.
	 *
	 * @since 1.0.0.
	 *
	 * @return void
	 */
	function atik_jetpack_infinite_scroll_footer() {
		?>
		<div id="infinite-footer">
			<div class="container">
				<?php get_footer( 'infinity' ); ?>
			</div>
		</div>
	<?php
	}
endif; // End of atik_jetpack_infinite_scroll_footer().

/**
 * Custom width for Jetpack gallery.
 */
function atik_custom_tiled_gallery_width() {
	return '970';
}
add_filter( 'tiled_gallery_content_width', 'atik_custom_tiled_gallery_width' );

/**
 * Remove Jetpack Share/Like buttons in specific conditions.
 *
 * @since  1.0.1
 * @return void
 */
function atik_remove_share() {
	if ( is_page_template( 'page-templates/template-layout-builder.php' ) ) {
		remove_filter( 'the_content', 'sharing_display',19 );
		remove_filter( 'the_excerpt', 'sharing_display',19 );
		if ( class_exists( 'Jetpack_Likes' ) ) {
			remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
		}
	}
}
add_action( 'loop_start', 'atik_remove_share' );
