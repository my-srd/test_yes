<?php
/**
 * Comment Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) : 
	?>

	<p class="no-comments">
		<?php echo __('This post is password protected. Enter the password to view comments.', 'lorada'); ?>
	</p>

	<?php

	return;
endif;


if ( have_comments() ) : ?>
	<div class="post-block post-comments-inner clearfix" id="comments">
		
		<h2 class="comment-title"><?php
			printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'lorada' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<ul class="comments">
			<?php
				// Comments list
				wp_list_comments( array(
					'short_ping'  => true,
					'avatar_size' => 120,
					'callback' => 'lorada_comment'
				) );
			?>
		</ul>

		<?php
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="clearfix">
				<div class="pagination" role="navigation">
					<?php paginate_comments_links() ?>
				</div>
			</div>
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><?php _e( 'Comments are closed.' , 'lorada' ); ?></p>
		<?php endif; ?>
	</div>
<?php endif; // have_comments() ?>

<?php

$comments_args = array(
	// change the title of the reply section
	'title_reply'   => esc_html__( 'Leave a comment', 'lorada' ),
	//Define Fields
    'fields' => array(
        //Author field
        'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" size="30" maxlength="245" required="required" placeholder="' . esc_attr__( 'Name', 'lorada' ) .' *"></input></p>',
        //Email Field
        'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" size="30" maxlength="100" aria-describedby="email-notes" required="required" placeholder="' . esc_attr__( 'Email', 'lorada' ) .' *"></input></p>',
        //URL Field
        'url' => '<p class="comment-form-url"><input id="url" name="url" type="text" size="30" maxlength="200" placeholder="' . esc_attr__( 'Website', 'lorada' ) .'"></input></p>'
    ),
	// remove "Text or HTML to be displayed after the set of comment fields"
	'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" placeholder="' . _x( 'Your message here', 'noun', 'lorada' ) . '"></textarea></p>',
	// change the label of submit button
	'label_submit'	=> esc_html__( 'Submit', 'lorada' )
);

comment_form($comments_args);