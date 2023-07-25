<?php
/**
 * Yoast functions
 * 
 * @package kemroc 
 */

/**
 * Customize breadcrumbs links for news.
 * 
 * @param array $links Breadcrumbs links array.
 */
function kemroc_yoast_customize_breadcrumbs_links_for_news( $links ) {
	if ( is_admin() ) {
		return $links;
	}
	if ( ! is_singular( 'post' ) ) {
		return $links;
	}

	$breadcrumb[] = array(
		'url'  => kemroc_home_url() . esc_html_x( 'aktuelles', 'breadcrumbs', 'kemroc' ) . '/',
		'text' => esc_html__( 'Aktuelles', 'kemroc' ),
	);

	array_splice( $links, 1, -2, $breadcrumb );

	return $links;
}

add_filter( 'wpseo_breadcrumb_links', 'kemroc_yoast_customize_breadcrumbs_links_for_news' );
