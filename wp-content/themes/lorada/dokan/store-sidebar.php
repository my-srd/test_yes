<?php
/* Lorada Dokan Vendor Sidebar Template */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$sidebar_class = lorada_get_sidebar_class();

if ( strstr( $sidebar_class, 'col-lg-0' ) ) return;

if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_appearance', 'off' ) === 'off' ): 
?>
    <aside id="dokan-secondary" class="sidebar-container dokan-store-sidebar <?php echo esc_attr( $sidebar_class ) ?>" role="complementary"> 
        <div class="widget-heading">
            <a href="#" class="close-side-widget"><?php esc_html_e( 'close', 'lorada' ); ?></a>
        </div>

        <div class="sidebar-inner lorada-sidebar-scroll">
            <div class="widget-area lorada-sidebar-content">
                <?php do_action( 'dokan_sidebar_store_before', $store_user->data, $store_info ); ?>
                <?php
                if ( ! dynamic_sidebar( 'sidebar-store' ) ) {
                    $args = array(
                        'before_widget' => '<div class="sidebar-widget dokan-store-widget %s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h2 class="widget-title">',
                        'after_title'   => '</h2>',
                    );

                    if ( dokan()->widgets->is_exists( 'store_category_menu' ) ) {
                        the_widget( dokan()->widgets->store_category_menu, array( 'title' => esc_html__( 'Store Product Category', 'lorada' ) ), $args );
                    }

                    if ( dokan()->widgets->is_exists( 'store_location' ) && dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on'  && ! empty( $map_location ) ) {
                        the_widget( dokan()->widgets->store_location, array( 'title' => esc_html__( 'Store Location', 'lorada' ) ), $args );
                    }

                    if ( dokan()->widgets->is_exists( 'store_open_close' ) && dokan_get_option( 'store_open_close', 'dokan_general', 'on' ) == 'on' ) {
                        the_widget( dokan()->widgets->store_open_close, array( 'title' => esc_html__( 'Store Time', 'lorada' ) ), $args );
                    }

                    if ( dokan()->widgets->is_exists( 'store_contact_form' ) && dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
                        the_widget( dokan()->widgets->store_contact_form, array( 'title' => esc_html__( 'Contact Vendor', 'lorada' ) ), $args );
                    }
                }
                ?>

                <?php do_action( 'dokan_sidebar_store_after', $store_user->data, $store_info ); ?>
            </div>
        </div>
    </aside><!-- #secondary .widget-area -->
<?php else: ?>
    <?php get_sidebar( 'store' ); ?>
<?php endif; ?>
