<?php
/**
 *	WooCommerce Helpers
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Add/Remove functions into/from pre-defined WooCommerce actions

/* Remove actions */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating' );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

if ( ! empty( lorada_get_opt('grouped_product_position') ) && ( 'after_summary' == lorada_get_opt('grouped_product_position') ) ) {
	remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
}

/* Add actions */
add_action( 'woocommerce_before_main_content', 'lorada_woocommerce_output_content_wrapper', 15 );
add_action( 'woocommerce_after_main_content', 'lorada_woocommerce_output_content_wrapper_end', 15 );
add_action( 'woocommerce_before_shop_loop', 'lorada_show_sidebar_btn', 25 );
add_action( 'woocommerce_before_shop_loop', 'lorada_products_per_page_tab', 25 );
add_action( 'woocommerce_before_shop_loop', 'lorada_change_products_display_mode', 25 );
add_action( 'woocommerce_before_shop_loop', 'lorada_topside_filter_toggle', 40 );
add_action( 'woocommerce_archive_description', 'wc_print_notices', 5 );
add_action( 'wp_ajax_lorada_variable_ajax_cart', 'lorada_variable_ajax_cart', 10 );
add_action( 'wp_ajax_nopriv_lorada_variable_ajax_cart', 'lorada_variable_ajax_cart', 10 );
add_action( 'wp_ajax_lorada_ajax_add_to_cart', 'lorada_ajax_add_to_cart', 10 );
add_action( 'wp_ajax_nopriv_lorada_ajax_add_to_cart', 'lorada_ajax_add_to_cart', 10 );
add_action( 'wp_ajax_lorada_product_quickview', 'lorada_product_quickview_template' );
add_action( 'wp_ajax_nopriv_lorada_product_quickview', 'lorada_product_quickview_template' );
add_action( 'wp_ajax_lorada_ajax_search', 'lorada_autocomplete_ajax_suggestion' );
add_action( 'wp_ajax_nopriv_lorada_ajax_search', 'lorada_autocomplete_ajax_suggestion' );

add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'lorada_woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'lorada_woocommerce_template_loop_product_hover_img', 15 );
add_action( 'woocommerce_before_shop_loop_item_title', 'lorada_variable_product_quick_shop', 20 );
add_action( 'woocommerce_shop_loop_item_title', 'lorada_woocommerce_template_loop_product_category', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'lorada_woocommerce_template_loop_product_title', 20 );

