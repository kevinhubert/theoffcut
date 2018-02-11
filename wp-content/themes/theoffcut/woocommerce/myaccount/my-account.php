<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

?>

<?php
if ( ! is_wc_endpoint_url( 'view-order' ) ) : ?>
	<div class="myaccount-navigation wc-tabs-wrapper">
		<div class="grid">
			<div class="grid__col grid__col--3-of-12">
				<?php
				/**
				 * My Account navigation.
				 * @since 2.6.0
				 */
				do_action( 'woocommerce_account_navigation' );
				?>
			</div>
			<div id="myaccount-tabs" class="myaccount-tabs grid__col grid__col--9-of-12">
				<?php
				/**
				 * My Account content.
				 * @since 2.6.0
				 */
				do_action( 'woocommerce_account_content' );
				?>
			</div>
		</div>
	</div>
<?php else : ?>
	<?php do_action( 'woocommerce_account_content' ); ?>
<?php endif; ?>
