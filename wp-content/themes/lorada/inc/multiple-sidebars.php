<?php
/* Sidebar Generator Class */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Lorada_Sidebar_Generator {

	function __construct() {
		add_action( 'init', array( $this,'init' ) );
		add_action( 'admin_menu', array( $this,'admin_menu' ) );
		add_action( 'admin_enqueue_scripts',	array( $this,'admin_enqueue_scripts' ) );
		add_action( 'admin_print_scripts',	array( $this,'admin_print_scripts' ) );
		add_action( 'wp_ajax_add_sidebar',	array( $this,'add_sidebar' ) );
		add_action( 'wp_ajax_remove_sidebar',	array( $this,'remove_sidebar' ) );
	}

	static function init() {
		//go through each sidebar and register it
		$sidebars = Lorada_Sidebar_Generator::get_sidebars();

		if( is_array( $sidebars ) ) {
			foreach( $sidebars as $sidebar ) {
				$sidebar_class = Lorada_Sidebar_Generator::name_to_class( $sidebar );

				register_sidebar( array(
					'name'			=>	$sidebar,
					'id'			=>	'lorada-custom-sidebar-' . strtolower( $sidebar_class ),
					'before_widget'	=>	'<div id="%1$s" class="sidebar-widget %2$s">',
					'after_widget'	=>	'</div>',
					'before_title'	=>	'<h2 class="widget-title">',
					'after_title'	=>	'</h2>',
				) );
			}
		}
	}

	static function admin_enqueue_scripts() {
		wp_enqueue_script( array( 'sack' ) );
	}

	static function admin_print_scripts() {
		?>

		<script type="text/javascript">
			function add_sidebar( sidebar_name ) {
				var mysack = new sack( "<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );

				mysack.execute = 1;
				mysack.method = 'POST';
				mysack.setVar( "action", "add_sidebar" );
				mysack.setVar( "sidebar_name", sidebar_name );
				mysack.encVar( "cookie", document.cookie, false );
				mysack.onError = function() { alert( 'Ajax error. Cannot add sidebar' ) };
				mysack.runAJAX();

				return true;
			}

			function remove_sidebar( sidebar_name,num ) {
				var mysack = new sack( "<?php echo site_url(); ?>/wp-admin/admin-ajax.php" );

				mysack.execute = 1;
				mysack.method = 'POST';
				mysack.setVar( "action", "remove_sidebar" );
				mysack.setVar( "sidebar_name", sidebar_name );
				mysack.setVar( "row_number", num );
				mysack.encVar( "cookie", document.cookie, false );
				mysack.onError = function() { alert( 'Ajax error. Cannot add sidebar' ) };
				mysack.runAJAX();

				return true;
			}
		</script>

		<?php
	}

	static function add_sidebar() {
		$sidebars = Lorada_Sidebar_Generator::get_sidebars();
		$name = str_replace( array( "\n", "\r", "\t" ),'',$_POST['sidebar_name'] );
		$id = Lorada_Sidebar_Generator::name_to_class( $name );

		if( isset( $sidebars[$id] ) ) {
			die( "alert('Sidebar already exists, please use a different name.')" );
		}

		$sidebars[$id] = $name;
		Lorada_Sidebar_Generator::update_sidebars( $sidebars );

		$js = "
			var tbl = document.getElementById('sbg_table');
			var lastRow = tbl.rows.length;
			// if there's no header row in the table, then iteration = lastRow + 1
			var iteration = lastRow;
			var row = tbl.insertRow(lastRow);

			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$name');
			cellLeft.appendChild(textNode);

			//middle cell
			var cellLeft = row.insertCell(1);
			var textNode = document.createTextNode('$id');
			cellLeft.appendChild(textNode);

			//var cellLeft = row.insertCell(2);
			//var textNode = document.createTextNode('[<a href=\'javascript:void(0);\' onclick=\'return remove_sidebar_link($name);\'>Remove</a>]');
			//cellLeft.appendChild(textNode)

			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
			linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'remove_sidebar_link(\'$name\')');
			removeLink.setAttribute('href', 'javascript:void(0)');

			removeLink.appendChild(linkText);
			cellLeft.appendChild(removeLink);
		";

		die( "$js" );
	}

	static function remove_sidebar() {
		$sidebars = Lorada_Sidebar_Generator::get_sidebars();
		$name = str_replace( array( "\n", "\r", "\t" ), '', $_POST['sidebar_name'] );
		$id = Lorada_Sidebar_Generator::name_to_class( $name );

		if( ! isset( $sidebars[$id] ) ) {
			die( "alert('Sidebar does not exist.')" );
		}

		$row_number = $_POST['row_number'];

		unset( $sidebars[$id] );

		Lorada_Sidebar_Generator::update_sidebars( $sidebars );
		$js = "
			var tbl = document.getElementById('sbg_table');
			tbl.deleteRow($row_number)
		";

		die( $js );
	}

	static function admin_menu() {
		add_theme_page( 
			esc_html__( 'Sidebars', 'lorada' ), 
			esc_html__( 'Sidebars', 'lorada' ), 
			'manage_options', 
			'multiple_sidebars', 
			array( 'Lorada_Sidebar_Generator', 'admin_page' ) 
		);
	}

	static function admin_page() {
		?>
		<script>
			function remove_sidebar_link( name, num ) {
				answer = confirm( "Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar." );

				if( answer ) {
					//alert('AJAX REMOVE');
					remove_sidebar( name, num );
				} else {
					return false;
				}
			}

			function add_sidebar_link() {
				var sidebar_name = prompt( "Sidebar Name:", "" );
				//alert(sidebar_name);
				add_sidebar( sidebar_name );
			}
		</script>

		<div class="wrap">
			<h2><?php echo esc_html__( 'Sidebars', 'lorada' ); ?></h2>

			<br />

			<table class="widefat page" id="sbg_table" style="width:600px;">
				<tr>
					<th><?php echo esc_html__( 'Sidebar Name', 'lorada' ); ?></th>
					<th><?php echo esc_html__( 'CSS class', 'lorada' ); ?></th>
					<th><?php echo esc_html__( 'Remove', 'lorada' ); ?></th>
				</tr>

				<?php
				$sidebars = Lorada_Sidebar_Generator::get_sidebars();

				//$sidebars = array('bob','john','mike','asdf');
				if( is_array( $sidebars ) && ! empty( $sidebars ) ) {
					$cnt=0;

					foreach ( $sidebars as $sidebar ) {
						$alt = $cnt%2 == 0 ? 'alternate' : '' ;
						?>

						<tr class="<?php echo esc_attr( $alt ); ?>">
							<td><?php echo esc_html( $sidebar ); ?></td>
							<td><?php echo Lorada_Sidebar_Generator::name_to_class( $sidebar ); ?></td>
							<td><a href="javascript:void(0);" onclick="return remove_sidebar_link( '<?php echo esc_js( $sidebar ); ?>',<?php echo esc_js( $cnt+1 ); ?>);" title="<?php echo esc_attr__( 'Remove this sidebar', 'lorada' ); ?>"><?php echo esc_html__( 'remove', 'lorada' ); ?></a></td>
						</tr>

						<?php
						$cnt++;
					}
				} else {
					?>

					<tr>
						<td colspan="3"><?php echo esc_html__( 'No Sidebars defined', 'lorada' ); ?></td>
					</tr>

					<?php
				}
				?>

			</table><br /><br />

			<div class="add_sidebar">
				<a href="javascript:void(0);" onclick="return add_sidebar_link()" title="<?php echo esc_attr__( 'Add New Sidebar', 'lorada' ); ?>" class="button-primary">+ <?php echo esc_html__( 'Add New Sidebar', 'lorada' ); ?></a>
			</div>

		</div>

		<?php
	}

	/**
	 * for saving the pages/post
	*/
	static function save_form( $post_id ) {
		if( isset( $_POST['sbg_edit'] ) ) {
			$is_saving = $_POST['sbg_edit'];

			if( ! empty( $is_saving ) ) {
				delete_post_meta( $post_id, 'sbg_selected_sidebar' );
				delete_post_meta( $post_id, 'sbg_selected_sidebar_replacement' );

				add_post_meta( $post_id, 'sbg_selected_sidebar', $_POST['sidebar_generator'] );
				add_post_meta( $post_id, 'sbg_selected_sidebar_replacement', $_POST['sidebar_generator_replacement'] );
			}
		}
	}

	static function edit_form() {
		global $post;

		$post_id = $post;
		if ( is_object( $post_id ) ) {
			$post_id = $post_id->ID;
		}

		$selected_sidebar = get_post_meta( $post_id, 'sbg_selected_sidebar', true );
		if( ! is_array( $selected_sidebar ) ) {
			$tmp = $selected_sidebar;
			$selected_sidebar = array();
			$selected_sidebar[0] = $tmp;
		}

		$selected_sidebar_replacement = get_post_meta( $post_id, 'sbg_selected_sidebar_replacement', true );
		if( ! is_array( $selected_sidebar_replacement ) ) {
			$tmp = $selected_sidebar_replacement;
			$selected_sidebar_replacement = array();
			$selected_sidebar_replacement[0] = $tmp;
		}
		?>

		<div id='sbg-sortables' class='meta-box-sortables'>
			<div id="sbg_box" class="postbox " >
				<div class="handlediv" title="Click to toggle"><br /></div>

				<h3 class='hndle'><span><?php echo esc_html__( 'Sidebar', 'lorada' ) ?></span></h3>

				<div class="inside">
					<div class="sbg_container">
						<input name="sbg_edit" type="hidden" value="sbg_edit" />

						<p><?php echo esc_html__('Please select the sidebar you would like to display on this page. <strong>Note:</strong> You must first create the sidebar under Appearance > Sidebars.', 'lorada'); ?></p>

						<ul>
						<?php
							global $wp_registered_sidebars;

							for( $i=0; $i<1; $i++ ) { 
								?>

								<li>
									<select name="sidebar_generator[<?php echo esc_attr( $i )?>]" style="display: none;">
										<option value="0"<?php if ( $selected_sidebar[$i] == '' ) { echo " selected"; } ?>><?php echo esc_html__( 'WP Default Sidebar', 'lorada' ); ?></option>

										<?php
										$sidebars = $wp_registered_sidebars;

										if( is_array( $sidebars ) && ! empty( $sidebars ) ) {
											foreach( $sidebars as $sidebar ) {
												if( $selected_sidebar[$i] == $sidebar['name'] ) {
													echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
												} else {
													echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
												}
											}
										}
										?>
									</select>

									<select name="sidebar_generator_replacement[<?php echo esc_attr( $i ); ?>]">
										<option value="0"<?php if ( $selected_sidebar_replacement[$i] == '' ) { echo " selected"; } ?>><?php echo esc_html__( 'None', 'lorada' ); ?></option>
										<?php

										$sidebar_replacements = $wp_registered_sidebars;
										if( is_array( $sidebar_replacements ) && ! empty( $sidebar_replacements ) ) {
											foreach( $sidebar_replacements as $sidebar ) {
												if( $selected_sidebar_replacement[$i] == $sidebar['name'] ) {
													echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
												} else {
													echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
												}
											}
										}
										?>
									</select>

								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
	static function get_sidebar( $name="0" ) {
		if ( ! is_singular() ) {
			if ( $name != "0" ) {
				if ( is_active_sidebar( $name ) ) :
					dynamic_sidebar( $name );
				endif;
			} else {
				if ( is_active_sidebar( 'lorada-post-sidebar' ) ) :
					dynamic_sidebar( 'lorada-post-sidebar' );
				endif;
			}

			return;//dont do anything
		}

		wp_reset_postdata();

		global $wp_query;

		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta( $post->ID, '_lorada_custom_sidebar', true );
		$did_sidebar = false;

		//this page uses a generated sidebar
		if ( ! empty( $selected_sidebar ) ) {
			if ( $selected_sidebar == 'default' ) {
				$did_sidebar = Lorada_Sidebar_Generator::default_behavior();
			} else {
				if ( is_active_sidebar( $selected_sidebar ) ) :
					dynamic_sidebar( $selected_sidebar );
				endif;
			}
		} else {
			if ( $name != "0" ) {
				if ( is_active_sidebar( $name ) ) :
					dynamic_sidebar( $name );
				endif;
			} else {
				$did_sidebar = Lorada_Sidebar_Generator::default_behavior();
			}
		}
	}

	/**
	 * replaces array of sidebar names
	*/
	static function update_sidebars($sidebar_array) {
		$sidebars = update_option('sbg_sidebars',$sidebar_array);
	}

	/**
	 * gets the generated sidebars
	*/
	static function get_sidebars() {
		$sidebars = get_option('sbg_sidebars');

		return $sidebars;
	}

	static function name_to_class( $name ) {
		$class = str_replace( array( ' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'', $name );

		return $class;
	}

	static function default_behavior() {
		$did_sidebar = false;

		if ( is_singular( 'room' ) ) {
			if ( is_active_sidebar( 'lorada-room-sidebar' ) ) :
				dynamic_sidebar( 'lorada-room-sidebar' );
			endif;

			$did_sidebar = true;
		}

		if ( ! $did_sidebar ) {
			if ( is_active_sidebar( 'lorada-blog-sidebar' ) ) :
				dynamic_sidebar( 'lorada-blog-sidebar' );//default behavior
			endif;

			$did_sidebar = true;
		}

		if ( ! $did_sidebar ) {
			if ( is_active_sidebar( 'lorada-post-sidebar' ) ) :
				dynamic_sidebar( 'lorada-post-sidebar' );//default behavior
			endif;

			$did_sidebar = true;
		}

		return $did_sidebar;
	}
}

$sbg = new Lorada_Sidebar_Generator;

function generated_dynamic_sidebar( $name = '0' ) {
	Lorada_Sidebar_Generator::get_sidebar( $name );

	return true;
}