add_action( 'lorada_woocommerce_before_group_offer_item', 'lorada_woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'lorada_woocommerce_before_group_offer_item', 'lorada_woocommerce_template_loop_product_hover_img', 20 );
add_action( 'lorada_woocommerce_before_group_offer_item', 'lorada_variable_product_quick_shop', 30 );

add_action( 'woocommerce_after_shop_loop_item', 'lorada_woocommerce_template_loop_wishlist', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'lorada_add_compare_link', 15 );
add_action( 'woocommerce_after_shop_loop_item', 'lorada_woocommerce_template_loop_quickview', 20 );

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

add_action( 'lorada_woocommerce_after_shop_tools', 'lorada_woocommerce_topside_filter_widget', 10 );
add_action( 'lorada_woocommerce_product_countdown', 'lorada_woocommerce_sale_product_countdown_time', 10 );

add_action( 'woocommerce_shop_loop_subcategory_title', 'lorada_woocommerce_template_loop_category_title', 10 );

add_action( 'lorada_woocommerce_single_product_flash', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_share', 'lorada_product_share_buttons', 10 );
add_action( 'lorada_products_nav_hook', 'lorada_products_navigation', 10 );
add_action( 'woocommerce_after_single_product_summary', 'lorada_woocommerce_output_product_data_tabs', 10 );

if ( lorada_get_opt( 'single_product_countdown' ) ) {
	add_action( 'woocommerce_single_product_summary', 'lorada_woocommerce_sale_product_countdown_time', 15 );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );
add_action( 'woocommerce_single_product_summary', 'lorada_woocommerce_output_product_data_tabs_secondary', 35 );

add_action( 'woocommerce_after_single_product_summary', 'lorada_woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'lorada_woocommerce_output_related_products', 20 );
add_action( 'lorada_before_sidebar_area', 'lorada_woocommerce_upsell_display_sidebar', 10 );
add_action( 'lorada_before_sidebar_area', 'lorada_woocommerce_output_related_products_sidebar', 15 );

if ( ! empty( lorada_get_opt('image_action') ) ) {
	add_action( 'lorada_additional_product_image_actions', 'woocommerce_product_additional_action_start', 10 );
	add_action( 'lorada_additional_product_image_actions', 'woocommerce_product_additional_action_end', 50 );
}

add_action( 'lorada_additional_product_image_actions', 'woocommerce_product_360_view', 30 );
add_action( 'lorada_additional_product_image_actions', 'woocommerce_product_video_view', 20 );

if ( 'zoom' == lorada_get_opt('image_action') ) {
	add_action( 'lorada_additional_product_image_actions', 'woocommerce_product_image_popup', 40 );
}

add_action( 'lorada_woocommerce_grouped_product', 'lorada_woocommerce_grouped_product', 10 );
add_action( 'woocommerce_widget_shopping_cart_buttons', 'lorada_woocommerce_widget_shopping_cart_button_view_cart', 10 );
add_action( 'woocommerce_widget_shopping_cart_buttons', 'lorada_woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
add_action( 'woocommerce_cart_is_empty', 'lorada_empty_cart_text', 10 );
add_action( 'woocommerce_before_quantity_input_field', 'lorada_quantity_minus_btn', 10 );
add_action( 'woocommerce_after_quantity_input_field', 'lorada_quantity_plus_btn', 10 );
add_action( 'woocommerce_login_form_end', 'lorada_social_login' );
add_action( 'woocommerce_account_navigation', 'lorada_myaccount_customer_avatar', 5 );
add_action( 'woocommerce_account_dashboard', 'lorada_myaccount_links', 10 );


/* Add filters */
add_filter( 'woocommerce_sale_flash', 'lorada_product_flash', 10 );
add_filter( 'woocommerce_add_to_cart_fragments', 'lorada_woocommerce_add_to_cart_fragments', 10 );
add_filter( 'woocommerce_product_categories_widget_args', 'lorada_filter_product_categories_widget_args', 10 );
add_filter( 'shortcode_atts_product_add_to_cart', 'lorada_add_to_cart_shortcode_atts', 10, 3 );
add_filter( 'woocommerce_output_related_products_args', 'lorada_woocommerce_output_related_products_args', 10 );
add_filter( 'woocommerce_product_tabs', 'lorada_product_additional_tabs' );
add_filter( 'woocommerce_gallery_thumbnail_size', 'lorada_wc_gallery_thumbnail_size' );
// Disable WooCommerce Default 3 stylesheets
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


/**
 * Custom Walker to show Lorada Category
 */
if ( ! class_exists( 'Lorada_Walker_Category' ) ) {
	class Lorada_Walker_Category extends Walker_Category {
		public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
			/** This filter is documented in wp-includes/category-template.php */
			$cat_name = apply_filters(
				'list_cats',
				esc_attr( $category->name ),
				$category
			);

			// Don't generate an element if the category name is empty.
			if ( ! $cat_name ) {
				return;
			}

			$link = '<div class="category-nav-link">';
			$link .= '<a href="' . esc_url( get_term_link( $category ) ) . '" alt="' . esc_attr( $category->cat_name ) . '">';

			$icon_url = get_term_meta( $category->term_id, 'product_cat_shop_icon', true );

			if ( ! empty( $icon_url ) ) {
				$link .= '<img src="'  . esc_url( $icon_url ) . '" alt="' . esc_attr( $category->cat_name ) . '" class="category-icon" />';
			}

			$link .= '<span class="category-summary">';
			$link .= '<span class="category-name">' . $cat_name . '</span>';

			if ( ! empty( $args['show_count'] ) ) {
				$link .= '<span class="category-products-count"><span class="cat-count-number">' . number_format_i18n( $category->count ) . '</span> <span class="cat-count-label">' . _n( 'product', 'products', $category->count, 'lorada' ) . '</span></span>';
			}

			$link .= '</span>';
			$link .= '</a>';

			$link .= '</div>';


			if ( 'list' == $args['style'] ) {
				$default_cat = get_option( 'default_product_cat' );
				$output .= "\t<li";
				$css_classes = array(
					'cat-item',
					'cat-item-' . $category->term_id,
					( $category->term_id == $default_cat ? 'wc-default-cat' : '')
				);

				if ( ! empty( $args['current_category'] ) ) {
					// 'current_category' can be an array, so we use `get_terms()`.
					$_current_terms = get_terms( $category->taxonomy, array(
						'include'		=> $args['current_category'],
						'hide_empty'	=> false,
					) );

					foreach ( $_current_terms as $_current_term ) {
						if ( $category->term_id == $_current_term->term_id ) {
							$css_classes[] = 'current-cat';
						} elseif ( $category->term_id == $_current_term->parent ) {
							$css_classes[] = 'current-cat-parent';
						}

						while ( $_current_term->parent ) {
							if ( $category->term_id == $_current_term->parent ) {
								$css_classes[] =  'current-cat-ancestor';
								break;
							}

							$_current_term = get_term( $_current_term->parent, $category->taxonomy );
						}
					}
				}

				/**
				 * Filter the list of CSS classes to include with each category in the list.
				 *
				 * @since 4.2.0
				 *
				 * @see wp_list_categories()
				 *
				 * @param array  $css_classes An array of CSS classes to be applied to each list item.
				 * @param object $category    Category data object.
				 * @param int    $depth       Depth of page, used for padding.
				 * @param array  $args        An array of wp_list_categories() arguments.
				 */
				$css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

				$output .=  ' class="' . $css_classes . '"';
				$output .= ">$link\n";
			} elseif ( isset( $args['separator'] ) ) {
				$output .= "\t$link" . $args['separator'] . "\n";
			} else {
				$output .= "\t$link<br />\n";
			}
		}
	}
}


/**
 * Custom Walker to modify WooCommerce Product Categories Widget
 */
if ( ! class_exists( 'Lorada_WC_Product_Cat_List_Walker' ) && class_exists( 'WooCommerce' ) ) :

	include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );

	class Lorada_WC_Product_Cat_List_Walker extends WC_Product_Cat_List_Walker {

		/**
		 * Start the element output.
		 *
		 * @see Walker::start_el()
		 * @since 2.1.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int $depth Depth of category in reference to parents.
		 * @param integer $current_object_id
		 */
		public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {
			$output .= '<li class="cat-item cat-item-' . $cat->term_id;

			if ( $args['current_category'] == $cat->term_id ) {
				$output .= ' current-cat';
			}

			if ( $args['has_children'] && $args['hierarchical'] ) {
				$output .= ' cat-parent';
			}

			if ( $args['current_category_ancestors'] && $args['current_category'] && in_array( $cat->term_id, $args['current_category_ancestors'] ) ) {
				$output .= ' current-cat-parent';
			}

			$output .=  '"><a href="' . get_term_link( (int) $cat->term_id, $this->tree_type ) . '">' . $cat->name . '</a>';

			if ( $args['show_count'] ) {
				$output .= ' <span class="count">' . $cat->count . '</span>';
			}
		}
	}

endif;


/**
 * Return bool by checking if current page is product attribute archive page
 */
if ( ! function_exists( 'lorada_is_product_attribute_archive' ) ) {
	function lorada_is_product_attribute_archive() {
		$queried_object = get_queried_object();
		if ( $queried_object && property_exists( $queried_object, 'taxonomy' ) ) {
			$taxonomy = $queried_object->taxonomy;
			return 'pa_' == substr($taxonomy, 0, 3);
		}

		return false;
	}
}


/**
 * Return bool by checking if current page is WooCommerce archive page
 */
if ( ! function_exists( 'lorada_is_shop_archive' ) ) {
	function lorada_is_shop_archive() {
		return class_exists( 'WooCommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || lorada_is_product_attribute_archive() );
	}
}


/**
 * WooCommerce Archive Ajax Main Loop
 */
if ( ! function_exists( 'lorada_woocommerce_main_loop' ) ) {
	function lorada_woocommerce_main_loop() {
		global $paged, $wp_query;

		$max_page = $wp_query->max_num_pages;

		ob_start();

		if ( isset( $_GET['loop'] ) && ! empty( $_GET['loop'] ) ) {
			wc_set_loop_prop( 'loop', (int) $_GET['loop'] );
		}

		if ( $columns = lorada_get_opt( 'shop_products_columns' ) ) {
			wc_set_loop_prop( 'columns', $columns );
		}

		if ( woocommerce_product_loop() ) {
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
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}

		$output = ob_get_clean();
		$output = array(
			'items'		=>	$output,
			'status'	=>	( $max_page > $paged ) ? 'have-products' : 'no-more-products',
			'nextPage'	=>	str_replace( '&#038;', '&', next_posts( $max_page, false ) )
		);

		echo json_encode( $output );
	}
}

/**
 * Display additional content wrapper for shop page width
 */
if ( ! function_exists( 'lorada_woocommerce_output_content_wrapper' ) ) {
	function lorada_woocommerce_output_content_wrapper() {
		$site_layout      = lorada_get_opt( 'site_layout' );
		$shop_page_layout = lorada_get_opt( 'shop_page_layout' );
		$product_page_layout = lorada_get_opt( 'single_product_width' );

		if ( is_singular( 'product' ) ) {
			$render_page_layout = $product_page_layout;
		} else {
			$render_page_layout = $shop_page_layout;
		}

		if ( 'full' == $site_layout ) {
			if ( 'custom' == $render_page_layout ) {
				echo '<div class="container">';
			} else {
				echo '<div class="container-fluid">';
			}
		} else {
			echo '<div class="container">';
		}
	}
}


/**
 * Display additional content wrapper for shop page width
 */
if ( ! function_exists( 'lorada_woocommerce_output_content_wrapper_end' ) ) {
	function lorada_woocommerce_output_content_wrapper_end() {
		echo '</div>';
	}
}


/**
 * Recursive function to get category image or take it from some parent term
 */
if ( ! function_exists( 'lorada_get_category_page_title_image' ) ) {
	function lorada_get_category_page_title_image( $cat ) {
		$taxonomy = 'product_cat';
		$meta_key = '';
		$cat_image = get_term_meta( $cat->term_id, 'product_cat_bg_image', true );

		if ( $cat_image != '' ) {
			return $cat_image;
		} else if ( ! empty( $cat->parent ) ) {
			$parent = get_term_by( 'term_id', $cat->parent, $taxonomy );

			return lorada_get_category_page_title_image( $parent );
		}

		return '';
	}
}


/**
 * Show categories menu
 */
if ( ! function_exists( 'lorada_product_categories_nav' ) ) {
	function lorada_product_categories_nav() {
		global $wp_query, $post;

		$shop_child_categories = lorada_get_opt( 'shop_child_categories' );

		$list_args = array(
			'taxonomy'		=>	'product_cat',
			'hide_empty'	=>	false
		);

		// Menu Order
		// $list_args['menu_order'] = false;
		$list_args['menu_order'] = 'asc';

		// Setup Current Category
		$current_cat   = false;
		$cat_children = array();

		if ( is_tax( 'product_cat' ) ) {
			$current_cat   = $wp_query->queried_object;
			$cat_children = get_term_children( $current_cat->term_id, 'product_cat' );
		}

		$list_args['depth']            = 1;
		$list_args['title_li']         = '';
		$list_args['hierarchical']     = 1;
		$list_args['show_count']       = lorada_get_opt( 'shop_products_count' );
		$list_args['walker']           = new Lorada_Walker_Category();

		$class = ( lorada_get_opt( 'shop_products_count' ) ) ? 'has-product-count' : 'no-product-count';

		$shop_link = get_post_type_archive_link( 'product' );

		include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );

		if ( is_object( $current_cat ) && empty( $cat_children ) && $shop_child_categories )
			return;

		echo '<div class="lorada-show-categories"><a href="#">' . esc_html__( 'Categories', 'lorada' ) . '</a></div>';

		echo '<ul class="lorada-product-categories ' . esc_attr( $class ). '">';

			echo '
			<li class="cat-link shop-all-link">
				<div class="category-nav-link">
					<a href="' . esc_url( $shop_link ) . '">
						<span class="category-summary">
							<span class="category-name">' . esc_html__( 'All', 'lorada' ) . '</span>
							<span class="category-products-count">
								<span class="cat-count-label">' . esc_html__( 'products', 'lorada' ) . '</span>
							</span>
						</span>
					</a>
				</div>
			</li>';

			if ( $shop_child_categories && ! empty( $cat_children ) ) {
				$list_args['child_of'] = $current_cat->term_id;
			}

			wp_list_categories( $list_args );

		echo '</ul>';
	}
}

/**
 * Display Product Thumbnails in product loop
 */
if ( ! function_exists( 'lorada_woocommerce_template_loop_product_thumbnail' ) ) {
	function lorada_woocommerce_template_loop_product_thumbnail() {
		echo lorada_get_product_thumbnail();
	}
}

if ( ! function_exists( 'lorada_get_product_thumbnail' ) ) {
	function lorada_get_product_thumbnail( $attach_id = false, $size = 'shop_catalog' ) {
		global $post, $woocommerce_loop;

		$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
		$display_style = wc_get_loop_prop( 'display_style', lorada_get_shop_view_style() );
		$product_link_open = lorada_get_opt( 'product_link' );
		$loading_class = '';
		$link_target = '';

		if ( 'carousel' != $display_style ) {
			$loading_class = 'is-loading';
		}

		if ( 'new_tab' == $product_link_open && lorada_is_shop_archive() ) {
			$link_target = 'rel="noopener noreferrer" target="_blank"';
		}

		if ( has_post_thumbnail() ) {
			if ( ! $attach_id ) {
				$attach_id = get_post_thumbnail_id();
			}

			$props = wc_get_product_attachment_props( $attach_id, $post );

			$html = '';
			$html .= '<a href="' . get_the_permalink() . '" class="lorada-product-img-link catalog-image ' . esc_attr( $loading_class ) . '" ' . $link_target . '>';
			$html .= wp_get_attachment_image( $attach_id, $image_size, '', array(
				'title'		=>	$props['title'],
				'alt'		=>	$props['alt'],
				'class'		=>	'img-responsive product-thumbnail-img'
			) );
			$html .= "</a>";

			return $html;
		} elseif ( wc_placeholder_img_src() ) {
			$html = '';
			$html .= '<a href="' . get_the_permalink() . '" class="lorada-product-img-link catalog-image ' . esc_attr( $loading_class ) . '" ' . $link_target . '>';
			$html .= wc_placeholder_img( $image_size );
			$html .= "</a>";

			return $html;
		}
	}
}

/**
 * Display Product Title in product loop
 */
if ( ! function_exists( 'lorada_woocommerce_template_loop_product_title' ) ) {
	function lorada_woocommerce_template_loop_product_title() {
		$html = "";
		$html .= "<h4 class='woocommerce-loop-product__title'>";
		$html .= "<a href='" . get_the_permalink() . "' class='woocommerce-loop-product-link'>";
		$html .= get_the_title();
		$html .= "</a></h4>";

		echo '' . $html;
	}
}

/**
 * Display Product Category in product loop
 */
if ( ! function_exists( 'lorada_woocommerce_template_loop_product_category' ) ) {
	function lorada_woocommerce_template_loop_product_category() {
		global $post, $product, $woocommerce_loop;

		$opt_categories_view = lorada_get_opt( 'shop_categories_view' );
		$categories_view = wc_get_loop_prop( 'categories_view', $opt_categories_view );

		if ( ! $categories_view ) {
			return;
		}

		$product_cats = wp_get_post_terms( $post->ID, 'product_cat' );

		if ( !empty( $product_cats ) && is_array( $product_cats ) ) {
			$product_cat = $product_cats[0];

			$html = "";
			$html .= "<p class='woocommerce-loop-product__cat product-cat-" . $product_cat->term_id . "'>";
			$html .= wc_get_product_category_list( $product->get_id(), ', ' );
			$html .= "</p>";

			echo '' . $html;
		}
	}
}

/**
 * Display 'QuickView' Button in product loop
 */
if ( ! function_exists( 'lorada_woocommerce_template_loop_quickview' ) ) {
	function lorada_woocommerce_template_loop_quickview() {
		global $product;

		if ( !lorada_get_opt( 'content_quick_view' ) ) return;

	    echo '<div class="content-product-btn quickview" data-id="'. esc_attr($product->get_id()) .'"><span class="txt-label">' . esc_html__( 'Quick View', 'lorada' ) . '</span></div>';
	}
}

/**
 * Display 'Wishlist' Button in product loop
 */
if ( ! function_exists( 'lorada_woocommerce_template_loop_wishlist' ) ) {
	function lorada_woocommerce_template_loop_wishlist() {
		$html = '';

		if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {
			$html = do_shortcode('[yith_wcwl_add_to_wishlist]');
		}

		echo '' . $html;
	}
}

/**
 * Display Product Flash
 */
if ( ! function_exists( 'lorada_product_flash' ) ) {
	function lorada_product_flash() {
		global $product;

		$flash_output = array();

		if ( $product->is_on_sale() ) {
			$percentage = '';

			if ( 'variable' == $product->get_type() ) {

				$maximum_percentage = 0;
				$variations = $product->get_variation_prices();

				foreach( $variations['regular_price'] as $key => $regular_price ) {
					$sale_price = $variations['sale_price'][$key];

					if ( $sale_price < $regular_price ) {
						$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

						if ( $percentage > $maximum_percentage ) {
							$maximum_percentage = $percentage;
						}
					}
				}

				$percentage = $maximum_percentage;

			} elseif ( 'simple' == $product->get_type() || 'external' == $product->get_type() ) {
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
			}

			if ( $percentage && lorada_get_opt('sale_label_view') ) {
				$flash_output[] = '<span class="onsale product-flash">-' . $percentage . '%</span>';
			} else {
				$flash_output[] = '<span class="onsale product-flash">' . esc_html__( 'Sale!', 'lorada' ) . '</span>';
			}
		}

		if ( ! $product->is_in_stock() ) {
			$flash_output[] = '<span class="out-stock product-flash">' . esc_html__( 'Sold Out', 'lorada' ) . '</span>';
		}

		if ( $product->is_featured() && lorada_get_opt( 'hot_label' ) ) {
			$flash_output[] = '<span class="featured product-flash">' . esc_html__( 'Hot', 'lorada' ) . '</span>';
		}

		if ( $flash_output ) {
			echo '<div class="product-flashs">' . implode( '', $flash_output ) . '</div>';
		}
	}
}

/**
 * Product Hover Image Generate
 */
if ( ! function_exists( 'lorada_woocommerce_template_loop_product_hover_img' ) ) {
	function lorada_woocommerce_template_loop_product_hover_img() {
		global $product, $woocommerce_loop;

		$thumb_attachment_ids = $product->get_gallery_image_ids();
		$hover_image = '';

		if ( ! empty( $thumb_attachment_ids[0] ) ) {
			$hover_image = lorada_get_product_thumbnail( $thumb_attachment_ids[0], 'shop_catalog' );
		}

		if ( '' != $hover_image ) {
			?>
			<div class="product-hover-img"><?php echo '' . $hover_image; ?></div>
			<?php
		}
	}
}

/**
 * Shop Page Additional Part on the Bottom of Toolbar
 */
if ( ! function_exists( 'lorada_woocommerce_topside_filter_widget' ) ) {
	function lorada_woocommerce_topside_filter_widget() {
		if ( 'full-width' != lorada_get_opt( 'shop_layout' ) || ! lorada_get_opt( 'shop_top_sidebar' ) ) return;

		?>
		<div class="topside-filter-widget">
			<div class="topside-widget-inner">
				<?php dynamic_sidebar( 'lorada-shop-sidebar' ); ?>
			</div>
		</div>
		<?php
	}
}

/**
 * Product Sale CountDown
 */
if ( ! function_exists( 'lorada_woocommerce_sale_product_countdown_time' ) ) {
	function lorada_woocommerce_sale_product_countdown_time() {
		global $product, $woocommerce_loop;

		$sale_start_date = get_post_meta( $product->get_id(), '_sale_price_dates_from', true );
		$sale_end_date = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );

		if ( $product->get_type() == 'variable' || apply_filters( 'lorada_sale_countdown_variable', false ) ) {
			$product_dig = apply_filters( 'lorada_countdown_variable_cache', true );
			$transient = 'lorada_countdown_variable_cache_' . $product->get_id();
			$added_variations = array();

			if ( $product_dig ) {
				$added_variations = get_transient( $transient );
			}

			if ( ! $added_variations ) {
				$added_variations = $product->get_available_variations();

				if ( $product_dig ) {
					set_transient( $transient, $added_variations, apply_filters( 'lorada_countdown_variable_cache_time', WEEK_IN_SECONDS ) );
				}
			}

			if ( $added_variations ) {
				$sale_start_date = get_post_meta( $added_variations[0]['variation_id'], '_sale_price_dates_from', true );
				$sale_end_date = get_post_meta( $added_variations[0]['variation_id'], '_sale_price_dates_to', true );
			}
		}

		$current_date = strtotime( date( 'Y-m-d H:i:s' ) );

		if ( $sale_start_date > $current_date || $sale_end_date < $current_date ) {
			return;
		}

		$timezone = 'GMT';
		if ( apply_filters( 'lorada_timezone', false ) ) $timezone = wc_timezone_string();

		$countdown_view = $woocommerce_loop['countdown_view'];
		$countdown_size = 'default';

		if ( isset( $woocommerce_loop['countdown_size'] ) ) $countdown_size = $woocommerce_loop['countdown_size'];

		if ( ( isset( $woocommerce_loop['product_layout'] ) ) && ( 'full' == $woocommerce_loop['product_layout'] ) ) {
			?>
			<span class="expire-label"><?php echo esc_html__( 'Expires in', 'lorada' ); ?>:</span>
			<?php
		}
		?>

		<div class="countdown-wrapper view-style-<?php echo esc_attr( $countdown_view ); ?>">
			<div class="product-sale-countdown countdown-timer countdown-view-<?php echo esc_attr( $countdown_view ); ?> countdown-size-<?php echo esc_attr( $countdown_size ); ?>" data-date-to="<?php echo esc_attr( date( 'Y-m-d H:i:s', $sale_end_date ) ); ?>" data-timezone="<?php echo esc_attr( $timezone ); ?>" data-view="<?php echo esc_attr( $countdown_view ); ?>"></div>
		</div>

		<?php
	}
}

if ( ! function_exists( 'lorada_clear_variable_countdown_cache' ) ) {
	function lorada_clear_variable_countdown_cache( $post_id ) {
		if ( ! apply_filters( 'lorada_countdown_variable_cache', true ) ) return;
		$transient = 'lorada_countdown_variable_cache_' . $post_id;

		delete_transient( $transient );
	}

	add_action( 'save_post', 'lorada_clear_variable_countdown_cache' );
}


/**
 * Get base shop page link
 */
if ( ! function_exists( 'lorada_shop_page_link' ) ) {
	function lorada_shop_page_link( $keep_query = false, $taxonomy = '' ) {
		$link = '';

		// Base Link decided by current page
		if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
			$link = home_url();
		} elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
			$link = get_post_type_archive_link( 'product' );
		} elseif( is_product_category() ) {
			$link = get_term_link( get_query_var('product_cat'), 'product_cat' );
		} elseif( is_product_tag() ) {
			$link = get_term_link( get_query_var('product_tag'), 'product_tag' );
		} else {
			$link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
		}

		if ( $keep_query ) {

			// Min/Max
			if ( isset( $_GET['min_price'] ) ) {
				$link = add_query_arg( 'min_price', wc_clean( $_GET['min_price'] ), $link );
			}

			if ( isset( $_GET['max_price'] ) ) {
				$link = add_query_arg( 'max_price', wc_clean( $_GET['max_price'] ), $link );
			}

			// Orderby
			if ( isset( $_GET['orderby'] ) ) {
				$link = add_query_arg( 'orderby', wc_clean( $_GET['orderby'] ), $link );
			}

			/**
			 * Search Arg.
			 * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
			 */
			if ( get_search_query() ) {
				$link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
			}

			// Post Type Arg
			if ( isset( $_GET['post_type'] ) ) {
				$link = add_query_arg( 'post_type', wc_clean( $_GET['post_type'] ), $link );
			}

			// Min Rating Arg
			if ( isset( $_GET['min_rating'] ) ) {
				$link = add_query_arg( 'min_rating', wc_clean( $_GET['min_rating'] ), $link );
			}

			// All current filters
			if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) {
				foreach ( $_chosen_attributes as $name => $data ) {
					if ( $name === $taxonomy ) {
						continue;
					}
					$filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );
					if ( ! empty( $data['terms'] ) ) {
						$link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
					}
					if ( 'or' == $data['query_type'] ) {
						$link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
					}
				}
			}
		}

		return $link;
	}
}


