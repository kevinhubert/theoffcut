<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Atik
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<a id="footer-toggle" class="footer-toggle" href="javascript:void(0)">
			<i class="genericon genericon-draggable"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Footer Widgets', 'atik' ); ?></span>
		</a>

		<div class="widget-area">
			<div class="container">
				<div class="grid">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<div class="site-info">
			<div class="container">
				<div class="grid">
					<div class="copyright grid__col grid__col--1-of-2 grid__col--am">
						<?php if ( atik_get_thememod_value( 'html-footer-text' ) || is_customize_preview() ) : ?>
							<div class="site-info-footer">
								<?php $allowed_tags = atik_allowed_html(); ?>
								<?php echo wp_kses( atik_get_thememod_value( 'html-footer-text' ), $allowed_tags ); ?>
							</div>
						<?php endif; ?>

						<?php if ( false === atik_get_thememod_value( 'bool-hide-credit' ) || is_customize_preview() ) : ?>
							<div class="site-byline">
								<?php /* translators: WordPress title */ ?>
								<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'atik' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'atik' ), 'WordPress' ); ?></a>
								<span class="sep"> | </span>
								<?php /* translators: Theme title */ ?>
								<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'atik' ), 'Atik', '<a href="https://codestag.com" rel="designer">Codestag</a>' ); ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="credit-cards-wrap grid__col grid__col--1-of-2 grid__col--am aligntxtright">
						<?php if ( atik_get_thememod_value( 'html-footer-card' ) || is_customize_preview() ) : ?>
							<div class="site-card">
								<?php $allowed_tags = atik_allowed_html(); ?>
								<?php echo wp_kses( atik_get_thememod_value( 'html-footer-card' ), $allowed_tags ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
