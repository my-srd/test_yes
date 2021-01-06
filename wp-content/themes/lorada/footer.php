<?php
/**
 * Main Theme Footer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

		<!-- Footer -->
		<?php
			if ( lorada_get_opt( 'enable_footer' ) ) :
				lorada_get_template_part( 'footer/footer', 'template' );
			endif;
		?>
		<!-- End Footer -->

		<?php if ( ! empty( lorada_get_opt( 'site_layout' ) ) && 'boxed' == lorada_get_opt( 'site_layout' ) ) : ?>
			</div>
		<?php endif; ?>

		<?php if ( is_singular( 'post' ) && ( 'backstretch' == lorada_get_opt( 'post_view_style' ) ) ) : ?>
			</div>
		<?php endif; ?>

	</div>
	<!-- End Page wrapper -->

	<?php
		// Include Mobile Navigation
		lorada_mobile_navigation();

		/**
		 * lorada_footer_actions hook.
		 *
		 * @hooked lorada_sale_countdown_template - 10
		 */
		do_action( 'lorada_footer_actions' );
	?>

	<!-- Product Quick View -->
	<div class="lorada-quick-view woocommerce"></div>

	<?php
	/**
	 * lorada_after_footer_content hook.
	 *
	 * @hooked lorada_sidebar_mini_cart - 10
	 * @hooked lorada_full_screen_searchbox - 15
	 * @hooked lorada_promo_popup - 20
	 * @hooked lorada_sticky_add_to_cart - 30
	 * @hooked lorada_mobile_sidebar_toggle_btn - 35
	 * @hooked lorada_mobile_bottom_navbar - 40
	 * @hooked lorada_mobile_toolbar_categories - 45
	 */
	do_action( 'lorada_after_footer_content' );
	?>

	<!-- Scroll Top Button -->
	<a href="#" class="back-to-top" title="<?php _e('Back To Top', 'lorada') ?>">
		<i class="lorada lorada-arrow-up"></i>
	</a>

	<!-- WordPress wp_footer() -->
	<?php wp_footer(); ?>
	
</body>
</html>