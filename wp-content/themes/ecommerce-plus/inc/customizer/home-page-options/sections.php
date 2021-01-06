<?php
$ecommerce_plus_options = ecommerce_plus_get_theme_options();

// Add service section
$wp_customize->add_section( 'ecommerce_plus_home_section', array(
	'title'             => __( 'Home Sections | Order','ecommerce-plus' ),
	'description'       => __( 'Order and show | hide home template sections.', 'ecommerce-plus' ),
	'panel'             => 'ecommerce_plus_home_panel',
));


// 1
$wp_customize->add_setting( 'ecommerce_plus_options[home_section_1]', array(
	'default'          	=> $ecommerce_plus_options['home_section_1'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[home_section_1]', array(
	'label'             => esc_html__( 'Section 1', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_home_section',
	'type'				=> 'select',
	'choices'			=> ecommerce_plus_home_sections(),
) );


// 2
$wp_customize->add_setting( 'ecommerce_plus_options[home_section_2]', array(
	'default'          	=> $ecommerce_plus_options['home_section_2'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[home_section_2]', array(
	'label'             => esc_html__( 'Section 2', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_home_section',
	'type'				=> 'select',
	'choices'			=> ecommerce_plus_home_sections(),
) );


// 3
$wp_customize->add_setting( 'ecommerce_plus_options[home_section_3]', array(
	'default'          	=> $ecommerce_plus_options['home_section_3'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[home_section_3]', array(
	'label'             => esc_html__( 'Section 3', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_home_section',
	'type'				=> 'select',
	'choices'			=> ecommerce_plus_home_sections(),
) );


//4
$wp_customize->add_setting( 'ecommerce_plus_options[home_section_4]', array(
	'default'          	=> $ecommerce_plus_options['home_section_4'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[home_section_4]', array(
	'label'             => esc_html__( 'Section 4', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_home_section',
	'type'				=> 'select',
	'choices'			=> ecommerce_plus_home_sections(),
) );


//5
$wp_customize->add_setting( 'ecommerce_plus_options[home_section_5]', array(
	'default'          	=> $ecommerce_plus_options['home_section_5'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[home_section_5]', array(
	'label'             => esc_html__( 'Section 5', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_home_section',
	'type'				=> 'select',
	'choices'			=> ecommerce_plus_home_sections(),
) );


//6
$wp_customize->add_setting( 'ecommerce_plus_options[home_section_6]', array(
	'default'          	=> $ecommerce_plus_options['home_section_6'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[home_section_6]', array(
	'label'             => esc_html__( 'Section 6', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_home_section',
	'type'				=> 'select',
	'choices'			=> ecommerce_plus_home_sections(),
) );


//7
$wp_customize->add_setting( 'ecommerce_plus_options[home_section_7]', array(
	'default'          	=> $ecommerce_plus_options['home_section_7'],
	'sanitize_callback' => 'ecommerce_plus_sanitize_select',
	'type'      		=> 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[home_section_7]', array(
	'label'             => esc_html__( 'Section 7', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_home_section',
	'type'				=> 'select',
	'choices'			=> ecommerce_plus_home_sections(),
) );