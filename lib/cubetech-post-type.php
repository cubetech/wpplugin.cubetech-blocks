<?php
function cubetech_blocks_create_post_type() {
	register_post_type('cubetech_blocks',
		array(
			'labels' => array(
				'name' => __('Blöcke'),
				'singular_name' => __('Block'),
				'add_new' => __('Block hinzufügen'),
				'add_new_item' => __('Neuer Block hinzufügen'),
				'edit_item' => __('Block bearbeiten'),
				'new_item' => __('Neuer Block'),
				'view_item' => __('Block betrachten'),
				'search_items' => __('Blöcke durchsuchen'),
				'not_found' => __('Keine Blöcke gefunden.'),
				'not_found_in_trash' => __('Keine Blöcke gefunden.')
			),
			'capability_type' => 'post',
			'taxonomies' => array('cubetech_blocks_group'),
			'public' => false,
			'has_archive' => false,
			'rewrite' => array('slug' => 'blocks', 'with_front' => false),
			'show_ui' => true,
			'menu_position' => '20',
			'menu_icon' => null,
			'hierarchical' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'page-attributes')
		)
	);
}
add_action('init', 'cubetech_blocks_create_post_type');
?>
