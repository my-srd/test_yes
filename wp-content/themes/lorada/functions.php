<?php
/**
 * Lorada Main Theme Functions
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LORADA_DIR',			get_template_directory() );
define( 'LORADA_URI',			get_template_directory_uri() );
define( 'LORADA_LIB', 			LORADA_DIR . '/inc' );
define( 'LORADA_TEMP',			LORADA_DIR . '/templates' );
define( 'LORADA_ADMIN', 		LORADA_LIB . '/admin' );

/* Include PHP files */
if ( class_exists( 'ReduxFramework' ) && ! isset( $redux_demo )  && file_exists( LORADA_LIB . '/theme_options/lorada.config.php' ) ) {
	require_once( LORADA_LIB . '/theme_options/lorada.config.php' );
}
require_once( LORADA_LIB . '/class-tgm-plugin-activation.php' );
require_once( LORADA_LIB . '/functions.php' );

/* Include Vendor integrations */
if ( class_exists( 'WeDevs_Dokan' ) ) {
	require_once( LORADA_LIB . '/integrations/dokan.php' );
}
if ( class_exists( 'WCFM' ) ) {
	require_once( LORADA_LIB . '/integrations/wcfm.php' );
}
if ( class_exists( 'WCMp' ) ) {
	require_once( LORADA_LIB . '/integrations/wcmp.php' );
}

/* Include Admin Theme Page */
if ( is_admin() ) {
	include_once( LORADA_ADMIN . '/admin.php' );
}

/* Lorada theme setup */
if ( ! function_exists( 'lorada_theme_setup' ) ) {
	function lorada_theme_setup() {
		require_once( LORADA_LIB . '/helper.php' );
		require_once( LORADA_LIB . '/multiple-sidebars.php' );

		if ( is_multisite() ) {
			update_site_option( 'fileupload_maxk', 1024 * 32 );
		}

		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );

		// Add support for Gutenberg
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-style' );
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => _x( 'Small', 'Name of the small font size in the block editor', 'lorada' ),
					'shortName' => _x( 'S', 'Short name of the small font size in the block editor.', 'lorada' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => _x( 'Regular', 'Name of the regular font size in the block editor', 'lorada' ),
					'shortName' => _x( 'M', 'Short name of the regular font size in the block editor.', 'lorada' ),
					'size'      => 21,
					'slug'      => 'normal',
				),
				array(
					'name'      => _x( 'Large', 'Name of the large font size in the block editor', 'lorada' ),
					'shortName' => _x( 'L', 'Short name of the large font size in the block editor.', 'lorada' ),
					'size'      => 26.25,
					'slug'      => 'large',
				),
				array(
					'name'      => _x( 'Larger', 'Name of the larger font size in the block editor', 'lorada' ),
					'shortName' => _x( 'XL', 'Short name of the larger font size in the block editor.', 'lorada' ),
					'size'      => 32,
					'slug'      => 'larger',
				),
			)
		);

		// support WooCommerce
		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width'			=>	350,
			'gallery_thumbnail_image_width'	=>	150,
			'single_image_width'			=>	900
		) );

		add_theme_support( 'wc-product-gallery-lightbox' );

		// load theme text domain - multi-language
		load_theme_textdomain( 'lorada', LORADA_DIR . '/languages' );

		// Register additional image sizes
		add_image_size( 'lorada-blog-thumnail', 750, 570, true );
		add_image_size( 'lorada-blog-thumnail2', 750, 1012, true );
		add_image_size( 'lorada-blog-thumnail-list', 1170, 370, true );
		add_image_size( 'lorada-single-post', 1170, 670, true );
		add_image_size( 'lorada-product-cat-thumb', 760, 760, true );
		add_image_size( 'lorada-map-marker', 42, 42, true );

		if ( ! isset( $content_width ) ) $content_width = 1140;
	}
}
add_action( 'after_setup_theme', 'lorada_theme_setup' );

/* CPT Support */
if ( ! function_exists( 'lorada_cpt_support' ) ) {
	function lorada_cpt_support() {
		$cpt_support = ['post', 'page', 'product', 'html_block'];

        update_option( 'elementor_cpt_support', $cpt_support);
		update_option( 'elementor_container_width', '1270');
        update_option( 'elementor_space_between_widgets', '0');
	}
}
add_action( 'after_switch_theme', 'lorada_cpt_support' );

