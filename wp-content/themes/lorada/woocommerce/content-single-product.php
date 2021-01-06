<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $woocommerce_loop;

$product_images_wrap_class = lorada_product_images_wrap_class();
$product_summary_wrap_class = lorada_product_summary_wrap_class();
$product_sticky = lorada_get_opt( 'sticky_product_contents' );
$product_sticky_metabox = get_post_meta( get_the_ID(), '_lorada_sticky_product_contents', true );
$opt_countdown_view = lorada_get_opt( 'single_countdown_view_style' );
$countdown_view = wc_get_loop_prop( 'countdown_view', $opt_countdown_view );
$woocommerce_loop['countdown_view'] = $countdown_view;
$woocommerce_loop['quickview'] = false;

if ( ! empty( $product_sticky_metabox ) ) {
	$product_sticky = $product_sticky_metabox;
}

$sticky_class = '';

if ( $product_sticky ) {
	$sticky_class = 'product-sticky-on';
}

$content_class = lorada_get_content_class();

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $sticky_class, $product ); ?>>
	<div class="row product-breadcrumbs-section">
		<div class="single-product-breadcrumbs-wrap">
			<?php woocommerce_breadcrumb(); ?>

			<?php if ( lorada_get_opt( 'product_navigation' ) ) : ?>
				<div class="product-navigation">
					<?php
						/**
						 * Hook: lorada_products_nav_hook.
						 *
						 * @hooked lorada_products_navigation - 10
						 */
						do_action( 'lorada_products_nav_hook' );
					?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="row product-image-summary-wrap">
		<div class="<?php echo esc_attr( $content_class ); ?> image-summary-content">
			<div class="row product-image-summary-inner">
				<div class="<?php echo esc_attr( $product_images_wrap_class ); ?> product-images">
					<div class="product-images-inner">
						<?php
							/**
							 * Hook: woocommerce_before_single_product_summary.
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							do_action( 'woocommerce_before_single_product_summary' );
						?>
					</div>
				</div>

				<div class="<?php echo esc_attr( $product_summary_wrap_class ); ?> summary entry-summary">
					<div class="product-summary-inner">
						<?php
							/**
							 * Hook: woocommerce_single_product_summary.
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked lorada_woocommerce_sale_product_countdown_time - 15 : Added
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_meta - 25
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked lorada_woocommerce_output_product_data_tabs_secondary - 35 : Added
							 * @hooked woocommerce_template_single_sharing - 50
							 * @hooked WC_Structured_Data::generate_product_data() - 60
							 */
							do_action( 'woocommerce_single_product_summary' );
						?>
					</div>
				</div>
			</div>
		</div>

		<?php
			/**
			 * woocommerce_sidebar hook.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action( 'woocommerce_sidebar' );
		?>
	</div>

	<?php
		if ( 'grouped' == $product->get_type() ) {
			/**
			 * Hook: lorada_woocommerce_grouped_product.
			 *
			 * @hooked lorada_woocommerce_grouped_product - 5
			 */
			do_action( 'lorada_woocommerce_grouped_product' );
		}
	?>

	<div class="product-tabs-wrapper row">
		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
