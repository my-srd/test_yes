<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if ( ! class_exists( 'Redux' ) ) {
	return;
}

//Lorada theme option name. In there, all of the Redux data is stored
$opt_name = "lorada_theme_options";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$show_admin = true;
$allow_submenu = true;
$page_priority = 45;
$parent_page = '';
$menu_title = esc_html__( 'Theme Options', 'lorada' );
$menu_type = 'menu';
$display_name = $theme->get( 'Name' );

/*************  START ARGUMENTS  **************/

$args = array(
	'opt_name'             => $opt_name,
	'display_name'         => $display_name,
	'display_version'      => $theme->get( 'Version' ),
	'menu_type'            => $menu_type,
	'allow_sub_menu'       => $allow_submenu,
	'menu_title'           => $menu_title,
	'page_title'           => esc_html__( 'Theme Options', 'lorada' ),
	'google_api_key'       => '',
	'google_update_weekly' => true,
	'async_typography'     => true,
	'admin_bar'            => $show_admin,
	'admin_bar_icon'       => 'dashicons-admin-settings',
	'admin_bar_priority'   => 90,
	'global_variable'      => '',
	'dev_mode'             => false,
	'update_notice'        => false,
	'customizer'           => false,
	'page_priority'        => $page_priority,
	'page_parent'          => $parent_page,
	'page_permissions'     => 'manage_options',
	'menu_icon'            => '',
	'last_tab'             => '',
	'page_icon'            => 'icon-themes',
	'page_slug'            => 'theme_options',
	'save_defaults'        => true,
	'default_show'         => true,
	'default_mark'         => '',
	'show_import_export'   => true,
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	'output_tag'           => true,
	'database'             => '',
	'system_info'          => false,

	// HINTS
	'hints'                => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)
);

Redux::setArgs( $opt_name, $args );

/**************  END ARGUMENTS ***************/


