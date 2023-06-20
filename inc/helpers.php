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
		'post_status'    => 'published',
		'posts_per_page' => -1, // phpcs:ignore
		'post_parent'    => $post_id,
	);
	$models_query = new WP_Query( $models_args );

	if ( 0 < $models_query->post_count ) {
		$models_amount = $models_query->post_count;
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

	$models = array();

	$models_args  = array(
		'post_type'      => $post_type,
		'post_status'    => 'published',
		'posts_per_page' => -1, // phpcs:ignore
		'post_parent'    => $post_id,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	);
	$models_query = new WP_Query( $models_args );
	
	if ( $models_query->have_posts() ) {
		while ( $models_query->have_posts() ) {
			$models_query->the_post();
			
			$blocks                       = parse_blocks( get_the_content() );
			$params                       = array();
			$model_title                  = get_the_title();
			$models[ $model_title ]['id'] = get_the_ID();
			
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
			$models[ $model_title ]['params'] = $params;
		}   
		wp_reset_postdata();
	}

	return $models;
}

/**
 * Getting the insides of headers in the content.
 * 
 * @param string $content Optional. Searchable content.
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
