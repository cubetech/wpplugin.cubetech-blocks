<?php
function cubetech_blocks_create_taxonomy() {
	
	$labels = array(
		'name'                => __( 'Blockgruppen'),
		'singular_name'       => __( 'Blockgruppe' ),
		'search_items'        => __( 'Gruppen durchsuchen' ),
		'all_items'           => __( 'Alle Blockgruppen' ),
		'edit_item'           => __( 'Blockgruppe bearbeiten' ), 
		'update_item'         => __( 'Blockgruppe aktualisiseren' ),
		'add_new_item'        => __( 'Neue Blockgruppe hinzufügen' ),
		'new_item_name'       => __( 'Gruppenname' ),
		'menu_name'           => __( 'Blockgruppe' )
	);

	$args = array(
		'hierarchical'        => true,
		'labels'              => $labels,
		'show_ui'             => true,
		'show_admin_column'   => true,
		'query_var'           => true,
		'rewrite'             => array( 'slug' => 'cubetech_blocks' )
	);

	register_taxonomy( 'cubetech_blocks_group', array( 'cubetech_blocks' ), $args );
	flush_rewrite_rules();
}
add_action('init', 'cubetech_blocks_create_taxonomy');
?>
