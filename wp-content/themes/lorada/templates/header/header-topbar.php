<?php
/**
 * Header Top Bar Template
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$classes = array();
$header_layout = apply_filters( 'lorada_header_layout', lorada_get_opt( 'header_layout' ) );

$classes[] = 'topbar-container';
if ( lorada_get_opt( 'top_bar_border' ) ) {
	$classes[] = 'border-enable';
}

$classes = implode( ' ', $classes );

if ( 'left_menu_bar' != $header_layout ) :
?>
<div id="header-topbar" class="<?php echo esc_attr( $classes ); ?>">
	<div class="topbar-wrapper">
		<div class="topbar-content">
			<div class="topbar-left-txt topbar-section">

				<?php if ( lorada_get_opt( 'currency_topbar_view' ) || lorada_get_opt( 'language_topbar_view' ) ) : ?>
					<div class="topbar-dropdown">

						<?php if ( lorada_get_opt( 'language_topbar_view' ) ) : ?>
							<div class="language-menu">
								<?php echo lorada_multi_language_switcher(); ?>
							</div>
						<?php endif; ?>

						<?php if ( lorada_get_opt( 'currency_topbar_view' ) ) : ?>
							<div class="currency-menu">
								<?php echo lorada_multi_currency_switcher(); ?>
							</div>
						<?php endif; ?>

					</div>
				<?php endif; ?>

				<?php if ( '' != lorada_get_opt( 'top_bar_txt' ) ) : ?>
					<div class="topbar-txt topbar-left-txt">
						<?php echo do_shortcode( lorada_get_opt( 'top_bar_txt' ) ); ?>
					</div>
				<?php endif; ?>

			</div>

			<div class="topbar-right-txt topbar-section">
				<?php if ( has_nav_menu( 'top-bar-menu' ) ) : ?>
					<div class="topbar-menu lorada-topbar-nav topbar-right-nav">
						<?php
							$walker = new LoradaWalker;

							wp_nav_menu( array(
								'theme_location'	=>	'top-bar-menu',
								'fallback_cb'		=>	false,
								'container'			=>	false,
								'items_wrap'		=>	'<ul class="%1$s topbar-navigation-wrapper">%3$s</ul>',
								'walker'			=>	$walker
							) );
						?>
					</div>
				<?php endif; ?>

				<?php if ( '' != lorada_get_opt( 'top_bar_right_txt' ) ) : ?>
					<div class="topbar-txt topbar-right-txt">
						<?php echo do_shortcode( lorada_get_opt( 'top_bar_right_txt' ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
endif;