/**
 * Change number of products displayed per page
 */
if( ! function_exists( 'lorada_change_products_per_page' ) ) {
	function lorada_change_products_per_page() {
		$per_page = 12;
		$number   = apply_filters( 'lorada_shop_per_page', lorada_get_products_per_page() );

		if ( is_numeric( $number ) && ! empty( $number ) ) {
			$per_page = $number;
		}

		return $per_page;
	}

	add_filter( 'loop_shop_per_page', 'lorada_change_products_per_page', 20 );
}


/**
 * Get Items per page number on the shop page
 */
if ( ! function_exists( 'lorada_get_products_per_page' ) ) {
	function lorada_get_products_per_page() {
		if ( ! class_exists( 'WC_Session_Handler' ) ) {
			return;
		}

		$s = WC()->session; // WC()->session

		if ( isset( $_REQUEST['per_page'] ) && ! empty( $_REQUEST['per_page'] ) ) :
			return intval( $_REQUEST['per_page'] );
		elseif ( $s->__isset( 'shop_per_page' ) ) :
			$val = $s->__get( 'shop_per_page' );

			if ( ! empty( $val ) ) {
				return intval( $s->__get( 'shop_per_page' ) );
			}
		endif;

		return intval( lorada_get_opt( 'shop_per_page' ) );
	}
}