/* Init lorada theme */
if ( ! function_exists( 'lorada_init' ) ) {
	function lorada_init() {
		require_once( LORADA_LIB . '/custom-menu/custom-menu.php' );
		require_once( LORADA_LIB . '/custom-menu/mobile-sticky-toolbar.php' );
		require_once( LORADA_TEMP . '/header/element-functions.php' );

		if ( class_exists( 'WooCommerce' ) ) {
			require_once( LORADA_LIB . '/woocommerce.php' );
		}

		// Scss compile actions
		add_action( 'redux/options/lorada_theme_options/saved', 'lorada_compile_theme_css', 10 );
		add_action( 'redux/options/lorada_theme_options/import', 'lorada_compile_theme_css', 10 );
		add_action( 'redux/options/lorada_theme_options/reset', 'lorada_compile_theme_css', 10 );
		add_action( 'redux/options/lorada_theme_options/section/reset', 'lorada_compile_theme_css', 10 );

		// Register Menu
		register_nav_menus( array(
			'main-navigation'			=>	esc_html__( 'Main Navigation', 'lorada' ),
			'mobile-side-navigation'	=>	esc_html__( 'Mobile Side Navigation', 'lorada' ),
			'top-bar-menu'				=>	esc_html__( 'Top Bar Right Menu', 'lorada' )
		) );
	}
}
add_action( 'init', 'lorada_init' );

/**/

/* Register lorada widget area */
if ( ! function_exists( 'lorada_register_sidebar' ) ) {
	function lorada_register_sidebar() {
		register_sidebar( array(
			'name'			=>	esc_html__( 'Header Widget Area', 'lorada' ),
			'id'			=>	'lorada-header-widget',
			'description'	=>	esc_html__( 'Widgets in this area will be shown on the header.', 'lorada' ),
			'before_widget'	=>	'<div id="%1$s" class="header-widget %2$s">',
			'after_widget'	=>	'</div>',
			'before_title'	=>	'<h2 class="widget-title">',
			'after_title'	=>	'</h2>',
		) );

		register_sidebar( array(
			'name'			=>	esc_html__( 'Shop Sidebar', 'lorada' ),
			'id'			=>	'lorada-shop-sidebar',
			'description'	=>	esc_html__( 'Widgets in this area will be shown on the sidebar of Shop page.', 'lorada' ),
			'before_widget'	=>	'<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'	=>	'</div>',
			'before_title'	=>	'<h2 class="widget-title">',
			'after_title'	=>	'</h2>',
		) );

		register_sidebar( array(
			'name'			=>	esc_html__( 'Single Product Sidebar', 'lorada' ),
			'id'			=>	'lorada-single-product-sidebar',
			'description'	=>	esc_html__( 'Widgets in this area will be shown on the sidebar of single product page.', 'lorada' ),
			'before_widget'	=>	'<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'	=>	'</div>',
			'before_title'	=>	'<h2 class="widget-title">',
			'after_title'	=>	'</h2>',
		) );

		register_sidebar( array(
			'name'			=>	esc_html__( 'Blog Sidebar', 'lorada' ),
			'id'			=>	'lorada-blog-sidebar',
			'description'	=>	esc_html__( 'Widgets in this area will be shown on the sidebar of Blog page.', 'lorada' ),
			'before_widget'	=>	'<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'	=>	'</div>',
			'before_title'	=>	'<h2 class="widget-title">',
			'after_title'	=>	'</h2>',
		) );

		register_sidebar( array(
			'name'			=>	esc_html__( 'Post Sidebar', 'lorada' ),
			'id'			=>	'lorada-post-sidebar',
			'description'	=>	esc_html__( 'Widgets in this area will be shown on the sidebar of single post page.', 'lorada' ),
			'before_widget'	=>	'<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'	=>	'</div>',
			'before_title'	=>	'<h2 class="widget-title">',
			'after_title'	=>	'</h2>',
		) );

		$footer_layout = lorada_get_opt( 'footer_layout', 'footer_four_col' );

		$footer_layout_config = lorada_footer_configuration( $footer_layout );

		if ( 1 < $footer_layout_config['column'] ) {

			foreach ( $footer_layout_config['column'] as $key => $columns ) {
				$column_index = $key + 1;

				register_sidebar( array(
					'name'			=>	esc_html__( 'Footer Widget Column ' . $column_index, 'lorada' ),
					'id'			=>	'lorada-footer-widget-' . $column_index,
					'description'	=>	esc_html__( 'Widgets in this area will be shown on the main footer.', 'lorada' ),
					'before_widget'	=>	'<div id="%1$s" class="footer-widget %2$s">',
					'after_widget'	=>	'</div>',
					'before_title'	=>	'<h2 class="widget-title">',
					'after_title'	=>	'</h2>',
				) );
			}

		}
	}
}
add_action( 'widgets_init', 'lorada_register_sidebar' );
