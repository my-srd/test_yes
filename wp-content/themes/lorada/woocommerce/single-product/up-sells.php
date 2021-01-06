<?php
/**
 * Single Product Up-Sells
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

if ( ! lorada_get_opt( 'show_upsell_products' ) ) {
	return;
}

$product_column = lorada_get_opt( 'upsell_products_columns' );
$product_view = lorada_get_opt( 'upsell_product_view' );
$product_position = lorada_get_opt( 'upsells_position' );
$opt_hover = lorada_get_opt( 'shop_product_hover_style' );

if ( 'carousel' == $product_view ) {
	$woocommerce_loop['display_style'] = 'carousel';
}

$woocommerce_loop['columns'] = $product_column;
$woocommerce_loop['hover_style'] = $opt_hover;

if ( $upsells ) : ?>

	<?php if ( 'sidebar' == $product_position ) : ?>
		<section class="up-sells upsells-widget">
			<h2 class="widget-title"><?php esc_html_e( 'Also like&hellip;', 'lorada' ) ?></h2>

			<?php lorada_product_widget_template( true, $upsells ); ?>		
		</section>
	<?php else : ?>
		<section class="up-sells upsells products">

			<h2><?php esc_html_e( 'You may also like&hellip;', 'lorada' ) ?></h2>

			<?php
			if ( 'grid' == $product_view ) :
				woocommerce_product_loop_start();
			elseif ( 'carousel' == $product_view ) :
				echo '<div class="after_single_product-slider" data-columns="' . esc_attr( $product_column ) . '">';
			endif;

				foreach ( $upsells as $upsell ) {
					$post_object = get_post( $upsell->get_id() );

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