/**
 *
 */
if ( ! function_exists( 'lorada_show_sidebar_btn' ) ) {
	function lorada_show_sidebar_btn() {
		if ( wc_get_loop_prop( 'is_shortcode' ) || ! wc_get_loop_prop( 'is_paginated' ) ) return;
		?>

			<div class="lorada-show-sidebar-btn">
				<span class="lorada-sidebar-icon"></span>
				<span><?php esc_html_e('Show sidebar', 'lorada'); ?></span>
			</div>

		<?php
	}
}


/**
 * Items per page select on the shop page
 */
if ( ! function_exists( 'lorada_products_per_page_tab' ) ) {
	function lorada_products_per_page_tab() {
		if ( ! lorada_get_opt( 'per_page_links' ) || ( wc_get_loop_prop( 'is_shortcode' ) || ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) || ( function_exists( 'wcfmmp_is_store_page' ) && wcfmmp_is_store_page() ) )
			return;

		global $wp_query;

		$per_page_options          = lorada_get_opt( 'per_page_options' );
		$products_per_page_options = ( ! empty($per_page_options) ) ? explode( ',', $per_page_options ) : array( 12, 24, 36, -1 );

		?>

		<div class="shop-products-per-page">
			<span class="per-page-title"><?php esc_html_e( 'Show', 'lorada' ); ?></span>

			<?php
			foreach( $products_per_page_options as $key => $value ) :
				?>

				<a rel="nofollow" href="<?php echo add_query_arg( 'per_page', $value, lorada_shop_page_link(true) ); ?>" class="per-page-variation<?php echo ( lorada_get_products_per_page() == $value ) ? ' current-variation' : ''; ?>">
					<span><?php
						$text = '%s';
						esc_html( printf( $text, $value == -1 ? esc_html__( 'All', 'lorada' ) : $value ) );
					?></span>
				</a>

				<span class="per-page-border"></span>

				<?php
			endforeach;
			?>

		</div>
		<?php
	}
}


/**
 * Display Products view buttons on shop page
 */
if ( ! function_exists( 'lorada_change_products_display_mode' ) ) {
	function lorada_change_products_display_mode() {
		$shop_view = lorada_get_shop_view_style();
		?>

		<div class="shop-products-view">
			<?php
			$view_list = array(
				'list'	=>	'list',
				'grid'	=>	'large',
			);

			foreach ( $view_list as $key => $value ) {
				$shop_link = add_query_arg( 'shop_view', $key );

				$link_class = 'shop-view products-view-' . $key;
				$icon_class = 'lorada';

				if ( 'list' == $key ) {
					$icon_class .= ' lorada-list4';
				} elseif ( 'grid' == $key) {
					$icon_class .= ' lorada-icons';
				}

				if ( $shop_view == $key ) {
					$link_class .= ' current-selection';
					// $shop_link  = 'javascript:void(0)';
				}
				?>

				<a href="<?php echo esc_url( $shop_link ) ?>" class="<?php echo esc_attr( $link_class ) ?>">
					<i class="<?php echo esc_attr( $icon_class ) ?>"></i>
				</a>

				<?php
			}
			?>
		</div>

		<?php
	}
}


/**
 * Topside Filter Widget Toggle Button
 */
if ( ! function_exists( 'lorada_topside_filter_toggle' ) ) {
	function lorada_topside_filter_toggle() {
		if ( 'full-width' != lorada_get_opt( 'shop_layout' ) || ! lorada_get_opt( 'shop_top_sidebar' ) ) return;

		?>
		<div class="topside-filter-toggle">
			<a href="#" class="filter-toggle-btn"><?php echo esc_html__( 'Filter', 'lorada' ) ?></a>
		</div>
		<?php
	}
}


/**
 * Get Product View Method on shop page
 */
if ( ! function_exists( 'lorada_get_shop_view_style' ) ) {
	function lorada_get_shop_view_style() {
		$shop_view = lorada_get_opt( 'default_shop_products_style' );

		if ( isset( $_REQUEST['shop_view'] ) && in_array( $_REQUEST['shop_view'], array( 'list', 'grid' ) ) ) {
			$shop_view = $_REQUEST['shop_view'];
		}

		$shop_view = apply_filters( 'lorada_get_shop_view_style', $shop_view );

		if ( empty( $shop_view ) ) {
			$shop_view = 'grid';
		}

		return $shop_view;
	}
}

/**
 * Variable Product Quick Shop
 */
if ( ! function_exists( 'lorada_variable_product_quick_shop' ) ) {
	function lorada_variable_product_quick_shop() {
		?>
			<div class="product-quick-shop">
				<div class="shop-form-close"><span><?php echo esc_html__( 'Close', 'lorada' ); ?></span></div>
				<div class="shop-form-wrapper"></div>
			</div>
		<?php
	}
}

/**
 * Variable Product Ajax Shop Content
 */
if ( ! function_exists( 'lorada_variable_ajax_cart' ) ) {
	function lorada_variable_ajax_cart( $id = false ) {
		global $post;

		if ( isset( $_GET['id'] ) ) {
			$id = (int) $_GET['id'];
		}

		if ( ! $id || ! class_exists( 'WooCommerce' ) ) return;

		$args = array(
			'post__in'	=>	array( $id ),
			'post_type'	=>	'product'
		);
		$ajax_posts = get_posts( $args );

		foreach ( $ajax_posts as $ajax_post ) {
			setup_postdata( $ajax_post );
			woocommerce_template_single_add_to_cart();
		}

		wp_reset_postdata();

		die();
	}
}

