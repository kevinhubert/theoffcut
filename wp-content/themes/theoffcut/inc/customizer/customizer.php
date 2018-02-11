<?php
/**
 * Atik Theme Customizer
 *
 * @package Atik
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0.0.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @return void
 */
function atik_customize_register( $wp_customize ) {
	// Tagline transport.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Rename the Header Text Color & Background Color.
	$wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Header Text', 'atik' );
	$wp_customize->get_control( 'background_color' )->label = esc_html__( 'Background', 'atik' );

	if ( ! atik_is_woocommerce_activated() ) {
		$wp_customize->remove_control( 'color-woo-sale' );
		$wp_customize->remove_control( 'color-woo-outofstock' );
	}

	if ( isset( $wp_customize->selective_refresh ) ) {

		$wp_customize->selective_refresh->add_partial( 'header-image-title', array(
			'selector' => '.custom-header-box-wrapper',
			'render_callback' => 'custom_header_box',
		) );

		$wp_customize->selective_refresh->add_partial( 'header-image-description', array(
			'selector' => '.custom-header-box-wrapper',
			'render_callback' => 'custom_header_box',
		) );

		$wp_customize->selective_refresh->add_partial( 'header-image-button-url', array(
			'selector' => '.custom-header-box-wrapper',
			'render_callback' => 'custom_header_box',
		) );

		$wp_customize->selective_refresh->add_partial( 'header-image-button-label', array(
			'selector' => '.custom-header-box-wrapper',
			'render_callback' => 'custom_header_box',
		) );

		$wp_customize->selective_refresh->add_partial( 'html-footer-text', array(
			'selector' => '.site-info-footer',
			'render_callback' => function() {
				$allowed_tags = atik_allowed_html();
				return wp_kses( atik_get_thememod_value( 'html-footer-text' ), $allowed_tags );
			},
		) );

	}
}

add_action( 'customize_register', 'atik_customize_register', 30 );

/**
 * Get template part custom header box
 *
 * @since 1.0.0.
 */
function custom_header_box() {
	get_template_part( 'partials/custom-header-box' );
}

/**
 * Enqueue scripts to run in the Customizer preview pane.
 *
 * @since 1.0.0.
 *
 * @return void
 */
function atik_customize_preview_js() {
	wp_enqueue_script(
		'atik-customizer-preview',
		get_template_directory_uri() . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		ATIK_VERSION,
		true
	);

	wp_localize_script(
		'atik-customizer-preview',
		'atikPreview',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		)
	);
}

add_action( 'customize_preview_init', 'atik_customize_preview_js' );

function atik_customize_controls_enqueue_scripts() {
	// Styles.
	wp_enqueue_style(
		'chosen',
		get_template_directory_uri() . '/assets/css/chosen/chosen' . ATIK_SUFFIX . '.css',
		array(),
		'1.6.2'
	);

	// Scripts.
	wp_enqueue_script(
		'chosen',
		get_template_directory_uri() . '/assets/js/chosen/chosen.jquery' . ATIK_SUFFIX . '.js',
		array( 'jquery', 'customize-controls' ),
		'1.6.2',
		true
	);

	wp_enqueue_script( 'atik-customize-controls', get_parent_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );

	wp_enqueue_script(
		'customizer-sections',
		get_template_directory_uri() . '/assets/js/customizer-sections.js',
		array( 'customize-controls', 'chosen' ),
		ATIK_VERSION,
		true
	);

	$localize = array(
		'fontOptions'               => atik_get_font_property_option_keys(),
		'chosen_no_results_default' => esc_html__( 'No results match', 'atik' ),
		'chosen_no_results_fonts'   => esc_html__( 'No matching fonts', 'atik' ),
	);

	// Localize the script.
	wp_localize_script(
		'customizer-sections',
		'chosenOptions',
		$localize
	);
}

add_action( 'customize_controls_enqueue_scripts', 'atik_customize_controls_enqueue_scripts' );


/**
 * Add sections and controls to the customizer.
 *
 * @since  1.0.0.
 *
 * @param WP_Customize_Manager $wp_customize    The Customizer instance.
 * @return void
 */
