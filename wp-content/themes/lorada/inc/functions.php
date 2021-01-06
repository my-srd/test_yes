<?php
/**
 * Lorada Included Functions
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Custom Body Classes */
if ( ! function_exists( 'lorada_custom_body_classes' ) ) {
	function lorada_custom_body_classes( $classes ) {
		$current_header_layout = lorada_get_opt( 'header_layout', 'header-layout-1' );
		$site_skin = lorada_get_opt( 'skin_mode', 'light' );

		if ( 'left_menu_bar' == $current_header_layout ) {
			$classes[] = 'left_menu_bar_header';
		}

		$classes[] = 'site-' . $site_skin . '-mode';

		if ( lorada_get_opt( 'sticky_mob_toolbar' ) ) {
			$classes[] = 'sticky-toolbar-on';
		}

		if ( lorada_get_opt( 'mobile_toolbar_txt' ) ) {
			$classes[] = 'sticky-toolbar-label-on';
		}

		return $classes;
	}
}
add_filter( 'body_class','lorada_custom_body_classes' );

/* Add WP admin custom CSS & JS */
if ( ! function_exists( 'lorada_admin_style' ) ) {
	function lorada_admin_style() {
		$theme_version = lorada_theme_version();
		$suffix = WP_DEBUG ? '' : '.min';

		wp_enqueue_style( 'font-awesome', LORADA_URI . '/inc/fonts/font-awesome/css/all.min.css', NULL, '5.7.0', 'all' );
		wp_enqueue_style( 'jquery-ui', LORADA_URI . '/css/admin/jquery-ui.min.css', NULL, '1.12.1', 'all' );
		wp_enqueue_style( 'lorada-admin-style', LORADA_URI . '/css/admin/admin' . $suffix . '.css', false, $theme_version, 'all' );
	}
}
add_action( 'admin_enqueue_scripts', 'lorada_admin_style' );

if ( ! function_exists( 'lorada_admin_script' ) ) {
	function lorada_admin_script() {
		$theme_version = lorada_theme_version();
		$suffix = WP_DEBUG ? '' : '.min';

		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'lorada-admin-script', LORADA_URI . '/js/admin' . $suffix . '.js', array( 'jquery' ), false );
	}
}
add_action( 'admin_enqueue_scripts', 'lorada_admin_script' );

