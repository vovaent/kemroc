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
		$file    = require $full_path_to_file; //phpcs:ignore
		$deps    = $file['dependencies'];
		$version = $file['version'];
	}

	return array(
		'deps'    => $deps,
		'version' => $version,
	);
}

/**
 * Getting product models amount
 * 
 * @param string $post_type Optional. Post type. Default post_type='page'.
 * @param int    $post_id Optional. Post id. Default current post id.
 * 
 * @return int
 */
function kemroc_get_models_amount( $post_type = 'page', $post_id = null ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = $post->ID;
	}

	$models_amount = 0;

	$models_args  = array(
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'posts_per_page' => -1, // phpcs:ignore
		'post_parent'    => $post_id,
	);
	$all_models   = get_posts( $models_args );
	$final_models = array();

	if ( ! empty( $all_models ) ) {
		foreach ( $all_models as $model ) {
			if ( get_field( 'unlist_on_product_page', $model->ID ) ) {
				continue;
			}

			$final_models[] = $model; 
		}
		
		$models_amount = count( $final_models );
	}

	return $models_amount;
}

/**
 * Getting product models for comparison
 * 
 * @param string $post_type Optional. Post type. Default post_type='page'.
 * @param int    $post_id Optional. Post id. Default current post id.
 * 
 * @return array
 */
function kemroc_get_models_compare( $post_type = 'page', $post_id = null ) {
	if ( null === $post_id ) {
		global $post;
		$post_id = $post->ID;
	}

	$new_models = array();

	$models_args = array(
		'post_type'      => $post_type,
		'post_status'    => 'publish',
		'posts_per_page' => -1, // phpcs:ignore
		'post_parent'    => $post_id,
	);
	
	$models = get_posts( $models_args );

	foreach ( $models as $key => $model ) {
		if ( get_field( 'unlist_on_product_page', $model->ID ) ) {
			continue;
		}

		$new_models[ $model->post_title ]['id'] = $model->ID;
						
		$blocks = parse_blocks( $model->post_content );
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

				if ( ! $params_key_title_post ) {
					continue;
				}

				$params_title            = $params_key_title_post->post_title;
				$params_measure_units    = get_field( 'measure_units', $params_key_title_post->ID );
				$params_us_measure_units = get_field( 'us_measure_units', $params_key_title_post->ID );
					
				$params_value    = 'params_' . $i . '_value';
				$params_us_value = 'params_' . $i . '_us_value';
				
				$params[ $params_title ]['default'] = $block_data[ $params_value ] . ' ' . $params_measure_units;
				$params[ $params_title ]['us']      = '';
				
				if ( $params_us_measure_units && isset( $block_data[ $params_us_value ] ) ) {
					$params[ $params_title ]['us'] = $block_data[ $params_us_value ] . ' ' . $params_us_measure_units;
				}           
			}
			break;
		}

		ksort( $params );
		$new_models[ $model->post_title ]['params'] = $params;
	}
	
	$new_models_keys = array_keys( $new_models );
	array_multisort( $new_models_keys, SORT_NATURAL, $new_models ); // phpcs:ignore

	return $new_models;
}

/**
 * Getting the insides of headers in the content.
 * 
 * @param string $content Optional. Searchable content.
 * @param string $tag Optional. Header tag.
 * 
 * @return array|void Returns an array of the insides of headers. If no string to search for is specified - returns false.
 */
function kemroc_get_headers_insides_in_content( $content = '', $tag = '' ) {
	if ( empty( $content ) ) {
		return;
	}

	if ( empty( $tag ) ) {
		$new_tag = 'h(1|2|3|4|5|6)';
	} else {
		$new_tag = "($tag)";
	}

	$headers_insides = array();
	$matches         = array();
	
	$pattern = '/<\s*' . $new_tag . '[^>]*>(.*?)<\/' . $new_tag . '>/';

	preg_match_all( $pattern, $content, $matches );

	if ( $matches[0] ) {
		
		foreach ( $matches[0] as $match ) {
			$header_inside     = preg_replace( $pattern, '$2', $match );
			$headers_insides[] = $header_inside;
		}
	}    

	return $headers_insides;
}
