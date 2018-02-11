<?php
/**
 * Child theme functions.
 *
 * @package Atik
 * @since Atik Child 1.0
 */

/**
 * Atik Child Theme
 *
 * Place any custom functionality/code snippets here.
 */
function atik_child_styles() {
	wp_enqueue_style( 'atik-parent-style', get_parent_theme_file_uri() . '/style.css', array( 'genericons' ) );
}
add_action( 'wp_enqueue_scripts', 'atik_child_styles' );
