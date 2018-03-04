<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atik
 */

?><!DOCTYPE html> 
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114353559-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114353559-1');
</script>

</head>

<body <?php body_class(); ?>>

<?php get_template_part( 'partials/wc', 'store-notice' ); ?>

<div id="page" class="container">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'atik' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'partials/woo', 'header-bg' ); ?>

		<?php get_template_part( 'partials/menu', 'top' ); ?>

		<div class="main-header">
			<div class="container">
				<div class="site-branding">
					<div class="site-title-container">
						<?php
						if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
							echo atik_get_logo(); // WPCS: XSS ok.
						} else {
							?>
							<?php if ( false === atik_get_thememod_value( 'bool-hide-title-description' ) ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php endif; ?>
							<?php
						}

						if ( false === atik_get_thememod_value( 'bool-hide-title-description' ) ) :
							$description = get_bloginfo( 'description', 'display' );

							if ( $description || is_customize_preview() ) :
								?>
								<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
							<?php endif; ?>
						<?php endif; ?>

					</div>
				</div><!-- .site-branding -->

				<?php get_template_part( 'partials/menu', 'mobile-toggle' ); ?>

				<?php get_template_part( 'partials/menu', 'main' ); ?> 

			</div>
		</div>

		<?php get_template_part( 'partials/woo', 'header-top' ); ?>

	</header><!-- #masthead -->
</div>
	<?php
	// Show header image on homepage.
	if ( is_front_page() ) {
		get_template_part( 'partials/custom', 'header' );
	}
	?>
<div class="l-homepage-content">
<div class="container">
	<div id="content" class="site-content">
