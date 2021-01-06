<?php
/**
 * @package ceylonthemes
 * @subpackage eCommerce Plus
 * @since 1.0.0
 */
    $options = ecommerce_plus_get_theme_options();
	$copyright_text = $options['copyright_text'];

?>
</div><!-- #content -->
	
<footer id="colophon" class="site-footer" role="contentinfo" style="background-color:<?php echo esc_attr($options['footer_bg_color']); ?>" >

	<div class="container">
		<div class="row">
			<?php require get_template_directory() . '/inc/footer-widgets.php' ;?>		
		</div>		
	</div>


	<div class="site-info">
	
		<div class="container">


		<div class="row">
		<div class="col-sm-6 col-xs-12"> 
        <span>
        	<?php 
        	echo '<a href="https://ceylonthemes.com ">'.ecommerce_plus_santize_allowed_html( $copyright_text ).'</a>'; 
        	if ( function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( ' | ' );
			}
        	?>
    	</span>
		</div>
        <div class="col-sm-6 col-xs-12">
		<span><?php echo esc_html__( "Powered by eCommerce Plus" , 'ecommerce-plus' ); ?></span>
		</div>
		</div>
		
		</div><!-- .container -->
    </div><!-- .site-info -->


		<?php
		$options  = ecommerce_plus_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) :
		?><div class="backtotop"><?php echo ecommerce_plus_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif; ?>

		</footer>
		<div class="popup-overlay"></div>
		
		
<?php wp_footer(); ?>

</body>
</html>
