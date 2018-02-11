<?php
/**
 * Template partials to load the correct blog layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

$blog_layout = atik_get_thememod_value( 'blog-layout' );
$count = $template_args['count'];

if ( 'one' === $blog_layout ) {
	if ( 0 === $count ) {
		if ( is_sticky() ) {
			get_template_part( 'partials/blog', 'layout-two' );
		} else {
			get_template_part( 'partials/blog', 'layout-one' );
		}
	} else {
		get_template_part( 'partials/blog', 'layout-one' );
	}
} elseif ( 'two' === $blog_layout ) {
	get_template_part( 'partials/blog', 'layout-two' );
} elseif ( 'three' === $blog_layout ) {

	if ( has_post_thumbnail() ) {
		if ( ($count % 3) === 0 ) {
			$class = 'grid__col--12-of-12 full-width';
		} else {
			$class = 'grid__col--1-of-2 half-width';
		}

		echo "<div class='grid__col {$class}'>";
		get_template_part( 'partials/blog', 'layout-three' );
		echo '</div>';
	}
}
