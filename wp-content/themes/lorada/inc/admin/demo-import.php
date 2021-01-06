<?php
/**
 * Demo Import Admin Page
 */

$theme = wp_get_theme();
if ( $theme->parent_theme ) {
	if ( function_exists( 'get_parent_theme_file_path' ) ) {
		$template_dir = basename( get_parent_theme_file_path() );
	} else {
		$template_dir = basename( get_template_directory() );
	}

	$theme = wp_get_theme( $template_dir );
}

$tgmpa = TGM_Plugin_Activation::$instance;
$plugins = TGM_Plugin_Activation::$instance->plugins;

$demos = array();

$demo_names = array(
	'demo13' => array( 'alt' => 'Sleepwear', 'url' => 'https://lorada.c-themes.com/sleepwear/', 'new' => true ),
	'demo12' => array( 'alt' => 'Medical', 'url' => 'https://lorada.c-themes.com/medicine/', 'new' => true ),
	'demo1' => array( 'alt' => 'Default Shop', 'url' => 'https://lorada.c-themes.com/default-shop/', 'new' => false ),
	'demo2' => array( 'alt' => 'Fashion Classic', 'url' => 'https://lorada.c-themes.com/fashion-classic/', 'new' => false ),
	'demo3' => array( 'alt' => 'Fashion Modern', 'url' => 'https://lorada.c-themes.com/fashion-modern/', 'new' => false ),
	'demo4' => array( 'alt' => 'Fashion with Sidebar', 'url' => 'https://lorada.c-themes.com/fashion-with-side/', 'new' => false ),
	'demo5' => array( 'alt' => 'Simple Shop', 'url' => 'https://lorada.c-themes.com/simple-shop/', 'new' => false ),
	'demo6' => array( 'alt' => 'Furniture', 'url' => 'https://lorada.c-themes.com/furniture/', 'new' => false ),
	'demo7' => array( 'alt' => 'Cosmetics', 'url' => 'https://lorada.c-themes.com/cosmetics/', 'new' => false ),
	'demo8' => array( 'alt' => 'Jewelry', 'url' => 'https://lorada.c-themes.com/jewelry/', 'new' => false ),
	'demo9' => array( 'alt' => 'Winery', 'url' => 'https://lorada.c-themes.com/winery/', 'new' => false ),
    'demo10' => array( 'alt' => 'Organic', 'url' => 'https://lorada.c-themes.com/organic/', 'new' => false ),
    'demo11' => array( 'alt' => 'Technology', 'url' => 'https://lorada.c-themes.com/technology/', 'new' => false )
);

foreach ( $demo_names as $key => $demo_name ) {
	$num = str_replace( 'demo', '', $key );

	$demos[$key] = array(
		'title'	=>	$demo_name['alt'],
		'url'	=>	$demo_name['url'],
		'new' => $demo_name['new'],
		'img'	=>	LORADA_URI . '/images/demos/demo' . $num . '.jpg'
	);
}

$dummy_ready = false;

if ( is_dir( LORADA_DUMMY_DATA_DIR . 'data/' ) ) 
	$dummy_ready = true;
?>

