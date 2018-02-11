<?php
/**
 * Atik functions.
 *
 * @package atik
 */

/**
 * Query WooCommerce activation
 */
function atik_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function atik_excerpt_more( $more ) {
	return sprintf( ' <a class="more-link" href="%1$s">%2$s<i class="genericon genericon-next"></i></a>',
		get_permalink( get_the_ID() ),
		esc_html__( 'Read More', 'atik' )
	);
}
add_filter( 'excerpt_more', 'atik_excerpt_more' );

/**
 * Filter the except length to specified characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function atik_custom_excerpt_length( $length ) {
	if ( '' !== atik_get_thememod_value( 'excerpt-length' ) ) {
		return absint( atik_get_thememod_value( 'excerpt-length' ) );
	}

	return 80;
}
add_filter( 'excerpt_length', 'atik_custom_excerpt_length', 999 );

if ( ! function_exists( 'atik_get_logo' ) ) :
	/**
	 * Get theme logo.
	 *
	 * @since 1.0.0
	 * @return mixed
	 */
	function atik_get_logo() {
		$light_logo = atik_get_thememod_value( 'logo-light' );
		if ( '' === $light_logo ) {
			the_custom_logo();
			return false;
		}

		$html = '';
		$html .= '<a href="' . esc_url( home_url( '/' ) ) . '" class="custom-logo-link" rel="home" itemprop="url">';
		$html .= '<img src="' . $light_logo . '" alt="' . get_bloginfo( 'name' ) . '" class="light">';
		$html .= '</a>';

		$has_shop_header_class = in_array( 'has-shop-header-image', get_body_class(), true );

		if ( $has_shop_header_class ) {
			return $html;
		} else {
			the_custom_logo();
			return false;
		}
	}
endif; // End of atik_get_logo.

/**
 * Like get_template_part() put lets you pass args to the template file.
 * Args are available in the template as $template_args array.
 *
 * @param string $file filepart.
 * @param string $template_args Template arguments.
 * @param mixed  $cache_args Style argument list.
 */
function atik_get_template_part( $file, $template_args = array(), $cache_args = array() ) {

	$template_args = wp_parse_args( $template_args );
	$cache_args = wp_parse_args( $cache_args );

	if ( $cache_args ) {

		foreach ( $template_args as $key => $value ) {
			if ( is_scalar( $value ) || is_array( $value ) ) {
				$cache_args[ $key ] = $value;
			} elseif ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
				$cache_args[ $key ] = call_user_func( 'get_id', $value );
			}
		}

		if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {

			if ( ! empty( $template_args['return'] ) )
				return $cache;

			echo $cache;
			return;
		}
	}

	$file_handle = $file;

	do_action( 'start_operation', 'atik_template_part::' . $file_handle );

	if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
		$file = get_stylesheet_directory() . '/' . $file . '.php';

	elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
		$file = get_template_directory() . '/' . $file . '.php';

	ob_start();
	$return = require( $file );
	$data = ob_get_clean();

	do_action( 'end_operation', 'atik_template_part::' . $file_handle );

	if ( $cache_args ) {
		wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
	}

	if ( ! empty( $template_args['return'] ) )
		if ( false === $return ) {
			return false;
		} else {
			return $data;
		}

	echo $data;
}
