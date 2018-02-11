<?php
/**
 * Home feature
 *
 * @package Atik
 */

?>

<div class="grid__col grid__col--1-of-3">
	<div class="widget-product-category" style="background-image:url(<?php echo esc_url( $template_args['feature']['background'] ); ?>);">
		<h3 class="cat-title">
			<span><?php echo esc_html( $template_args['feature']['button_text'] ); ?></span>
		</h3>

		<a class="cat-link" href="<?php echo esc_url( $template_args['feature']['button_url'] ); ?>"></a>
	</div>
</div>
