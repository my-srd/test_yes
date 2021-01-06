<?php
/**
 * Footer options
 *
 * @package ceylonthemes
 * @subpackage eCommerce Plus
 * @since 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'ecommerce_plus_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'ecommerce-plus' ),
		'priority'   			=> 900,
		'panel'      			=> 'ecommerce_plus_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'ecommerce_plus_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'ecommerce_plus_santize_allowed_html',
	)
);

$wp_customize->add_control( 'ecommerce_plus_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'ecommerce-plus' ),
		'section'    			=> 'ecommerce_plus_section_footer',
		'type'		 			=> 'textarea',
    )
);

// scroll top visible

$wp_customize->add_setting( 'ecommerce_plus_options[scroll_top_visible]', array(
	'default'   => true,
	'type'      => 'option',
	'type'      => 'option',
	'sanitize_callback' => 'ecommerce_plus_sanitize_checkbox',
 ) );

$wp_customize->add_control('ecommerce_plus_options[scroll_top_visible]',
	array(
		'section'   => 'ecommerce_plus_section_footer',
		'label'     => esc_html__( 'Display Scroll Top Button', 'ecommerce-plus' ),
		'type'      => 'checkbox'
		 )
);

// background Color
$wp_customize->add_setting( 'ecommerce_plus_options[footer_bg_color]', array(
	'default'           => $options['footer_bg_color'],
	'sanitize_callback' => 'sanitize_hex_color',
	'type'      		=> 'option',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ecommerce_plus_options[footer_bg_color]', array(
	'active_callback' 	=> 'ecommerce_plus_extra_plugin',
	'label'             => __( 'Background Color', 'ecommerce-plus' ),
	'section'           => 'ecommerce_plus_section_footer',
) ) );
