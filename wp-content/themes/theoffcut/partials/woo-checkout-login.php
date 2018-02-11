<?php
/**
 * Template part for displaying login form & coupon in content-page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

?>
<div class="entry-woocommerce-info grid">
	<div class="grid__col">
		<?php do_action( 'atik_shop_login' ); ?>
	</div>
	<div class="grid__col grid__col--3-of-12 grid__col--am grid__col--push-9-of-12">
		<?php do_action( 'atik_coupon' ); ?>
	</div>
</div>
