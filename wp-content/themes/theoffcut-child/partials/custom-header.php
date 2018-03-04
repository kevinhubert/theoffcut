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


<div class="l-banner" style="background-image: url(<?php header_image(); ?>);">
	<span class="has-overlay"></span>
</div>

<div class="l-banner__text">
	<div class="l-banner__text--title">
		Handmade goods from Austin Texas
	</div>
	<div class="l-banner__text--subtitle">
		crafted locally with love
	</div>
</div><!-- .l-banner -->
