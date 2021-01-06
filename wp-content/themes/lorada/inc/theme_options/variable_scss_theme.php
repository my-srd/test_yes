<?php
/**
 * Theme Option Value Compile
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function lorada_hex2rgb($hex) {
	$hex = str_replace( "#", "", $hex );

	if( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
		$g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
		$b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2, 1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );
	return implode( ",", $rgb );
}

/* Theme Options Values */
$container_max_width = lorada_get_opt( 'container_max_width', 1200 );
$primary_color = lorada_get_opt( 'primary_color', '#cc3333' );
$secondary_color = lorada_get_opt( 'secondary_color', '#339900' );
$site_bg = lorada_get_opt( 'site_background' );
$topbar_bg = lorada_get_opt( 'top_bar_bg_color', '#fff' );
$topbar_txt = lorada_get_opt( 'top_bar_txt_color', '#222' );
$body_font = lorada_get_opt( 'typography-body' );
$nav_font = lorada_get_opt( 'typography-nav' );
$h1_font = lorada_get_opt( 'typography-h1' );
$h2_font = lorada_get_opt( 'typography-h2' );
$h3_font = lorada_get_opt( 'typography-h3' );
$h4_font = lorada_get_opt( 'typography-h4' );
$h5_font = lorada_get_opt( 'typography-h5' );
$h6_font = lorada_get_opt( 'typography-h6' );
$header_width_style = lorada_get_opt( 'header_width_style', 'custom' );
$header_bg = lorada_get_opt( 'header_bg_color' );
$header_max_width = lorada_get_opt( 'header_max_width', 1300 );
$mobile_screen_size = lorada_get_opt( 'mobile_screen_size', 960 );
$header_top_space = lorada_get_opt( 'header_top_spacing', 10 );
$header_bottom_space = lorada_get_opt( 'header_bottom_spacing', 10 );
$header_logo_height = lorada_get_opt( 'logo_height', 23 );
$header_sticky_logo_height = lorada_get_opt( 'sticky_logo_height', 23 );
$logo_padding = lorada_get_opt( 'logo_padding' );
$topbar_width_style = lorada_get_opt( 'topbar_width_style', 'custom' );
$topbar_max_width = lorada_get_opt( 'topbar_max_width', 1300 );
$menu_bg = lorada_get_opt( 'menu_bg_color' );
$submenu_bg = lorada_get_opt( 'sub_menu_bg_color', '#fff' );
$navmenu_align = lorada_get_opt( 'menu_align', 'left' );
$collection_menu_content_bg = lorada_get_opt( 'collection_menu_content_bg', '#fff' );
$collection_menu_bg = lorada_get_opt( 'collection_menu_bg', '#cc3333' );
$collection_menu_title_clr = lorada_get_opt( 'collection_menu_title_clr', '#fff' );
$cart_icon_bg = lorada_get_opt( 'cart_icon_bg', '#f6edea' );
$sitcky_header_bg_clr = lorada_get_opt( 'sitcky_header_bg_clr', '#fff' );
$sticky_header_menu_clr = lorada_get_opt( 'sticky_header_menu_clr', '#222' );
$sticky_header_top_spacing = lorada_get_opt( 'sticky_header_top_spacing', 10 );
$sticky_header_bottom_spacing = lorada_get_opt( 'sticky_header_bottom_spacing', 10 );
$page_heading_top_space = lorada_get_opt( 'page_heading_top_spacing', 110 );
$page_heading_bottom_space = lorada_get_opt( 'page_heading_bottom_spacing', 80 );
$footer_width_style = lorada_get_opt( 'footer_width_style', 'custom' );
$footer_max_width = lorada_get_opt( 'footer_max_width', 1300 );
$footer_bg_clr = lorada_get_opt( 'footer_bg_clr', '#f1f1f1' );
$footer_widget_title = lorada_get_opt( 'footer_widget_title_clr', '#222' );
$footer_widget_text = lorada_get_opt( 'footer_widget_text_clr', '#666' );
$copyright_area_bg = lorada_get_opt( 'copyright_area_bg', '#f1f1f1' );
$copyright_area_text = lorada_get_opt( 'copyright_txt_clr', '#f1f1f1' );
$hot_label_clr = lorada_get_opt( 'hot_label_clr', '#c71414' );
$soldout_label_clr = lorada_get_opt( 'soldout_label_clr', '#3a3a3a' );
?>

