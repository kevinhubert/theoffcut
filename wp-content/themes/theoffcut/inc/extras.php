<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Atik
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function atik_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_single() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	// Add a class if there is a custom header.
	if ( has_header_image() ) {
		$classes[] = 'has-header-image';
	}

	$ext_url_video = get_theme_mod( 'external_header_video' );
	$custom_url_video = get_theme_mod( 'header_video' );

	if ( $custom_url_video ) {
		$classes[] = 'has-header-custom';
	} elseif ( $ext_url_video ) {
		$classes[] = 'has-header-youtube';
	} elseif ( ! $custom_url_video && ! $ext_url_video ) {
		$classes[] = 'has-header-image-only';
	}

	$classes[] = 'column-' . atik_get_thememod_value( 'shop-column' );

	if ( atik_is_woocommerce_activated() ) {
		if ( is_woocommerce() && ( ! is_product() ) ) {
			if ( false !== (bool) atik_get_thememod_value( 'shop-header-img' ) ) {
				$classes[] = 'has-shop-header-image';
			}
		}
	}

	if ( false !== atik_get_thememod_value( 'bool-hide-addtocart' ) ) {
		$classes[] = 'hide-add-to-cart';
	}

	return $classes;
}
add_filter( 'body_class', 'atik_body_classes' );
