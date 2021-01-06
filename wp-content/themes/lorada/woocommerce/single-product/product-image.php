<?php
/**
 * Single Product Image
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( has_post_thumbnail() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
$thumbnail_position = lorada_get_opt('thumbnail_position');
$main_gallery_class = $thumb_gallery_class = $thumb_carousel_class = $gallery_wraper_class = '';

if ( 'left' == $thumbnail_position || 'bottom' == $thumbnail_position || 'without_thumbs' == $thumbnail_position ) {
	$gallery_wraper_class .= ' owl-carousel';
}

if ( 'left' == $thumbnail_position ) {
	$main_gallery_class = 'col-lg-10 order-2';
	$thumb_gallery_class = 'col-lg-2 order-1';
} elseif ( 'img_list_thumbs' == $thumbnail_position ) {
	$main_gallery_class = 'main-gallery-list';
	$thumb_gallery_class = 'vertical-thumb-gallery';
} else {
	$main_gallery_class = 'col-lg-12';
	$thumb_gallery_class = 'col-lg-12';
	$thumb_carousel_class = ' owl-carousel';
}

?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?> row thumb-position-<?php echo esc_attr( $thumbnail_position ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="<?php echo esc_attr( $main_gallery_class ); ?>">
		<div class="row">

			<?php
				/**
				 * Hook: lorada_woocommerce_single_product_flash.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 */
				do_action( 'lorada_woocommerce_single_product_flash' );
			?>

			<figure class="woocommerce-product-gallery__wrapper<?php echo esc_attr( $gallery_wraper_class ); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					$html = '<div class="product-image-wrap" data-index="0">';
					$html .= wc_get_gallery_image_html( $post_thumbnail_id, true );
					$html .= '</div>';
				} else {
					$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'lorada' ) );
					$html .= '</div>';
				}

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

				do_action( 'woocommerce_product_thumbnails' );
				?>
			</figure>

			<?php
				/**
				 * Hook: lorada_additional_product_image_actions.
				 *
				 * @hooked woocommerce_product_additional_action_start - 10
				 * @hooked woocommerce_product_video_view - 20
				 * @hooked woocommerce_product_360_view - 30
				 * @hooked woocommerce_product_image_popup - 40
				 * @hooked woocommerce_product_additional_action_end - 50
				 */
				do_action( 'lorada_additional_product_image_actions' );
			?>

		</div>
	</div>

	<?php if ( 'left' == $thumbnail_position || 'bottom' == $thumbnail_position || 'img_list_thumbs' == $thumbnail_position ) : ?>

		<div class="<?php echo esc_attr( $thumb_gallery_class ); ?>">

			<?php if ( 'bottom' == $thumbnail_position ) : ?>
				<div class="row">
			<?php endif; ?>

					<div class="thumbnails<?php echo esc_attr( $thumb_carousel_class ); ?>"></div>

			<?php if ( 'bottom' == $thumbnail_position ) : ?>
				</div>
			<?php endif; ?>

		</div>

	<?php endif; ?>
</div>
