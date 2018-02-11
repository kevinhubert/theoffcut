<?php
/**
 * Custom header
 *
 * @package Atik
 */

if ( false === get_header_image() || '' === get_header_image() ) {
	return;
}

// Bail, if its a WooCommerce page.
if ( atik_is_woocommerce_activated() && is_woocommerce() ) {
	return;
}

$ext_url_video    = get_theme_mod( 'external_header_video' );
$custom_url_video = absint( get_theme_mod( 'header_video' ) );

?>

<div class="custom-header">
	<div class="custom-header-media">
		<?php if ( $custom_url_video ) : ?>
			<?php the_custom_header_markup(); ?>
		<?php elseif ( $ext_url_video ) : ?>
			<div class="custom-header-media-wrapper">
				<div class="video-bg cover">
					<div class="video-fg">
						<?php the_custom_header_markup(); ?>
					</div>
				</div>
			</div>
		<?php elseif ( ! $custom_url_video && ! $ext_url_video ) : ?>
			<!-- image only, output markup too -->
			<?php the_custom_header_markup(); ?>
		<?php endif; ?>

	</div>

	<?php get_template_part( 'partials/custom-header-box' ); ?>

</div><!-- .custom-header -->
