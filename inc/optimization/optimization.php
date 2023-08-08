<?php
/**
 * Optimization
 * 
 * @package kemroc
 */

require get_template_directory() . '/inc/optimization/critical-css.php'; //phpcs:ignore

function kemroc_dequeue_dashicon() {
	if ( current_user_can( 'update_core' ) ) {
		return;
	}

	if ( is_admin() ) {
		return;
	}
	
	wp_deregister_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'kemroc_dequeue_dashicon' );
