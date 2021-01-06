<?php
/**
 * 404 Page Template
 */

get_header();
?>

<div class="main-content container">
	<div class="row content-inner-404">
		<div class="col-md-12 text-center">
			<div class="description-content">
				<p>
					<?php esc_html_e( 'It seems we can`t find what you`re looking for. Perhaps searching can help or go back to', 'lorada' ); ?>
					<a href="<?php echo esc_url( home_url('/') ); ?>"><?php echo esc_html__( 'Homepage', 'lorada' ); ?></a>
				</p>
				<?php
					lorada_header_block_search_form( array(
						'ajax'	=>	false
					) );
				?>
			</div>

		</div>
	</div>
</div>

<?php get_footer(); ?>