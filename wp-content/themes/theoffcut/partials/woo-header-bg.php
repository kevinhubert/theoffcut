<?php
/**
 * Template part for displaying shop header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

$shop_header_image = wp_get_attachment_url( atik_get_thememod_value( 'shop-header-img' ) );
$shop_opacity = atik_get_thememod_value( 'shop-header-cover-opacity' ) / 100;
$shop_cover_color = atik_get_thememod_value( 'shop-header-cover-color' );

if ( ! atik_is_woocommerce_activated() ) {
	return false;
}
if ( ! is_woocommerce() || is_product() ) {
	return false;
}
if ( false === (bool) atik_get_thememod_value( 'shop-header-img' ) ) {
	return false;
}
?>

<div class="shop-header-background" style="background-image:url(<?php echo esc_url( $shop_header_image ) ?>);">
	<span class="cover" style="opacity:<?php echo $shop_opacity; ?>; background-color:<?php echo esc_attr( $shop_cover_color ); ?>"></span>
</div>
