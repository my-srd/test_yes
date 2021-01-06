<?php
/**
 *	WCMp Compatibility
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'lorada_wcmp_dequeue_styles' ) ) {
	function lorada_wcmp_dequeue_styles() {
		if ( class_exists( 'WCMp' ) && is_vendor_dashboard() && ( is_user_wcmp_vendor( get_current_user_id() ) || is_user_wcmp_pending_vendor( get_current_user_id() ) || is_user_wcmp_rejected_vendor( get_current_user_id() ) ) ) {
			// wp_dequeue_style( 'wcmp-bootstrap-style' );
			// wp_deregister_style('wcmp-bootstrap-style');
		}
	}

	add_action( 'wp_enqueue_scripts', 'lorada_wcmp_dequeue_styles', 10005 );
}