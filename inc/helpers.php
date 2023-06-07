<?php
/**
 * Helpers
 * 
 * @package kemroc
 */

/**
 * Retrievs asset data
 * 
 * @param string $path_to_file Path to file.
 * 
 * @return array
 */
function kemroc_get_asset_data( $path_to_file ) {

	// Set default fallback to dependencies array.
	$deps    = array();
	$version = '';

	// Check to see if the file exists.
	$full_path_to_file = get_theme_file_path( $path_to_file );

	// If the file can be found, use it to set the dependencies array.
	if ( file_exists( $full_path_to_file ) ) {
		$file    = require $full_path_to_file;
		$deps    = $file['dependencies'];
		$version = $file['version'];
	}

	return array(
		'deps'    => $deps,
		'version' => $version,
	);
}

/**
 * Retrievs product models
 * 
 * @param string $post_type Post type.
 * 
 * @return array
 */
function kemroc_get_models( $post_type ) {
	// Get models.
	$models_args  = array(
		'post_type'      => $post_type,
		'post_status'    => 'published',
		'posts_per_page' => -1, // phpcs:ignore
		'post_parent'    => get_the_ID(),
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);
	$models_query = new WP_Query( $models_args );
	
	$models = array();

	if ( $models_query->have_posts() ) {
		while ( $models_query->have_posts() ) {
			$models_query->the_post();
			
			$blocks = parse_blocks( get_the_content() );
			$params = array();

			foreach ( $blocks as $block ) {
				if ( 'acf/model-info' !== $block['blockName'] ) {
					continue;
				}

				$block_data   = $block['attrs']['data'];
				$block_params = $block_data['params'];

				if ( empty( $block_params ) ) {
					break;
				}
				
				for ( $i = 0; $i < $block_params; $i++ ) { 
					$params_key_title_post_id = 'params_' . $i . '_title';
					$params_key_title_post    = get_post( $block_data[ $params_key_title_post_id ] );
					$params_title             = $params_key_title_post->post_title;
					
					$params_value = 'params_' . $i . '_value';
					
					$params[ $params_title ] = $block_data[ $params_value ];
				}
				break;
			}

			ksort( $params );
			$model_title = get_the_title();
			
			$models[ $model_title ]['id']     = get_the_ID();
			$models[ $model_title ]['params'] = $params;
		}   
		wp_reset_postdata();
	}

	return $models;
}
