<?php
/**
 * @package Atik
 */

/**
 * Return an object containing an array of CSS rules.
 *
 * This function behaves differently depending on which parameters are given.
 * - With no parameters, it returns the rules for all the CSS-related settings using their current stored values.
 * - With an array of setting IDs, it returns the rules for those specific settings, using their current stored values.
 * - With both an array of setting IDs and a corresponding array of values, it will return the rules for those specific settings, using the given values (sanitized).
 *
 * @since 1.0.0.
 *
 * @param  array $setting_ids       An optional array of setting IDs.
 * @param  array $preview_values    An optional array of values for the settings.
 *
 * @return mixed|ATIK_CSS|void
 */
function atik_get_css_rules( $setting_ids = array(), $preview_values = array() ) {
	$settings      = new ATIK_Settings();
	$css           = new ATIK_CSS();
	$setting_pairs = array();

	// Default array of settings.
	if ( empty( $setting_ids ) ) {
		$setting_ids = array(
			'background_color',
			'color-accent',
			'color-footer-background',
			'color-footer-text',
			'color-sticky',
			'color-woo-sale',
			'color-woo-outofstock',
			'font-body',
			'font-headers',
			'bool-hide-credit',
			'custom-settings',
		);
	}

	// Use the saved setting values if no preview values are given.
	if ( empty( $preview_values ) ) {
		foreach ( (array) $setting_ids as $id ) {
			$setting_pairs[ $id ] = $settings->get_value( $id );
		}
	} else {
		$setting_pairs = array_combine( (array) $setting_ids, (array) $preview_values );
		array_walk( $setting_pairs, array( $settings, 'sanitize_value' ) );
	}

	// Iterate through each setting.
	foreach ( $setting_pairs as $setting_id => $sanitized_value ) {
		/**
		 * Filter to override the CSS rules for a particular setting.
		 *
		 * To override the CSS rules for a setting, create a function that accepts all three
		 * of the parameters of this filter. Use the ATIK_CSS methods in the $css parameter
		 * to add custom rules, then return $css instead of $override.
		 *
		 * Example:
		 * function child_css_override_titlecolor( $override, $setting_id, $css ) {
		 *     if ( 'color-site-title' === $setting_id ) {
		 *         $css->add( array(
		 *             'selectors'    => array(
		 *                 '.site-title', '.site-title a',
		 *             ),
		 *             'declarations' => array(
		 *                 'background-color' => $settings->get_value( $setting_id ),
		 *             ),
		 *         ) );
		 *         return $css;
		 *     }
		 *
		 *     return $override;
		 * }
		 * add_filter( 'atik_css_rule_override', 'child_css_override_titlecolor', 10, 4 );
		 *
		 * To add rules for a setting not in the defaults list, or a new setting, use the 'custom-settings'
		 * value for the setting ID, like this:
		 *
		 *     if ( 'custom-settings' === $setting_id ) {
		 *         // Rules go here.
		 *     }
		 *
		 * @since 1.0.0.
		 *
		 * @param bool|ATIK_CSS    $override           Value determines whether setting CSS rules get overridden.
		 * @param string               $setting_id         The ID of the setting to override.
		 * @param mixed                $sanitized_value    The sanitized value currently assigned to the setting.
		 * @param ATIK_CSS         $css                The instance of ATIK_CSS.
		 */
		$override = apply_filters( 'atik_css_rule_override', false, $setting_id, $sanitized_value, $css );
		if ( false !== $override && 'ATIK_CSS' === get_class( $override ) ) {
			$css = $override;
			continue;
		}

		switch ( $setting_id ) {
			case 'font-body' :
				$css->add( array(
					'selectors'    => array(
						'body',
						'button',
						'input',
						'select',
						'textarea',
						'.taxonomy-description',
						'.products-list.products .product-category .count',
					),
					'declarations' => array(
						'font-family' => "'$sanitized_value'",
					),
				) );
				break;
			case 'font-headers' :
				$css->add( array(
					'selectors'    => array(
						'.site-branding',
						'h1,h2,h3,h4,h5,h6',
					),
					'declarations' => array(
						'font-family' => "'$sanitized_value'",
					),
				) );
				break;
			case 'color-accent' :
				$css->add( array(
					'selectors'    => array(
						'a:hover',
						'a:focus',
						'a:active',
						'.page-title span',
						'.extra-menu > li > a:hover',
						'.extra-menu > li > a:active',
						'.extra-menu > li > a:focus',
						'.cart_list.cart_list a.remove:hover',
						'.cart_list.cart_list a.remove:active',
						'.cart_list.cart_list a.remove:focus',
						'.extra-menu .cart.sfHover > a',
						'.search-results-title span',
						'.blog .page-header .page-title span',
						'.archive .page-header .page-title span',
						'.post-navigation .post-title:hover',
					),
					'declarations' => array(
						'color' => $sanitized_value,
					),
				) );
				$css->add( array(
					'selectors'    => array(
						'button',
						'.button',
						'.milestone-header.milestone-header',
						'.store-notice-container',
						'.twitter-follow-button:hover',
						'.instagram-follow-link:hover',
						'input[type="reset"]',
						'input[type="submit"]',
						'input[type="button"]',
						'.hentry.sticky.has-post-thumbnail .sticky-post',
						'.hentry.has-post-thumbnail .sticky-post',
						'.home-widget.widget_search',
						'.home-widget.widget_product_search',
						'.error-404 .search-form-wrapper',
						'.button.alt',
						'.woocommerce-pagination a.page-numbers:hover',
						'.woocommerce-pagination a.page-numbers:active',
						'.woocommerce-pagination a.page-numbers:focus',
						'.woocommerce-info .button:hover',
						'.woocommerce-info .button:active',
						'.woocommerce-info .button:focus',
						'.product-thumbnails.flexslider .flex-direction-nav a:hover',
						'.product-thumbnails .flex-active-slide',
						'.posts-navigation a',
						'.woocommerce-account.woocommerce-view-order .woocommerce > p + .button',
						'.woocommerce .comment .meta .verified',
						'.widget_price_filter .ui-slider .ui-slider-range',
						'.widget_price_filter .ui-slider .ui-slider-range',
						'.widget_price_filter .ui-slider .ui-slider-handle',
						'.woocommerce-message',
						'.widget_shopping_cart_content .buttons .button',
						'.stag-instagram .stag-button',
						'.comment-reply-link',
						'.woocommerce-pagination span.page-numbers.current',
						'.woocommerce-info .button',
					),
					'declarations' => array(
						'background-color' => $sanitized_value,
					),
				) );
				$css->add( array(
					'selectors'    => array(
						'.main-navigation .primary-menu > li:hover > a',
						'.main-navigation ul ul :hover > a',
						'.main-navigation .current-menu-item > a',
						'.main-navigation .current_page_item > a',
						'.main-navigation .current_page_parent > a',
						'.main-navigation .current-menu-parent > a',
						'.main-navigation .current-menu-ancestor > a',
						'.main-navigation .current_page_parent > a',
						'.woocommerce-tabs .tabs li.active a',
						'.entry-content p > a:not(.button):not(.stag-button)',
						'.entry-summary p > a:not(.more-link)',
						'.header-image-description a',
						'.atik_widget_featured_slides a',
						'.site-slider .slide-desc a:not(.button)',
						'.lost_password a',
						'.woocommerce-tabs.wc-tabs-wrapper .tabs li a:hover',
						'.woocommerce-tabs.wc-tabs-wrapper .accordion-tab a:hover',
					),
					'declarations' => array(
						'border-bottom-color' => $sanitized_value,
					),
				) );
				break;
			case 'color-footer-background' :
				$css->add( array(
					'selectors'    => array(
						'.site-footer',
						'.footer-toggle',
					),
					'declarations' => array(
						'background-color' => $sanitized_value,
					),
				) );
				break;
			case 'color-footer-text' :
				$css->add( array(
					'selectors'    => array(
						'.site-footer',
						'.site-footer a',
						'.site-footer button',
						'.site-footer select',
						'.site-footer textarea',
						'.site-footer .genericon',
						'.site-footer .cart_list a.remove',
						'.site-footer .wp-caption',
						'.site-footer .cart_list .amount',
						'.site-footer .widget_shopping_cart_content .total',
						'.site-footer .wp-caption',
						'.site-footer .cart_list .variation dt',
						'.site-footer .cart_list .variation dd',
						'.site-footer .cart_list .quantity',
					),
					'declarations' => array(
						'color' => $sanitized_value,
					),
				) );
				$css->add( array(
					'selectors'    => array(
						'.site-footer input',
						'.site-footer button',
						'.site-footer select',
						'.site-footer textarea',
						'.site-footer .widget-title',
					),
					'declarations' => array(
						'border-color' => $sanitized_value,
					),
				) );
				break;
			case 'color-sticky' :
				$css->add( array(
					'selectors'    => array(
						'.hentry.sticky.has-post-thumbnail .sticky-post',
						'.hentry.has-post-thumbnail .sticky-post',
					),
					'declarations' => array(
						'background-color' => $sanitized_value,
					),
				) );
				break;
			case 'color-woo-sale' :
				$css->add( array(
					'selectors'    => array(
						'.product .onsale',
					),
					'declarations' => array(
						'background-color' => $sanitized_value,
					),
				) );
				break;
			case 'color-woo-outofstock' :
				$css->add( array(
					'selectors'    => array(
						'.product .out-of-stock',
					),
					'declarations' => array(
						'background-color' => $sanitized_value,
					),
				) );
				break;
			case 'bool-hide-credit' :
				if ( true === $sanitized_value ) {
					$css->add( array(
						'selectors'    => array(
							'.site-byline'
						),
						'declarations' => array(
							'display' => 'none',
						),
					) );
				} else {
					$css->add( array(
						'selectors'    => array(
							'.site-byline'
						),
						'declarations' => array(
							'display' => 'block',
						),
					) );
				}
				break;
		}
	}

	return $css;
}

