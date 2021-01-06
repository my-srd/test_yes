<?php

function ecommerce_plus_custom_css(){

$option 			= ecommerce_plus_get_theme_options();

$color 				= esc_attr($option['primary_color']);
$link_color 		= esc_attr($option['link_color']);
$button_color 		= $color;
$text_color 		= esc_attr($option['text_color']);
$link_hover_color 	= esc_attr($option['link_hover_color']);
$header_bg_color	= esc_attr($option['header_bg_color']);
$accent_color		= esc_attr($option['accent_color']);


$css = '

	/* CUSTOM FONTS */
	
	body {
		font-family: "'.$option['body_font'].'", sans-serif;
	}
	
	h1,	h2,	h3,	h4,	h5,	h6, .theme-section-title {
		clear: both;
		margin: 16px 0;
		line-height: 1.2;
		font-weight: 400;
		font-family: "'.$option['heading_font'].'", sans-serif;
	}
	
	
	.site-title,
	.post-navigation a, 
	.posts-navigation a,
	.post-navigation span,
	.posts-navigation span,	
	.pagination .page-numbers,
	.pagination .page-numbers.dots:hover,
	.pagination .page-numbers.dots:focus,
	.post-navigation span,
	.posts-navigation span,
	.jetpack_subscription_widget input[type="submit"],
	.jetpack_subscription_widget button[type="submit"],
	.widget_popular_post a time,
	.widget_popular_post time,
	.widget_latest_post a time,
	.widget_latest_post time,
	.widget_featured_post a time,
	.widget_featured_post time,
	.reply a,
	.section-subtitle,
	.trail-items li,
	ul.filter-tabs li a,
	.post-categories a,
	.posted-on a,
	#masthead .login-register a,
	.main-navigation ul.nav-menu > li > a {
		font-family: "'.$option['heading_font'].'", sans-serif;
	}
	
	
	/*----------------
	# Color Options
	-----------------*/
	
	#masthead {
		background: '.$header_bg_color.';
	}
	
	.amount-cart {
    	color: #fff;
    	background: '.$link_color.';
	}
	
	.amount-cart::before {
		border-right: 7px solid '.$link_color.';
	}	
	.cart-contents span.count {
    	color: #fff;
    	background: '.$link_color.';
	}

	
	.header-icon-container a {
		
	}
	
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active {
		border-bottom-color:  '.$color.';  
	}
	
	.woocommerce span.onsale, 
	.my-yith-wishlist .button.yith-wcqv-button::before, 
	.my-yith-wishlist .compare-button a::before,
	.my-yith-wishlist .yith-wcwl-add-button .add_to_wishlist::before,
	.my-yith-wishlist .yith-wcwl-wishlistexistsbrowse a::before, 
	.my-yith-wishlist .yith-wcwl-wishlistaddedbrowse a::before {
		background-color: '.$color.';		
	}
	
	.product-wrapper .badge-wrapper .onsale {
		background-color: '.$color.';	
	}
	
	.glyphicon-menu-left::before, 
	.glyphicon-menu-right::before {
		background-color: '.$color.';
		border-radius: 24px;
	}

	.carousel-indicators .active {
		background-color: '.$color.';
		border: 1px solid '.$color.';
	}
	
	.carousel-control:hover .glyphicon-menu-left::before,
	.carousel-control:focus .glyphicon-menu-left::before,
	.carousel-control:hover .glyphicon-menu-right::before, 
	.carousel-control:focus .glyphicon-menu-right::before {
		background-color: '.$accent_color.';
	}	
		
		
	/*
	 * Text Color
	 */

	body {
		color: '.$text_color.';	
	} 
	
	.woocommerce ul.products li.product .price,
	.woocommerce div.product p.price, 
	.woocommerce div.product span.price {
		color: '.$text_color.';	
	}

	/* 
	 *	button color 
	 */
	 
	#masthead .login-register a {
		background-color: '.$button_color.';
		border: 2px solid '.$button_color.';	
	}

	
	#respond input[type="submit"],
	input[type="submit"] {	
		background-color: '.$button_color.';
		color: #fff;
	}
	
	.btn {
		background-color: '.$button_color.';
	}
		
	.widget_search form.search-form .search-submit, 
	.widget_search form.search-form .search-submit {
		background-color: '.$button_color.';
		color: #fff;
	}
	
	
	.backtotop {
		background-color: '.$button_color.';
		color: #fff;
	}

	
	/* hover & focus */

	
	
	#masthead .main-navigation .login-register a:hover,
	#masthead .main-navigation .login-register a:focus {
		background-color: '.$accent_color.';
		border: 2px solid '.$accent_color.';
		color: #fff;
	}
	
	#respond input[type="submit"]:hover,
	input[type="submit"]:focus {	
		background-color: '.$accent_color.';
		color: #fff;
	}
	
	.btn:focus,
	.btn:hover {
		background-color: '.$accent_color.';
		color:#fff;
	}
	
	.reply a:focus, 
	.reply a:hover {
		background-color: '.$accent_color.';
		color:#fff;	
	}
		
	.widget_search form.search-form .search-submit:focus, 
	.widget_search form.search-form .search-submit:hover {
		background-color: '.$accent_color.';

	}
	
	.backtotop:hover,
	.backtotop:focus {
		background-color: '.$accent_color.';
		color: #fff;
	}
	
	.post-edit-link:hover,
	.post-edit-link:focus {
		background-color: '.$accent_color.';
		color: #fff;	
	}
	
	/* Link Hover */
	
	a:hover,
	a:focus {
		color: '.$link_hover_color.';
		text-decoration: none;
	}

	.post-categories a:hover,
	.post-categories a:focus {
		color: '.$link_hover_color.';
		text-transform:uppercase;
	}
	
	.posted-on a:hover,
	.posted-on a:focus{
		color: '.$link_hover_color.';
	}
	
	.single .post-categories a:hover,
	.single .post-categories a:focus,
	.single .byline a:hover
	.single .byline a:focus, {
		color: '.$link_hover_color.';
	}

		
			
	/* 
	 * link color 
	 */
	
	a {
		color: '.$link_color.';
		text-decoration: none;
	}

	.post-categories a {
		color: '.$link_color.';
		text-transform:uppercase;
	}
	
	.posted-on a {
		color: '.$link_color.';
	}
	
	.single .post-categories a,
	.single .byline a {
		color: '.$link_color.';
	}

	.jetpack_subscription_widget input[type="submit"],
	.jetpack_subscription_widget button[type="submit"] {
		background-color: '.$color.';
		color: #fff;
	}

	.widget_popular_post a time,
	.widget_popular_post time,
	.widget_latest_post a time,
	.widget_latest_post time,
	.widget_featured_post a time,
	.widget_featured_post time {
		color: '.$color.';
	}
	
	.widget svg {
		fill: '.$color.';
	}

	.section-subtitle {
		color: '.$color.';
	}
	
	.reply a {
		background-color: '.$color.';
		color: #fff;
	}

	
	.single .posted-on a {
		background-color: '.$color.';
		color: #fff;
	}
	
	
	/*
	 * Menu
	 */
	 
	.main-navigation ul#primary-menu li.current-menu-item > a,
	.main-navigation ul#primary-menu li:hover > a {
		color: '.$accent_color.';
	}


	#masthead .main-navigation ul.nav-menu > li a:hover,
	#masthead .main-navigation ul.nav-menu > li a:focus {
		color: '.$accent_color.';
	}
	
	.main-navigation ul.nav-menu > li a:hover svg,
	.main-navigation ul.nav-menu > li a:focus svg {
		fill: '.$accent_color.';
	}	
	
	.main-navigation ul.nav-menu > li button:hover svg,
	.main-navigation ul.nav-menu > li button:focus svg {
		fill: '.$accent_color.';
	}
	
	#masthead .main-navigation ul.nav-menu > li.login-register-item a:hover,
	#masthead .main-navigation ul.nav-menu > li.login-register-item a:focus {
		color: #fff;	
	}

	
	
	button.menu-toggle:hover svg,
	button.menu-toggle:focus svg {
		fill: '.$accent_color.';
	}	

	@media screen and (min-width: 1024px) {
		
	}
	
	
	@media screen and (max-width: 1023px) {
	
		.main-navigation ul,
		.main-navigation ul ul,
		.main-navigation ul ul ul {
			background-color: #fff;
		}
		
	}
	
	@media screen and (min-width: 1024px) {
		.main-navigation ul ul,
		.main-navigation ul ul ul {
			background-color: #fff;
		}
	}
	
	/* woo colors */
	
	.woocommerce button.button.alt.disabled,
	.woocommerce a.add_to_cart_button,
	.woocommerce a.add_to_cart_button:focus,
	.woocommerce a.product_type_grouped, 
	.woocommerce a.product_type_external, 
	.woocommerce a.product_type_simple, 
	.woocommerce a.product_type_variable,
	.woocommerce button.button.alt,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce a.button.alt,
	.woocommerce #respond input#submit,
	.woocommerce .widget_price_filter .price_slider_amount .button {
		background: '.$color.';
		color:#fff;
		text-decoration: none;
	}	
		
	
	.woocommerce button.button.alt.disabled:hover,
	.woocommerce button.button.alt.disabled:focus,
	
	.woocommerce a.button:hover,
	.woocommerce a.button:focus,
	
	.woocommerce button.button:hover,
	.woocommerce button.button:focus,
	
	.woocommerce div.product form.cart .button:hover,
	.woocommerce div.product form.cart .button:focus,
	
	.woocommerce a.button.alt:hover,
	.woocommerce a.button.alt:focus {
		background-color: '.$accent_color.';
		color: #fff;
	}
	
	.woocommerce button.button.alt:hover,
	.woocommerce button.button.alt:focus {
		background-color: '.$accent_color.';
		color: #fff;
	}


	
	
	';
	
	return $css;
	

}
