<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$delimiter = '';

if ( ! empty( $breadcrumb ) ) {

	echo '' . $wrap_before;

	$count = count($breadcrumb);

	$i = 0;
	$class = '';

	foreach ( $breadcrumb as $key => $crumb ) {

		$i++;

		if( $i == $count - 1 ) {
			$class = 'breadcrumb-link-last';
		}

		echo '' . $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '" class="breadcrumb-link ' . $class . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo '<span class="breadcrumb-last"> ';
			echo esc_html( $crumb[0] );
			echo '</span>';
		}

		echo '' . $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '' . $delimiter;
		}

	}

	echo '' . $wrap_after;

}