/**
 * Output the theme CSS rules as an inline style element.
 *
 * Used in the Customizer preview pane.
 *
 * @since 1.0.0.
 *
 * @return void
 */
function atik_inline_css_rules() {
	// Get the rules.
	$css = atik_get_css_rules();

	// Build the rules.
	$output = $css->build();

	// Output the rules.
	if ( ! empty( $output ) ) {
		echo "\n<style type=\"text/css\" id=\"atik-inline-css\">\n";
		echo  $output;
		echo "\n</style>\n";
	}
}

if ( is_customize_preview() ) {
	// Only add the inline rules in the Customizer preview pane.
	add_action( 'wp_head', 'atik_inline_css_rules', 99 );
}

/**
 * Add the theme CSS rules to the content editor.
 *
 * @since 1.0.0.
 *
 * @param  string    $stylesheets    The comma-separated string of stylesheet URLs.
 *
 * @return string                    The modified string of stylesheet URLs.
 */
function atik_editor_css_rules( $stylesheets ) {
	$stylesheets .= ',' . add_query_arg( 'action', 'atik-css-rules', admin_url( 'admin-ajax.php' ) );
	return $stylesheets;
}

add_filter( 'mce_css', 'atik_editor_css_rules', 99 );

/**
 * Generates the theme CSS as an Ajax response.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function atik_ajax_css_rules() {
	// Make sure this is an Ajax request.
	if ( ! defined( 'DOING_AJAX' ) || true !== DOING_AJAX ) {
		return;
	}

	/**
	 * Filter whether the dynamic stylesheet will send headers telling the browser
	 * to cache the request. Set to false to turn off these headers.
	 *
	 * @since 1.0.0.
	 *
	 * @param bool    $cache_headers
	 */
	if ( true === apply_filters( 'atik_stylesheet_cache_headers', true ) ) {
		// Set headers for caching
		// @link http://stackoverflow.com/a/15000868
		// @link http://www.mobify.com/blog/beginners-guide-to-http-cache-headers/
		$expires = HOUR_IN_SECONDS;
		header( 'Pragma: public' );
		header( 'Cache-Control: private, max-age=' . $expires );
		header( 'Expires: ' . gmdate( 'D, d M Y H:i:s', time() + $expires ) . ' GMT' );
	}

	// Set header for content type.
	header( 'Content-type: text/css' );

	// Get the rules.
	$css = atik_get_css_rules();

	// Echo the rules.
	echo  $css->build();

	// End the Ajax response.
	die();
}

