<?php
/**
 * @package Atik
 */

/**
 * Get the array of definitions for Customizer settings and controls.
 *
 * @since 1.0.0.
 *
 * @param  object $wp_customize    The Customizer instance.
 *
 * @return mixed|void
 */
function atik_customize_get_definitions( $wp_customize ) {
	$google_fonts = atik_all_font_choices();

	$wp_customize->add_panel( 'atik_options_panel', array(
		'title'       => esc_html__( 'Theme Options', 'atik' ),
		'description' => esc_html__( 'Configure your theme settings', 'atik' ),
		'priority' => 999,
	) );

	$definitions = array(
		'title_tagline' => array(
			'options' => array(
				'logo-light' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Image_Control',
						'label' => esc_html__( 'Logo (Light)', 'atik' ),
						'description' => esc_html__( 'Choose a logo that will show over a dark background.', 'atik' ),
						'priority' => 8,
					),
				),
				'bool-hide-title-description' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'type' => 'checkbox',
						'label' => esc_html__( 'Hide Site Title & Description', 'atik' ),
					),
				),
			),
		),

		'colors' => array(
			'title' => esc_html__( 'Colors', 'atik' ),
			'description' => '',
			'priority' => '',
			'options' => array(
				'color-accent' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label' => esc_html__( 'Accent', 'atik' ),
					),
				),
				'color-footer-background' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label' => esc_html__( 'Footer Background', 'atik' ),
					),
				),
				'color-footer-text' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label' => esc_html__( 'Footer Text Color', 'atik' ),
					),
				),
				'color-sticky' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label' => esc_html__( '"Sticky" Label', 'atik' ),
					),
				),
				'color-woo-sale' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label' => esc_html__( '"Sale" Label', 'atik' ),
					),
				),
				'color-woo-outofstock' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label' => esc_html__( '"Out of stock" Label', 'atik' ),
					),
				),
			),
		),

		'atik_fonts' => array(
			'title' => esc_html__( 'Fonts', 'atik' ),
			'description' => sprintf(
				esc_html__( 'The list of Google fonts is long! You can %s before making your choices.', 'atik' ),
				sprintf(
					'<a href="%1$s" target="_blank">%2$s</a>',
					esc_url( 'https://fonts.google.com' ),
					esc_html__( 'preview', 'atik' )
				)
			),
			'priority' => $wp_customize->get_section( 'colors' )->priority + 1,
			'options' => array(
				'font-body' => array(
					'setting' => array(),
					'control' => array(
						'type' => 'select',
						'choices' => $google_fonts,
						'label' => esc_html__( 'Body', 'atik' ),
					),
				),
				'font-headers' => array(
					'setting' => array(),
					'control' => array(
						'type' => 'select',
						'choices' => $google_fonts,
						'label' => esc_html__( 'Headers', 'atik' ),
					),
				),
				'google-font-subset' => array(
					'setting' => array(),
					'control' => array(
						'type' => 'select',
						'choices' => atik_get_google_font_subsets(),
						'label' => esc_html__( 'Google Font Subset', 'atik' ),
						'description' => sprintf(
							esc_html__( 'Not all fonts provide each of these subsets. Please visit the %s to see which subsets are available for each font.', 'atik' ),
							sprintf(
								'<a href="%1$s" target="_blank">%2$s</a>',
								esc_url( 'https://fonts.google.com' ),
								esc_html__( 'Google Fonts website', 'atik' )
							)
						),
					),
				),
			),
		),

		'header_image' => array(
			'options' => array(
				'header-image-title' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'type' => 'text',
						'label' => esc_html__( 'Custom Header Title', 'atik' ),
					),
				),
				'header-image-description' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'type' => 'textarea',
						'label' => esc_html__( 'Custom Header Content', 'atik' ),
					),
				),
				'header-image-button-url' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'type' => 'text',
						'label' => esc_html__( 'Button URL', 'atik' ),
					),
				),
				'header-image-button-label' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'type' => 'text',
						'label' => esc_html__( 'Button Label', 'atik' ),
					),
				),
				'header-image-position' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'label' => esc_html__( 'Content Position', 'atik' ),
						'type' => 'select',
						'choices' => array(
							'left' => esc_html__( 'Left', 'atik' ),
							'center' => esc_html__( 'Center', 'atik' ),
							'right' => esc_html__( 'Right', 'atik' ),
						),
					),
				),
			),
		),

		'atik_labels' => array(
			'title' => esc_html__( 'Labels', 'atik' ),
			'panel' => 'atik_options_panel',
			'options' => array(
				'mobile-menu-label' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label' => esc_html__( 'Mobile Menu Label', 'atik' ),
						'type' => 'text',
					),
				),
				'sticky-label' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label' => esc_html__( 'Sticky Label', 'atik' ),
						'type' => 'text',
					),
				),
			),
		),

		'atik_blog_layout' => array(
			'title' => esc_html__( 'Blog Layout', 'atik' ),
			'description' => esc_html__( 'Here you can customize your blog layout options. When selecting third layout, only posts with featured images will be displayed.', 'atik' ),
			'panel' => 'atik_options_panel',
			'options' => array(
				'blog-layout' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label' => esc_html__( 'Layout', 'atik' ),
						'type' => 'radio',
						'choices' => array(
							'one' => '1',
							'two' => '2',
							'three' => '3',
						),
					),
				),
				'single-layout' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label' => esc_html__( 'Single Post / Page Style', 'atik' ),
						'type' => 'radio',
						'choices' => array(
							'featured-full-width' => esc_html__( 'Full Width Featured Image', 'atik' ),
							'featured-boxed' => esc_html__( 'Boxed Featured Image', 'atik' ),
						),
					),
				),
				'excerpt-length' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'       => esc_html__( 'Excerpt Length', 'atik' ),
						'description' => esc_html__( 'Define post excerpt length for blog posts (applies to Blog Layout 1 &amp; 2)', 'atik' ),
						'type'        => 'number',
						'input_attrs' => array(
							'step' => 5,
							'min' => 10,
							'max' => 200,
						),
					),
				),
			),
		),

		'atik_shop_settings' => array(
			'title' => esc_html__( 'Shop Settings', 'atik' ),
			'description' => esc_html__( 'Here you can customize your shop settings.', 'atik' ),
			'panel' => 'atik_options_panel',
			'active_callback' => 'atik_is_woocommerce_activated',
			'options' => array(
				'shop-header-img' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Cropped_Image_Control',
						'label'         => esc_html__( 'Shop Header Image', 'atik' ),
						'description'   => esc_html__( 'Upload a custom image to shop header. Suggested image dimensions: 1200 × 600', 'atik' ),
						'flex_width'    => true,
						'flex_height'   => true,
						'width'         => 1200,
						'height'        => 600,
					),
				),
				'shop-header-cover-color' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label' => esc_html__( 'Shop Header Cover Color', 'atik' ),
					),
				),
				'shop-header-cover-opacity' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'label'       => esc_html__( 'Shop Header Cover Opacity', 'atik' ),
						'description' => esc_html__( 'Set opacity for Shop Header Cover', 'atik' ),
						'type'        => 'range',
						'input_attrs' => array(
								'min'   => 0,
								'max'   => 100,
								'step'  => 5,
							),
						),
				),
				'shop-layout' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label' => esc_html__( 'Layout', 'atik' ),
						'description' => esc_html__( 'When selecting style 2, products description will show on mouse hover.', 'atik' ),
						'type' => 'radio',
						'choices' => array(
							'one' => esc_html__( 'Style 1', 'atik' ),
							'two' => esc_html__( 'Style 2', 'atik' ),
						),
					),
				),
				'shop-column' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'label'     => esc_html__( 'Columns', 'atik' ),
						'description' => esc_html__( 'Choose how many columns for products.', 'atik' ),
						'type' => 'radio',
						'choices' => array(
							2 => esc_html__( '2 columns', 'atik' ),
							3 => esc_html__( '3 columns', 'atik' ),
							5 => esc_html__( '3 columns + sidebar', 'atik' ),
							4 => esc_html__( '4 columns', 'atik' ),
						),
					),
				),
				'bool-hide-upsell' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'type' => 'checkbox',
						'label' => esc_html__( 'Hide upsell products at single product', 'atik' ),
					),
				),
				'bool-hide-related' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'type' => 'checkbox',
						'label' => esc_html__( 'Hide related products at single product', 'atik' ),
					),
				),
				'bool-hide-addtocart' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'type' => 'checkbox',
						'label' => esc_html__( 'Hide "add to cart" button at shop listing', 'atik' ),
					),
				),
			),
		),

		'atik_footer' => array(
			'title' => esc_html__( 'Footer', 'atik' ),
			'description' => '',
			'panel' => 'atik_options_panel',
			'options' => array(
				'html-footer-text' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'type' => 'text',
						'label' => esc_html__( 'Footer Text', 'atik' ),
					),
				),
				'bool-hide-credit' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'type' => 'checkbox',
						'label' => esc_html__( 'Hide theme byline', 'atik' ),
					),
				),
				'html-footer-card' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'type'  => 'textarea',
						'label' => esc_html__( 'Footer bottom right content', 'atik' ),
					),
				),
			),
		),

		'404_page' => array(
			'title' => esc_html__( 'Custom 404 Page', 'atik' ),
			'description' => '',
			'panel' => 'atik_options_panel',
			'options' => array(
				'404_custom_page' => array(
					'setting' => array(
						'transport' => 'refresh',
					),
					'control' => array(
						'type' => 'dropdown-pages',
						'label' => esc_html__( 'Select 404 Pages:', 'atik' ),
						'allow_addition' => true,
					),
				),
				'404-cover-color' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'control_class' => 'WP_Customize_Color_Control',
						'label' => esc_html__( 'Page Cover Color', 'atik' ),
					),
				),
				'404-cover-opacity' => array(
					'setting' => array(
						'transport' => 'postMessage',
					),
					'control' => array(
						'label'       => esc_html__( 'Page Cover Opacity', 'atik' ),
						'description' => esc_html__( 'Set opacity for 404 Page Cover&#039;s featured image.', 'atik' ),
						'type'        => 'range',
						'input_attrs' => array(
							'min'   => 0,
							'max'   => 100,
							'step'  => 5,
						),
					),
				),
			),
		),

	);

	/**
	 * Filter the control definitions for the Customizer.
	 *
	 * '[section_id]' => array(
	 * 	   'title' => esc_html__( '[Section Title]', 'atik' ),
	 * 	   'description' => esc_html__( '[Section description]', 'atik' ),
	 * 	   'options' => array(
	 * 		   '[setting-id]' => array(
	 * 			   'setting' => array(
	 *                 [setting-parameter] => [value]
	 *             ),
	 * 			   'control' => array(
	 *                 [control-parameter] => [value]
	 *             ),
	 * 		   ),
	 * 	   ),
	 * ),
	 *
	 * @since 1.0.0.
	 *
	 * @param array    $definitions    The array containing all of the Customizer definitions.
	 */
	$definitions = apply_filters( 'atik_customizer_definitions', $definitions );

	return $definitions;
}
