<?php
/**
 * Template Name: Page: Layout Builder
 *
 * @package Atik
 */

get_header(); ?>

	<div id="primary" class="full-width-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					the_content( __( 'Continue Reading', 'stag' ) );
					wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages:', 'stag' ) . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) );
				?>

			<?php endwhile; ?>
			<!-- END .entry-content -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
