<?php
/**
 * The template for displaying all pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_classes = array();

if ( 'full' == lorada_get_opt( 'site_layout' ) && 'custom' == lorada_get_opt( 'page_width' ) ) {
	$page_classes[] = 'container';
} else {
	$page_classes[] = 'container-fluid';
}

$page_classes = implode( ' ', $page_classes );
$content_class = lorada_get_content_class();

get_header();

lorada_page_heading();
?>

<div class="main-content <?php echo esc_attr( $page_classes ); ?>">
	<div class="row page-content-inner">
		<div class="entry-content <?php echo esc_attr( $content_class ); ?>">
			<!-- Loop Setting -->
			<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile;

			lorada_post_comments_field();
			?>
			<!-- Resetting the page Loop -->
		</div>

		<?php get_sidebar(); ?>
	</div>
</div>

<?php
get_footer();
