<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Atik
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php get_template_part( 'partials/entry', 'cover' ); ?>

		<div class="container">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'partials/content', get_post_format() );

				get_template_part( 'partials/nav', 'post' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
