<?php
/**
 * Header Elements Define Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Add theme favicon */
if ( ! function_exists( 'lorada_favicon' ) ) {
	function lorada_favicon() {
		if ( function_exists( 'wp_site_icon' ) && has_site_icon() ) :
			wp_site_icon();
		else:
			// Get Default favicon
			$favicon = LORADA_URI . '/favicon.png';
			// Get Default Retina favicon
			$fav_retina = LORADA_URI . '/images/favicon_retina.png';

			// Get Uploaded favicon
			$fav_uploaded = lorada_get_opt( 'favicon' );
			if ( isset( $fav_uploaded['url'] ) && '' != $fav_uploaded['url'] ) {
				$favicon = $fav_uploaded['url'];
			}
			// Get Uploaded Retina favicon
			$fav_retina_uploaded = lorada_get_opt( 'favicon_retina' );
			if ( isset( $fav_retina_uploaded['url'] ) && '' != $fav_retina_uploaded['url'] ) {
				$fav_retina = $fav_retina_uploaded['url'];
			}
			?>

			<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>">
			<link rel="apple-touch-icon-precomposed" sizes="160x160" href="<?php echo esc_url($fav_retina); ?>">

			<?php
		endif;
	}

	add_action( 'wp_head', 'lorada_favicon' );
}

/* Generate Header Blocks */
if ( ! function_exists( 'lorada_generate_header' ) ) {
	function lorada_generate_header( $header_layout ) {
		$header_config = lorada_get_header_config( $header_layout );
		lorada_config_divi( $header_config );
	}

	function lorada_config_divi( $configuration ) {
		foreach ( $configuration as $key => $block ) {
			lorada_generate_header_block( $key, $block );
		}
	}

	function lorada_generate_header_block( $key, $block ) {
		if ( is_array( $block ) ) {
			ob_start();
			lorada_config_divi( $block );
			$output = ob_get_contents();
			ob_end_clean();

			// Generate div block with $key class
			echo '<div class="' . esc_attr( $key ) . '">';
			if ( ! empty( $output ) ) {
				echo '' . $output;
			}
			echo '</div>';
		} else {
			$block_function = 'lorada_header_block_' . $block;

			if ( function_exists( $block_function ) ) {
				$block_function();
			}
		}
	}

	function lorada_get_header_config( $header_layout = 'header_default' ) {
		$header_config = array();

		$navigation_wrapper_class = 'navigation-wrapper';

		$header_config['header_default'] = array(
			'header-container' => array(
				'header-wrapper' => array(
					'header_mobile_nav',
					'logo',
					'header_widget',
					'right-column' => array(
						'account',
						'search',
						'wishlist',
						'cart'
					)
				)
			),
			$navigation_wrapper_class => array(
				'nav-container' => array(
					'navigation-inner' => array(
						'collection_menu',
						'main_nav_menu',
						'menu_extend_txt'
					)
				)
			)
		);

		$header_config['header_simple'] = array(
			'header-container' => array(
				'header-wrapper' => array(
					'header_mobile_nav',
					'logo',
					'main_nav_menu',
					'right-column' => array(
						'account',
						'search',
						'wishlist',
						'cart'
					)
				)
			)
		);

		$header_config['advanced_logo_center'] = array(
			'header-container' => array(
				'header-wrapper' => array(
					'header_mobile_nav',
					'header_widget',
					'logo',
					'right-column' => array(
						'account',
						'search',
						'wishlist',
						'cart'
					)
				)
			),
			$navigation_wrapper_class => array(
				'nav-container' => array(
					'navigation-inner' => array(
						'main_nav_menu'
					)
				)
			)
		);

		$header_config['left_menu_bar'] = array(
			'left-side-menu-inner' => array(
				'header-sidebar-wrapper' => array(
					'logo',
					'header_widget',
					'navigation-inner' => array(
						'main_nav_menu'
					),
					'header-icon-links' => array(
						'account',
						'search',
						'wishlist',
						'cart'
					),
					'header-multi-settings' => array(
						'multi_cur',
						'multi_lang'
					),
					'left-menu-footer' => array(
						'menu_extend_txt'
					)
				)
			)
		);

		if ( ! isset( $header_config[ $header_layout ] ) ) {
			$header_layout = 'header_default';
		}

		return $header_config[$header_layout];
	}
}

