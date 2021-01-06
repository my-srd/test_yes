<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'ld-ajax' == lorada_is_ajax() ) {
	lorada_woocommerce_main_loop();
	die();
}

get_header( 'shop' );

// Get content container width
$content_class = lorada_get_content_class();
?>

<div class="main-content-wrapper">
	<?php
	/**
	 * Shop page heading
	 */
	lorada_page_heading();

	/**
	 * Hook: woocommerce_before_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked lorada_woocommerce_output_content_wrapper - 15
	 * @hooked woocommerce_breadcrumb - 20 : removed
	 * @hooked WC_Structured_Data::generate_website_data() - 30
	 */
	do_action( 'woocommerce_before_main_content' );
	?>

	<div class="row products-archive-container">
		<div class="site-content shop-content-area <?php echo esc_attr($content_class) ?>" rol="main">

			<div class="loading-effect"></div>
			<?php
			/**
			 * Hook: woocommerce_archive_description.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );

			if ( woocommerce_product_loop() ) {
				?>

				<div class="shop-loop-header">
					<div class="shop-loop-breadcrumbs">
						<?php
						woocommerce_breadcrumb();
						woocommerce_result_count();
						?>
					</div>

					<div class="shop-loop-tools">
						<?php

						/**
						 * Hook: woocommerce_before_shop_loop.
						 *
						 * @hooked wc_print_notices - 10 : Removed
						 * @hooked woocommerce_result_count - 20
						 * @hooked lorada_show_sidebar_btn - 25
						 * @hooked lorada_products_per_page_tab - 25
						 * @hooked lorada_change_products_display_mode - 25
						 * @hooked woocommerce_catalog_ordering - 30
						 * @hooked lorada_topside_filter_toggle - 40
						 */
						do_action( 'woocommerce_before_shop_loop' );
						?>
					</div>

					<?php
					/**
					 * Hook: lorada_woocommerce_after_shop_tools.
					 *
					 * @hooked lorada_woocommerce_topside_filter_widget - 10
					 */
					do_action( 'lorada_woocommerce_after_shop_tools' );
					?>
				</div>

				<?php

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			}
			?>

		</div>

		<?php
		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 * @hooked lorada_woocommerce_output_content_wrapper_end - 15
	 */
	do_action( 'woocommerce_after_main_content' );
	?>
</div>

<?php
get_footer( 'shop' );
