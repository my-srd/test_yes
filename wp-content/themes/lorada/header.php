<?php
/**
 * Main Theme Header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="supports-fontface">
<head>
	<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="profile" href="//gmpg.org/xfn/11">

	<!-- WordPress wp_head() -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<!-- Start Page Wrapper -->
	<div id="page-wrapper" <?php lorada_page_classes(); ?>>
		<?php
		if ( ! empty( lorada_get_opt( 'site_layout' ) ) && 'boxed' == lorada_get_opt( 'site_layout' ) ) {
			?>
			<div class="row">
			<?php
		} else if ( is_singular( 'post' ) && ( 'backstretch' == lorada_get_opt( 'post_view_style' ) ) ) {
			?>
			<div class="row post-backstretch-template">
			<?php
		}

		$header_layout = apply_filters( 'lorada_header_layout', lorada_get_opt( 'header_layout' ) );

		if ( lorada_get_opt( 'top_bar_enable' ) ) {
			lorada_get_template_part( 'header/header', 'topbar' );
		}

		if ( lorada_get_opt( 'sticky_header_setting' ) || 'left_menu_bar' == $header_layout ) :
			echo lorada_sticky_header_clone( $header_layout );
		endif;

		if ( 'left_menu_bar' == $header_layout ) :
			?>
			<div class="lorada-left-menu left-sidebar-menu">
			<?php
		endif;
		?>

		<!-- Header -->
		<header <?php lorada_header_classes( $header_layout ); ?>>
			<?php lorada_generate_header( $header_layout ); ?>
		</header>
		<!-- End Header -->

		<!-- Header Promotion Bar -->
		<?php
		if ( 'left_menu_bar' != $header_layout ) echo lorada_header_bottom_promo_bar();
		?>
		<!-- End Header Promotion Bar -->

		<?php
		if ( 'left_menu_bar' == $header_layout ) :
			?>
			</div>
			<?php
		endif;