/* Header Blocks Functions */
if ( ! function_exists( 'lorada_header_block_logo' ) ) {
	function lorada_header_block_logo() {
		$logo = LORADA_URI . '/images/logo.png';
		$light_logo = LORADA_URI . '/images/light-logo.png';
		$sticky_logo = LORADA_URI . '/images/logo.png';

		$logo_uploaded = lorada_get_opt( 'logo' );
		$light_logo_uploaded = lorada_get_opt( 'light_logo' );
		$sticky_logo_uploaded = lorada_get_opt( 'alternative_logo' );

		if ( isset( $logo_uploaded['url'] ) && '' != $logo_uploaded['url'] ) {
			if ( is_ssl() ) {
				$logo = str_replace( 'http"//', 'https://', $logo_uploaded['url'] );
			} else {
				$logo = $logo_uploaded['url'];
			}
		}

		if ( isset( $light_logo_uploaded['url'] ) && '' != $light_logo_uploaded['url'] ) {
			if ( is_ssl() ) {
				$light_logo = str_replace( 'http"//', 'https://', $light_logo_uploaded['url'] );
			} else {
				$light_logo = $light_logo_uploaded['url'];
			}
		}

		if ( isset( $sticky_logo_uploaded['url'] ) && '' != $sticky_logo_uploaded['url'] ) {
			if ( is_ssl() ) {
				$sticky_logo = str_replace( 'http"//', 'https://', $sticky_logo_uploaded['url'] );
			} else {
				$sticky_logo = $sticky_logo_uploaded['url'];
			}
		}
		?>
		<div class="site-logo">
			<a href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
				<img class="normal-logo" src="<?php echo esc_url( $logo ); ?>" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				<img class="light-logo" src="<?php echo esc_url( $light_logo ); ?>" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>">

				<?php if ( isset( $sticky_logo ) && '' != $sticky_logo ) { ?>
				<img class="sticky-logo" src="<?php echo esc_url( $sticky_logo ); ?>" title="<?php bloginfo( 'description' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				<?php } ?>
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'lorada_header_block_header_widget' ) ) {
	function lorada_header_block_header_widget() {
		?>
		<div class="header-widget">
			<?php
				if ( is_active_sidebar( 'lorada-header-widget' ) ) {
					dynamic_sidebar( 'lorada-header-widget' );
				}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'lorada_header_block_search' ) ) {
	function lorada_header_block_search() {
		$search_widget_style = lorada_get_opt( 'search_widget_style' );
		$widget_style_class = 'search-form-' . $search_widget_style;
		$search_image_uploaded = lorada_get_opt( 'custom_search_icon' );
		$search_image = '';

		if ( 'disable' == $search_widget_style ) {
			return;
		}

		if ( isset( $search_image_uploaded['url'] ) && '' != $search_image_uploaded['url'] ) {
			$search_image = $search_image_uploaded['url'];
		}
		?>
		<div class="search-button <?php echo esc_attr( $widget_style_class ); ?>">
			<a href="#">
				<?php if ( '' != $search_image ) : ?>
					<img src="<?php echo esc_url( $search_image ); ?>">
				<?php else: ?>
					<i class="lorada lorada-magnifier"></i>
				<?php endif; ?>
			</a>

			<?php if ( 'full_screen' != $search_widget_style ) : ?>
				<div class="search-form-wrapper">
					<div class="form-inner">
						<?php
							lorada_header_block_search_form( array(
								'type'	=>	'dropdown',
								'count'	=>	10
							) );
						?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'lorada_header_block_search_opened' ) ) {
	function lorada_header_block_search_opened() {
		?>
		<div class="lorada-header-searchbox opened-searchbox">
			<?php lorada_header_block_search_form(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'lorada_header_block_search_form' ) ) {
	function lorada_header_block_search_form( $args = array() ) {
		$search_post_type = 'post';

		if ( ! empty( lorada_get_opt( 'search_post_type' ) ) ) {
			$search_post_type = lorada_get_opt( 'search_post_type' );
		}

		$args = wp_parse_args( $args, array(
			'post_type'			=>	$search_post_type,
			'show_collections'	=>	false,
			'ajax'				=>	lorada_get_opt( 'ajax_search' ),
			'type'				=>	'form',
			'thumbnail_img'		=>	true,
			'product_price'		=>	true,
			'count'				=>	15
		) );

		extract($args);

		$form_class = ''; $form_data = '';

		$ajax_args = array(
			'post_type'		=>	$post_type,
			'thumbnail'		=>	$thumbnail_img,
			'price'			=>	$product_price,
			'count'			=>	$count
		);

		if ( $ajax ) {
			foreach ( $ajax_args as $key => $value ) {
				$form_data .= ' data-' . $key . '="' . $value . '"';
			}

			$form_class .= 'lorada-ajax-search';
		}

		switch ( $post_type ) {
			case 'product':
				$input_placeholder = esc_attr__( 'Search for Products...', 'lorada' );
				break;
			case 'post':
				$input_placeholder = esc_attr__( 'Search for posts...', 'lorada' );
				break;
		}

		if ( $show_collections ) {
			$form_class .= ' show-category-dropdown';
		}

		?>
		<div class="lorada-search-form type-<?php echo esc_attr( $type ); ?>">
			<form method="get" role="search" class="searchform <?php echo esc_attr( $form_class ); ?>" action="<?php echo esc_url( home_url('/') ); ?>" <?php echo '' . $form_data; ?>>
				<div class="searchform-inner">
					<?php if( $show_collections && $post_type == 'product' ) lorada_show_categories_dropdown(); ?>
					<input type="text" name="s" placeholder="<?php echo '' . $input_placeholder; ?>" value="<?php echo get_search_query(); ?>" autocomplete="off">
					<input type="hidden" name="post_type" value="<?php echo esc_attr( $post_type ); ?>">
					<button type="submit" class="search-submit"><?php echo esc_html_x( 'Search', 'submit button', 'lorada' ); ?></button>
				</div>
			</form>

			<div class="search-result-container">
				<div class="lorada-search-result"></div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'lorada_header_block_multi_cur' ) ) {
	function lorada_header_block_multi_cur() {
		if ( ! lorada_get_opt( 'currency_topbar_view' ) ) {
			return;
		}
		?>
		<div class="currency-menu">
			<?php echo lorada_multi_currency_switcher(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'lorada_multi_currency_switcher' ) ) {
	function lorada_multi_currency_switcher() {
		if ( class_exists( 'woocommerce_wpml' ) && class_exists( 'WooCommerce' ) && class_exists( 'SitePress' ) ) {
			global $sitepress, $woocommerce_wpml;

			if( !isset($woocommerce_wpml->multi_currency) ){
				return;
			}

			$settings = $woocommerce_wpml->get_settings();
			$format = isset($settings['wcml_curr_template']) && $settings['wcml_curr_template'] != '' ? $settings['wcml_curr_template']:'%code%';
			$wc_currencies = get_woocommerce_currencies();

			if( !isset($settings['currencies_order']) ){
				$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
			} else {
				$currencies = $settings['currencies_order'];
			}

			$selected_html = '';
			foreach( $currencies as $currency ){
				if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
					$currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
													array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

					if( $currency == $woocommerce_wpml->multi_currency->get_client_currency() ){
						$selected_html = '<a href="javascript: void(0)" class="wcml_selected_currency">'.$currency_format.'</a>';
						break;
					}
				}
			}

			echo '<div class="wcml_currency_switcher currency-picker">';
				echo  '' . $selected_html;
				echo '<ul>';

				foreach( $currencies as $currency ){
					if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
						$currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
														array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
						echo '<li><a rel="' . $currency . '">' . $currency_format . '</a></li>';
					}
				}

				echo '</ul>';
			echo '</div>';
		} elseif ( class_exists( 'WOOCS' ) && class_exists( 'WooCommerce' ) ) {
			/* For WooCommerce Currency Switcher plugin */
			global $WOOCS;

			$currencies = $WOOCS->get_currencies();
			if( !is_array($currencies) ){
				return;
			}
			?>
			<div class="wcml_currency_switcher currency-picker">
				<a href="javascript: void(0)" class="wcml_selected_currency"><?php echo esc_html($WOOCS->current_currency); ?></a>
				<ul>
					<?php
					foreach( $currencies as $key => $currency ){
						$link = add_query_arg('currency', $currency['name']);
						echo '<li rel="'.$currency['name'].'"><a href="'.esc_url($link).'">'.esc_html($currency['name']).'</a></li>';
					}
					?>
				</ul>
			</div>
			<?php
		} else {
			/* Demo Content Html */
			?>
			<div class="wcml_currency_switcher currency-picker">
				<a href="javascript: void(0)" class="wcml_selected_currency">USD</a>
				<ul>
					<li rel="USD"><a href="#">USD</a></li>
					<li rel="EUR"><a href="#">EUR</a></li>
					<li rel="INR"><a href="#">INR</a></li>
					<li rel="GBP"><a href="#">GBP</a></li>
					<li rel="CAD"><a href="#">CAD</a></li>
					<li rel="AUD"><a href="#">AUD</a></li>
					<li rel="JPY"><a href="#">JPY</a></li>
				</ul>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'lorada_header_block_multi_lang' ) ) {
	function lorada_header_block_multi_lang() {
		if ( ! lorada_get_opt( 'language_topbar_view' ) ) {
			return;
		}
		?>
		<div class="language-menu">
			<?php echo lorada_multi_language_switcher(); ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'lorada_multi_language_switcher' ) ) {
	function lorada_multi_language_switcher() {
		$language_count = 1;
		$languages = array();

		if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
			$languages = icl_get_languages( 'skip_missing=1&orderby=code' );
			$language_count = count( $languages );
		}

		if ( $language_count > 1 ) {
			?>
			<div class="wcml_language_switcher language-picker">
				<?php
				foreach ( $languages as $l ) {
					if ( $l['active'] ) {
						?>
						<a href="javascript: void(0)" class="wcml_selected_language"><?php echo esc_html($l['translated_name']); ?></a>
						<?php
					}
				}
				?>

				<ul>
				<?php
				foreach ( $languages as $l ) {
					if ( ! $l['active'] ) {
						echo '<li><a href="' . esc_url( $l['url'] ) . '">' . esc_html( $l['translated_name'] ) . '</a></li>';
					}
				}
				?>
				</ul>
			</div>
			<?php
		} else {
			/* Demo Content Html */
			?>
			<div class="wcml_language_switcher language-picker">
				<a href="javascript: void(0)" class="wcml_selected_language">English</a>
				<ul>
					<li><a href="#">German</a></li>
					<li><a href="#">Dutch</a></li>
					<li><a href="#">French</a></li>
					<li><a href="#">Italian</a></li>
					<li><a href="#">Japanese</a></li>
					<li><a href="#">Russian</a></li>
					<li><a href="#">Spanish</a></li>
				</ul>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'lorada_show_categories_dropdown' ) ) {
	function lorada_show_categories_dropdown() {
		if ( ! lorada_get_opt( 'show_categories' ) ) {
			return;
		}

		$args = array(
			'hide_empty'	=>	1,
			'parent'		=>	0
		);

		$terms = get_terms( 'product_cat', $args );

		if ( ! empty( $terms ) ) {
			?>
			<div class="search-by-category dropdown-category">
				<div class="search-dropdown-category-inner">
					<input type="hidden" name="product_cat">
					<a href="#" data-val="0"><?php esc_html_e( 'All Categories', 'lorada' ); ?></a>
					<div class="category-list">
						<ul class="category-list-content">
							<li style="display: none;">
								<a href="#" data-val="0"><?php esc_html_e( 'All Categories', 'lorada' ); ?></a>
							</li>

							<?php
							if ( ! lorada_get_opt( 'show_subcategories' ) ) {
								foreach ( $terms as $term ) {
									?>
									<li><a href="#" data-val="<?php echo esc_attr( $term->slug ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
									<?php
								}
							} else {
								$args = array(
									'orderby'		=>	'id',
									'order'			=>	'ASC',
									'title_li'		=>	false,
									'taxonomy'		=>	'product_cat',
									'hide_empty'	=>	false,
									'walker'		=>	new Lorada_Custom_Category_Walker()
								);

								wp_list_categories( $args );
							}
							?>
						</ul>
					</div>
				</div>
			</div>
			<?php
		}
	}
}

class Lorada_Custom_Category_Walker extends Walker_Category {
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

		$link = '<a href="' . esc_url( get_term_link( $category ) ) . '" data-val="' . esc_attr( $category->slug ) . '" ';
		if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
			/**
			 * Filters the category description for display.
			 *
			 * @since 1.2.0
			 *
			 * @param string $description Category description.
			 * @param object $category    Category object.
			 */
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		}

		$link .= '>';
		$link .= $cat_name . '</a>';

		if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
			$link .= ' ';

			if ( empty( $args['feed_image'] ) ) {
				$link .= '(';
			}

			$link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';

			if ( empty( $args['feed'] ) ) {
				$alt = ' alt="' . sprintf(esc_html__( 'Feed for all posts filed under %s', 'lorada' ), $cat_name ) . '"';
			} else {
				$alt = ' alt="' . $args['feed'] . '"';
				$name = $args['feed'];
				$link .= empty( $args['title'] ) ? '' : $args['title'];
			}

			$link .= '>';

			if ( empty( $args['feed_image'] ) ) {
				$link .= $name;
			} else {
				$link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
			}
			$link .= '</a>';

			if ( empty( $args['feed_image'] ) ) {
				$link .= ')';
			}
		}

		if ( ! empty( $args['show_count'] ) ) {
			$link .= ' (' . number_format_i18n( $category->count ) . ')';
		}
		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$css_classes = array(
				'cat-item',
				'cat-item-' . $category->term_id,
			);

			if ( ! empty( $args['current_category'] ) ) {
				// 'current_category' can be an array, so we use `get_terms()`.
				$_current_terms = get_terms( $category->taxonomy, array(
					'include' => $args['current_category'],
					'hide_empty' => false,
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
			 * Filters the list of CSS classes to include with each category in the list.
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

if ( ! function_exists( 'lorada_header_block_wishlist' ) ) {
	function lorada_header_block_wishlist( $return = false ) {
		ob_start();

		$wishlist_icon = '';
		$wishlist_icon_uploaded = lorada_get_opt( 'custom_wishlist_icon' );

		if ( isset( $wishlist_icon_uploaded['url'] ) && '' != $wishlist_icon_uploaded['url'] ) {
			$wishlist_icon = $wishlist_icon_uploaded['url'];
		}

		if ( class_exists( 'YITH_WCWL' ) && ( lorada_get_opt( 'wishlist_header_view' ) ) || $return ) :
			?>
			<div class="header-wishlist">
				<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>" class="header-wishlist-inner">
					<?php if ( '' != $wishlist_icon ) : ?>
						<img src="<?php echo esc_url( $wishlist_icon ); ?>">
					<?php else: ?>
						<i class="lorada lorada-heart"></i>
						<span class="wishlist-title"><?php esc_html_e( 'Wishlist', 'lorada' ); ?></span>
					<?php endif; ?>
					<span class="wishlist-count"><?php echo yith_wcwl_count_products(); ?></span>
				</a>
			</div>
			<?php
		endif;

		$output = ob_get_clean();
		if ( $return ) return $output;

		echo '' . $output;
	}
}

if ( ! function_exists( 'lorada_header_block_cart' ) ) {
	function lorada_header_block_cart( $slug = 'main' ) {
		if ( ! class_exists('WooCommerce') ) {
			return;
		}

		$cart_icon = '';
		$view_position = lorada_get_opt( 'cart_view_popsition' );
		$icon_view = lorada_get_opt( 'shopping_cart_view' );
		$mini_cart_function = lorada_get_opt( 'shopping_mini_cart' );
		$cart_icon_uploaded = lorada_get_opt( 'custom_cart_icon' );

		if ( isset( $cart_icon_uploaded['url'] ) && '' != $cart_icon_uploaded['url'] ) {
			$cart_icon = $cart_icon_uploaded['url'];
		}

		$mini_cart_link = '#';
		$mini_cart_class = 'mini-cart';

		if ( isset ( $mini_cart_function ) && ! $mini_cart_function ) {
			$mini_cart_link = wc_get_cart_url();
			$mini_cart_class = 'simple-link-cart';
		}

		if ( $mini_cart_function ) {
			if ( 'side_view' == $view_position ) {
				$mini_cart_class .= ' mini-cart-side-bar';
			} else if ( 'dropdown' == $view_position ) {
				$mini_cart_class .= ' mini-cart-dropdown';
			}
		}

		if ( 'disable' != $icon_view ) : ?>

		<div id="header-shopping-cart-<?php echo esc_attr( $slug ) ?>" class="lorada-shopping-cart lorada-cart-view-<?php echo esc_attr( $icon_view ); ?> <?php echo esc_attr( $mini_cart_class ); ?>">
			<a href="<?php echo esc_url( $mini_cart_link ); ?>" class="cart-button">
				<?php if ( '' != $cart_icon ) : ?>
					<img src="<?php echo esc_url( $cart_icon ); ?>">
				<?php else: ?>
					<i class="lorada lorada-bag2"></i>
				<?php endif; ?>

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
			</a>

			<?php
			if ( isset ( $mini_cart_function ) && $mini_cart_function && 'side_view' != $view_position ) :

				$extra_class = '';
				if ( 1 > WC()->cart->cart_contents_count ) {
					$extra_class .= 'mini-box';
				} else if ( 2 > WC()->cart->cart_contents_count ) {
					$extra_class .= 'semi-mini-box';
				}

			?>

				<div class="mini-cart-container woocommerce <?php echo esc_attr( $extra_class ); ?>">
					<div class="widget_shopping_cart_content">
						<?php woocommerce_mini_cart(); ?>
					</div>
				</div>

			<?php endif; ?>
		</div>

		<?php
		endif;
	}
}

if ( ! function_exists( 'lorada_header_block_account' ) ) {
	function lorada_header_block_account() {
		if ( ! lorada_get_opt( 'account_header_view' ) ) return;

		$account_links = lorada_get_account_links();

		if ( ! empty( $account_links ) ) {
			?>
			<div class="header-account">
				<?php foreach ( $account_links as $key => $account_link ) : ?>
					<a href="<?php echo esc_url( $account_link['url'] ) ?>">
						<span class="account-label-icon"><?php echo '' . $account_link['label-icon']; ?></span>
					</a>
					<?php if ( ! empty( $account_link['dropdown-form'] ) ) {
						echo '' . $account_link['dropdown-form'];
					} ?>
				<?php endforeach; ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'lorada_get_account_links' ) ) {
	function lorada_get_account_links() {
		$account_links = array();
		$dashboard_url = '#';
		$icon_image_uploaded = lorada_get_opt( 'custom_account_icon' );

		if ( class_exists( 'WooCommerce' ) && false !== get_option('woocommerce_myaccount_page_id') ) {
			$dashboard_url = get_permalink( get_option('woocommerce_myaccount_page_id') );
		}

		if ( isset( $icon_image_uploaded['url'] ) && '' != $icon_image_uploaded['url'] ) {
			$icon_image = $icon_image_uploaded['url'];
			$label_icon = '<img src="' . esc_url( $icon_image ) . '">';
		} else {
			$label_icon = '<i class="lorada lorada-user"></i>';
		}

		if ( is_user_logged_in() ) {
			$account_links['my-account'] = array(
				'label-icon'	=>	$label_icon . '<span class="account-title logged-in-account">' . esc_html__( 'My Account', 'lorada' ) . '</span>',
				'url'			=>	$dashboard_url,
				'dropdown-form' =>	'<div class="account-menu-dropdown">' . lorada_get_account_menu() . '</div>'
			);
		} else {
			$account_links['register'] = array(
				'label-icon'	=>	'<span class="account-title">' . esc_html__( 'Login / Register', 'lorada' ) . '</span>',
				'url'			=>	$dashboard_url
			);

			if ( lorada_get_opt( 'login_dropdown' ) ) {
				$account_links['register']['dropdown-form'] = '
					<div class="account-form-dropdown">
						<div class="dropdown-form-inner">
							<h3 class="form-title">
								<span>' . esc_html__( 'Sign in', 'lorada' ) . '</span>
								<a href="' . esc_url( $dashboard_url ) . '">' . esc_html__( 'Create an Account', 'lorada' ) . '</a>
							</h3>
							' . lorada_login_form( false, $dashboard_url ) . '
						</div>
					</div>
				';
			}
		}

		return $account_links;
	}
}

if ( ! function_exists( 'lorada_header_block_header_mobile_nav' ) ) {
	function lorada_header_block_header_mobile_nav() {
		?>
		<div class="header-mobile-nav">
			<div class="mobile-nav-wrapper">
				<span class="hamburger-bars"></span>
				<span class="mobile-nav-label"><?php echo esc_html__( 'Menu', 'lorada' ); ?></span>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'lorada_header_block_collection_menu' ) ) {
	function lorada_header_block_collection_menu() {
		$collection_menu = lorada_get_opt( 'collection_menu' );

		if ( ! $collection_menu ) {
			return;
		}

		$menu_classes = array();

		$menu_title = lorada_get_opt( 'collection_menu_title' );
		$menu_title = ( ! empty( $menu_title ) ) ? $menu_title : 'All Department';

		$menu_hover = lorada_get_opt( 'menu_hover' );
		$menu_classes[] = ( isset( $menu_hover ) && ( '' != $menu_hover ) ) ? $menu_hover : 'default';

		if ( lorada_get_opt( 'collection_menu_collapse' ) ) $menu_classes[] = 'menu-collapse';

		$menu_classes = implode( ' ', $menu_classes );
		?>
			<div class="lorada-vertical-navigation header-collection-menu hover-style-<?php echo esc_attr( $menu_classes ); ?>">
				<div class="collection-menu-title">
					<span class="title-inner">
						<span class="hamburger-bars"></span>
						<?php echo esc_html( $menu_title ); ?>
					</span>
					<span class="menu-drop-icon"></span>
				</div>

				<div class="collection-menu-dropdown">
					<?php
						$walker = new LoradaWalker;

						wp_nav_menu( array(
							'menu'			=>	$collection_menu,
							'menu_class'	=>	'collection-menu-navigation lorada-menu-nav',
							'container'		=>	false,
							'walker'		=>	$walker
						) );
					?>
				</div>
			</div>
		<?php
	}
}

if ( ! function_exists( 'lorada_header_block_main_nav_menu' ) ) {
	function lorada_header_block_main_nav_menu() {
		if ( ! has_nav_menu( 'main-navigation' ) ) {
			return;
		}

		$menu_hover = lorada_get_opt( 'menu_hover' );
		$menu_hover_class = ( isset( $menu_hover ) && ( '' != $menu_hover ) ) ? $menu_hover : 'default';
		?>

		<nav class="main-navigation site-nav lorada-navigation hover-style-<?php echo esc_attr( $menu_hover_class ); ?>">
			<?php
				$walker = new LoradaWalker;

				wp_nav_menu( array(
					'theme_location'	=>	'main-navigation',
					'fallback_cb'		=>	false,
					'container'			=>	false,
					'items_wrap'		=>	'<ul id="%1$s" class="menu-main-navigation lorada-menu-nav">%3$s</ul>',
					'walker'			=>	$walker
				) );
			?>
		</nav>

		<?php
	}
}

if ( ! function_exists( 'lorada_header_block_menu_extend_txt' ) ) {
	function lorada_header_block_menu_extend_txt() {
		$extend_txt = lorada_get_opt( 'menu_extend_txt' );

		if ( empty( $extend_txt ) ) return;

		?>
		<div class="menu-extend-txt-widget">
			<?php echo do_shortcode( $extend_txt ); ?>
		</div>
		<?php
	}
}

/* Dropdown Login Form */
if ( ! function_exists( 'lorada_login_form' ) ) {
	function lorada_login_form( $echo = true, $action = false, $hidden = false, $message = false, $redirect = false ) {
		ob_start();
		?>

		<form class="woocommerce-form woocommerce-form-login login" method="post" <?php if ( $hidden ) echo 'style="display:none;"'; ?> <?php echo ( ! empty( $action ) ) ? 'action="' . esc_url( $action ) . '"' : ''; ?> autocomplete="on">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<?php echo isset( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

			<div class="login-form-close"><span><?php esc_html_e( 'Close', 'lorada' ); ?></span></div>

			<p class="form-row form-row-first">
				<label for="username"><?php _e( 'Username or email', 'lorada' ); ?> <span class="required">*</span></label>
				<input type="text" id="username" class="input-text" name="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" autocomplete="off" />
			</p>
			<p class="form-row form-row-last">
				<label for="password"><?php _e( 'Password', 'lorada' ); ?> <span class="required">*</span></label>
				<input id="password" class="input-text" type="password" name="password" autocomplete="off" />
			</p>
			<div class="clear"></div>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<?php if ( $redirect ): ?>
					<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
				<?php endif ?>
				<input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'lorada' ); ?>" />
			</p>

			<div class="login-form-footer">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="woocommerce-LostPassword lost_password"><?php esc_html_e( 'Lost your password?', 'lorada' ); ?></a>
				<label class="remember-me-label woocommerce-form__label woocommerce-form__label-for-checkbox remember-checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" value="forever" /> <?php esc_html_e( 'Remember me', 'lorada' ); ?>
				</label>
			</div>

			<?php if ( class_exists( 'NextendSocialLogin' ) && ! empty( NextendSocialLogin::$enabledProviders ) ) : ?>
				<span class="login-separator"><?php echo esc_html__( 'Or', 'lorada' ); ?></span>
				<?php NextendSocialLogin::addLoginFormButtons(); ?>
			<?php endif; ?>
		</form>

		<?php
		$output = ob_get_contents();
		ob_end_clean();

		if ( $echo ) {
			echo '' . $output;
		} else {
			return $output;
		}
	}
}

/* Sticky Header Clone */
if ( ! function_exists( 'lorada_sticky_header_clone' ) ) {
	function lorada_sticky_header_clone( $header = 'header_default' ) {
		$mobile_layout = lorada_get_opt( 'header_mobile_layout' );
		$mobile_layout = ( empty( $mobile_layout ) ) ? 'logo_center' : $mobile_layout;
		$sticky_header = ( empty( lorada_get_opt( 'sticky_header_setting' ) ) ) ? ' sticky-disabled' : '';
		$sticky_header_on_scroll = ( ! empty( lorada_get_opt( 'sticky_header_on_scroll' ) ) ) ? ' hide_sticky_scrolldown' : '';
		$header_layout = apply_filters( 'lorada_header_layout', lorada_get_opt( 'header_layout' ) );

		?>
		<div class="sticky-header-enable header-clone mobile-layout-<?php echo esc_attr( $mobile_layout ) ?> <?php echo esc_attr( $header ) . esc_attr( $sticky_header ) . esc_attr( $sticky_header_on_scroll ); ?>">
			<div class="header-container">
				<div class="header-clone-wrapper">
					<?php
						echo lorada_header_block_header_mobile_nav();
						echo lorada_header_block_logo();
					?>

					<div class="header-clone-menu-wrap">
						<?php echo lorada_header_block_main_nav_menu(); ?>
					</div>

					<div class="right-column">
						<?php
							echo lorada_header_block_account();
							echo lorada_header_block_search();
							echo lorada_header_block_wishlist();
							echo lorada_header_block_cart( 'sticky' );
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

/* Mobile Nav */
if ( ! function_exists( 'lorada_mobile_navigation' ) ) {
	function lorada_mobile_navigation() {
		$menu_locations = get_nav_menu_locations();
		$mobile_location = 'main-navigation';
		?>

		<div class="mobile-nav">
			<?php
			lorada_header_block_search_form();

			if ( lorada_get_opt( 'mobile_categories' ) ) {
				?>

				<div class="mobile-navigation-tab">
					<ul class="tab-wrapper">
						<li id="page-menu-nav" class="mobile-nav-title active">
							<span><?php echo esc_html__( 'Menu', 'lorada' ); ?></span>
						</li>

						<li id="category-menu-nav" class="mobile-nav-title">
							<span><?php echo esc_html__( 'Category', 'lorada' ); ?></span>
						</li>
					</ul>
				</div>

				<?php
				echo '<div class="mobile-navigation-tab-content mobile-category-menu">';
				$mobile_categories_menu = lorada_get_opt( 'mobile_category_menu' );

				if ( ! empty( $mobile_categories_menu ) ) {
					$walker = new LoradaWalker;
					wp_nav_menu( array(
						'menu'			=>	$mobile_categories_menu,
						'menu_class'	=>	'lorada-mobile-nav',
						'container'		=>	false,
						'walker'		=>	$walker
					) );
				} else {
					?>
					<span class="missed-category-menu">
						<?php esc_html_e( 'Choose your category menu in Lorada Theme Options -> Header -> Menu -> Mobile Category Menu.', 'lorada' ); ?>
					</span>
					<?php
				}

				echo '</div>';
			}

			if ( isset( $menu_locations['mobile-side-navigation'] ) && $menu_locations['mobile-side-navigation'] != 0 ) {
				$mobile_location = 'mobile-side-navigation';
			}

			if ( has_nav_menu( $mobile_location ) ) {
				echo '<div class="mobile-navigation-tab-content mobile-page-menu active">';

				$walker = new LoradaWalker;
				wp_nav_menu( array(
						'theme_location'	=>	$mobile_location,
						'menu_class'		=>	'lorada-mobile-nav',
						'container'			=>	false,
						'walker'			=>	$walker
				) );

				$share_type = lorada_get_opt('mobile_share_type');

				if ( class_exists( 'Lorada_Core_Main_Functions' ) ) {
					echo '<div class="mobile-nav-social">';

					echo Lorada_Core_Main_Functions::instance()->lorada_core_social_buttons( array(
						'type' => $share_type,
						'btn_size' => 'small',
						'btn_shape' => 'square',
						'btn_style' => 'colored'
					) );

					echo '</div>';
				}

				echo '</div>';
			}

			?>
		</div>

		<?php
	}
}

/* Mobile Additional Nav Items */
if ( ! function_exists( 'lorada_mobile_addi_items' ) ) {
	add_filter( 'wp_nav_menu_items', 'lorada_mobile_addi_items', 10, 2 );

	function lorada_mobile_addi_items( $items, $args ) {
		$wishlist_item = $account_item = '';

		if ( class_exists( 'YITH_WCWL' ) ) {
			$wishlist_item = '<li class="menu-item item-level-0 menu-item-my-account">';
			$wishlist_item .= '<a href="' . YITH_WCWL()->get_wishlist_url() . '"><i class="lorada lorada-heart"></i>' . esc_html__( 'Wishlist', 'lorada' ) . '</a>';
			$wishlist_item .= '</li>';
		}

		if ( class_exists( 'WooCommerce' ) && false !== get_option('woocommerce_myaccount_page_id') ) {
			$dashboard_url = get_permalink( get_option('woocommerce_myaccount_page_id') );

			$account_item = '<li class="menu-item item-level-0 menu-item-my-account">';
			$account_item .= '<a href="' . esc_url( $dashboard_url ) . '"><i class="lorada lorada-user"></i>' . esc_html__( 'My Account', 'lorada' ) . '</a>';
			$account_item .= '</li>';
		}

		if ( $args->theme_location == 'mobile-side-navigation' ) {
			$items .= $wishlist_item;
			$items .= $account_item;
		}

		return $items;
	}
}

/* My Account Menu */
if ( ! function_exists( 'lorada_get_account_menu' ) ) {
	function lorada_get_account_menu() {
		$user_info = get_userdata( get_current_user_id() );

		$html = '<ul class="sub-menu">';
		foreach ( wc_get_account_menu_items() as $key => $label ) {
            $html .= '<li class="' . wc_get_account_menu_item_classes( $key ) . '"><a href="' . esc_url( wc_get_account_endpoint_url( $key ) ) . '"><span>' . esc_html( $label ) . '</span></a></li>';
        }
		$html .= '</ul>';

		return $html;
	}
}

if ( ! function_exists( 'lorada_my_account_nav' ) ) {
	function lorada_my_account_nav( $items ) {
		$user_info = get_userdata( get_current_user_id() );
		$user_roles = $user_info && property_exists( $user_info, 'roles' ) ? $user_info->roles : array();

		unset( $items['customer-logout'] );

		if ( class_exists( 'WeDevs_Dokan' ) && ( in_array( 'seller', $user_roles ) || in_array( 'administrator', $user_roles ) ) ) {
			$items['dokan'] = esc_html__( 'Vendor Dashboard', 'lorada' );
		}

		$items['customer-logout'] = esc_html__( 'Logout', 'lorada' );

		return $items;
	}

	add_filter( 'woocommerce_account_menu_items', 'lorada_my_account_nav', 15 );
}

if ( ! function_exists( 'lorada_my_account_nav_endpoint_url' ) ) {
	function lorada_my_account_nav_endpoint_url( $url, $endpoint, $value, $permalink ) {
		if ( 'dokan' === $endpoint && class_exists( 'WeDevs_Dokan' ) ) {
			$url = dokan_get_navigation_url();
		}

		return $url;
	}

	add_filter( 'woocommerce_get_endpoint_url', 'lorada_my_account_nav_endpoint_url', 15, 4 );
}

/* Bottom Promotion Bar */
if ( ! function_exists( 'lorada_header_bottom_promo_bar' ) ) {
	function lorada_header_bottom_promo_bar() {
		$output = '';
		$header_overlap = lorada_get_opt( 'header_overlap' );
		$promo = lorada_get_opt( 'header_bottom_promo' );
		$promo_content = lorada_get_opt( 'header_promo_content' );

		if ( empty( $promo ) || false == $promo || empty( $promo_content ) || $header_overlap ) return;

		ob_start();
		?>
		<div class="header-promo-bar">
			<?php
			if ( class_exists( 'Lorada_Core_Main_Functions' ) ) {
				echo Lorada_Core_Main_Functions::instance()->lorada_core_html_block( array( 'block_id' => $promo_content ) );
			}
			?>
		</div>
		<?php

		$output = ob_get_clean();
		return $output;
	}
}
