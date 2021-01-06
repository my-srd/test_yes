<?php
/**
 * The default template for displaying post content
 */

global $post, $post_counter;

$blog_style      = lorada_get_opt( 'blog_style' );
$blog_excerpt    = lorada_get_opt( 'blog_excerpt' );
$classes         = array();
$classes[]       = 'blog-post-item';
$thumb_size		 = 'lorada-blog-thumnail';

if ( '' == get_the_title() ){
	$classes[] = 'post-no-title';
}

if ( 1 == $blog_style ) $thumb_size = 'lorada-blog-thumnail-list';

if ( 3 != $blog_style ) {
	$post_content = '';
	$post_content = get_the_content();
	$post_content = lorada_strip_tags( apply_filters( 'the_content', $post_content ) );

	if ( 'full' != $blog_excerpt ) {
		$blog_excerpt_length_by = lorada_get_opt( 'blog_excerpt_length_by' );
		$blog_excerpt_length    = intval( lorada_get_opt( 'blog_excerpt_length' ) );

		if ( 'word' == $blog_excerpt_length_by ) {
			$post_content = explode( ' ', $post_content, $blog_excerpt_length );

			if ( count( $post_content ) >= $blog_excerpt_length ) {
				array_pop( $post_content );
				$post_content = implode( " ", $post_content ) . '... ';
			} else {
				$post_content = implode( " ", $post_content );
			}
		} else {
			$post_content = substr( $post_content, 0, $blog_excerpt_length ) . '... ';
		}
	}
} else {
	if ( ( 1 == $post_counter % 2 ) || ( 1 == $post_counter % 3 ) ) $thumb_size = 'lorada-blog-thumnail2';
}

$gallery = get_post_meta( $post->ID, '_lorada_post_gallery', true );
$video = get_post_meta( $post->ID, '_lorada_post_video', true );
$post_media_icon = '<i class="lorada lorada-picture"></i>';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="blog-post-inner">
		<?php if ( is_sticky($post->ID) ) : ?>
			<span class="sticky-post"><?php echo esc_html__( 'Featured', 'lorada' ); ?></span>
		<?php endif; ?>

		<?php if ( has_post_thumbnail($post->ID) ) : ?>
			<div class="post-head-part">
				<span class="featured-media-icon">
					<?php
						if ( ! empty( $gallery ) ) {
							$post_media_icon = '<i class="lorada lorada-pictures"></i>';
						}

						if ( ! empty( $video ) ) {
							$post_media_icon = '<i class="lorada lorada-clapboard-play"></i>';
						}

						echo '' . $post_media_icon;
					?>
				</span>

				<?php
				if ( class_exists('Lorada_Core_Elementor_Modules') && ! empty( $gallery ) && empty( $video ) ) {
					?>
					<div class="post-gallery-slider">
						<?php
							Lorada_Core_Elementor_Modules::instance()->post_gallery_list( $post->ID, '_lorada_post_gallery', $thumb_size );
						?>
					</div>
					<?php
				}
				?>

				<?php
				if ( class_exists('Lorada_Core_Elementor_Modules') && ! empty( $video ) ) {
					echo Lorada_Core_Elementor_Modules::instance()->post_video( $post->ID, '_lorada_post_video', $thumb_size );
				}
				?>

				<?php
				if ( ! class_exists('Lorada_Core_Elementor_Modules') || ( empty( $gallery ) && empty( $video ) ) ) {
					?>
					<a href="<?php echo get_permalink( $post->ID ); ?>" class="post-featured-part">
						<?php
							echo get_the_post_thumbnail( $post->ID, $thumb_size );
						?>
					</a>
					<?php
				}
				?>
			</div>
		<?php endif; ?>

		<div class="post-bottom-part">
			<h3 class="post-title">
				<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo esc_html( $post->post_title ); ?></a>
			</h3>

			<div class="post-info-part">
				<span class="post-date"><?php echo get_the_time( 'M j, Y', $post->ID ); ?></span>
				<span class="joint"><?php echo esc_html__( 'In', 'lorada' ); ?></span>
				<?php echo get_the_category_list( ', ', '', $post->ID ); ?>
			</div>

			<?php if ( 3 != $blog_style ) : ?>
				<div class="post-summary">
					<p class="summary-content"><?php echo '' . $post_content; ?></p>
				</div>
			<?php endif; ?>

			<?php if ( 2 != $blog_style ) : ?>
				<a href="<?php echo get_permalink( $post->ID ); ?>" class="lorada-btn post-read-more">
					<?php echo esc_html__( 'Read More', 'lorada' ); ?>
					<i class="lorada lorada-chevron-right"></i>
				</a>
			<?php else : ?>
				<a href="<?php echo get_permalink( $post->ID ); ?>" class="post-continue">
					<?php echo esc_html__( 'Continue', 'lorada' ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</article>
