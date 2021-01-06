<?php
/**
 * Lorada Theme Help Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* Get parent theme name */
if ( ! function_exists( 'lorada_parent_theme_name' ) ) {
	function lorada_parent_theme_name() {
		$actived_theme = wp_get_theme();

		if ( $actived_theme->parent() ):
			$theme_name = $actived_theme->parent()->get( 'Name' );
		else:
			$theme_name = $actived_theme->get( 'Name' );
		endif;

		return $theme_name;
	}
}

/* Get Theme Version */
if ( ! function_exists( 'lorada_theme_version' ) ) {
	function lorada_theme_version() {
		$lorada_theme = wp_get_theme();
		return $lorada_theme->get( 'Version' );
	}
}

/* Get Theme Author */
if ( ! function_exists( 'lorada_theme_author' ) ) {
	function lorada_theme_author() {
		$lorada_theme = wp_get_theme();
		return $lorada_theme->get( 'Author' );
	}
}

/* Get Theme Option Value */
if ( ! function_exists( 'lorada_get_opt' ) ) {
	function lorada_get_opt( $slug, $default = false ) {
		global $lorada_theme_options;
		
		$page_id = get_the_ID();

		if ( class_exists( 'WooCommerce' ) && is_shop() ) {
			$page_for_shop = get_option( 'woocommerce_shop_page_id' );
			$page_id = $page_for_shop;
		}

		if ( is_home() ) {
			$page_for_posts_id = get_option('page_for_posts');
			$page_id = $page_for_posts_id;
		}

		$lorada_opt_val = isset( $lorada_theme_options[ $slug ] ) ? $lorada_theme_options[ $slug ] : '';
		$lorada_opt_metabox_val = get_post_meta( $page_id, '_lorada_' . $slug, true );

		if ( ! empty( $lorada_opt_metabox_val ) && ( 'inherit' != $lorada_opt_metabox_val ) ) {
			$lorada_opt_val = $lorada_opt_metabox_val;
		}

		if ( empty( $lorada_opt_val ) && ! empty( $default ) ) {
			$lorada_opt_val = $default;
		}

		return $lorada_opt_val;
	}
}

/* Get template part (for templates like the shop-loop) */
if ( ! function_exists( 'lorada_get_template_part' ) ) { 
	function lorada_get_template_part( $slug, $name = '' ) { 
		$template = '';
		$file_name = '';

		if ( $name ) { 
			$file_name = "{$slug}-{$name}.php";
		} else { 
			$file_name = "{$slug}.php";
		}

		// check if templates/slug-name.php file exists
		$template = locate_template( 'templates/' . $file_name );

		// Allow 3rd party plugins to filter template file from their plugin.
		$template = apply_filters( 'lorada_get_template_part', $template, $slug, $name );

		if ( $template ) {
			load_template( $template, false );
		}
	}
}

/* Conditional Tag : Check if ajax call */
if ( ! function_exists( 'lorada_is_ajax' ) ) { 
	function lorada_is_ajax() { 
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
			return 'wp-ajax';
		}

		if ( isset( $_REQUEST['ld_ajax'] ) ) { 
			return 'ld-ajax';
		}

		return false;
	}
}

/* Strip variable tags */
if ( ! function_exists( 'lorada_strip_tags' ) ) {
	function lorada_strip_tags( $content ) {
		$content = str_replace( ']]>', ']]&gt;', $content );
		$temp = preg_replace( array( "/<script.*?\/script>/s", "/<style.*?\/style>/s" ), "", $content );
		if ( NULL !== $temp ) { 
			$content = $temp;
		}
		$content = strip_tags( $content );

		return $content;
	}
}