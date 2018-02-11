<?php
/**
 * Template part for displaying header title in content-page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Atik
 */

$is_cart_page = ( atik_is_woocommerce_activated() && is_cart() ) ? true : false;
$is_account_page = ( atik_is_woocommerce_activated() && is_account_page() ) ? true : false;
$is_checkout_page = ( atik_is_woocommerce_activated() && is_checkout() ) ? true : false;
$is_order_received_page = ( atik_is_woocommerce_activated() && is_order_received_page() ) ? true : false;
?>
<div class="inner">
	<div class="grid">
		<?php if ( $is_account_page ) : ?>
			<div class="grid__col grid__col--8-of-12 grid__col--am">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>
		<?php elseif ( ! $is_account_page ) : ?>
			<div class="grid__col grid__col--4-of-12 grid__col--am">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $is_cart_page ) : ?>
			<div class="grid__col grid__col--3-of-12 grid__col--am grid__col--push-5-of-12">
				<!-- if cart empty no need to display coupon. -->
				<?php
				if ( WC()->cart->get_cart_contents_count() !== 0 && wc_coupons_enabled() ) {
					do_action( 'atik_coupon' );
				}
				?>
			</div>
		<?php elseif ( $is_checkout_page ) : ?>
			<div class="grid__col grid__col--8-of-12 grid__col--am">
				<div class="woocommerce-info-wrap grid">
					<div class="grid__col grid__col--1-of-2 grid__col--m-1-of-2 grid__col--s-1-of-2 grid__col--am aligntxtright">
						<?php
						if ( ! is_user_logged_in() && 'no' !== get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
							$info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );
							$info_message .= ' <a href="#" class="showlogin button">' . __( 'Sign in', 'woocommerce' ) . '</a>';
							wc_print_notice( $info_message, 'notice' );
						}
						?>
					</div>

					<?php if ( ! $is_order_received_page ) : ?>
						<div class="grid__col grid__col--1-of-2 grid__col--m-1-of-2 grid__col--s-1-of-2 grid__col--am aligntxtright">
							<?php
							$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a discount code?', 'atik' ) . ' <a href="#" class="showcoupon button">' . __( 'Add Code', 'atik' ) . '</a>' );
							wc_print_notice( $info_message, 'notice' );
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php elseif ( $is_account_page ) : ?>
			<?php if ( is_user_logged_in() ) : ?>
				<div class="grid__col grid__col--4-of-12 grid__col--am aligntxtright">
					<?php
					$current_user = wp_get_current_user();
					if ( ! ($current_user instanceof WP_User) ) {
						return;
					}
					$display_name = $current_user->display_name;
					$avatar = get_avatar( $current_user->ID, 64 );
					?>
					<p class="myaccount_user">
						<span class="user-meta">
							<span class="user-name">
								<?php echo esc_attr( $display_name ); ?>
							</span>
							<a href="<?php echo esc_url( wp_logout_url() ); ?>">Logout</a>
						</span>
						<?php echo $avatar; ?>
					</p>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>
