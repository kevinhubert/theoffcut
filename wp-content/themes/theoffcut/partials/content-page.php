<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

$is_account_page = ( atik_is_woocommerce_activated() && is_account_page() ) ? true : false;
$is_cart_page = ( atik_is_woocommerce_activated() && is_cart() ) ? true : false;
$is_checkout_page = ( atik_is_woocommerce_activated() && is_checkout() ) ? true : false;
$is_woo_page = ( $is_account_page || $is_cart_page || $is_checkout_page ) ? true : false;
$is_view_order_page = ( atik_is_woocommerce_activated() && is_view_order_page() ) ? true : false;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( $is_woo_page ) : ?>
			<?php if ( ( is_account_page() && ! is_user_logged_in() ) || ( $is_view_order_page ) ) : ?>
				<!-- Do not output title -->
			<?php else : ?>
				<?php get_template_part( 'partials/woo', 'header' ); ?>
			<?php endif; ?>
		<?php else : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif; ?>

	</header><!-- .entry-header -->

	<?php if ( $is_checkout_page ) : ?>
		<?php get_template_part( 'partials/woo', 'checkout-login' ); ?>
	<?php endif; ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'atik' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'atik' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
