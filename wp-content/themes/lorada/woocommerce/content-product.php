<?php
/**
 * The template for displaying product content within loops
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Input content product classes
$classes = array();
$classes[] = 'product-content-item';

$opt_view_style = lorada_get_shop_view_style();
$view_style = wc_get_loop_prop( 'display_style', $opt_view_style );

$opt_hover = lorada_get_opt( 'shop_product_hover_style' );
$hover = wc_get_loop_prop( 'hover_style', $opt_hover );

$opt_countdown_view = lorada_get_opt( 'shop_countdown_view_style' );
$countdown_view = wc_get_loop_prop( 'countdown_view', $opt_countdown_view );
$woocommerce_loop['countdown_view'] = $countdown_view;
$wc_loop_count = wc_get_loop_prop( 'loop', 0 ) + 1;

if ( $product->get_rating_count() > 0 ) {
	$classes[] = 'has-review';
}

$opt_hover_layout = array( 'hover-1', 'hover-2', 'hover-3', 'hover-4' );

if ( empty( $woocommerce_loop['group_offer_products'] ) ) {
	if ( 'list' == $view_style ) {
		$hover = 'list';
		$classes[] = 'product-list-view';
	} else {
		$classes[] = 'product-' . $hover . '-layout';
	}
}

if ( lorada_get_opt('product_quick_shop') ) {
	$classes[] = 'product-quick-shop-enable';
}

if ( isset( $woocommerce_loop['special_products'] ) && ( true == $woocommerce_loop['special_products'] ) ) {
	?>
		<div class="special-offer-products product-view-<?php echo esc_attr( $woocommerce_loop['product_layout'] ); ?>">
			<?php wc_get_template_part( 'special', 'product' ); ?>
		</div>
	<?php

	return;
}

if ( isset( $woocommerce_loop['group_offer_products'] ) && ( true == $woocommerce_loop['group_offer_products'] ) ) {
	$classes[] = 'group-offer-product-view';
	$classes[] = 'product-hover-1-layout';

	?>
		<div <?php wc_product_class( $classes, $product ); ?> data-id="<?php echo esc_attr( $product->get_id() ); ?>">
			<?php wc_get_template_part( 'group-offer', 'product' ); ?>
		</div>
	<?php

	return;
}
?>

<div <?php wc_product_class( $classes, $product ); ?> data-id="<?php echo esc_attr( $product->get_id() ); ?>" data-loop="<?php echo esc_attr( $wc_loop_count ) ?>">
	<?php
		if ( 'list' == $hover ) {
			wc_get_template_part( 'content', 'product-list' ); 
		} else if ( "hover-3" == $hover ) {
			wc_get_template_part( 'content', 'product-hover-2' ); 
		} else if ( "hover-4" == $hover ) {
			wc_get_template_part( 'content', 'product-hover-3' ); 
		} else {
			wc_get_template_part( 'content', 'product-hover-1' ); 
		}
	?>
</div>