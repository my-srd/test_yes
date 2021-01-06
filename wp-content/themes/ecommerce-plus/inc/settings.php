<?php 
/**
 * Customizer default options
 *
 * @package ceylonthemes
 * @subpackage eCommerce Plus
 * @since 1.0.0
 * @return array An array of default values
 */

function ecommerce_plus_get_default_theme_options() {
	$ecommerce_plus_default_options = array(
	
		// Header Options
		'site_header_layout'			=> 'default',
		
		'home_section_1'				=> 'ecommerce_plus_post_slider',
		'home_section_2'				=> 'ecommerce_plus_product_showcase',
		'home_section_3'				=> 'ecommerce_plus_product_slider',
		'home_section_4'				=> 'ecommerce_plus_product_slider_2',
		'home_section_5'				=> 'ecommerce_plus_cta',
		'home_section_6'				=> 'ecommerce_plus_services',
		'home_section_7'				=> 'ecommerce_plus_contact',
		
		'primary_color'					=> '#178dff',		
		'link_color'					=> '#4c4c4c',
		'text_color'					=> '#333333',
		'link_hover_color'				=> '#178dff',
		'accent_color'					=> '#dd3333',
		
		//cta
		'cta_page'						=> '',
		'cta_text'						=> '',
		'cta_label'						=> esc_html__('CLAIM OFFER', 'ecommerce-plus'),
		'cta_color'						=> '#000',
		'cta_link'						=> '',
		'cta_height'					=> 300,		
		'cta_image'						=> get_template_directory_uri(). '/images/header-image.jpg',
		
		//contact
		'contact_form_shortcode'		=> '[contact-form-7   title="Contact form 1"]',		
		
		//services
		'service_page'					=> true,
		
		//post slider
		'slider_cat'					=> '',		
		'slider_height'					=> 450,
		'slider_title_text'				=> true,
		'slider_max'					=> 3,
		'slider_btn_label'				=> esc_html__('Read More', 'ecommerce-plus'),			
		'slider_btn_url'				=> '',
		
		//product section			
		'product_section_1_product_cat'		=> '',
		'product_section_1_product_feature'	=> '',
		'product_section_1_slider'			=> true,
		'product_section_1_num_products'	=> '',
		'product_section_1_height'			=> '',
		'product_section_1_title'			=> esc_html__('Our Products', 'ecommerce-plus'),
		'product_section_1_image_height'	=> '',
		'product_section_1_speed'			=> '',
		'product_section_1_colums'			=> 'col-md-2 col-sm-2 col-lg-2 col-xs-6',
		'product_section_1_type'			=> 0,
		
		//product section			
		'product_section_2_product_cat'		=> '',
		'product_section_2_product_feature'	=> '',
		'product_section_2_slider'			=> true,
		'product_section_2_num_products'	=> '',
		'product_section_2_height'			=> '',
		'product_section_2_title'			=> esc_html__('Our Products', 'ecommerce-plus'),
		'product_section_2_image_height'	=> '',
		'product_section_2_speed'			=> '',
		'product_section_2_colums'			=> 'col-md-2 col-sm-2 col-lg-2 col-xs-6',
		'product_section_2_type'			=> 0,		
	
		//product showcase
		'prod_navigation_section_enable'	=> true,			
		'prod_slider_cat_label'				=> esc_html__('Top Categories', 'ecommerce-plus'),
		'prod_slider_cat'					=> '',		
		'prod_slider_height'				=> 450,
		'prod_slider_title_text'			=> true,
		'prod_slider_max'					=> 3,
		'prod_slider_btn_label'				=> esc_html__('View Product', 'ecommerce-plus'),
		'prod_slider_btn_url'				=> '',			
		
		// Fonts
		'heading_font'					=> 'Roboto Condensed',
		'body_font'						=> 'Google Sans',
		
		'contact_section_address'		=> '',
		'contact_section_email'			=> '',
		'contact_section_phone'			=> '',
		'contact_section_hours'			=> '',	
			
		'social_facebook_link'			=> '',
		'social_twitter_link'			=> '',
		'social_whatsapp_link'			=> '',
		'social_pinterest_link'			=> '',
		'social_instagram_link'			=> '',
		'social_linkdin_link'			=> '',
		'social_youtube_link'			=> '',
	
		// Color Options
		'header_title_color'			=> '#1ea854',
		'header_tagline_color'			=> '#3f444d',
		'header_txt_logo_extra'			=> 'show-all',
		'header_bg_color'				=> '#ffffff',
		
		// breadcrumb
		'breadcrumb_enable'				=> true,
		'breadcrumb_separator'			=> '>',
		
		// layout 
		'site_layout'         			=> 'fluid',
		'sidebar_position' 				=> 'right-sidebar',
		'post_sidebar_position' 		=> 'right-sidebar',
		'page_sidebar_position' 		=> 'right-sidebar',
		'woo_sidebar_position'			=> 'left-sidebar',


		// excerpt options
		'long_excerpt_length'           => 20,
		'read_more_text'           		=> esc_html__( 'Read More', 'ecommerce-plus' ),
		
		// pagination options
		'pagination_enable'         	=> true,
		'pagination_type'         		=> 'default',

		// footer options
		'footer_bg_color'           	=> '#fbfbfb',
		'copyright_text'           		=> esc_html__('Copyright', 'ecommerce-plus'),
		'scroll_top_visible'        	=> true,		


		// blog/archive options
		'your_latest_posts_title' 		=> esc_html__( 'Blogs', 'ecommerce-plus' ),
		'hide_date' 					=> false,
		'hide_category'					=> false,

		// single post theme options
		'single_post_hide_date' 		=> false,
		'single_post_hide_author'		=> false,
		'single_post_hide_category'		=> false,
		'single_post_hide_tags'			=> false,

		/* Landing Page Settings */

		// top bar
		'topbar_login_register_enable'	=> true,
		'topbar_login_label'			=> esc_html__( 'My Account', 'ecommerce-plus' ),
		'topbar_login_url'				=> '',
		
	);

	$output = apply_filters( 'ecommerce_plus_default_theme_options', $ecommerce_plus_default_options );

	return $output;
}