function atik_customize_add_sections( $wp_customize ) {
	// Compile the section definitions.
	$sections = atik_customize_get_definitions( $wp_customize );

	// Initial priority.
	$priority = new ATIK_Prioritizer( 1000 );

	// Register each section and add its options.
	foreach ( $sections as $section => $data ) {
		// Store the options.
		if ( isset( $data['options'] ) ) {
			$options = $data['options'];
			unset( $data['options'] );
		}

		// Determine the priority.
		if ( ! isset( $data['priority'] ) ) {
			$data['priority'] = $priority->add();
		}

		// Register section, if it doesn't already exist.
		if ( ! $wp_customize->get_section( $section ) ) {
			$wp_customize->add_section( $section, $data );
		}

		// Add options to the section.
		if ( isset( $options ) ) {
			atik_customize_add_section_options( $section, $options );
			unset( $options );
		}
	}
}

add_action( 'customize_register', 'atik_customize_add_sections' );

/**
 * Register settings and controls for a section.
 *
 * @since  1.0.0.
 *
 * @param string $section             Section ID.
 * @param  array  $args                Array of setting and control definitions.
 * @param  int    $initial_priority    The initial priority to use for controls.
 * @return int                            The last priority value assigned
 */
function atik_customize_add_section_options( $section, $args, $initial_priority = 10 ) {
	global $wp_customize;

	$settings = new ATIK_Settings();
	$priority = new ATIK_Prioritizer( $initial_priority, 10 );

	foreach ( $args as $setting_id => $option ) {
		// Add setting.
		if ( isset( $option['setting'] ) ) {
			$defaults = array(
				'type'                 => 'theme_mod',
				'capability'           => 'edit_theme_options',
				'theme_supports'       => '',
				'default'              => $settings->get_default( $setting_id ),
				'transport'            => 'refresh',
				'sanitize_callback'    => $settings->get_sanitize_callback( $setting_id ),
				'sanitize_js_callback' => '',
			);
			$setting = wp_parse_args( $option['setting'], $defaults );

			// Add the setting arguments inline so Theme Check can verify the presence of sanitize_callback.
			$wp_customize->add_setting( $setting_id, array(
				'type'                 => $setting['type'],
				'capability'           => $setting['capability'],
				'theme_supports'       => $setting['theme_supports'],
				'default'              => $setting['default'],
				'transport'            => $setting['transport'],
				'sanitize_callback'    => $setting['sanitize_callback'],
				'sanitize_js_callback' => $setting['sanitize_js_callback'],
			) );
		}

		// Add control.
		if ( isset( $option['control'] ) ) {
			$control_id = $setting_id;

			$defaults = array(
				'settings' => $setting_id,
				'section'  => $section,
				'priority' => $priority->add(),
			);

			if ( ! isset( $option['setting'] ) ) {
				unset( $defaults['settings'] );
			}

			$control = wp_parse_args( $option['control'], $defaults );

			// Check for a specialized control class.
			if ( isset( $control['control_class'] ) ) {
				$class = $control['control_class'];

				/**
				 * Filter the path for loading a Customizer control file.
				 *
				 * @since 1.0.0.
				 *
				 * @param string    $control_path    The path to the control file.
				 * @param string    $control_id      The ID of the current control.
				 * @param array     $control         The array of parameters for the current control.
				 */
				$control_path = apply_filters( 'atik_customizer_control_path', get_template_directory() . '/inc/customizer/controls', $control_id, $control );

				$control_file = trailingslashit( $control_path ) . $class . '.php';
				if ( file_exists( $control_file ) ) {
					require_once( $control_file );
				}

				if ( class_exists( $class ) ) {
					unset( $control['control_type'] );

					// Dynamically generate a new class instance in a way that's compatible with PHP 5.2.
					$reflection = new ReflectionClass( $class );
					$class_instance = $reflection->newInstanceArgs( array( $wp_customize, $control_id, $control ) );

					$wp_customize->add_control( $class_instance );
				}
			} else {
				$wp_customize->add_control( $control_id, $control );
			}
		}
	}

	return $priority->get();
}
