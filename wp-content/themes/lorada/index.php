<?php
/**
 * Main Blog Post Page Template
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( lorada_is_ajax() ) { 
	do_action( 'lorada_main_loop' );
	die();
}

get_header();

lorada_page_heading();

// Get content container width
$content_class = lorada_get_content_class();
$wrapper_class = '';
$blog_width    = lorada_get_opt( 'blog_width' );
$site_layout   = lorada_get_opt( 'site_layout' );

if ( 'full' == $site_layout && 'boxed' == $blog_width ) { 
	$wrapper_class .= ' container';
}
?>

<div class="main-content <?php echo esc_attr( $wrapper_class ) ?>">
	<div class="row content-layout-wrapper justify-content-between">
		<div class="site-content <?php echo esc_attr( $content_class ) ?>" role="main"> 

			<?php 
			/**
			 * Hook: lorada_main_loop.
			 *
			 * @hooked lorada_main_loop - 10
			 */
			do_action( 'lorada_main_loop' );

			?>

		</div>

		<?php 

		get_sidebar();

		?>
	</div>
</div>

<?php
get_footer();