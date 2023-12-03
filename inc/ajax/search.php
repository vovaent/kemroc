<?php
/**
 * Search processing
 * 
 * @package kemroc 
 */

/**
 * Ajax_products_action_callback
 */
function kemroc_live_search_callback() {
	if ( isset( $_GET['nonce'] ) && 
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['nonce'] ) ), 'products-nonce' ) 
	) {
		$err_message['spam'] = esc_html__( 'Daten, die von einer fremden Adresse gesendet werden', 'kemroc' );
	}
	
	$search_term = isset( $_GET['term'] ) ? sanitize_text_field( wp_unslash( $_GET['term'] ) ) : '';

	if ( 500 < $search_term ) {
		$search_term = substr( $search_term, 0, 500 );
	}
 
	$posts = get_posts(
		array(
			'posts_per_page' => 6,
			'post_type'      => array( 'post', 'page' ),
			's'              => $search_term,
		) 
	);
 
	$results = array();
 
	if ( $posts ) {
 
		foreach ( $posts as $post ) {
			$thumb = get_the_post_thumbnail( $post->ID );
			if ( '' === $thumb ) {
				$thumb = '<img src="' . get_template_directory_uri() . '/images/no-image.jpg" alt="" class="search-card__image">';
			}
			
			$excerpt = kemroc_get_the_excerpt( 7, $post->ID );
 
			$results[] = array(
				'id'      => $post->ID,
				'thumb'   => '<div class="search-card__thumbnail">' . $thumb . '</div><!-- /.search-card__thumbnail -->',
				'excerpt' => '<div class="search-card__excerpt">' . $excerpt . '</div><!-- /.search-card__excerpt -->',
				'label'   => $post->post_title,
				'value'   => '<h6 class="search-card__title">' . $post->post_title . '</h6><!-- /.search-card__title -->',
				'url'     => get_permalink( $post->ID ),
				'more'    => '<p class="btn btn-arrow-rounded search-card__pseudo-link">' .
									esc_html__( 'Mehr lesen', 'kemroc' ) .
									'<span>' .
										kemroc_get_template_part_content( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ) .
									'</span>
                                </p>',
			);
 
		}   
	}
 
	if ( $err_message ) {
		wp_send_json_error( $err_message );
	} else {
		wp_send_json_success( $results );
	}

	wp_die(); 
}

if ( wp_doing_ajax() ) {
	add_action( 'wp_ajax_search_action', 'kemroc_live_search_callback' );
	add_action( 'wp_ajax_nopriv_search_action', 'kemroc_live_search_callback' );
}
