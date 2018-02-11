<?php
/**
 * Partials template for displaying navigations
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

?>

<?php if ( get_next_posts_link() || get_previous_posts_link() ) : ?>
<nav class="navigation posts-navigation" role="navigation">
	<span class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'atik' ); ?></span>
	<div class="nav-links grid">
		<?php
		// Left arrow.
		if ( get_previous_posts_link() ) : ?>
		<div class="nav-previous grid__col grid__col--1-of-2">
			<?php previous_posts_link( esc_html__( 'Newer posts', 'atik' ) ); ?>
		</div>
		<?php endif; ?>

		<?php
		// Right arrow.
		if ( get_next_posts_link() ) : ?>
		<div class="nav-next grid__col grid__col--1-of-2<?php if ( ! get_previous_posts_link() ) echo ' grid__col--push-1-of-2'; ?>">
			<?php next_posts_link( esc_html__( 'Older posts', 'atik' ) ); ?>
		</div>
		<?php endif; ?>
	</div>
</nav>
<?php endif;
