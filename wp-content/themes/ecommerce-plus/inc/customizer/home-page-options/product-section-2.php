<?php
$ecommerce_plus_options = ecommerce_plus_get_theme_options();

$wp_customize->add_section( 'ecommerce_plus_product_section_2', array(
	'title'             => esc_html__( 'Product Section 2','ecommerce-plus' ),
	'description'       => esc_html__( 'Product Section 2', 'ecommerce-plus' ),
	'panel'             => 'ecommerce_plus_home_panel',
) );


		
$wp_customize->selective_refresh->add_partial( 'ecommerce_plus_options[product_section_2_title]', array(
	'selector' => '#home-product-2',
) );


// blog title settings and control
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_title]', array(
	'default'			=> $ecommerce_plus_options['product_section_2_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_title]', array(
	'label'           	=> esc_html__( 'Section Title', 'ecommerce-plus' ),
	'section'        	=> 'ecommerce_plus_product_section_2',
	'type'				=> 'text',
) );


// Category or Type
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_type]', array(
	'default'			=> $ecommerce_plus_options['product_section_2_type'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_radio',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_type]', array(
	'label'     		=> esc_html__( 'Display Product', 'ecommerce-plus' ),
	'section'   		=> 'ecommerce_plus_product_section_2',
	'type'				=> 'radio',
	'choices'			=> array(
							'0' => esc_html__('Product Category', 'ecommerce-plus' ),
							'1' => esc_html__('Product Type', 'ecommerce-plus' ),
				  		),			  
) );


// product categories
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_product_cat]', array(
	'default'          	=> $ecommerce_plus_options['product_section_2_product_cat'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_product_cat]', array(
	'label'             => esc_html__( 'Select product category', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_product_section_2',
	'type'				=> 'select',
	'active_callback' 	=> 'ecommerce_plus_sec_2_is_product_category_enable',
	'choices'			=> ecommerce_plus_get_product_categories(),
) );

// product feature
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_product_feature]', array(
	'default'          	=> $ecommerce_plus_options['product_section_2_product_feature'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_product_feature]', array(
	'label'             => esc_html__( 'Select Product Type', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_product_section_2',
	'type'				=> 'select',
	'active_callback' 	=> 'ecommerce_plus_sec_2_is_product_type_enable',
	'choices'			=> array(
							"featured" => __('Featured', 'ecommerce-plus'),
							"best-selling" => __('Best Selling', 'ecommerce-plus'),
							"top-rated" => __('Top Rated', 'ecommerce-plus'),
							"on-sale" => __('On Sale', 'ecommerce-plus'),
							"latest" => __('Latest', 'ecommerce-plus'),
							"price" => __('Price (Height to low)', 'ecommerce-plus'),
							"price-low" => __('Price (Low to height)', 'ecommerce-plus'),
							),
));


// columns
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_colums]', array(
	'default'          	=> $ecommerce_plus_options['product_section_2_colums'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_colums]', array(
	'label'             => esc_html__( 'Number of Colums', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_product_section_2',
	'active_callback' 	=> 'ecommerce_plus_extra_plugin',	
	'type'				=> 'select',
	'choices'			=> 	array(
							"col-md-4 col-sm-4 col-lg-4 col-xs-6" 	=> 3,
							"col-md-3 col-sm-3 col-lg-3 col-xs-6" 	=> 4,
							"col-sm-2" 								=> 5,
							"col-md-2 col-sm-2 col-lg-2 col-xs-6" 	=> 6,		
						),
));

// slider | grid
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_slider]', array(
	'default'			=> $ecommerce_plus_options['product_section_2_slider'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_radio',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_slider]', array(
	'label'     => esc_html__( 'Product Grid or Slider', 'ecommerce-plus' ),
	'section'   => 'ecommerce_plus_product_section_2',
	'type'		=> 'radio',
	'choices'	=> array(
					'0' => esc_html__('Product Grid', 'ecommerce-plus' ),
					'1' => esc_html__('Product Slider', 'ecommerce-plus' ),
				  ),
) );


// number of products
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_num_products]', array(
	'default'			=> $ecommerce_plus_options['product_section_2_num_products'],
	'sanitize_callback' => 'absint',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_num_products]', array(
	'label'           	=> esc_html__( 'Number of products to show', 'ecommerce-plus' ),
	'section'        	=> 'ecommerce_plus_product_section_2',
	'type'				=> 'number',
) );


//Slider Speed 
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_speed]', array(
	'default'			=> $ecommerce_plus_options['product_section_2_speed'],
	'sanitize_callback' => 'absint',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_speed]', array(
	'label'           	=> esc_html__( 'Slider Speed (Seconds)', 'ecommerce-plus' ),
	'section'        	=> 'ecommerce_plus_product_section_2',
	'active_callback' 	=> 'ecommerce_plus_sec_2_is_slider_enable',	
	'type'				=> 'number',
) );

// Slider item height
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_height]', array(
	'default'			=> $ecommerce_plus_options['product_section_2_height'],
	'sanitize_callback' => 'absint',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_height]', array(
	'label'           	=> esc_html__( 'Item Height (px)', 'ecommerce-plus' ),
	'section'        	=> 'ecommerce_plus_product_section_2',
	'type'				=> 'number',
) );


//Image height
$wp_customize->add_setting( 'ecommerce_plus_options[product_section_2_image_height]', array(
	'default'			=> $ecommerce_plus_options['product_section_2_image_height'],
	'sanitize_callback' => 'absint',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[product_section_2_image_height]', array(
	'label'           	=> esc_html__( 'Product Image Height (px)', 'ecommerce-plus' ),
	'section'        	=> 'ecommerce_plus_product_section_2',
	'type'				=> 'number',
) );
