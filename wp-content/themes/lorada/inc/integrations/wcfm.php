<?php
/**
 *	WCFM Compatibility
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'lorada_wcfm_dequeue_styles' ) ) {
	function lorada_wcfm_dequeue_styles() {
		if ( class_exists( 'WCFM' ) && lorada_is_shop_archive() ) {
			wp_dequeue_style( 'jquery-ui-style' );
			wp_deregister_style('jquery-ui-style');
		}
	}

	add_action( 'wp_enqueue_scripts', 'lorada_wcfm_dequeue_styles', 10005 );
}