// RTL Setting
<?php if ( is_rtl() ) : ?>
$left: right;
$right: left;
<?php else : ?>
$left: left;
$right: right;
<?php endif; ?>

$container_width: <?php echo '' . $container_max_width . 'px'; ?>;
$site_primary_color: <?php echo '' . $primary_color; ?>;
$site_secondary_color: <?php echo '' . $secondary_color; ?>;
$site_background: <?php if(isset( $site_bg['background-color'] ) && ! empty( $site_bg['background-color'] )) { echo '' . $site_bg['background-color']; } ?> <?php if(isset( $site_bg['background-image'] ) && ! empty( $site_bg['background-image'] )): ?>url( <?php echo '' . $site_bg['background-image'] ?>) <?php if(isset( $site_bg['background-position'] ) && ! empty( $site_bg['background-position'] )) { echo '' . $site_bg['background-position'] . '/'; } else { echo 'left top / '; } ?> <?php if(isset( $site_bg['background-size'] ) && ! empty( $site_bg['background-size'] ) && 'inherit' != $site_bg['background-size'] ) { echo '' . $site_bg['background-size']; } else { echo 'auto'; } ?> <?php if(isset( $site_bg['background-repeat'] ) && ! empty( $site_bg['background-repeat'] )) { echo '' . $site_bg['background-repeat']; } else { echo 'repeat'; } ?> <?php if(isset( $site_bg['background-attachment'] ) && ! empty( $site_bg['background-attachment'] )) { echo '' . $site_bg['background-attachment']; } else { 'scroll'; } endif;?>;
$site_solid_background: <?php if (isset( $site_bg['background-color'] ) && ! empty( $site_bg['background-color'] )) { echo '' . $site_bg['background-color']; } ?>;
$site_background_opacity: <?php if (isset( $site_bg['background-color'] ) && ! empty( $site_bg['background-color'] )) { echo 'rgba(' . lorada_hex2rgb( $site_bg['background-color'] ) . ', .85)'; } ?>;
$topbar_bg_color: <?php echo '' . $topbar_bg; ?>;
$topbar_txt_color: <?php echo '' . $topbar_txt; ?>;
$body_font_family: <?php if ( isset( $body_font['font-family'] ) && '' != $body_font['font-family'] ) { echo '' . $body_font['font-family']; } else { echo 'inherit'; } ?>;
$body_font_weight: <?php if ( isset( $body_font['font-weight'] ) && '' != $body_font['font-weight'] ) { echo '' . $body_font['font-weight']; }
	else { echo 'initial'; } ?>;
$body_font_size: <?php if ( isset( $body_font['font-size'] ) && '' != $body_font['font-size'] ) { echo '' . $body_font['font-size']; }
	else { echo '15px'; } ?>;
$body_font_line_height: <?php if ( isset( $body_font['line-height'] ) && '' != $body_font['line-height'] ) { echo '' . $body_font['line-height']; } else { echo 'inherit'; } ?>;
$body_font_color: <?php if ( isset( $body_font['color'] ) && '' != $body_font['color'] ) { echo '' . $body_font['color']; } else { echo 'inherit'; } ?>;
$nav_font_family: <?php if ( isset( $nav_font['font-family'] ) && '' != $nav_font['font-family'] ) { echo '' . $nav_font['font-family']; } else { echo 'inherit'; } ?>;
$nav_font_weight: <?php if ( isset( $nav_font['font-weight'] ) && '' != $nav_font['font-weight'] ) { echo '' . $nav_font['font-weight']; }
	else { echo 'initial'; } ?>;
$nav_font_size: <?php if ( isset( $nav_font['font-size'] ) && '' != $nav_font['font-size'] ) { echo '' . $nav_font['font-size']; }
	else { echo '15px'; } ?>;
$nav_font_color: <?php if ( isset( $nav_font['color'] ) && '' != $nav_font['color'] ) { echo '' . $nav_font['color']; } else { echo 'inherit'; } ?>;
$nav_icon_hover_color: <?php if ( isset( $nav_font['color'] ) && '' != $nav_font['color'] ) { echo 'rgba(' . lorada_hex2rgb( $nav_font['color'] ) . ', .6)'; } else { echo 'inherit'; } ?>;
$nav_border_color: <?php if ( isset( $nav_font['color'] ) && '' != $nav_font['color'] ) { echo 'rgba(' . lorada_hex2rgb( $nav_font['color'] ) . ', .15)'; } else { echo 'inherit'; } ?>;
$h1_font_family: <?php if ( isset( $h1_font['font-family'] ) && '' != $h1_font['font-family'] ) { echo '' . $h1_font['font-family']; } else { echo 'inherit'; } ?>;
$h1_font_weight: <?php if ( isset( $h1_font['font-weight'] ) && '' != $h1_font['font-weight'] ) { echo '' . $h1_font['font-weight']; }
	else { echo 'initial'; } ?>;
