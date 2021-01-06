<?php
/**
 * Mobile bottom navbar
 */

if ( ! function_exists( 'lorada_mobile_bottom_navbar' ) ) {
	add_action( 'lorada_after_footer_content', 'lorada_mobile_bottom_navbar', 40 );

	function lorada_mobile_bottom_navbar() {
		$items = lorada_get_opt( 'sticky_toolbar_items' );

		if ( isset( $items['enabled']['placebo'] ) ) {
			unset( $items['enabled']['placebo'] );
		}

		$enabled_items = class_exists( 'XTS\Options' ) ? $items : $items['enabled'];

		if ( ! $enabled_items || ! lorada_get_opt( 'sticky_mob_toolbar' ) ) return;

		$classes = 'lorada-mobile-toolbar';
		if ( lorada_get_opt( 'mobile_toolbar_txt' ) ) {
			$classes .= ' show-toolbar-txt';
		}
		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
			<?php
			foreach ( $enabled_items as $key => $value ) :
				$key = class_exists( 'XTS\Options' ) ? $value : $key;

				switch ( $key ) :
					case 'home':
						lorada_mobile_navbar_page_link_temp( $key );
						break;
					case 'wishlist':
						lorada_mobile_navbar_wishlist_temp();
						break;
					case 'account':
						lorada_mobile_navbar_page_link_temp( $key );
						break;
					case 'categories':
						lorada_mobile_navbar_categories_temp();
						break;
					case 'search':
						lorada_mobile_navbar_search_temp();
						break;
					case 'shop':
						lorada_mobile_navbar_page_link_temp( $key );
						break;
					case 'blog':
						lorada_mobile_navbar_page_link_temp( $key );
						break;
					case 'cart':
						lorada_mobile_navbar_cart_temp();
						break;
					case 'custom_1':
						lorada_mobile_navbar_custom_link_temp( $key );
						break;
					case 'custom_2':
						lorada_mobile_navbar_custom_link_temp( $key );
						break;
				endswitch;
			endforeach;
			?>
		</div>
		<?php
	}
}

/* Page link toolbar item */
if ( ! function_exists( 'lorada_mobile_navbar_page_link_temp' ) ) {
	function lorada_mobile_navbar_page_link_temp( $key ) {
		$url = $text = '';

		switch ( $key ) {
			case 'home':
				$url = get_home_url();
				$text = esc_html__( 'Home', 'lorada' );
				$icon_class = 'lorada-home3';
				break;

			case 'account':
				$url = class_exists( 'WooCommerce' ) ? get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) : get_home_url();
				$text = esc_html__( 'My Account', 'lorada' );
				$icon_class = 'lorada-user';
				break;

			case 'shop':
				$url = class_exists( 'WooCommerce' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : get_home_url();
				$text = esc_html__( 'Shop', 'lorada' );
				$icon_class = 'lorada-store';
				break;

			case 'blog':
				$url  = get_permalink( get_option( 'page_for_posts' ) );
				$text = esc_html__( 'Blog', 'lorada' );
				$icon_class = 'lorada-register';
				break;
		}
		?>
		<div class="lorada-toolbar-item lorada-toolbar-<?php echo esc_attr( $key ); ?>">
			<a href="<?php echo esc_url( $url ) ?>">
				<i class="lorada <?php echo esc_attr( $icon_class ); ?>"></i>
				<span class="item-text"><?php echo $text; ?></span>
			</a>
		</div>
		<?php
	}
}

/* Wishlist toolbar item */
if ( ! function_exists( 'lorada_mobile_navbar_wishlist_temp' ) ) {
	function lorada_mobile_navbar_wishlist_temp() {
		if ( ! class_exists( 'WooCommerce' ) || ! class_exists( 'YITH_WCWL' ) ) return;

		?>
		<div class="lorada-toolbar-item lorada-toolbar-wishlist">
			<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>">
				<span class="item-icon-wrap">
					<i class="lorada lorada-heart"></i>
					<span class="product-count"><?php echo yith_wcwl_count_products(); ?></span>
				</span>
				<span class="item-text"><?php echo esc_html__( 'Wishlist', 'lorada' ); ?></span>
			</a>
		</div>
		<?php
	}
}

/* Product categories toolbar item */
if ( ! function_exists( 'lorada_mobile_navbar_categories_temp' ) ) {
	function lorada_mobile_navbar_categories_temp() {
		$args = array(
			'hide_empty'	=>	1,
			'parent'		=>	0
		);
		$cat_terms = get_terms( 'product_cat', $args );

		if ( ! class_exists( 'WooCommerce' ) || empty( $cat_terms ) ) return;

		?>
		<div class="lorada-toolbar-item lorada-toolbar-categories">
			<a href="#">
				<i class="lorada lorada-menu"></i>
				<span class="item-text"><?php echo esc_html__( 'Categories', 'lorada' ); ?></span>
			</a>
		</div>
		<?php
	}
}

