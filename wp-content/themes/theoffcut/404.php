<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Atik
 */

get_header();

$error_page_id = atik_get_thememod_value( '404_custom_page' );

if ( 0 !== $error_page_id ) :

	$post                = get_post( $error_page_id );
	$error_thumbnail     = get_the_post_thumbnail_url( $error_page_id, 'full' );
	$error_cover_opacity = atik_get_thememod_value( '404-cover-opacity' ) / 100;
	$error_cover_color   = atik_get_thememod_value( '404-cover-color' );

	?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found has-background">
				<div class="page-cover-bg" style="background-image:url(<?php echo esc_url( $error_thumbnail ) ?>);">
					<span class="cover" style="opacity:<?php echo $error_cover_opacity; // WPCS: XSS ok. ?>; background-color:<?php echo esc_attr( $error_cover_color ); ?>"></span>
				</div>

				<header class="page-header container">
					<h1 class="page-title"><?php echo $post->post_title; // WPCS: XSS ok. ?></h1>
				</header><!-- .page-header -->

				<div class="entry-content container">
					<?php
					remove_filter( 'the_content', 'sharing_display',19 );
					remove_filter( 'the_excerpt', 'sharing_display',19 );
					echo apply_filters( 'the_content', $post->post_content ); // WPCS: XSS ok.
					?>
				</div><!-- .entry-content -->

			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php else : ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header container">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'atik' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content container">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'atik' ) ?></p>
				</div><!-- .page-content -->

				<div class="search-form-wrapper">
					<?php get_search_form(); ?>
				</div>

			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php endif; ?>

<?php
get_footer();
