<?php
/*
 * Maintenance Mode - "Coming Soon" Page Template
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$coming_soon_content = '';
$bg_image      = lorada_get_opt( 'coming_soon_bg_image' );
$content_block = lorada_get_opt( 'coming_soon_content' );
$content_pos   = lorada_get_opt( 'coming_soon_content_pos' );

if ( class_exists( 'Lorada_Core_Main_Functions' ) ) {
	if ( $content_block ) $coming_soon_content =  Lorada_Core_Main_Functions::instance()->lorada_core_html_block( array( 'block_id' => $content_block ) );
}

add_action('wp_footer', 'lorada_elementor_scripts');
if ( ! function_exists( 'lorada_elementor_scripts' ) ) {
	function lorada_elementor_scripts() {
		wp_enqueue_script( 'lorada-elementor-widgets' );
	}
}
?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="supports-fontface coming-soon-page">

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<link rel="profile" href="//gmpg.org/xfn/11">

		<!-- WordPress wp_head() -->
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<!-- Start Page Wrapper -->
		<div id="page-wrapper" class="page-full-layout">
			<div class="main-content coming_soon_content_wrapper" style="background-image: url(<?php echo esc_url($bg_image['background-image']) ?>); background-color: <?php echo esc_attr( $bg_image['background-color'] ); ?>;">
				<?php
					$content_class = '';
					if ( 'left' == $content_pos ) {
						$content_class = 'col-md-6 offset-md-0 offset-sm-2 col-sm-8';
					} elseif ( 'center' == $content_pos ) {
						$content_class = 'offset-md-3 col-md-6 offset-sm-2 col-sm-8';
					} elseif ( 'right' == $content_pos ) {
						$content_class = 'offset-md-6 col-md-6 offset-sm-2 col-sm-8';
					}
				?>

				<div class="container">
					<div class="row">
						<div class="<?php echo esc_attr( $content_class ) ?>">
							<?php
								// show coming soon page content
								echo '' . $coming_soon_content;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Page wrapper -->

		<?php

		/**
		 * lorada_footer_actions hook.
		 *
		 * @hooked lorada_sale_countdown_template - 10
		 */
		do_action( 'lorada_footer_actions' );

		wp_footer();

		?>

	</body>

</html>
