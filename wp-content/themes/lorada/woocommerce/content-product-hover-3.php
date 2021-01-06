<?php
/**
 * Content Product Layout 3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce_loop;

$opt_countdown_timer = lorada_get_opt( 'shop_product_countdown' );
$countdown_timer = wc_get_loop_prop( 'countdown_timer', $opt_countdown_timer );
?>

<div class="product-thumbs">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10 : Removed
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10 : Changed
	 * @hooked lorada_woocommerce_template_loop_product_hover_img - 15 : Added
	 * @hooked lorada_variable_product_quick_shop - 20 : Added
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );
	?>

	<div class="wishlist-btn">
		<?php lorada_woocommerce_template_loop_wishlist(); ?>
	</div>
</div>

<div class="product-infobox clearfix">
	<div class="product-swatches-wrapper">
		<?php echo lorada_product_attribute_swatch(); ?>
	</div>

	<?php
	if ( $countdown_timer ) {
		/**
		 * lorada_woocommerce_product_countdown hook.
		 *
		 * @hooked lorada_woocommerce_sale_product_countdown_time - 10
		 */
		do_action( 'lorada_woocommerce_product_countdown' );
	}
	
	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked lorada_woocommerce_template_loop_product_category - 10 : Added
	 * @hooked woocommerce_template_loop_product_title - 20 : Changed
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	// Render product rating
	woocommerce_template_loop_rating();
	?>

	<div class="product-price-btns">
		<div class="price-btns-wrap">
			<div class="price-wrap">
				<?php woocommerce_template_loop_price(); ?>
			</div>

			<div class="product-btns">
				<div class="cart-btn-wrap">
					<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>

				<div class="other-btns-wrap">
					<?php
						lorada_add_compare_link();
						lorada_woocommerce_template_loop_quickview();
					?>
				</div>
			</div>
		</div>
	</div>
</div>