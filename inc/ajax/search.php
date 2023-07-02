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
									esc_html__( 'Alle produkte', 'kemroc' ) .
									'<span>' .
										kemroc_get_template_part_content( 'template-parts/icons/arrow', 'right', array( 'fill' => '#ff6000' ) ) .
									'</span>
                                </p>',
			);
 
		}   
	}
 
	wp_send_json( $results );
 
}