/**
 * Lorada Product Ajax Cart
 */
if ( ! function_exists( 'lorada_ajax_add_to_cart' ) ) {
	function lorada_ajax_add_to_cart() {
		ob_start();

		woocommerce_mini_cart();

		$mini_cart = ob_get_clean();

		$data = array(
			'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
					'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>',
				)
			),
			'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() ),
		);

		wp_send_json( $data );

		die();
	}
}

/**
 * Lorada Product QuickView
 */
if ( ! function_exists( 'lorada_product_quickview_template' ) ) {
	function lorada_product_quickview_template() {

		global $post, $product, $woocommerce;

		$post = get_post($_GET['pid']);
		$product = wc_get_product( $post->ID );

		if ( post_password_required() ) {
			echo get_the_password_form();
			die();
			return;
		}

		if ( $product->product_type == "variable" ) {
			$variable_class = "product-type-variable";
		} else {
			$variable_class = "";
		}

		?>
			<div class="quickview-wrap-<?php echo esc_attr( $post->ID ); ?> <?php echo esc_attr( $variable_class ); ?>">
				<?php echo get_template_part('woocommerce/quick-view'); ?>
			</div>
		<?php

		die();

	}
}

/**
 * Refresh cart item in Header when add products via Ajax
 */
if ( ! function_exists( 'lorada_woocommerce_add_to_cart_fragments' ) ) {
	function lorada_woocommerce_add_to_cart_fragments( $fragments ) {

		ob_start();
		?>

		<div class="shopping-cart-info">
			<span class="cart-items-number"><?php echo sprintf('%d', WC()->cart->cart_contents_count); ?>
				<?php $count = ( ! WC()->cart->cart_contents_count ) ? 1 : WC()->cart->cart_contents_count; ?>
				<span class="item-label"><?php echo esc_html__( _n( 'item', 'items', $count, 'lorada' ) ); ?></span>
			</span>
			<span class="lorada-cart-subtotal">
				<span class="cart-label"><?php echo esc_html__( 'Basket', 'lorada' ); ?>: </span>
				<?php echo WC()->cart->get_cart_subtotal(); ?>
			</span>
		</div>

		<?php

		$fragments['.lorada-shopping-cart .shopping-cart-info'] = ob_get_clean();

		// Modify Mini-Cart Container
		$classes = 'mini-cart-container woocommerce';

		if ( 1 > count( WC()->cart->get_cart() ) ) {
			$classes .= ' mini-box';
		} else if ( 2 > count( WC()->cart->get_cart() ) ) {
			$classes .= ' semi-mini-box';
		}

		$mini_cart = $fragments['div.widget_shopping_cart_content'];

		unset( $fragments['div.widget_shopping_cart_content'] );

		$fragments['div.mini-cart-container'] = '<div class="' . $classes . '">' . $mini_cart . '</div>';

		return $fragments;
	}
}

/**
 * Variable Product Attribute Swatch
 */
if ( ! function_exists( 'lorada_product_attribute_swatch' ) ) {
	function lorada_product_attribute_swatch() {
		global $product;

		if ( ! lorada_get_opt('content_variation_switch') ) {
			return;
		}

		$product_id = $product->get_id();

		if ( empty( $product_id ) || ! $product->is_type( 'variable' ) )
			return false;

		$product_attributes = wc_get_attribute_taxonomies();
		$first_attribute_key = array_keys($product_attributes)[0];

		$attribute_name = 'pa_' . $product_attributes[$first_attribute_key]->attribute_name;
		if ( empty( $attribute_name ) ) return false;

		$variations_available = $product->get_available_variations();
		if ( empty( $variations_available ) ) return false;

		$available_attribute_swatches = lorada_get_variations_option( $attribute_name, $variations_available, $product_id );
		if ( empty( $available_attribute_swatches ) ) return false;

		$terms = wc_get_product_terms( $product_id, $attribute_name, array( 'fields' => 'slugs' ) );

		$tmp_available_attribute_swatches = $available_attribute_swatches;
		$available_attribute_swatches = array();

		foreach ( $terms as $id => $slug ) {
			if ( isset ( $tmp_available_attribute_swatches[$slug] ) ) {
				$available_attribute_swatches[$slug] = $tmp_available_attribute_swatches[$slug];
			}
		}

		$html = '';

		$html .= '<div class="product-attribute-swatches">';

			foreach ( $available_attribute_swatches as $key => $attribute_swatch ) {
				$bg_style = $swatch_class = $attribute_data = '';

				if ( ! empty( $attribute_swatch['attribute_image'] ) ) {
					$swatch_class .= ' image-swatch';
					$bg_style = 'background-image: url(' . $attribute_swatch['attribute_image'] . ');';
				} else if ( ! empty( $attribute_swatch['attribute_color'] ) ) {
					$swatch_class .= ' color-swatch';
					$bg_style = 'background-color: ' . $attribute_swatch['attribute_color'] . ';';
				} else {
					$swatch_class .= ' text-swatch';
				}

				if ( ! empty( $attribute_swatch['image_src'] ) ) {
					$attribute_data .= 'data-image-src="' . $attribute_swatch['image_src'] . '"';
					$attribute_data .= ' data-image-srcset="' . $attribute_swatch['image_srcset'] . '"';
					$attribute_data .= ' data-image-sizes="' . $attribute_swatch['image_sizes'] . '"';
					$swatch_class .= ' include-variation-image';
				}

				if ( ! empty( $attribute_swatch['is_in_stock'] ) && ! $attribute_swatch['is_in_stock'] ) {
					$swatch_class .= ' out-of-stock-variation';
				}

				$term = get_term_by( 'slug', $key, $attribute_name );
				$attribute_data .= ' data-toggle="tooltip" data-placement="top"';
				$attribute_data .= ' title="' . $term->name . '"';

				$html .= '<div class="product-attribute-inner ' . esc_attr( $swatch_class ) . '" style="' . esc_attr( $bg_style ) . '" ' . $attribute_data . '>' . $term->name . '</div>';
			}

		$html .= '</div>';

		return $html;
	}
}

/**
 * Product Filter by Category Widget args
 */
if ( ! function_exists( 'lorada_filter_product_categories_widget_args' ) ) {
	function lorada_filter_product_categories_widget_args( $list_args ) {
		$list_args['walker'] = new Lorada_WC_Product_Cat_List_Walker();

		return $list_args;
	}
}

/**
 * Show the subcategory title and product counts in the product loop
 */
if ( ! function_exists( 'lorada_woocommerce_template_loop_category_title' ) ) {
	function lorada_woocommerce_template_loop_category_title( $category ) {
		$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_image_src( $thumbnail_id, 'lorada-product-cat-thumb' );
			$image = $image[0];
		} else {
			$image = wc_placeholder_img_src();
		}

		?>
		<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="product-cat-inner">
			<div class="thumb-wrap">
				<img src="<?php echo '' . $image; ?>" alt="<?php echo esc_html( $category->slug ); ?>">
				<span class="product-count"><?php echo esc_html( $category->count ); ?> <?php echo esc_html( _n( 'product', 'products', $category->count, 'lorada' ) ); ?></span>
			</div>

			<span class="category-name"><?php echo esc_html( $category->name ); ?></span>
		</a>
		<?php
	}
}

/**
 * Modify shortcode [add_to_cart] atts
 */
if ( ! function_exists( 'lorada_add_to_cart_shortcode_atts' ) ) {
	function lorada_add_to_cart_shortcode_atts( $output, $pairs, $atts ) {
		if ( isset( $atts['button_style'] ) ) {
			$output['class'] .= 'add_to_cart_btn_' . $atts['button_style'];
		} else {
			$output['class'] .= 'add_to_cart_btn_primary';
		}

		if ( ! isset( $atts['style'] ) || empty( $atts['style'] ) ) {
			$output['style'] = '';
		}

		return $output;
	}
}

/**
 * Woocommerce Wishlist Ajax Count
 */
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'lorada_ajax_update_count' ) ) {
	function lorada_ajax_update_count() {
		wp_send_json( array(
			'count' => yith_wcwl_count_all_products()
		) );
	}

	add_action( 'wp_ajax_lorada_update_wishlist_count', 'lorada_ajax_update_count' );
	add_action( 'wp_ajax_nopriv_lorada_update_wishlist_count', 'lorada_ajax_update_count' );
}

/**
 * Generate Product Page Classes
 */
