<?php
/**
 * Single Product Share
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce_loop;
?>
<div class="summary-bottom-section">
	<?php if ( lorada_get_opt('share_product') ) : $share_type = lorada_get_opt('product_share_type'); ?>
		<div class="product-share">
			<span class="share-title">
				<?php echo ( 'follow' == $share_type ) ? esc_html__( 'Follow:', 'lorada' ) : esc_html__( 'Share:', 'lorada' ); ?>
			</span>

			<?php do_action( 'woocommerce_share' ); // Sharing plugins can hook into here ?>
		</div>
	<?php endif; ?>

	<?php if ( ! $woocommerce_loop['quickview'] ) : ?>
		<div class="product-size-guide">
			<?php do_action( 'woocommerce_size_guide' ); ?>
		</div>
	<?php endif; ?>
</div>