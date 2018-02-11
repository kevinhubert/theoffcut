<?php
/**
 * Template part for footer when Jetpack Infinite Scroll is active.
 *
 * @package Atik
 */

?>

<?php if ( false === atik_get_thememod_value( 'bool-hide-credit' ) || is_customize_preview() ) : ?>
<footer id="colophon" class="site-footer-infinity" role="contentinfo">

	<div class="site-byline">
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'atik' ) ); ?>">
			<?php /* translators: WordPress title */ ?>
			<?php printf( esc_html__( 'Proudly powered by %s', 'atik' ), 'WordPress' ); ?>
		</a>
		<span class="sep"> | </span>

		<?php /* translators: Theme title */ ?>
		<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'atik' ), 'Atik', '<a href="https://codestag.com" rel="designer">Codestag</a>' ); ?>
	</div>

</footer><!-- #colophon -->
<?php endif; ?>
