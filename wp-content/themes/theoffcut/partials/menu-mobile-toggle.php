<?php
/**
 * Partials template for displaying mobile navigation toggle in header.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

?>
<div class="ham-menu-container">
	<a id="mobile-menu-toggle" class="menu-toggle" href="javascript:void(0)" aria-controls="primary-menu" aria-expanded="false"><i class="genericon"></i>
		<?php
		$menu_label = atik_get_thememod_value( 'mobile-menu-label' );
		if ( '' !== $menu_label ) { ?>
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php echo esc_html( $menu_label ); ?></button>
		<?php } ?>
		<span class="screen-reader-text"><?php esc_html__( 'Primary Menu', 'atik' ); ?></span>
	</a>
</div>
