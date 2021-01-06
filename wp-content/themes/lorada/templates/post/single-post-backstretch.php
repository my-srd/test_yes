<?php
/**
 * Post BackStretch Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">
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
			echo lorada_post_pagination();
			echo lorada_post_author();
			echo lorada_post_comments_field();
		?>
	</div>
</article>