<div class="wrap about-wrap lorada-welcome">
	<h1><?php echo esc_html__( 'Welcome to Lorada', 'lorada' ); ?></h1>

	<div class="about-text">
		<?php echo esc_html__( 'Thank you for purchasing our Lorada - multipurpose woocommerce theme. Theme is now installed and ready to use! Please install required plugins, and import our dummy content. We hope you enjoy it!', 'lorada' ); ?>

		<div class="lorada-thumb">
			<img src="<?php echo LORADA_URI; ?>/images/thumbnail.png" alt="lorada-thumbnail" />
			<span class="theme-version">
				<?php echo number_format( (float)lorada_theme_version(), 1 ); ?>
			</span>
		</div>
	</div>

	<div class="nav-tab-wrapper">
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=lorada_theme' ) ); ?>" class="nav-tab"><?php echo esc_html__( 'Required Plugins', 'lorada' ); ?></a>
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=system_status' ) ); ?>" class="nav-tab"><?php echo esc_html__( 'System Status', 'lorada' ); ?></a>
		<a href="#" class="nav-tab nav-tab-active"><?php echo esc_html__( 'Demo Import', 'lorada' ); ?></a>
		<a href="<?php echo esc_url( admin_url( 'admin.php?page=theme_options' ) ); ?>" class="nav-tab"><?php echo esc_html__( 'Theme Options', 'lorada' ); ?></a>
	</div>

	<div class="lorada-demo-import">
		<?php
		$import_ready = true;
		$plugins_required = true;

		$memory_limit = intval( substr( ini_get( 'memory_limit' ), 0, -1 ) );
		if ( $memory_limit < 256 ) {
			$import_ready = false;
		}

		$execution_time = intval( ini_get( 'max_execution_time' ) );
		if ( $execution_time < 30 ) {
			$import_ready = false;
		}

		$upload_size = intval( substr( size_format( wp_max_upload_size() ), 0, -1 ) );
		$size_unit = preg_replace( '/[0-9]+/', '', substr( size_format( wp_max_upload_size() ), 0, -1) );
		$upload_size_unit = str_replace( ' ', '', $size_unit );

		if ( 'M' == $upload_size_unit ) {
			if ( $upload_size < 12 ) {
				$import_ready = false;
			}
		}

		if ( ! ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ) ) {
			$import_ready = false;
			$fsockopen = true;
		}

		$posting['gzip']['name'] = 'GZip';
		if ( ! is_callable( 'gzopen' ) ) {
			$import_ready = false;
		}

		foreach ( $plugins as $plugin ) {
			if ( ! class_exists( $plugin['check_str'] ) && ! function_exists( $plugin['check_str'] ) ) {
				$plugins_required = false;
				break;
			}
		}
		?>

		<div class="theme-browser">
			<?php if ( $dummy_ready == true ) : ?>
				<?php
				if ( $plugins_required && $import_ready ) {
					?>
					<div class="lorada-admin-alert alert-success">
						<?php echo esc_html__( 'You are ready to import base demo content. Please select one demo, and import dummy content.', 'lorada' ); ?>
					</div>
					<?php
				} else {
					?>
					<div class="lorada-admin-alert alert-error">
						<?php echo esc_html__( 'You are not ready to import base demo content. Please check', 'lorada' ) . ' <a href="' . esc_url( admin_url( 'admin.php?page=system_status' ) ) . '">' . esc_html__( 'System Status', 'lorada' ) . '</a> ' . esc_html__( 'tab. You need to activate all "required plugins" and "Server Environment" tables.', 'lorada' ); ?>
					</div>
					<?php
				}
				?>

				<div id="lorada-install-options">
					<h3 class="title"><?php echo esc_html__( 'Install Options', 'lorada' ); ?></h3>

					<label for="lorada-import-options"><input type="checkbox" id="lorada-import-options" value="1" checked="checked"/> <?php echo esc_html__( 'Import theme options', 'lorada' ); ?></label>
					<input type="hidden" id="lorada-install-demo-type" value="landing"/>
					<label for="lorada-reset-menus"><input type="checkbox" id="lorada-reset-menus" value="1" checked="checked"/> <?php echo esc_html__( 'Reset menus', 'lorada' ); ?></label>
					<label for="lorada-reset-widgets"><input type="checkbox" id="lorada-reset-widgets" value="1" checked="checked"/> <?php echo esc_html__( 'Reset widgets', 'lorada' ); ?></label>
					<label for="lorada-import-dummy"><input type="checkbox" id="lorada-import-dummy" value="1" checked="checked"/> <?php echo esc_html__( 'Import dummy content', 'lorada' ); ?></label>
					<label for="lorada-import-widgets"><input type="checkbox" id="lorada-import-widgets" value="1" checked="checked"/> <?php echo esc_html__( 'Import widgets', 'lorada' ); ?></label>

					<p><?php echo esc_html__( 'Do you want to install demo? It can also take a minute to complete.', 'lorada' ); ?></p>

					<button class="button button-primary" id="lorada-import-yes"><?php echo esc_html__( 'Yes', 'lorada' ); ?></button>
					<button class="button" id="lorada-import-no"><?php echo esc_html__( 'No', 'lorada' ); ?></button>
				</div>

				<div id="import-status"></div>

				<div class="import-success importer-notice">
					<p>
					<?php echo esc_html__( 'The demo content has been imported successfully.', 'lorada' ) . '<a href="' . site_url() . '" target="_blank">' . esc_html__('View Site', 'lorada' ) . '</a>'; ?>
					</p>
				</div>

				<div class="import-demo-area">
					<div class="demo-list-inner">
						<?php foreach ( $demos as $demo => $demo_details ) : ?>
							<div class="demo-screenshot">
								<div class="screenshot-inner">
									<img src="<?php echo esc_url( $demo_details['img'] ); ?>" alt="<?php echo esc_attr( $demo ); ?>">

									<?php if ( $demo_details['new'] ) : ?>
									<span class="new-ribbon"><strong><?php echo esc_html__( 'New', 'Lorada' ); ?></strong></span>
									<?php endif; ?>

									<div id="<?php echo esc_attr( $demo ); ?>" class="demo-info">
										<?php echo esc_html( $demo_details['title'] ); ?>
									</div>
									<div class="demo-actions">
										<a href="<?php echo esc_url( $demo_details['url'] ) ?>" class="demo-preview-link" target="_blank">
											<?php echo esc_html__( 'Preview', 'lorada' ); ?>
										</a>

										<?php
											$disabled = '';

											if ( ! $plugins_required || ! $import_ready ) {
												$disabled = 'disabled=disabled';
											}

											printf( '<a href="#" class="button button-primary lorada-install-demo-button" data-demo-id="%s" %s>%s</a>', strtolower( $demo ), esc_attr( $disabled ), esc_html__( 'Install Demo', 'lorada' ) );
										?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php else : ?>
				<div class="lorada-admin-alert alert-info">
					<?php echo esc_html__( 'First, you need to download the demo data from our live server. The Demo data will be downloaded in wp-content/uploads folder. So please make sure this folder has writable permission.', 'lorada' ); ?>
				</div>
				
				<p class="download-btn-wrap">
					<?php printf( '<a href="%s" class="button-primary">%s</a>', admin_url( 'themes.php?page=demo_import&remote-action=download-dummy' ), esc_html__( 'Download Dummy Data', 'lorada' ) ); ?>
				</p>
			<?php endif; ?>
		</div>
	</div>
</div>
