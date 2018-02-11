<?php
/**
 * Partials template for displaying main navigation in header.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

?>
<div class="navigation-wrap">
	<div class="clear"></div>
	<nav class="extra-navigation">
		<ul id="extra-menu" class="extra-menu">
			<?php do_action( 'atik_cart' ); ?>
		</ul>
	</nav>

	<?php if ( atik_is_woocommerce_activated() ) : ?>
		<nav class="extra-mobile-navigation">
			<p class="buttons clearfix">
				<?php
				echo sprintf( '<a href="%s" class="button wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View Cart', 'atik' ) );

				echo sprintf( '<a href="%s" class="button checkout wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'checkout' ) ), esc_html__( 'Checkout', 'atik' ) );
				?>
			</p>
		</nav>
	<?php endif; ?>

	<nav id="site-navigation" class="main-navigation" role="navigation">
		<?php wp_nav_menu( array(
			'theme_location' => 'menu-1',
			'menu_id'        => 'primary-menu',
			'container'      => 'ul',
			'menu_id'        => 'primary-menu',
			'menu_class'     => 'primary-menu',
		) );
		?>
	</nav><!-- #site-navigation -->

	<div class="top-mobile-header">
		<?php if ( has_nav_menu( 'menu-3' ) ) : ?>
			<nav id="language-mobile-navigation" class="language-navigation" role="navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'menu-3',
					'menu_id'        => 'language-menu',
					'depth'          => 2,
					'fallback_cb'    => false,
					'container'      => 'ul',
					'menu_id'        => 'language-mobile-menu',
					'menu_class'     => 'language-menu',
				) );
				?>
			</nav>
		<?php endif; ?>

		<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
			<nav class="secondary-navigation" role="navigation">
				<?php wp_nav_menu( array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'secondary-menu',
					'depth'          => -1,
					'fallback_cb'    => false,
					'container'      => 'ul',
					'menu_id'        => 'secondary-mobile-menu',
					'menu_class'     => 'secondary-menu',
				) );
				?>
			</nav>
		<?php endif; ?>
	</div>
</div>