add_action( 'wp_ajax_atik-css-rules', 'atik_ajax_css_rules' );
add_action( 'wp_ajax_nopriv_atik-css-rules', 'atik_ajax_css_rules' );

/**
 * Returns the theme CSS as a JSON object.
 *
 * Used for asynchronous previewing in the Customizer.
 *
 * @since 1.0.0.
 *
 * @return void
 */
function atik_ajax_css_json() {
	// Make sure this is an Ajax request.
	if ( ! defined( 'DOING_AJAX' ) || true !== DOING_AJAX ) {
		return;
	}

	$settings = new ATIK_Settings();

	// Get post parameters.
	$setting_ids = array();
	if ( isset( $_POST['sid'] ) ) {
		$setting_ids = array_map( 'sanitize_title_with_dashes', (array) $_POST['sid'] );
	}
	$values = array();
	if ( isset( $_POST['val'] ) ) {
		foreach ( (array) $_POST['val'] as $index => $raw_value ) {
			$values[ $index ] = $settings->sanitize_value( $raw_value, $setting_ids[ $index ] );
		}
	}

	// Generate the rules.
	$css = atik_get_css_rules( $setting_ids, $values );

	// Send response.
	if ( isset( $css->data ) && is_array( $css->data ) && ! empty( $css->data ) ) {
		wp_send_json_success( $css->data );
	} else {
		wp_send_json_error( $css );
	}
}

add_action( 'wp_ajax_atik-css-json', 'atik_ajax_css_json' );

/**
 * Saves a version number (Unix timestamp) when Customizer settings are saved.
 *
 * @since 1.0.0.
 *
 * @return void
 */
function atik_customize_save_version() {
	set_theme_mod( 'version', time() );
}

add_action( 'customize_save_after', 'atik_customize_save_version' );
