<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( '' !== atik_get_thememod_value( 'shop-column' ) ) {
	$shop_column = atik_get_thememod_value( 'shop-column' );
} else {
	$shop_column = '3';
}

// if column 5 means, column 3 + sidebar.
if ( 5 === $shop_column ) {
	$shop_column = '3';
}

// Applied custom cross sells if at cart page only.
if ( is_cart() ) {
	if ( isset( $woocommerce_loop['name'] ) ) {
		$loop_name = $woocommerce_loop['name'];
	} else {
		$loop_name = '';
	}

	// Force 2 columns at cross sells.
	if ( 'cross-sells' === $loop_name ) {
		$shop_column = '2';
	}
}

$grid_class = 'grid__col grid__col--m-1-of-2 grid__col--1-of-' . $shop_column;

$classes[] = $grid_class;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

<li <?php post_class( $classes ); ?>>

	<div class="product-img-wrapper">
		<?php
		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_show_product_loop_sale_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		do_action( 'atik_after_img_wrapper' );
		?>
	</div>

	<div class="product-meta clearfix">
		<?php
		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @un-hooked woocommerce_template_loop_product_title - 10
	 	 * @hooked atik_wrapped_link_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );

		/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );

		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</div>
</li>
