<?php
class LoradaCustomMenu {
	function __construct() {
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_nav_fields' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'update_custom_nav_fields'), 10, 3 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'edit_custom_walker'), 10, 2 );
	} // end constructor
	
	function add_custom_nav_fields( $menu_item ) {
		$menu_item->menu_style = get_post_meta( $menu_item->ID, '_menu_item_style', true );
		$menu_item->menu_width = get_post_meta( $menu_item->ID, '_menu_item_width', true );
		$menu_item->menu_height = get_post_meta( $menu_item->ID, '_menu_item_height', true );
		$menu_item->menu_background = get_post_meta( $menu_item->ID, '_menu_item_background', true );
		$menu_item->menu_icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
		$menu_item->menu_block = get_post_meta( $menu_item->ID, '_menu_item_block', true );
		$menu_item->menu_marker = get_post_meta( $menu_item->ID, '_menu_item_marker', true );
		$menu_item->submenu_text_scheme = get_post_meta( $menu_item->ID, '_submenu_text_scheme', true );

		return $menu_item;
	}
	
	function update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
		if ( isset( $_REQUEST['menu-item-style'][$menu_item_db_id] ) ) {
			$menu_item_style = $_REQUEST['menu-item-style'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_style', $menu_item_style );
		} else {
			delete_post_meta( $menu_item_db_id, '_menu_item_style' );
		}

		if ( isset( $_REQUEST['menu-item-width'][$menu_item_db_id] ) ) {
			$menu_item_width = $_REQUEST['menu-item-width'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_width', $menu_item_width );
		} else {
			delete_post_meta( $menu_item_db_id, '_menu_item_width' );
		}

		if ( isset( $_REQUEST['menu-item-height'][$menu_item_db_id] ) ) {
			$menu_item_height = $_REQUEST['menu-item-height'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_height', $menu_item_height );
		} else {
			delete_post_meta( $menu_item_db_id, '_menu_item_height' );
		}

		if ( isset( $_REQUEST['menu-item-background'][$menu_item_db_id] ) ) {
			$menu_item_background = $_REQUEST['menu-item-background'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_background', $menu_item_background );
		} else {
			delete_post_meta( $menu_item_db_id, '_menu_item_background' );
		}

		if ( isset( $_REQUEST['menu-item-icon'][$menu_item_db_id] ) ) {
			$menu_item_icon = $_REQUEST['menu-item-icon'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_icon', $menu_item_icon );
		} else {
			delete_post_meta( $menu_item_db_id, '_menu_item_icon' );
		}

		if ( isset( $_REQUEST['menu-item-block'][$menu_item_db_id] ) ) {
			$menu_item_block = $_REQUEST['menu-item-block'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_block', $menu_item_block );
		} else {
			delete_post_meta( $menu_item_db_id, '_menu_item_block' );
		}

		if ( isset( $_REQUEST['menu-item-marker'][$menu_item_db_id] ) ) {
			$menu_item_marker = $_REQUEST['menu-item-marker'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_marker', $menu_item_marker );
		} else {
			delete_post_meta( $menu_item_db_id, '_menu_item_marker' );
		}

		if ( isset( $_REQUEST['submenu-text-scheme'][$menu_item_db_id] ) ) {
			$submenu_text_scheme = $_REQUEST['submenu-text-scheme'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_submenu_text_scheme', $submenu_text_scheme );
		} else {
			delete_post_meta( $menu_item_db_id, '_submenu_text_scheme' );
		}
	}
	
	function edit_custom_walker( $walker, $menu_id ) {
		return 'LoradaMenuEditCustom';
	}

}

$GLOBALS['sweet_custom_menu'] = new LoradaCustomMenu();

include_once( 'edit-custom-walker.php' );
include_once( 'custom-walker.php' );