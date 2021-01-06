<?php
/**
 * The template for displaying product widget entries.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

if ( isset( $elementor ) && ( true == $elementor ) ) {
	echo '<div class="widget-item">';
} else {
	echo '<li class="widget-item">';
}
?>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
	
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<?php echo '' . $product->get_image(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<span class="product-title"><?php echo wp_kses_post( $product->get_name() ); ?></span>
	</a>
	
	<?php if ( ( ! empty( $show_rating ) ) && ( ! empty( $product->get_review_count() ) ) ) : ?>
		<div class="woocommerce-product-rating">
			<?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
			<span class="rating-count">(<?php echo esc_html( $product->get_review_count() ); ?>)</span>
		</div>
	<?php endif; ?>
	
	<span class="price"><?php echo '' . $product->get_price_html(); ?></span>
	
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>

<?php
if ( isset( $elementor ) && ( true == $elementor ) ) {
	echo '</div>';
} else {
	echo '</li>';
}
