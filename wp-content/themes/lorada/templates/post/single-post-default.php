<?php
/**
 * Post Default Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = get_the_ID();
$gallery = get_post_meta( $post_id, '_lorada_post_gallery', true );
$video = get_post_meta( $post_id, '_lorada_post_video', true );
$content_class = lorada_get_content_class();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner <?php if ( 'col-lg-12' == $content_class ) echo esc_attr('row justify-content-center no-sidebar'); ?>">
		<?php if ( 'col-lg-12' == $content_class ) : ?>
		<div class="col-lg-8">
		<?php endif; ?>
		<div class="post-breadcrumb"><?php lorada_post_breadcrumbs(); ?></div>
		<h2 class="post-title"><?php the_title(); ?></h2>
		<div class="post-meta">
				<span class="post-date"><?php echo get_the_date(); ?></span>
				<span class="joint"><?php echo esc_html__( 'In', 'lorada' ); ?></span>
				<div class="post-categories"><?php echo get_the_category_list(' '); ?></div>
			</div>
		<?php if ( 'col-lg-12' == $content_class ) : ?>
		</div>
		<?php endif; ?>

		<?php if ( 'col-lg-12' == $content_class ) : ?>
		<div class="col-lg-12">
		<?php endif; ?>
		<div class="post-feature-wrap">
			<?php
			if ( class_exists('Lorada_Core_Elementor_Modules') && ! empty( $gallery ) && empty( $video ) ) {
				?>
				<div class="post-gallery-slider">
					<?php 
						Lorada_Core_Elementor_Modules::instance()->post_gallery_list( $post_id, '_lorada_post_gallery', 'lorada-single-post' ); 
					?>
				</div>
				<?php
			}
			?>

			<?php
			if ( class_exists('Lorada_Core_Elementor_Modules') && ! empty( $video ) ) {
				echo Lorada_Core_Elementor_Modules::instance()->post_video( $post_id, '_lorada_post_video', 'lorada-single-post' );
			}
			?>
			
			<?php
			if ( ! class_exists('Lorada_Core_Elementor_Modules') || ( empty( $gallery ) && empty( $video ) ) ) {
				?>
				<a href="<?php echo get_permalink( $post_id ); ?>" class="post-featured-part">
					<?php
						echo get_the_post_thumbnail( $post_id, 'lorada-single-post' ); 
					?>
				</a>
				<?php
			}								
			?>
		</div>
		<?php if ( 'col-lg-12' == $content_class ) : ?>
		</div>
		<?php endif; ?>

		<?php if ( 'col-lg-12' == $content_class ) : ?>
		<div class="col-lg-8">
		<?php endif; ?>
		<div class="post-content">
			<?php 
				the_content(); 

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'lorada' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'lorada' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			?>
		</div>
			<div class="tag-social-wrap">
		<?php 
			echo lorada_post_tags();
			echo lorada_post_share_buttons();
				?>
			</div>
			<?php
			echo lorada_post_author();
			echo lorada_post_pagination();
			echo lorada_post_comments_field();
		?>
		<?php if ( 'col-lg-12' == $content_class ) : ?>
		</div>
		<?php endif; ?>
	</div>
</article>