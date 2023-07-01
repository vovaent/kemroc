<?php
add_action( 'wp_ajax_search_action', 'true_search' );
add_action( 'wp_ajax_nopriv_search_action', 'true_search' );
 
function true_search() {
 
	$search_term = isset( $_GET['term'] ) ? $_GET['term'] : '';
 
	$posts = get_posts(
		array(
			'posts_per_page' => 20,
			'post_type'      => array( 'post', 'page' ),
			's'              => $search_term,
		) 
	);
 
	$results = array();
 
	if ( $posts ) {
 
		foreach ( $posts as $post ) {
 
			$results[] = array(
				'id'    => $post->ID,
				'title' => $post->post_title,
				'url'   => get_permalink( $post->ID ),
			);
 
		}   
	}
 
	wp_send_json( $results );
 
}