if ( ! function_exists( 'lorada_product_images_wrap_class' ) ) {
	function lorada_product_images_wrap_class() {
		$class = 'col-lg-';
		$col_val = lorada_product_images_size();

		return $class . $col_val;
	}

	function lorada_product_images_size() {
		$product_img_width = lorada_get_opt( 'product_img_width' );

		$col_val = 6;

		switch ( $product_img_width ) {
			case 1:
				$col_val = 4;
			break;
			case 2:
				$col_val = 7;
			break;
			case 3:
				$col_val = 8;
			break;
		}

		return apply_filters( 'lorada_product_images_size', $col_val );
	}
}

if ( ! function_exists( 'lorada_product_summary_wrap_class' ) ) {
	function lorada_product_summary_wrap_class() {
		$class = 'col-lg-';
		$col_val = lorada_product_summary_size();

		return $class . $col_val;
	}

	function lorada_product_summary_size() {
		return apply_filters( 'lorada_product_summary_size', 12 - lorada_product_images_size() );
	}
}

/**
 * Product Share Buttons
 */
if ( ! function_exists( 'lorada_product_share_buttons' ) ) {
	function lorada_product_share_buttons() {
		$share_type = lorada_get_opt('product_share_type');

		if ( class_exists( 'Lorada_Core_Main_Functions' ) ) {
			echo Lorada_Core_Main_Functions::instance()->lorada_core_social_buttons( array(
				'type' => $share_type,
				'btn_size' => 'medium',
				'btn_shape' => 'square',
				'btn_style' => 'colored'
			) );
		}
	}
}

/**
 * Adjust Single Product Page - Related product args
 */
if ( ! function_exists( 'lorada_woocommerce_output_related_products_args' ) ) {
	function lorada_woocommerce_output_related_products_args( $args ) {
		$product_counts = lorada_get_opt( 'related_products_count' );
		$product_counts = ( $product_counts ) ? $product_counts : 4;

		$args['posts_per_page']	= $product_counts;

		return $args;
	}
}

/**
 * Product Navigation
 */
if ( ! function_exists( 'lorada_products_navigation' ) ) {
	function lorada_products_navigation() {
		$next_product = get_next_post();
		$prev_product = get_previous_post();
		$next_product = ( ! empty( $next_product ) ) ? wc_get_product( $next_product->ID ) : false;
		$prev_product = ( ! empty( $prev_product ) ) ? wc_get_product( $prev_product->ID ) : false;

		if ( ! empty( $prev_product ) ) : ?>

			<div class="previous-product product-nav-btn">
				<a href="<?php echo esc_url( $prev_product->get_permalink() ); ?>"><?php esc_html_e('Previous product', 'lorada'); ?></a>

				<div class="product-preview-wrapper">
					<div class="product-preview">
						<div class="product-image-small">
							<a href="<?php echo esc_url( $prev_product->get_permalink() ); ?>" class="product-thumb-img">
								<?php echo wp_kses( $prev_product->get_image(), array( 'img' => array('class' => true,'width' => true,'height' => true,'src' => true,'alt' => true) ) );?>
							</a>
						</div>

						<div class="minimal-info">
							<a href="<?php echo esc_url( $prev_product->get_permalink() ); ?>" class="product-title">
								<?php echo esc_html( $prev_product->get_title() ); ?>
							</a>

							<span class="price">
								<?php echo '' . $prev_product->get_price_html(); ?>
							</span>
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>

		<?php if ( ! empty( $next_product ) ) : ?>

			<div class="next-product product-nav-btn">
				<a href="<?php echo esc_url( $next_product->get_permalink() ); ?>"><?php esc_html_e('Next product', 'lorada'); ?></a>

				<div class="product-preview-wrapper">
					<div class="product-preview">
						<div class="product-image-small">
							<a href="<?php echo esc_url( $next_product->get_permalink() ); ?>" class="product-thumb-img">
								<?php echo wp_kses( $next_product->get_image(), array( 'img' => array('class' => true,'width' => true,'height' => true,'src' => true,'alt' => true) ) );?>
							</a>
						</div>

						<div class="minimal-info">
							<a href="<?php echo esc_url( $next_product->get_permalink() ); ?>" class="product-title">
								<?php echo esc_html( $next_product->get_title() ); ?>
							</a>

							<span class="price">
								<?php echo '' . $next_product->get_price_html(); ?>
							</span>
						</div>
					</div>
				</div>
			</div>

		<?php endif;
	}
}

/**
 * Woocommerce Product Tabs View
 */
if ( ! function_exists( 'lorada_woocommerce_output_product_data_tabs' ) ) {
	function lorada_woocommerce_output_product_data_tabs() {
		$tab_view = lorada_get_opt('product_tabs_view');
		$tab_position = lorada_get_opt('product_tabs_position');

		if ( ( 'after_cart_btn' != $tab_position ) || ( 'accordion' != $tab_view ) ) {
			echo woocommerce_output_product_data_tabs();
		}
	}
}

/**
 * Woocommerce Product Tabs View after "Add to Cart" button
 */
if ( ! function_exists( 'lorada_woocommerce_output_product_data_tabs_secondary' ) ) {
	function lorada_woocommerce_output_product_data_tabs_secondary() {
		$tab_view = lorada_get_opt('product_tabs_view');
		$tab_position = lorada_get_opt('product_tabs_position');

		if ( 'after_cart_btn' == $tab_position && 'accordion' == $tab_view ) {
			?>
				<div class="product-tabs-wrapper tab-position-side">
					<?php echo woocommerce_output_product_data_tabs(); ?>
				</div>
			<?php
		}
	}
}

/**
 * Woocommerce upsell display standard position
 */
if ( ! function_exists( 'lorada_woocommerce_upsell_display' ) ) {
	function lorada_woocommerce_upsell_display() {
		$upsells_position = lorada_get_opt( 'upsells_position' );

		if ( ( 'standard' == $upsells_position ) && is_singular( 'product' ) ) {
			echo woocommerce_upsell_display();
		}
	}
}

/**
 * Woocommerce upsell display sidebar position
 */
if ( ! function_exists( 'lorada_woocommerce_upsell_display_sidebar' ) ) {
	function lorada_woocommerce_upsell_display_sidebar() {
		$upsells_position = lorada_get_opt( 'upsells_position' );

		if ( ( 'sidebar' == $upsells_position ) && is_singular( 'product' ) ) {
			echo woocommerce_upsell_display();
		}
	}
}

/**
 * Woocommerce Related display standard position
 */
if ( ! function_exists( 'lorada_woocommerce_output_related_products' ) ) {
	function lorada_woocommerce_output_related_products() {
		$related_position = lorada_get_opt( 'related_position' );

		if ( ( 'standard' == $related_position ) && is_singular( 'product' ) ) {
			echo woocommerce_output_related_products();
		}
	}
}

/**
 * Woocommerce Related display sidebar position
 */
if ( ! function_exists( 'lorada_woocommerce_output_related_products_sidebar' ) ) {
	function lorada_woocommerce_output_related_products_sidebar() {
		$related_position = lorada_get_opt( 'related_position' );

		if ( ( 'sidebar' == $related_position ) && is_singular( 'product' ) ) {
			echo woocommerce_output_related_products();
		}
	}
}

/**
 * Woocommerce Grouped Product View after summary
 */
if ( ! function_exists( 'lorada_woocommerce_grouped_product' ) ) {
	function lorada_woocommerce_grouped_product() {
		$grouped_proudcts_pos = lorada_get_opt('grouped_product_position');

		if ( ! empty( $grouped_proudcts_pos ) && ( 'after_summary' == $grouped_proudcts_pos ) ) {
			?>
				<div class="lorada-grouped-products row">
					<?php echo woocommerce_grouped_add_to_cart(); ?>
				</div>
			<?php
		}
	}
}

/**
 * Woocommerce Product Image Additional Actions
 */
if ( ! function_exists( 'woocommerce_product_360_view_gallery_ids' ) ) {
	function woocommerce_product_360_view_gallery_ids() {
		global $post;

		if ( ! $post ) return;

		$product_360_view_gallery = get_post_meta( $post->ID, '_lorada_product_360_gallery', true );
		return $product_360_view_gallery;
	}
}

if ( ! function_exists( 'woocommerce_product_additional_action_start' ) ) {
	function woocommerce_product_additional_action_start() {
		?>
			<div class="product-additional-action-btns">
		<?php
	}
}

if ( ! function_exists( 'woocommerce_product_additional_action_end' ) ) {
	function woocommerce_product_additional_action_end() {
		?>
			</div>
		<?php
	}
}

if ( ! function_exists( 'woocommerce_product_image_popup' ) ) {
	function woocommerce_product_image_popup() {
		?>
			<div class="lorada-product-enlarge-wrap">
				<a href="#" class="product-image-enlarge-btn"></a>
			</div>
		<?php
	}
}

