<?php
/**
 * Products processing
 * 
 * @package kemroc 
 */

/**
 * Ajax_products_action_callback
 */
function kemroc_ajax_products_action_callback() {
	if ( isset( $_POST['nonce'] ) && 
	! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'products-nonce' ) 
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
		'post_type'      => 'page',
		'post_status'    => 'published',
		'paged'          => $page_number,
	);

	if ( isset( $_POST['posts_per_page'] ) ) {
		$posts_per_page         = sanitize_text_field( wp_unslash( $_POST['posts_per_page'] ) );
		$args['posts_per_page'] = $posts_per_page;
	}

	if ( isset( $_POST['parent_page_id'] ) ) {
		$parent_page_id      = sanitize_text_field( wp_unslash( $_POST['parent_page_id'] ) );
		$args['post_parent'] = $parent_page_id;
	}

	$query = new WP_Query( $args );
	if ( $query->have_posts() ) :
		while ( $query->have_posts() ) :
			$query->the_post(); 
			
			$article_item  = '<div class="products__item">';
			$article_item .= kemroc_get_template_part_content( 
				'template-parts/cards/product/product', 
				null, 
				array( 'class' => 'product-card' ) 
			);
			$article_item .= '</div><!-- /.products__item -->';
			
			$posts[] = $article_item;
		endwhile; 
		wp_reset_postdata();

		$prev_arrow = kemroc_get_template_part_content(
			'template-parts/icons/arrow-left',
			null,
			array( 'fill' => '#ff6000' ) 
		);
		$next_arrow = kemroc_get_template_part_content(
			'template-parts/icons/arrow-right',
			null,
			array( 'fill' => '#ff6000' ) 
		);
        $navigation = kemroc_get_the_posts_pagination( //phpcs:ignore
			array(
				'class'     => 'kemroc-navigation',
				'prev_text' => $prev_arrow, 
				'next_text' => $next_arrow,
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
	add_action( 'wp_ajax_products_action', 'kemroc_ajax_products_action_callback' );
	add_action( 'wp_ajax_nopriv_products_action', 'kemroc_ajax_products_action_callback' );
}
