<?php
/**
 * Product Loop Start
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Input products wrapper classes
$classes = array();
$classes[] = 'products product-content-item-wrapper';

$opt_view_style = lorada_get_shop_view_style();
$opt_columns = lorada_get_opt( 'shop_products_columns' );
$woocommerce_loop['display_style'] = $opt_view_style;

if ( $opt_columns && lorada_is_shop_archive() ) {
	$woocommerce_loop['columns'] = $opt_columns;	
}

if ( 'list' == $opt_view_style ) {
	$woocommerce_loop['columns'] = 1;
	$classes[] = 'products-list list-view-method';
} else {
	$classes[] = 'products-grid grid-view-method';
}

$classes = implode( ' ', $classes );
?>

<div class="<?php echo esc_attr( $classes ); ?>" data-source="main_loop">
	<div class="view-method-inner" data-column="<?php echo esc_attr( wc_get_loop_prop( 'columns', $opt_columns ) ); ?>">