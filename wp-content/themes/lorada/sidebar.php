<?php
/* Lorada Sidebar Template */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$sidebar_class = lorada_get_sidebar_class();
$sidebar_name = lorada_get_sidebar_name();

if ( strstr( $sidebar_class, 'col-lg-0' ) ) return;

?>

<aside class="sidebar-container <?php echo esc_attr( $sidebar_class ) ?> area-<?php echo esc_attr( $sidebar_name ) ?>" role="complementary"> 
	<div class="widget-heading">
		<a href="#" class="close-side-widget"><?php esc_html_e( 'close', 'lorada' ); ?></a>
	</div>

	<div class="sidebar-inner lorada-sidebar-scroll">
		<div class="widget-area lorada-sidebar-content">
			<?php
				do_action( 'lorada_before_sidebar_area' );

				dynamic_sidebar( $sidebar_name );

				do_action( 'lorada_after_sidebar_area' );
			?>
		</div>
	</div>
</aside>