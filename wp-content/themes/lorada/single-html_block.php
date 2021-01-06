<?php
/**
 * Single HTML Blcok Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="single-html-block-content">
	<div class="container-fluid">
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					the_content();
				endwhile;
			endif;
		?>
	</div>
</div>

<?php 
get_footer();