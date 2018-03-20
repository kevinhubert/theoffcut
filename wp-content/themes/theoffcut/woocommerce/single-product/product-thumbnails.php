<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();
if ( count( $attachment_ids ) >= 1 && count( $attachment_ids ) <= 5 ) {
	$nav_class = 'hide-nav';
} elseif ( count( $attachment_ids ) <= 0 ) {
	$nav_class = 'hide-nav-always';
} else {
	$nav_class = 'show-nav';
}
$loop = 0;
?>
	<div id="product-thumbnails" class="product-thumbnails flexslider <?php echo esc_attr( $nav_class ); ?>">
		<div class="thumbnails slides">
			<?php
			foreach ( $attachment_ids as $attachment_id ) {
				$classes = array( 'zoom' );

				$image_class = implode( ' ', $classes );
				$props       = wc_get_product_attachment_props( $attachment_id, $post );
				$url         = wp_get_attachment_url( $attachment_id );

				if ( ! $props['url'] ) {
					continue;
				}

				echo apply_filters(
					'woocommerce_single_product_image_thumbnail_html',
					sprintf(
						'<a href="%s">%s</a>',
						esc_url( $props['url'] ),
						wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 1, $props )
					),
					$attachment_id,
					$post->ID,
					esc_attr( $image_class )
				);

				$loop++;
			}
			?>
		</div>
	</div>
