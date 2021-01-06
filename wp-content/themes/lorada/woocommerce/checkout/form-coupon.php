<?php
/**
 * Checkout coupon form
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>

<div class="lorada-checkout-coupon">
	<div class="woocommerce-form-coupon-toggle">
		<?php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'lorada' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'lorada' ) . '</a>' ), 'notice' ); ?>
	</div>

	<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
		<div class="coupon-form-wrapper">
			<p class="form-row form-row-first">
				<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'lorada' ); ?>" id="coupon_code" value="" />
			</p>

			<p class="form-row form-row-last">
				<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'lorada' ); ?>"><?php esc_html_e( 'Apply coupon', 'lorada' ); ?></button>
			</p>
		</div>
	</form>
</div>