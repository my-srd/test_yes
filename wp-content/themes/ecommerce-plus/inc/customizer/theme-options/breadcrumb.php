<?php
/**
 * Breadcrumb options
 *
 * @package ceylonthemes
 * @subpackage eCommerce Plus
 * @since 1.0.0
 */

$wp_customize->add_section( 'ecommerce_plus_breadcrumb', array(
	'title'             => esc_html__( 'Breadcrumb','ecommerce-plus' ),
	'description'       => esc_html__( 'Breadcrumb options.', 'ecommerce-plus' ),
	'panel'             => 'ecommerce_plus_theme_options_panel',
) );

// Breadcrumb enable setting and control.

$wp_customize->add_setting( 'ecommerce_plus_options[breadcrumb_enable]', array(
	'default'   => true,
	'type'      => 'option',
	'sanitize_callback' => 'ecommerce_plus_sanitize_checkbox',
 ) );

$wp_customize->add_control('ecommerce_plus_options[breadcrumb_enable]',
	array(
		'section'   => 'ecommerce_plus_breadcrumb',
		'label'     => esc_html__( 'Hide Category', 'ecommerce-plus' ),
		'type'      => 'checkbox'
		 )
);

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'ecommerce_plus_options[breadcrumb_separator]', array(
	'sanitize_callback'	=> 'sanitize_text_field',
	'default'          	=> $options['breadcrumb_separator'],
	'type'      => 'option',
) );

$wp_customize->add_control( 'ecommerce_plus_options[breadcrumb_separator]', array(
	'label'            	=> esc_html__( 'Separator', 'ecommerce-plus' ),
	'active_callback' 	=> 'ecommerce_plus_is_breadcrumb_enable',
	'section'          	=> 'ecommerce_plus_breadcrumb',
) );
