<?php
/**
 * Partials template for displaying top navigation in header.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

if ( ! has_nav_menu( 'menu-3' ) && ! has_nav_menu( 'menu-2' ) && ! has_nav_menu( 'jetpack-social-menu' ) ) {
	return;
}

?>
<div class="top-header">
	<div class="container">
		<div class="top-left-menu">
			<?php if ( has_nav_menu( 'menu-3' ) ) : ?>
				<nav id="language-navigation" class="language-navigation" role="navigation">
					<?php wp_nav_menu( array(
						'theme_location' => 'menu-3',
						'menu_id'        => 'language-menu',
						'depth'          => 2,
						'fallback_cb'    => false,
						'container'      => 'ul',
						'menu_id'        => 'language-menu',
						'menu_class'     => 'language-menu',
					) );
					?>
				</nav>
			<?php endif; ?>
		</div>
		<div class="top-right-menu">
			<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
				<nav id="secondary-site-navigation" class="secondary-navigation" role="navigation">
					<?php wp_nav_menu( array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'secondary-menu',
						'depth'          => -1,
						'fallback_cb'    => false,
						'container'      => 'ul',
						'menu_id'        => 'secondary-menu',
						'menu_class'     => 'secondary-menu',
					) );
					?>
				</nav>
			<?php endif; ?>

			<?php
			if ( function_exists( 'jetpack_social_menu' ) ) {
				jetpack_social_menu();
			}
			?>
		</div>
	</div>
</div>
