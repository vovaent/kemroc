<?php
/**
 * Yoast functions
 * 
 * @package kemroc
 */

/**
 * Custom separator for breadcrumbs
 * 
 * @param string $sep Separator HTML code.
 */
function kemroc_wpseo_breadcrumb_separator( $sep ) {
	$custom_sep = '<span class="breadcrumbs__separator">';

	ob_start();

	get_template_part(
		'template-parts/icons/arrow-right',
		null,
		array(
			'width'  => 3.6,
			'height' => 6,
		) 
	);
	$custom_sep .= ob_get_contents();
	$custom_sep .= '</span>';
	
	ob_end_clean();
	
	return $custom_sep;
}
add_filter( 'wpseo_breadcrumb_separator', 'kemroc_wpseo_breadcrumb_separator', 10, 1 );
