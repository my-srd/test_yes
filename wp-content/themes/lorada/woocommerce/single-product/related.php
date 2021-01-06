<?php
/**
 * Related Products
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

if ( ! lorada_get_opt( 'show_related_products' ) ) {
	return;
}

$product_counts = lorada_get_opt( 'related_products_count' );
$product_column = lorada_get_opt( 'related_products_columns' );
$product_view = lorada_get_opt( 'related_product_view' );
$product_position = lorada_get_opt( 'related_position' );
$opt_hover = lorada_get_opt( 'shop_product_hover_style' );

if ( 'carousel' == $product_view ) {
	$woocommerce_loop['display_style'] = 'carousel';
}

$woocommerce_loop['columns'] = $product_column;
$woocommerce_loop['hover_style'] = $opt_hover;

if ( $related_products ) : ?>

	<?php if ( 'sidebar' == $product_position ) : ?>
		<section class="related products related-widget">
			<h2 class="widget-title"><?php esc_html_e( 'Related', 'lorada' ); ?></h2>

			<?php lorada_product_widget_template( true, $related_products ); ?> 
		</section>
	<?php else : ?>
		<section class="related products">

			<h2><?php esc_html_e( 'Related products', 'lorada' ); ?></h2>

			<?php
			if ( 'grid' == $product_view ) :
				woocommerce_product_loop_start();
			elseif ( 'carousel' == $product_view ) :
				echo '<div class="after_single_product-slider" data-columns="' . esc_attr( $product_column ) . '">';
			endif;

				foreach ( $related_products as $related_product ) {
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' );
				}

			if ( 'grid' == $product_view ) :
				woocommerce_product_loop_end();
			elseif ( 'carousel' == $product_view ) :
				echo '</div>';
			endif;
			?>

		</section>
	<?php endif; ?>

<?php endif;

wp_reset_postdata();
