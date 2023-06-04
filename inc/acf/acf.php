<?php
/**
 * ACF functions
 * 
 * @package kemroc 
 */

/**
 * Blocks
 */
require get_template_directory() . '/inc/acf/blocks.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * ACF add options sub_page
 */
function kemroc_acf_option_init() {
	if ( function_exists( 'acf_add_options_sub_page' ) ) {

		$parent = acf_add_options_page(
			array(
				'page_title' => __( 'Themen Einstellungen', 'kemroc' ),
				'menu_title' => __( 'Themen Einstellungen', 'kemroc' ),
				'menu_slug'  => 'theme-general-settings',
				'capability' => 'edit_posts',
				'redirect'   => false,
			)
		);
	}
}
add_action( 'acf/init', 'kemroc_acf_option_init' );
