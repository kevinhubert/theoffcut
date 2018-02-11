<?php
/**
 * Configure LayerSlider WordPress Plugin.
 *
 * @package Atik
 */

/**
 * Disable LayerSlider auto update.
 *
 * @since 1.0.1
 * @return void
 */
function atik_layerslider_config() {
	// Disable auto-updates.
	$GLOBALS['lsAutoUpdateBox'] = false;
}
add_action( 'layerslider_ready', 'atik_layerslider_config' );
