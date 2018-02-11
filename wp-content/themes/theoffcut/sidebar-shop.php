<?php
/**
 * The sidebar for WooCommerce shop pages.
 *
 * @package Atik
 */

if ( ! is_active_sidebar( 'shop-sidebar' ) ) {
	return;
}
$shop_column = atik_get_thememod_value( 'shop-column' );
// only show for 3 columns + sidebar.
if ( 5 !== $shop_column ) {
	return;
}
?>

<aside id="secondary" class="shop-widgets widget-area" role="complementary">
	<?php dynamic_sidebar( 'shop-sidebar' ); ?>
</aside><!-- #secondary -->