/* Product search toolbar item */
if ( ! function_exists( 'lorada_mobile_navbar_search_temp' ) ) {
	function lorada_mobile_navbar_search_temp() {
		?>
		<div class="lorada-toolbar-item lorada-toolbar-search search-form-full_screen">
			<a href="#">
				<i class="lorada lorada-magnifier"></i>
				<span class="item-text"><?php echo esc_html__( 'Search', 'lorada' ); ?></span>
			</a>
		</div>
		<?php
	}
}

/* Product cart toolbar item */
if ( ! function_exists( 'lorada_mobile_navbar_cart_temp' ) ) {
	function lorada_mobile_navbar_cart_temp() {
		if ( ! class_exists( 'WooCommerce' ) ) return;

		?>
		<div class="lorada-toolbar-item lorada-toolbar-cart">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
				<span class="item-icon-wrap">
					<i class="lorada lorada-cart"></i>
					<span class="product-count"><?php echo sprintf('%d', WC()->cart->cart_contents_count); ?></span>
				</span>
				<span class="item-text"><?php echo esc_html__( 'Cart', 'lorada' ); ?></span>
			</a>
		</div>
		<?php
	}
}

/* Custom link toolabr item */
if ( ! function_exists( 'lorada_mobile_navbar_custom_link_temp' ) ) {
	function lorada_mobile_navbar_custom_link_temp( $key ) {
		$custom_url = lorada_get_opt( $key . '_url' );
		$custom_txt = lorada_get_opt( $key . '_txt' );
		$custom_icon = lorada_get_opt( $key . '_icon' );

		if ( $custom_icon['id'] && $custom_url && $custom_txt ) :
		?>
		<div class="lorada-toolbar-item lorada-toolbar-<?php echo esc_attr( $key ); ?>">
			<a href="<?php echo esc_url( $custom_url ) ?>">
				<?php echo wp_get_attachment_image( $custom_icon['id'] ); ?>
				<span class="item-text"><?php echo $custom_txt; ?></span>
			</a>
		</div>
		<?php
		endif;
	}
}

/* Product categories for mobile toolbar */
if ( ! function_exists( 'lorada_mobile_toolbar_categories' ) ) {
	add_action( 'lorada_after_footer_content', 'lorada_mobile_toolbar_categories', 45 );

	function lorada_mobile_toolbar_categories() {
		if ( ! class_exists( 'WooCommerce' ) ) return;

		$toolbar_items = lorada_get_opt( 'sticky_toolbar_items' );

		if ( isset( $toolbar_items['enabled']['placebo'] ) ) {
			unset( $toolbar_items['enabled']['placebo'] );
		}

		$enabled_items = class_exists( 'XTS\Options' ) ? $toolbar_items : $toolbar_items['enabled'];

		if ( array_key_exists( 'categories', $enabled_items ) ) {
			?>
			<div class="lorada-toolbar-product-cats-wrap">
				<div class="sidebar-header">
					<a href="#" class="close-sidebar"><i class="lorada lorada-cross2"></i></a>
				</div>

				<ul class="product-cats-list">
					<?php
					global $wp_query, $post;

					$current_cat   = false;
					$cat_ancestors = array();

					if ( is_tax( 'product_cat' ) ) {
						$current_cat   = $wp_query->queried_object;
						$cat_ancestors = get_ancestors( $current_cat->term_id, 'product_cat' );

					} elseif ( is_singular( 'product' ) ) {
						$terms = wc_get_product_terms(
							$post->ID,
							'product_cat',
							array(
								'orderby' => 'parent',
								'order'   => 'DESC',
							)
						);

						if ( $terms ) {
							$main_term = $terms[0];
							$current_cat = $main_term;
							$cat_ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
						}
					}

					$list_args = array(
						'walker'						=> new WC_Product_Cat_List_Walker(),
						'orderby'						=> 'menu_order',
						'order'							=> 'ASC',
						'title_li'						=> false,
						'taxonomy'						=> 'product_cat',
						'current_category'				=> ( $current_cat ) ? $current_cat->term_id : '',
						'current_category_ancestors'	=> $cat_ancestors,
						'hide_empty'					=> false
					);

					wp_list_categories( $list_args );
					?>
				</ul>
			</div>
			<?php
		}
	}
}
