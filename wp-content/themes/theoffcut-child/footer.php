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
					
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114353559-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114353559-1');
</script>


<script type="text/javascript" src="/theoffcut/wp-content/themes/theoffcut-child/dist/scripts/main.js"></script>
<?php wp_footer(); ?>

</body>
</html>
