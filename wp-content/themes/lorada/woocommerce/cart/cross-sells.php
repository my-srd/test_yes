<?php
/**
 * Cross-sells
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

if ( ! lorada_get_opt( 'show_cross_sell_products' ) ) {
	return;
}

$product_column = lorada_get_opt( 'cross_sell_products_columns' );
$product_view = lorada_get_opt( 'cross_sell_product_view' );
$opt_hover = lorada_get_opt( 'shop_product_hover_style' );

if ( 'carousel' == $product_view ) {
	$woocommerce_loop['display_style'] = 'carousel';
}
$woocommerce_loop['columns'] = $product_column;
$woocommerce_loop['hover_style'] = $opt_hover;

if ( $cross_sells ) : ?>

	<div class="cross-sells crosssells products">
		<?php
		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in&hellip;', 'lorada' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php
			if ( 'grid' == $product_view ) :
				woocommerce_product_loop_start();
			elseif ( 'carousel' == $product_view ) :
				echo '<div class="after_product_cart-slider" data-columns="' . esc_attr( $product_column ) . '">';
			endif;

				foreach ( $cross_sells as $cross_sell ) {
					$post_object = get_post( $cross_sell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' );
				}

			if ( 'grid' == $product_view ) :
				woocommerce_product_loop_end();
			elseif ( 'carousel' == $product_view ) :
				echo '</div>';
			endif;
			?>

	</div>

<?php endif;

wp_reset_postdata();
