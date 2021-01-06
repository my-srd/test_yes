<?php
/**
 * Order tracking form
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $post;
?>

<div class="lorada-tracking-order">
	<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">
		<div class="row">
			<div class="col-sm-8 offset-sm-2 col-xs-12">
				<p class="tracking-order-description"><?php esc_html_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'lorada' ); ?></p>
			</div>

			<div class="col-sm-4 offset-sm-4 col-xs-12">
				<p class="form-row form-row-first"><label for="orderid"><?php esc_html_e( 'Order ID', 'lorada' ); ?></label> <input class="input-text custom-input-text" type="text" name="orderid" id="orderid" value="<?php echo isset( $_REQUEST['orderid'] ) ? esc_attr( $_REQUEST['orderid'] ) : ''; ?>" placeholder="<?php esc_attr_e( 'Found in your order confirmation email.', 'lorada' ); ?>" /></p>
			</div>

			<div class="col-sm-4 offset-sm-4 col-xs-12">
				<p class="form-row form-row-last"><label for="order_email"><?php esc_html_e( 'Billing email', 'lorada' ); ?></label> <input class="input-text custom-input-text" type="text" name="order_email" id="order_email" value="<?php echo isset( $_REQUEST['order_email'] ) ? esc_attr( $_REQUEST['order_email'] ) : ''; ?>" placeholder="<?php esc_attr_e( 'Email you used during checkout.', 'lorada' ); ?>" /></p>
			</div>

			<div class="col-sm-4 offset-sm-4 col-xs-12">
				<p class="form-row text-center track-submit"><input type="submit" class="button black-button" name="track" value="<?php esc_attr_e( 'Track', 'lorada' ); ?>" /></p>
				<?php wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' ); ?>
			</div>
		</div>
	</form>
</div>
