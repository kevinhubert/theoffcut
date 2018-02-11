<?php
/**
 * Template part for displaying sticky post thumbnail and label.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

if ( ! has_post_thumbnail() ) {
	return;
}
?>

<figure class="entry-thumbnail">
	<a href="<?php the_permalink(); ?>" class="entry-thumb">
		<?php get_template_part( 'partials/entry', 'sticky' ); ?>
		<?php the_post_thumbnail(); ?>
	</a>
</figure>
