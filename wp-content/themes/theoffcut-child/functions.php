<?php
/**
 * Child theme functions.
 *
 * @package TheOffcut
 * @since TheOffcut Child 1.0
 */

/**
 * TheOffcut Child Theme
 *
 * Place any custom functionality/code snippets here.
 */
function TheOffcut_child_styles() {
	wp_enqueue_style( 'TheOffcut-parent-style', get_parent_theme_file_uri() . '/style.css', array( 'genericons' ) );
}
add_action( 'wp_enqueue_scripts', 'TheOffcut_child_styles' );
