<?php
/**
 * All News processing
 * 
 * @package kemroc 
 */

/**
 * Ajax_all_news_action_callback
 */
function kemroc_ajax_all_news_action_callback() {
	if ( isset( $_POST['nonce'] ) && 
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'all-news-nonce' ) 
	) {
		$err_message['spam'] = esc_html__( 'Daten, die von einer fremden Adresse gesendet werden', 'kemroc' );
	}

	$err_message = array();
	$posts       = array();
	$navigation  = '';

	if ( ! isset( $_POST['page_number'] ) ) {
		$err_message['page_number'] = 'empty';
	} else {
		$page_number = sanitize_text_field( wp_unslash( $_POST['page_number'] ) );
	}

	if ( ! isset( $_POST['page_slug'] ) ) {
		$err_message['page_slug'] = 'empty';
	} else {
		$page_slug = sanitize_text_field( wp_unslash( $_POST['page_slug'] ) );
	}

	$args = array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'paged'          => $page_number,
	);

	if ( isset( $_POST['posts_per_page'] ) ) {
		$posts_per_page         = sanitize_text_field( wp_unslash( $_POST['posts_per_page'] ) );
		$args['posts_per_page'] = $posts_per_page;
	}

	if ( isset( $_POST['cat'] ) ) {
		$cat         = sanitize_text_field( wp_unslash( $_POST['cat'] ) );
		$args['cat'] = $cat;
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post(); 
			
			$new_item = kemroc_get_template_part_content( 
				'template-parts/cards/news/new', 
				'card'
			);
			
			$posts[] = $new_item;
		endwhile; 
		wp_reset_postdata();

        $navigation = kemroc_get_the_posts_pagination( //phpcs:ignore
			array(
				'class'     => 'kemroc-navigation',
				'prev_text' => '', 
				'next_text' => '',
			),
			$query,
			$page_number
		);

		$navigation = str_replace( 'wp-admin/admin-ajax.php', $page_slug, $navigation );
	endif;

	if ( $err_message ) {
		wp_send_json_error( $err_message );
	} else {
		wp_send_json_success(
			array(
				'posts'      => $posts,
				'navigation' => $navigation,
			) 
		);
	}

	wp_die();
}

if ( wp_doing_ajax() ) {
	add_action( 'wp_ajax_all_news_action', 'kemroc_ajax_all_news_action_callback' );
	add_action( 'wp_ajax_nopriv_all_news_action', 'kemroc_ajax_all_news_action_callback' );
}
