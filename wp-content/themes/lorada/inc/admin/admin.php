<?php
/**
 * Lorada Admin Page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Lorada_Admin_Pages' ) ) {
	class Lorada_Admin_Pages {
		public $theme_name = 'lorada';

		/**
		 * Construct
		 */
		public function __construct() {
			$wp_upload_dir = wp_upload_dir();
			$dummy_data_base_dir = $wp_upload_dir['basedir'] . '/' . $this->theme_name . '_dummy/';

			// Define Value
			define( 'LORADA_DUMMY_DATA_DIR' , $dummy_data_base_dir );

			// Action Lists
			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_init', array( $this, 'get_remote_dummy_data' ) );
			add_action( 'admin_menu', array( $this, 'lorada_theme_admin_menu' ) );
			add_action( 'admin_menu', array( $this, 'lorada_theme_system_status' ) );
			add_action( 'admin_menu', array( $this, 'lorada_theme_import_menu' ) );
			add_action( 'after_switch_theme', array( $this, 'activation_redirect' ) );
		}

		public function admin_init() {
			if ( current_user_can( 'edit_theme_options' ) ) {
	            if ( isset( $_GET['lorada-deactivate'] ) && 'deactivate-plugin' == $_GET['lorada-deactivate'] ) {
	                check_admin_referer( 'lorada-deactivate', 'lorada-deactivate-nonce' );

	                $plugins = TGM_Plugin_Activation::$instance->plugins;

	                foreach ( $plugins as $plugin ) {
	                    if ( $plugin['slug'] == $_GET['plugin'] ) {
	                        deactivate_plugins( $plugin['file_path'] );
	                    }
	                }
				}

				if ( isset( $_GET['lorada-activate'] ) && 'activate-plugin' == $_GET['lorada-activate'] ) {
	                check_admin_referer( 'lorada-activate', 'lorada-activate-nonce' );

	                $plugins = TGM_Plugin_Activation::$instance->plugins;

	                foreach ( $plugins as $plugin ) {
	                    if ( isset( $_GET['plugin'] ) && $plugin['slug'] == $_GET['plugin'] ) {
	                        activate_plugin( $plugin['file_path'] );

	                        wp_redirect( admin_url( 'admin.php?page=lorada_theme' ) );
	                        exit;
	                    }
	                }
	            }

				$php_version = phpversion();
				if ( version_compare( $php_version, '5.4', '<' ) ) {
					add_action( 'admin_notices', array( $this, 'php_low_version_notice' ) );
				}
			}
		}

		function php_low_version_notice() {
			$html = '<div class="notice notice-error">';
			$html .= '<h2>' . __( 'Lorada Theme Notification', 'lorada' ) . '</h2>';
			$html .= '<p>' . __( 'Current PHP version is ', 'lorada' ) . phpversion() . '.</p>';
			$html .= '<p><strong>' . __( 'We recommend a minimum PHP version of 5.4', 'lorada' ) . '.</strong></p>';
			$html .= '</div>';

			echo '' . $html;
		}

		public function get_remote_dummy_data() {
			if ( isset( $_GET['remote-action'] ) && ( 'download-dummy' == $_GET['remote-action'] ) ) {
				if ( ! is_dir( LORADA_DUMMY_DATA_DIR ) ) {
					mkdir( LORADA_DUMMY_DATA_DIR, 0777 );
				}

				$virtual_file = LORADA_DUMMY_DATA_DIR . 'sample.zip';
				$remote_file = 'https://c-themes.com/download-files/' . $this->theme_name . '-dummy-data.zip';

				$data = file_get_contents( $remote_file );
				$file = fopen( $virtual_file, 'w+' );
				fputs( $file, $data );
				fclose( $file );

				if ( file_exists($virtual_file) ) {
					WP_Filesystem();
					unzip_file( $virtual_file , LORADA_DUMMY_DATA_DIR );
				}

				@unlink( $virtual_file );

				wp_redirect( admin_url('admin.php?page=demo_import') );
			}
		}

		function activation_redirect() {
			if ( current_user_can('edit_theme_options') ) {
				header('Location:' . admin_url() . 'admin.php?page=lorada_theme');
			}
		}

		function lorada_theme_admin_menu() {
			add_theme_page(
				lorada_parent_theme_name(),
				lorada_parent_theme_name(),
				'administrator',
				'lorada_theme',
				array( $this, 'theme_welcome_page' )
			);
		}

		function theme_welcome_page() {
			require_once( LORADA_ADMIN . '/lorada-welcome.php' );
		}

		function lorada_theme_system_status() {
			add_theme_page(
				__( 'System Status', 'lorada' ),
				__( 'System Status', 'lorada' ),
				'administrator',
				'system_status',
				array( $this, 'system_status_page' )
			);
		}

		function system_status_page() {
			require_once( LORADA_ADMIN . '/system-status.php' );
		}

		function lorada_theme_import_menu() {
			add_theme_page(
				__( 'Demo Import', 'lorada' ),
				__( 'Demo Import', 'lorada' ),
				'administrator',
				'demo_import',
				array( $this, 'lorada_demo_import' )
			);
		}

		function lorada_demo_import() {
			require_once( LORADA_ADMIN . '/demo-import.php' );
		}

		public function plugin_link( $item ) {
			$installed_plugins = get_plugins();

			$item['sanitized_plugin'] = $item['name'];

			$actions = array();

			// We have a repo plugin
			if ( ! $item['version'] ) {
				$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
			}

			/** We need to display the 'Install' hover link */
			if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
				$actions = array(
					'install' => sprintf(
						'<a href="%1$s" class="button button-primary" title="' . __( 'Install', 'lorada' ) .' %2$s">' . __( 'Install', 'lorada' ) . '</a>',
						esc_url( wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-install' => 'install-plugin',
									'return_url'    => 'lorada_theme',
								),
								TGM_Plugin_Activation::$instance->get_tgmpa_url()
							),
							'tgmpa-install',
							'tgmpa-nonce'
						) ),
						$item['sanitized_plugin']
					),
				);
			}
			/** We need to display the 'Activate' hover link */
			elseif ( is_plugin_inactive( $item['file_path'] ) ) {
				$actions = array(
					'activate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="' . __( 'Activate', 'lorada' ) . ' %2$s">' . __( 'Activate', 'lorada' ) . '</a>',
						esc_url( add_query_arg(
							array(
								'plugin'               => urlencode( $item['slug'] ),
								'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
								'plugin_source'        => urlencode( $item['source'] ),
								'lorada-activate'       => 'activate-plugin',
								'lorada-activate-nonce' => wp_create_nonce( 'lorada-activate' ),
							),
							admin_url( 'admin.php?page=lorada_theme' )
						) ),
						$item['sanitized_plugin']
					),
				);
			}
			/** We need to display the 'Update' hover link */
			elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
				$actions = array(
					'update' => sprintf(
						'<a href="%1$s" class="button button-primary" title="' . __( 'Update', 'lorada' ) . ' %2$s">' . __( 'Update', 'lorada' ) . '</a>',
						wp_nonce_url(
							add_query_arg(
								array(
									'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'        => urlencode( $item['slug'] ),
									'tgmpa-update'  => 'update-plugin',
									'plugin_source' => urlencode( $item['source'] ),
									'version'       => urlencode( $item['version'] ),
									'return_url'    => 'lorada_theme',
								),
								TGM_Plugin_Activation::$instance->get_tgmpa_url()
							),
							'tgmpa-update',
							'tgmpa-nonce'
						),
						$item['sanitized_plugin']
					),
				);
			} elseif ( class_exists( $item['check_str'] ) || function_exists( $item['check_str'] ) ) {
				$actions = array(
					'deactivate' => sprintf(
						'<a href="%1$s" class="button button-primary" title="' . __( 'Deactivate', 'lorada' ) . ' %2$s">' . __( 'Deactivate', 'lorada' ) . '</a>',
						esc_url( add_query_arg(
							array(
								'plugin'                 => urlencode( $item['slug'] ),
								'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
								'plugin_source'          => urlencode( $item['source'] ),
								'lorada-deactivate'       => 'deactivate-plugin',
								'lorada-deactivate-nonce' => wp_create_nonce( 'lorada-deactivate' ),
							),
							admin_url( 'admin.php?page=lorada_theme' )
						) ),
						$item['sanitized_plugin']
					),
				);
			}

			return $actions;
		}
	}

	new Lorada_Admin_Pages;
}
