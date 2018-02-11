<?php
/**
 * The template for displaying archive pages.
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
				if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title">
							<?php if ( is_category() ) { ?>
								<?php esc_html_e( 'Showing all posts in:', 'atik' ); ?>
								<span><?php echo single_cat_title( '', false ); ?></span>

							<?php } elseif ( is_tag() ) { ?>
								<?php esc_html_e( 'Tag Archives:', 'atik' ); ?>
								<span><?php echo single_tag_title( '', false ); ?></span>

							<?php } elseif ( is_author() ) { ?>

								<?php

								/*
								 * Queue the first post, that way we know
								 * what author we're dealing with (if that is the case).
								 */
								the_post(); ?>

								<?php esc_html_e( 'Author:', 'atik' ); ?>
								<span class="vcard"><?php the_author(); ?></span>

								<?php
								$author_description = get_the_author_meta( 'description' );
								if ( ! empty( $author_description ) ) {
									echo apply_filters( 'author_meta_description', '<div class="taxonomy-description">' . do_shortcode( $author_description ) . '</div>' );
								}

								/*
								 * Since we called the_post() above, we need to
								 * rewind the loop back to the beginning that way
								 * we can run the loop properly, in full.
								 */
								rewind_posts();
								?>

							<?php } elseif ( is_day() ) { ?>
								<?php esc_html_e( 'Daily Archives:', 'atik' ); ?>
								<span><?php echo get_the_date(); ?></span>

							<?php } elseif ( is_month() ) { ?>
								<?php esc_html_e( 'Monthly Archives:', 'atik' ); ?>
								<span><?php echo get_the_date( 'F Y' ); ?></span>

							<?php } elseif ( is_year() ) { ?>
								<?php esc_html_e( 'Yearly Archives:', 'atik' ); ?>
								<span><?php echo get_the_date( 'Y' ); ?></span>

							<?php } else { ?>
								<?php esc_html_e( 'Archives:', 'atik' ); ?>
							<?php } // End if(). ?>
						</h1>
						<?php
						if ( is_category() ) {
							// show an optional category description.
							$category_description = category_description();
							if ( ! empty( $category_description ) ) {
								echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
							}
						} elseif ( is_tag() ) {
							// show an optional tag description.
							$tag_description = tag_description();
							if ( ! empty( $tag_description ) ) {
								echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
							}
						}
						?>
					</header><!-- .page-header -->

					<?php

					$container_class = 'grid';
					$blog_layout = atik_get_thememod_value( 'blog-layout' );
					if ( 'three' === $blog_layout ) {
						$container_class .= ' posts-list';
					}

					echo "<div class='{$container_class}'>";

					$count = 0;

					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						$blog_layout = atik_get_thememod_value( 'blog-layout' );

						if ( 'one' === $blog_layout ) {
							$count++;
							if ( 1 === $count ) {
								get_template_part( 'partials/blog', 'layout-two' );
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

								$count++;
							}
						}

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
