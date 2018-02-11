<?php
/**
 * Partials template for displaying navigations
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

// Don't print empty markup if there's nowhere to navigate.
$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
$next     = get_adjacent_post( false, '', false );

if ( ! $next && ! $previous ) {
	return;
}
?>
<nav class="navigation post-navigation" role="navigation">
	<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'atik' ); ?></h1>
	<div class="nav-links grid">
		<?php
			previous_post_link(
				'<div class="nav-previous nav-link grid__col grid__col--1-of-2">%link</div>',
				_x( '<span class="meta-nav">Previous Post</span> <h2 class="post-title">%title</h2>', 'Previous post link', 'atik' )
			);

			next_post_link(
				'<div class="nav-next nav-link grid__col grid__col--1-of-2">%link</div>',
				_x( '<span class="meta-nav">Next Post</span> <h2 class="post-title">%title</h2>', 'Next post link', 'atik' )
			);
		?>
	</div><!-- .nav-links -->
</nav><!-- .navigation -->
<?php