$h1_font_size: <?php if ( isset( $h1_font['font-size'] ) && '' != $h1_font['font-size'] ) { echo '' . $h1_font['font-size']; }
	else { echo '15px'; } ?>;
$h1_font_line_height: <?php if ( isset( $h1_font['line-height'] ) && '' != $h1_font['line-height'] ) { echo '' . $h1_font['line-height']; } else { echo 'inherit'; } ?>;
$h1_font_color: <?php if ( isset( $h1_font['color'] ) && '' != $h1_font['color'] ) { echo '' . $h1_font['color']; } else { echo 'inherit'; } ?>;
$h2_font_family: <?php if ( isset( $h2_font['font-family'] ) && '' != $h2_font['font-family'] ) { echo '' . $h2_font['font-family']; } else { echo 'inherit'; } ?>;
$h2_font_weight: <?php if ( isset( $h2_font['font-weight'] ) && '' != $h2_font['font-weight'] ) { echo '' . $h2_font['font-weight']; }
	else { echo 'initial'; } ?>;
$h2_font_size: <?php if ( isset( $h2_font['font-size'] ) && '' != $h2_font['font-size'] ) { echo '' . $h2_font['font-size']; }
	else { echo '15px'; } ?>;
$h2_font_line_height: <?php if ( isset( $h2_font['line-height'] ) && '' != $h2_font['line-height'] ) { echo '' . $h2_font['line-height']; } else { echo 'inherit'; } ?>;
$h2_font_color: <?php if ( isset( $h2_font['color'] ) && '' != $h2_font['color'] ) { echo '' . $h2_font['color']; } else { echo 'inherit'; } ?>;
$h3_font_family: <?php if ( isset( $h3_font['font-family'] ) && '' != $h3_font['font-family'] ) { echo '' . $h3_font['font-family']; } else { echo 'inherit'; } ?>;
$h3_font_weight: <?php if ( isset( $h3_font['font-weight'] ) && '' != $h3_font['font-weight'] ) { echo '' . $h3_font['font-weight']; }
	else { echo 'initial'; } ?>;
$h3_font_size: <?php if ( isset( $h3_font['font-size'] ) && '' != $h3_font['font-size'] ) { echo '' . $h3_font['font-size']; }
	else { echo '15px'; } ?>;
$h3_font_line_height: <?php if ( isset( $h3_font['line-height'] ) && '' != $h3_font['line-height'] ) { echo '' . $h3_font['line-height']; } else { echo 'inherit'; } ?>;
$h3_font_color: <?php if ( isset( $h3_font['color'] ) && '' != $h3_font['color'] ) { echo '' . $h3_font['color']; } else { echo 'inherit'; } ?>;
$h4_font_family: <?php if ( isset( $h4_font['font-family'] ) && '' != $h4_font['font-family'] ) { echo '' . $h4_font['font-family']; } else { echo 'inherit'; } ?>;
$h4_font_weight: <?php if ( isset( $h4_font['font-weight'] ) && '' != $h4_font['font-weight'] ) { echo '' . $h4_font['font-weight']; }
	else { echo 'initial'; } ?>;
$h4_font_size: <?php if ( isset( $h4_font['font-size'] ) && '' != $h4_font['font-size'] ) { echo '' . $h4_font['font-size']; }
	else { echo '15px'; } ?>;
$h4_font_line_height: <?php if ( isset( $h4_font['line-height'] ) && '' != $h4_font['line-height'] ) { echo '' . $h4_font['line-height']; } else { echo 'inherit'; } ?>;
$h4_font_color: <?php if ( isset( $h4_font['color'] ) && '' != $h4_font['color'] ) { echo '' . $h4_font['color']; } else { echo 'inherit'; } ?>;
$h5_font_family: <?php if ( isset( $h5_font['font-family'] ) && '' != $h5_font['font-family'] ) { echo '' . $h5_font['font-family']; } else { echo 'inherit'; } ?>;
$h5_font_weight: <?php if ( isset( $h5_font['font-weight'] ) && '' != $h5_font['font-weight'] ) { echo '' . $h5_font['font-weight']; }
	else { echo 'initial'; } ?>;
