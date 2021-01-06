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
?>

<li class="widget-item product-small-widget">
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
	
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<?php echo '' . $product->get_image(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<div class="small-widget-info">
			<span class="product-title"><?php echo wp_kses_post( $product->get_name() ); ?></span>
			
			<?php if ( ! empty( $show_rating ) ) : ?>
				<?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
			<?php endif; ?>
			
			<span class="price"><?php echo '' . $product->get_price_html(); ?></span>
		</div>
	</a>
	
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>
