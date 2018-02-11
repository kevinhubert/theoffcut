<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	$mobile_thumb_id = get_post_thumbnail_id();
	$mobile_thumb_url = wp_get_attachment_image_src( $mobile_thumb_id,'full', true );
	$mobile_thumb = $mobile_thumb_url[0];
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'layout-three' ); ?>>

	<div class="entry-wrap">
		<figure class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" class="entry-thumb">
				<div class="mobile-thumb" style="background-image:url(<?php echo esc_url( $mobile_thumb ); ?>);"></div>
			</a>
		</figure>

		<header class="entry-header">
			<?php get_template_part( 'partials/entry', 'sticky' ); ?>
			<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php atik_posted_on(); ?>
				<?php atik_entry_footer(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>
		</header><!-- .entry-header -->
	</div>
</article><!-- #post-## -->