$h5_font_size: <?php if ( isset( $h5_font['font-size'] ) && '' != $h5_font['font-size'] ) { echo '' . $h5_font['font-size']; }
	else { echo '15px'; } ?>;
$h5_font_line_height: <?php if ( isset( $h5_font['line-height'] ) && '' != $h5_font['line-height'] ) { echo '' . $h5_font['line-height']; } else { echo 'inherit'; } ?>;
$h5_font_color: <?php if ( isset( $h5_font['color'] ) && '' != $h5_font['color'] ) { echo '' . $h5_font['color']; } else { echo 'inherit'; } ?>;
$h6_font_family: <?php if ( isset( $h6_font['font-family'] ) && '' != $h6_font['font-family'] ) { echo '' . $h6_font['font-family']; } else { echo 'inherit'; } ?>;
$h6_font_weight: <?php if ( isset( $h6_font['font-weight'] ) && '' != $h6_font['font-weight'] ) { echo '' . $h6_font['font-weight']; }
	else { echo 'initial'; } ?>;
$h6_font_size: <?php if ( isset( $h6_font['font-size'] ) && '' != $h6_font['font-size'] ) { echo '' . $h6_font['font-size']; }
	else { echo '15px'; } ?>;
$h6_font_line_height: <?php if ( isset( $h6_font['line-height'] ) && '' != $h6_font['line-height'] ) { echo '' . $h6_font['line-height']; } else { echo 'inherit'; } ?>;
$h6_font_color: <?php if ( isset( $h6_font['color'] ) && '' != $h6_font['color'] ) { echo '' . $h6_font['color']; } else { echo 'inherit'; } ?>;
$header_bg_color: <?php if(isset( $header_bg['background-color'] ) && ! empty( $header_bg['background-color'] )) { echo '' . $header_bg['background-color']; } ?> <?php if(isset( $header_bg['background-image'] ) && ! empty( $header_bg['background-image'] )):?>url( <?php echo '' . $header_bg['background-image'] ?>) <?php if(isset( $header_bg['background-position'] ) && ! empty( $header_bg['background-position'] )) { echo '' . $header_bg['background-position'] . '/'; } else { echo 'left top / '; } ?> <?php if(isset( $header_bg['background-size'] ) && ! empty( $header_bg['background-size'] ) && 'inherit' != $header_bg['background-size'] ) { echo '' . $header_bg['background-size']; } else { echo 'auto'; } ?> <?php if(isset( $header_bg['background-repeat'] ) && ! empty( $header_bg['background-repeat'] )) { echo '' . $header_bg['background-repeat']; } else { echo 'repeat'; } ?> <?php if(isset( $header_bg['background-attachment'] ) && ! empty( $header_bg['background-attachment'] )) { echo '' . $header_bg['background-attachment']; } else { 'scroll'; } endif; ?>;
$header_solid_bg_clr: <?php if(isset( $header_bg['background-color'] ) && ! empty( $header_bg['background-color'] )) { echo '' . $header_bg['background-color']; } ?>;
$header_width: <?php if ( isset( $header_width_style ) && ( 'full' == $header_width_style ) ) { echo 'auto'; }
	else { echo '' . $header_max_width . 'px'; } ?>;
$mobile_enable_width: <?php echo '' . $mobile_screen_size . 'px'; ?>;
$header_top_space_val: <?php echo '' . $header_top_space . 'px'; ?>;
$header_bottom_space_val: <?php echo '' . $header_bottom_space . 'px'; ?>;
$header_logo_height_val: <?php echo '' . $header_logo_height . 'px'; ?>;
$sticky_logo_height_val: <?php echo '' . $header_sticky_logo_height . 'px'; ?>;
$logo_padding_top: <?php if ( isset( $logo_padding['padding-top'] ) && ( '' != $logo_padding['padding-top'] ) ) { echo '' . $logo_padding['padding-top']; }
	else { echo '0px'; } ?>;
