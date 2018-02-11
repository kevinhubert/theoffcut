<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">

				<?php
				if ( have_posts() ) :

					if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
						</header>

					<?php
					endif;

					$container_class = 'grid';
					$blog_layout = atik_get_thememod_value( 'blog-layout' );
					if ( 'three' === $blog_layout ) {
						$container_class .= ' posts-list';
					}

					echo "<div id='posts-container' class='{$container_class}'>";

					$count = 0;

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						atik_get_template_part( 'partials/blog-layout-template', array( 'count' => $count ) );
						$count++;

					endwhile;

					echo '</div>';

					get_template_part( 'partials/nav', 'paging' );

				else :

					get_template_part( 'partials/content', 'none' );

				endif; ?>

			</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
