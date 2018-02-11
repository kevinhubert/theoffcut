<?php
/**
 * Template Name: Page: Widgetized
 *
 * @package Atik
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( '' !== get_the_content() ) : ?>

		<div id="primary" class="container">
			<div class="content-area">
				<main id="main" class="site-main" role="main">
					<div class="entry-content">
						<?php
							the_content();

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atik' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
				</main>
			</div>
		</div>

		<?php endif; ?>

		<?php dynamic_sidebar( 'widget-area-page-' . get_the_ID() ); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>
