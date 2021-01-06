<?php
/**
 * Add to wishlist template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly

global $product;
?>

<div class="wishlist-icon">
	<?php
	$btn_class = 'wishlist-button sticker wishlist content-product-btn';

	if ( $exists && ! $available_multi_wishlist ) {
		$btn_class .= ' browse-wishlist';
	} else {
		$btn_class .= ' add-to-wishlist';
	}
	?>

	<span class="<?php echo esc_attr( $btn_class ); ?>">
		<span class="txt-label"><?php echo esc_html__( 'Wishlist', 'lorada' ); ?></span>
	</span>

	<div class="yith-wcwl-add-to-wishlist add-to-wishlist-<?php echo esc_attr( $product_id ); ?> <?php echo esc_attr( $container_classes ); ?> wishlist-fragment on-first-load" data-fragment-ref="<?php echo esc_attr( $product_id ); ?>" data-fragment-options="<?php echo esc_attr( json_encode( $fragment_options ) )?>">
	    <?php if( ! $ajax_loading ): ?>
	        <?php if( ! ( $disable_wishlist && ! is_user_logged_in() ) ): ?>

	            <!-- ADD TO WISHLIST -->
	            <?php yith_wcwl_get_template( 'add-to-wishlist-' . $template_part . '.php', $var ); ?>

	            <!-- COUNT TEXT -->
	            <?php
	            if( $show_count ):
	                echo yith_wcwl_get_count_text( $product_id );
	            endif;
	            ?>

	        <?php else: ?>
	            <a href="<?php echo esc_url( add_query_arg( array( 'wishlist_notice' => 'true', 'add_to_wishlist' => $product_id ), get_permalink( wc_get_page_id( 'myaccount' ) ) ) )?>" rel="nofollow" class="disabled_item <?php echo str_replace( array( 'add_to_wishlist', 'single_add_to_wishlist' ), '', $link_classes ) ?>" >
	                <?php echo '' . $label ?>
	            </a>
	        <?php endif; ?>
		<?php endif; ?>
	</div>

</div>
