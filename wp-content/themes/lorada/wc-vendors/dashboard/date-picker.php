<?php
/**
 * Date picker Template
 *
 * @author        Jamie Madden, WC Vendors
 * @package       WCVendors/Templates/dashboard
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form method="post" class="wcv-form-date-filter">
	<div class="date-from">
		<label for="from"><?php _e( 'From:', 'lorada' ); ?></label>
		<input class="date-pick" type="date" name="start_date" id="from"
		       value="<?php echo esc_attr( gmdate( 'Y-m-d', $start_date ) ); ?>"/>
	</div>

	<div class="date-to">
		<label for="to"><?php _e( 'To:', 'lorada' ); ?></label>
		<input type="date" class="date-pick" name="end_date" id="to"
		       value="<?php echo esc_attr( gmdate( 'Y-m-d', $end_date ) ); ?>"/>
	</div>

	<input type="submit" class="btn btn-inverse btn-small" value="<?php _e( 'Show', 'lorada' ); ?>"/>
</form>
