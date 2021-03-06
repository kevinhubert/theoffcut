<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

?>

<div class="grid__col grid__col--1-of-2">

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'layout-one' ); ?>>
		<?php get_template_part( 'partials/entry', 'thumbnail' ); ?>

		<header class="entry-header">
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

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	</article><!-- #post-## -->

</div>
