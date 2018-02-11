<?php
/**
 * Template part for displaying cover.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

if ( ! has_post_thumbnail() ) {
	return;
}

$thumb_url = get_the_post_thumbnail_url();
$single_layout = atik_get_thememod_value( 'single-layout' );
?>

<?php if ( 'featured-full-width' === $single_layout ) : ?>
	<figure class="entry-thumbnail featured-full-width">
		<div class="thumbnail-container">
			<div class="entry-thumb" style="background-image:url(<?php echo esc_url( $thumb_url ) ?>);"></div>
		</div>

		<figcaption>
			<div class="container">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</div>
		</figcaption>
	</figure>
<?php else : ?>
	<figure class="entry-thumbnail featured-boxed">
		<a href="<?php the_permalink(); ?>" class="entry-thumb">
			<?php the_post_thumbnail(); ?>
		</a>
	</figure>

	<figcaption>
		<div class="container">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</figcaption>
<?php endif; ?>
