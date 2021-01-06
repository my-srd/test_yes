<?php
/**
 *	Menu Admin Edit Custom
 */
class LoradaMenuEditCustom extends Walker_Nav_Menu  {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
	}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth, $wpdb;

		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = $original_object->post_title;
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __('%s (Invalid)', 'lorada'), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)', 'lorada'), $item->title );
		}

		$title = empty( $item->label ) ? $title : $item->label;

		$menu_marker_array = get_option( 'lorada_menu_marker_opt' );
		$marker_keys = array();
		if ( $menu_marker_array && is_array( $menu_marker_array ) ) {
			$marker_keys = array_keys( $menu_marker_array );
		}

		$args = array(
			'posts_per_page'	=>	-1,
			'numberposts'		=>	-1,
			'post_type'			=>	'html_block'
		);

		$html_block_posts = get_posts( $args );
		$html_block_dropdown = array();

		foreach ( $html_block_posts as $post ) :
			setup_postdata( $post );
			$html_block_dropdown[ esc_html__( 'Select Block', 'lorada' ) ] = 'select_block';
			$html_block_dropdown[ $post->post_title ] = $post->ID;
		endforeach;

		?>
		<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo esc_attr( implode(' ', $classes ) ); ?>">
			<dl class="menu-item-bar">
				<dt class="menu-item-handle">
					<span class="item-title"><?php echo esc_html( $title ); ?></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'lorada'); ?>">&#8593;</abbr></a>
							|
							<a href="<?php
								echo wp_nonce_url(
									add_query_arg(
										array(
											'action' => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								);
							?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'lorada'); ?>">&#8595;</abbr></a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>" title="<?php esc_attr_e('Edit Menu Item', 'lorada'); ?>" href="<?php
							echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>"><span class="screen-reader-text"><?php _e( 'Edit Menu Item', 'lorada' ); ?></span></a>
					</span>
				</dt>
			</dl>

			<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
				<?php if( 'custom' == $item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
							<?php _e('URL', 'lorada'); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-thin">
					<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
						<?php _e('Navigation Label', 'lorada'); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
					</label>
				</p>
				<p class="description description-thin">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
						<?php _e('Title Attribute', 'lorada'); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
						<?php _e('Open link in a new window/tab', 'lorada'); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
						<?php _e('CSS Classes (optional)', 'lorada'); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
						<?php _e('Link Relationship (XFN)', 'lorada'); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
						<?php _e('Description', 'lorada'); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', 'lorada'); ?></span>
					</label>
				</p>
				<?php
				/* New fields insertion starts here */
				?>
				<div class="clear"></div>

				<div class="lorada-custom-option">
					<h4><?php echo esc_html__( 'Lorada Custom Fields', 'lorada' ); ?></h4>
				</div>
				<p class="field-menu-style description description-wide">
					<label for="edit-menu-item-style-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Menu Style', 'lorada' ); ?>
						<select id="edit-menu-item-style-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-style" name="menu-item-style[<?php echo esc_attr( $item_id ); ?>]">
							<option value="default-menu" <?php selected( $item->menu_style, 'default-menu', true);?>>
								<?php esc_html_e('Default Menu', 'lorada'); ?>
							</option>
							<option value="full-width-mega" <?php selected( $item->menu_style, 'full-width-mega', true); ?>>
								<?php esc_html_e('Full width mega menu', 'lorada'); ?>
							</option>
							<option value="sized-mega" <?php selected( $item->menu_style, 'sized-mega', true); ?>>
								<?php esc_html_e('Set sizes mega menu', 'lorada'); ?>
							</option>
						</select>
					</label>
				</p>
				<p class="field-size-width description description-thin">
					<label for="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Dropdown Menu Width', 'lorada' ); ?>
						<input type="number" id="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-width" name="menu-item-width[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_width ); ?>">
					</label>
				</p>
				<p class="field-size-height description description-thin">
					<label for="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Dropdown Menu height', 'lorada' ); ?>
						<input type="number" id="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-height" name="menu-item-height[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_height ); ?>">
					</label>
				</p>
				<p class="field-menu-background description description-wide">
					<label for="edit-menu-item-background-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Submenu Background URL', 'lorada' ); ?>
						<input type="text" id="edit-menu-item-background-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-background" name="menu-item-background[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_background ); ?>" placeholder="http://">
					</label>
				</p>
				<p class="field-menu-icon description description-wide">
					<label for="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Menu Icon (Add FontAwesome 5.x or Lorada icon font ) class)', 'lorada' ); ?>
						<input type="text" id="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-icon" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_icon ); ?>" placeholder="fas fa-cog">
					</label>
				</p>
				<p class="field-html-block description description-wide">
					<label for="edit-menu-item-block-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'HTML Block for dropdown menu', 'lorada' ); ?>
						<select id="edit-menu-item-block-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-block" name="menu-item-block[<?php echo esc_attr( $item_id ); ?>]">

							<?php
							if ( ! empty( $html_block_dropdown ) ) {
								foreach ($html_block_dropdown as $title => $id): ?>
									<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $item->menu_block, $id, true); ?>><?php echo esc_html( $title ); ?></option>
							<?php
								endforeach;
							} ?>

						</select>
					</label>
				</p>
				<p class="field-menu-marker description description-wide">
					<label for="edit-menu-item-marker-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Main Menu Marker', 'lorada' ); ?>
						<select id="edit-menu-item-marker-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-marker" name="menu-item-marker[<?php echo esc_attr( $item_id ); ?>]">
							<option value="title" <?php if ($item->menu_marker == "title" ) echo "selected"; ?>>
								<?php esc_html_e( 'Select Menu Marker', 'lorada' ); ?>
							</option>

							<?php
							if ( ! empty( $marker_keys ) ) {
								foreach ( $marker_keys as $marker_key ) { ?>

								<option value="<?php echo esc_attr( $marker_key ); ?>" <?php selected( $item->menu_marker, $marker_key, true); ?> >
									<?php echo esc_html( $marker_key ); ?>
								</option>

								<?php }
							}
							?>
						</select>
					</label>
				</p>
				<p class="field-submenu-text-scheme description description-wide">
					<label for="edit-submenu-text-scheme-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'Submenu Text Color Scheme', 'lorada' ); ?>
						<select id="edit-submenu-text-scheme-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-submenu-text-scheme" name="submenu-text-scheme[<?php echo esc_attr( $item_id ); ?>]">
							<option value="default" <?php selected( $item->submenu_text_scheme, 'default', true); ?>>
								<?php esc_html_e('Default', 'lorada'); ?>
							</option>
							<option value="light" <?php selected( $item->submenu_text_scheme, 'light', true); ?>>
								<?php esc_html_e('Light', 'lorada'); ?>
							</option>
							<option value="dark" <?php selected( $item->submenu_text_scheme, 'dark', true); ?>>
								<?php esc_html_e('Dark', 'lorada'); ?>
							</option>
						</select>
					</label>
				</p>
				<?php
				/* New fields insertion ends here */
				?>
				<div class="menu-item-actions description-wide submitbox">
					<?php if( 'custom' != $item->type && $original_title !== false ) : ?>
						<p class="link-to-original">
							<?php printf( __('Original: %s', 'lorada'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
						</p>
					<?php endif; ?>
					<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php
					echo wp_nonce_url(
						add_query_arg(
							array(
								'action' => 'delete-menu-item',
								'menu-item' => $item_id,
							),
							remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
						),
						'delete-menu_item_' . $item_id
					); ?>"><?php _e('Remove', 'lorada'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo esc_attr( $item_id ); ?>" href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
						?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php _e('Cancel', 'lorada'); ?></a>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				<div style="clear: both;"></div>
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php

		$output .= ob_get_clean();

		}
}
