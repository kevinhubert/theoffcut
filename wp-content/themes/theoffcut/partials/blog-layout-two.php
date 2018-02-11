<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

?>

<div class="grid__col grid__col--1-of-1 layout-two">

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'layout-two' ); ?>>
		<?php get_template_part( 'partials/entry', 'thumbnail' ); ?>

		<div class="entry-wrap">
			<div class="grid">

				<header class="entry-header grid__col grid__col--1-of-2">
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

				<div class="entry-summary grid__col grid__col--1-of-2">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->

			</div>
		</div>

	</article><!-- #post-## -->

</div>