/*************  START SECTIONS  **************/
Redux::setSection( $opt_name, array(
	'title'		=>	esc_html__( 'Basic Settings', 'lorada' ),
	'id'		=>	'basic_settings',
	'icon'		=>	'el el-home'
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'General', 'lorada' ),
	'id'			=>	'general',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'	=>	array(
		array(
			'id'		=>	'site_layout',
			'title'		=>	esc_html__( 'Site Layout', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				'full'		=>	esc_html__( 'Full Width', 'lorada' ),
				'boxed'		=>	esc_html__( 'Boxed Layout', 'lorada' )
			),
			'default'	=>	'full'
		),

		array(
			'id'		=>	'border_shadow',
			'title'		=>	esc_html__( 'Boxed Border Shadow', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true,
			'required'	=>	array(
				'site_layout', 'equals', array( 'boxed' )
			)
		),

		array(
			'id'		=>	'favicon',
			'title'		=>	esc_html__( 'Favicon image', 'lorada' ),
			'type'		=>	'media',
			'desc'		=>	esc_html__( 'Upload Favicon image (png, ico)', 'lorada' ),
			'url'		=>	false,
			'default'	=>	array(
				'url'	=>	LORADA_URI . '/favicon.png'
			)
		),

		array(
			'id'		=>	'favicon_retina',
			'title'		=>	esc_html__( 'Favicon Retina image', 'lorada' ),
			'type'		=>	'media',
			'desc'		=>	esc_html__( 'Upload Retina Favicon image (png, ico)', 'lorada' ),
			'url'		=>	false,
			'default'	=>	array(
				'url'	=>	LORADA_URI . '/images/favicon-retina.png'
			)
		),

		array(
			'id'		=>	'container_max_width',
			'title'		=>	esc_html__( 'Bootstrap Container Max Width', 'lorada' ),
			'type'		=>	'slider',
			'min'		=>	960,
			'step'		=>	10,
			'max'		=>	1920,
			'default'	=>	1200,
			'display'	=>	'text'
		),

		array(
			'id'		=>	'google_map_api_key',
			'title'		=>	esc_html__( 'Google Map API Key', 'lorada' ),
			'type'		=>	'text',
			'subtitle'	=>	wp_kses( __('Obtain API key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a> to use our Google Map VC element.', 'lorada'), array(
					'a' => array(
                        'href' => array(),
                        'target' => array()
                    )
            ) )
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Page & Layout Setting', 'lorada' ),
	'id'			=>	'page_layout_setting',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'page_width',
			'title'		=>	esc_html__( 'Page Width', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				'full'		=>	esc_html__( 'Full Width', 'lorada' ),
				'custom'	=>	esc_html__( 'Boxed Width', 'lorada' )
			),
			'default'	=>	'full',
			'required'	=>	array(
				array( 'site_layout', 'equals', array( 'full' ) ),
				array( 'header_layout', 'not', 'left_menu_bar' )
			)
		),

		array(
			'id'		=>	'page_sidebar',
			'type'		=>	'image_select',
			'title'		=>	esc_html__( 'Page Sidebar Layout', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select sidebar layout for page.', 'lorada' ),
			'options'	=>	array(
				'full-width'    =>  array(
					'alt'	=>	esc_html__( 'No Sidebar', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/1col.png'
				),
				'sidebar-left'  =>  array(
					'alt'	=>	esc_html__( 'Left Sidebar', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/2cl.png'
				),
				'sidebar-right' =>  array(
					'alt'	=>	esc_html__( 'Right Sidebar', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/2cr.png'
				),
			),
			'default'	=>	'full-width'
		),

		array(
			'id'		=>	'page_sidebar_width',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Sidebar Size', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can set different sizes for your page sidebar.', 'lorada' ),
			'options'	=>	array(
				2		=>	esc_html__( 'Small', 'lorada' ),
				3		=>	esc_html__( 'Medium', 'lorada' ),
				4		=>	esc_html__( 'Large', 'lorada' )
			),
			'default'	=>	3,
			'required'	=>	array(
				'page_sidebar', '!=', 'full-width'
			)
		),

		array(
			'id'		=>	'page_comments_enable',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Show comments form on page', 'lorada' ),
			'default'	=>	true
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Mobile Bottom Navbar', 'lorada' ),
	'id'			=>	'mobile_bottom_nav',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'sticky_mob_toolbar',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Enable Sticky Navbar', 'lorada' ),
			'subtitle'	=> 	esc_html__( 'Show/hide sticky toolbar on the mobile bottom area', 'lorada' ),
			'default'	=>	false
		),

		array(
			'id'		=>	'mobile_toolbar_txt',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Enable Navbar Text', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show/hide sticky navbar icon texts', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'sticky_toolbar_items',
			'type'		=>	'sorter',
			'title'		=>	esc_html__( 'Select Navbar Items', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose your navbar items which will show on navbar area', 'lorada' ),
			'options'	=>	array(
				'enabled'	=>	array(
					'home'			=>	esc_html__( 'Home page', 'lorada' ),
					'wishlist'		=>	esc_html__( 'Wishlist', 'lorada' ),
					'account'		=>	esc_html__( 'My account', 'lorada' ),
					'categories'	=>	esc_html__( 'Categories', 'lorada' ),
					'search'		=>	esc_html__( 'Search', 'lorada' )
				),

				'disabled'	=>	array(
					'shop'		=>	esc_html__( 'Shop page', 'lorada' ),
					'blog'		=>	esc_html__( 'Blog page', 'lorada' ),
					'cart'		=>	esc_html__( 'Cart', 'lorada' ),
					'custom_1'	=>	esc_html__( 'Custom Item 1', 'lorada' ),
					'custom_2'	=>	esc_html__( 'Custom Item 2', 'lorada' )
				)
			)
		),

		array(
			'id'		=>	'toolbar_custom_1_item',
			'icon'		=>	'fas fa-icons',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Navbar Custom Item 1', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'custom_1_url',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Custom Item URL', 'lorada' )
		),

		array(
			'id'		=>	'custom_1_txt',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Custom Item Text', 'lorada' )
		),

		array(
			'id'		=>	'custom_1_icon',
			'type'		=>	'media',
			'title'		=>	esc_html__( 'Custom Item Icon', 'lorada' ),
			'url'		=>	false
		),

		array(
			'id'		=>	'toolbar_custom_2_item',
			'icon'		=>	'fas fa-icons',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Navbar Custom Item 2', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'custom_2_url',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Custom Item URL', 'lorada' )
		),

		array(
			'id'		=>	'custom_2_txt',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Custom Item Text', 'lorada' )
		),

		array(
			'id'		=>	'custom_2_icon',
			'type'		=>	'media',
			'title'		=>	esc_html__( 'Custom Item Icon', 'lorada' ),
			'url'		=>	false
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Typography', 'lorada' ),
	'id'			=>	'typography-setting',
	'icon'			=>	'el el-fontsize',
	'fields'		=>	array(
		array(
			'id'			=> 'typography-body',
			'type'			=> 'typography',
			'title'			=> esc_html__( 'Body Font', 'lorada' ),
			'subtitle'		=> esc_html__( 'Set typography options for body text font.', 'lorada' ),
			'google'		=> true,
			'font-backup'	=> false,
			'text-align'	=> false,
			'all_styles'	=> true,
			'default'		=> array(
				'color'			=> '#666',
				'font-size'		=> '14px',
				'font-family'	=> 'Poppins',
				'font-weight'	=> '400',
				'line-height'	=> '24px'
			),
		),

		array(
			'id'			=> 'typography-nav',
			'type'			=> 'typography',
			'title'			=> esc_html__( 'Navigation Font', 'lorada' ),
			'subtitle'		=> esc_html__( 'Set all navigation menu typography.', 'lorada' ),
			'google'		=> true,
			'font-backup'	=> false,
			'text-align'	=> false,
			'line-height'	=> false,
			'all_styles'	=> true,
			'default'		=> array(
				'color'			=> '#222',
				'font-weight'	=> '600',
				'font-family'	=> 'Poppins',
				'font-size'		=> '14px'
			),
		),

		array(
			'id'			=> 'typography-h1',
			'type'			=> 'typography',
			'title'			=> esc_html__( 'H1 Font Style', 'lorada' ),
			'subtitle'		=> esc_html__( 'Set HTML h1 tag typography.', 'lorada' ),
			'google'		=> true,
			'font-backup'	=> false,
			'text-align'	=> false,
			'all_styles'	=> true,
			'default'		=> array(
				'font-family'	=> 'Libre Baskerville',
				'font-size'		=> '24px',
				'font-weight'	=> '400',
				'line-height'	=> '34px',
				'color'			=> '#222'
			),
		),

		array(
			'id'			=> 'typography-h2',
			'type'			=> 'typography',
			'title'			=> esc_html__( 'H2 Font Style', 'lorada' ),
			'subtitle'		=> esc_html__( 'Set HTML h2 tag typography.', 'lorada' ),
			'google'		=> true,
			'font-backup'	=> false,
			'text-align'	=> false,
			'all_styles'	=> true,
			'default'		=> array(
				'font-family'	=> 'Libre Baskerville',
				'font-size'		=> '20px',
				'font-weight'	=> '400',
				'line-height'	=> '28px',
				'color'			=> '#222'
			),
		),

		array(
			'id'			=> 'typography-h3',
			'type'			=> 'typography',
			'title'			=> esc_html__( 'H3 Font Style', 'lorada' ),
			'subtitle'		=> esc_html__( 'Set HTML h3 tag typography.', 'lorada' ),
			'google'		=> true,
			'font-backup'	=> false,
			'text-align'	=> false,
			'all_styles'	=> true,
			'default'		=> array(
				'font-family'	=> 'Poppins',
				'font-size'		=> '18px',
				'font-weight'	=> '400',
				'line-height'	=> '25px',
				'color'			=> '#222'
			),
		),

		array(
			'id'			=> 'typography-h4',
			'type'			=> 'typography',
			'title'			=> esc_html__( 'H4 Font Style', 'lorada' ),
			'subtitle'		=> esc_html__( 'Set HTML h4 tag typography.', 'lorada' ),
			'google'		=> true,
			'font-backup'	=> false,
			'text-align'	=> false,
			'all_styles'	=> true,
			'default'		=> array(
				'font-family'	=> 'Poppins',
				'font-size'		=> '16px',
				'font-weight'	=> '400',
				'line-height'	=> '23px',
				'color'			=> '#222'
			),
		),

		array(
			'id'			=> 'typography-h5',
			'type'			=> 'typography',
			'title'			=> esc_html__( 'H5 Font Style', 'lorada' ),
			'subtitle'		=> esc_html__( 'Set HTML h5 tag typography.', 'lorada' ),
			'google'		=> true,
			'font-backup'	=> false,
			'text-align'	=> false,
			'all_styles'	=> true,
			'default'		=> array(
				'font-family'	=> 'Poppins',
				'font-size'		=> '13px',
				'font-weight'	=> '400',
				'line-height'	=> '18px',
				'color'			=> '#222'
			),
		),

		array(
			'id'			=> 'typography-h6',
			'type'			=> 'typography',
			'title'			=> esc_html__( 'H6 Font Style', 'lorada' ),
			'subtitle'		=> esc_html__( 'Set HTML h6 tag typography.', 'lorada' ),
			'google'		=> true,
			'font-backup'	=> false,
			'text-align'	=> false,
			'all_styles'	=> true,
			'default'		=> array(
				'font-family'	=> 'Poppins',
				'font-size'		=> '11px',
				'font-weight'	=> '400',
				'line-height'	=> '15px',
				'color'			=> '#222'
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Colors & Styles', 'lorada' ),
	'id'			=>	'colors_styles',
	'icon'			=>	'el el-brush',
	'fields'		=>	array(
		array(
			'id'			=>	'site_skin',
			'icon'			=>	'fas fa-magic',
			'type'			=>	'info',
			'raw'			=>	'<h3>' . esc_html__( 'Site Skin', 'lorada' ) . '</h3>'
		),

		array(
			'id'			=>	'skin_mode',
			'title'			=>	esc_html__( 'Skin Mode', 'lorada' ),
			'subtitle'		=>	esc_html__( 'If you select dark page background, please choose "Dark Skin" Mode.', 'lorada' ),
			'type'			=>	'button_set',
			'options'		=>	array(
				'light'		=>	esc_html__( 'Light Skin', 'lorada' ),
				'dark'		=>	esc_html__( 'Dark Skin', 'lorada' )
			),
			'default'		=>	'light'
		),

		array(
			'id'			=>	'site_color',
			'icon'			=>	'fas fa-palette',
			'type'			=>	'info',
			'raw'			=>	'<h3>' . esc_html__( 'Site Colors', 'lorada' ) . '</h3>'
		),

		array(
			'id'			=>	'primary_color',
			'type'			=>	'color',
			'title'			=>	esc_html__( 'Site Primary Color', 'lorada' ),
			'default'		=>	'#cc3333',
			'transparent'	=>	false
		),

		array(
			'id'			=>	'secondary_color',
			'type'			=>	'color',
			'title'			=>	esc_html__( 'Site Secondary Color', 'lorada' ),
			'default'		=>	'#339900',
			'transparent'	=>	false
		),

		array(
			'id'			=>	'page_bg',
			'icon'			=>	'fas fa-paint-roller',
			'type'			=>	'info',
			'raw'			=>	'<h3>' . esc_html__( 'Page Background', 'lorada' ) . '</h3>'
		),

		array(
			'id'			=>	'site_background',
			'title'			=>	esc_html__( 'Site Background', 'lorada' ),
			'type'			=>	'background',
			'default'		=>	array(
				'background-color'	=>	'#fff'
			),
			'transparent'	=>	false
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Header', 'lorada' ),
	'id'			=>	'header',
	'icon'			=>	'el el-wrench',
	'fields'		=>	array(
		array(
			'id'		=>	'header_width_style',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Header Width Style', 'lorada' ),
			'options'	=>	array(
				'full'		=>	esc_html__( 'Full Width', 'lorada' ),
				'custom'	=>	esc_html__( 'Boxed Layout', 'lorada' )
			),
			'default'	=>	'custom',
			'required'	=>	array(
				array( 'site_layout', 'equals', array( 'full' ) ),
				array( 'header_layout', 'not', 'left_menu_bar' )
			)
		),

		array(
			'id'		=>	'header_max_width',
			'title'		=>	esc_html__( 'Header Max Width', 'lorada' ),
			'type'		=>	'slider',
			'min'		=>	960,
			'step'		=>	10,
			'max'		=>	1600,
			'default'	=>	1300,
			'display'	=>	'text',
			'required'	=>	array(
				'header_width_style', 'equals',	array( 'custom' )
			)
		),

		array(
			'id'			=>	'header_bg_color',
			'title'			=>	esc_html__( 'Header Background Color', 'lorada' ),
			'type'			=>	'background',
			'default'		=>	array(
				'background-color'	=>	'#fff'
			),
			'transparent'	=>	false
		),

		array(
			'id'		=>	'header_overlap',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Header above the content', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Overlap page content with this header. Header background is transparent.', 'lorada' ),
			'default'	=>	false,
			'required'	=>	array(
				'header_layout', 'equals', array( 'header_simple', 'advanced_logo_center' )
			)
		),

		array(
			'id'		=>	'header_bottom_line',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Header Bottom Line', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show the border line in the bottom of header.', 'lorada' ),
			'default'	=>	false,
			'required'	=>	array(
				'header_layout', 'equals', array( 'header_simple', 'advanced_logo_center' )
			)
		),

		array(
			'id'		=>	'header_spacing_size',
			'icon'		=>	'fas fa-sliders-h',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Header Spacing and Size', 'lorada' ) . '</h3>',
			'required'	=>	array(
				'header_layout', 'not', 'left_menu_bar'
			)
		),

		array(
			'id'		=>	'header_top_spacing',
			'title'		=>	esc_html__( 'Header Top Spacing', 'lorada' ),
			'type'		=>	'slider',
			'default'	=>	20,
			'min'		=>	0,
			'step'		=>	1,
			'max'		=>	200,
			'display'	=>	'text',
			'required'	=>	array(
				'header_layout', 'not', 'left_menu_bar'
			)
		),

		array(
			'id'		=>	'header_bottom_spacing',
			'title'		=>	esc_html__( 'Header Bottom Spacing', 'lorada' ),
			'type'		=>	'slider',
			'default'	=>	20,
			'min'		=>	0,
			'step'		=>	1,
			'max'		=>	200,
			'display'	=>	'text',
			'required'	=>	array(
				'header_layout', 'not', 'left_menu_bar'
			)
		),

		array(
			'id'		=>	'header_layout_option',
			'icon'		=>	'fas fa-th',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Select Header Layout', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'header_layout',
			'type'		=>	'image_select',
			'title'		=>	esc_html__( 'Header layout', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose your header layout', 'lorada' ),
			'options'	=>	array(
				'header_default'	=>	array(
					'title'			=>	esc_html__( 'Default Header', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/header-layout1.png',
					'alt'			=>	'Default Header Layout'
				),

				'header_simple'		=>	array(
					'title'			=>	esc_html__( 'Simple Header', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/header-layout2.png',
					'alt'			=>	'Simple Header Layout'
				),

				'advanced_logo_center'	=>	array(
					'title'			=>	esc_html__( 'Advanced Logo Center', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/header-layout3.png',
					'alt'			=>	'Advanced Logo Center Layout'
				),

				'left_menu_bar'		=>	array(
					'title'			=>	esc_html__( 'Left Menu Sidebar', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/header-layout4.png',
					'alt'			=>	'Left Menu Sidebar Layout'
				)
			),
			'default'	=>	'header_simple'
		),

		array(
			'id'		=>	'header_mobile_layout',
			'type'		=>	'image_select',
			'title'		=>	esc_html__( 'Header Layout on mobile Device', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose your mobile header layout', 'lorada' ),
			'options'	=>	array(
				'logo_center'		=>	array(
					'title'			=>	esc_html__( 'Logo Center', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/header-mobile1.png',
					'alt'			=>	'Logo Center Layout'
				),

				'menu_left'			=>	array(
					'title'			=>	esc_html__( 'Mobile Menu Left', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/header-mobile2.png',
					'alt'			=>	'Mobile Menu Left Layout'
				),

				'menu_right'		=>	array(
					'title'			=>	esc_html__( 'Mobile Menu Right', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/header-mobile3.png',
					'alt'			=>	'Mobile Menu Right Layout'
				)
			),
			'default'	=>	'logo_center'
		),

		array(
			'id'		=>	'mobile_screen_size',
			'type'		=>	'slider',
			'title'		=>	esc_html__( 'Mobile Layout Width', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Set width where mobile layout is available.', 'lorada' ),
			'min'		=>	767,
			'step'		=>	1,
			'max'		=>	1600,
			'default'	=>	960,
			'display'	=>	'text'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Logo', 'lorada' ),
	'id'			=>	'header_logo',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'logo',
			'title'		=>	esc_html__( 'Logo Image', 'lorada' ),
			'desc'		=>	esc_html__( 'Upload your logo image (png, jpg)', 'lorada' ),
			'type'		=>	'media',
			'url'		=>	false,
			'default'	=>	array(
				'url'	=>	LORADA_URI . '/images/logo.png'
			)
		),

		array(
			'id'		=>	'light_logo',
			'title'		=>	esc_html__( 'Light Logo Image', 'lorada' ),
			'desc'		=>	esc_html__( 'Upload your logo image (png, jpg)', 'lorada' ),
			'type'		=>	'media',
			'url'		=>	false,
			'default'	=>	array(
				'url'	=>	LORADA_URI . '/images/light-logo.png'
			)
		),

		array(
			'id'		=>	'alternative_logo',
			'title'		=>	esc_html__( 'Alternative Sticky Logo', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Used This Logo on the Sticky Header', 'lorada' ),
			'type'		=>	'media',
			'url'		=>	false,
			'desc'		=>	esc_html__( 'Upload your logo image (png, jpg)', 'lorada' ),
			'default'	=>	array(
				'url'	=>	LORADA_URI . '/images/logo.png'
			)
		),

		array(
			'id'				=>	'logo_padding',
			'title'				=>	esc_html__( 'Logo Image Padding', 'lorada' ),
			'type'				=>	'spacing',
			'mode'				=>	'padding',
			'units'				=>	array( 'px' ),
			'units_extended'	=>	false,
			'desc'				=>	esc_html__( 'Add padding space in your logo image', 'lorada' ),
			'default'			=>	array(
				'padding-top'		=>	'0px',
				'padding-right'		=>	'0px',
				'padding-bottom'	=>	'0px',
				'padding-left'		=>	'0px',
				'units'				=>	'px'
			)
		),

		array(
			'id'		=>	'logo_height',
			'title'		=>	esc_html__( 'Logo Height', 'lorada' ),
			'type'		=>	'slider',
			'default'	=>	43,
			'min'		=>	0,
			'max'		=>	200,
			'step'		=>	1,
			'display'	=>	'text'
		),

		array(
			'id'		=>	'sticky_logo_height',
			'title'		=>	esc_html__( 'Sticky Logo Height', 'lorada' ),
			'type'		=>	'slider',
			'default'	=>	43,
			'min'		=>	0,
			'max'		=>	200,
			'step'		=>	1,
			'display'	=>	'text'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Top bar', 'lorada' ),
	'id'			=>	'header_top_bar',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'top_bar_desc',
			'type'		=>	'info',
			'desc'		=>	esc_html__( 'Top bar section will not be shown in header left menu layout.', 'lorada' )
		),

		array(
			'id'		=>	'top_bar_basic',
			'type'		=>	'info',
			'icon'		=>	'fas fa-sliders-h',
			'raw'		=>	'<h3>' . esc_html__( 'Top Bar Basic Settings', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'top_bar_enable',
			'title'		=>	esc_html__( 'Top Bar', 'lorada' ),
			'type'		=>	'switch',
			'on'		=>	esc_html__( 'Enable', 'lorada' ),
			'off'		=>	esc_html__( 'Disable', 'lorada' ),
			'default'	=>	false
		),

		array(
			'id'		=>	'topbar_width_style',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Topbar Width Style', 'lorada' ),
			'options'	=>	array(
				'full'		=>	esc_html__( 'Full Width', 'lorada' ),
				'custom'	=>	esc_html__( 'Boxed Layout', 'lorada' )
			),
			'default'	=>	'custom',
			'required'	=>	array(
				'site_layout', 'equals', array( 'full' )
			)
		),

		array(
			'id'		=>	'topbar_max_width',
			'title'		=>	esc_html__( 'Topbar Max Width', 'lorada' ),
			'type'		=>	'slider',
			'min'		=>	960,
			'step'		=>	10,
			'max'		=>	1600,
			'default'	=>	1300,
			'display'	=>	'text',
			'required'	=>	array(
				'topbar_width_style', 'equals',	array( 'custom' )
			)
		),

		array(
			'id'			=>	'top_bar_bg_color',
			'title'			=>	esc_html__( 'Top Bar Background', 'lorada' ),
			'type'			=>	'color',
			'default'		=>	'#fff',
			'transparent'	=>	false
		),

		array(
			'id'			=>	'top_bar_txt_color',
			'title'			=>	esc_html__( 'Top Bar Text Color', 'lorada' ),
			'type'			=>	'color',
			'default'		=>	'#666',
			'transparent'	=>	false
		),

		array(
			'id'			=>	'top_bar_txt',
			'title'			=>	esc_html__( 'Top bar Left Text', 'lorada' ),
			'type'			=>	'text',
			'default'		=>	'Free Shipping For All Orders Of $200'
		),

		array(
			'id'			=>	'top_bar_right_txt',
			'title'			=>	esc_html__( 'Top bar Right Text', 'lorada' ),
			'subtitle'		=>	esc_html__( 'You can also use shortcodes here. Ex: [lorada_social_buttons]', 'lorada' ),
			'type'			=>	'text',
			'default'		=>	'[lorada_social_buttons type="follow" btn_size="small" color_scheme="dark"]'
		),

		array(
			'id'		=>	'top_bar_border',
			'title'		=>	esc_html__( 'Top Bar Bottom Border', 'lorada' ),
			'type'		=>	'switch',
			'on'		=>	esc_html__( 'Enable', 'lorada' ),
			'off'		=>	esc_html__( 'Disable', 'lorada' ),
			'default'	=>	true
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Menu', 'lorada' ),
	'id'			=>	'header_menu',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'menu_bg_options',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Menu Color Options', 'lorada' ) . '</h3>',
			'icon'		=>	'fas fa-paint-brush'
		),

		array(
			'id'			=>	'menu_bg_color',
			'title'			=>	esc_html__( 'Menu Background Color', 'lorada' ),
			'type'			=>	'background',
			'default'		=>	array(
				'background-color'	=>	'#fff'
			),
			'transparent'	=>	false,
			'required'	=>	array(
				'header_layout', 'equals', array( 'header_default', 'advanced_logo_center' )
			)
		),

		array(
			'id'			=>	'sub_menu_bg_color',
			'title'			=>	esc_html__( 'Sub Menu Background Color', 'lorada' ),
			'type'			=>	'color',
			'default'		=>	'#fff',
			'transparent'	=>	false
		),

		array(
			'id'		=>	'menu_settings',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Menu Settings', 'lorada' ) . '</h3>',
			'icon'		=>	'fas fa-sliders-h'
		),

		array(
			'id'		=>	'menu_hover',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'Menu Hover Style', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can change menu hover style in the header navigation', 'lorada' ),
			'options'	=>	array(
				'default'	=>	esc_html__( 'Default', 'lorada' ),
				'bordered'	=>	esc_html__( 'Hover Border', 'lorada' ),
				'dotted'	=>	esc_html__( 'Dotted', 'lorada' )
			),
			'default'	=>	'default'
		),

		array(
			'id'		=>	'menu_align',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Main Menu Align', 'lorada' ),
			'options'	=>	array(
				'left'		=>	esc_html__( 'Left', 'lorada' ),
				'center'	=>	esc_html__( 'Center', 'lorada' ),
				'right'		=>	esc_html__( 'Right', 'lorada' ),
			),
			'default'	=>	'center',
			'required'	=>	array(
				array( 'header_layout', 'not', 'advanced_logo_center' ),
				array( 'header_layout', 'not', 'left_menu_bar' )
			)
		),

		array(
			'id'		=>	'menu_extend_txt',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Menu Extend Text', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Add your text like share button, phone number, location etc.', 'lorada' ),
			'desc'		=>	esc_html__( 'You can also use shortcodes here. Ex: [lorada_html_block block_id="65"]', 'lorada' ),
			'default'	=>	'+(364)106 7572',
			'required'	=>	array(
				'header_layout', 'equals', array( 'header_default', 'left_menu_bar' )
			)
		),

		array(
			'id'		=>	'mobile_categories',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Show categories in Mobile Menu', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show your category menu in the mobile navigation', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'mobile_category_menu',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'Mobile Category Menu', 'lorada' ),
			'data'		=>	'menus',
			'required'	=>	array(
				'mobile_categories', 'equals', true
			)
		),

		array(
			'id'		=>	'mobile_nav_social',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Show Share Buttons on the Bottom of Mobile Nav', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'mobile_share_type',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Share Button Types', 'lorada' ),
			'options'	=>	array(
				'follow'	=>	esc_html__( 'Follow', 'lorada' ),
				'share'		=>	esc_html__( 'Share', 'lorada' )
			),
			'default'	=>	'share',
			'required'	=>	array(
				'mobile_nav_social', 'equals', true
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Collection Menu', 'lorada' ),
	'id'			=>	'header_collection',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'collection_menu_title',
			'title'		=>	esc_html__( 'Collection Menu Title', 'lorada' ),
			'type'		=>	'text',
			'default'	=>	'All Department'
		),

		array(
			'id'		=>	'collection_menu',
			'title'		=>	esc_html__( 'Collection Menu', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose your any custom menu for a collection header navigation', 'lorada' ),
			'type'		=>	'select',
			'data'		=>	'menus'
		),

		array(
			'id'		=>	'collection_menu_collapse',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Menu Collapse on Front Page', 'lorada' ),
			'default'	=>	false
		),

		array(
			'id'			=>	'collection_menu_content_bg',
			'title'			=>	esc_html__( 'Menu Content Background', 'lorada' ),
			'type'			=>	'color',
			'transparent'	=>	false,
			'default'		=>	'#fff'
		),

		array(
			'id'			=>	'collection_menu_bg',
			'title'			=>	esc_html__( 'Menu Title Background', 'lorada' ),
			'type'			=>	'color',
			'transparent'	=>	false,
			'default'		=>	'#cc3333',
		),

		array(
			'id'			=>	'collection_menu_title_clr',
			'title'			=>	esc_html__( 'Menu Title Color', 'lorada' ),
			'type'			=>	'color',
			'transparent'	=>	false,
			'default'		=>	'#fff'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Shopping Cart Element', 'lorada' ),
	'id'			=>	'header_shopping_icon',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'custom_cart_icon',
			'title'		=>	esc_html__( 'Custom Cart Icon', 'lorada' ),
			'type'		=>	'media',
			'desc'		=>	esc_html__( 'Upload your custom cart image: png, jpg', 'lorada' )
		),

		array(
			'id'		=>	'shopping_mini_cart',
			'title'		=>	esc_html__( 'Cart Icon Function', 'lorada' ),
			'type'		=>	'switch',
			'on'		=>	esc_html__( 'Mini Cart', 'lorada' ),
			'off'		=>	esc_html__( 'Simple Link', 'lorada' ),
			'default'	=>	1
		),

		array(
			'id'		=>	'cart_view_popsition',
			'title'		=>	esc_html__( 'Shopping Cart View Position', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Shopping cart widget is appeared in the header dropdown or sidebar.', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				'side_view'	=>	esc_html__( 'Sidebar View', 'lorada' ),
				'dropdown'	=>	esc_html__( 'Dropdown in header', 'lorada' )
			),
			'default'	=>	'side_view',
			'required'	=>	array(
				'shopping_mini_cart', 'equals', 1
			)
		),

		array(
			'id'		=>	'view_cart_after_added',
			'title'		=>	esc_html__( 'View Mini Cart Box After Ajax Cart', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true
		),

		array(
			'id'		=>	'shopping_cart_view',
			'title'		=>	esc_html__( 'Cart Icon View Style', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose your Cart Icon Style in the header', 'lorada' ),
			'type'		=>	'select',
			'options'	=>	array(
				1	=>	esc_html__( 'Style 1', 'lorada' ),
				2	=>	esc_html__( 'Style 2', 'lorada' ),
				'disable'	=>	esc_html__( 'Disable', 'lorada' )
			),
			'default'	=>	2,
			'required'	=>	array(
				'header_layout', 'not', 'left_menu_bar'
			)
		),

		array(
			'id'			=>	'cart_icon_bg',
			'title'			=>	esc_html__( 'Cart Icon Background Color', 'lorada' ),
			'type'			=>	'color',
			'default'		=>	'#f6edea',
			'transparent'	=>	false,
			'required'		=>	array(
				'shopping_cart_view', 'equals', '2'
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Search Element', 'lorada' ),
	'id'			=>	'header_search_icon',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'custom_search_icon',
			'title'		=>	esc_html__( 'Custom Search Icon', 'lorada' ),
			'type'		=>	'media',
			'desc'		=>	esc_html__( 'Upload your custom search image: png, jpg', 'lorada' )
		),

		array(
			'id'		=>	'search_widget_style',
			'title'		=>	esc_html__( 'Search Form Style', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Dispaly search form in diffrent view', 'lorada' ),
			'type'		=>	'select',
			'options'	=>	array(
				'full_screen'	=>	esc_html__( 'Full screen search form', 'lorada' ),
				'dropdown'		=>	esc_html__( 'Dropdown search form', 'lorada' ),
				'disable'		=>	esc_html__( 'Disable search icon', 'lorada' )
			),
			'default'	=>	'full_screen'
		),

		array(
			'id'		=>	'ajax_search',
			'title'		=>	esc_html__( 'Ajax Search', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	1
		),

		array(
			'id'		=>	'search_post_type',
			'title'		=>	esc_html__( 'Search Post Type', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can choose search post type such as posts and woocommerce products.', 'lorada' ),
			'type'		=>	'select',
			'options'	=>	array(
				'product'	=>	esc_html__( 'Product', 'lorada' ),
				'post'	=>	esc_html__( 'Post', 'lorada' )
			),
			'default'	=>	'product'
		),

		array(
			'id'		=>	'show_categories',
			'title'		=>	esc_html__( 'Show Dropdown Categories', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show product categories in search form', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	1
		),

		array(
			'id'		=>	'show_subcategories',
			'title'		=>	esc_html__( 'Show Sub Categories', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show sub categories in dropdown menu', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	1,
			'required'	=>	array(
				'show_categories', 'equals', 1
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Others Elements', 'lorada' ),
	'id'			=>	'header_other',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'header_account_setting',
			'type'		=>	'info',
			'icon'		=>	'far fa-user',
			'raw'		=>	'<h3>' . esc_html__( 'Account Icon', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'custom_account_icon',
			'title'		=>	esc_html__( 'Custom Account Icon', 'lorada' ),
			'type'		=>	'media',
			'desc'		=>	esc_html__( 'Upload your custom account image: png, jpg', 'lorada' )
		),

		array(
			'id'		=>	'account_header_view',
			'type'		=>	'switch',
			'title'		=>	esc_html__( '"My account" icon shows in header', 'lorada' ),
			'default'	=>	1
		),

		array(
			'id'		=>	'login_dropdown',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Login form in dropdown', 'lorada' ),
			'default'	=>	1
		),

		array(
			'id'		=>	'header_wishlist_setting',
			'type'		=>	'info',
			'icon'		=>	'far fa-heart',
			'raw'		=>	'<h3>' . esc_html__( 'Wishlist Icon', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'custom_wishlist_icon',
			'title'		=>	esc_html__( 'Custom Wishlist Icon', 'lorada' ),
			'type'		=>	'media',
			'desc'		=>	esc_html__( 'Upload your custom wishlist image: png, jpg', 'lorada' )
		),

		array(
			'id'		=>	'wishlist_header_view',
			'title'		=>	esc_html__( 'Display Wishlist Icon', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true
		),

		array(
			'id'		=>	'header_currency_setting',
			'type'		=>	'info',
			'icon'		=>	'far fa-money-bill-alt',
			'raw'		=>	'<h3>' . esc_html__( 'Multi Currency Switcher', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'currency_topbar_view',
			'title'		=>	esc_html__( 'Show Multi Currency Dropdown in topbar', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true
		),

		array(
			'id'		=>	'header_language_setting',
			'type'		=>	'info',
			'icon'		=>	'fas fa-language',
			'raw'		=>	'<h3>' . esc_html__( 'Multi Language Switcher', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'language_topbar_view',
			'title'		=>	esc_html__( 'Show Multi Language Dropdown in topbar', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true
		),

		array(
			'id'		=>	'header_bottom_promo_setting',
			'type'		=>	'info',
			'icon'		=>	'fas fa-ad',
			'raw'		=>	'<h3>' . esc_html__( 'Header Promo Bar', 'lorada' ) . '</h3>',
			'required'	=>	array(
				'header_layout', 'not', 'left_menu_bar'
			)
		),

		array(
			'id'		=>	'header_bottom_promo',
			'title'		=>	esc_html__( 'Show promotion bar in the bottom of header', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true,
			'required'	=>	array(
				'header_layout', 'not', 'left_menu_bar'
			)
		),

		array(
			'id'		=>	'header_promo_content',
			'title'		=>	esc_html__( 'Promotion Content', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select "HTML Block" to show on promotion bar.', 'lorada' ),
			'type'		=>	'select',
			'data'		=>	'posts',
			'args'		=>	array(
				'post_type'			=> 'html_block',
				'posts_per_page'	=> -1,
				'orderby'			=> 'id',
				'order'				=> 'ASC',
			),
			'required'	=>	array(
				'header_bottom_promo', 'equals', true,
				'header_layout', 'not', 'left_menu_bar'
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Sticky Header', 'lorada' ),
	'id'			=>	'sticky_header',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'			=>	'sticky_header_setting',
			'title'			=>	esc_html__( 'Sticky Header', 'lorada' ),
			'type'			=>	'switch',
			'on'			=>	esc_html__( 'Enable', 'lorada' ),
			'off'			=>	esc_html__( 'Disable', 'lorada' ),
			'default'		=>	false
		),

		array(
			'id'			=>	'sticky_header_on_scroll',
			'title'			=>	esc_html__( 'Hide Sticky Header on Scroll Down', 'lorada' ),
			'type'			=>	'switch',
			'on'			=>	esc_html__( 'Yes', 'lorada' ),
			'off'			=>	esc_html__( 'No', 'lorada' ),
			'default'		=>	true
		),

		array(
			'id'			=>	'sitcky_header_bg_clr',
			'title'			=>	esc_html__( 'Sticky Header Background Color', 'lorada' ),
			'type'			=>	'color',
			'default'		=>	'#fff',
			'transparent'	=>	false,
			'validate'		=>	'color'
		),

		array(
			'id'			=>	'sticky_header_menu_clr',
			'title'			=>	esc_html__( 'Sticky Header Menu Color', 'lorada' ),
			'type'			=>	'color',
			'default'		=>	'#222',
			'transparent'	=>	false,
			'validate'		=>	'color'
		),

		array(
			'id'			=>	'sticky_header_top_spacing',
			'title'			=>	esc_html__( 'Header Top Spacing', 'lorada' ),
			'type'			=>	'slider',
			'default'		=>	10,
			'min'			=>	0,
			'step'			=>	1,
			'max'			=>	50,
			'display'		=>	'text'
		),

		array(
			'id'			=>	'sticky_header_bottom_spacing',
			'title'			=>	esc_html__( 'Header Bottom Spacing', 'lorada' ),
			'type'			=>	'slider',
			'default'		=>	10,
			'min'			=>	0,
			'step'			=>	1,
			'max'			=>	50,
			'display'		=>	'text'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Page Heading', 'lorada' ),
	'id'			=>	'page_titles',
	'icon'			=>	'el-icon-check',
	'fields'		=>	array(
        array(
			'id'		=>	'page_title_design',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Page Title', 'lorada' ),
			'options'	=>	array(
				'left'		=>	esc_html__( 'Default', 'lorada' ),
				'center'	=>	esc_html__( 'Centered', 'lorada' ),
				'abreast'	=>	esc_html__( 'Abreast', 'lorada' ),
				'disable'	=>	esc_html__( 'Disable', 'lorada' ),
			),
			'default'	=>	'center',
			'tags'		=>	'page heading design'
		),

		array(
			'id'		=>	'show_breadcrumbs',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Show Breadcrumbs', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'title_background',
			'type'		=>	'background',
			'title'		=>	esc_html__( 'Pages heading background', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Set background image or color, that will be used as a default for all page titles, shop page and blog.', 'lorada' ),
			'desc'		=>	esc_html__( 'You can also specify other image for particular page', 'lorada' ),
			'default'	=>	array(
				'background-color'		=>	'#f3f3f3',
				'background-position'	=>	'center center',
				'background-size'		=>	'cover',
				'background-repeat'		=>	'no-repeat'
			),
			'transparent'	=>	false,
			'tags'		=>	'page title color page title background'
		),

		array(
			'id'		=>	'page_title_size',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Page title size', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can set different sizes for your pages titles', 'lorada' ),
			'options'	=>	array(
				'default'	=>	esc_html__( 'Default',  'lorada' ),
				'small'		=>	esc_html__( 'Small',  'lorada' ),
				'large'		=>	esc_html__( 'Large', 'lorada' ),
			),
			'default'	=>	'default',
			'tags'		=>	'page heading size breadcrumbs size'
		),

		array(
			'id'		=>	'page_title_color',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Page title color', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can set different colors depending on it\'s background. May be light or dark', 'lorada' ),
			'options'	=>	array(
				'default'	=>	esc_html__( 'Default',  'lorada' ),
				'light'		=>	esc_html__( 'Light', 'lorada' ),
				'dark'		=>	esc_html__( 'Dark', 'lorada' ),
			),
			'default'	=>	'dark'
		),

		array(
			'id'		=>	'page_heading_top_spacing',
			'title'		=>	esc_html__( 'Page Heading Top Spacing', 'lorada' ),
			'type'		=>	'slider',
			'default'	=>	80,
			'min'		=>	0,
			'step'		=>	1,
			'max'		=>	200,
			'display'	=>	'text'
		),

		array(
			'id'		=>	'page_heading_bottom_spacing',
			'title'		=>	esc_html__( 'Page Heading Bottom Spacing', 'lorada' ),
			'type'		=>	'slider',
			'default'	=>	80,
			'min'		=>	0,
			'step'		=>	1,
			'max'		=>	200,
			'display'	=>	'text'
		)
	),
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Footer', 'lorada' ),
	'id'			=>	'footer',
	'icon'			=>	'el el-website',
	'fields'		=> array(
		array(
			'id'		=>	'enable_footer',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Footer', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'footer_width_style',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Footer Width Style', 'lorada' ),
			'options'	=>	array(
				'full'		=>	esc_html__( 'Full Width', 'lorada' ),
				'custom'	=>	esc_html__( 'Boxed Layout', 'lorada' )
			),
			'default'	=>	'custom',
			'required'	=>	array(
				array( 'site_layout', 'equals', array( 'full' ) ),
				array( 'header_layout', 'not', 'left_menu_bar' )
			)
		),

		array(
			'id'		=>	'footer_max_width',
			'title'		=>	esc_html__( 'Footer Max Width', 'lorada' ),
			'type'		=>	'slider',
			'min'		=>	960,
			'step'		=>	10,
			'max'		=>	1600,
			'default'	=>	1300,
			'display'	=>	'text',
			'required'	=>	array(
				'footer_width_style', 'equals',	array( 'custom' )
			)
		),

		array(
			'id'		=>	'footer_top_content',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Footer Top Content', 'lorada' ),
			'desc'		=>	esc_html__( 'Add footer top content using html block shortcode. EX: [lorada_html_block block_id="7"]', 'lorada' ),
			'default'	=>	''
		),

		array(
			'id'		=>	'footer_layout_option',
			'icon'		=>	'fas fa-tachometer-alt',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Main Footer Settings', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'footer_layout',
			'type'		=>	'image_select',
			'title'		=>	esc_html__( 'Footer Layout', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose your footer layout', 'lorada' ),
			'options'	=>	array(
				'footer_one_col'	=>	array(
					'title'			=>	esc_html__( 'Footer One Column', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/footer-one-column.png',
					'alt'			=>	'Footer One Column Layout'
				),

				'footer_two_col'	=>	array(
					'title'			=>	esc_html__( 'Footer Two Columns', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/footer-two-column.png',
					'alt'			=>	'Footer Two Columns Layout'
				),

				'footer_three_col'	=>	array(
					'title'			=>	esc_html__( 'Footer Three Columns', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/footer-three-column.png',
					'alt'			=>	'Footer Three Columns Layout'
				),

				'footer_four_col'	=>	array(
					'title'			=>	esc_html__( 'Footer Four Columns', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/footer-four-column.png',
					'alt'			=>	'Footer Four Columns Layout'
				),

				'footer_five_col'	=>	array(
					'title'			=>	esc_html__( 'Footer Five Columns', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/footer-five-column.png',
					'alt'			=>	'Footer Five Columns Layout'
				),

				'footer_six_col'	=>	array(
					'title'			=>	esc_html__( 'Footer Six Columns', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/footer-six-column.png',
					'alt'			=>	'Footer Five Fit Columns Layout'
				),
			),
			'default'	=>	'footer_four_col'
		),

		array(
			'id'			=>	'footer_bg_clr',
			'title'			=>	esc_html__( 'Footer Background Color', 'lorada' ),
			'type'			=>	'color',
			'default'		=>	'#f1f1f1',
			'transparent'	=>	false,
			'validate'		=>	'color'
		),

		array(
			'id'			=>	'footer_widget_title_clr',
			'type'			=>	'color',
			'title'			=>	esc_html__( 'Footer Widget Title Color', 'lorada' ),
			'default'		=>	'#222',
			'transparent'	=>	false,
			'validate'		=>	'color'
		),

		array(
			'id'			=>	'footer_widget_text_clr',
			'type'			=>	'color',
			'title'			=>	esc_html__( 'Footer Text Color', 'lorada' ),
			'default'		=>	'#666',
			'transparent'	=>	false,
			'validate'		=>	'color'
		),

		array(
			'id'		=>	'copyright_area_option',
			'icon'		=>	'fas fa-tachometer-alt',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Copyright Area Settings', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'copyright_setting',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Copyright Area', 'lorada' ),
			'on'		=>	esc_html__( 'Enable', 'lorada' ),
			'off'		=>	esc_html__( 'Disable', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'			=>	'copyright_area_bg',
			'type'			=>	'color',
			'title'			=>	esc_html__( 'Copyright Area Background Color', 'lorada' ),
			'default'		=>	'#f1f1f1',
			'transparent'	=>	false,
			'validate'		=>	'color'
		),

		array(
			'id'			=>	'copyright_txt_clr',
			'type'			=>	'color',
			'title'			=>	esc_html__( 'Copyright Area Text Color', 'lorada' ),
			'default'		=>	'#666666',
			'transparent'	=>	false,
			'validate'		=>	'color'
		),

		array(
			'id'		=>	'split_line',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Copyright Split Line', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'copyright_text',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Copyright Text', 'lorada' ),
			'default'	=>	esc_html__( '© 2019 Lorada. All Rights Reserved.', 'lorada' )
		),

		array(
			'id'		=>	'footer_payment_logo',
			'title'		=>	esc_html__( 'Payment Logo', 'lorada' ),
			'type'		=>	'media',
			'url'		=>	true,
			'default'	=>	array(
				'url'	=>	LORADA_URI . '/images/theme_options/payment_logo.png'
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Blog', 'lorada' ),
	'id'			=>	'blog',
	'icon'			=>	'el el-pencil',
	'fields'		=>	array(
		array(
			'id'		=>	'blog_width',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Blog Page Width', 'lorada' ),
			'subtitle'	=>	esc_html__( '', 'lorada' ),
			'options'	=>	array(
				'full'		=>	esc_html__( 'Full Width', 'lorada' ),
				'boxed'		=>	esc_html__( 'Boxed Width', 'lorada' ),
			),
			'default'	=>	'boxed',
			'required'	=>	array(
				array( 'site_layout', 'equals', 'full' ),
			)
		),

		array(
			'id'		=>	'blog_layout',
			'type'		=>	'image_select',
			'title'		=>	esc_html__( 'Blog Layout', 'lorada' ),
			'subtitle'	=>	esc_html__( '', 'lorada' ),
			'options'	=>	array(
				'full-width'	=>	array(
					'alt'	=>	esc_html__( 'Full Width', 'lorada' ),
					'img'	=>	ReduxFramework::$_url . 'assets/img/1col.png'
				),
				'sidebar-left'	=>	array(
					'alt'	=>	esc_html__( '2 Column Left', 'lorada' ),
					'img'	=>	ReduxFramework::$_url . 'assets/img/2cl.png'
				),
				'sidebar-right'	=>	array(
					'alt'	=>	esc_html__( '2 Column Right', 'lorada' ),
					'img'	=>	ReduxFramework::$_url . 'assets/img/2cr.png'
				),
			),
			'default'	=>	'full-width'
		),

		array(
			'id'		=>	'blog_sidebar_width',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Blog Sidebar Size', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can use different size sidebars', 'lorada' ),
			'options'	=>	array(
				2	=>	esc_html__( 'Small', 'lorada' ),
				3	=>	esc_html__( 'Medium', 'lorada' ),
				4	=>	esc_html__( 'Large', 'lorada' ),
			),
			'default'	=>	3
		),

		array(
			'id'		=>	'blog_style',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'Blog Style', 'lorada' ),
			'options'	=>	array(
				'1'	=>	esc_html__( 'List View', 'lorada' ),
				'2'	=>	esc_html__( 'Grid View', 'lorada' ),
				'3'	=>	esc_html__( 'Masonry View', 'lorada' )
			),
			'default'	=>	'2'
		),

		array(
			'id'		=>	'blog_grid_columns',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Blog items columns', 'lorada' ),
			'subtitle'	=>	esc_html__( 'For grid view style', 'lorada' ),
			'options'	=>	array(
				2	=>	'2',
				3	=>	'3',
				4	=>	'4',
			),
			'default'	=>	3,
			'required'	=>	array(
				array( 'blog_style', 'not', 1 ),
			)
		),

		array(
			'id'		=>	'blog_excerpt',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Posts excerpt', 'lorada' ),
			'subtitle'	=>	esc_html__( 'If you will set this option to "Excerpt" then you are able to set custom excerpt for each post or it will be cutted from the post content. If you choose "Full content" then all content will be shown, or you can also add "Read more button" while editing the post and by doing this cut your excerpt length as you need.', 'lorada' ),
			'options'	=>	array(
				'excerpt'	=>	esc_html__( 'Excerpt', 'lorada' ),
				'full'		=>	esc_html__( 'Full content', 'lorada' )
			),
			'default'	=>	'excerpt',
			'required'	=>	array(
				'blog_style', 'equals', array('1', '2')
			)
		),

		array(
			'id'		=>	'blog_excerpt_length_by',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Excerpt length by words or letters', 'lorada' ),
			'options'	=>	array(
				'word'		=>	esc_html__( 'Words', 'lorada' ),
				'letter'	=>	esc_html__( 'Letters', 'lorada' )
			),
			'default'	=>	'word',
			'required'	=>	array(
				array( 'blog_excerpt', 'equals', 'excerpt' ),
			)
		),

		array(
			'id'		=>	'blog_excerpt_length',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Excerpt length', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Number of words or letters that will be displayed for each post if you use "Excerpt" mode and don\'t set custom excerpt for each post.', 'lorada' ),
			'default'	=>	15,
			'required'	=>	array(
				array( 'blog_excerpt', 'equals', 'excerpt' ),
			)
		),

		array(
			'id'		=>	'blog_pagination',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Blog pagination', 'lorada' ),
			'options'	=>	array(
				'pagination'	=>	esc_html__( 'Pagination links', 'lorada' ),
				'load_more'		=>	esc_html__( '"Load more" button', 'lorada' ),
				'infinit'		=>	esc_html__( 'Infinite scrolling', 'lorada' ),
			),
			'default' => 'pagination'
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Single Post', 'lorada' ),
	'id'			=>	'single_post',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'single_post_width',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Post Page Width Style', 'lorada' ),
			'options'	=>	array(
				'full'		=>	esc_html__( 'Full Width', 'lorada' ),
				'custom'	=>	esc_html__( 'Boxed Layout', 'lorada' )
			),
			'default'	=>	'custom',
			'required'	=>	array(
				array( 'site_layout', 'equals', array( 'full' ) ),
				array( 'header_layout', 'not', 'left_menu_bar' )
			)
		),

		array(
			'id'		=>	'single_post_sidebar',
			'type'		=>	'image_select',
			'title'		=>	esc_html__( 'Post Sidebar Layout', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select sidebar layout for single post page.', 'lorada' ),
			'options'	=>	array(
				'full-width'    =>  array(
					'alt'	=>	esc_html__( 'No Sidebar', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/1col.png'
				),
				'sidebar-left'  =>  array(
					'alt'	=>	esc_html__( 'Left Sidebar', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/2cl.png'
				),
				'sidebar-right' =>  array(
					'alt'	=>	esc_html__( 'Right Sidebar', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/2cr.png'
				),
			),
			'default'	=>	'full-width'
		),

		array(
			'id'		=>	'single_post_sidebar_width',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Sidebar Size', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can set different sizes for your single post page sidebar.', 'lorada' ),
			'options'	=>	array(
				2		=>	esc_html__( 'Small', 'lorada' ),
				3		=>	esc_html__( 'Medium', 'lorada' ),
				4		=>	esc_html__( 'Large', 'lorada' )
			),
			'default'	=>	3,
			'required'	=>	array(
				'single_post_sidebar', '!=', 'full-width'
			)
		),

		array(
			'id'		=>	'post_view_style',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'Post View Style', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose single post page style.', 'lorada' ),
			'options'	=>	array(
				'default'			=>	esc_html__( 'Default Layout', 'lorada' ),
				'backstretch'		=>	esc_html__( 'Backstretch Image Layout', 'lorada' )
			),
			'default'	=>	'default'
		),

		array(
			'id'		=>	'post_comments_enable',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Show Commnets', 'lorada' ),
			'default'	=>	true
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Shop', 'lorada' ),
	'id'			=>	'shop',
	'icon'			=>	'fas fa-shopping-cart',
	'fields'		=>	array(
		array(
			'id'		=>	'shop_page_layout',
			'title'		=>	esc_html__( 'Shop Page Width', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				'full'		=>	esc_html__( 'Full Width', 'lorada' ),
				'custom'	=>	esc_html__( 'Boxed Layout', 'lorada' )
			),
			'default'	=>	'custom',
			'required'	=>	array(
				array( 'site_layout', 'equals', 'full' )
			)
		),

		array(
			'id'		=>	'shop_ajax_filter',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'AJAX shop', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Enable AJAX functionality for filters widgets on shop.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'product_quick_shop',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Quick Shop in Variable Products', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Add to Cart variable products directly.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'product_link',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'Open Product Page', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select if open product page in current or new tab', 'lorada' ),
			'options'	=>	array(
				'current'	=>	esc_html__( 'In current tab', 'lorada' ),
				'new_tab'	=>	esc_html__( 'In new tab', 'lorada' ),
			),
			'default'	=>	'current',
		),

		array(
			'id'		=>	'empty_cart_text',
			'type'		=>	'textarea',
			'title'		=>	esc_html__( 'Empty Cart Text', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Text will be shown in empty cart page.', 'lorada' ),
			'default'	=>	'You need to add some products to your shopping cart.<br> Please go to "Shop" page, and find your products.'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Product Grid Style', 'lorada' ),
	'id'			=>	'product_grid_style',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'default_shop_products_style',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Shop Product View', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Default product view style in shop page.', 'lorada' ),
			'options'	=>	array(
				'grid'	=>	esc_html__( 'Grid', 'lorada' ),
				'list'	=>	esc_html__( 'List', 'lorada' ),
			),
			'default'	=>	'grid'
		),

		array(
			'id'		=>	'shop_products_columns',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Products Columns', 'lorada' ),
			'subtitle'	=>	esc_html__( 'How many products are shown in per row.', 'lorada' ),
			'options'	=>	array(
				2	=>	'2',
				3	=>	'3',
				4	=>	'4',
				5	=>	'5',
				6	=>	'6'
			),
			'default'	=>	3,
			'required'	=>	array(
				'default_shop_products_style', 'equals', 'grid'
			)
		),

		array(
			'id'		=>	'shop_product_hover_style',
			'type'		=>	'image_select',
			'title'		=>	esc_html__( 'Product Hover Style', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select products hover style in shop page.', 'lorada' ),
			'options'	=>	array(
				'hover-1'			=>	array(
					'title'			=>	esc_html__( 'Product Hover Layout 1', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/product-hover-1.jpg',
					'alt'			=>	'Product Hover Layout 1'
				),

				'hover-2'				=>	array(
					'title'			=>	esc_html__( 'Product Hover Layout 2', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/product-hover-2.jpg',
					'alt'			=>	'Product Hover Layout 2'
				),

				'hover-3'			=>	array(
					'title'			=>	esc_html__( 'Product Hover Layout 3', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/product-hover-3.jpg',
					'alt'			=>	'Product Hover Layout 3'
				),

				'hover-4'				=>	array(
					'title'			=>	esc_html__( 'Product Hover Layout 4', 'lorada' ),
					'img'			=>	LORADA_URI . '/images/theme_options/product-hover-4.jpg',
					'alt'			=>	'Product Hover Layout 4'
				)
			),
			'default'	=>	'hover-1',
			'required'	=>	array(
				'default_shop_products_style', 'equals', 'grid'
			)
		),

		array(
			'id'		=>	'product_attribute_type',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Product Attribute Type', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose product attribute view type.', 'lorada' ),
			'options'	=>	array(
				'select'	=>	esc_html__( 'Select Box', 'lorada' ),
				'buttonset'	=>	esc_html__( 'Button Set', 'lorada' )
			),
			'default'	=>	'buttonset'
		),

		array(
			'id'		=>	'content_quick_view',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Product Quick View', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show/Hide quick view button in the content product layout.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'content_variation_switch',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Product Variation Swatch', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show/Hide variable product swatch in content product layout.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'shop_categories_view',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Product Categories', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show/Hide product categories in shop page.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'shop_product_countdown',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Product Sale CountDown', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show/Hide Sale CountDown in shop page.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'shop_countdown_view_style',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'CountDown View Style', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select product sale countdown view style.', 'lorada' ),
			'options'	=>	array(
				'border'	=>	esc_html__( 'Default', 'lorada' ),
				'dark'		=>	esc_html__( 'Rectangle Dark', 'lorada' ),
				'light'		=>	esc_html__( 'Rectangle Light', 'lorada' )
			),
			'default'	=>	'border',
			'required'	=>	array(
				'shop_product_countdown', 'equals', true
			)
		),

		array(
			'id'		=>	'shop_per_page',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Products per page', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Number of products per page', 'lorada' ),
			'default'	=>	12
		),

		array(
			'id'		=>	'per_page_links',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Products per page links', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Allow customers to change number of products per page', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'per_page_options',
			'type'		=>	'text',
			'title'		=>	esc_html__('Products per page variations', 'lorada'),
			'default'	=>	'9,24,36',
			'desc'		=>	esc_html__('For ex.: 12,24,36,-1. Use -1 to show all products on the page', 'lorada'),
			'required'	=>	array(
				array( 'per_page_links', 'equals', true ),
			)
		),

		array(
			'id'		=>	'shop_pagination',
			'type'		=>	'button_set',
			'title'		=>	esc_html__('Products pagination', 'lorada'),
			'options'	=>	array(
			    'pagination'	=>	esc_html__( 'Pagination', 'lorada'),
			    'more-btn'		=>	esc_html__('"Load more" button', 'lorada'),
			    'infinit'		=>	esc_html__( 'Infinite scrolling', 'lorada' ),
			),
			'default'	=>	'pagination'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Product Labels', 'lorada' ),
	'id'			=>	'product_labels',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'sale_label_view',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Sale Label View in percentage', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show sale flash label with text or percentage number.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'hot_label',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'View Hot Label', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show/Hide Hot label in featured products.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'			=>	'hot_label_clr',
			'type'			=>	'color',
			'title'			=>	esc_html__( 'Hot Label Background Color', 'lorada' ),
			'subtitle'		=>	esc_html__( 'Change label background color in products. Text color is always white.', 'lorada' ),
			'transparent'	=>	false,
			'default'		=>	'#c71414',
			'required'		=>	array(
				'hot_label', 'equals', true
			)
		),

		array(
			'id'			=>	'soldout_label_clr',
			'type'			=>	'color',
			'title'			=>	esc_html__( 'Sold Out Label Background Color', 'lorada' ),
			'subtitle'		=>	esc_html__( 'Change label background color in products. Text color is always white.', 'lorada' ),
			'transparent'	=>	false,
			'default'		=>	'#3a3a3a',
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Sidebar', 'lorada' ),
	'id'			=>	'shop-layout',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'shop_layout',
			'type'		=>	'image_select',
			'title'		=>	esc_html__( 'Shop Layout', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select main content and sidebar alignment for shop pages.', 'lorada' ),
			'options'	=>	array(
				'full-width'	=>	array(
					'alt'	=>	esc_html__( '1 Column', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/1col.png'
				),
				'sidebar-left'	=>	array(
					'alt'	=>	esc_html__( '2 Column Left', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/2cl.png'
				),
				'sidebar-right'	=>	array(
					'alt'	=>	esc_html__( '2 Column Right', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/2cr.png'
				),
			),
			'default' => 'sidebar-left'
		),
		array(
			'id'		=>	'shop_sidebar_width',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Sidebar size', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can set different sizes for your shop pages sidebar', 'lorada' ),
			'options'	=>	array(
				2	=>	esc_html__( 'Small', 'lorada' ),
				3	=>	esc_html__( 'Medium', 'lorada' ),
				4	=>	esc_html__( 'Large', 'lorada' )
			),
			'default'	=>	3,
			'required'	=>	array(
				array( 'shop_layout', '!=', 'full-width' ),
			)
		),
		array(
			'id'		=>	'shop_hide_sidebar_desktop',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Off canvas sidebar for desktop', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can can hide sidebar and show nicely on button click on the shop page.', 'lorada' ),
			'default'	=>	false,
			'required'	=>	array(
				array( 'shop_layout', '!=', 'full-width' ),
			)
		),
		array(
			'id'		=> 'shop_top_sidebar',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Shop Filter Widget on the Top Area', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Shop page filter widgets will be shown on the top area with toggle dropdown menu.', 'lorada' ),
			'default'	=>	true,
			'required'	=>	array(
				'shop_layout', 'equals', 'full-width'
			)
		)
	),
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Page Heading', 'lorada' ),
	'id'			=>	'shop-page-heading',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'shop_title',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Shop title', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show title for shop page, product categories or tags.', 'lorada' ),
			'default'	=>	true
		),
		array(
			'id'		=>	'shop_categories',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Categories in page heading', 'lorada' ),
			'subtitle'	=>	esc_html__( 'This categories menu is generated automatically based on all categories in the shop. You are not able to manage this menu as other WordPress menus.', 'lorada' ),
			'default'	=>	1
		),
		array(
			'id'		=>	'shop_child_categories',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Show current category descendants', 'lorada' ),
			'default'	=>	0,
			'required'	=>	array(
				array( 'shop_categories', 'equals', true),
			)
		),
		array(
			'id'		=>	'shop_products_count',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Show products count for each category', 'lorada' ),
			'default'	=>	1,
			'required'	=>	array(
				array( 'shop_categories', 'equals', true ),
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Single Product', 'lorada' ),
	'id'			=>	'single_product',
	'icon'			=>	'fas fa-tag',
	'fields'		=>	array(
		array(
			'id'		=>	'single_product_width',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Product Page Width Style', 'lorada' ),
			'options'	=>	array(
				'full'		=>	esc_html__( 'Full Width', 'lorada' ),
				'custom'	=>	esc_html__( 'Boxed Layout', 'lorada' )
			),
			'default'	=>	'custom',
			'required'	=>	array(
				array( 'site_layout', 'equals', array( 'full' ) ),
				array( 'header_layout', 'not', 'left_menu_bar' )
			)
		),

		array(
			'id'		=>	'product_sidebar_layout',
			'type'		=>	'image_select',
			'title'		=>	esc_html__( 'Product Sidebar Layout', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select sidebar layout for single product page.', 'lorada' ),
			'options'	=>	array(
				'full-width'    =>  array(
					'alt'	=>	esc_html__( 'No Sidebar', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/1col.png'
				),
				'sidebar-left'  =>  array(
					'alt'	=>	esc_html__( 'Left Sidebar', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/2cl.png'
				),
				'sidebar-right' =>  array(
					'alt'	=>	esc_html__( 'Right Sidebar', 'lorada' ),
					'img'	=>	ReduxFramework::$_url.'assets/img/2cr.png'
				),
			),
			'default'	=>	'full-width'
		),

		array(
			'id'		=>	'product_sidebar_width',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Sidebar Size', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can set different sizes for your product pages sidebar.', 'lorada' ),
			'options'	=>	array(
				2		=>	esc_html__( 'Small', 'lorada' ),
				3		=>	esc_html__( 'Medium', 'lorada' ),
				4		=>	esc_html__( 'Large', 'lorada' )
			),
			'default'	=>	2,
			'required'	=>	array(
				'product_sidebar_layout', '!=', 'full-width'
			)
		),

		array(
			'id'		=>	'ajax_add_to_cart',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Product Ajax Add to Cart', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Enable ajax add to cart in single product page.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'sticky_product_contents',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Sticky Product Contents', 'lorada' ),
			'default'	=>	false
		),

		array(
			'id'		=>	'sticky_add_to_cart',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Sticky Add to Cart Button', 'lorada' ),
			'default'	=>	false
		),

		array(
			'id'		=>	'single_product_countdown',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Product Sale CountDown', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show/Hide Sale CountDown in single product page.', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'single_countdown_view_style',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'CountDown View Style', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select product sale countdown view style.', 'lorada' ),
			'options'	=>	array(
				'border'	=>	esc_html__( 'Default', 'lorada' ),
				'dark'		=>	esc_html__( 'Rectangle Dark', 'lorada' ),
				'light'		=>	esc_html__( 'Rectangle Light', 'lorada' )
			),
			'default'	=>	'border',
			'required'	=>	array(
				'single_product_countdown', 'equals', true
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Page Elements', 'lorada' ),
	'id'			=>	'product_page_elements',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'product_navigation',
			'title'		=>	esc_html__( 'Product Navigation', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true
		),

		array(
			'id'		=>	'share_product_heading',
			'icon'		=>	'fas fa-chevron-right',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Share Buttons', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'share_product',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Show Product Share Buttons', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'product_share_type',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Share Button Types', 'lorada' ),
			'options'	=>	array(
				'follow'	=>	esc_html__( 'Follow', 'lorada' ),
				'share'		=>	esc_html__( 'Share', 'lorada' )
			),
			'default'	=>	'share',
			'required'	=>	array(
				'share_product', 'equals', true
			)
		),

		array(
			'id'		=>	'grouped_product_heading',
			'icon'		=>	'fas fa-chevron-right',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Grouped Products', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'grouped_product_position',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Grouped Products Position', 'lorada' ),
			'options'	=>	array(
				'standard'		=>	esc_html__( 'Standard Position', 'lorada' ),
				'after_summary'	=>	esc_html__( 'After Product Summary', 'lorada' )
			),
			'default'	=>	'standard'
		),

		array(
			'id'		=>	'related_product_heading',
			'icon'		=>	'fas fa-chevron-right',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Related Products', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'show_related_products',
			'title'		=>	esc_html__( 'Related Products', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true
		),

		array(
			'id'		=>	'related_products_count',
			'title'		=>	esc_html__( 'Related Products Count', 'lorada' ),
			'subtitle'	=>	esc_html__( 'How many products to show.', 'lorada' ),
			'type'		=>	'text',
			'default'	=>	4,
			'required'	=>	array(
				'show_related_products', 'equals', true
			)
		),

		array(
			'id'		=>	'related_products_columns',
			'title'		=>	esc_html__( 'Related Products Column', 'lorada' ),
			'subtitle'	=>	esc_html__( 'How many products to show per row.', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				2	=>	'2',
				3	=>	'3',
				4	=>	'4',
				5	=>	'5',
				6	=>	'6',
			),
			'default'	=>	4,
			'required'	=>	array(
				'show_related_products', 'equals', true
			)
		),

		array(
			'id'		=>	'related_product_view',
			'title'		=>	esc_html__( 'Related Product View', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose different view mode.', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				'grid'		=>	esc_html__( 'Grid', 'lorada' ),
				'carousel'	=>	esc_html__( 'Carousel', 'lorada' )
			),
			'default'	=>	'carousel',
			'required'	=>	array(
				'show_related_products', 'equals', true
			)
		),

		array(
			'id'		=>	'related_position',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Related Position', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show related products in standard or product sidebar.', 'lorada' ),
			'options'	=>	array(
				'standard'	=>	esc_html__( 'Standard', 'lorada' ),
				'sidebar'	=>	esc_html__( 'Sidebar', 'lorada' ),
			),
			'default'	=>	'standard',
			'required'	=>	array(
				'show_related_products', 'equals', true
			)
		),

		array(
			'id'		=>	'upsell_product_heading',
			'icon'		=>	'fas fa-chevron-right',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Upsells Products', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'show_upsell_products',
			'title'		=>	esc_html__( 'Upsells Products', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true
		),

		array(
			'id'		=>	'upsell_products_columns',
			'title'		=>	esc_html__( 'Upsells Products Column', 'lorada' ),
			'subtitle'	=>	esc_html__( 'How many products to show per row.', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				2	=>	'2',
				3	=>	'3',
				4	=>	'4',
				5	=>	'5',
				6	=>	'6',
			),
			'default'	=>	4,
			'required'	=>	array(
				'show_upsell_products', 'equals', true
			)
		),

		array(
			'id'		=>	'upsell_product_view',
			'title'		=>	esc_html__( 'Upsells Product View', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose different view mode.', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				'grid'		=>	esc_html__( 'Grid', 'lorada' ),
				'carousel'	=>	esc_html__( 'Carousel', 'lorada' )
			),
			'default'	=>	'carousel',
			'required'	=>	array(
				'show_upsell_products', 'equals', true
			)
		),

		array(
			'id'		=>	'upsells_position',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Upsells Position', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show upsells products in standard or product sidebar.', 'lorada' ),
			'options'	=>	array(
				'standard'	=>	esc_html__( 'Standard', 'lorada' ),
				'sidebar'	=>	esc_html__( 'Sidebar', 'lorada' ),
			),
			'default'	=>	'standard',
			'required'	=>	array(
				'show_upsell_products', 'equals', true
			)
		),

		array(
			'id'		=>	'cross_sell_product_heading',
			'icon'		=>	'fas fa-chevron-right',
			'type'		=>	'info',
			'raw'		=>	'<h3>' . esc_html__( 'Cross-sells Products', 'lorada' ) . '</h3>'
		),

		array(
			'id'		=>	'show_cross_sell_products',
			'title'		=>	esc_html__( 'Cross-sells Products', 'lorada' ),
			'type'		=>	'switch',
			'default'	=>	true
		),

		array(
			'id'		=>	'cross_sell_products_columns',
			'title'		=>	esc_html__( 'Cross-sells Products Column', 'lorada' ),
			'subtitle'	=>	esc_html__( 'How many products to show per row.', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				2	=>	'2',
				3	=>	'3',
				4	=>	'4',
				5	=>	'5',
				6	=>	'6',
			),
			'default'	=>	4,
			'required'	=>	array(
				'show_cross_sell_products', 'equals', true
			)
		),

		array(
			'id'		=>	'cross_sell_product_view',
			'title'		=>	esc_html__( 'Cross-sells Product View', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose different view mode.', 'lorada' ),
			'type'		=>	'button_set',
			'options'	=>	array(
				'grid'		=>	esc_html__( 'Grid', 'lorada' ),
				'carousel'	=>	esc_html__( 'Carousel', 'lorada' )
			),
			'default'	=>	'carousel',
			'required'	=>	array(
				'show_cross_sell_products', 'equals', true
			)
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Images Setting', 'lorada' ),
	'id'			=>	'product_images_set',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'product_img_width',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'Product Image Width', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose different product image size as your need.', 'lorada' ),
			'options'	=>	array(
				1	=>	esc_html__( 'Small Width', 'lorada' ),
				2	=>	esc_html__( 'Medium Width', 'lorada' ),
				3	=>	esc_html__( 'Large Width', 'lorada' )
			),
			'default'	=>	2
		),

		array(
			'id'		=>	'thumbnail_position',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'Product Thumbnail Layout', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose your thumbnail position such as vertical, horizontal and etc.', 'lorada' ),
			'options'	=>	array(
				'left'				=>	esc_html__( 'Left Vertical Slider', 'lorada' ),
				'bottom'			=>	esc_html__( 'Bottom Horizontal Slider', 'lorada' ),
				'img_list'			=>	esc_html__( 'Main Image List', 'lorada' ),
				'img_list_thumbs'	=>	esc_html__( 'Main Image List with Thumbnails', 'lorada' ),
				'two_col_1'			=>	esc_html__( 'Two Columns Layout', 'lorada' ),
				'two_col_2'			=>	esc_html__( 'Two Columns Fit Layout', 'lorada' ),
				'without_thumbs'	=>	esc_html__( 'Without Thumbnails', 'lorada' )
			),
			'default'	=>	'left',
		),

		array(
			'id'		=>	'main_slider_auto_height',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Main Slider Auto Height', 'lorada' ),
			'default'	=>	false,
			'required'	=>	array(
				'thumbnail_position', 'equals', array( 'left', 'bottom', 'without_thumbs' )
			)
		),

		array(
			'id'		=>	'image_action',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Product Image Action', 'lorada' ),
			'options'	=>	array(
				'zoom'			=>	esc_html__( 'Zoom', 'lorada' ),
				'swipe_popup'	=>	esc_html__( 'Photoswipe Popup', 'lorada' )
			),
			'default'	=>	'zoom'
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Filter Tabs', 'lorada' ),
	'id'			=>	'product_filter_tabs',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'product_tabs_view',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Tabs View Style', 'lorada' ),
			'options'	=>	array(
				'tabs'			=>	esc_html__( 'Default Tab', 'lorada' ),
				'accordion'		=>	esc_html__( 'Accordion', 'lorada' )
			),
			'default'	=>	'tabs'
		),

		array(
			'id'		=>	'product_tabs_position',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Tabs Position', 'lorada' ),
			'options'	=>	array(
				'standard'	=>	esc_html__( 'Standard Position', 'lorada' ),
				'after_cart_btn'	=>	esc_html__( 'After "Add to Cart" button', 'lorada' )
			),
			'default'	=>	'standard',
			'required'	=>	array(
				'product_tabs_view', 'equals', 'accordion'
			)
		),

		array(
			'id'		=>	'additional_tab_title',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Additional Tab Title', 'lorada' ),
			'subtitle'	=>	esc_html__( 'If you leave empty, additional tab will not be appeared.', 'lorada' ),
			'default'	=>	'Additional Info'
		),

		array(
			'id'		=>	'additional_tab_content',
			'type'		=>	'textarea',
			'title'		=>	esc_html__( 'Additional Tab Content', 'lorada' ),
			'subtitle'	=>	esc_html__( 'You can also use shortcodes here. Ex: [lorada_html_block block_id="65"]', 'lorada' )
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Social Setting', 'lorada' ),
	'id'			=>	'social_setting',
	'icon'			=>	'fas fa-share-square',
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Social Links', 'lorada' ),
	'id'			=>	'social-follow',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'follow_info', 'type'		=>	'info',
			'desc'		=>	esc_html__( 'Configure [lorada_social_buttons] shortcode. If you leave empty field, that particular link will be removed. There are two types of social buttons. [lorada_social_buttons type="follow"]: It is shown simple social links. [lorada_social_buttons type="share"]: It is shown social icons that share your page in social media. You can use both types.', 'lorada' )
		),

		array(
			'id'		=>	'facebook_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Facebook link', 'lorada' ),
			'default'	=>	'#'
		),

		array(
			'id'		=>	'twitter_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Twitter link', 'lorada' ),
			'default'	=>	'#'
		),

		array(
			'id'		=>	'google_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Google+ link', 'lorada' ),
			'default'	=>	'#'
		),

		array(
			'id'		=>	'instagram_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Instagram link', 'lorada' ),
			'default'	=>	'#'
		),

		array(
			'id'		=>	'pinterest_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Pinterest link', 'lorada' ),
			'default'	=>	'#'
		),

		array(
			'id'		=>	'youtube_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Youtube link', 'lorada' ),
			'default'	=>	'#'
		),

		array(
			'id'		=>	'linkedin_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'LinkedIn link', 'lorada' ),
			'default'	=>	'#'
		),

		array(
			'id'		=>	'vimeo_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Vimeo link', 'lorada' ),
			'default'	=>	''
		),

		array(
			'id'		=>	'tumblr_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Tumblr link', 'lorada' ),
			'default'	=>	''
		),

		array(
			'id'		=>	'flickr_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Flickr link', 'lorada' ),
			'default'	=>	''
		),

		array(
			'id'		=>	'github_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Github link', 'lorada' ),
			'default'	=>	''
		),

		array(
			'id'		=>	'vk_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'VK link', 'lorada' ),
			'default'	=>	''
		),

		array(
			'id'		=>	'dribbble_link',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Dribbble link', 'lorada' ),
			'default'	=>	''
		),

		array(
			'id'		=>	'social_email',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Email for Social link', 'lorada' ),
			'default'	=>	true
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Social Share', 'lorada' ),
	'id'			=>	'social-share',
	'subsection'	=>	true,
	'icon'			=>	'fas fa-chevron-right',
	'fields'		=>	array(
		array(
			'id'		=>	'follow_info',
			'type'		=>	'info',
			'desc'		=>	esc_html__( 'Configure [lorada_social_buttons] shortcode. If you leave empty field, that particular link will be removed. There are two types of social buttons. [lorada_social_buttons type="follow"]: It is shown simple social links. [lorada_social_buttons type="share"]: It is shown social icons that share your page in social media. You can use both types.', 'lorada' )
		),

		array(
			'id'		=>	'facebook_share',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Facebook Share', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'twitter_share',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Twitter Share', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'google_share',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Google Plus Share', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'pinterest_share',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Pinterest Share', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'linkedin_share',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'LinkedIn Share', 'lorada' ),
			'default'	=>	true
		),

		array(
			'id'		=>	'vk_share',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'VK Share', 'lorada' ),
			'default'	=>	false
		),

		array(
			'id'		=>	'email_share',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Email for Share links', 'lorada' ),
			'default'	=>	true
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Promo Popup', 'lorada' ),
	'id'			=>	'promo_popup',
	'icon'			=>	'fas fa-bullhorn',
	'fields'		=>	array(
		array(
			'id'		=>	'enable_promo_popup',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Enable Promo Popup', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show promotion popup when visitors enter the site.', 'lorada' ),
			'default'	=>	false
		),

		array(
			'id'		=>	'promo_popup_width',
			'type'		=>	'slider',
			'title'		=>	esc_html__( 'Promo Popup Width', 'lorada' ),
			'min'		=>	300,
			'max'		=>	1200,
			'step'		=>	10,
			'default'	=>	850
		),

		array(
			'id'		=>	'popup_content_txt',
			'type'		=>	'editor',
			'title'		=>	esc_html__( 'Popup Content Text', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Add your promotion text or HTML Block shortcode.', 'lorada' )
		),

		array(
			'id'			=>	'popup_bg',
			'type'			=>	'background',
			'title'			=>	esc_html__( 'Popup Background', 'lorada' ),
			'subtitle'		=>	esc_html__( 'Set popup background setting', 'lorada' ),
			'default'		=> array(
				'background-image'		=>	'',
				'background-color'		=>	'#222',
				'background-repeat'		=>	'no-repeat',
				'background-size'		=>	'contain',
				'background-position'	=>	'left center',
			),
			'transparent' 	=>	false,
		),

		array(
			'id'		=>	'popup_condition',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Popup Condition', 'lorada' ),
			'options'	=>	array(
				'delay'		=>	esc_html__( 'Delay Time', 'lorada' ),
				'scrolling'	=>	esc_html__( 'Page Scroll', 'lorada' )
			),
			'default'	=>	'delay'
		),

		array(
			'id'		=>	'popup_delay_time',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Popup Delay Time (ms)', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Show promotion popup after delay time.', 'lorada' ),
			'default'	=>	'3000',
			'required'	=>	array(
				array( 'popup_condition', 'equals', 'delay' )
			)
		),

		array(
			'id'		=>	'popup_page_scroll',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Scroll Top Position (px)', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Add scroll top position where popup appears.', 'lorada' ),
			'default'	=>	500,
			'required'	=>	array(
				array( 'popup_condition', 'equals', 'scrolling' )
			)
		),

		array(
			'id'		=>	'change_page_num',
			'type'		=>	'slider',
			'title'		=>	esc_html__( 'Change Page Number Before Showing Popup', 'lorada' ),
			'min'		=>	0,
			'max'		=>	5,
			'step'		=>	1,
			'default'	=>	0
		),

		array(
			'id'		=>	'promo_version',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Promo Popup Version', 'lorada' ),
			'subtitle'	=>	esc_html__( 'If you change your cookie policy information you can increase their version to show the popup to all visitors again.', 'lorada' ),
			'default'	=>	1
		),

		array(
			'id'		=>	'hide_promo_popup_mobile',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Hide Popup on mobile device.', 'lorada' ),
			'default'	=>	1
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Cookies Law', 'lorada' ),
	'id'			=>	'cookie-setting',
	'icon'			=>	'fas fa-user-secret',
	'fields'		=>	array(
		array(
			'id'		=>	'show_cookie',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Show Cookies Notification', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Under EU privacy regulations, websites must make it clear to visitors what information about them is being stored. This specifically includes cookies. Turn on this option and user will see info box at the bottom of the page that your web-site is using cookies.', 'lorada' ),
			'default'	=>	false
		),

		array(
			'id'		=>	'cookies_text',
			'type'		=>	'editor',
			'title'		=>	esc_html__( 'Notification text', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Place here some information about cookies usage that will be shown in the popup.', 'lorada' ),
			'default'	=>	esc_html__( 'We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies.', 'lorada' )
		),

		array(
			'id'		=>	'cookies_policy_page',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'Page with details', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Choose page that will contain detailed information about your Privacy Policy', 'lorada' ),
			'data'		=>	'pages'
		),

		array(
			'id'		=>	'cookies_version',
			'type'		=>	'text',
			'title'		=>	esc_html__( 'Cookies version', 'lorada' ),
			'subtitle'	=>	esc_html__( 'If you change your cookie policy information you can increase their version to show the popup to all visitors again.', 'lorada' ),
			'default'	=>	1
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Maintenance', 'lorada' ),
	'id'			=>	'maintenance_mode',
	'icon'			=>	'el el-cog',
	'fields'		=>	array(

		array(
			'id'		=>	'coming_soon_mode',
			'type'		=>	'switch',
			'title'		=>	esc_html__( 'Maintenance Mode', 'lorada' ),
			'on'		=>	esc_html__( 'Enable', 'lorada' ),
			'off'		=>	esc_html__( 'Disable', 'lorada' ),
			'default'	=>	0
		),

		array(
			'id'					=>	'coming_soon_bg_image',
			'type'					=>	'background',
			'title'					=>	esc_html__( 'Coming Soon Background Image', 'lorada' ),
			'default'				=>	array(
				'background-color'	=>	'#fff'
			),
			'transparent'			=>	false,
			'background-repeat'		=>	false,
			'background-size'		=>	false,
			'background-attachment'	=>	false,
			'background-position'	=>	false,
			'required'				=>	array(
				'coming_soon_mode', 'equals', array( '1' )
			)
		),

		array(
			'id'		=>	'coming_soon_content',
			'type'		=>	'select',
			'title'		=>	esc_html__( 'Coming Soon Page Content', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Select "HTML Block" to show on Coming Soon Page', 'lorada' ),
			'data'		=>	'posts',
			'args'		=>	array(
				'post_type'			=> 'html_block',
				'posts_per_page'	=> -1,
				'orderby'			=> 'id',
				'order'				=> 'ASC',
			),
			'required'	=>	array(
				'coming_soon_mode', 'equals', array( '1' )
			)
		),

		array(
			'id'		=>	'coming_soon_content_pos',
			'type'		=>	'button_set',
			'title'		=>	esc_html__( 'Coming Soon Content Position', 'lorada' ),
			'options'	=>	array(
				'left'		=>	esc_html__( 'Left', 'lorada' ),
				'center'	=>	esc_html__( 'Center', 'lorada' ),
				'right'		=>	esc_html__( 'Right', 'lorada' ),
			),
			'default'	=>	'left',
			'required'	=>	array(
				'coming_soon_mode', 'equals', array( '1' )
			)
		),
	)
) );

Redux::setSection( $opt_name, array(
	'title'			=>	esc_html__( 'Custom Code', 'lorada' ),
	'id'			=>	'custom_code',
	'icon'			=>	'fas fa-code',
	'fields'		=>	array(
		array(
			'id'		=>	'custom_js',
			'title'		=>	esc_html__( 'Custom Javascript Code', 'lorada' ),
			'subtitle'	=>	esc_html__( 'Here is the place to paste your Google Analytics code or any other JS code you might want to add to be loaded in the footer of your website.', 'lorada' ),
			'type'		=>	'ace_editor',
			'mode'		=>	'javascript',
			'default'	=>	'jQuery(document).ready(function(){});'
		)
	)
) );