if ( ! function_exists( 'woocommerce_product_360_view' ) ) {
	function woocommerce_product_360_view() {
		$gallery_images = woocommerce_product_360_view_gallery_ids();

		if ( empty( $gallery_images ) ) {
			return;
		}

		$id = rand( 100, 9999 );
		$threed_id = uniqid( 'product-threed-id-' . $id );

		$gallery_frame_count = count( $gallery_images );
		$images_js_content = '';

		?>
			<div class="lorada-product-360-view">
				<a href="#product-360-viewer" class="product-360-view-btn"></a>
			</div>
			<div id="product-360-viewer" class="product-360-viewer-wrap mfp-hide">
				<div id="<?php echo esc_attr( $threed_id ); ?>" class="lorada-threesixty-view">
					<ul class="threed-360-view-images">
						<?php
							if ( $gallery_frame_count > 0 ) {
								$i = 0;

								foreach ( (array) $gallery_images as $attachment_id => $attachment_url ) {
									$i++;

									$view_img = wp_get_attachment_image_src( $attachment_id, 'full' );

									$width = $view_img[1];
									$height = $view_img[2];
									$images_js_content .= "'" . $view_img[0] . "'";

									if ( $i < $gallery_frame_count ) {
										$images_js_content .= ",";
									}
								}
							}
						?>
					</ul>

					<div class="spinner">
						<span>0%</span>
					</div>
				</div>
			</div>
		<?php

		wp_add_inline_script( 'lorada-theme-scripts', 'jQuery(document).ready(function($) {
			$("#' . esc_attr( $threed_id ) . '").ThreeSixty({
				totalFrames: ' . esc_js( $gallery_frame_count ) . ',
				endFrame: ' . esc_js( $gallery_frame_count ) . ',
				currentFrame: 1,
				imgList: ".threed-360-view-images",
				progress: ".spinner",
				imgArray: ' . "[" . $images_js_content . "]" . ',
				height: ' . esc_js( $height ) . ',
				width: ' . esc_js( $width ) . ',
				responsive: true,
				navigation: true
			});
		});', 'after' );
	}
}

if ( ! function_exists( 'woocommerce_product_video_view' ) ) {
	function woocommerce_product_video_view() {
		$product_video_url = get_post_meta( get_the_ID(), '_lorada_product_video', true );

		if ( empty( $product_video_url ) ) {
			return;
		}

		?>
			<div class="lorada-product-video-view">
				<a href="<?php echo esc_url( $product_video_url ); ?>" class="product-video-view-btn"></a>
			</div>
		<?php
	}
}

/**
 * Woocommerce Product Additional Tab
 */
if ( ! function_exists( 'lorada_product_additional_tabs' ) ) {
	function lorada_product_additional_tabs( $tabs ) {
		$additional_tab_title = lorada_get_opt( 'additional_tab_title' );

		if ( ! empty( $additional_tab_title ) ) {
			$tabs['lorada_additional_tab'] = array(
				'title'		=>	$additional_tab_title,
				'priority'	=>	40,
				'callback'	=>	'lorada_additional_product_tab_content'
			);
		}

		$individual_additional_tab_title = get_post_meta( get_the_ID(), '_lorada_product_additional_tab_title', true );

		if ( ! empty( $individual_additional_tab_title ) ) {
			$tabs['lorada_individual_additional_tab'] = array(
				'title'		=>	$individual_additional_tab_title,
				'priority'	=>	40,
				'callback'	=>	'lorada_individual_additional_product_tab_content'
			);
		}

		return $tabs;
	}
}

if ( ! function_exists( 'lorada_additional_product_tab_content' ) ) {
	function lorada_additional_product_tab_content() {
		$additional_tab_content = lorada_get_opt( 'additional_tab_content' );

		if ( ! empty( $additional_tab_content ) ) {
			echo do_shortcode( $additional_tab_content );
		}
	}
}

if ( ! function_exists( 'lorada_individual_additional_product_tab_content' ) ) {
	function lorada_individual_additional_product_tab_content() {
		$additional_tab_content = get_post_meta( get_the_ID(), '_lorada_product_additional_tab_content',  true );

		if ( ! empty( $additional_tab_content ) ) {
			echo do_shortcode( $additional_tab_content );
		}
	}
}

/**
 * Product Widget Template
 */
if ( ! function_exists( 'lorada_product_widget_template' ) ) {
	function lorada_product_widget_template( $small_size = true, $products ) {
		global $product;

		echo '<ul class="product_list_widget">';
			foreach ( $products as $single_proudct ) {
				$product = $single_proudct;

				$template_args = array(
					'show_rating' => false,
				);

				if ( $small_size ) {
					wc_get_template( 'content-small-widget-product.php', $template_args );
				} else {
					wc_get_template( 'content-widget-product.php', $template_args );
				}
			}
		echo '</ul>';
	}
}

/**
 * Full Ajax Autocomplete Search
 */
if ( ! function_exists( 'lorada_autocomplete_ajax_suggestion' ) ) {
	function lorada_autocomplete_ajax_suggestion() {
		$allowed_post_types = array( 'post', 'product', 'portfolio' );
		$suggested_post_type = 'product';
		$suggestions = array();

		add_filter( 'posts_search', 'product_search_with_sku' );

		$query_args = array(
			'post_type'			=>	$suggested_post_type,
			'posts_per_page'	=>	15,
			'post_status'		=>	'publish',
			'no_found_rows'		=>	1
		);

		if ( ! empty( $_REQUEST['post_type'] ) && in_array( $_REQUEST['post_type'], $allowed_post_types ) ) {
			$suggested_post_type = strip_tags( $_REQUEST['post_type'] );
			$query_args['post_type'] = $suggested_post_type;
		}

		if ( ! empty( $_REQUEST['query'] ) ) {
			$query_args['s'] = sanitize_text_field( $_REQUEST['query'] );
		}

		if ( ! empty( $_REQUEST['viewNumber'] ) ) {
			$query_args['posts_per_page'] = (int) $_REQUEST['viewNumber'];
		}

		if ( 'product' == $suggested_post_type ) {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();

			$query_args['tax_query'][] = array(
				'taxonomy'	=>	'product_visibility',
				'field'		=>	'term_taxonomy_id',
				'terms'		=>	$product_visibility_term_ids['exclude-from-search'],
				'operator'	=>	'NOT IN'
			);

			if ( ! empty( $_REQUEST['product_cat'] ) ) {
				$query_args['product_cat'] = strip_tags($_REQUEST['product_cat']);
			}
		}

		$results = new WP_Query( $query_args );

		if ( $results->have_posts() ) {
			while ( $results->have_posts() ) :
				$results->the_post();

				if ( 'product' == $suggested_post_type ) {
					$product = new WC_Product( get_the_ID() );

					$suggestions[] = array(
						'value'		=>	get_the_title(),
						'thumbnail'	=>	$product->get_image(),
						'price'		=>	$product->get_price_html(),
						'permalink'	=>	get_the_permalink()
					);
				} else {
					$suggestions[] = array(
						'value'		=>	get_the_title(),
						'thumbnail'	=>	get_the_post_thumbnail( null, 'medium', '' ),
						'permalink'	=>	get_the_permalink()
					);
				}
			endwhile;

			wp_reset_postdata();
		} else {
			$value_text = esc_html__( 'No Products found', 'lorada' );

			if ( 'post' == $suggested_post_type ) {
				$value_text = esc_html__( 'No Posts found', 'lorada' );
			} else if ( 'portfolio' == $suggested_post_type ) {
				$value_text = esc_html__( 'No Portfolios found', 'lorada' );
			}

			$suggestions[] = array(
				'value'		=>	$value_text,
				'no_found'	=>	true,
				'permalink'	=>	''
			);
		}

		echo json_encode( array(
			'suggestions'	=>	$suggestions
		) );

		die();
	}
}

if ( ! function_exists( 'product_search_with_sku' ) ) {
	function product_search_with_sku( $where ) {
		if ( ! empty( $_REQUEST['query'] ) ) {
			$s = sanitize_text_field( $_REQUEST['query'] );
			return product_sku_query_search( $where, $s );
		}

		return $where;
	}
}

if ( ! function_exists( 'product_sku_query_search' ) ) {
	function product_sku_query_search( $where, $s ) {
		global $wpdb;

		$search_ids = array();
		$terms = explode( ',', $s );

		foreach ( $terms as $term ) {
			if ( is_admin() && is_numeric($term) ) {
				$search_ids[] = $term;
			}

			$sku_to_parent_id = $wpdb->get_col($wpdb->prepare("SELECT p.post_parent as post_id FROM {$wpdb->posts} as p join {$wpdb->postmeta} pm on p.ID = pm.post_id and pm.meta_key='_sku' and pm.meta_value LIKE '%%%s%%' where p.post_parent <> 0 group by p.post_parent", wc_clean($term)));

			$sku_to_id = $wpdb->get_col($wpdb->prepare("SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='_sku' AND meta_value LIKE '%%%s%%';", wc_clean($term)));

			$search_ids = array_merge( $search_ids, $sku_to_id, $sku_to_parent_id );
		}

		$search_ids = array_filter( array_map('absint', $search_ids) );

		if ( sizeof( $search_ids ) > 0 ) {
		    $where = str_replace( ')))', ") OR ({$wpdb->posts}.ID IN (" . implode(',', $search_ids) . "))))", $where );
		}

		return $where;
	}
}

