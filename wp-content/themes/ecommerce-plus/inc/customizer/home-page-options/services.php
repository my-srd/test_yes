<?php
$ecommerce_plus_options = ecommerce_plus_get_theme_options();

// Add service section
$wp_customize->add_section( 'ecommerce_plus_service_section', array(
	'title'             => esc_html__( 'Services','ecommerce-plus' ),
	'description'       => esc_html__( 'Service Section Options.', 'ecommerce-plus' ),
	'panel'             => 'ecommerce_plus_home_panel',
));

$wp_customize->selective_refresh->add_partial( 'ecommerce_plus_options[service_page]', array(
	'selector' => '#home-service-section .container',
) );

// about pages drop down chooser control and setting
$wp_customize->add_setting( 'ecommerce_plus_options[service_page]', array(
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
));


$wp_customize->add_control( 'ecommerce_plus_options[service_page]', array(
	'label'     => esc_html__( 'Select Page', 'ecommerce-plus' ),
	'section'   => 'ecommerce_plus_service_section',
	'type'		=> 'select',
	'choices'	=> ecommerce_plus_get_page_choices(),
) );



