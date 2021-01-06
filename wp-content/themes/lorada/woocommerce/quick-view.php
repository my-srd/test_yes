<?php
/**
 *	Product Quick View Template
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce_loop;

$woocommerce_loop['quickview'] = true;
?>

<div class="product-view-wrapper product">
	<a href="javascript:;" class="quickview-close"></a>

	<div class="quickview-slider-wrapper">
		<?php  
	        $image_title 				= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_src 					= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_thumbnail' );
			$image_data_src				= wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_single' );
			$image_data_src_original 	= wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$image_link  				= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       				= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			$image_original				= get_the_post_thumbnail( $post->ID, 'full' );
			$attachment_count   		= count( $product->get_gallery_attachment_ids() );
			$catalog_image 				= get_the_post_thumbnail( $post->ID, 'shop_catalog');
			?>

			<div class="cover-image">
				<?php echo '' . $catalog_image; ?>
	        </div>

			<div class="swiper-container">
				<div class="swiper-wrapper images">
					<?php if ( has_post_thumbnail() ) { ?>  
					<div class="swiper-slide">
						<?php echo '' . $image; ?>
		            </div>
					<?php
		            $attachment_ids = $product->get_gallery_attachment_ids();
		            if ( $attachment_ids ) {
		                foreach ( $attachment_ids as $attachment_id ) {
		                    $image_link = wp_get_attachment_url( $attachment_id );
		                    if (!$image_link) continue;
		                    $image_title       			= esc_attr( get_the_title( $attachment_id ) );
		                    $image_src         			= wp_get_attachment_image_src( $attachment_id, 'shop_single_small_thumbnail' );
							$image_data_src    			= wp_get_attachment_image_src( $attachment_id, 'shop_single' );
							$image_data_src_original 	= wp_get_attachment_image_src( $attachment_id, 'full' );
							$image_link        			= wp_get_attachment_url( $attachment_id );
						    $image		      			= wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );?>                    		
							<div class="swiper-slide">
	                            <img src="<?php echo esc_url($image_data_src[0]); ?>" alt="<?php echo esc_html($image_title); ?>">
		                    </div>
		                	<?php
						}
					}
		            ?>		                
					<?php
					} else {
				        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
				    }
				    ?>
				</div>

				<div class="swiper-pagination"></div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
	</div><!-- Lorada slider wrapper -->

	<div class="quickview-item-info summary entry-summary">
		<div class="product-summary-inner">
			<?php
	        do_action( 'woocommerce_single_product_summary' );
	        ?>
		</div>
	</div><!-- Lorada item info -->
</div>