$logo_padding_bottom: <?php if ( isset( $logo_padding['padding-bottom'] ) && ( '' != $logo_padding['padding-bottom'] ) ) { echo '' . $logo_padding['padding-bottom']; } else { echo '0px'; } ?>;
$logo_padding_left: <?php if ( isset( $logo_padding['padding-left'] ) && ( '' != $logo_padding['padding-left'] ) ) { echo '' . $logo_padding['padding-left']; } else { echo '0px'; } ?>;
$logo_padding_right: <?php if ( isset( $logo_padding['padding-right'] ) && ( '' != $logo_padding['padding-right'] ) ) { echo '' . $logo_padding['padding-right']; } else { echo '0px'; } ?>;
$topbar_width: <?php if ( isset( $topbar_width_style ) && ( 'full' == $topbar_width_style ) ) { echo 'auto'; }
	else { echo '' . $topbar_max_width . 'px'; } ?>;
$menu_bg_color: <?php if(isset( $menu_bg['background-color'] ) && ! empty( $menu_bg['background-color'] )) { echo '' . $menu_bg['background-color']; } ?> url(<?php if(isset( $header_bg['background-image'] ) && ! empty( $header_bg['background-image'] )) echo '' . $menu_bg['background-image'] ?>) <?php if(isset( $menu_bg['background-position'] ) && ! empty( $menu_bg['background-position'] )) { echo '' . $menu_bg['background-position'] . '/'; } else { echo 'left top / '; } ?> <?php if(isset( $menu_bg['background-size'] ) && ! empty( $menu_bg['background-size'] ) && 'inherit' != $menu_bg['background-size'] ) { echo '' . $menu_bg['background-size']; } else { echo 'auto'; } ?> <?php if(isset( $menu_bg['background-repeat'] ) && ! empty( $menu_bg['background-repeat'] )) { echo '' . $menu_bg['background-repeat']; } else { echo 'repeat'; } ?> <?php if(isset( $menu_bg['background-attachment'] ) && ! empty( $menu_bg['background-attachment'] )) { echo '' . $menu_bg['background-attachment']; } else { 'scroll'; } ?>;
$submenu_bg_color: <?php echo '' . $submenu_bg; ?>;
$navmenu_align_val: <?php echo '' . $navmenu_align; ?>;
$collection_menu_content_bg_color: <?php echo '' . $collection_menu_content_bg; ?>;
$collection_menu_bg_color: <?php echo '' . $collection_menu_bg; ?>;
$collection_menu_title_color: <?php echo '' . $collection_menu_title_clr; ?>;
$cart_icon_bg_color: <?php echo '' . $cart_icon_bg; ?>;
$sitcky_header_bg_color: <?php echo '' . $sitcky_header_bg_clr; ?>;
$sticky_header_menu_color: <?php echo '' . $sticky_header_menu_clr; ?>;
$sticky_nav_icon_hover_color: <?php if ( isset( $sticky_header_menu_clr ) && ( '' != $sticky_header_menu_clr ) ) { echo 'rgba(' . lorada_hex2rgb( $sticky_header_menu_clr ) . ', .6)'; } else { echo '#fff'; } ?>;
$sticky_header_top_spacing_val: <?php echo '' . $sticky_header_top_spacing . 'px'; ?>;
$sticky_header_bottom_spacing_val: <?php echo '' . $sticky_header_bottom_spacing . 'px'; ?>;
$page_heading_top_space_val: <?php echo '' . $page_heading_top_space . 'px'; ?>;
$page_heading_bottom_space_val: <?php echo '' . $page_heading_bottom_space . 'px'; ?>;
$footer_width: <?php if ( isset( $footer_width_style ) && ( 'full' == $footer_width_style ) ) { echo 'auto'; }
	else { echo '' . $footer_max_width . 'px'; } ?>;
$footer_bg_color: <?php echo '' . $footer_bg_clr; ?>;
$footer_widget_title_color: <?php echo '' . $footer_widget_title; ?>;
$footer_widget_text_color: <?php echo '' . $footer_widget_text; ?>;
$footer_split_line: <?php if ( isset( $footer_widget_text ) && ( '' != $footer_widget_text ) ) { echo 'rgba(' . lorada_hex2rgb( $footer_widget_text ) . ', .2)'; } else { echo '#fff'; } ?>;
$copyright_area_bg_color: <?php echo '' . $copyright_area_bg; ?>;
$copyright_area_text_color: <?php echo '' . $copyright_area_text; ?>;
$hot_label_bg_color: <?php echo '' . $hot_label_clr; ?>;
$soldout_label_bg_color: <?php echo '' . $soldout_label_clr; ?>;
