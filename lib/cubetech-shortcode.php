<?php
function cubetech_blocks_shortcode($atts)
{
	extract(shortcode_atts(array(
		'group'			=> false,
		'orderby' 		=> array('menu_order'=>'ASC'),
		'numberposts'	=> 999,
		'offset'		=> 0,
		'poststatus'	=> 'publish',
	), $atts));
	
	if ( $group == false )
		return "Keine Gruppe angegeben";
		
	if ( $group == 'all' )
		$tax_query = false;
	else {
		$tax_query = array(
		    array(
		        'taxonomy' => 'cubetech_blocks_group',
		        'terms' => $group,
		        'field' => 'id',
		    )
		);
	}
	
	$args = array(
		'posts_per_page'  	=> 999,
		'numberposts'     	=> $numberposts,
		'offset'          	=> $offset,
		'orderby'         	=> $orderby,
		'post_type'       	=> 'cubetech_blocks',
		'post_status'     	=> $poststatus,
		'suppress_filters' 	=> true,
		'tax_query'			=> $tax_query,
	);
		
	$posts = get_posts($args);
	$class = '';
	$return = '';
	
	$return .= '</div><div class="cubetech-blocks-container">';
	
	foreach ($posts as $post) {
	
		$post_meta_data = get_post_custom($post->ID);
		$terms = wp_get_post_terms($post->ID, 'cubetech_blocks_group');
		$link = '';
		
		if(isset($post_meta_data['cubetech_blocks_internallink'][0]) && $post_meta_data['cubetech_blocks_internallink'][0] != '')
			$link = '<span class="cubetech-blocks-link"><a href="' . $post_meta_data['cubetech_blocks_internallink'][0] . '">Details</a></span>';
		elseif(isset($post_meta_data['cubetech_blocks_externallink'][0]) && $post_meta_data['cubetech_blocks_externallink'][0] != '')
			$link = '<span class="cubetech-blocks-link"><a href="' . $post_meta_data['cubetech_blocks_externallink'][0] . '" target="_blank">Details</a></span>';
		elseif ( $post_meta_data['cubetech_blocks_links'][0] != '' && $post_meta_data['cubetech_blocks_links'][0] != 'nope' && $post_meta_data['cubetech_blocks_links'][0] > 0 )
			$link = '<span class="cubetech-blocks-link"><a href="' . get_permalink( $post_meta_data['cubetech_blocks_links'][0] ) . '">Details</a></span>';
		
		$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		
		$return .= '
		<div class="cubetech-blocks">
			<div class="cubetech-blocks-image" style="background-image:url('.$thumbnail.')">
			</div>
			<div class="cubetech-blocks-content">
				<h2 class="cubetech-blocks-title">' . $post->post_title . '</h2>';
				if(isset($post_meta_data['cubetech_blocks_subtitle'][0]) && $post_meta_data['cubetech_blocks_subtitle'][0] != '')
					$return .= '<h3 class="cubetech-blocks-subtitle">' . $post_meta_data['cubetech_blocks_subtitle'][0] . '</h3>';
		$return .= '
				<div class="cubetech-blocks-content-container">' . $post->post_content . '</div>
				' . $link . '
			</div>
		</div>';

	}

	return $return . '</div>';

}
add_shortcode('cubetech-blocks', 'cubetech_blocks_shortcode');
?>
