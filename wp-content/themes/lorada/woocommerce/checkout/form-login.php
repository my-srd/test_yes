<?php
/**
 * Checkout login form
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>

<div class="lorada-checkout-login">
	<div class="woocommerce-form-login-toggle">
		<?php wc_print_notice( apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'lorada' ) ) . ' <a href="#" class="showlogin">' . __( 'Click here to login', 'lorada' ) . '</a>', 'notice' ); ?>
	</div>

	<?php
		woocommerce_login_form(
			array(
				'message'  => __( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.', 'lorada' ),
				'redirect' => wc_get_checkout_url(),
				'hidden'   => true,
			)
		);
	?>
</div>