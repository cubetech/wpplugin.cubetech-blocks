<?php
/**
 * Plugin Name: cubetech Blocks
 * Plugin URI: http://www.cubetech.ch
 * Description: cubetech Blocks - generate some blocks, reusable within groups and shorttags
 * Version: 1.0
 * Author: cubetech GmbH
 * Author URI: http://www.cubetech.ch
 */

include_once('lib/cubetech-post-type.php');
include_once('lib/cubetech-shortcode.php');
include_once('lib/cubetech-group.php');
include_once('lib/cubetech-metabox.php');

add_image_size( 'cubetech-blocks-thumb', 400, 335, true );

wp_enqueue_script('jquery');
wp_register_script('cubetech_blocks_js', plugins_url('assets/js/cubetech-blocks.js', __FILE__), 'jquery');
wp_enqueue_script('cubetech_blocks_js');

add_action('wp_enqueue_scripts', 'cubetech_blocks_add_styles');

function cubetech_blocks_add_styles() {
	wp_register_style('cubetech-blocks-css', plugins_url('assets/css/cubetech-blocks.css', __FILE__) );
	wp_enqueue_style('cubetech-blocks-css');
}

add_filter('nav_menu_css_class', 'cubetech_blocks_current_type_nav_class', 10, 2 );
function cubetech_blocks_current_type_nav_class($classes, $item) {
    $post_type = get_query_var('post_type');
    if(($key = array_search('current_page_parent', $classes)) !== false) {
	    unset($classes[$key]);
	}
    if ($item->attr_title != '' && $item->attr_title == $post_type) {
        array_push($classes, 'current-menu-item');
    }
    return $classes;
}

function cubetech_blocks_custom_colors() {
   echo '<style type="text/css">
           th#year { width: 10%; }
         </style>';
}

add_action('admin_head', 'cubetech_blocks_custom_colors');

/* Add button to TinyMCE */
function cubetech_blocks_addbuttons() {

	if ( (! current_user_can('edit_posts') && ! current_user_can('edit_pages')) )
		return;
	
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_cubetech_blocks_tinymce_plugin");
		add_filter('mce_buttons', 'register_cubetech_blocks_button');
		add_action( 'admin_footer', 'cubetech_blocks_dialog' );
	}
}
 
function register_cubetech_blocks_button($buttons) {
   array_push($buttons, "|", "cubetech_blocks_button");
   return $buttons;
}
 
function add_cubetech_blocks_tinymce_plugin($plugin_array) {
	$plugin_array['cubetech_blocks'] = plugins_url('assets/js/cubetech-blocks-tinymce.js', __FILE__);
	return $plugin_array;
}

add_action('init', 'cubetech_blocks_addbuttons');

function cubetech_blocks_dialog() { 

	$args=array(
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	$taxonomies = get_terms('cubetech_blocks_group', $args);
	
	?>
	<style type="text/css">
		#cubetech_blocks_dialog { padding: 10px 30px 15px; }
	</style>
	<div style="display:none;" id="cubetech_blocks_dialog">
		<div>
			<p>Wählen Sie bitte die einzufügende Blockgruppe:</p>
			<p><select name="cubetech_blocks_taxonomy" id="cubetech_blocks_taxonomy">
				<option value="">Bitte Gruppe auswählen</option>
				<option value="all">Alle Kategorien anzeigen</option>
				<?php
				foreach($taxonomies as $tax) :
					echo '<option value="' . $tax->term_id . '">' . $tax->name . '</option>';
				endforeach;
				?>
			</select></p>
		</div>
		<div>
			<p><input type="submit" class="button-primary" value="Blockgruppe einfügen" onClick="if ( cubetech_blocks_taxonomy.value != '' && cubetech_blocks_taxonomy.value != 'undefined' ) { tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[cubetech-blocks group=' + cubetech_blocks_taxonomy.value + ']'); tinyMCEPopup.close(); }" /></p>
		</div>
	</div>
	<?php
}

?>
