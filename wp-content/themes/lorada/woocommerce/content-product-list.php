<?php
/**
 * Product List Layout
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce_loop;

$opt_countdown_timer = lorada_get_opt( 'shop_product_countdown' );
$countdown_timer = wc_get_loop_prop( 'countdown_timer', $opt_countdown_timer );
?>

<div class="product-content-wrap">
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
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );

		if ( $countdown_timer ) {
			/**
			 * lorada_woocommerce_product_countdown hook.
			 *
			 * @hooked lorada_woocommerce_sale_product_countdown_time - 10
			 */
			do_action( 'lorada_woocommerce_product_countdown' );
		}
		?>

	</div>

	<div class="product-infobox clearfix">
		
		<?php
		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10 : Changed
		 */
		do_action( 'woocommerce_shop_loop_item_title' );
		?>

		<div class="rating-price-wrapper">
			<?php
				echo woocommerce_template_loop_price();
				echo woocommerce_template_loop_rating();
			?>
		</div>

		<div class="summary-content-wrapper">
			<?php the_excerpt(); ?>
		</div>

		<div class="product-swatches-wrapper">
			<?php echo lorada_product_attribute_swatch(); ?>
		</div>

		<div class="product-btns">
			<?php echo woocommerce_template_loop_add_to_cart(); ?>

			<div class="other-btns-wrap">
				<?php
					echo lorada_woocommerce_template_loop_quickview();
					echo lorada_woocommerce_template_loop_wishlist();
					echo lorada_add_compare_link();
				?>
			</div>
		</div>

	</div>
</div>