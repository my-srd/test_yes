<?php
/**
 * Group Offer Product
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
<div class="product-infobox clearfix">
	<?php
	woocommerce_show_product_loop_sale_flash();

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked lorada_woocommerce_template_loop_product_category - 10 : Added
	 * @hooked woocommerce_template_loop_product_title - 20 : Changed
	 */
	do_action( 'woocommerce_shop_loop_item_title' );
	?>

	<div class="product-rating-price">
		<div class="rating-price-wrap">
			<?php
			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
		</div>
	</div>

	<div class="product-swatches-wrapper">
		<?php echo lorada_product_attribute_swatch(); ?>
	</div>
</div>

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
	 * @hooked lorada_woocommerce_template_loop_product_thumbnail - 10
	 * @hooked lorada_woocommerce_template_loop_product_hover_img - 20
	 * @hooked lorada_variable_product_quick_shop - 30
	 */
	do_action( 'lorada_woocommerce_before_group_offer_item' );
	?>

	<div class="product-btns">
		<?php
		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5 : Removed
		 * @hooked lorada_woocommerce_template_loop_wishlist - 5 : Added
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 * @hooked lorada_add_compare_link - 15 : Added
		 * @hooked lorada_woocommerce_template_loop_quickview - 20 : Added
		 */
		do_action( 'woocommerce_after_shop_loop_item' );
		?>
	</div>
</div>

<?php 
$available_quantity = 0;

if ( ! $product->is_type( 'variable' ) ) {
	$available_quantity = $product->get_stock_quantity();
} else {
	$added_variations = $product->get_available_variations();

	foreach ( $added_variations as $single_variant ) {
		if ( $single_variant['max_qty'] ) $available_quantity = $available_quantity + $single_variant['max_qty'];
	}
}

if ( $available_quantity ) {
	$product_sold = get_post_meta( $product->get_id(), 'total_sales', true );
	$total_quantity = $available_quantity + $product_sold;
	$sold_percentage = $product_sold / $total_quantity * 100;

	?>
	<div class="quantity-state">
		<div class="quantity-stock-num">
			<div class="sold-state">
				<span class="label"><?php echo esc_html__( 'Sold', 'lorada' ); ?> : </span>
				<strong><?php echo esc_html( $product_sold ); ?></strong>
			</div>

			<div class="total-state">
				<span class="label"><?php echo esc_html__( 'Avaliable', 'lorada' ); ?> : </span>
				<strong><?php echo esc_html( $total_quantity ); ?></strong>
			</div>
		</div>

		<div class="state-progress progress">
			<span class="progress-bar" style="width: <?php echo esc_attr( $sold_percentage ) ?>%"></span>
		</div>
	</div>
	<?php
}