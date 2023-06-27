<?php
/**
 * Current articles processing
 * 
 * @package kemroc 
 */

/**
 * Ajax_current_articles_action_callback
 */
function kemroc_ajax_current_articles_action_callback() {
	if ( isset( $_POST['nonce'] ) && 
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'current-articles-nonce' ) 
	) {
		wp_die( esc_html__( 'Daten, die von einer fremden Adresse gesendet werden', 'kemroc' ) );
	}

	$err_message   = array();
	$articles_list = array();
	$navigation    = '';

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

	$articles_args = array(
		'post_type'      => 'post',
		'post_status'    => 'published',
		'paged'          => $page_number,
	);

	if ( isset( $_POST['posts_per_page'] ) ) {
		$posts_per_page                  = sanitize_text_field( wp_unslash( $_POST['posts_per_page'] ) );
		$articles_args['posts_per_page'] = $posts_per_page;
	}

	if ( isset( $_POST['cat'] ) ) {
		$cat                  = sanitize_text_field( wp_unslash( $_POST['cat'] ) );
		$articles_args['cat'] = $cat;
	}

	$articles_query = new WP_Query( $articles_args );

	if ( $articles_query->have_posts() ) :
		while ( $articles_query->have_posts() ) :
			$articles_query->the_post(); 
			
			$article_item  = '<div class="current-articles__item">';
			$article_item .= kemroc_get_template_part_content( 
				'template-parts/cards/article/article', 
				'current', 
				array( 'class' => 'current-article' ) 
			);
			$article_item .= '</div><!-- /.current-articles__item -->';
			
			$articles_list[] = $article_item;
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
			$articles_query,
			$page_number
		);

		$navigation = str_replace( 'wp-admin/admin-ajax.php', $page_slug, $navigation );
	endif;

	if ( $err_message ) {
		wp_send_json_error( $err_message );
	} else {
		wp_send_json_success(
			array(
				'articles_list' => $articles_list,
				'navigation'    => $navigation,
			) 
		);
	}

	wp_die();
}

if ( wp_doing_ajax() ) {
	add_action( 'wp_ajax_current_articles_action', 'kemroc_ajax_current_articles_action_callback' );
	add_action( 'wp_ajax_nopriv_current_articles_action', 'kemroc_ajax_current_articles_action_callback' );
}
