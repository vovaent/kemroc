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
