<?php
/**
 * My Account page
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 * @since 2.6.0
 */
?>

<div class="my-account-dashboard">
	<div class="row">
		<div class="col-md-3 col-sm-4 col-xs-12">
			<?php do_action( 'woocommerce_account_navigation' ); ?>
		</div>

		<div class="col-md-9 col-sm-8 col-xs-12">
			<div class="woocommerce-MyAccount-content">
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
</div>