/* Add WP front-end custom CSS & JS */
if ( ! function_exists( 'lorada_style' ) ) {
	function lorada_style() {
		$theme_version = lorada_theme_version();
		$suffix = WP_DEBUG ? '' : '.min';

		if ( ! class_exists( 'ReduxFramework' ) ) {
			wp_enqueue_style( 'lorada-default-google-fonts', lorada_default_google_fonts(), array(), $theme_version, 'all' );
		}

		wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css', NULL, '1.11.2', 'all' );
		wp_enqueue_style( 'lorada-font-awesome', LORADA_URI . '/inc/fonts/font-awesome/css/all.min.css', NULL, '5.7.0', 'all' );
		wp_enqueue_style( 'bootstrap-style', LORADA_URI . '/css/bootstrap' . $suffix . '.css', array(), '4.0.0', 'all' );

		if ( is_multisite() ) {
			$blog_id = get_current_blog_id();
			wp_enqueue_style( 'lorada-theme-style', LORADA_URI . '/css/theme' . $blog_id . '.css', array(), $theme_version, 'all' );
		} else {
			wp_enqueue_style( 'lorada-theme-style', LORADA_URI . '/css/theme.css', array(), $theme_version, 'all' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'lorada_style' );

if ( ! function_exists( 'lorada_script' ) ) {
	function lorada_script() {
		$theme_version = lorada_theme_version();
		$suffix = WP_DEBUG ? '' : '.min';
		$google_map_api_key = lorada_get_opt( 'google_map_api_key', '' );

		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'zoom' );
		wp_enqueue_script( 'popper-script', LORADA_URI . '/js/popper.min.js', array( 'jquery' ), '1.14.7', true );
		wp_enqueue_script( 'bootstrap-script', LORADA_URI . '/js/bootstrap' . $suffix . '.js', array( 'jquery' ), '4.0', true );
		wp_enqueue_script( 'lodash-script', LORADA_URI . '/js/lodash.min.js', array('jquery'), '2.4.1', true );
		wp_enqueue_script( 'jquery-magnific', LORADA_URI . '/js/jquery.magnific-popup' . $suffix . '.js', array('jquery'), '1.1.0', true );
		wp_enqueue_script( 'jquery-sticky-kit', LORADA_URI . '/js/jquery.sticky-kit.js', array('jquery'), '1.1.3', true );
		wp_enqueue_script( 'jquery-autocomplete', LORADA_URI . '/js/jquery.autocomplete' . $suffix . '.js', array('jquery'), '1.4.8', true );
		wp_enqueue_script( 'owl-carousel', LORADA_URI . '/js/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.3.4', true );
		wp_enqueue_script( 'nice-select', LORADA_URI . '/js/jquery.nice-select' . $suffix . '.js', array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'jquery-mousewheel', LORADA_URI . '/js/jquery.mousewheel' . $suffix . '.js', array('jquery'), '3.1.13', true );
		wp_enqueue_script( 'slick-script', LORADA_URI . '/js/slick.min.js', array('jquery'), '1.6.0', true );
		wp_enqueue_script( 'parallax-script', LORADA_URI . '/js/parallax' . $suffix . '.js', array('jquery'), '1.5.0', true );
		wp_enqueue_script( 'threesixty-script', LORADA_URI . '/js/threesixty.min.js', array('jquery', 'jquery-cookie'), '2.0.5', true );
		wp_enqueue_script( 'jquery-easing', LORADA_URI . '/js/jquery.easings.min.js', array('jquery'), '1.9.2', true );
		wp_enqueue_script( 'moment-script', LORADA_URI . '/js/moment.min.js', array('jquery'), '2.22.1', true );
		wp_enqueue_script( 'moment-timezone-data-script', LORADA_URI . '/js/moment-timezone-with-data.min.js', array('jquery'), '0.5.17', true );
		wp_enqueue_script( 'swiper-script', LORADA_URI . '/js/swiper' . $suffix . '.js', array('jquery'), '4.3.3', true );
		wp_enqueue_script( 'velocity-effect-script', LORADA_URI . '/js/velocity.min.js', array('jquery'), '1.5.0', true );
		wp_enqueue_script( 'jquery-countdown', LORADA_URI . '/js/jquery.countdown' . $suffix . '.js', array('jquery', 'jquery-cookie'), '2.22.0', true );
		wp_enqueue_script( 'jquery-pjax', LORADA_URI . '/js/jquery.pjax.js', array( 'jquery', 'jquery-cookie' ), $theme_version, true );
		wp_enqueue_script( 'isotope-script', LORADA_URI . '/js/isotope.pkgd' . $suffix . '.js', array( 'jquery' ), '3.0.6', true );
		wp_enqueue_script( 'packery-script', LORADA_URI . '/js/packery-mode.pkgd' . $suffix . '.js', array('jquery'), '2.0.1', true );
		wp_enqueue_script( 'jquery-adaptive', LORADA_URI . '/js/jquery.adaptive-backgrounds.js', array('jquery'), $theme_version, true );
		wp_enqueue_script( 'jquery-counterup', LORADA_URI . '/js/jquery.counterup.min.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'bootstrap-notify', LORADA_URI . '/js/bootstrap-notify' . $suffix . '.js', array('jquery'), '3.1.5', true );
		wp_enqueue_script( 'google-maps', '//maps.googleapis.com/maps/api/js?key=' . $google_map_api_key , array(), false, true );
		wp_enqueue_script( 'gmap3', LORADA_URI . '/js/gmap3.min.js', array(), false, true );

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'lorada-theme-scripts', LORADA_URI . '/js/theme-scripts' . $suffix . '.js', array( 'jquery' ), $theme_version, true );
		wp_enqueue_script( 'wc-add-to-cart-variation' );

		$rtl = false;
		if ( is_rtl() ) $rtl = true;

		$promo = lorada_get_opt( 'enable_promo_popup' );

		wp_localize_script( 'lorada-theme-scripts', 'js_lorada_vars', array(
			'ajax_url'						=>	admin_url( 'admin-ajax.php' ),
			'timer_days'					=>	esc_html__( 'Days', 'lorada' ),
			'timer_hours'					=>	esc_html__( 'Hours', 'lorada' ),
			'timer_mins'					=>	esc_html__( 'Min', 'lorada' ),
			'timer_sec'						=>	esc_html__( 'Sec', 'lorada' ),
			'product_ajax_cart'				=>	lorada_get_opt('ajax_add_to_cart'),
			'shopping_mini_cart'			=>	lorada_get_opt('shopping_mini_cart'),
			'view_cart_after_added'			=>	lorada_get_opt('view_cart_after_added'),
			'product_carousel_auto_height'	=>	lorada_get_opt('main_slider_auto_height'),
			'product_thumb_position'		=>	lorada_get_opt('thumbnail_position'),
			'product_img_zoom'				=>	( 'zoom' == lorada_get_opt('image_action') ) ? 'true' : 'false',
			'product_img_action'			=>	lorada_get_opt('image_action'),
			'upsells_product_column'		=>	lorada_get_opt('upsell_products_columns'),
			'related_product_column'		=>	lorada_get_opt('related_products_columns'),
			'view_all_results'				=>	esc_html__( 'View all results', 'lorada' ),
			'cookies_law_version'			=>	lorada_get_opt( 'cookies_version' ),
			'promo_popup_enable'			=>	$promo,
			'promo_popup_condition'			=>	lorada_get_opt( 'popup_condition' ),
			'promo_popup_delay'				=>	lorada_get_opt( 'popup_delay_time' ),
			'promo_popup_scroll'			=>	lorada_get_opt( 'popup_page_scroll' ),
			'promo_popup_page_num'			=>	lorada_get_opt( 'change_page_num' ),
			'promo_popup_version'			=>	lorada_get_opt( 'promo_version' ),
			'promo_popup_mobile'			=>	lorada_get_opt( 'hide_promo_popup_mobile' ),
			'rtl'							=>	$rtl
		) );

		if ( ! empty( lorada_get_opt( 'custom_js' ) ) ) {
			wp_add_inline_script( 'lorada-theme-scripts', lorada_get_opt( 'custom_js' ), 'after' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'lorada_script' );

/* Default google fonts */
if ( ! function_exists( 'lorada_default_google_fonts' ) ) {
	function lorada_default_google_fonts() {
		$fonts_url = '';
		$default_google_fonts = 'Playfair+Display:400,400i,700,700i,900|Poppins:100,200,300,400,400i,500,600,600i,700,700i,800,900';

		$query_args = array(
			'family'	=>	$default_google_fonts
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

		return esc_url_raw( $fonts_url );
	}
}

/* Get current page ID */
if ( ! function_exists( 'lorada_get_page_id' ) ) {
	function lorada_get_page_id() {
		global $post, $product;

		$page_id = 0;

		$page_for_posts    = get_option( 'page_for_posts' );
		$page_for_shop     = get_option( 'woocommerce_shop_page_id' );

		if ( isset( $post->ID ) ) {
			$page_id = $post->ID;
		}

		if ( lorada_is_blog_archive() ) {
			$page_id = $page_for_posts;
		}

		if ( function_exists( 'lorada_is_shop_archive' ) && lorada_is_shop_archive() ) {
			$page_id = $page_for_shop;
		}

		if ( is_singular( 'product' ) ) {
			$page_id = $product->get_id();
		}

		return $page_id;
	}
}

/* Return bool by checking if current page is blog page */
if( ! function_exists( 'lorada_is_blog_archive' ) ) {
	function lorada_is_blog_archive() {
		return ( is_home() || is_search() || is_tag() || is_category() || is_date() || is_author() );
	}
}

/* Generate Header Class */
if ( ! function_exists( 'lorada_header_classes' ) ) {
	function lorada_header_classes( $header ) {
		global $post;

		$page_id = 0;
		$page_for_posts = get_option( 'page_for_posts' );
		$page_for_shop = get_option( 'woocommerce_shop_page_id' );

		if ( isset( $post->ID ) ) {
			$page_id = $post->ID;
		}

		if ( is_home() ) {
			$page_id = $page_for_posts;
		}

		if ( function_exists( 'lorada_is_shop_archive' ) && lorada_is_shop_archive() ) {
			$page_id = $page_for_shop;
		}

		$nav_menu_scheme = get_post_meta( $page_id, '_lorada_header_color_scheme', true );

		$header_class = 'main-header';
		$header_class .= ' ' . $header;
		$header_width_style = lorada_get_opt( 'header_width_style' );
		$header_overlap = false;
		$header_bottom = false;
		$mobile_layout = lorada_get_opt( 'header_mobile_layout' );
		$mobile_layout = ( empty( $mobile_layout ) ) ? 'logo_center' : $mobile_layout;

		if ( 'full' == $header_width_style ) {
			$header_class .= ' header-full-width';
		} else {
			$header_class .= ' header-boxed-width';
		}

		$available_layouts = array( 'header_simple', 'advanced_logo_center' );

		if ( lorada_get_opt( 'header_bottom_line' ) && in_array( $header, $available_layouts ) ) {
			$header_bottom = true;
		}

		if ( ! empty( $nav_menu_scheme ) ) {
			$header_class .= ' header-color-scheme-' . $nav_menu_scheme;
		}

		$header_class .= ( $header_bottom ) ? ' header-bottom-enable' : '';
		$header_class .= ' mobile-layout-' . $mobile_layout;

		echo 'class="' . esc_attr( $header_class ) . '"';
	}
}

/* Generate Page Class */
if ( ! function_exists( 'lorada_page_classes' ) ) {
	function lorada_page_classes() {
		$classes = array();

		$site_layout 			= lorada_get_opt( 'site_layout' );
		$header_layout 			= lorada_get_opt( 'header_layout' );
		$border_boxed			= lorada_get_opt( 'border_shadow' );
		$shop_ajax_filter     	= lorada_get_opt( 'shop_ajax_filter' );
		$hide_sidebar_desktop 	= lorada_get_opt( 'shop_hide_sidebar_desktop' );
		$header_overlap  		= lorada_get_opt( 'header_overlap' );
		$page_template 			= basename( get_page_template() );

		$classes[] = 'lorada-page-content';
		$classes[] = $header_layout . '_header';

		if ( ! empty( $site_layout ) && 'boxed' == $site_layout ) {
			$classes[] = 'page-boxed-layout container';

			if ( $border_boxed ) {
				$classes[] = 'border-boxed';
			}
		} else if ( is_singular( 'post' ) && ( 'backstretch' == lorada_get_opt( 'post_view_style' ) ) ) {
			$classes[] = 'page-boxed-layout container border-boxed';
		} else {
			$classes[] = 'page-full-layout';
		}

		if ( $shop_ajax_filter ) {
			$classes[] = 'lorada-ajax-shop-on';
		}

		if ( $hide_sidebar_desktop ) {
			$classes[] = 'offcanvas-sidebar-desktop';
		}

		if ( $header_overlap && ! in_array( $header_layout, array( 'header_default', 'left_menu_bar' ) ) ) {
			$classes[] = 'lorada-header-overlap';
		}

		if ( 'portfolio.php' == $page_template ) {
			$classes[] = 'lorada-header-overlap';
		}

		echo 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
	}
}

/* Return CSS classes for page main content area */
if ( ! function_exists( 'lorada_get_content_class' ) ) {
	function lorada_get_content_class() {
		$content_class  = '';
		$cl             = 'col-lg-';
		$page_id        = lorada_get_page_id();
		$sidebar_size   = 3;
		$content_size   = 9;
		$layout         = 'sidebar-right';

		if ( function_exists( 'lorada_is_shop_archive' ) && lorada_is_shop_archive() ) {
			$opt_shop_layout = array( 'cat-shop', 'no-sidebar', 'full-width' );
			$sidebar_size = intval( lorada_get_opt( 'shop_sidebar_width' ) );
			$layout = lorada_get_opt( 'shop_layout' );
		} else if ( function_exists( 'lorada_is_blog_archive' ) && lorada_is_blog_archive() ) {
			$opt_blog_layout = array( 'with-sidebar' );
			$sidebar_size = intval( lorada_get_opt( 'blog_sidebar_width' ) );
			$layout       = lorada_get_opt( 'blog_layout' );
		} else if ( is_singular( 'post' ) ) {
			$sidebar_size = intval( lorada_get_opt( 'single_post_sidebar_width' ) );
			$layout = lorada_get_opt( 'single_post_sidebar' );
		} else if ( is_singular( 'product' ) ) {
			$sidebar_size = intval( lorada_get_opt( 'product_sidebar_width' ) );
			$layout = lorada_get_opt( 'product_sidebar_layout' );
		} else if ( is_page() ) {
			$sidebar_size = intval( lorada_get_opt( 'page_sidebar_width' ) );
			$layout = lorada_get_opt( 'page_sidebar' );
		}

		if ( 'full-width' == $layout || is_singular( 'elementor_library' ) ) {
			$sidebar_size = 0;
			$content_size = 12;
		}

		$content_size  = 12 - $sidebar_size;
		$content_class = $cl . $content_size;

        if ( is_singular( 'post' ) && ( 0 != $sidebar_size ) ) {
			$content_class = 'col-lg-' . ($content_size - 1) . ' ' . 'col-md-12';
		}

		if ( 'sidebar-left' == $layout ) {
			$content_class .= ' order-lg-2';
		}

		return $content_class;
	}
}

/* Return the sidebar name of current page */
if ( ! function_exists( 'lorada_get_sidebar_name' ) ) {
	function lorada_get_sidebar_name() {
		$specific = '';
		$page_id = lorada_get_page_id();
		$sidebar_name = '';

		if ( function_exists( 'lorada_is_shop_archive' ) && lorada_is_shop_archive() ) {
			$sidebar_name = 'lorada-shop-sidebar';
		} else if ( is_singular( 'product' ) ) {
			$sidebar_name = 'lorada-single-product-sidebar';
		} else if ( is_singular( 'post' ) ) {
			$sidebar_name = 'lorada-post-sidebar';
		} elseif ( lorada_is_blog_archive() ) {
			$sidebar_name = 'lorada-blog-sidebar';
		}

		if ( 0 != $page_id ) {
			$specific = get_post_meta( $page_id, '_lorada_custom_sidebar', true );
		}

		if ( '' != $specific && 'none' != $specific ) {
			$sidebar_name = $specific;
		}

		return $sidebar_name;
	}
}

/* Return CSS classes for page Sidebar container */
if ( ! function_exists( 'lorada_get_sidebar_class' ) ) {
	function lorada_get_sidebar_class() {
		$sidebar_class  = '';
		$cl             = 'col-lg-';
		$page_id        = lorada_get_page_id();
		$sidebar_size   = 3;
		$content_size   = 9;
		$layout         = 'sidebar-right';

		if ( function_exists( 'lorada_is_shop_archive' ) && lorada_is_shop_archive() ) {
			$opt_shop_layout = array( 'cat-shop', 'no-sidebar', 'full-width' );
			$sidebar_size = intval( lorada_get_opt( 'shop_sidebar_width' ) );
			$layout = lorada_get_opt( 'shop_layout' );
		} else if ( function_exists( 'lorada_is_blog_archive' ) && lorada_is_blog_archive() ) {
			$opt_blog_layout = array( 'with-sidebar' );
			$sidebar_size = intval( lorada_get_opt( 'blog_sidebar_width' ) );
			$layout       = lorada_get_opt( 'blog_layout' );
		} else if ( is_singular( 'post' ) ) {
			$sidebar_size = intval( lorada_get_opt( 'single_post_sidebar_width' ) );
			$layout = lorada_get_opt( 'single_post_sidebar' );
		} else if ( is_singular( 'product' ) ) {
			$sidebar_size = intval( lorada_get_opt( 'product_sidebar_width' ) );
			$layout = lorada_get_opt( 'product_sidebar_layout' );
		} else if ( is_page() ) {
			$sidebar_size = intval( lorada_get_opt( 'page_sidebar_width' ) );
			$layout = lorada_get_opt( 'page_sidebar' );
		} else if ( is_404() || is_singular( 'html_block' ) || is_singular( 'elementor_library' ) ) {
			$sidebar_size = 0;
			$layout = 'full-width';
		}

		$content_size   = 12 - $sidebar_size;

		if ( 'full-width' == $layout ) {
			$sidebar_size = 0;
			$content_size = 12;
		}

		$sidebar_class = $cl . $sidebar_size;

		if ( 'sidebar-left' == $layout ) {
			$sidebar_class .= ' order-lg-1';
		}

		$sidebar_class .= ' ' . $layout;

		return $sidebar_class;
	}
}

/* Configurate Footer Layouts */
if ( ! function_exists( 'lorada_footer_configuration' ) ) {
	function lorada_footer_configuration( $layout = 'footer_four_col' ) {
		$layout_config = apply_filters( 'lorada_footer_layout_config', array(
			'footer_one_col'		=>	array(
				'column'			=>	array(
					'col-lg-12 col-md-12'
				)
			),

			'footer_two_col'		=>	array(
				'column'			=>	array(
					'col-lg-6 col-md-6',
					'col-lg-6 col-md-6'
				)
			),

			'footer_three_col'		=>	array(
				'column'			=>	array(
					'col-lg-4 col-md-4',
					'col-lg-4 col-md-4',
					'col-lg-4 col-md-4'
				)
			),

			'footer_four_col'		=>	array(
				'column'			=>	array(
					'col-lg-3 col-md-6',
					'col-lg-3 col-md-6',
					'col-lg-3 col-md-6',
					'col-lg-3 col-md-6'
				)
			),

			'footer_five_col'		=>	array(
				'column'			=>	array(
					'col-lg-3 col-md-6',
					'col-lg-3 col-md-6',
					'col-lg-2 col-md-4',
					'col-lg-2 col-md-4',
					'col-lg-2 col-md-4'
				)
			),

			'footer_six_col'	=>	array(
				'column'		=>	array(
					'col-lg-2 col-md-4',
					'col-lg-2 col-md-4',
					'col-lg-2 col-md-4',
					'col-lg-2 col-md-4',
					'col-lg-2 col-md-4',
					'col-lg-2 col-md-4'
				)
			)
		) );

		return ( isset( $layout_config[$layout] ) ) ? $layout_config[$layout] : array();
	}
}

/* Lorada Sidebar Mini Cart */
if ( ! function_exists( 'lorada_sidebar_mini_cart' ) ) {
	add_action( 'lorada_after_footer_content', 'lorada_sidebar_mini_cart', 10 );

	function lorada_sidebar_mini_cart() {
		$toolbar_items = lorada_get_opt( 'sticky_toolbar_items' );

		if ( isset( $toolbar_items['enabled']['placebo'] ) ) {
			unset( $toolbar_items['enabled']['placebo'] );
		}

		$enabled_items = class_exists( 'XTS\Options' ) ? $toolbar_items : $toolbar_items['enabled'];

		if ( ( lorada_get_opt( 'shopping_mini_cart' ) && 'side_view' == lorada_get_opt( 'cart_view_popsition' ) ) || ( lorada_get_opt( 'sticky_mob_toolbar' ) && array_key_exists( 'cart', $enabled_items ) ) ) {
			?>

			<div class="lorada-sidebar-mini-cart">
				<div class="sidebar-header">
					<a href="#" class="close-sidebar"><i class="lorada lorada-cross2"></i></a>
				</div>

				<div class="mini-cart-container woocommerce">
					<div class="widget_shopping_cart_content">
						<?php
							if ( class_exists( 'WooCommerce' ) ) {
								woocommerce_mini_cart();
							}
						?>
					</div>
				</div>
			</div>

			<?php
		}
	}
}

/* Lorada Full Screen Searchbox */
if ( ! function_exists( 'lorada_full_screen_searchbox' ) ) {
	add_action( 'lorada_after_footer_content', 'lorada_full_screen_searchbox', 15 );

	function lorada_full_screen_searchbox() {
		$toolbar_items = lorada_get_opt( 'sticky_toolbar_items' );

		if ( isset( $toolbar_items['enabled']['placebo'] ) ) {
			unset( $toolbar_items['enabled']['placebo'] );
		}

		$enabled_items = class_exists( 'XTS\Options' ) ? $toolbar_items : $toolbar_items['enabled'];

		if ( 'full_screen' == lorada_get_opt( 'search_widget_style' ) || ( lorada_get_opt( 'sticky_mob_toolbar' ) && array_key_exists( 'search', $enabled_items ) ) ) {
			?>

			<div id="lorada-full-screen-search" class="full-screen-search-form">
				<div class="form-inner">
					<span class="form-close"></span>

					<?php
						lorada_header_block_search_form( array(
							'type'	=>	'full_screen',
							'count'	=>	50
						) );
					?>
				</div>
			</div>

			<?php
		}
	}
}

/* Lorada Promo Popup */
if ( ! function_exists( 'lorada_promo_popup' ) ) {
	add_action( 'lorada_after_footer_content', 'lorada_promo_popup', 20 );

	function lorada_promo_popup() {
		if ( ! lorada_get_opt( 'enable_promo_popup' ) ) {
			return;
		}

		$style = array();
		$popup_width = lorada_get_opt( 'promo_popup_width' );
		$popup_bg = lorada_get_opt( 'popup_bg' );

		if ( '' != $popup_width ) {
			$style['width'] = 'max-width: ' . $popup_width . 'px';
		}

		if ( '' != $popup_bg ) {
			$style['bg-image'] = 'background-image: url(' . $popup_bg['background-image'] . ')';
			$style['bg-color'] = 'background-color: ' . $popup_bg['background-color'];
			$style['bg-repeat'] = 'background-repeat: ' . $popup_bg['background-repeat'];
			$style['bg-size'] = 'background-size: ' . $popup_bg['background-size'];
			$style['bg-position'] = 'background-position: ' . $popup_bg['background-position'];
		}
		?>

		<div class="lorada-promo-popup mfp-with-anim mfp-hide" style="<?php echo esc_attr( implode( ';', $style ) ); ?>">
			<div class="promo-popup-inner">
				<?php echo do_shortcode( lorada_get_opt( 'popup_content_txt' ) ); ?>
			</div>
		</div>

		<?php
	}
}

/* Mobile sidebar toggle button */
if ( ! function_exists( 'lorada_mobile_sidebar_toggle_btn' ) ) {
	add_action( 'lorada_after_footer_content', 'lorada_mobile_sidebar_toggle_btn', 35 );

	function lorada_mobile_sidebar_toggle_btn() {
		$sidebar_class = lorada_get_sidebar_class();

		if ( strstr( $sidebar_class, 'col-lg-0' ) ) return;

		if ( function_exists( 'lorada_is_shop_archive' ) && ! lorada_is_shop_archive() ) {
			?>

			<div class="mobile-sidebar-toggle-btn">
				<span class="btn-inner"><i class="lorada lorada-chevron-right"></i></span>
				<span class="dot-wave"></span>
			</div>

			<?php
		}
	}
}

/* Extra Footer Section */
if ( ! function_exists( 'lorada_extra_footer_section' ) ) {
	add_action( 'wp_footer', 'lorada_extra_footer_section', 999 );

	function lorada_extra_footer_section() {
		$show_cookie = lorada_get_opt( 'show_cookie' );

		if ( ! $show_cookie ) {
			return;
		}

		$page_id = lorada_get_opt( 'cookies_policy_page' );
		?>

			<div class="lorada-cookies-popup">
				<div class="lorada-cookies-inner container">
					<div class="cookies-info-text">
						<?php echo do_shortcode( lorada_get_opt( 'cookies_text' ) ); ?>
					</div>

					<div class="cookies-buttons">
						<?php if ( $page_id ): ?>
							<a href="<?php echo get_permalink( $page_id ); ?>" class="read-more-cookies"><?php esc_html_e( 'More info' , 'lorada' ); ?></a>
						<?php endif ?>

						<a href="#" class="accept-cookie-btn"><?php esc_html_e( 'Accept' , 'lorada' ); ?></a>
					</div>
				</div>
			</div>

		<?php
	}
}

/* Get post image */
if ( ! function_exists( 'lorada_get_post_thumbnail' ) ) {
	function lorada_get_post_thumbnail( $size = 'medium', $attach_id = false ) {
		global $post;

		$img = '';

		if ( has_post_thumbnail() ) {
			if ( function_exists( 'wpb_getImageBySize' ) ) {
				if ( ! $attach_id ) {
					$attach_id = get_post_thumbnail_id();
				}

				$img = wpb_getImageBySize( array(
					'attach_id'	 => $attach_id,
					'thumb_size' => $size,
					'class'      => 'attachment-large wp-post-image'
				) );

				$img = $img['thumbnail'];
			} else {
				$img = get_the_post_thumbnail( $post->ID, $size );
			}
		}

		return $img;
	}
}

/* Blog archive page main loop */
if ( ! function_exists( 'lorada_main_loop' ) ) {
	add_action( 'lorada_main_loop', 'lorada_main_loop' );

	function lorada_main_loop() {
		global $paged, $wp_query, $post_counter;

		$max_page = $wp_query->max_num_pages;
		$post_counter = 0;

		$pagination = lorada_get_opt( 'blog_pagination' );
		$blog_style = lorada_get_opt( 'blog_style' );

		if ( is_search() ) {
			$pagination = 'pagination';
		}

		$is_ajax = lorada_is_ajax();

		if ( ! $paged ) {
			$paged = 1;
		}

		if ( have_posts() ) {
			// Show necessary description : tag, category, author bio
			if ( ! $is_ajax ) {
				if ( is_tag() && tag_description() ) {
					?>
					<div class="archive-meta"><?php echo tag_description() ?></div>
					<?php
				}

				if ( is_category() && category_description() ) {
					?>
					<div class="archive-meta"><?php echo category_description() ?></div>
					<?php
				}

				if ( is_author() && get_the_author_meta( 'description' ) ) {
					get_template_part( 'author-bio' );
				}
			}

			// Show main blog posts
			if ( ! $is_ajax ) {
				$grid_columns = lorada_get_opt( 'blog_grid_columns' );
				$grid_columns = empty( $grid_columns ) ? 3 : $grid_columns;

				$classes    = array();
				$classes[]  = 'lorada-latest-posts';

				if ( 3 == $blog_style ) {
					$classes[] = 'grid-view-method';
					$classes[] = 'display-masonry-grid';
				} elseif ( 2 == $blog_style ) {
					$classes[] = 'grid-view-method';
				} else {
					$classes[] = 'list-view-method';
					$grid_columns = 1;
				}
				?>

				<div class="lorada-blog-wrapper blog-pagination-<?php echo esc_attr( $pagination ) ?> <?php echo esc_attr( implode(' ', $classes) ) ?>" data-paged="1" data-source="main_loop">
					<div class="latest-post-inner view-method-inner" data-column="<?php echo esc_attr( $grid_columns ) ?>">

				<?php
			}

				if ( $is_ajax ) {
					ob_start();
				}

				while ( have_posts() ) :
					the_post();
					get_template_part( 'content', get_post_format() );

					$post_counter++;
				endwhile;

				if ( $is_ajax ) {
					$output = ob_get_clean();
				}

			if ( ! $is_ajax ) {
				?>

					</div>
				</div>

				<div class="blog-footer">
					<?php
					if ( ( 'infinit' == $pagination || 'load_more' == $pagination ) && get_next_posts_link() ) {
						$load_more_link = add_query_arg( 'ld_ajax', 1, next_posts( $max_page, false ) );
						$extra_class    = '';

						if ( 'infinit' == $pagination ) {
							$extra_class .= ' load-on-scroll';
						}
						?>

						<a href="<?php echo esc_url( $load_more_link ) ?>" class="lorada-btn lorada-blog-load-more <?php echo esc_attr( $extra_class ) ?>">
							<span class="text-label"><?php echo esc_html__( 'Load more', 'lorada' ) ?></span>
							<span class="loading-text-label"><?php echo esc_html__( 'Loading...', 'lorada' ) ?></span>
						</a>

						<?php
					} else {
						?>

						<nav class="lorada-pagination">
							<?php
								echo paginate_links( array(
										'type'		=> 'list',
										'prev_text'	=> esc_html__( 'Prev', 'lorada' ),
										'next_text'	=> esc_html__( 'Next', 'lorada' ),
									) );
							?>
						</nav>

						<?php
					}
					?>
				</div>

				<?php
			}
		} else {
			get_template_part( 'content', 'none' );
		}

		if ( $is_ajax ) {
			$output = array(
				'items'		=>	$output,
				'status'	=>	( $max_page > $paged ) ? 'have-posts' : 'no-more-posts',
				'nextPage'	=>	add_query_arg( 'ld_page', 1, next_posts( $max_page, false ) )
			);

			echo json_encode( $output );
		}
	}
}

/* Masonry Layout Init */
if ( ! function_exists( 'lorada_masonry_layout' ) ) {
	function lorada_masonry_layout( $id, $content, $item_selector = 'grid-item' ) {
		$masonry_function = function() use( $id, $content, $item_selector ) {

			ob_start();
			?>

				jQuery(document).ready(function($) {

					var masonry_content = $("#<?php echo esc_js( $id ); ?> .<?php echo esc_js( $content ); ?>");

					masonry_content.isotope({
						itemSelector: '.<?php echo esc_js( $item_selector ); ?>',
						layoutMode: 'packery',
						packery: {
							gutter: 0
						}
					}).isotope( 'layout' );
				});

			<?php

			return ob_get_clean();
		};

		wp_add_inline_script( 'lorada-theme-scripts', $masonry_function(), 'after' );
	}
}

/* Generate and show each page heading ( containing Page title, Breadcrumbs, ... ) */
if ( ! function_exists( 'lorada_page_heading' ) ) {
	function lorada_page_heading() {
		global $wp_query, $post;

		// Remove page title for dokan store list page
		if( function_exists( 'dokan_is_store_page' )  && dokan_is_store_page() ) {
			return '';
		}

		$page_id = 0;

		$show_page_heading  = 'show';
		$page_title  = true;
		$show_breadcrumbs = lorada_get_opt( 'show_breadcrumbs' );

		$background_image = '';

		$style = array();

		$page_for_posts    = get_option( 'page_for_posts' );
		$page_for_shop     = get_option( 'woocommerce_shop_page_id' );

		$title_color = $title_design = $title_size = 'default';

		// Get default styles from Options Panel
		$title_background	= lorada_get_opt( 'title_background' );
		$title_design		= lorada_get_opt( 'page_title_design' );
		$title_size			= lorada_get_opt( 'page_title_size' );
		$title_color		= lorada_get_opt( 'page_title_color' );
		$shop_title			= lorada_get_opt( 'shop_title' );
		$shop_categories	= lorada_get_opt( 'shop_categories' );

		$title_class = 'title-size-'  . $title_size;
		$title_class .= ' color-scheme-' . $title_color;
		$title_class .= ' text-' . $title_design;

		if ( 'disable' == $title_design ) {
			$page_title = false;
		}

		if ( ! $page_title && ! $show_breadcrumbs ) {
			$show_page_heading = 'hide';
		}

		// Get page ID to get custom value from metabox of specific PAGE | BLOG PAGE | SHOP PAGE.
		$page_id = lorada_get_page_id();

		if ( 0 != $page_id ) {
			// Get meta value for specific page id
			$show_page_heading = get_post_meta( $page_id, '_lorada_page_heading', true );
			$background_image = get_post_meta( $page_id, '_lorada_background_image', true );
			$custom_background_color = get_post_meta( $page_id, '_lorada_background_color', true );
			$custom_top_spacing = get_post_meta( $page_id, '_lorada_page_heading_top', true );
			$custom_bottom_spacing = get_post_meta( $page_id, '_lorada_page_heading_bottom', true );

			if ( '' != $background_image ) {
				$style['bg-image'] = "background-image: url(" . $background_image . ")";
			} else if ( isset( $title_background['background-image'] ) && ! empty( $title_background['background-image'] ) ) {
				$style['bg-image'] = "background-image: url(" . $title_background['background-image'] . ")";
			}

			$style['bg-repeat']   = "background-repeat: " . $title_background['background-repeat'];
			$style['bg-size']     = "background-size: " . $title_background['background-size'];
			$style['bg-position'] = "background-position: " . $title_background['background-position'];

			if ( '' != $custom_background_color ) {
				$style['bg-color'] = "background-color: " . $custom_background_color;
			} else if ( isset( $title_background['background-color'] ) && ! empty( $title_background['background-color'] ) ) {
				$style['bg-color'] = "background-color: " . $title_background['background-color'];
			}

			if ( ! empty( $custom_top_spacing ) ) {
				$style['top_space'] = "padding-top: " . $custom_top_spacing . "px";
			}

			if ( ! empty( $custom_bottom_spacing ) ) {
				$style['bottom_space'] = "padding-bottom: " . $custom_bottom_spacing . "px";
			}
		} else {
			$style['bg-color'] = "background-color: #f3f3f3;";
		}

		if ( 'hide' == $show_page_heading ) {
			return;
		}

		// Heading for pages
		if( is_singular( 'page' ) && $page_id != $page_for_posts ):
			$title = get_the_title();
			?>

			<div class="page-title <?php echo esc_attr( $title_class ); ?>" style="<?php echo esc_attr( implode( ';', $style) ); ?>">
				<div class="container">
					<?php if( $page_title ): ?><h1 class="entry-title"><?php echo esc_html( $title ); ?></h1><?php endif; ?>
					<?php if( $show_breadcrumbs ) lorada_breadcrumbs(); ?>
				</div>
			</div>

			<?php
			return;
		endif;

		// Heading for blog post and archives
		if ( is_singular( 'post' ) || lorada_is_blog_archive() ):

			$title = ( ! empty( $page_for_posts ) )? get_the_title( $page_for_posts ) : esc_html__( 'Blog', 'lorada' );

			if ( is_tag() ) {
				$title = esc_html__( 'Tag Archives: ', 'lorada' )  . single_tag_title( '', false ) ;
			}

			if ( is_category() ) {
				$title = '<span>' . single_cat_title( '', false ) . '</span>';
			}

			if ( is_date() ) {
				if ( is_day() ) :
					$title = esc_html__( 'Daily Archives: ', 'lorada') . get_the_date();
				elseif ( is_month() ) :
					$title = esc_html__( 'Monthly Archives: ', 'lorada') . get_the_date( _x( 'F Y', 'monthly archives date format', 'lorada' ) );
				elseif ( is_year() ) :
					$title = esc_html__( 'Yearly Archives: ', 'lorada') . get_the_date( _x( 'Y', 'yearly archives date format', 'lorada' ) );
				else :
					$title = esc_html__( 'Archives', 'lorada' );
				endif;
			}

			if ( is_author() ) {
				/*
				 * Queue the first post, that way we know what author
				 * we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				the_post();

				$title = esc_html__( 'Posts by ', 'lorada' ) . '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>';

				/*
				 * Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();
			}

			if ( is_search() ) {
				$title = esc_html__( 'Search Results for: ', 'lorada' ) . get_search_query();
			}
			?>

				<div class="page-title <?php echo esc_attr( $title_class ); ?> title-blog" style="<?php echo esc_attr( implode( ';', $style ) ); ?>">
					<div class="container">
						<?php if ( $page_title && is_single() ): ?>
							<h3 class="entry-title"><?php echo '' . $title; ?></h3>
						<?php else: ?>
							<h1 class="entry-title"><?php echo '' . $title; ?></h1>
						<?php endif; ?>

						<?php if( $show_breadcrumbs && ! is_search() ) lorada_breadcrumbs(); ?>
					</div>
				</div>

			<?php
			return;
		endif;

		// Page heading for shop page
		if ( lorada_is_shop_archive() ):

			if ( is_product_category() ) {

				$cat = $wp_query->get_queried_object();

				$cat_image = lorada_get_category_page_title_image( $cat );

				if ( '' != $cat_image ) {
					$style['bg-image'] = "background-image: url(" . $cat_image . ")";
				}
			}

			if ( ! $shop_title ) {
				$title_class .= ' without-title';
			}

			if ( apply_filters( 'woocommerce_show_page_title', true ) ) :
				?>

				<div class="page-title <?php echo esc_attr( $title_class ); ?> title-shop" style="<?php echo esc_attr( implode( ';', $style ) ); ?>">
					<div class="container">
						<div class="woocommerce-products-header nav-shop">

							<div class="shop-title-wrapper">
								<?php if ( $shop_title ): ?>
									<h1 class="woocommerce-products-header__title entry-title"><?php woocommerce_page_title(); ?></h1>
								<?php endif ?>
							</div>

							<?php if ( $shop_categories ) lorada_product_categories_nav(); ?>

						</div>
					</div>
				</div>

				<?php
			endif;

			return;
		endif;
	}
}

/* Breadcrumbs function */
if ( ! function_exists( 'lorada_breadcrumbs' ) ) {
	function lorada_breadcrumbs() {

		/* === OPTIONS === */
		$text['home']     = esc_html__( 'Home', 'lorada' ); // text for the 'Home' link
		$text['category'] = esc_html__( 'Archive by Category "%s"', 'lorada' ); // text for a category page
		$text['search']   = esc_html__( 'Search Results for "%s" Query', 'lorada' ); // text for a search results page
		$text['tag']      = esc_html__( 'Posts Tagged "%s"', 'lorada' ); // text for a tag page
		$text['author']   = esc_html__( 'Articles Posted by %s', 'lorada' ); // text for an author page
		$text['404']      = esc_html__( 'Error 404', 'lorada' ); // text for the 404 page

		$show_current_post  = 0; // 1 - show current post
		$show_current       = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
		$show_on_home       = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$show_home_link     = 1; // 1 - show the 'Home' link, 0 - don't show
		$show_title         = 1; // 1 - show the title for the links, 0 - don't show
		$delimiter          = ' &raquo; '; // delimiter between crumbs
		$before             = '<span class="current">'; // tag before the current crumb
		$after              = '</span>'; // tag after the current crumb
		/* === END OF OPTIONS === */

		global $post;

		$home_link    = home_url( '/' );
		$link_before  = '<span typeof="v:Breadcrumb">';
		$link_after   = '</span>';
		$link_attr    = ' rel="v:url" property="v:title"';
		$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
		$parent_id    = $parent_id_sec = ( ! empty( $post ) && is_a( $post, 'WP_Post' ) ) ? $post->post_parent : 0;
		$frontpage_id = get_option( 'page_on_front' );

		if ( is_front_page() ) {
			return;
		} else if ( is_home() ) {
			if ( 1 == $show_on_home ) {
				echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a><span class="current">';
				single_post_title();
				echo '</span></div>';
			}
		} else {
			echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';

			if ( 1 == $show_home_link ) {
				echo '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $text['home'] . '</a>';

				if ( 0 == $frontpage_id || $parent_id != $frontpage_id ) {
					echo esc_html( $delimiter );
				}
			}

			if ( is_category() ) {
				$this_cat = get_category( get_query_var( 'cat' ), false );

				if ( 0 != $this_cat->parent ) {
					$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);

					if ( 0 == $show_current ) {
						$cats = preg_replace( "#^(.+)$delimiter$#", "$1", $cats );
					}

					$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
					$cats = str_replace( '</a>', '</a>' . $link_after, $cats );

					if ( 0 == $show_title ) {
						$cats = preg_replace( '/ title="(.*?)"/', '', $cats );
					}

					echo '' . $cats;
				}

				if ( 1 == $show_current ) {
					echo '' . $before . sprintf( $text['category'], single_cat_title( '', false ) ) . $after;
				}

			} elseif ( is_search() ) {
				echo '' . $before . sprintf( $text['search'], get_search_query() ) . $after;

			} elseif ( is_day() ) {
				echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y') ) . $delimiter;
				echo sprintf( $link, get_month_link( get_the_time('Y'),get_the_time('m') ), get_the_time('F') ) . $delimiter;
				echo '' . $before . get_the_time('d') . $after;

			} elseif ( is_month() ) {
				echo sprintf( $link, get_year_link( get_the_time('Y') ), get_the_time('Y') ) . $delimiter;
				echo '' . $before . get_the_time('F') . $after;

			} elseif ( is_year() ) {
				echo '' . $before . get_the_time('Y') . $after;

			} elseif ( is_single() && !is_attachment() ) {
				if ( 'post' != get_post_type() ) {
					$post_type = get_post_type_object( get_post_type() );
					$slug = $post_type->rewrite;
					printf( $link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name );

					if ( 1 == $show_current ) {
						echo esc_html( $delimiter ) . $before . get_the_title() . $after;
					}
				} else {
					$cat = get_the_category();
					$cat = $cat[0];
					$cats = get_category_parents( $cat, TRUE, $delimiter );

					if ( 0 == $show_current ) {
						$cats = preg_replace( "#^(.+)$delimiter$#", "$1", $cats );
					}

					$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
					$cats = str_replace( '</a>', '</a>' . $link_after, $cats );
					if ( 0 == $show_title ) {
						$cats = preg_replace( '/ title="(.*?)"/', '', $cats );
					}

					echo '' . $cats;

					if ( 1 == $show_current_post ) {
						echo '' . $before . get_the_title() . $after;
					}
				}

			} elseif ( ! is_single() && ! is_page() && 'post' != get_post_type() && ! is_404() ) {
				$post_type = get_post_type_object( get_post_type() );
				if ( is_object( $post_type ) ) {
					echo '' . $before . $post_type->labels->singular_name . $after;
				}

			} elseif ( is_attachment() ) {
				$parent = get_post( $parent_id );
				$cat = get_the_category( $parent->ID );
				$cat = $cat[0];

				if ( $cat ) {
					$cats = get_category_parents( $cat, TRUE, $delimiter );
					$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
					$cats = str_replace( '</a>', '</a>' . $link_after, $cats );

					if ( 0 == $show_title ) {
						$cats = preg_replace( '/ title="(.*?)"/', '', $cats );
					}

					echo '' . $cats;
				}

				printf( $link, get_permalink( $parent ), $parent->post_title );

				if ( 1 == $show_current ) {
					echo esc_html( $delimiter ) . $before . get_the_title() . $after;
				}

			} elseif ( is_page() && ! $parent_id ) {
				if ( 1 == $show_current ) {
					echo '' . $before . get_the_title() . $after;
				}

			} elseif ( is_page() && $parent_id ) {
				if ( $parent_id != $frontpage_id ) {
					$breadcrumbs = array();

					while ( $parent_id ) {
						$page = get_post( $parent_id );

						if ( $parent_id != $frontpage_id ) {
							$breadcrumbs[] = sprintf( $link, get_permalink( $page->ID ), get_the_title( $page->ID ) );
						}

						$parent_id = $page->post_parent;
					}

					$breadcrumbs = array_reverse( $breadcrumbs );

					for ( $i = 0; $i < count($breadcrumbs); $i++ ) {
						echo '' . $breadcrumbs[$i];
						if ( $i != count( $breadcrumbs ) - 1 ) {
							echo esc_html( $delimiter );
						}
					}
				}

				if ( 1 == $show_current ) {
					if ( 1== $show_home_link || ( 0 != $parent_id_sec && $parent_id_sec != $frontpage_id ) ) {
						echo esc_html( $delimiter );
					}

					echo '' . $before . get_the_title() . $after;
				}

			} elseif ( is_tag() ) {
				echo '' . $before . sprintf( $text['tag'], single_tag_title( '', false ) ) . $after;

			} elseif ( is_author() ) {
		 		global $author;

				$userdata = get_userdata( $author );
				echo '' . $before . sprintf( $text['author'], $userdata->display_name ) . $after;

			} elseif ( is_404() ) {
				echo '' . $before . $text['404'] . $after;

			} elseif ( has_post_format() && ! is_singular() ) {
				echo get_post_format_string( get_post_format() );
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ' (';
				}

				echo esc_html__('Page', 'lorada' ) . ' ' . get_query_var( 'paged' );

				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ')';
				}
			}

			echo '</div><!-- .breadcrumbs -->';
		}
	}
}

/* Post Breadcrumbs function */
if ( ! function_exists( 'lorada_post_breadcrumbs' ) ) {
	function lorada_post_breadcrumbs() {
		if ( ! is_home() ) {
			$sep = '<i class="lorada lorada-chevron-right"></i>';

			echo '<a href="' . home_url() . '">';
			echo esc_html__( 'Home', 'lorada' );
			echo '</a>' . $sep;

			$category = get_the_category();
			$name = $category[0]->cat_name;
			$cat_id = get_cat_ID( $name );
			$link = get_category_link( $cat_id );
			echo '<a href="'. esc_url( $link ) .'"">'. $name .'</a>';

			echo '' . $sep;
			the_title();
		}
	}
}

/* Product Lazyload Style */
if ( ! function_exists( 'lorada_product_lazyload_style' ) ) {
	function lorada_product_lazyload_style( $class, $width, $height ) {
		$lazyload_style = "
			.lorada-product-img-link." . $class . ".is-loading {
				min-width: 100%;
				min-height: {$height}px;
			}
		";

		wp_add_inline_style( 'lorada-theme-style', $lazyload_style );
	}
}

/* Sale CountDown Template */
if ( ! function_exists( 'lorada_sale_countdown_template' ) ) {
	function lorada_sale_countdown_template() {
		?>
			<script type="text/template" id="flip-countdown-template">
				<div class="time <%= label %>">
				  <div class="count curr top"><%= curr %></div>
				  <div class="count next top"><%= next %></div>
				  <div class="count next bottom"><%= next %></div>
				  <div class="count curr bottom"><%= curr %></div>
				  <div class="countdown-label"><%= label.length < 6 ? label : label.substr(0, 3)  %></div>
				</div>
			</script>
		<?php
	}

	add_action( 'lorada_footer_actions', 'lorada_sale_countdown_template', 10 );
}

/* Product Attribute Swatches */
if ( ! function_exists( 'lorada_attribute_swatches' ) ) {
	function lorada_attribute_swatches( $product_id, $attribute_name, $options, $available_variations ) {
		$swatches = array();

		foreach ( $options as $key => $value ) {
			$swatch = lorada_attribute_swatche( $product_id, $attribute_name, $value );

			if ( ! empty( $swatch ) ) {
				$swatches[$key] = $swatch;
			}
		}

		return $swatches;
	}
}

if ( ! function_exists( 'lorada_attribute_swatche' ) ) {
	function lorada_attribute_swatche( $product_id, $attribute_name, $value ) {
		$inner_swatches = array();
		$image = $color = '';

		$term = get_term_by( 'slug', $value, $attribute_name );

		if ( is_object( $term ) ) {
			$image = get_term_meta( $term->term_id, 'attribute_image', true );
			$color = get_term_meta( $term->term_id, 'attribute_color', true );
		}

		if ( '' != $image ) {
			$inner_swatches['attribute_image'] = $image;
		}

		if ( '' != $color ) {
			$inner_swatches['attribute_color'] = $color;
		}

		return $inner_swatches;
	}
}

if ( ! function_exists( 'lorada_get_variations_option' ) ) {
	function lorada_get_variations_option( $attribute_name, $variations_available, $product_id ) {
		$available_attribute_swatches = array();

		foreach ( $variations_available as $key => $variation ) {
			$variation_option = array();
			$attribute_key = 'attribute_' . $attribute_name;

			if ( ! empty( $variation['attributes'][$attribute_key] ) ) {
				$value = $variation['attributes'][$attribute_key];
			} else {
				continue;
			}

			if ( ! empty( $variation['image']['src'] ) ) {
				$variation_option = array(
					'variation_id'	=>	$variation['variation_id'],
					'image_src'		=>	$variation['image']['thumb_src'],
					'image_srcset'	=>	wp_get_attachment_image_srcset($variation['image_id'], 'shop_catalog'),
					'image_sizes'	=>	wp_get_attachment_image_sizes($variation['image_id'], 'shop_catalog'),
					'is_in_stock'	=>	$variation['is_in_stock']
				);
			}

			$inner_swatches = lorada_attribute_swatche( $product_id, $attribute_name, $value );
			$available_attribute_swatches[$value] = array_merge( $inner_swatches, $variation_option );
		}

		return $available_attribute_swatches;
	}
}

/* Lorada Post BackStretch BG */
if ( ! function_exists( 'lorada_post_backstretch_bg' ) ) {
	function lorada_post_backstretch_bg( $layout ) {
		if ( 'backstretch' != $layout ) {
			return;
		}

		$featured_image_id = get_post_thumbnail_id();
		$image_src = wp_get_attachment_image_src( $featured_image_id, 'full' );

		if ( '' != trim( $image_src[0] ) ) {
			if (is_ssl()) {
				$image_url = str_replace("http://", "https://", $image_src[0]);
			} else {
				$image_url = $image_src[0];
			}

			?>

			<div class="post-backstretch-wrap">
				<img class="backstretch-bg no-parallax" src="<?php echo esc_url( $image_url ); ?>">
			</div>

			<?php
		}
	}
}

/* Lorada Post Header */
if ( ! function_exists( 'lorada_post_header' ) ) {
	function lorada_post_header() {
		global $post;
		?>

		<div class="post-breadcrumb">
			<?php lorada_post_breadcrumbs(); ?>
		</div>

		<div class="post-header-holder">
			<div class="post-categories">
				<?php echo get_the_category_list(' '); ?>
			</div>

			<h2 class="post-title"><?php the_title(); ?></h2>

			<div class="post-meta">
				<div class="author-date-info">
					<span><?php echo esc_html__( 'By', 'lorada' ); ?></span>

					<a href="<?php echo get_author_posts_url( $post->post_author ); ?>">
						<span class="post-author"><?php echo get_the_author_meta('display_name', $post->post_author); ?></span>
					</a>

					<div class="author-line"> - </div>

					<span class="post-date"><?php echo get_the_date(); ?></span>
				</div>

				<div class="post-comments">
					<a href="#comments">
						<i class="lorada lorada-bubbles"></i>
						<?php echo get_comments_number(); ?>
					</a>
				</div>
			</div>
		</div>

		<?php
	}
}

/* Lorada Post Tags */
if ( ! function_exists( 'lorada_post_tags' ) ) {
	function lorada_post_tags() {

		if ( ! has_tag() ) {
			return;
		}

		?>

		<div class="post-tags">
			<span class="tag-title"><?php echo esc_html__( 'Tags', 'lorada' ); ?>:</span>
			<?php echo get_the_tag_list( '', ' ' ); ?>
		</div>

		<?php
	}
}

/* Lorada Post Share Button */
if ( ! function_exists( 'lorada_post_share_buttons' ) ) {
	function lorada_post_share_buttons() {
		?>

		<div class="post-share-links">
			<span class="link-title"><?php echo esc_html__( 'Share', 'lorada' ); ?>:</span>

			<?php
			if ( class_exists( 'Lorada_Core_Main_Functions' ) ) {
				echo Lorada_Core_Main_Functions::instance()->lorada_core_social_buttons( array(
					'type' => 'share',
					'btn_size' => 'small',
					'btn_shape' => 'square',
					'btn_style' => 'colored'
				) );
			}
			?>
		</div>

		<?php
	}
}

/* Lorada Post Pagination */
if ( ! function_exists( 'lorada_post_pagination' ) ) {
	function lorada_post_pagination() {
		global $post;

		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>

		<div class="post-pagination">
			<nav role="navigation" class="single-post-navigation">
				<div class="nav-previous">
					<?php previous_post_link( '%link', '<div class="nav-post-title"><i class="lorada lorada-chevron-left"></i><div class="nav-arrow">' . __( 'Previous', 'lorada' ) . '<span>%title</span></div></div>' ); ?>
				</div>

				<div class="nav-next">
					<?php next_post_link( '%link', '<div class="nav-post-title"><div class="nav-arrow">' . __( 'Next', 'lorada' ) . '<span>%title</span></div><i class="lorada lorada-chevron-right"></i></div>' ); ?>
				</div>
			</nav>
		</div>

		<?php
	}
}

/* Lorada Post Author */
if ( ! function_exists( 'lorada_post_author' ) ) {
	function lorada_post_author() {
		if ( empty( get_the_author_meta( 'description' ) ) ) return;
		?>

		<div class="post-author-wrapper">
			<div class="author-inner clearfix">
				<div class="author-img-thumbnail">
					<?php echo get_avatar( get_the_author_meta( 'email' ), '150' ); ?>
				</div>

				<div class="author-profile">
					<span class='name'><?php the_author_posts_link(); ?></span>
			        <p class="description"><?php the_author_meta( 'description' ); ?></p>
					<div class="author-social-info">
						<span class="info-label"><?php echo esc_html__( 'Follow me on', 'lorada' ); ?>:</span>
				        <ul class="author-social-links">
					    	<?php if ( ! empty( get_the_author_meta( 'facebook_url' ) ) ): ?>
								<li>
									<a href="<?php echo esc_url( get_the_author_meta( 'facebook_url' ) ); ?>"><i class="fab fa-facebook-f"></i></a>
								</li>
							<?php endif; ?>

							<?php if ( ! empty( get_the_author_meta( 'twitter_url' ) ) ): ?>
								<li>
									<a href="<?php echo esc_url( get_the_author_meta( 'twitter_url' ) ); ?>"><i class="fab fa-twitter"></i></a>
								</li>
							<?php endif; ?>

							<?php if ( ! empty( get_the_author_meta( 'google_plus_url' ) ) ): ?>
								<li>
									<a href="<?php echo esc_url( get_the_author_meta( 'google_plus_url' ) ); ?>"><i class="fab fa-google-plus-g"></i></a>
								</li>
							<?php endif; ?>

							<?php if ( ! empty( get_the_author_meta( 'linkedin_url' ) ) ): ?>
								<li>
									<a href="<?php echo esc_url( get_the_author_meta( 'linkedin_url' ) ); ?>"><i class="fab fa-linkedin-in"></i></a>
								</li>
							<?php endif; ?>

							<?php if ( ! empty( get_the_author_meta( 'instagram_url' ) ) ): ?>
								<li>
									<a href="<?php echo esc_url( get_the_author_meta( 'instagram_url' ) ); ?>"><i class="fab fa-instagram"></i></a>
								</li>
							<?php endif; ?>
				        </ul>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}

/* Lorada Post Comments */
if ( ! function_exists( 'lorada_post_comments_field' ) ) {
	 function lorada_post_comments_field() {
	 	$enable_page_comments = lorada_get_opt( 'page_comments_enable' );
	 	$enable_post_comments = lorada_get_opt( 'post_comments_enable' );

		if ( ! comments_open() ) return;
		if ( is_page() && ! $enable_page_comments ) return;
		if ( is_singular( 'post' ) && ! $enable_post_comments ) return;

	 	?>

	 	<div class="post-comments-field">
			<?php
				wp_reset_postdata();
				comments_template();
			?>
		</div>

	 	<?php
	}
}

/* User Profile Custom field */
if ( ! function_exists( 'lorada_user_profile_social_url' ) ) :
	function lorada_user_profile_social_url( $user ) {
		?>

		<h3><?php esc_html_e('Social Profile URL', 'lorada'); ?></h3>

		<table class="form-table">
			<tr>
				<th>
					<label for="facebook_url"><?php esc_html_e('Facebook profile URL', 'lorada'); ?>
				</label></th>
				<td>
					<input type="text" name="facebook_url" id="facebook_url" value="<?php echo esc_attr( get_the_author_meta( 'facebook_url', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th>
					<label for="twitter_url"><?php esc_html_e('Twitter profile URL', 'lorada'); ?>
				</label></th>
				<td>
					<input type="text" name="twitter_url" id="twitter_url" value="<?php echo esc_attr( get_the_author_meta( 'twitter_url', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th>
					<label for="google_plus_url"><?php esc_html_e('Google+ profile URL', 'lorada'); ?>
				</label></th>
				<td>
					<input type="text" name="google_plus_url" id="google_plus_url" value="<?php echo esc_attr( get_the_author_meta( 'google_plus_url', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th>
					<label for="linkedin_url"><?php esc_html_e('LinkedIn profile URL', 'lorada'); ?>
				</label></th>
				<td>
					<input type="text" name="linkedin_url" id="linkedin_url" value="<?php echo esc_attr( get_the_author_meta( 'linkedin_url', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
			<tr>
				<th>
					<label for="instagram_url"><?php esc_html_e('Instagram profile URL', 'lorada'); ?>
				</label></th>
				<td>
					<input type="text" name="instagram_url" id="instagram_url" value="<?php echo esc_attr( get_the_author_meta( 'instagram_url', $user->ID ) ); ?>" class="regular-text" /><br />
				</td>
			</tr>
		</table>

		<?php
	}
endif;

if ( ! function_exists( 'lorada_save_user_profile_social_url' ) ) :
	function lorada_save_user_profile_social_url( $user_id ) {

		if ( ! current_user_can( 'edit_user', $user_id ) )
			return false;

		update_user_meta( $user_id, 'facebook_url', $_POST['facebook_url'] );
		update_user_meta( $user_id, 'twitter_url', $_POST['twitter_url'] );
		update_user_meta( $user_id, 'google_plus_url', $_POST['google_plus_url'] );
		update_user_meta( $user_id, 'linkedin_url', $_POST['linkedin_url'] );
		update_user_meta( $user_id, 'instagram_url', $_POST['instagram_url'] );
	}
endif;

add_action( 'show_user_profile', 'lorada_user_profile_social_url' );
add_action( 'edit_user_profile', 'lorada_user_profile_social_url' );

add_action( 'personal_options_update', 'lorada_save_user_profile_social_url' );
add_action( 'edit_user_profile_update', 'lorada_save_user_profile_social_url' );

/* Template Redirect for "Coming Soon" mode  */
if ( ! function_exists( 'lorada_redirect_page_template' ) ) :
	function lorada_redirect_page_template() {
		$coming_soon_mode = lorada_get_opt( 'coming_soon_mode' );

		if ( isset( $coming_soon_mode ) && ! empty( $coming_soon_mode ) && ! is_user_logged_in() ) {
			if ( ! is_home() && ! is_front_page() ) {
				wp_redirect( site_url() );
				die;
			}
		}
	}
endif;

add_action( 'template_redirect', 'lorada_redirect_page_template', 99 );

/* Load "Coming Soon" page template */
if ( ! function_exists( 'lorada_load_coming_soon_page' ) ) :
	function lorada_load_coming_soon_page( $template ) {
		$coming_soon_mode = lorada_get_opt( 'coming_soon_mode' );

		if ( isset( $coming_soon_mode ) && ! empty( $coming_soon_mode ) && ! is_user_logged_in() ) {
			return lorada_get_template_part( 'coming', 'soon' );
		}

		return $template;
	}
endif;

add_filter( 'template_include', 'lorada_load_coming_soon_page', 99 );

/* Remove frameborder Attribute */
function lorada_remove_frameborder( $html, $url ) {
    if ( strpos( $url, 'youtube.com' ) !== false || strpos( $url, 'vimeo.com' ) !== false ) {
        $html = str_replace( 'frameborder="0"', '', $html );
    }

    return $html;
}

add_filter( 'embed_oembed_html', 'lorada_remove_frameborder', 10, 2 );

/* Comments Template */
if ( ! function_exists( 'lorada_comment' ) ) {
	function lorada_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>

		<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

			<div class="comment-body">
				<div class="img-thumbnail">
					<?php echo get_avatar( $comment, 100 ); ?>
				</div>

				<div class="comment-block">
					<div class="comment-info">
						<span class="comment-by"><?php echo get_comment_author_link(); ?></span>
						<div class="comment-date">
							<?php printf( esc_html__( '%1$s at %2$s', 'lorada' ), get_comment_date(),  get_comment_time() ); ?>
						</div>
					</div>
					<div class="comment-text">
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<em><?php echo esc_html__( 'Your comment is awaiting moderation.', 'lorada' ); ?></em>
							<br />
						<?php endif; ?>
						<?php comment_text() ?>
					</div>
					<div class="comment-action">
						<span><?php edit_comment_link( esc_html__( 'Edit', 'lorada' ), '  ', '' ); ?></span>
						<span><?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'lorada' ), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
					</div>
				</div>
			</div>

		</li>

		<?php
	}
}

/* Enqueue Comment JS */
if ( ! function_exists( 'lorada_enqueue_comment_reply' ) ) {
	add_action( 'comment_form_before', 'lorada_enqueue_comment_reply' );

	function lorada_enqueue_comment_reply() {
		if ( get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

/* Register required plugins */
if ( ! function_exists( 'lorada_register_required_plugins' ) ) {
	add_action( 'tgmpa_register', 'lorada_register_required_plugins' );

	function lorada_register_required_plugins() {
		$plugins = array(
			array(
				'name'					=> 'Lorada Core',
				'slug'					=> 'lorada-core',
				'source'				=> 'http://c-themes.com/download-files/lorada-core.zip',
				'required'				=> true,
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'version'				=> '2.1.0',
				'image_url'				=> LORADA_URI . '/images/plugins/lorada_core.jpg',
				'check_str'				=> 'Lorada_Core'
			),
			array(
				'name'					=>	'Redux Framework',
				'slug'					=>	'redux-framework',
				'required'				=>	true,
				'image_url'				=>	LORADA_URI . '/images/plugins/redux_options.jpg',
				'check_str'				=>	'ReduxFramework'
			),
			array(
				'name'					=>	'Elementor',
				'slug'					=>	'elementor',
				'required'				=>	true,
				'image_url'				=>	LORADA_URI . '/images/plugins/elementor.jpg',
				'check_str'				=>	'elementor_fail_wp_version'
			),
			array(
				'name'					=>	'Revolution Slider',
				'slug'					=>	'revslider',
				'source'				=>	'http://c-themes.com/download-files/revslider.zip',
				'required'				=>	true,
				'version'				=>	'6.3.2',
				'force_activation'		=>	false,
				'force_deactivation'	=>	false,
				'image_url'				=>	LORADA_URI . '/images/plugins/revolution_slider.jpg',
				'check_str'				=>	'RevSliderFront'
			),
			array(
				'name'					=>	'WooCommerce',
				'slug'					=>	'woocommerce',
				'required'				=>	true,
				'image_url'				=>	LORADA_URI . '/images/plugins/woocommerce.jpg',
				'check_str'				=>	'WooCommerce'
			),
			array(
				'name'					=>	'WooCommerce Lookbook',
				'slug'					=>	'woocommerce-lookbook',
				'source'				=>	'http://c-themes.com/download-files/woocommerce-lookbook.zip',
				'required'				=>	true,
				'version'				=>	'1.1.4.2',
				'image_url'				=>	LORADA_URI . '/images/plugins/woocommerce_lookbook.jpg',
				'check_str'				=>	'WOO_LOOKBOOK'
			),
			array(
				'name'					=>	'Yith WooCommerce Wishlist',
				'slug'					=>	'yith-woocommerce-wishlist',
				'required'				=>	true,
				'image_url'				=>	LORADA_URI . '/images/plugins/yith_wishlist.jpg',
				'check_str'				=>	'YITH_WCWL'
			),
			array(
				'name'					=>	'Yith WooCommerce Compare',
				'slug'					=>	'yith-woocommerce-compare',
				'required'				=>	true,
				'image_url'				=>	LORADA_URI . '/images/plugins/yith_compare.jpg',
				'check_str'				=>	'YITH_Woocompare'
			),
			array(
				'name'					=>	'CMB2',
				'slug'					=>	'cmb2',
				'required'				=>	true,
				'image_url'				=>	LORADA_URI . '/images/plugins/cmb2.jpg',
				'check_str'				=>	'CMB2_Bootstrap_270'
			),
			array(
				'name'					=>	'Contact Form 7',
				'slug'					=>	'contact-form-7',
				'required'				=>	true,
				'image_url'				=>	LORADA_URI . '/images/plugins/contact_form_7.jpg',
				'check_str'				=>	'WPCF7'
			),
			array(
				'name'					=>	'MailChimp for Wordpress',
				'slug'					=>	'mailchimp-for-wp',
				'required'				=>	true,
				'image_url'				=>	LORADA_URI . '/images/plugins/mailchimp-for-wp.jpg',
				'check_str'				=>	'MC4WP_MailChimp'
			)
		);

		$config = array(
			'default_path'		=> '',
			'menu'				=> 'install-required-plugins',
			'has_notices'		=> true,
			'dismissable'		=> true,
			'dismiss_msg'		=> '',
			'is_automatic'		=> false,
			'message'			=> '',
			'strings'			=> array(
				'page_title'						=> esc_html__( 'Install Required Plugins', 'lorada' ),
				'menu_title'						=> esc_html__( 'Install Plugins', 'lorada' ),
				'installing'						=> esc_html__( 'Installing Plugin: %s', 'lorada' ), // %s = plugin name.
				'oops'								=> esc_html__( 'Something went wrong with the plugin API.', 'lorada' ),
				'notice_can_install_required'		=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'lorada' ), // %1$s = plugin name(s).
				'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'lorada' ), // %1$s = plugin name(s).
				'notice_cannot_install'				=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'lorada' ),
				'notice_can_activate_required'		=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'lorada' ),
				'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'lorada' ),
				'notice_cannot_activate'			=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'lorada' ),
				'notice_ask_to_update'				=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'lorada' ),
				'notice_cannot_update'				=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'lorada' ),
				'install_link'						=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'lorada' ),
				'activate_link'						=> _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'lorada' ),
				'return'							=> esc_html__( 'Return to Required Plugins Installer', 'lorada' ),
				'plugin_activated'					=> esc_html__( 'Plugin activated successfully.', 'lorada' ),
				'complete'							=> esc_html__( 'All plugins installed and activated successfully. %s', 'lorada' ),
				'nag_type'							=> 'updated'
			)
		);

		tgmpa( $plugins, $config );

	}
}
