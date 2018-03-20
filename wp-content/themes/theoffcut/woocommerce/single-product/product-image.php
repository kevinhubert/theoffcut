<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
 * @version 3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
$thumbnail_post    = get_post( $post_thumbnail_id );
$image_title       = $thumbnail_post->post_content;
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters(
	 'woocommerce_single_product_image_gallery_classes', array(
		 'woocommerce-product-gallery',
		 'woocommerce-product-gallery--' . $placeholder,
		 'images',
	 )
	);

$has_gallery    = false;
$attachment_ids = $product->get_gallery_image_ids();
if ( ! empty( $attachment_ids ) ) {
	$has_gallery = true;
}
$loop = 0;
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">
		<div class="images">

		<?php
		// if has gallery, use gallery instead of featured image.
		if ( $has_gallery ) :
		?>

			<div id="product-slider" class="product-slider flexslider">
				<div class="product-img slides">
					<?php
					foreach ( $attachment_ids as $attachment_id ) {
						$url           = wp_get_attachment_url( $attachment_id );
						$image_title   = esc_attr( get_the_title( $attachment_id ) );
						$image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

						$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );

						$image = wp_get_attachment_image(
							 $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ), 0, $attr = array(
								 'title'                   => $image_title,
								 'alt'                     => $image_title,
								 'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
								 'data-src'                => $full_size_image[0],
								 'data-large_image'        => $full_size_image[0],
								 'data-large_image_width'  => $full_size_image[1],
								 'data-large_image_height' => $full_size_image[2],
							 )
							);

						if ( has_post_thumbnail() ) {
							$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $attachment_id, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
							$html .= $image;
							$html .= '</a></div>';
						}

						echo apply_filters( 'woocommerce_single_product_image_html', $html, get_post_thumbnail_id( $attachment_id ) );

						$loop++;
					}
					?>
				</div>
			</div>

		<?php else : ?>
			<figure class="woocommerce-product-gallery__wrapper">
				<?php
				$attributes = array(
					'title'                   => $image_title,
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);

				if ( has_post_thumbnail() ) {
					$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
					$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
					$html .= '</a></div>';
				} else {
					$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
					$html .= '</div>';
				}

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
				?>
			</figure>
		<?php
		endif;
		do_action( 'woocommerce_product_thumbnails' );
		?>
		</div>
	</figure>
</div>