/**
 * Output the view cart button.
 */
if ( ! function_exists( 'lorada_woocommerce_widget_shopping_cart_button_view_cart' ) ) {
	function lorada_woocommerce_widget_shopping_cart_button_view_cart() {
		echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="lorada-btn wc-forward">' . esc_html__( 'View cart', 'lorada' ) . '</a>';
	}
}

/**
 * Output the proceed to checkout button.
 */
if ( ! function_exists( 'lorada_woocommerce_widget_shopping_cart_proceed_to_checkout' ) ) {
	function lorada_woocommerce_widget_shopping_cart_proceed_to_checkout() {
		echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="lorada-btn checkout wc-forward">' . esc_html__( 'Checkout', 'lorada' ) . '</a>';
	}
}

/**
 * Empty Cart Text
 */
if ( ! function_exists( 'lorada_empty_cart_text' ) ) {
	function lorada_empty_cart_text() {
		$empty_cart_text = lorada_get_opt( 'empty_cart_text' );
		?>
			<span class="empty-cart-icon"><i class="lorada lorada-cart-empty"></i></span>
			<div class="lorada-empty-cart-txt">
				<?php echo wp_kses( $empty_cart_text, array(
					'p' 		=> array(),
					'h1' 		=> array(),
					'h2' 		=> array(),
					'h3' 		=> array(),
					'strong'	=> array(),
					'em' 		=> array(),
					'span' 		=> array(),
					'div' 		=> array(),
					'br' 		=> array()
				) ); ?>
			</div>
		<?php
	}
}

/**
 * Product Compare
 */
if ( ! function_exists( 'lorada_compare_btn_config' ) ) {

	add_action( 'init', 'lorada_compare_btn_config', 20 );

	function lorada_compare_btn_config() {
		global $yith_woocompare;

		if ( ! class_exists( 'YITH_Woocompare' ) ) {
			return;
		}

		$compare_obj = $yith_woocompare->obj;

		if ( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ) {
			remove_action( 'woocommerce_after_shop_loop_item', array( $compare_obj, 'add_compare_link' ), 20 );
		}
	}
}

if ( ! function_exists( 'lorada_add_compare_link' ) ) {
	function lorada_add_compare_link() {
		global $product;

		$product_id = $product->get_id();

		if ( ! class_exists( 'YITH_Woocompare' ) || ( get_option('yith_woocompare_compare_button_in_products_list') != 'yes' ) ) {
			return;
		}

		// return if product doesn't exist
		if ( empty( $product_id ) || apply_filters( 'yith_woocompare_remove_compare_link_by_cat', false, $product_id ) ) {
			return;
		}

		$is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

		if ( ! isset( $button_text ) || $button_text == 'default' ) {
		$button_text = get_option( 'yith_woocompare_button_text', __( 'Compare', 'lorada' ) );
		do_action ( 'wpml_register_single_string', 'Plugins', 'plugin_yit_compare_button_text', $button_text );
		$button_text = apply_filters( 'wpml_translate_single_string', $button_text, 'Plugins', 'plugin_yit_compare_button_text' );
		}

		printf( '<a href="%s" class="%s" data-product_id="%d" rel="nofollow"><span class="txt-label">%s</span></a>', lorada_add_product_url( $product_id ), 'content-product-btn compare' . ( $is_button == 'button' ? ' button' : '' ), $product_id, $button_text );
	}
}

if ( ! function_exists( 'lorada_add_product_url' ) ) {
	function lorada_add_product_url( $product_id ) {
		$action_add = 'yith-woocompare-add-product';

		$url_args = array(
			'action' => $action_add,
			'id' => $product_id
		);

		return apply_filters( 'yith_woocompare_remove_product_url', esc_url_raw( add_query_arg( $url_args, site_url() ) ), $action_add );
	}
}

if ( ! function_exists( 'lorada_custom_compare_style' ) ) {
	add_action( 'wp_print_styles', 'lorada_custom_compare_style', 200 );

	function lorada_custom_compare_style() {
		if ( ! class_exists( 'YITH_Woocompare' ) ) {
			return;
		}

		$view_action = 'yith-woocompare-view-table';

		if ( ( ! defined('DOING_AJAX') || ! DOING_AJAX ) && ( ! isset( $_REQUEST['action'] ) || $view_action != $_REQUEST['action'] ) ) {
			return;
		}

		wp_enqueue_style( 'lorada-theme-style' );
	}
}

/**
 * Sticky Product Add to Cart
 */
if ( ! function_exists( 'lorada_sticky_add_to_cart' ) ) {
	add_action( 'lorada_after_footer_content', 'lorada_sticky_add_to_cart', 30 );

	function lorada_sticky_add_to_cart() {
		$sticky_add_cart = lorada_get_opt( 'sticky_add_to_cart' );

		if ( ! is_singular( 'product' ) || ! $sticky_add_cart ) {
			return;
		}

		global $product;

		$post_thumbnail_id = $product->get_image_id();

		?>

		<div class="lorada-sticky-add-cart-wrap">
			<div class="sticky-cart-container">
				<div class="product-info">
					<div class="product-thumb-img">
						<?php echo wp_get_attachment_image( $post_thumbnail_id, 'thumbnail' ); ?>
					</div>

					<?php the_title( '<h6 class="product-title">', '</h6>' ); ?>
				</div>

				<div class="product-cart-form">
					<?php
						woocommerce_template_single_price();
						woocommerce_template_single_add_to_cart();
					?>
				</div>
			</div>
		</div>

		<?php
	}
}

/**
 * Quantity Form Buttons
 */
if ( ! function_exists( 'lorada_quantity_minus_btn' ) ) {
	function lorada_quantity_minus_btn() {
		echo '<span class="qty-btn minus-btn"><i class="lorada lorada-circle-minus"></i></span>';
	}
}

if ( ! function_exists( 'lorada_quantity_plus_btn' ) ) {
	function lorada_quantity_plus_btn() {
		echo '<span class="qty-btn plus-btn"><i class="lorada lorada-plus-circle"></i></span>';
	}
}

/**
 * Social Login Buttons
 */
if ( ! function_exists( 'lorada_social_login' ) ) {
	function lorada_social_login() {
		if ( class_exists( 'NextendSocialLogin' ) && ! empty( NextendSocialLogin::$enabledProviders ) ) {
			echo '<span class="login-separator">' . esc_html__( 'Or Login With', 'lorada' ) . '</span>';
			NextendSocialLogin::addLoginFormButtons();
		}
	}
}

/**
 * Custom My Account Avatar
 */
if ( ! function_exists( 'lorada_myaccount_customer_avatar' ) ) {
	 function lorada_myaccount_customer_avatar() {
	     $current_user = wp_get_current_user();
	     ?>
	     <div class="myaccount-profile">
	     	<div class="myaccount_avatar">
	     		<?php echo get_avatar( $current_user->user_email, 150, '', $current_user->display_name ); ?>
	     	</div>

	     	<span class="username"><?php echo $current_user->display_name; ?></span>
	     </div>
	     <?php
	 }
}

/**
 * WooCommerce Account Dropdown Links
 */
if ( ! function_exists( 'lorada_myaccount_links' ) ) {
	function lorada_myaccount_links() {
		?>
		<div class="lorada-myaccount-links">
			<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
				<div class="<?php echo esc_attr( $endpoint ); ?>-link-item">
					<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="item-link">
						<?php echo esc_html( $label ); ?>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}

/**
 * Custom WooCommerce Product Thumbnail Size
 */
if ( ! function_exists( 'lorada_product_thumbnail_size' ) ) {
	function lorada_product_thumbnail_size() {
		$cache_key = 'lorada-wc-thumb-size';
		$size = wp_cache_get( $cache_key, 'woocommerce' );

		if ( $size ) return $size;

		$size = array(
			'width'  => absint( wc_get_theme_support( 'gallery_thumbnail_image_width', 100 ) ),
			'height' => absint( wc_get_theme_support( 'gallery_thumbnail_image_width', 100 ) ),
			'crop'   => 1,
		);

		// Get woocommerce cropping size
		$cropping = get_option( 'woocommerce_thumbnail_cropping', '1:1' );

		if ( 'custom' === $cropping ) {
			$width = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_width', '4' ) );
			$height = max( 1, get_option( 'woocommerce_thumbnail_cropping_custom_height', '3' ) );
			$size['height'] = absint( round( ( $size['width'] / $width ) * $height ) );
			$size['crop']   = 1;
		}

		wp_cache_set( $cache_key, $size, 'woocommerce' );

		add_image_size( 'lorada_wc_gallery_thumb', $size['width'], $size['height'], $size['crop'] );
	}

	add_action( 'init', 'lorada_product_thumbnail_size', 20 );
}

/**
 * Custom Product Thumbnail Size
 */
if ( ! function_exists( 'lorada_wc_gallery_thumbnail_size' ) ) {
	function lorada_wc_gallery_thumbnail_size( $size ) {
		return 'lorada_wc_gallery_thumb';
	}
}
