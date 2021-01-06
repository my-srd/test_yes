<?php
/**
 * The template for displaying product widget entries.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

?>
<li class="widget-item">
	<?php do_action( 'woocommerce_widget_product_review_item_start', $args ); ?>

	<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
		<?php echo '' . $product->get_image(); ?>
		<span class="product-title"><?php echo esc_html( $product->get_name() ); ?></span>
	</a>

	<?php echo wc_get_rating_html( intval( get_comment_meta( $comment->comment_ID, 'rating', true ) ) );?>

	<span class="reviewer"><?php echo sprintf( esc_html__( 'by %s', 'lorada' ), get_comment_author( $comment->comment_ID ) ); ?></span>

	<?php do_action( 'woocommerce_widget_product_review_item_end', $args ); ?>
</li>
