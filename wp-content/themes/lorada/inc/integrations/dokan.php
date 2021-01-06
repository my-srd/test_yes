<?php
/**
 *	Dokan Compatibility
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'lorada_dokan_register_store_widget' ) ) {
	function lorada_dokan_register_store_widget() {
		return array(
            'name'          => esc_html__( 'Dokan Store Sidebar', 'lorada' ),
            'id'            => 'sidebar-store',
            'before_widget' => '<div id="%1$s" class="sidebar-widget dokan-store-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        );
	}

	add_filter( 'dokan_store_widget_args', 'lorada_dokan_register_store_widget' );
}

if( ! function_exists( 'lorada_dokan_edit_product_wrap_start' ) ) {
    function lorada_dokan_edit_product_wrap_start(){
        echo '<div class="dokan-edit-product-wrap container-fluid" role="main">';
    }
    add_action( 'dokan_dashboard_wrap_before', 'lorada_dokan_edit_product_wrap_start', 10 );
}

if( ! function_exists( 'lorada_dokan_edit_product_wrap_end' ) ) {
    function lorada_dokan_edit_product_wrap_end(){
        echo '</div>';
    }
    add_action( 'dokan_dashboard_wrap_after', 'lorada_dokan_edit_product_wrap_end', 10 );
}