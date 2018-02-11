<?php
/**
 * Template part for displaying shop header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

if ( ! atik_is_woocommerce_activated() ) {
	return false;
}
if ( ! is_woocommerce() ) {
	return false;
}
if ( is_product() ) {
	return false;
}
?>

<div class="page-header">
	<?php
		/**
		 * Woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

	<div class="inner">
		<div class="grid">
			<div class="grid__col grid__col--9-of-12 grid__col--am">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

				<?php endif; ?>

				<?php
					/**
					 * Woocommerce_archive_description hook.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action( 'woocommerce_archive_description' );
				?>
			</div>

			<div class="grid__col grid__col--3-of-12 grid__col--am">
				<?php if ( have_posts() ) : ?>
					<?php
						/**
						 * Woocommerce_before_shop_loop hook.
						 *
						 * @hooked woocommerce_result_count - 20
						 * @hooked woocommerce_catalog_ordering - 30
						 */
						do_action( 'woocommerce_before_shop_loop' );
					?>
				<?php endif; ?>
			</div>
		</div>

	</div><!-- .inner -->

	<?php
		/**
		 * Woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
</div><!-- .page-header -->
